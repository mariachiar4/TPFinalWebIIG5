{{> header}}
<div class="login">
  <div class="login-triangle"></div>
  
  <h2 class="login-header">Registro</h2>

  <form class="login-container" action="/user/registrarse" method="POST" enctype="application/x-www-form-urlencoded">
    <p><input name="nombre" type="text" placeholder="Nombre"></p>
    <p><input name="email" type="email" placeholder="Email"></p>
    <p><input name="password" type="password" placeholder="Password"></p>
    <p><input type="submit" value="Registrarse"></p>
  </form>
</div>