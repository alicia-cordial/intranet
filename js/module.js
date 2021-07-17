$(document).ready(function() {

    //TOGGLE inscription / connexion
    $('body').on('click', '.callForm', function() {
        if ($(this).is('#callFormInscription')) {
            callform('inscription')
        } else {
            callform('connexion')
        }
    });

    /*INSCRIPTION*/
    //Display inscription blocks
    $('body').on('click', '#email', function() {
        $('#bloc2').css('display', 'block')
    });
    $('body').on('change', '#password2', function() {
        $('#bloc3').css('display', 'block')
    });

    //Submit inscription
    $('body').on('submit', '.Inscription', '#formInscription', function(event) {
        $('#message').empty();
        event.preventDefault()
        $.post(
            'API/apiModule.php', {
                form: 'inscription',
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
                        $("#message").append("<p>Inscription réussie !</p>");
                    } else {
                        $('#message').append("<p>" + message + "</p>");
                    }
                }
            },
        );
    });

    /*PHOTO PERSONNE*/
    $('body').on('click', '.uploadPic', function(event) {
        let button = $(this)
        console.log($(this))
        $('#messageFile').empty()
        var fd = new FormData();
        var files = $('#file')[0].files;
        if (button.is('uploadPicUpdate')) {
            var action = "update"
        } else if (button.is('uploadPicNew')) {
            var action = "updateProfile"
        }
        var src = button.attr('value')

        // Check file selected or not
        if (files.length > 0) {
            fd.append('file', files[0]);
            fd.append('action', action);
            fd.append('src', src);

            $.ajax({
                url: 'API/apiModule.php',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response)
                    if (response != 0) {
                        d = new Date();
                        $(".preview").css("background-image", "url('img/articles/" + response + '?' + d.getTime() + "')")
                        button.attr('value', response)
                    } else {
                        $('#messageFile').html("Le fichier ne s'est pas envoyé")
                    }
                },
            });
        } else {
            $('#messageFile').html("Sélectionnez un fichier SVP");
        }
    });

    /*CONNEXION*/
    //Display 2d block
    $('body').on('click', '#login', function() {
        $('#bloc2').css('display', 'block')
    });

    //Submit connexion
    $('body').on('submit', '#formConnexion', function(event) {
        $('#message').empty();
        event.preventDefault()
        $.post(
            'API/apiModule.php', {
                form: 'connexion',
                login: $('#login').val(),
                password: $('#password').val(),
            },
            function(data) {
                console.log(data);
                let messages = JSON.parse(data);
                for (let message of messages) {
                    if (message === "success") {
                        $("#message").append("<p>Connexion réussie !</p> <a href='compte'>Voir votre profil</a>");
                    } else {
                        $('#message').append("<p>" + message + "</p>");
                    }
                }
            },
        );
    });

    function callform(page) {
        $.get('views/user/' + page + '.php',
            function(data) {
                $('#mainCompte').html(data);
            });
    };
})