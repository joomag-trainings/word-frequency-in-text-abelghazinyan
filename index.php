<?php
    /**
     * Created by PhpStorm.
     * User: abelghazinyan
     * Date: 7/9/17
     * Time: 9:38 PM
     */
    $file = file_get_contents("text");
    $words = preg_split('/\s+/',$file);
    foreach ($words as &$word){
        $word = strtolower($word);
        $word = str_replace(".","",$word);
        $word = str_replace(",","",$word);
    }
    foreach ($words as $word){
        if(!in_array($word,$words)) {
            $frequency[$word] = 1;
        }else{
            $frequency[$word]++;
        }
    }
php?>
<html>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

  google.charts.load('current', {'packages':['corechart']});

  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'word');
    data.addColumn('number', 'Quantity');
    <?php
      echo "data.addRows([";
      foreach ($frequency as $key => $value){
        echo "['{$key}',{$value}],";
      }
      echo "]);";
    php?>
    var options = {'title':'Word Frequencies in the Lorem Ipsum',
                   'width':"100%",
                   'height':"100%"};

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
</script>
<body>
    <div id="chart_div"></div>
</body>
</html>




