<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Articulos Prueba</title>
        
        <!-- Tailwind CSS Link -->
        <link rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.1/tailwind.min.css">

        <!-- Fontawesome Link -->
        <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet">
    
    </head>
    <body>
        <div id="app">
            @yield("content")
        </div>
        <script src="{{ asset('js/app.js') }}" ></script>
    
    </body>
</html>