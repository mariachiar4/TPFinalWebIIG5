{{> header}}
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<link rel="stylesheet" type="text/css" href="/public/styles/articulo.css">

<section class="seccion-articulo">
    <div>
        <p class="error">{{notificacion}}</p>
    </div>
    <h2 class="text-center">
        {{#id_articulo}}Editar{{/id_articulo}}
        <!-- el primero pregunta si existe + itera, imprime EDITAR -->
        {{^id_articulo}}Crear{{/id_articulo}} 
        <!-- el segundo pregunta si NO existe , imprime CREAR-->
        Artículo
    </h2>
    <form id="form" class="form-container" action="/articulo/procesarArticulo" method="POST" enctype="multipart/form-data">
        <div class="form-element">
            <label class="form-label" for="id_publicacion">Publicación</label>
            
            <select name="id_publicacion" id="id_publicacion">
                <option value="" disabled selected>Seleccione una publicación</option>
                {{#publicaciones}}
                    <option value="{{id}}" {{#selected}}selected{{/selected}}>{{nombre}}</option>
                {{/publicaciones}}
            </select>
        </div>
        <div class="form-element oculto" id="id_seccion_container">
            <!-- Div que tiene que crearse por js al seleccionar la publicacion que queres. -->
            <label class="form-label" for="id_seccion">Sección</label>
            <select name="id_seccion" id="id_seccion">
            </select>
        </div>
        <div class="form-element">
            <label class="form-label" for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" value="{{titulo}}">
        </div>

        <div class="form-element">
            <label class="form-label" for="bajada">Bajada</label>
            <input type="text" id="bajada" name="bajada" value="{{bajada}}">
        </div>

        <div class="form-element">
            <label class="form-label" for="imagen">Imágen</label>
            <div class="form-input-file">
                {{#img}}
                    <img id="img" alt="img" width="100" height="100"
                        src="/public/img/articulos/{{img}}" />
                {{/img}}
                {{^img}}
                    <img id="img" alt="img" width="100" height="100"
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOQAAADdCAMAAACc/C7aAAAAaVBMVEXDw8MAAADGxsaXl5fJycnMzMxSUlKRkZF1dXV5eXnCwsIFBQWlpaV+fn66urqurq5dXV1sbGxMTEyKiopXV1czMzOcnJwaGhqoqKiEhIQlJSUrKysODg5mZmZHR0ezs7M7OzsVFRU5OTmFwHepAAAC+klEQVR4nO3bi1KjMBSAYXIarIbea2uttVXf/yE36Q0qobrITHP0/2Z2Zt2xDP+GQEDMMgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAANQ56dCtY+JcZge9zgzsrXvipGc61EtzLO29KbpKLMx9mkPpI83H410XFiblyGFufy7Ph0lHPnSya/aByFuqRv7sSqchUvwV83k4EHFtt6QhcrwOl4GXZdv9VBApq3CdK/w1c9nykNUQ+XK6pG/abin5SFmWy5Z+u6FMP7K6unttt6cKIqflSE4a9tQd/zRtKflI6ZeRw6Y9deFS2ryl5COzUXkzMWoIcZm45bixUkGkfd6PormyyBMZPxkzaVouKIjM7PAwjtPm/XRP4Rse8/hgaoh0djzdbl9XeePJxc7CUBdmHi/REOkPx3Bb2DTlnOwP6L34vNQReZ3szqffRXRa/oJIcetzpJnksS2pj3T5pPrIqmfr6wL9kbZvynWf/8uuPi21Rzrxa4WijCzMW/0j6iKdV/lSZPH5Ges0V3+4flqi+uV77Ql07QmCtkg7GlcumM4uI0/ZC+UjGe67FpVl+qhWGGw/f0pRpIS99aeWjTtV2rdopBleTktNkZkMwvmzMHf20BCaY42FWV3MXFWR2eZY8ezvpY/N8aF8UhuZz84jtV+Iu/d4YfiGu+oHFUX6e43i1LDODs1FfCT9P8+lXN7piZRxNWOS23nTOB7syvsRPZHZ+qKhv2uckMfBLqelmsjLew1/anlpOlbLwT5vSUeks/2rQVG9U5eSyLC0+f+3JE53XToiRT6+OjhjPjRFunz6dVHM9DAtVURG7zW+ZbAfSw2R0mpCHvi1vFMRabctC/1/zdaKisjTTwnaRIYfhCmIdHbQunF/Rl5J8pEizfca37Pxkzr5yNnXHdfNJPGRHNrRvP9D81HqkbnNO5D2W5K//X1XFyK7kuyby3/iHXTp8rcJVmk2/onfCwEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAALi1f4DsKck70eEzAAAAAElFTkSuQmCC" />
                {{/img}}
                <div>
                    <input type="file" name="imagen" accept="image/png, image/jpeg, image/webp" value="{{img}}"
                        onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])">
                </div>
            </div>
        </div>



        <div class="form-element">
            <label class="form-label" for="contenido">Contenido</label>
            <textarea id="contenido" name="contenido" cols="30" rows="10">{{contenido}}</textarea>
        </div>

        <div>
            {{#id_articulo}}
                <input type="hidden" name="accion" value="editar">
                <input type="hidden" name="id" value="{{id_articulo}}">

                <input class="margin-top" type="submit" value="Editar Artículo">
            {{/id_articulo}}

            {{^id_articulo}}
                <input type="hidden" name="accion" value="crear">
                <input class="margin-top" type="submit" value="Editar Artículo">
            {{/id_articulo}}
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

    window.addEventListener("load", function(evento){
        
        id_publicacion = {{#id_publicacion}} // si es editar
                            {{id_publicacion}}
                         {{/id_publicacion}}
                         {{^id_publicacion}} // si es crear
                            0
                         {{/id_publicacion}};
        if(id_publicacion != 0){
            obtenerSelectSecciones(id_publicacion);
        }
    })

    //llamada a fetch para obtener las secciones de la ultima edicion de la publicacion que se eligio en el primer select
    //tambien se va a tener que crear otro dato que sea el id_edicion_seccion
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
            body: formData
        })
        .then((response) => response.json())
        .then((secciones) => {
            let seccion_container = document.getElementById("id_seccion_container");
            if(secciones.length > 0){
                let select_secciones = document.getElementById("id_seccion");
                select_secciones.innerHTML = '<option value="" disabled>Seleccione una sección</option>';

                seccion_container.classList.remove("oculto"); 
                let option = "";
                secciones.forEach(seccion =>{
                    option = document.createElement("option");
                    option.value = seccion.id;
                    option.innerText = seccion.nombre;
                    select_secciones.appendChild(option);
                    {{#articulo}}
                        if({{id_seccion}} == seccion.id){
                            // option.selected = true; equivale a la linea de abajo
                            option.setAttribute("selected", true);
                        } 
                    {{/articulo}}
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
        toolbar: 'undo redo | alignleft aligncenter alignright alignjustify'
    });
</script>