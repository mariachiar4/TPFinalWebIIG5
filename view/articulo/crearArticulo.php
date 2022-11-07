{{> header}}
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


<section class="seccion-articulo">
    <h2 class="text-center">Crear Artículo</h2>
    <form class="form-container" action="/articulo/procesarArticulo" method="POST" enctype="multipart/form-data">
        <div class="form-element">
            <label class="form-label" for="id_publicacion">Publicación</label>
            <select name="id_publicacion" id="id_publicacion">
                <option value="" disabled selected>Seleccione una publicación</option>
                {{#publicaciones}}
                    <option value="{{id}}">{{nombre}}</option>
                {{/publicaciones}}
            </select>
        </div>
        <div class="form-element oculto" id="id_seccion_container">
            <!-- Div que tiene que crearse por js al seleccionar la publicacion que queres. -->
            <label class="form-label" for="id_seccion">Sección</label>
            <select name="id_seccion" id="id_seccion">
                <option value="" selected disabled>Seleccione una sección</option>
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
            <label class="form-label" for="contenido">Contenido</label>
            <textarea id="contenido" name="contenido" cols="30" rows="10"></textarea>
        </div>

        <div>
            <input class="margin-top" type="submit" value="Crear Artículo">
        </div>
    </form>
</section>


<script>
    let select_publicaciones = document.getElementById("id_publicacion");
    let id_publicacion = 0;
    select_publicaciones.addEventListener("change", function(evento){
        id_publicacion = evento.target.value;
        console.log("id", id_publicacion)
        obtenerSelectSecciones(id_publicacion);
    })

    //llamada a fetch para obtener las secciones de la ultima edicion de la publicacion que se eligio en el primer select
    //tambien se va a tener que crear otro dato que sea el id_edicion_seccion -> para que se llene el input hidden 
    function obtenerSelectSecciones(id_publicacion){
        const formData = new FormData();

        let url = "/seccion/procesarSeccionesSegunPublicacion";

        formData.append("id_publicacion", id_publicacion);
        fetch(url, {
            method: 'POST',
            mode: 'no-cors',
            headers: {
                "Content-Type": "application/json"
            },
            //headers: {"Content-Type": "application/x-www-form-urlencoded"},
            body: formData
        })
        .then((response) => response.json())
        .then((secciones) => {
            let seccion_container = document.getElementById("id_seccion_container");
            if(secciones.length > 0){
                let select_secciones = document.getElementById("id_seccion");
                seccion_container.classList.remove("oculto");
                let option = "";
                secciones.forEach(seccion =>{
                    option = document.createElement("option");
                    option.value = seccion.id;
                    option.innerText = seccion.nombre;
                    select_secciones.appendChild(option);
                })
            }else{
                seccion_container.classList.add("oculto");
            }


            
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }

    //inicializamos tinymce para el contenido

    tinymce.init({
        selector: '#contenido',
        plugins: 'image',
        toolbar: 'undo redo | alignleft aligncenter alignright alignjustify | image',
        images_file_types: 'jpg,svg,webp,png',

        images_upload_url: '/articulo/procesarImagen'
		}
    });




</script>