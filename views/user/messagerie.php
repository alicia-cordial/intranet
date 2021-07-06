<?php 
session_start(); 

if (empty($_SESSION)) {
    header("Location: index.php");
} else {
    require_once('../../models/UserModel.php');
    $model = new UserModel();
 
  
}?>


<button id="myBtn"> Messagerie</button>
<section id="sectionVendeur" class="sectionMessagerie">  
  <!-- The Modal -->
<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content" id="modal-content">
  <span class="close">&times;</span>
 
 
  <section id="tableLists">
 
  


    <div>
        <p class="messagerie" value="">Tous</p>
    </div>
</article>

<article id="listeMessages">

</article>

<article id="infoAdmin">

</article>

    <form id="formMessagerie">
        <input type="text" id="idUser" hidden value="<?= $_SESSION['user']['id'] ?>">
        <input type="text" id="contenu" placeholder="Type in your message right here bro !" required>
        <button type="submit" class="submit">🔥 Send !</button>
    </form>

<div id="infoMessage"></div>

<form>
    <label for="search">Search</label>
    <input id="search" type="search" />
    <button id="btnSearch">Go</button>
</form>

      <div class="out"></div>
</section>


<div>
    <p class="showUsers" value="">Tous les utilisateurs</p>
</div>

<article id="listeUsers">

</article>
 
 



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

<script>
      let APIKEY = "Kcxwxp4PN5SBX8kFlZrO8LNQa9T5osWX";
      // you will need to get your own API KEY
      // https://developers.giphy.com/dashboard/
      document.addEventListener("DOMContentLoaded", init);
      function init() {
        document.getElementById("btnSearch").addEventListener("click", ev => {
          ev.preventDefault(); //to stop the page reload
          let url = `https://api.giphy.com/v1/gifs/search?api_key=${APIKEY}&limit=10&q=`;
          let str = document.getElementById("search").value.trim();
          url = url.concat(str);
          console.log(url);
          fetch(url)
            .then(response => response.json())
            .then(content => {
              //  data, pagination, meta
              console.log(content.data);
              console.log("META", content.meta);
              let fig = document.createElement("figure");
              let img = document.createElement("img");
              let fc = document.createElement("figcaption");
              img.src = content.data[0].images.downsized.url;
              img.alt = content.data[0].title;
              fc.textContent = content.data[0].title;
              fig.appendChild(img);
              fig.appendChild(fc);
              let out = document.querySelector(".out");
              out.insertAdjacentElement("afterbegin", fig);
              document.querySelector("#search").value = "";
            })
            .catch(err => {
              console.error(err);
            });
        });
      }
    </script>