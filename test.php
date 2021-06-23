<?php 
session_start(); 
require_once('../../models/UserModel.php');




if (isset($_POST['submit'])) {
    $model = new UserModel();
    $contenu = htmlspecialchars($_POST['contenu']);
    $id_utilisateur = $_SESSION['user']['id'];
    
    $model->addMessage($contenu, $id_utilisateur);
    $success = "bravo";
 
       
}



?>




<link rel="stylesheet" href="css/app.css">


<section id="sectionVendeur">

<button id="myBtn"> Messagerie</button>

<article id="contacts">



    
  <!-- The Modal -->
<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content" id="modal-content">
  <span class="close">&times;</span>

<section class="chat" id="chat">
    <div class="messages" id="messages">
<?php  
$model = new UserModel();
foreach($model->selectMessagesConversation() as $messages):
      
        ?>
    <div class="message" id="message">
        <h4><?= $messages['date']; ?>  <?= $messages['identifiant']; ?></h4>
        <h4><?= $messages['contenu']; ?></h4>
 
    </div>
    <?php endforeach; ?>
    </div>


    <div id="form">
    <form method="POST">
        <input type="text" id="id_utilisateur" name="id" value="<?= $_SESSION['user']['id']?> " placeholder="<?= $_SESSION['user']['id']?> ">
        <input type="text" id="contenu" name="contenu" placeholder="Type in your message right here bro !">
        <button type="submit" name="submit">🔥 Send !</button>
        
    </form>
    </div>
</section>

</div>

</div>

</article>

<article id="Message">
</article>


</section>






<script type="text/javascript">

/*CHARGMENT PAGE */

    /*$('#myBtn').click(function() {
         $('#chat').load('views/user/messagerie.php');
         return false;
     });*/
    /*
        function refresh_chat() {
            $.post("API/apiMessagerie.php", function(data) {
                $("#chat").html(data.chat);
            });
        }
        $(function() { window.setInterval(refresh_chat(), 100); });
        refresh_chat();
    */

    //window.setInterval('refresh()', 10000); 	
    // Call a function every 10000 milliseconds 
    // (OR 10 seconds).

    // Refresh or reload page.
    //function refresh() {
    //  window.location.reload();
    //window.scrollTo(0,document.querySelector("#form").scrollHeight);
    //element = document.getElementById('form');
    //element.scrollTop = element.scrollHeight;

    // }



    //window.scrollTo(0, document.body.scrollHeight || document.documentElement.scrollHeight);
    //SCROLL EN BAS
    //element = document.getElementById('form');
	//element.scrollTop = element.scrollHeight;



/*function OuvrirPopup(page, nom, option) {
  window.open(page, nom, option);
} */ //POUR QUE POP UP PRENNE TOUTE LA PLACE


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
function doRefresh() {
    $('#modal').load(location.href + ' #modal');
    }
    $(function() {
 setInterval(doRefresh, 2000);
        });
</script>

