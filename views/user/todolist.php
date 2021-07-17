<?php 
session_start(); 

if (empty($_SESSION)) {
    header("Location: index.php");
} else {
    require_once('../../models/UserModel.php');
    $model = new UserModel();
    $tasksUser = $model->selectTasks($_SESSION['user']['id']);
  
}?>

<section id="sectionVendeur" class="sectionTdl">

<div>

<p class="containerContactUser"><a class='TODOLIST white-text ' href='#ex1' rel='modal:open'></a></p>

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

        
        <form id='formTodo'>
            <input type="text" id="idUser" hidden value="<?= $_SESSION['user']['id'] ?>">
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

            </div>

</section>
