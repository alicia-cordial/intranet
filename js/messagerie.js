$(document).ready(function() {


    /*AJOUT MESSAGE*/


    $('body').on('submit', '#formMessagerie', function(event) {
        event.preventDefault(); // empecher reload
        console.log($('#contenu').val()),
            $.post(
                'API/apiMessagerie.php', {
                    action: 'sendNewMessage',
                    contenu: $('#contenu').val()
                },


                function(result) {
                    console.log(result);
                    let message = JSON.parse(result);
                    $('#contenu').val('')
                    $('#infoMessage').append("<p>Message envoyé !</p>")
                }



            );



    });
    /*
    $('body').on('submit', '#formMessagerie', function(e) {
        $('#contenu').empty()
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: "API/apiMessagerie.php",
            data: $('#formMessagerie').serialize(),
            dataType: 'json',
            success: function(data) {
                $('#listeMessages').html(data);

            }
        })

    });

    $('body').on('submit', '#formMessagerie', function(event) {
        $('#contenu').empty()
        event.preventDefault()
        let idUser = $('#idUser').attr('value'); //id 
        console.log($('#contenu').val())
        console.log(idUser),
            console.log(contenu),
            $.post(
                'API/apiMessagerie.php', {
                    action: 'sendNewMessage',
                    idUser: idUser,
                    contenu: $('#contenu').val()
                },


                function(data) {
                    let message = JSON.parse(data);
                    console.log(data);
                    $('#contenu').val(''),
                        console.log(idUser)
                        // M.toast({ html: 'Message envoyé !' }
                }
            )
    })
*/



    /*
        $('body').on('submit', '#formMessagerie', function(e) {
            e.preventDefault();

            $.post(
                'API/apiMessagerie.php', {
                    action: 'sendNewMessage',
                    idUser: $('#idUser').val(),
                    contenu: $('#contenu').val()
                },


                function(idMessage) {
                    $.post(
                        'API/apiMessagerie.php', {
                            action: "displayMessage",
                            idMessage: idMessage
                        },

                        function(data) {
                            let message = JSON.parse(data);
                            console.log(data)
                            $('#listeMessages').append("<tr value='" + message.identifiant + "' id='" + message.id + "'><td>" + message.identifiant + "</td><br/><br/><td>" + message.date + "</td><br/><br/><td class='contenuInput'>" + message.contenu + "</td></tr><br/>")
                            $('#contenu').val('');


                        }

                    )
                },

            )
        });
    */

    $('body').on('click', '.messagerie', function(e) {
        e.preventDefault(); // empecher reload
        let choice = $(this).attr('value');
        $('#listeMessages').empty()
        console.log(choice)
        $.post(
            'API/apiMessagerie.php', {
                action: 'displayMessages',
                choice: choice
            },
            function(data) {
                console.log(data);
                let messages = JSON.parse(data);
                if (messages === 'none') {
                    $('#listeMessages').append("<p>Rien</p>")
                } else {
                    for (let message of messages) {

                        $('#listeMessages').append("<tr value='" + message.identifiant + "' id='" + message.id + "'><td>" + message.identifiant + "</td><br/><br/><td>" + message.date + "</td><br/><br/><td class='contenuInput'>" + message.contenu + "</td></tr><br/>")

                    }
                }
            }
        )
    })

    $('body').on('click', '.showUsers', function() {
        let choice = $(this).attr('value');
        $('#listeUsers').empty()
        console.log(choice)
        $.post(
            'API/apiMessagerie.php', {
                action: 'allUsers',
                choice: choice
            },
            function(data) {
                console.log(data);
                let users = JSON.parse(data);
                if (users === 'none') {
                    $('#listeUsers').append("<p>Rien</p>")
                } else {
                    for (let user of users) {

                        $('#listeUsers').append("<tr class='users' value='" + user.identifiant + "' id='" + user.id + "'><td>" + user.identifiant + "</td></tr>")

                    }
                }
            }
        )
    })



    //BOUTON SUPPRIMER user
    /*  $('body').on('click', '.deleteMessage', function() {
              let row = $(this).parents('tr')
              let idUser = row.attr('id')
              $('#infoAdmin').empty()
              $(this).html('<button id="confirmSupprUser">Êtes-vokus sûr.e ? </button><button class="navAdmin">Non.</button>')
                  //$('#infoAdmin').append("<p>Si l'utilisateur est un vendeur, ses articles en vente seront aussi supprimés. Procéder avec prudence.</p>")
              $('body').on('click', '#confirmSupprMess', function() {
                  $.post(
                      'API/apiMessagerie.php', { action: 'deleteMess', id: idUser },
                      function(data) {
                          let message = JSON.parse(data);
                          row.hide()
                          $('#infoAdmin').html('<p>Message supprimé.</p>')
                      },
                  );
              });
          }) */


})