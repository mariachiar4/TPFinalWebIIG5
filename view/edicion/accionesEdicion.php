{{> header}}
<section>

    <ul>
        <ol>id_edicion nombre_Publicacion nombre_edicion fecha_creacion precio_edicion</ol>
    {{#ediciones}} 
        <form action="/edicion/procesarAccionEdicion" method="post">
            <input name="id" readonly="readonly" value='{{id}}'>
            <input readonly="readonly" name="nombre_publicacion" type="text" value='{{nombre_publicacion}}'>
            <input name="nombre_edicion" type="text" value='{{nombre_edicion}}'>
            <input readonly="readonly" value='{{fecha_creacion}}'>
            <input name="precio" type="number" value='{{precio}}'>


            <input type="submit" name="accion" value='Editar'>
            <input type="submit" name="accion" value='Eliminar'>

        </form>
    {{/ediciones}} 
    </ul>
</section>