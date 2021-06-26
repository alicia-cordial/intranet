<?php 
session_start(); 

if (empty($_SESSION)) {
    header("Location: index.php");
} else {
    require_once('../../models/UserModel.php');
    $model = new UserModel();
    $tasksUser = $model->selectTasks($_SESSION['user']['id']);
  
}?>

<section id="sectionVendeur">

<button id="myBtn2"> To do list</button>
    <!-- The Modal -->
<div id="myModal2" class="modal">

<!-- Modal content -->
<div class="modal-content" id="modal-content">
  <span class="close">&times;</span>

    <section id="tableLists">

    <article class="list" id="listTodo">
        <h3>Taches a faire</h3>
        <ul id="toDoList" class="listAFaire">
            <?php foreach ($tasksUser['toDo'] as $key => $task) : ?>
                <li class="liTask" id="<?= $task['id'] ?>">
                    <input class="liTaskTitle" readonly="readonly" value="<?= $task['titre'] ?>">
                </li>
            <?php endforeach; ?>
        
        </ul>

        
        <form method="post" id='formTodo'>
            <input type="text" id="userId" hidden value="<?= $_SESSION['user']['id'] ?>">
            <input type="text" id="titleTask" placeholder="Ajouter une tache">
            <button type="submit" class="addTask"> +</button>
        </form>
    </article>




    <article class="list">
        <h3>Taches terminées</h3>
        <ul id="doneList">
            <?php foreach ($tasksUser['done'] as $key => $task) : ?>
                <li class="liTask" id="<?= $task['id'] ?>">
                    <input class="liTaskTitle" readonly="readonly" value="<?= $task['titre'] ?>">
                    <span><input type='checkbox' checked disabled class='liTaskEnd'> <?= $task['date_fin'] ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </article>
  
    <article class="list" onclick="displayArchive()" id="containerArchive">
        <h3>Taches archivées</h3>
        <ul id="archiveList">
            <?php foreach ($tasksUser['archive'] as $key => $task) : ?>
                <li class="liTask" id="<?= $task['id'] ?>">
                    <input class="liTaskTitle" readonly="readonly" value="<?= $task['titre'] ?>">
                </li>
            <?php endforeach; ?>
        </ul>

    </article>
    </section>

</section>

<script>


// Get the modal
var modal = document.getElementById("myModal2");

// Get the button that opens the modal
var btn = document.getElementById("myBtn2");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}
</script>