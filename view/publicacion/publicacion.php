{{> header}}
<link rel="stylesheet" href="/public/styles/publicacion.css">
<!-- Nav secciones -->

<section class="publicaciones-principales-container">
    {{#articulos}}
        <a href="/articulo/getArticulo/id={{id}}" class="publicaciones-principales-itemLink">
            <h3>{{titulo}}</h3>
            <h4>{{bajada}}</h4>
            <img src="/public/img/articulos/{{fotos}}" alt="{{titulo}}">
        </a>
    {{/articulos}}    
</section>