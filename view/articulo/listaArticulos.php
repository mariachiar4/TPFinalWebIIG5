{{> header}}
<link rel="stylesheet" type="text/css" href="/public/styles/articulo.css">
<link rel="stylesheet" type="text/css" href="/public/styles/publicacion.css">

    <section>
    <div class="white-title">
        {{notificacion}}
    </div>
    <!--ID TITULO NOMBRECREADOR EDICION SECCION PUBLICACION-->
    <div class="grid-articulo">
        <div class="white-title">ID</div>
        <div class="white-title">Título</div>
        <div class="white-title">Creador</div>
        <div class="white-title">Edición</div>
        <div class="white-title">Sección</div>
        <div class="white-title">Publicación</div>
        <div class="white-title"></div>

    {{#articulos}} 
        <div>{{id}}</div>
        <div>{{titulo}}</div>
        <div>{{usuarioCreador}}</div>
        <div>{{edicion}}</div>
        <div>{{seccion}}</div>
        <div>{{publicacion}}</div>
        <a href="/articulo/editarArticulo?id={{id}}">Editar artículo</a>
    {{/articulos}} 

    </div>
</section>
