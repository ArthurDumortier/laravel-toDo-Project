<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsConnected
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $sessionToken = $request->session()->get('remember_token');
        $isInitialLogin = $request->session()->get('is_initial_login');


        if ($sessionToken) {
            // L'utilisateur est authentifié
            if ($request->routeIs('Connection')) {
                $request->session()->forget('is_initial_login'); // Supprimer la variable de session après l'utilisation
                // L'utilisateur essaie d'accéder à la page de connexion, redirigez-le vers la page ProgramView
                return redirect()->route('TachesAccueil', ['id' => $request->session()->get('user')->id]);
            }
        } else {
            // L'utilisateur n'est pas authentifié, redirigez-le vers la page de connexion
            if (!$request->routeIs('Connection') || $isInitialLogin) {
                return redirect()->route('Connection');
            }
        }

        // L'utilisateur est authentifié ou accède à la page de connexion, continuez avec la demande
        return $next($request);
    }
}
