<!--
   Todolist: Creiamo un variabile con un array di array di todo da fare.
   Ogni todo avrà un messaggio e un boolean (completato e non completato).
   Se è completato lo stilerete in modo diverso (tipo disabled), con tutte le
   nozioni che abbiamo visto oggi. In jQuery poi interverremo su ogni todo
   per completarlo lato client.
-->


<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
      <title>Todo List</title>
   </head>
   <body>

      <?php

         $todo_items = [
            [
               'msg' => 'fare spesa',
               'done' => 'false'
            ],
            [
               'msg' => 'pulire',
               'done' => 'true'
            ],
            [
               'msg' => 'appuntamento ore 16',
               'done' => 'false'
            ],
            [
               'msg' => 'guarda Peaky Blonders',
               'done' => 'false'
            ],
            [
               'msg' => 'Chiama Tizio',
               'done' => 'false'
            ],
            [
               'msg' => 'Vai da Caio',
               'done' => 'false'
            ],
         ];

         //var_dump($todo_items);die();
      ?>

      <div class="container">

         <?php
            foreach ($todo_items as $todo_item) {
         ?>

         <?php
               if ($todo_item['done'] == 'false') {
                  $class = 'active';
                  $button_state = 'btn-active';
               }  else {
                     $class = 'done';
                     $button_state = 'disabled';
                  }
         ?>

               <div class="item <?php echo $class; ?>">
                  <h2> <?php echo ucfirst($todo_item['msg']); ?></h2>
                  <button class="btn <?php echo $button_state; ?>" type="button" name="button">Done</button>
               </div>

         <?php
            }
         ?>

      </div>

      <script type="text/javascript" src="js/main.js"></script>
   </body>
</html>
