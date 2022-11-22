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
    <form action="/articulo/editarArticulo?id={{id}}" method="post" class="contents" style='background-color:{{color}}'>
        <div class="pepe">{{id}}</div>
        <div class="pepe">{{titulo}}</div>
        <div class="pepe">{{usuarioCreador}}</div>
        <div class="pepe">{{edicion}}</div>
        <div class="pepe">{{seccion}}</div>
        <div class="pepe">{{publicacion}}</div>
        <input class="w-full" type="submit" value='Editar artículo'>
        </form>
    {{/articulos}} 

    </div>
</section>
