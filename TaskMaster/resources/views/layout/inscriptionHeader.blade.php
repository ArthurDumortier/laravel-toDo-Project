<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.menu') {{--  ajoute la sous page s'appelant head --}}
    <title>@yield('nomtitre')</title>
</head>

<body>
    <header>
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 gap-3 border-bottom box-shadow">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        TaskMaster
                    </div>
                    <nav class="col-md-4">
                        <a href="{{url('accueilConnectionView')}}" class="btn btn-outline-primary">Page Welcome</a>
                        <a href="{{url('Connection')}}" class="btn btn-outline-primary">Se Connecter</a>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <div class="contrainer">
        @yield('monbody') {{-- Crée d'un champs permettant d'être modifié dans la page qui appelle ce champs --}}
        <br>
        <br>
    </div>
    @include('layout.footer') {{--  ajoute la sous page s'appelant footer --}}
</body>

</html>
