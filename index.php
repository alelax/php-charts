<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
      <script src="js/Chart.js"></script>
      <title>Dashboard</title>
   </head>
   <body>

      <main>


         <div class="chart-container">
            <canvas id="annual-sales"></canvas>
         </div>

         <div class="chart-container">
            <canvas id="monthly-sales"></canvas>
         </div>

      </main>




      <script type="text/javascript">

         <?php include 'data.php' ?>

         $(document).ready(function(){

            <?php include 'data.php' ?>

            //First point
            // var cxt_line_chart = $('#annual-sales');
            // var line_chart_data = <?php echo json_encode($data) ?>;
            // var line_chart_labels = <?php echo json_encode($labels) ?>;
            // var line_chart = new Chart( cxt_line_chart, chart_config('line', line_chart_labels, line_chart_data, 'Vendite Mensili', 'rgba(22, 59, 213, 0.65)', 'rgba(0, 37, 190, 1)' ) );


            //Second point
            <?php

               foreach ($graphs as $key => $graph) {

                  if ($key == 'fatturato') {

                     foreach ($graph as $f_key => $f_value) {

                        if ($f_key == 'type') {
                           $line_type = $f_value;
                        } elseif ($f_key == 'data') {
                           $line_data = $f_value;
                        } elseif ($f_key == 'labels') {
                           $line_labels = $f_value;
                        }

                     }
                  }

                  elseif ($key == 'fatturato_by_agent') {

                     foreach ($graph as $k => $value) {

                        if ($k == 'type') {
                           $pie_type = $value;
                        }

                        elseif ($k == 'data') {
                           foreach ($value as $agent => $amount) {
                              $pie_labels[] = $agent;
                              $pie_data[] = $amount;
                           }
                        }

                     }
                  }
               }

            ?>

            var cxt_line_chart2 = $('#annual-sales');

            var line_chart_type2 = <?php echo json_encode($line_type) ?>;
            console.log('line type');
            console.log(line_chart_type2);

            var line_chart_data2 = <?php echo json_encode($line_data) ?>;
            console.log('line data');
            console.log(line_chart_data2);

            var line_chart_labels2 = <?php echo json_encode($line_labels) ?>;
            console.log('line label');
            console.log(line_chart_labels2);

            var line_chart = new Chart( cxt_line_chart2, chart_config(line_chart_type2, line_chart_labels2, line_chart_data2, 'Vendite Mensili', 'rgba(4, 214, 0, 0.65)', 'rgba(0, 37, 190, 1)' ) );

            var cxt_pie_chart = $('#monthly-sales');

            var pie_chart_type2 = <?php echo json_encode($pie_type) ?>;
            console.log('pie type');
            console.log(pie_chart_type2);

            var pie_chart_data2 = <?php echo json_encode($pie_data) ?>;
            console.log('pie data');
            console.log(pie_chart_data2);

            var pie_chart_labels2 = <?php echo json_encode($pie_labels) ?>;
            console.log('pie label');
            console.log(pie_chart_labels2);

            var line_chart = new Chart( cxt_pie_chart, chart_config(pie_chart_type2, pie_chart_labels2, pie_chart_data2, 'Vendite Individuali', 'rgba(4, 214, 0, 0.65)', 'rgba(0, 37, 190, 1)' ) );




            //<?php
            //
            //    $lab = [];
            //    $amt = [];
            //    foreach ($graphs['fatturato_by_agent'] as $key => $graph) {
            //       if ($key == 'data') {
            //          foreach ($graph as $k => $element) {
            //             var_dump($element);
            //             // $lab[] = $k;
            //             // $amt[] = $element;
            //          }
            //       }
            //    };
            //
            //    var_dump($lab);die();
            //    // var_dump('---------');
               // var_dump($amt);

            ?>



            //chart_config riceve come parametri il tipo di grafico, le labels e i dati da mostrare.
            //Crea e restituisce l'oggetto richiesto da Chart.js per creare il grafico
            function chart_config(chart_type, chart_labels, chart_data, chart_title, mainColor, secondaryColor ) {

               var c_config = {

                  type: chart_type,
                  data: {
                     labels: chart_labels,
                     datasets: [{
                        label: chart_title,
                        data: chart_data,
                        backgroundColor: mainColor,
                        borderColor: secondaryColor,
                     }]
                  }

               };

               return c_config;
            }

         });

      </script>

      <script type="text/javascript" src="js/main.js"></script>
   </body>
</html>
