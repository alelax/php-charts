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

         <?php
            $access_permission = $_GET['level'];
         ?>

         <?php
            if (
                  $access_permission != 'guest'    &&
                  $access_permission != 'employee' &&
                  $access_permission != 'clevel'
               ) { ?>

               <h1 class="denied"> PERMESSO NEGATO </h1>

         <?php
            }
            else { ?>

               <div class="chart-container">
                  <canvas id="annual-sales"></canvas>
               </div>

            <?php
               if ($access_permission != 'guest'  ) { ?>
                  <div class="chart-container">
                     <canvas id="monthly-sales"></canvas>
                  </div>
            <?php
               }
            ?>

            <?php
               if ($access_permission == 'clevel'  ) { ?>
                  <div class="chart-container">
                     <canvas id="annual-efficency"></canvas>
                  </div>
            <?php
               }

            }
            ?>


      </main>




      <script type="text/javascript">

         <?php include 'data.php' ?>

         $(document).ready(function(){



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

                  elseif ($key == 'team_efficiency') {

                     foreach ($graph as $k => $value) {

                        if ($k == 'type') {
                           $team_eff_type = $value;
                        }

                        elseif ($k == 'data') {
                           foreach ($value as $team => $efficeny) {
                              $team_eff_labels[] = $team;
                              $team_eff_data[] = $efficeny;
                           }
                        }

                     }
                  }


               }



            ?>

            /* ********** ANNUAL SALES LINE CHART ********** */

            var cxt_line_chart = $('#annual-sales');

            var line_chart_type2 = <?php echo json_encode($line_type) ?>;
            console.log('line type');
            console.log(line_chart_type2);

            var line_chart_data2 = <?php echo json_encode($line_data) ?>;
            console.log('line data');
            console.log(line_chart_data2);

            var line_chart_labels2 = <?php echo json_encode($line_labels) ?>;
            console.log('line label');
            console.log(line_chart_labels2);

            var line_chart = new Chart( cxt_line_chart, chart_config(line_chart_type2, line_chart_labels2, line_chart_data2, 'Vendite Mensili', 'rgba(4, 214, 0, 0.65)', 'rgba(0, 37, 190, 1)' ) );


            /* ********** AGENT SALES PIE CHART ********** */

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

            var pie_chart = new Chart( cxt_pie_chart, chart_config(pie_chart_type2, pie_chart_labels2, pie_chart_data2, 'Vendite Individuali', 'rgba(4, 214, 0, 0.65)', 'rgba(0, 37, 190, 1)' ) );


            /* ********** ANNUAL TEAM EFFICENCY LINE CHART ********** */

            var cxt_line_eff_chart = $('#annual-efficency');

            var line_eff_chart_type = <?php echo json_encode($team_eff_type) ?>;
            console.log('line efficency type');
            console.log(line_eff_chart_type);

            var line_eff_chart_data = <?php echo json_encode($team_eff_data) ?>;
            console.log('line efficency data');
            console.log(line_eff_chart_data);

            var line_eff_chart_labels = <?php echo json_encode($team_eff_labels) ?>;
            console.log('line efficency label');
            console.log(line_eff_chart_labels);

            var line_eff_chart = new Chart( cxt_line_eff_chart , {

               type: 'line',
               data: {
                  labels: ["Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre"],
                  datasets: getDataset(line_eff_chart_labels, line_eff_chart_data, ['rgba(20, 78, 208, 0.25)', 'rgba(235, 7, 15, 0.25)', 'rgba(44, 236, 13, 0.25)'], ['rgb(20, 78, 208)', 'rgb(235, 7, 15)', 'rgb(44, 236, 13)'])
               },

            });

            console.log(  );


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

            //getDataset riceve in ingresso un array di label, uno di dati, e due array di colori.
            //Genera e restituisce un array di oggetti dataset formattati in base alle specifiche di Chart.js.
            function getDataset(label_arr, data_arr, backgroundColor, borderColor) {
               var i = 0;
               var dataset = [];
               while (i < data_arr.length) {
                  var obj = {
                     label: label_arr[i],
                     data: data_arr[i],
                     backgroundColor: backgroundColor[i],
                     borderColor: borderColor[i],
                  };

                  dataset.push(obj);

                  i++;
               }

               return dataset;
            }

         });

      </script>

      <script type="text/javascript" src="js/main.js"></script>
   </body>
</html>
