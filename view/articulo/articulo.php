{{> header}}
<link rel="stylesheet" type="text/css" href="/public/styles/articulo.css">
<!-- leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
     integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
     crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
crossorigin=""></script>

<div class="page-container">
    <div style="display: flex; justify-content: end;margin-bottom:1rem;font-size:1.2rem;">
        <a style="color:black;border-radius:32px; background-color: white; padding-block: 0.3rem; padding-inline: 0.5rem;" 
        href="/articulo/pdfArticulo?id={{#articulo}}{{id_articulo}}{{/articulo}}" target="__blank" rel="noopener noreferrer">Exportar</a>
    </div>
    <div class="articulo-container">
        {{#articulo}}
        <div class="header-articulo">
            <div >
                <h4 class="blue-text">{{seccion}}</h4>
                <h2 class="titulo-articulo">{{titulo}}</h2>
                <h3 class="bajada-articulo">{{bajada}}</h3>
            </div>

            <!-- leaflet -->
            <div class="container-mapa">
                <div style="height: 250px; max-width: 500px; margin: auto;" id="map"></div>
            </div>
            <!-- leaflet -->
        </div>



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

<!-- leaflet -->
<script>
        {{#articulo}}
            var articuloLat = {{lat}};
            var articuloLon = {{lon}};
        {{/articulo}}

    var map = L.map("map").setView([articuloLat, articuloLon], 5); // coordenadas del usuario

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution:
        '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);

    var marker = L.marker([articuloLat, articuloLon]).addTo(map);
</script>
<!-- leaflet -->