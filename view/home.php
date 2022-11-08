{{> header}}

<div class="main-container">
    <div class="titulo-container">
        <span class="titulo-deco">[</span><h1 class="titulo">Infonete</h1><span class="titulo-deco">]</span>
    </div>

    
    <div class="cartas-container">
        {{#publicaciones}} 
            {{#estado}} 
            <div class="carta"  style='background-color:{{color}}'> 
                <a class="carta-link" href="/publicacion/getPublicacion/id={{id}}">
                    <h3 class="carta-titulo">{{nombre}}</h3>
                    <p class="carta-descripcion">{{descripcion}}</p>
                    <div class="carta-sociales-container">
                        <a target="_blank" href='{{facebook_url}}' class="carta-social-link"><img src="/public/img/facebook.png"/></a>
                        <a target="_blank" href='{{instagram_url}}' class="carta-social-link"><img src="/public/img/instagram.png"/></a>
                        <a target="_blank" href='{{twitter_url}}' class="carta-social-link"><img src="/public/img/twitter.png"/></a>
                        <a target="_blank" href='{{link_url}}' class="carta-social-link"><img src="/public/img/link.png"/></a>
                    </div>
                </a>
            </div> 
            {{/estado}} 
        {{/publicaciones}}
    </div>
</div>