<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\CreateStandRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StandController extends Controller
{
    public function create(Request $request)
    {
        if ($request->user()?->stand) {
            return redirect()->route('seller.dashboard');
        }

        $user = $request->user();

        $categories = Category::query()
            ->where('is_active', true)
            ->with('parent')
            ->orderBy('name')
            ->get()
            ->map(fn (Category $category) => [
                'id' => $category->id,
                'label' => $category->parent
                    ? $category->parent->translatedName().' — '.$category->translatedName()
                    : $category->translatedName(),
                'kind' => $category->resolvedKind(),
            ])
            ->filter(fn (array $category) => $category['kind'] !== null)
            ->values();

        $countries = config('countries.list', []);

        return view('seller.create-stand', compact('user', 'categories', 'countries'));
    }

    public function store(CreateStandRequest $request)
    {
        $validated = $request->validated();

        $category = Category::findOrFail($validated['category_id']);

        $user = $request->user();

        if ($user) {
            $user->update([
                'name' => $validated['name'],
                'phone_number' => $validated['phone_number'],
                'email' => $validated['email'] ?? $user->email,
            ]);

            if (! $user->hasRole('seller')) {
                $user->assignRole('seller');
            }
        } else {
            $user = User::create([
                'name' => $validated['name'],
                'phone_number' => $validated['phone_number'],
                'email' => $validated['email'] ?? null,
                'password' => Hash::make($validated['password']),
            ]);
            $user->assignRole('seller');
            Auth::login($user);
        }

        $logoPath = $request->hasFile('logo')
            ? $request->file('logo')->store('stands/logos', 'public')
            : null;

        $offer = $validated['kind'] === 'service' ? 'service' : 'produits';
        $description = sprintf('Stand %s — %s (%s)', $validated['stand_name'], $category->name, $offer);

        $stand = $user->stand()->create([
            'stand_name' => $validated['stand_name'],
            'kind' => $validated['kind'],
            'slug' => Str::slug($validated['stand_name']).'-'.$user->id,
            'description' => $description,
            'city' => $validated['city'],
            'country' => $validated['country'],
            'contact_phone' => $validated['phone_number'],
            'contact_email' => $validated['email'] ?? null,
            'logo_url' => $logoPath,
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
        ]);

        $stand->categories()->attach($category->id);
        $stand->buyleadCredits()->create(['available_credits' => 0]);

        try {
            \Illuminate\Support\Facades\Mail::to('bramslevel129@gmail.com')
                ->send(new \App\Mail\StandCreatedMail($stand));
        } catch (\Exception $e) {
            Log::error('Erreur StandCreatedMail : '.$e->getMessage());
        }

        return redirect()->route('seller.loading-stand')
            ->with('success', __('seller.flash.stand_created'));
    }

    public function reverseGeocode(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'lat' => ['required', 'numeric', 'between:-90,90'],
            'lon' => ['required', 'numeric', 'between:-180,180'],
        ], $this->validationMessages(), $this->validationAttributes());

        try {
            $response = Http::timeout(8)
                ->withHeaders([
                    'User-Agent' => config('app.name', 'Kelbom').'/1.0 (stand-onboarding)',
                    'Accept-Language' => 'fr',
                ])
                ->get('https://nominatim.openstreetmap.org/reverse', [
                    'lat' => $validated['lat'],
                    'lon' => $validated['lon'],
                    'format' => 'json',
                    'addressdetails' => 1,
                ]);

            if (! $response->successful()) {
                return response()->json(['message' => __('seller.flash.geocode_unavailable')], 502);
            }

            $address = $response->json('address', []);

            $country = $address['country'] ?? null;
            $city = $address['city']
                ?? $address['town']
                ?? $address['village']
                ?? $address['municipality']
                ?? $address['state']
                ?? null;

            return response()->json([
                'country' => $country,
                'city' => $city,
            ]);
        } catch (\Throwable $e) {
            Log::warning('reverseGeocode failed: '.$e->getMessage());

            return response()->json(['message' => __('seller.flash.geocode_failed')], 502);
        }
    }

    public function edit(Request $request)
    {
        $stand = $request->user()->stand;
        if (! $stand) {
            return redirect()->route('seller.create')->with('error', __('seller.flash.create_stand_first_please'));
        }

        return view('seller.stand.edit', compact('stand'));
    }

    public function update(Request $request)
    {
        $stand = $request->user()->stand;

        $validated = $request->validate([
            'stand_name' => 'required|string|max:255',
            'description' => 'required|string',
            'contact_phone' => 'required|string|max:20',
            'whatsapp_number' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'website_url' => 'nullable|url|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'logo' => 'nullable|image|max:2048',
            'cover' => 'nullable|image|max:2048',
        ], $this->validationMessages(), $this->validationAttributes());

        if ($validated['stand_name'] !== $stand->stand_name) {
            $stand->slug = $stand->generateSlug($validated['stand_name']);
        }

        if ($request->hasFile('logo')) {
            if ($stand->logo_url) {
                Storage::disk('public')->delete($stand->logo_url);
            }
            $stand->logo_url = $request->file('logo')->store('stands/logos', 'public');
        }

        if ($request->hasFile('cover')) {
            if ($stand->cover_url) {
                Storage::disk('public')->delete($stand->cover_url);
            }
            $stand->cover_url = $request->file('cover')->store('stands/covers', 'public');
        }

        $stand->update(collect($validated)->except(['logo', 'cover'])->toArray());

        return redirect()->back()->with('success', __('seller.flash.stand_updated'));
    }

    public function show(Request $request)
    {
        $stand = $request->user()->stand;
        if (! $stand) {
            return redirect()->route('seller.create')->with('error', __('seller.flash.create_stand_first_please'));
        }
        $stand->load(['products', 'activeSubscription']);

        return view('seller.stand.preview', compact('stand'));
    }

    private function validationMessages(): array
    {
        $messages = trans('seller.validation.messages');

        return is_array($messages) ? $messages : [];
    }

    private function validationAttributes(): array
    {
        $attributes = trans('seller.validation.attributes');

        return is_array($attributes) ? $attributes : [];
    }
}
