<!DOCTYPE html>
<html lang="pt_BR">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Portal Notícias')</title>
    @vite('resources/css/app.css')
</head>
 
<body class="bg-slate-50 text-slate-800 min-h-screen flex flex-col">
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between py-3 items-center">
            <div>
                <img src="img/logoportal.svg" alt="Portal Notícias">
            </div>
            <nav>
                <ul class="flex gap-5 text-slate-900 items-center">
                    <li><a href="/">Home</a></li>
                    <li><a href="/contato">Contato</a></li>
                    <li><a href="#" class="inline-block bg-blue-500 text-white px-5 rounded-md py-1">Login</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="flex-1 max-w-7xl mx-auto my-10">

        @yield("conteudo")
 
    </main>
 
    <footer class="bg-slate-900 text-slate-400">
        <div class="max-w-7xl mx-auto py-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div>
                    <h2 class="font-semibold text-white mb-2">PortalBR</h2>
 
                    <p>Plataforma criada em aula para aprender laravel</p>
                </div>
                <div>
                    <h2 class="font-semibold text-white mb-2">Navegar</h2>
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/contato">Contato</a></li>
                        <li><a href="#">Login</a></li>
                    </ul>
                </div>
                <div>
                    <h2 class="font-semibold text-white mb-2">Tags</h2>
                    <div class="flex gap-4">
                        <span class="bg-slate-800 text-slate-300 px-3 py-0.5 text-sm ">PHP 8</span>
                        <span class="bg-slate-800 text-slate-300 px-3 py-0.5 text-sm ">SQL</span>
                        <span class="bg-slate-800 text-slate-300 px-3 py-0.5 text-sm ">Laravel</span>
                        <span class="bg-slate-800 text-slate-300 px-3 py-0.5 text-sm ">C#</span>
                    </div>
                </div>
            </div>
 
            <div class="border-t border-slate-500 text-center p-1 mt-5">
                &copy; Todos os direitos reservados.
            </div>
        </div>
    </footer>
</body>
 
</html>
 