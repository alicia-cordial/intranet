<?php 
session_start(); 

if (empty($_SESSION)) {
    header("Location: index.php");
} else {
    require_once('../../models/UserModel.php');
    $model = new UserModel();
    $messageUser = $model->selectMessages();
  
}?>

<link rel="stylesheet" href="css/app.css">

<section id="sectionVendeur">

<button id="myBtn"> Messagerie</button>
    
  <!-- The Modal -->
<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content" id="modal-content">
  <span class="close">&times;</span>


  <section id="tableLists">
  <article class="list">
  
    <ul id="messagerie">
        <?php foreach ($messageUser as $key => $message) : ?>
            <li class="liMessage" id="<?= $message['id'] ?>">
                <input class="liMessageTitle" readonly="readonly" value="<?= $message['identifiant'] ?>">
                <input class="liMessageTitle" readonly="readonly" value="<?= $message['date'] ?>">
                <input class="liMessageTitle" readonly="readonly" value="<?= $message['contenu'] ?>">
            </li>
        <?php endforeach; ?>
    
    </ul>

   
    <form method="post" id="formMessagerie">
        <input type="text" id="userId" value="<?= $_SESSION['user']['id'] ?>" placeholder="<?= $_SESSION['user']['id']?> ">
        <input type="text" id="contenu" placeholder="Type in your message right here bro !">
        <button type="submit" class="submit">🔥 Send !</button>
        
    </form>


  </article>
</section>

</div>

</div>

</section>







<script type="text/javascript">



// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

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

