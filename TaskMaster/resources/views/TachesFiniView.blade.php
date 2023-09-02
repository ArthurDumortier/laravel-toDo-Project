@extends('layout.master')

@section('nomtitre')
Mes Taches
@endsection

@section('monbody')

@if($taches->count() == 0)
<h3 class="row d-flex justify-content-center m-3">Vous n'avez pas encore Terminer de tâches</h3>
@else
<!-- <div class="row d-flex justify-content-end m-4">
    @include('layout.searchbarfini')
</div> -->
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-10">
            <table id="myTable" class="table table-bordered table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nom de la tâche</th>
                        <th scope="col">Description</th>
                        <th scope="col">Date d'échéance</th>
                        <th scope="col">Priorité</th>
                        <th scope="col">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($taches as $tache)
                    <tr>
                        <td>{{ $tache->Nom }}</td>
                        <td>{{ $tache->Description }}</td>
                        <td>{{ $tache->Date_Echeance }}</td>
                        <td>{{ $tache->LibellePriorite }}</td>
                        <td>{{ $tache->LibelleStatut }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('layout.script')

@endif
@endsection
