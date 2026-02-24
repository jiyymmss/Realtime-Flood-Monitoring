// Parse the JSON data
var data = JSON.parse('<?php echo $json_data; ?>');

// Create the chart
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
  type: 'area',
  data: {
    labels: data.map(function(item) {
      return item.water_level;
    }),
    datasets: [{
      label: 'My Dataset',
      data: data.map(function(item) {
        return item.water_level;
      })
    }]
  }
});
