$(document).ready(function() {


    $('body').on('click', '.navUser', function() {
        $('#sectionVendeur').empty();

        //UPDATE PROFIL
        if ($(this).is('#navUpdateProfil')) {
            callSectionUser('updateProfile')
            $('body').on('change', 'input[name="status"]', function() {
                if (!$(this).hasClass('originalStatus')) {
                    $('#statusInfo').css('display', 'block')
                } else {
                    $('#statusInfo').css('display', 'none')
                }
            })

            //MESSAGERIE
        } else if ($(this).is('#navMessagerie')) {
            callSectionUser('messagerie')
            $.post(
                'API/apiMessagerie.php', { action: 'selectContacts' },
                function(data) {
                    let contacts = JSON.parse(data);
                    let contactList = $('#contacts')
                    console.log(data);
                    if (contacts == 'none') {
                        contactList.append("Aucune conversation");
                    } else {
                        for (let contact of contacts) {

                        }
                    }
                }
            );

            // TO DO LIST
        } else if ($(this).is('#navTdl')) { // lien correspondant
            callSectionUser('todolist') //page views
            $.post(
                'API/apiTodo.php', { action: 'showTache' }, //lien ac API
                function(data) {
                    let tdls = JSON.parse(data);
                    let tdlList = $("#container_todo")
                    console.log(data);
                    if (tdls == 'none') {
                        tdlList.append('Aucune tâche');

                    } else {
                        $.each(tdls, function(key, value) {
                            tdlList.append("<p class='individualTache' id='" + value.id + "'>" + value.titre + value.date_debut + value.termine + "</p>");
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

/*
if ($(this).is('#navTdl')) {
    callSectionAdmin('todolist')
    $.post(
        'API/apiTodo.php', {
            action: 'showTache',
        },
        function(data) {
            console.log(data);
            let taches = JSON.parse(data);
            if (taches === 'none') {
                $('#taches').append("<p>Rien</p>")
            } else {
                for (let ta of taches) {
                    if ($('#' + ta.id).length === 0) {
                        if (ta.titre) {
                            $('#taches').append("<tr value='" + ta.titre + "' id='" + ta.id + "'><td><td class='rowTache'>" + ta.titre + "</td><td><button class='updateTache'>Modifier le titre</button></td></tr>")
                        }
                    }
                }
            }
        }
    )

}


//update tache

$('body').one('click', '.updateTache', function() {
    let row = $(this).parents('tr')
    let idTache = row.attr('id');
    let tacheName = row.attr('value');
    if ($('#newName').length == 0) {
        $(this).after("<input id='newName' value='" + tacheName + "'>")
    }
    $('body').on('click', '.updateTache', function() {
        $.post(
            'API/apiTodo', { action: 'updateTache', idTache: idTache, newName: $('#newName').val() },
            function(data) {
                console.log(data);
                $('#infoAdmin').html('<p>Nom de la tache updatée !</p>')
                setTimeout(
                    function() {
                        $("#sectionVendeur").load(location.href + " #sectionVendeur")
                    }, 2000);
            }
        )
    })
})

//delete tache

$('body').one('click', '.deleteTache', function() {
    let row = $(this).parents('tr')
    let idTache = row.attr('id');
    $.post(
        'API/apiTodo.php', { action: 'deleteTache', id: idTache },
        function(data) {
            console.log(data);
            let message = JSON.parse(data);
            row.hide()
            $('#infoAdmin').html('<p>Tache supprimée.</p>')

        }
    )
})

//Button nouvelle tache
$('body').one('click', '#addNewTache', function() {
    if ($('#newTacheName').length == 0) {
        $(this).after("<input id='newTacheName'>")
    }
    $('body').on('click', '#addNewTache', function() {
        $.post(
            'API/apiTodo.php', { action: 'addNewTache', titre: $('#newTacheName').val() },
            function(data) {
                console.log(data);
                let tache = JSON.parse(data);
                $('#newTacheName').empty()
                $('#tachesVides').append("<tr value='" + tache.titre + "' id='" + tache.id + "'><td><td class='rowTache'>" + tache.titre + "</td><td><button class='deleteTache'>Supprimer la tache</button></td></tr>")
                $('#infoAdmin').html('<p>Catégorie créée.</p>')

            }
        )
    })
})*/

/*FUNCTIONS*/
function callSectionUser(page) {
    $.get('views/user/' + page + '.php',
        function(data) {
            $('#sectionVendeur').html(data);
        });
}