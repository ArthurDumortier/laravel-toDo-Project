<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session; //méthode sesssion (message)


class ConnectionController extends Controller
{
    public function Connection()
    {
        return view('ConnectionView');
    }

    public function VerifConnection(Request $request)
    {
        $request->validate([
            'Identifiant' => 'required',
            'Password' => 'required',
        ]);

        $credentials = $request->only('Identifiant', 'Password');

    
        $user = User::where('Identifiant', $credentials['Identifiant'])->first();

        if ($user && Hash::check($credentials['Password'], $user->Password)) {
        Log::info('User found:', ['user' => $user]);
        Log::info('Password matches');
            $user->remember_token = Str::random(60);
            $sql = "UPDATE [User] SET remember_token = ? WHERE Identifiant = ?";
            DB::update($sql, [$user->remember_token, $user->Identifiant]);
            Log::info('token : ',  [$user->remember_token]);

            $user = User::where('Identifiant', $credentials['Identifiant'])->first();
            Log::info('Token:', [$user->remember_token]);

            Auth::login($user, $request->has('remember'));
            $request->session()->put('remember_token', $user->remember_token);
            $request->session()->put('user', $user);

            $request->session()->put('is_initial_login', true);
            // Recuperer l'id de l'utilisateur grace à son identifiant

            $user->Id = User::where('Identifiant', $credentials['Identifiant'])->value('Id');
            // dd($user->Id);

            return redirect()->route('TachesAccueil', ['id' => $user->Id]);

        }
      

        return redirect()->back()->withErrors([
            'Identifiant ou mot de passe incorrect.'
        ]);
    }

    public function logout(Request $request)
    {
        $credentials = $request->only('Identifiant', 'Id');

        $user = User::where('Id', $credentials['Id'])->first();

        if ($user) {

            $userId = $request->input('Id'); // récupérer l'ID de l'utilisateur
            $user = User::find($userId); // retrouver l'utilisateur dans la base de données  
            
            $request->session()->put('user', $user);
             // Récupérer l'utilisateur à partir de la session
            // $user = $request->session()->get('user');


            // Mise à jour du remember_token dans la base de données
            $sql = "UPDATE [User]
                    SET remember_token = NULL
                    WHERE Id = ?";
            DB::update($sql, [$user->Id]);


    
            // Déconnexion de l'utilisateur
            Auth::logout();
    
            // Suppression du remember_token de la session
            $request->session()->forget('remember_token');
            $request->session()->forget('user');
        }
        return redirect('/Connection');
    }
}
