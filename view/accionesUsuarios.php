{{> header}}
<section>
    <div class="white-title">
        {{notificacion}}
    </div>

    <div class="grid-usuarios">
        <div class="white-title">ID</div>
        <div class="white-title">Rol</div>
        <div class="white-title">Nombre</div>
        <div class="white-title">Email</div>
        <div class="white-title"></div>
        <!-- <ol>id rol  nombre email</ol> -->
        {{#usuarios}} 
            <form action="/user/procesarAccionUsuario" method="post" class="contents">
                <input class="read-only" name="id" readonly="readonly" value='{{id}}'>
                <input class="read-only" name="rol" readonly="readonly" value='{{rol}}'>
                <input name="nombre" type="text" value='{{nombre}}'>
                <input type="text" name="email" readonly="readonly" class="read-only" value='{{email}}'>

                
                <div class="w-full">
                    <input class="w-full" type="submit" name="accion" value='Editar'>
                    <input class="w-full" type="submit" name="accion" value='Dar de baja'>
                </div>
            </form>
        {{/usuarios}} 
    </div>
</section>