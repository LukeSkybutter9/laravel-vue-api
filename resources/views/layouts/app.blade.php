<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Articulos Prueba</title>
        
        <!-- Tailwind CSS Link -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.1/tailwind.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/mailtoharshit/San-Francisco-Font-/sanfrancisco.css">
        <link href="{{ asset('css/init.css') }}" rel="stylesheet">

        <!-- Fontawesome Link -->
        <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet">
    
    </head>
    <body>
        <div class="supercontainer min-h-screen flex flex-col justify-center pt-12 pr-8 overflow-y-scroll">
            <div class="container mx-auto text-center md:text-left lg:text-left ">
                <h1 class="mb-10 pl-8 font-sans text-4xl sm:text-5xl md:text-6xl lg:text-7xl ">Listado de Artículos</h1>
            </div>
            <div id="app" class="containerInfo flex flex-col md:flex-row gap-10 ">
                <div class="formulario ">
                    @yield("formulario")
                </div>
                <div class="tarjetas ">
                    @yield("content")
                </div>
            </div>
        </div>
        <script src="{{ asset('js/app.js') }}" ></script>
    </body>
</html>