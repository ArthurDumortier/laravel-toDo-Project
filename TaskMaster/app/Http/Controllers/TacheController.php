<?php

namespace App\Http\Controllers;

use App\Models\TacheModel;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;


class TacheController extends Controller
{
    public function GetTaches($id)
    {
        $taches = new TacheModel();

        return view('TachesAccueilView', ['taches' => $taches->GetTaches($id), 'id' => $id, 'priorites' => $taches->GetPriorites(), 'statuts' => $taches->GetStatuts(), 'dateMini' => now(), 'dateDuJour' => now()]);
    }


    public function GetTachesFini($id)
    {
        $taches = new TacheModel();

        return view('TachesFiniView', ['taches' => $taches->GetTachesFini($id), 'id' => $id, 'priorites' => $taches->GetPriorites(), 'statuts' => $taches->GetStatuts()]);
    }

    public function CreateTaches($id)
    {
        $priorites = new TacheModel();
        $statuts = new TacheModel();        
        return view('CreateTachesView', ['id' => $id, 'priorites' => $priorites->GetPriorites(), 'statuts' => $statuts->GetStatuts(), 'dateMini' => now()]);
    }

    public function AddTache($id, Request $request) 
    {
        $validated = $request->validate([
            'Nom' => 'required|max:255',
            'Description' => 'required|max:255',
            'Date_Echeance' => 'required|date|after_or_equal:today',
            'Priorite' => 'required|integer',
        ]);

        $tache = new TacheModel();
        $tache->AddTache($id, $request->input('Nom'), $request->input('Description'), $request->input('Date_Echeance'), $request->input('Priorite'));
        return redirect()->route('TachesAccueil', ['id' => $id]);
    }

    public function CloseTache($idTache)
    {
        $tache = new TacheModel();
        $tache->CloseTache($idTache);
        return redirect()->route('TachesAccueil', ['id' => $tache->GetIdUser($idTache)]);
    }

    public function GoToEditTache($idTache)
    {
        $tache = new TacheModel();
        $tache = $tache->GetTache($idTache);
        $priorites = new TacheModel();
        $statuts = new TacheModel();
        return view('EditTacheView', ['tache' => $tache, 'priorites' => $priorites->GetPriorites(), 'statuts' => $statuts->GetStatuts(), 'dateMini' => now()]);
    }

    public function EditTache($id, Request $request) 
    {
        $validated = $request->validate([
            'Nom' => 'required|max:255',
            'Description' => 'required|max:255',
            'Date_Echeance' => 'required|date|after_or_equal:today',
            'Priorite' => 'required|integer',
            'Statut' => 'required|integer',
        ]);

        $tache = new TacheModel();
        $tache->EditTache($request->input('idTache'), $request->input('Nom'), $request->input('Description'), $request->input('Date_Echeance'), $request->input('Priorite'), $request->input('Statut'));
        return redirect()->route('TachesAccueil', ['id' => $request->input('idUser')]);
    }

    // public function SearchTache($id, Request $request)
    // {
    //     $taches = new TacheModel();
    //     $tachesQuery = $taches->SearchTache($id, $request->input('searchText'));

    //     $perPage = 5; // Nombre d'éléments par page
    //     $currentPage = request()->input('page', 1); // Récupère le numéro de page à partir de la requête

    //     $tachesPaginated = new LengthAwarePaginator(
    //         $tachesQuery->forPage($currentPage, $perPage), // Récupère les éléments pour la page courante
    //         $tachesQuery->count(), // Total d'éléments
    //         $perPage, // Nombre d'éléments par page
    //         $currentPage, // Numéro de page courante
    //         ['path' => request()->url()] // URL de base pour la pagination
    //     );

    //     if($request->input('searchText') == null)
    //     {
    //         return redirect()->route('TachesAccueil', ['id' => $id, 'priorites' => $taches->GetPriorites(), 'statuts' => $taches->GetStatuts(), 'dateMini' => now()]);
    //     }
    //     else 
    //     {   
    //         return view('TachesAccueilView', ['taches' =>  $tachesPaginated, 'id' => $id, 'priorites' => $taches->GetPriorites(), 'statuts' => $taches->GetStatuts(), 'dateMini' => now()]);
    //     }
    // }
    
    // public function SearchTacheFini($id, Request $request)
    // {
    //     $taches = new TacheModel();
    //     $tachesQuery = $taches->SearchTacheFini($id, $request->input('searchText'));

    //     $perPage = 5; // Nombre d'éléments par page
    //     $currentPage = request()->input('page', 1); // Récupère le numéro de page à partir de la requête

    //     $tachesPaginated = new LengthAwarePaginator(
    //         $tachesQuery->forPage($currentPage, $perPage), // Récupère les éléments pour la page courante
    //         $tachesQuery->count(), // Total d'éléments
    //         $perPage, // Nombre d'éléments par page
    //         $currentPage, // Numéro de page courante
    //         ['path' => request()->url()] // URL de base pour la pagination
    //     );

    //     if($request->input('searchText') == null)
    //     {
    //         return redirect()->route('TacheFinis', ['id' => $id, 'priorites' => $taches->GetPriorites(), 'statuts' => $taches->GetStatuts()]);
    //     }
    //     else 
    //     {   
    //         return view('TachesFiniView', ['taches' =>  $tachesPaginated, 'id' => $id, 'priorites' => $taches->GetPriorites(), 'statuts' => $taches->GetStatuts()]);
    //     }
    // }
}
