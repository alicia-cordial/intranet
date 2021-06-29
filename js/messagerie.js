$(document).ready(function() {


    /*AJOUT MESSAGE*/
    $('body').on('submit', '#formMessagerie', function(e) {
        e.preventDefault();

        $.post(
            'API/apiMessagerie.php', {
                action: 'sendNewMessage',
                userId: $('#userId').val(),
                contenu: $('#contenu').val()
            },
            function(idMessage) {

                $.post(
                    'API/apiMessagerie.php', {
                        action: "displayMessage",
                        idMessage: idMessage
                    },

                    function(resultat) {
                        let data = JSON.parse(resultat);

                        $('#messagerie').append("<li class='liMessage' id='message" + data.id + "'>" + "<input class='liMessageTitle' readOnly='readonly' value='" + data.identifiant + data.date + "'</li>" +
                            "<input class='liMessageTitle' readOnly='readonly' value='" + data.contenu + "'</li>");
                        $('#contenu').val('');

                        if (data.id_utilisateur == userId) {
                            $('#message' + data.id).addClass('messageDestinataire')
                        } else {
                            $('#message' + data.id).addClass('messageUtilisateur')
                        }
                    }


                )
            },


        )
    });

});