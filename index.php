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
            <canvas id="annual-sales" width="400" height="400"></canvas>
         </div>

      </main>

      <script type="text/javascript">

         <?php include 'data.php' ?>

         $(document).ready(function(){
            var chart_context = $('#annual-sales');

            var chart_data = <?php echo json_encode($data) ?>;
            var chart_labels = <?php echo json_encode($labels) ?>;

            var myChart = new Chart( chart_context, chart_config('line', chart_labels, chart_data, 'Vendite Mensili', 'rgba(22, 59, 213, 0.65)', 'rgba(0, 37, 190, 1)' ) );





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
