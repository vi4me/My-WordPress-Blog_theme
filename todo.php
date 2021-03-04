<?php
/*
Template Name: todo
Template Post Type: specialization
*/
?>
<?php

get_header('main');
?>

<div class="todo-wrapper">
    <h1 class="text-center">Список дел</h1>
    <div class="inputField">
      <input type="text" placeholder="Добавить задачу">
      <button>+</button>
    </div>
    <ul class="todoList">

    </ul>
    <div class="todo-footer">
      <span>Количесво задач: </span><span class="pendingTasks"></span>
      <button>Очистить все</button>
    </div>
  </div>


<?php

get_footer();
