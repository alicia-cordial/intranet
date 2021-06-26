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

                        $('#messagerie').append("<li class='liMessage' id='" + data.id + "'>" + "<input class='liMessageTitle' readOnly='readonly' value='" + data.identifiant + data.date + "'</li>" +
                            "<input class='liMessageTitle' readOnly='readonly' value='" + data.contenu + "'</li>");
                        $('#contenu').val('');
                    }

                )
            },

        )
    });

});

/*
 //NEW MESSAGE IN CONVERSATION
    $('body').on('submit', '#formNewMessage', function (event) {
        let idDestinataire = $(this).attr('value')
        event.preventDefault()
        let conversation = $('#conversation')
        console.log(idDestinataire)
        console.log($('#newMessage').val())
        $.post(
            'API/apiMessagerie.php', {
                action: 'sendNewMessage',
                idDestinataire: idDestinataire,
                messageContent: $('#newMessage').val()
            },
            function (data) {
                let message = JSON.parse(data);
                $('#newMessage').val('')
                console.log(data);
                conversation.append("<p id='message" + message.id + "' class='messageUtilisateur'>Envoyé le : " + message.date + " - " + message.contenu + "</p>")
            }
        )
    })
*/