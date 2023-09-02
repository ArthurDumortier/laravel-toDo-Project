@extends('layout.master')

@section('nomtitre')
Mes Taches
@endsection

@section('monbody')

@if($taches->count() == 0)
<h3 class="row d-flex justify-content-center m-3">Vous n'avez pas encore Créer de tâches</h3>
@else
<!-- <div class="row d-flex justify-content-end m-4">
    @include('layout.searchbar')
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
                        <th scope="col">Modifier</th>
                        <th scope="col">Fermé</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($taches as $tache)
                    @if ($tache == null)
                    <tr>
                        <td colspan="7">Vous n'avez pas de tâches</td>
                    </tr>
                    @else
                    <tr>
                        <td>{{ $tache->Nom }}</td>
                        <td>{{ $tache->Description }}</td>
                        <td>{{ date('d-m-Y', strtotime($tache->Date_Echeance)) }}</td>
                        <td>{{ $tache->LibellePriorite }}</td>
                        @if ($tache->Date_Echeance < $dateDuJour) 
                        <td>En retard</td>
                        @else 
                            <td>{{ $tache->LibelleStatut }}</td>
                        @endif
                        <td>
                            <a href="{{ url('GoToEditTache', $tache->id) }}" class="btn btn-primary">Modifier</a>
                        </td>
                        <td>
                            <a href="{{ url('CloseTache', $tache->id) }}" class="btn btn-danger">Fermé</a>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
        @endif
        <div class="row d-flex justify-content-center m-4">
            <div class="text-center">
                <button type="button" class="btn btn-outline-warning text-dark" data-toggle="modal"
                    data-target="#AddTacheModal">
                    Ajouter une tâche
                </button>
                
                <div class="modal fade" id="AddTacheModal" tabindex="-1" role="dialog"
                    aria-labelledby="AddTacheModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="background-color: #FEFAE2">
                            <div class="modal-header">
                                <h5 class="modal-title" id="AddTacheModalLabel">Création de programme</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="text-center">
                                    <form action="{{url("AddTache",$id)}}" method="get">
                                        @method('POST')
                                        @csrf
                                        <div class="form-group">
                                            <label for="Nom">Nom de la tâche</label>
                                            <input type="text" class="form-control" id="Nom" name="Nom"
                                                placeholder="Nom de la tâche">
                                        </div>
                                        <div class="form-group">
                                            <label for="Description">Description</label>
                                            <input type="text" class="form-control" id="Description" name="Description"
                                                placeholder="Description">
                                        </div>
                                        <div class="form-group">
                                            <label for="Date_Echeance">Date d'échéance</label>
                                            <input type="date" class="form-control" id="Date_Echeance"
                                                name="Date_Echeance" min="{{ $dateMini }}"
                                                placeholder="Date d'échéance">
                                        </div>
                                        <div class="form-group">
                                            <label for="Priorite">Priorité</label>
                                            <select class="form-control" id="Priorite" name="Priorite">
                                                // ajout d'un foreach pour afficher les priorités
                                                @foreach ($priorites as $priorite)
                                                <option value="{{ $priorite->id }}">{{ $priorite->LibellePriorite }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit"
                                                class="btn btn-outline-warning text-dark">Créer</button>
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-dismiss="modal">Fermer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
    </div>
    
    @include('layout.script')
@endsection
