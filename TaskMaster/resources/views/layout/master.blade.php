<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.menu') {{--  ajoute la sous page s'appelant head --}}
    <title>@yield('nomtitre')</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('TachesAccueil', session('user')->Id) }}">Task Master</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('TachesAccueil', session('user')->Id) }}">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('TachesFini', session('user')->Id) }}">Mes Taches Fini</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('TachesAccueil', session('user')->Id) }}">Taches en cours</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="get">
                            @method('post')
                                @csrf
                                @if(session('user'))
                                    <input type="hidden" name="Id" value="{{ session('user')->Id }}"> 
                                @endif
                                <button type="submit" class="btn btn-outline-warning p-2 text-dark mx-1">Se déconnecter</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="contrainer">
        @yield('monbody') {{-- Crée d'un champs permettant d'être modifié dans la page qui appelle ce champs --}}
    </div>
    @include('layout.footer') {{--  ajoute la sous page s'appelant footer --}}
</body>

</html>
