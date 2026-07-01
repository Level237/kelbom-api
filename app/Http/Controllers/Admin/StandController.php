<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stand;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StandController extends Controller
{
    public function index()
    {
        $stands = Stand::with('user')->latest()->paginate(10);
        return view('admin.stands.index', compact('stands'));
    }

    public function create()
    {
        // On récupère les utilisateurs avec le rôle 'seller' qui n'ont pas encore de stand
        $users = User::whereHas('roles', function($q) {
            $q->where('name', 'seller');
        })->doesntHave('stand')->get();

        return view('admin.stands.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id|unique:stands,user_id',
            'stand_name' => 'required|string|max:255',
            'description' => 'required|string',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'whatsapp_number' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
        ]);

        Stand::create([
            'user_id' => $request->user_id,
            'stand_name' => $request->stand_name,
            'slug' => Str::slug($request->stand_name) . '-' . uniqid(),
            'description' => $request->description,
            'city' => $request->city,
            'country' => $request->country ?? 'Togo',
            'whatsapp_number' => $request->whatsapp_number,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,
            'is_verified' => $request->has('is_verified'),
        ]);

        return redirect()->route('admin.stands.index')->with('success', 'Stand créé avec succès.');
    }

    public function show(Stand $stand)
    {
        $stand->load(['user', 'products.category']);
        return view('admin.stands.show', compact('stand'));
    }

    public function toggleStatus(Stand $stand)
    {
        $stand->update([
            'is_verified' => !$stand->is_verified
        ]);

        $status = $stand->is_verified ? 'activé (vérifié)' : 'désactivé';
        return back()->with('success', "Le stand a été $status avec succès.");
    }

    public function edit(Stand $stand)
    {
        return view('admin.stands.edit', compact('stand'));
    }

    public function update(Request $request, Stand $stand)
    {
        $request->validate([
            'stand_name' => 'required|string|max:255',
            'description' => 'required|string',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'whatsapp_number' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
        ]);

        $stand->update([
            'stand_name' => $request->stand_name,
            'description' => $request->description,
            'city' => $request->city,
            'country' => $request->country ?? 'Togo',
            'whatsapp_number' => $request->whatsapp_number,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,
            'is_verified' => $request->has('is_verified'),
        ]);

        return redirect()->route('admin.stands.index')->with('success', 'Stand mis à jour avec succès.');
    }

    public function destroy(Stand $stand)
    {
        $stand->delete();
        return redirect()->route('admin.stands.index')->with('success', 'Stand supprimé avec succès.');
    }
}
