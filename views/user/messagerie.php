<?php 
session_start(); 

if (empty($_SESSION)) {
    header("Location: index.php");
} else {
    require_once('../../models/UserModel.php');
    $model = new UserModel();
 
  
}?>
  




<div>
                
    <p class="containerContactUser"><a class='Messagerie white-text ' href='#ex1' rel='modal:open'></a></p>
            
    
    <section id="tableLists">

        <div>
            <p class="messagerie" value="">Tous</p>
        </div>
        </article>

        <article id="listeMessages">

        </article>

        <article id="infoAdmin">

        </article>
        <!--<img src="images/giphy.svg"/>-->
        <form id="formMessagerie">
            <input type="text" id="idUser" hidden value="<?= $_SESSION['user']['id'] ?>">
            <input type="text" id="contenu" placeholder="Type in your message right here bro !" required>
            <button type="submit" class="submit">🔥 Send !</button>
        </form>

        <div id="infoMessage"></div>


    </section>
</div>