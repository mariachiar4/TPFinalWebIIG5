{{> header}}


<button onclick="getLocation()">Try It</button>

<p id="demo"></p>

<div id="iframe-container"></div>

<script>
var x = document.getElementById("demo");

function getLocation() {
  if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
    iframe = document.createElement("embed");
    iframe.src = `https://maps.google.com/maps?q=${position.coords.latitude},${position.coords.longitude}&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;&output=embed`;
    iframe.width = 500;
    iframe.height = 200;


    let iframeContainer = document.getElementById("iframe-container");
    
    iframeContainer.appendChild(iframe);
}
</script>

