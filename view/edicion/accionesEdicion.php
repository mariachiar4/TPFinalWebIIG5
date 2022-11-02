{{> header}}
<section>
    <div class="white-title">
        {{notificacion}}
    </div>

    <div class="grid-edicion">
        <div class="white-title">ID</div>
        <div class="white-title">Publicacion</div>
        <div class="white-title">Nombre</div>
        <div class="white-title">Fecha Creado</div>
        <div class="white-title">Precio Edicion</div>
        <div class="white-title"></div>
        <!-- <ol>id_edicion nombre_Publicacion nombre_edicion fecha_creacion precio_edicion</ol> -->
    {{#ediciones}} 
        <form action="/edicion/procesarAccionEdicion" method="post" class="contents">
            <input class="read-only" name="id" readonly="readonly" value='{{id}}'>
            <input class="read-only" readonly="readonly" name="nombre_publicacion" type="text" value='{{nombre_publicacion}}'>
            <input name="nombre_edicion" type="text" value='{{nombre_edicion}}'>
            <input class="read-only" readonly="readonly" value='{{fecha_creacion}}'>
            <input name="precio" type="number" value='{{precio}}'>

            
            <div class="w-full">
                <input class="w-full" type="submit" name="accion" value='Editar'>
                <input class="w-full" type="submit" name="accion" value='Eliminar'>
            </div>

        </form>
    {{/ediciones}} 
    </div>
</section>