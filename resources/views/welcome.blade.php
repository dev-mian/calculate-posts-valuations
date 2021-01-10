<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Calcular valoraciones de usuarios y sus posts</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Calcular Valoraciones de usuarios y sus posts</h1>
                <p>
                    Aplicación en Laravel que nos permite calcular una valoración para cada post obtenido desde la API, así como para cada usuario 
                    perteneciente a cada post. La API nos devolverá un máximo de 100 posts distribuidos para 10 usuarios. 
                </p>
                <p>
                    Para calcular dicho valor tenemos que contar el número de veces que una palabra aparece en el título o en la descripción de todo 
                    el conjunto de los posts. Solo en el caso de que la palabra que buscamos existe en el título, entonces, esta palabra es más importante 
                    y contará doble, no será así si la palabra se encuentra en la descripción. Por tanto, para calcular la valoración de un post contaremos 
                    todas las ocurrencias de cada palabra en todos los posts y para calcular la valoración del usuario sumaremos las valoraciones de todos 
                    sus posts. 
                </p>
    
                <button id="download-csv-file" class="btn btn-primary my-4">Descargar valoraciones</button>
            </div>
        </div>
        <div id="overlay">
            <div class="container">
                <div class="row h-100">
                    <div class="col-sm-12 my-auto">
                        <h3 class="text-white text-lg-center">Generando el fichero para su descarga...</h3>
                        <div class="spinner-border text-primary d-block m-auto" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
