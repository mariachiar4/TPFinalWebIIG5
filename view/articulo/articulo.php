{{> header}}
<link rel="stylesheet" type="text/css" href="/public/styles/articulo.css">

<div class="page-container">
    <div class="articulo-container">
        {{#articulo}}
                <h4 class="blue-text">{{seccion}}</h4>
                <h2 class="titulo-articulo"><img title="lat: {{lat}} lon: {{lon}}" class="location-pin" src="/public/img/locationpin.png">{{titulo}}</h2>
                <h3 class="bajada-articulo">{{bajada}}</h3>
                <p class="creadopor-articulo"><i>Creado por : {{usuarioCreador}}</i></p>
                <div class="contenedor-imagen-articulo">
                    <img class="imagen-articulo" src="/public/img/articulos/{{fotos}}" alt="{{titulo}}">
                </div>
                {{{contenido}}}
        {{/articulo}}
        {{^articulo}}
            <div class="error-articulo">
                Articulo inexistente
            </div>
        {{/articulo}}
    </div>
</div>