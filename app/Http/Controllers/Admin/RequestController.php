<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Request as ClientRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index()
    {
        $requests = ClientRequest::with('category')->latest()->paginate(10);
        return view('admin.requests.index', compact('requests'));
    }

    public function destroy(ClientRequest $client_request)
    {
        // On renomme le paramètre en client_request (ou id) pour éviter le conflit avec Request de Http
        $client_request->delete();
        return back()->with('success', 'La demande a été supprimée avec succès.');
    }
}
