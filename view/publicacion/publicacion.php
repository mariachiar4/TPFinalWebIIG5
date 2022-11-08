{{> header}}
<link rel="stylesheet" href="/public/styles/publicacion.css">
<!-- Nav secciones -->
<section>
    <nav>
        <ul class="secciones-container">
            <a class="secciones-item" href="/publicacion/getPublicacion/id={{id}}"><li>Todos</li></a>
        {{#secciones}} 
            <a class="secciones-item" href="/publicacion/getPublicacion/id={{id}}"><li>{{nombre}}</li></a>
        {{/secciones}} 
        </ul>
    </nav>
</section>

<section class="publicaciones-principales-container">
    {{#articulos}}
        <a href="" class="publicaciones-principales-itemLink">
            <h3>{{titulo}}</h3>
            <h4>{{bajada}}</h4>
            <img src="https://www.infobae.com/new-resizer/IaJkgUr27syQN0xrQ9ZiyHAOaMY=/992x606/filters:format(webp):quality(85)/cloudfront-us-east-1.images.arcpublishing.com/infobae/H5RBZFFBY3XG3KZPP363OS2P2A.jpg" alt="Soja">
        </a>
    {{/articulos}}
   
    
</section>