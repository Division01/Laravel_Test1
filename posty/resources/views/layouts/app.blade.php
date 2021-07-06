<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Posty</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body class="bg-gray-200">
        <nav class="p-6 bg-white flex justify-between mb-6">
            <ul class="flex items-center" style="list-style-type:none">
                <li>
                    <a href="/" class="p-5">Home</a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}" class="p-5">Dashboard</a>
                </li>
                <li>
                    <a href="" class="p-5">Posts</a>
                </li>
            </ul>

            <ul class="flex items-center" style="list-style-type:none">

                @auth
                    <li>
                        <a href="" class="p-5">Name</a>
                    </li>
                    <li>
                        {{-- Je laisse le commentaire pour rappel que ce n'est pas une bonne façon de faire, il est intéressant
                        de faire la requête via la méthode POST pou utiliser le @csrf niveau cybersécurité. Malheureusement
                        ça ne foncitonnait pas chez moi, j'ai donc dû trouver une solution alternative --}}

                        {{-- <form action="{{ route('logout') }} method="post" class="inline p-5">
                            @csrf
                            <button type="submit">Logout</button>
                        </form> --}}
                        
                        <a href=" {{ route('logout') }} " class="p-5">Logout</a>

                    </li>
                @endauth

                @guest
                    <li>
                        <a href=" {{ route('login') }} " class="p-5">Login</a>
                    </li>
                    <li>
                        <a href=" {{ route('register') }} " class="p-5">Register</a>
                    </li>
                @endguest

            </ul>
        </nav>

        @yield('content')
    </body>
</html>