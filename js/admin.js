$(document).ready(function() {
    //
    $('body').on('click', '.navUser', function() {
        $('#sectionUser').empty();

        if ($(this).is('#navUsers')) {
            callSectionUser('adminUsers')
        }
    })


    $('body').on('click', '.showUsers', function() {
        let choice = $(this).attr('value');
        $('#listeUsersTries').empty()
        console.log(choice)
        $.post(
            'API/apiAdmin.php', {
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

                        $('#listeUsersTries').append("<tr value='" + user.identifiant + "' id='" + user.id + "'><td class='utilisateurs'>" + user.identifiant + "</td><td><button class='deleteUser'>Supprimer</button></td></tr>")

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

})

/*FUNCTIONS*/
function callSectionUser(page) {
    $.get('views/user/' + page + '.php',
        function(data) {
            $('#sectionVendeur').html(data);
        });
}