<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Resources\Stand\StandResource;
use App\Models\Category;
use App\Models\Stand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StandController extends Controller
{
    private const SESSION_KEY = 'stand_creation_data';

    public function create(Request $request)
    {
        // Vérifier si la session possède le numéro de téléphone (venant du register)
        if (!session()->has('registered_seller_phone')) {
            return redirect()->route('seller.register')->with('error', 'Veuillez d\'abord créer un compte.');
        }

        $step = (int) $request->get('step', 1);

        // Ensure we don't skip steps
        if ($step > 1 && !session()->has(self::SESSION_KEY)) {
            return redirect()->route('seller.stand.create', ['step' => 1]);
        }

        $data = session(self::SESSION_KEY, []);

        $categories = Category::whereNull('parent_id')
            ->where('is_active', true)
            ->with([
                'children' => function ($query) {
                    $query->where('is_active', true);
                }
            ])
            ->get();


        return view('seller.create-stand', [
            'currentStep' => $step,
            'data' => $data,
            'categories' => $categories,
        ]);
    }

    public function storeStep(Request $request)
    {
        $step = (int) $request->input('current_step');
        $validatedData = [];

        switch ($step) {
            case 1:
                $validatedData = $request->validate([
                    'stand_name' => 'required|string|max:255',
                    'categories' => 'required|array',
                    'categories.*' => 'exists:categories,id',
                    'short_desc' => 'required|string|max:150',
                ]);
                break;

            case 2:
                $validatedData = $request->validate([
                    'country' => 'required|string|max:100',
                    'city' => 'required|string|max:100',
                    'zone' => 'required|string|max:255',
                    'address' => 'nullable|string|max:500',
                ]);
                break;

            case 3:
                $validatedData = $request->validate([
                    'phone' => 'required|string|max:20',
                    'whatsapp' => 'nullable|string|max:20',
                    'email' => 'nullable|email|max:255',
                    'website' => 'nullable|url|max:255',
                ]);
                break;

            case 4:
                return $this->store($request);
        }

        $currentData = session(self::SESSION_KEY, []);
        session([self::SESSION_KEY => array_merge($currentData, $validatedData)]);

        return redirect()->route('seller.stand.create', ['step' => $step + 1]);
    }

    public function store(Request $request)
    {
        $phone = session('registered_seller_phone');
        if (!$phone) {
            return redirect()->route('seller.register')->with('error', 'Session expirée, veuillez recommencer.');
        }

        $user = \App\Models\User::where('phone_number', $phone)->first();
        if (!$user) {
            return redirect()->route('seller.register')->with('error', 'Utilisateur non trouvé.');
        }

        if ($user->stand) {
            return redirect()->route('seller.dashboard')->with('error', 'Vous avez déjà un stand.');
        }

        $sessionData = session(self::SESSION_KEY, []);

        $request->validate([
            'logo' => 'nullable|image|max:2048',
            'cover' => 'nullable|image|max:2048',
        ]);

        $logoPath = $request->hasFile('logo') ? $request->file('logo')->store('stands/logos', 'public') : null;
        $coverPath = $request->hasFile('cover_image') ? $request->file('cover_image')->store('stands/covers', 'public') : null;

        $seller = $user->stand()->create([
            'stand_name' => $sessionData['stand_name'],
            'slug' => Str::slug($sessionData['stand_name']) . '-' . $user->id,
            'description' => $sessionData['short_desc'],
            'city' => $sessionData['city'],
            'country' => $sessionData['country'],
            'address' => ($sessionData['zone'] ?? '') . ' - ' . ($sessionData['address'] ?? ''),
            'contact_phone' => $sessionData['phone'],
            'whatsapp_number' => $sessionData['whatsapp'] ?? null,
            'contact_email' => $sessionData['email'] ?? $user->email,
            'website_url' => $sessionData['website'] ?? null,
            'logo_url' => $logoPath,
            'cover_url' => $coverPath,
        ]);

        if (!empty($sessionData['categories'])) {
            $seller->categories()->attach($sessionData['categories']);
        }

        $seller->buyleadCredits()->create(['available_credits' => 0]);
        session()->forget(self::SESSION_KEY);

        return redirect()->route('seller.loading-stand')->with('success', 'Votre stand a été créé avec succès.');
    }

    public function edit(Request $request)
    {
        $stand = $request->user()->stand;
        if (!$stand) {
            return redirect()->route('seller.stand.create')->with('error', 'Veuillez d\'abord créer un stand.');
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
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'logo' => 'nullable|image|max:2048',
            'cover' => 'nullable|image|max:2048',
        ]);

        if ($validated['stand_name'] !== $stand->stand_name) {
            $stand->slug = $stand->generateSlug($validated['stand_name']);
        }

        if ($request->hasFile('logo')) {
            if ($stand->logo_url) {
                Storage::disk('public')->delete($stand->logo_url);
            }
            $path = $request->file('logo')->store('stands/logos', 'public');
            $stand->logo_url = $path;
        }

        if ($request->hasFile('cover_image')) {
            if ($stand->cover_url) {
                Storage::disk('public')->delete($stand->cover_url);
            }
            $path = $request->file('cover')->store('stands/covers', 'public');
            $stand->cover_url = $path;
        }

        $stand->update(collect($validated)->except(['logo', 'cover'])->toArray());

        return redirect()->back()->with('success', 'Votre stand a été mis à jour.');
    }

    public function show(Request $request)
    {
        $stand = $request->user()->stand;
        if (!$stand) {
            return redirect()->route('seller.stand.create')->with('error', 'Veuillez d\'abord créer un stand.');
        }
        $stand->load(['products', 'activeSubscription']);
        return view('seller.stand.preview', compact('stand'));
    }
}
