<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TacheModel extends Model
{
    use HasFactory;
    protected $table='Taches';
    public $timestamps = false;

    protected $fillable=[
        'Nom',
        'Description',
        'Date_echeance',
        'Date_creation',
        'Priorite',
        'Statut',
    ];

    public function GetTaches($id){
        $taches = DB::table('User')
        ->join('Taches', 'User.id', '=', 'Taches.idUser')
        ->join('Statut', 'Statut.id', '=', 'Taches.idStatut')
        ->join('Priorite', 'Priorite.id', '=', 'Taches.idPriorite')
        ->select('User.Identifiant','Taches.id', 'Taches.Nom', 'Taches.Description', 'Taches.Date_Echeance', 'Statut.LibelleStatut', 'Priorite.LibellePriorite')
        ->where('idUser', '=', $id)
        ->where('Statut.id', '!=', 2)
        ->orderBy('Taches.Date_Echeance', 'asc')
        ->get();

        return $taches;
    }

    public function GetTachesFini($id){
        $taches = DB::table('User')
        ->join('Taches', 'User.id', '=', 'Taches.idUser')
        ->join('Statut', 'Statut.id', '=', 'Taches.idStatut')
        ->join('Priorite', 'Priorite.id', '=', 'Taches.idPriorite')
        ->select('User.Identifiant', 'Taches.Nom', 'Taches.Description', 'Taches.Date_Echeance', 'Statut.LibelleStatut', 'Priorite.LibellePriorite')
        ->where('idUser', '=', $id)
        ->where('Statut.id', '=', 2)
        ->get();
    
        return $taches;
    }

    public function GetPriorites() {
        $priorites = DB::table('Priorite')
        ->select('Priorite.id', 'Priorite.LibellePriorite')
        ->get();

        return $priorites;
    }

    public function GetStatuts() {
        $statuts = DB::table('Statut')
        ->select('Statut.id', 'Statut.LibelleStatut')
        ->get();

        return $statuts;
    }

    public function AddTache($id, $nom, $description, $date_echeance, $priorite) {
        DB::table('Taches')->insert([
            'Nom' => $nom,
            'Description' => $description,
            'Date_Echeance' => $date_echeance,
            'Date_Creation' => date('Y-m-d'),
            'idUser' => $id,
            'idPriorite' => $priorite,
        ]); 
    }

    public function CloseTache($id) {
        //Change le statut de la tâche à 2 (Fini)
        DB::table('Taches')
        ->where('id', $id)
        ->update(['idStatut' => 2]);
    }

    public function GetTache($idTache)
    {
        $tache = DB::table('Taches')
        ->join('Priorite', 'Priorite.id', '=', 'Taches.idPriorite')
        ->join('Statut', 'Statut.id', '=', 'Taches.idStatut')
        ->select('Taches.id', 'Taches.Nom', 'Taches.Description', 'Taches.Date_Echeance', 'Priorite.LibellePriorite', 'Statut.LibelleStatut', 'Taches.idUser')
        ->where('Taches.id', '=', $idTache)
        ->get();

        return $tache;
    }

    public function EditTache($idTache, $nom, $description, $date_echeance, $priorite, $idStatut) {
        // dd($idTache);
        DB::table('Taches')
        ->where('id', $idTache)
        ->update([
            'Nom' => $nom,
            'Description' => $description,
            'Date_Echeance' => $date_echeance,
            'idPriorite' => $priorite,
            'idStatut' => $idStatut,
        ]);
    }

    public function GetIdUser($idTache) {
        $idUser = DB::table('Taches')
        ->select('idUser')
        ->where('id', '=', $idTache)
        ->value('idUser');

        return $idUser;
    }
    
    // public function SearchTache($id, $search) {
    //     $taches = DB::table('Taches')
    //         ->join('Priorite', 'Priorite.id', '=', 'Taches.idPriorite')
    //         ->join('Statut', 'Statut.id', '=', 'Taches.idStatut')
    //         ->join('User', 'User.id', '=', 'Taches.idUser')
    //         ->select('User.Identifiant', 'Taches.id', 'Taches.Nom', 'Taches.Description', 'Taches.Date_Echeance', 'Statut.LibelleStatut', 'Priorite.LibellePriorite')
    //         ->where('idStatut', '!=', 2)
    //         ->where('idUser', '=', $id)
    //         ->where(function ($query) use ($search) {
    //             $query->where('Taches.Nom', 'LIKE', '%'.$search.'%')
    //                 ->orWhere('Taches.Description', 'LIKE', '%'.$search.'%');
    //         })
    //         ->orderby('Taches.Date_Echeance', 'asc')
    //         ->get();

    //     return $taches;
    // }

    // public function SearchTacheFini($id, $search) 
    // {
    //     $taches = DB::table('Taches')
    //     ->join('Priorite', 'Priorite.id', '=', 'Taches.idPriorite')
    //     ->join('Statut', 'Statut.id', '=', 'Taches.idStatut')
    //     ->join('User', 'User.id', '=', 'Taches.idUser')
    //     ->select('User.Identifiant', 'Taches.id', 'Taches.Nom', 'Taches.Description', 'Taches.Date_Echeance', 'Statut.LibelleStatut', 'Priorite.LibellePriorite')
    //     ->where('idStatut', '=', 2)
    //     ->where('idUser', '=', $id)
    //     ->where(function ($query) use ($search) {
    //         $query->where('Taches.Nom', 'LIKE', '%'.$search.'%')
    //             ->orWhere('Taches.Description', 'LIKE', '%'.$search.'%');
    //     })
    //     ->orderby('Taches.Date_Echeance', 'asc')
    //     ->get();

    // return $taches;
    // }
}
