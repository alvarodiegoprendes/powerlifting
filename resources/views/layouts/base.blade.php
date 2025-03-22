<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
        }
        
        .navbar {
            background-color: #333;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            width: 100%;
        }
        
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0.5rem;
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
        }
        
        .nav-links {
            display: flex;
            gap: 1rem;
            width: 100%;
        }
        
        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 0.5rem;
            transition: color 0.3s;
        }
        
        .nav-links a:hover {
            color: #f0f0f0;
        }
        
        .nav-toggle {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        @media (max-width: 768px) {
            .nav-toggle {
                display: block;
            }
            
            .nav-links {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: #333;
                flex-direction: column;
                padding: 1rem;
                gap: 1rem;
                display: none;
            }
            
            .nav-links.active {
                display: flex;
            }
            
            .nav-links a {
                width: 100%;
                padding: 0.75rem 0;
            }
        }
        
        .container {
            padding: 0.5rem;
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
            box-sizing: border-box;
            overflow-x: hidden;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <button class="nav-toggle" id="navToggle">&#9776;</button>
            <div class="nav-links" id="navLinks">
                <a href="{{route('ranking.index') }}">Ranking de Atletas</a>
                <a href="{{route('atleta.index') }}">Listado de Atletas</a>
                <a href="{{route('competencia.index')}}">Listado de Competencias</a>
                <a style="margin-left: auto;" href="{{route('login')}}">Login</a>
                
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('body')
    </div>

    <script>
        document.getElementById('navToggle').addEventListener('click', function() {
            document.getElementById('navLinks').classList.toggle('active');
        });
    </script>
</body>
</html>