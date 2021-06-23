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
                'API/apiMessagerie.php', { action: 'showConversation' },
                function(data) {
                    let messages = JSON.parse(data);
                    for (let message of messages) {
                        if (message === "success") {
                            $("#Message").append("<p>Modification du profil réussie !</p>");

                        }

                    }


                },
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


/*FUNCTIONS*/
function callSectionUser(page) {
    $.get('views/user/' + page + '.php',
        function(data) {
            $('#sectionVendeur').html(data);
        });
}