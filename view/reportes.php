{{> header}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<section>
  <h2 class="white-title">Suscripciones por Periodo</h2>
  <div>
    <div>
      <label for="fecha_inicio">Fecha Inicio</label>
      <input type="date" name="fecha_inicio" id="fecha_inicio">
    </div>

    <div>
      <label for="fecha_fin">Fecha Fin</label>
      <input type="date" name="fecha_fin" id="fecha_fin">
    </div>
    <button onclick="obtenerReporte()">Obtener Reportes</button>
    <div id="error" class="error"></div>
  </div>
</section>

<div class="contendor-reporte oculto" id="contenedor-chart">
  <canvas id="myChart"></canvas>
</div>

<script>
  let chart;
  function obtenerReporte (){
    const fecha_inicio = document.getElementById("fecha_inicio").value; 
    const fecha_fin = document.getElementById("fecha_fin").value;


    const validacionOk = validarFechas(fecha_inicio,fecha_fin);
    const errorElem = document.getElementById("error");
    const contenedorChartElem = document.getElementById("contenedor-chart");

    if (validacionOk) {
      errorElem.innerHTML = "";
      contenedorChartElem.classList.remove("oculto");
      const formData = new FormData();
  
      let url = `/user/getReportes?fecha_inicio=${fecha_inicio}&fecha_fin=${fecha_fin}`;
  
      fetch(url, {
          method: 'GET',
          mode: 'no-cors',
          headers: {
              "Content-Type": "application/json"
          },
      }).then((response) => response.json()).then((result) => {
        crearChart(result);
      })
    } else {
      contenedorChartElem.classList.add("oculto");
      errorElem.innerHTML = "Rango de fechas incorrecto";
    }
  }

  function crearChart(result) {
    const ctx = document.getElementById('myChart');
      
      if(chart){
        chart.destroy();
      }
      chart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: result.labels,
          datasets: [{
            label: 'Suscripciones por dia',
            data: result.data,
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
  }

  function validarFechas(fecha_inicio,fecha_fin){
    if (!fecha_inicio || !fecha_fin ||fecha_inicio > fecha_fin || fecha_fin < fecha_inicio){
      return false;
    } else 
      return true;
  }

 
</script>