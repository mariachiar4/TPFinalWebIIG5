{{> header}}
<link rel="stylesheet" href="/public/styles/publicacion.css">
<!-- Nav secciones -->
<section>
    <nav>
        <ul class="secciones-container">
            <a class="secciones-item" href="/publicacion/getPublicacion/id={{id}}"><li>Todos</li></a>
        {{#secciones}} 
            <a class="secciones-item" href="/publicacion/getPublicacion/id={{id}}"><li>{{nombre}}</li></a>
        {{/secciones}} 
        </ul>
    </nav>
</section>

<section class="publicaciones-principales-container">
    {{#articulos}}
        <a href="/articulo/getArticulo/id={{id}}" class="publicaciones-principales-itemLink">
            <h3>{{titulo}}</h3>
            <h4>{{bajada}}</h4>
            <img src="/public/img/articulos/{{fotos}}" alt="{{titulo}}">
        </a>
    {{/articulos}}    
</section>