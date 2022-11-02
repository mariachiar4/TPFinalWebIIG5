{{> header}}
<section>
    <div class="white-title">
        {{notificacion}}
    </div>

    <div class="grid-publicacion">
        <div class="white-title">ID</div>
        <div class="white-title">Publicacion</div>
        <div class="white-title">Precio</div>
        <div class="white-title">Estado</div>
        <div class="white-title"></div>
    {{#publicaciones}} 
        <form action="/publicacion/procesarAccionPublicacion" method="post" class="contents" style='background-color:{{color}}'>
            <input class="read-only" name="id" readonly="readonly" value='{{id}}'>
            <input class="read-only" readonly="readonly" name="nombre_publicacion" type="text" value='{{nombre}}'>
            <input class="read-only" readonly="readonly" name="precio" type="text" value='{{precio_suscripcion}}'>
            <input class="read-only" readonly="readonly" name="precio" type="text" value='{{#estado}}Visible{{/estado}} {{^estado}}Oculto{{/estado}}'>

      
            <input class="w-full" type="submit" name="accion" value='Cambiar de Estado'>
        

        </form>
    {{/publicaciones}} 
    </div>
</section>