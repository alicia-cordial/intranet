$(document).ready(function() {

    $('body').on('click', '.modal', function() {
        let choice = $(this).attr('value');
        $('#listeMessages').empty()
        console.log(choice)
        $.post(
            'API/apiMessagerie.php', {
                action: 'displayMessage',
                choice: choice
            },
            function(data) {
                console.log(data);
                let messages = JSON.parse(data);
                if (messages === 'none') {
                    $('#listeMessages').append("<p>Rien</p>")
                } else {
                    for (let message of messages) {

                        $('#listeMessages').append("<tr value='" + message.contenu + "' id='" + message.id + "'><td>" + message.identifiant + "</td><td>" + message.date + "</td><td>" + message.contenu + "</td></tr>")

                    }
                    $("#myModal").scrollTop($("#myModal")[0].scrollHeight);

                }
            }
        )
    })


    /*AJOUT MESSAGE*/
    $('body').on('submit', '#formMessagerie', function(e) {
        $('#contenu').empty();
        e.preventDefault();
        $.post(
            'API/apiMessagerie.php', {
                action: 'createMessage',
                userId: $('#userId').val(),
                contenu: $('#contenu').val(),

            },
            function(data) {
                console.log(data);
                let message = JSON.parse(data);
                $('#contenu').empty()
                $('#listeMessages').append("<tr value='" + message.contenu + "' id='" + message.id + "'><td>" + message.identifiant + "</td><td>" + message.date + "</td><td>" + message.contenu + "</td></tr>")
                $('#rep').html('<p>Message créé.</p>')

            }


        )
    });

});