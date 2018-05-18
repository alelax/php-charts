<?php
  $data = [1000,1322,1123,2301,3288,988,502,2300,5332,2300,1233,2322];
  $labels = ["Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre"];
?>


<?php
  $graphs = [
    'fatturato' => [
        'type' => ['line'],
        'data' => [1000,1322,1123,2301,3288,988,502,2300,5332,2300,1233,2322],
        'labels' => ["Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre"]
    ],
    'fatturato_by_agent' => [
      'type' => ['pie'],
      'data' => [
        'Marco' => 9000,
        'Giuseppe' => 4000,
        'Mattia' => 3200,
        'Alberto' => 2300
     ],
    ]
  ];
 ?>
