<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Fonte Google -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- CSS da aplicação -->
    <link rel="stylesheet" href="/css/styles.css">
    <script src="/js/scripts.js"></script>

    {{-- SCRIPT EDITOR --}}
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: 'textarea#editor',
            skin: 'bootstrap',
            plugins: 'lists, link, image, media',
            toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help',
            menubar: false,
        });
    </script>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            @if (session('msg'))
                <p class="msg">{{ session('msg') }}</p>
            @endif
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <a href="/" class="navbar-brand">
                        <img src="https://pbs.twimg.com/profile_images/880419617130336257/7ZQLukqw_400x400.jpg"
                            class="img-logo" width="100%" />
                    </a>
                    <ul class="nav flex-column bg-light">
                        <li class="nav-item">
                            <a href="/" class="nav-link">
                                <ion-icon name="newspaper-outline"></ion-icon>
                                Periódicos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/journals/create" class="nav-link">
                                <ion-icon name="create-outline"></ion-icon>
                                Criar periódico
                            </a>
                        </li>

                        @auth
                            <li class="nav-item">
                                <a href="/dashboard" class="nav-link">
                                    <ion-icon name="list-outline"></ion-icon>
                                    Meus periódicos
                                </a>
                            </li>
                        @endauth

                    </ul>
                    <div class="nav-footer">
                        <ul class="nav flex-column bg-light">
                            @auth
                                <li class="nav-item">
                                    <form action="/logout" method="POST">
                                        @csrf
                                        <a href="/logout" class="nav-link"
                                            onclick="
                                                event.preventDefault();
                                                this.closest('form').submit();">
                                            <ion-icon name="log-out-outline"></ion-icon>
                                            Sair
                                        </a>
                                    </form>
                                </li>
                            @endauth

                            @guest
                                <li class="nav-item">
                                    <a href="/login" class="nav-link">
                                        <ion-icon name="log-in-outline"></ion-icon>
                                        Entrar
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/register" class="nav-link">
                                        <ion-icon name="log-in-outline"></ion-icon>
                                        Cadastrar
                                    </a>
                                </li>

                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            <main class="col-md-10">
                @yield('content')
            </main>
        </div>
    </div>

    <footer>
        <p>Periódicos IFSP &copy; 2022</p>
    </footer>
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
</body>

</html>
