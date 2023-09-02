@extends('layout.connectionHeader')

@section('nomtitre')
S'inscrire
@endsection

@section('monbody')
<body>
    <form class="form-signin" action="{{ route('addUser')}}" method="get">
      @csrf
      @method('post')
      <div class="text-center mb-4">
        <h1 class="h3 mb-3 font-weight-normal">Formulaire d'inscription</h1>
      </div>
      <div class="form-label-group">
        <label for="inputIdentifiant"><h3>Identifiant</h3></label>
        <input type="text" id="inputIdentifiant" name="Identifiant" class="form-control" placeholder="Pseudo" required="" autofocus="">
      </div>
      <br>
      <div class="form-label-group">
        <label for="inputPassword"><h3>Password</h3></label>
        <input type="password" id="inputPassword"  name="Password" class="form-control" placeholder="Mot de passe" required="">        
      </div>
      <br>
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <button class="btn btn-lg btn-primary btn-block" type="submit">Créer son compte</button>
    </form>
    <br>

</body>
@endsection