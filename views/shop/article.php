<?php

if(isset($_GET['id'])){

    $model = new Shop();
  
    $id = htmlspecialchars($_GET['id']);
    $articles = $model->showArticle($id);
    //echo '<pre>';
    //var_dump($articles);
    //echo'</pre>';

}

    ?>

<h1>Fiche Produit</h1>

<table>
    <thead>
    <tr>
        <th>Titre</th>
        <th>Description</th>
        <th>Date Ajout</th>
        <th>Prix</th>
        <th>Etat objet</th>
        <th>Ouvert à négociation</th>
        <th>Signal</th>
        <th>Catégorie</th>
        <th>Vendeur</th>
        <th>Code Postal</th>
        <th>Mail</th>
    </tr>
    </thead>

    <tbody>
   
        <tr>
            <td><?= $articles['titre']; ?></td>
            <td><?= $articles['description']; ?></td>
            <td><?= $articles['date_ajout']; ?></td>
            <td><?= $articles['prix'].'€'; ?></td>
            <td><?= $articles['etat_objet']; ?></td>
            <td><?= $articles['ouvert_negociation']; ?></td>
            <td><?= $articles['signal'] ?></br><a id =" <?= $articles['id'] ?>" class='signalObjet' href='#ex2' rel='modal:open'>Signaler objet</a> </td>
            <td><?= $articles['nom']; ?></td>
            <td><a href='profilVendeur?id=<?= $articles['id']; ?>'><?= $articles['identifiant']; ?></a></td>
            <td><?= $articles['']; ?></td>
            <td><a id =" <?= $articles['id'] ?>" class='contactUser' href='#ex1' rel='modal:open'>Contacter le vendeur</a> </td>
    
          
        </tr>



    </tbody>
</table>



<div id="ex1" class="modal">
    <div id="idDestinataire" value="<?= $articles['id']; ?>"></div>
    <div id="nameDestinataire" value="<?= $articles['identifiant']; ?>"></div>
            <form id='newMessage'>
                <input placeholder='votre message' required>
                <button type='submit'>Envoyer</button>
        </form>
    <div id="infoMessage"></div>
        <a href="#" rel="modal:close">Close</a>
    </div>

