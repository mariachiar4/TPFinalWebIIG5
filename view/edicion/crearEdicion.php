{{> header}}
<section>
    <h2>Crear Edición</h2>
    <form action="/edicion/procesarEdicion" method="post" enctype="application/x-www-form-urlencoded">
        <div>
            <label for="id_publicacion">Publicación</label>
            <select name="id_publicacion" id="id_publicacion">
                {{#publicaciones}} 
                    <option value={{id}}>{{nombre}}</option>
                {{/publicaciones}} 
            </select>
        </div>
        <div>
            <label for="id_secciones">Secciones</label>
            <div>
                {{#secciones}} 
                    <input type="checkbox" name="id_secciones[]" id="id_secciones" value={{id}}>{{nombre}}</input>
                {{/secciones}} 
            </div>
        </div>
        
        <div>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre">
        </div>
        <!-- precio -->
        <div>
            <label for="precio">Precio</label>
            <input type="number" name="precio" id="precio">
        </div>
        <input type="submit" value="Crear Edición">

    </form>
</section>