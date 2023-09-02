@extends('layout.connectionHeader')

@section('nomtitre')
Se Connecter
@endsection

@section('monbody')
<body class="text-center">
  <div class="d-flex align-items-center justify-content-center">
  <form class="form-signin" action="{{ route('verifConnection') }}" method="get" style="max-width: 400px;">
    @csrf
    @method('POST')
    <img class="mb-4 mx-auto d-block" src="{{asset("logo.png")}}" alt="" width="150" height="150">
    <h1 class="h3 mb-3 font-weight-normal text-center">Se Connecter</h1>
    <div class="form-group">
      <label for="inputIdentifiant" class="sr-only"><h3>Identifiant :</h3></label>
      <input type="text" id="inputIdentifiant" name="Identifiant" class="form-control form-control-lg mb-1" style="background-color: #F1EDC8" placeholder="Identifiant" required="" autofocus="">
      <label for="inputPassword" class="sr-only"><h3>Mot de passe :</h3></label>
      <input type="password" id="inputPassword" name="Password" class="form-control form-control-lg" style="background-color: #F1EDC8" placeholder="Mot de passe" required="">  
    </div>      
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <button class="btn btn-lg btn-outline-warning btn-block text-dark" type="submit">Se connecter</button>
  </form>
  </div>
</body>
@endsection