<div id="ex1" class="modal">
    <div id="idDestinataire" value="<?= $users['id']; ?>"></div>
    <div id="nameDestinataire" value="<?= $users['identifiant']; ?>"></div>
            <form id='newMessage'>
                <input placeholder='votre message' required>
                <button type='submit'>Envoyer</button>
        </form>
    <div id="infoMessage"></div>
        <a href="#" rel="modal:close">Close</a>
    </div>
