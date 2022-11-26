{{> header}}
<section class="container-flex">
    {{#usuario}}
        {{#administrador}}
            <div class="">
                <h3 class="titulo-admin-container">Publicación</h3>
                <a class="link-admin" href="/publicacion/accionesPublicacion">Modificar Publicación</a>
            </div>
            
            <div class="margin-top">
                <h3 class="titulo-admin-container">Edición</h3>
                <a class="link-admin" href="/edicion/crearEdicion">Crear Ediciones</a>
                <a class="link-admin" href="/edicion/accionesEdicion">Acciones de Ediciones</a>
            </div>

            <div class="margin-top">
                <h3 class="titulo-admin-container">Informes</h3>
                <a class="link-admin" href="/user/pdfContenidistas">Contenidistas</a>
                <a class="link-admin" href="/user/pdfLectores">Lectores</a>
            </div>

            <div class="margin-top">
                <h3 class="titulo-admin-container">Usuario</h3>
                <a class="link-admin" href="/user/registrarContenidista">Registrar contenidista</a>
                <a class="link-admin" href="/user/accionesUsuarios">Acciones de Usuarios</a>
                <a class="link-admin" href="/user/reportes">Reportes</a>

            </div>
        {{/administrador}}
        <div class="margin-top">
            <h3 class="titulo-admin-container">Artículo</h3>
            {{^administrador}}
                <a class="link-admin" href="/articulo/accionesArticulo">Crear Artículo</a>
            {{/administrador}}
            <a class="link-admin" href="/articulo/listar_articulos">Acciones Artículos</a>
        </div>
    {{/usuario}}
</section>