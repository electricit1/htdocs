<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="container">
    <div id="chart_div" style="width: 900px; height: 500px;margin: auto;background-color:#0f0f0f;"></div>	
</div>

<script>
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data wyniku', 'Twoje Wyniki'],
          <?php foreach ($data['wyniki'] as $key => $value) {?>
          
          [<?php echo json_encode($value->data_wyniku); ?>,  <?php echo str_replace(array("\""), array(""), json_encode($value->wynik)); ?>], 	

          <?php  }?>
        ]);

        var options = {
          title: <?php echo json_encode('Punkty') ;?>,
          hAxis: {title: 'Wyniki',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }

</script>