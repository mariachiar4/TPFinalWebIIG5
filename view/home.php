{{> header}}

<div class="main-container">
    <div class="titulo-container">
        <span class="titulo-deco">[</span><h1 class="titulo">Infonete</h1><span class="titulo-deco">]</span>
        {{#pronostico}} 
        <div class="clima-container">
            <div>Temperatura {{temperature}}°C</div>
            <div class="clima-viento-container"><span>Velocidad de Viento : {{windspeed}} Km/H</span>
            <span style="font-size:20px;width:10px;display:flex;transform:rotate({{winddirection}}deg)">↑</span></div>
        </div>
        {{/pronostico}} 
    </div>

    
    <div class="cartas-container">
        {{#publicaciones}} 
            {{#estado}} 
            <div class="carta"  style='background-color:{{color}}'> 
            
                {{#estaSuscripto}} 
                    <a class="carta-link" href="/publicacion/getPublicacion/id={{id}}">
                        <h3 class="carta-titulo">{{nombre}}</h3>
                        <p class="carta-descripcion">{{descripcion}}</p>
                        <div class="carta-sociales-container">
                            <a target="_blank" href='{{facebook_url}}' class="carta-social-link"><img src="/public/img/facebook.png"/></a>
                            <a target="_blank" href='{{instagram_url}}' class="carta-social-link"><img src="/public/img/instagram.png"/></a>
                            <a target="_blank" href='{{twitter_url}}' class="carta-social-link"><img src="/public/img/twitter.png"/></a>
                            <a target="_blank" href='{{link_url}}' class="carta-social-link"><img src="/public/img/link.png"/></a>
                        </div>
                        <div>
                            <div >Suscrito hasta : {{fecha_fin}}</div>
                        </div>
                    </a>
                {{/estaSuscripto}}

                {{^estaSuscripto}}
                <form class="carta-link" action="/user/suscripcion" method="post" enctype="application/x-www-form-urlencoded">
                        <h3 class="carta-titulo">{{nombre}}</h3>
                        <p class="carta-descripcion">{{descripcion}}</p>
                        <div class="carta-sociales-container">
                            <a target="_blank" href='{{facebook_url}}' class="carta-social-link"><img src="/public/img/facebook.png"/></a>
                            <a target="_blank" href='{{instagram_url}}' class="carta-social-link"><img src="/public/img/instagram.png"/></a>
                            <a target="_blank" href='{{twitter_url}}' class="carta-social-link"><img src="/public/img/twitter.png"/></a>
                            <a target="_blank" href='{{link_url}}' class="carta-social-link"><img src="/public/img/link.png"/></a>
                        </div>
                        <input type="hidden" name="id_publicacion" value="{{id}}">
                        <div class="carta-subscripcion">
                            <button type="submit" class="carta-subscripcion border-button">
                                <div>Subscribite ya!</div>
                                <div class="carta-suscripcion-precio">Por Solo {{precio_suscripcion}}$</div>
                            </button>
                        </div >
                </form>
                {{/estaSuscripto}}
            </div> 
            {{/estado}} 
        {{/publicaciones}}
    </div>
</div>