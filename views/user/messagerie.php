<?php 
require_once('../../models/UserModel.php');
session_start(); 
$model = new UserModel();


if (isset($_POST['submit'])) {
   
    $contenu = htmlspecialchars($_POST['contenu']);
    $id_utilisateur = $_SESSION['user']['id'];
    
    $model->addMessage($contenu, $id_utilisateur);
    $success = "bravo";
 
       
}



?>



<link rel="stylesheet" href="css/app.css">
<section id="sectionVendeur">
    <article id="contacts">

    </article>

    <button id="myBtn"> Messagerie</button>
  <!-- The Modal -->
<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
  <span class="close">&times;</span>

<section class="chat">
    <div class="messages" id="messages">
<?php  foreach($model->selectMessagesConversation() as $messages):
      
        ?>
    <div class="message">
        <h4><?= $messages['date']; ?>  <?= $messages['identifiant']; ?></h4>
        <h4><?= $messages['contenu']; ?></h4>
 
    </div>
    <?php endforeach; ?>
  

    
    </div>
    <div id="form">
    <form method="POST">
        <input type="text" id="user" name="id" value="<?= $_SESSION['user']['id']?> " placeholder="<?= $_SESSION['user']['id']?> ">
        <input type="text" id="contenu" name="contenu" placeholder="Type in your message right here bro !">
        <button type="submit" name="submit">🔥 Send !</button>
        
    </form>
    </div>
</section>

</div>

</div>
</section>










<script type="text/javascript">

/*CHARGMENT PAGE */

window.setInterval('refresh()', 10000); 	
    // Call a function every 10000 milliseconds 
    // (OR 10 seconds).

    // Refresh or reload page.
    function refresh() {
        window.location.reload();
    }

    element = document.getElementById('form');
	element.scrollTop = element.scrollHeight;





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

// When the user clicks anywhere outside of the modal, close it
/*window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}*/




</script>