{{> header}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<section>
  <h2 class="white-title">Suscripciones por Periodo</h2>
  <form action="/user/getReportes" method="get">
    <div>
      <label for="fecha_inicio">Fecha Inicio</label>
      <input type="date" name="fecha_inicio" id="fecha_inicio">
    </div>

    <div>
      <label for="fecha_fin">Fecha Fin</label>
      <input type="date" name="fecha_fin" id="fecha_fin">
    </div>
    <button type="submit">Obtener Reportes</button>
  </form>
</section>

<!-- <div class="contendor-reporte">
  <canvas id="myChart"></canvas>
</div> -->




<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['01/01/2022', '01/02/2022', '01/03/2022', '01/04/2022', '01/05/2022'],
      datasets: [{
        label: '# of Votes',
        data: [0, 1, 0, 2, 0],
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
</script>