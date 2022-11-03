{{> header}}
<section class="form-container">
    <h2 class="white-title">Crear Edición</h2>
    <form class="container-flex" action="/articulo/procesarArticulo" method="post" enctype="application/x-www-form-urlencoded">
        <div class="form-element">
            <label class="form-label" for="id_publicacion">Publicación</label>
            <select  name="id_publicacion" id="id_publicacion">
                {{#publicaciones}} 
                    <option value={{id}}>{{nombre}}</option>
                {{/publicaciones}} 
            </select>
        </div>
        <div class="form-element">
            <label class="form-label" for="id_secciones">Secciones</label>
            <div class="two-column-grid">
                {{#secciones}} 
                <div>
                    <input type="checkbox" name="id_secciones[]" id="id_secciones" value={{id}}>
                    <span class="form-label">{{nombre}}</span>
                </div>
                {{/secciones}} 
            </div>
        </div>
        
        <div class="form-element">
            <label class="form-label" for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre">
        </div>
        <!-- precio -->
        <div class="form-element">
            <label class="form-label" for="precio">Precio</label>
            <input type="number" name="precio" id="precio">
        </div>

        <input class="margin-top" type="submit" value="Crear Edición">

    </form>
</section>