<?php

namespace App\Http\Controllers;

use App\Models\InscriptionModel;
use Illuminate\Http\Request;

class InscriptionController extends Controller
{
    public function Inscription()
    {
        return view('InscriptionView');
    }

    public function AddUser(Request $request)
    {
        $request->validate([
            'Identifiant' => 'required|min:5',
            'Password' => 'required|min:10',
        ]);

        $user = new InscriptionModel();
        $user->AddUser($request->input('Identifiant'), $request->input('Password'));
        return view('ConnectionView');
        
    }
}
