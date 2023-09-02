<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InscriptionModel extends Model
{
    protected $table = 'User';

    public function AddUser($Identifiant, $Password){
        // Méthode bcrypt : permet de hacher mdp
        $hashedPassword = bcrypt($Password);

        $user = DB::insert('INSERT INTO [User] (Identifiant, [Password], CreationDate) VALUES (?, ?, ?)', [
            $Identifiant, $hashedPassword, now()
        ]);
        return $user;
    }
}
