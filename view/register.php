{{> header}}

<script>

function getLocation() {
  if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(getPosition);
    } 
}

function getPosition(position) {
    let latInput = document.getElementById("lat")
    let lonInput = document.getElementById("lon")
    latInput.value = position.coords.latitude
    lonInput.value = position.coords.longitude
 
}


  window.addEventListener("load", function(evento){
      getLocation();
    })
</script>

<div class="login">
  <div class="login-triangle"></div>
  
  <h2 class="login-header">Registro</h2>

  <form class="login-container" action="/user/procesarRegistro" method="POST" enctype="application/x-www-form-urlencoded">
    <p><input name="nombre" type="text" placeholder="Nombre"></p>
    <p><input name="email" type="email" placeholder="Email"></p>
    <p><input name="password" type="password" placeholder="Password"></p>
    <input id="lat" name="lat" type="hidden" >
    <input id="lon" name="lon" type="hidden" >
    <p><input type="submit" value="Registrarse"></p>
  </form>
</div>