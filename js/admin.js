$(document).ready(function() {


    $('body').on('click', '.navAdmin', function() {
        $('#sectionAdmin').empty();

        if ($(this).is('#navAdminUsers')) {
            callSectionAdmin('adminUsers')
        }

        //UPDATE PROFIL
        else if ($(this).is('#navUpdateProfil')) {
            callSectionUser('updateProfile')
            $('body').on('change', 'input[name="status"]', function() {
                if (!$(this).hasClass('originalStatus')) {
                    $('#statusInfo').css('display', 'block')
                } else {
                    $('#statusInfo').css('display', 'none')
                }
            })


        } else if ($(this).is('#navAdminMessagerie')) {
            callSectionAdmin('adminMessagerie')
            $.post(
                'API/apiMessagerie', { action: 'selectContacts' },
                function(data) {
                    let contacts = JSON.parse(data);
                    let contactList = $('#contacts')
                    console.log(data);
                    if (contacts == 'none') {
                        contactList.append("Aucune conversation");
                    } else {
                        $.each(contacts, function(key, value) {
                            contactList.append("<p class='individualConversation' id='" + value.id + "'>" + value.identifiant + "</p>")
                        })
                    }
                }
            );
        }


    })







    //Formulaire modification profil
    $('body').on('submit', '#formUpdateUser', function(event) {
        $('#message').empty();
        event.preventDefault()
        $.post(
            'API/apiModule.php', {
                form: 'updateProfil',
                login: $('#login').val(),
                password: $('#password').val(),
                password2: $('#password2').val(),
                email: $('#email').val(),
            },
            function(data) {
                console.log(data);
                let messages = JSON.parse(data);
                for (let message of messages) {
                    if (message === "success") {
                        $("#message").append("<p>Modification du profil réussie !</p>");
                        setTimeout(
                            function() {
                                $("#mainCompte").load(location.href + " #mainCompte")
                            }, 3000);
                    } else {
                        $('#message').append("<p>" + message + "</p>");
                    }
                }
            },
        );
    });

})


$('body').on('click', '.showUsers', function() {
    let choice = $(this).attr('value');
    $('#listeUsersTries').empty()
    console.log(choice)
    $.post(
        'API/apiAdmin', {
            action: 'showUsers',
            choice: choice
        },
        function(data) {
            console.log(data);
            let users = JSON.parse(data);
            if (users === 'none') {
                $('#listeUsersTries').append("<p>Rien</p>")
            } else {
                for (let user of users) {
                    if (user.status == 'vendeur') {
                        $('#listeUsersTries').append("<tr value='" + user.identifiant + "' id='" + user.id + "'><td><a href='profilVendeur?id=" + user.id + "'>" + user.identifiant + "</a></td><td>" + user.status + "</td><td>Inscription : " + user.date_inscription + "</td><td><a id ='" + user.id_vendeur + "' class='contactUser' href='#ex1' rel='modal:open'>Contacter le vendeur</a></td><td><button class='deleteUser'>Supprimer</button></td></tr>")
                    } else {
                        $('#listeUsersTries').append("<tr value='" + user.identifiant + "' id='" + user.id + "'><td>" + user.identifiant + "</td><td>" + user.status + "</td><td>Inscription : " + user.date_inscription + "</td><td><a id ='" + user.id_vendeur + "' class='contactUser' href='#ex1' rel='modal:open'>Contacter le vendeur</a></td><td><button class='deleteUser'>Supprimer</button></td></tr>")
                    }
                }
            }
        }
    )
})

//BOUTON SUPPRIMER user
$('body').on('click', '.deleteUser', function() {
    let row = $(this).parents('tr')
    let idUser = row.attr('id')
    $('#infoAdmin').empty()
    $(this).html('<button id="confirmSupprUser">Êtes-vous sûr.e ? </button><button class="navAdmin">Non.</button>')
    $('#infoAdmin').append("<p>Si l'utilisateur est un vendeur, ses articles en vente seront aussi supprimés. Procéder avec prudence.</p>")
    $('body').on('click', '#confirmSupprUser', function() {
        $.post(
            'API/apiAdmin.php', { action: 'deleteUser', id: idUser },
            function(data) {
                let message = JSON.parse(data);
                row.hide()
                $('#infoAdmin').html('<p>Utilisateur.ice supprimé.e.</p>')
            },
        );
    });
})


/*FUNCTIONS*/
function callSectionUser(page) {
    $.get('views/admin/' + page + '.php',
        function(data) {
            $('#sectionAdmin').html(data);
        });
}