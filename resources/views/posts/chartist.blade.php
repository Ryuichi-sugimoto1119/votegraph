<div class="ct-chart" id="chart{{$key}}"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
<script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
<script type="text/javascript">

  function createChart (key, tmp_label, tmp_data) {
    var row_labels = tmp_label.split(',');
    var row_series = tmp_data.split(',').map(Number);
    var name = '#chart' + key
    
    var data = {
      labels: row_labels,
      series: row_series
    };
    
    var sum = function(a, b) { return a + b };
  
    var index = function(val, labels) { return labels.indexOf(val) };
  
    new Chartist.Pie(name, data, {
      labelInterpolationFnc: function(value) {
        if (Math.round(data.series[index(value, data.labels)] > 0)) {
          return value + '(' + Math.round(data.series[index(value, data.labels)] / data.series.reduce(sum) * 100) + '%)';
        } else {
          return ''        
        }
      }
    });
  }
  
  createChart({{$key}},'{{$label}}', '{{$data}}');


</script>

<style>
  .ct-chart{
    width: 300px;
    height: 300px;
    font-color: white;
  }
  
  .ct-label{
    fill: white;
    font-size: 15px;
  }
  
  
</style>