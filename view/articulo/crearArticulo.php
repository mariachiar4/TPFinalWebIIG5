{{> header}}
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


<section class="seccion-articulo">
    <h2 class="text-center">Crear Artículo</h2>
    <form class="form-container" action="" method="POST" enctype="multipart/form-data">
        <div class="form-element">
            <label class="form-label" for="id_publicacion">Publicación</label>
            <select name="id_publicacion" id="id_publicacion">
                {{#publicaciones}}
                    <option value="{{id}}">{{nombre}}</option>
                {{/publicaciones}}
            </select>
        </div>
        <div class="form-element">
            <!-- Div que tiene que crearse por js al seleccionar la publicacion que queres. -->
            <label class="form-label" for="id_publicacion">Seccion</label>
            <select name="id_publicacion" id="id_publicacion">
            <option value="">Edicion</option>
            </select>
        </div>

        <div class="form-element">
            <label class="form-label" for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo">
        </div>

        <div class="form-element">
            <label class="form-label" for="bajada">Bajada</label>
            <input type="text" id="bajada" name="bajada">
        </div>

        <div class="form-element">
            <label class="form-label" for="foto">Imágen</label>
            <input type="file" id="foto" name="foto">
        </div>

        <div class="form-element">
            <label class="form-label" for="contenido">Contenido</label>
            <textarea id="contenido" name="contenido" cols="30" rows="10"></textarea>
        </div>

        <div>
            <input type="hidden" name="id_edicion_seccion" value="">
            <input class="margin-top" type="submit" value="Crear Artículo">
        </div>
    </form>
</section>


<script>
    let select_publicaciones = document.getElementById("id_publicacion");
    let id_publicacion = 0;
    select_publicaciones.addEventListener("change", function(evento){
        id_publicacion = evento.target.value;
        obtenerSelectSecciones(id_publicacion);
    })

    //llamada a fetch para obtener las secciones de la ultima edicion de la publicacion que se eligio en el primer select
    //tambien se va a tener que crear otro dato que sea el id_edicion_seccion -> para que se llene el input hidden 
    function obtenerSelectSecciones(id_publicacion){
        const formData = new FormData();

        let url = "/articulo/procesarSeccionesSegunPublicacion";

        formData.append("id_publicacion", id_publicacion);

        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then((response) => response.json())
        .then((result) => {
            console.log('Success:', result);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }

    //inicializamos tinymce para el contenido
    tinymce.init({
        selector: '#contenido',
        plugins: [
            'emoji'
        ],
        toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
      });




</script>