@extends('layout.master')

@section('nomtitre')
Modification d'une tâche
@endsection

@section('monbody')

<div class="container-fluid">
    <div class="column">
        <form action="{{url("EditTache",$tache[0]->id)}}" method="get">    
            @method('POST')
            @csrf
            <input type="hidden" name="idUser" value="{{ $tache[0]->idUser }}">
            <input type="hidden" name="idTache" value="{{ $tache[0]->id }}">
            <div class="form-group">
                <label for="Nom">Nom de la tâche</label>
                <input type="text" class="form-control" id="Nom" name="Nom" value="{{ $tache[0]->Nom }}" placeholder="{{ $tache[0]->Nom }}">
            </div>
            <div class="form-group">
                <label for="Description">Description</label>
                <input type="text" class="form-control" id="Description" name="Description" value="{{ $tache[0]->Description }}" placeholder="{{ $tache[0]->Description }}">
            </div>
            <div class="form-group">
                <label for="Date_Echeance">Date d'échéance</label>
                <input type="date" class="form-control" id="Date_Echeance" name="Date_Echeance" min="{{ $dateMini }}" value="{{ $tache[0]->Date_Echeance }}" placeholder="{{ $tache[0]->Date_Echeance }}">
            </div>
            <div class="form-group">
                <label for="Priorite">Priorité</label>
                <select class="form-control" id="Priorite" name="Priorite">
                    // ajout d'un foreach pour afficher les priorités
                    @foreach ($priorites as $priorite)
                    <option value="{{ $priorite->id }}">{{ $priorite->LibellePriorite }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="Statut">Statut</label>
                <select class="form-control" id="Statut" name="Statut">
                    @foreach ($statuts as $statut)
                    <option value="{{ $statut->id }}">{{ $statut->LibelleStatut }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Modifier la tâche</button>
        </form>
    </div>
    </div>

@endsection