function sleep(milliseconds) {
    const date = Date.now();
    let currentDate = null;
    do {
        currentDate = Date.now();
    } while (currentDate - date < milliseconds);
} //horaire auto

$(function() {

    $("#todo_list > li").draggable({ // Les éléments de la liste sont déplaçables
        revert: "invalid" // s'ils ne sont pas placés dans un élément droppable, ils retournent à leur position initiale
    });
    $("#container_done").droppable({ // Le container de la liste terminée peut recevoir des éléments déplacés
        drop: function(event, ui) {

            // 1) fait une requête AJAX vers un script PHP qui marque la tâche terminée
            $.ajax({
                url: 'API/apiTdl.php', // La ressource ciblée
                type: 'POST',
                data: {
                    // on stocke dans la variable id_tache la valeur de l'attribut "id" des éléments draggable
                    // et cette variable sera envoyée au fichier tache_terminee.php
                    id_tache: ui.draggable.attr("id")
                }
            });
            sleep(20);
            // 2) télécharge la liste terminée et ajoute le code HTML nécessaire
            $.ajax({
                url: 'API/apiTdl.php',
                type: 'POST',
                data: {
                    id_tache: ui.draggable.attr("id")
                },
                success: function(resultat) {
                    // on stocke dans data le résultat de la requête contenue dans affichage_tache.php
                    // on utilise parseJSON pour convertir la string obtenue grâce à la requête en objet javaScript
                    var data = $.parseJSON(resultat);
                    // on ajoute à la liste des tâche terminées les éléments de la liste avec le bon id
                    $("#done_list").append('<li id="' + data.id + '" class="tache_finie"><div><p class="name_task">' + data.name + '</p>  <p class="date_task">' + data.date_finish + '</p></div><div><p><i class="fas fa-times"></i></p></div></li>');
                    // icone supprimer
                    $(".fa-times").click(function() {
                        $.ajax({
                            url: 'API/apiTdl.php', // La ressource ciblée
                            type: 'POST',
                            data: {
                                id_tache: $(this).closest('li').attr('id') // l'id_tache est l'élément le plus proche de l'attribut de id dans le DOM
                            }
                        });

                        $(this).closest('li').remove();

                    })
                    $('li').click(function(e) {

                        $.ajax({
                            url: 'API/apiTdl.php',
                            type: 'POST',
                            data: {
                                id_tache: $(e.currentTarget).attr("id")
                            },
                            success: function(resultat) {
                                var data = $.parseJSON(resultat);
                                $("#name_task_modif").val(data.name);
                                $("#id_tache").val(data.id);
                            }
                        })

                        $("#form_modif").modal();

                    })
                }
            })

            ui.draggable.remove()
        }
    });

    $("#add_btn_task").click(function() {
        $("#add_btn_task").addClass("hidden");
        $("#form_ajout").removeClass("hidden");
    })

    // creation de tâches

    $("#form_ajout").submit(function(e) {
        e.preventDefault();
        // 1 : création de la tâche
        $.ajax({
            url: 'API/apiTdl.php', // La ressource ciblée
            type: 'POST',
            data: {
                user_id: $('meta[name=user]').attr("content"),
                texte_tache: $("#name_task").val()
            },
            success: function(resultat) {
                console.log(resultat);
                $.ajax({
                    url: 'API/apiTdl.php',
                    type: 'POST',
                    data: {
                        id_tache: resultat
                    },
                    success: function(resultat) {
                        var data = $.parseJSON(resultat);
                        $("#todo_list").append('<li id=' + data.id + '><p class="name_task">' + data.name + '</p><p class="date_task">' + data.date_creation + '</p></li>');
                        $("#todo_list > li").draggable({
                            revert: "invalid"
                        });
                        // Update des tasks

                        $('li').click(function(e) {

                            $.ajax({
                                url: 'API/apiTdl.php',
                                type: 'POST',
                                data: {
                                    id_tache: $(e.currentTarget).attr("id")
                                },
                                success: function(resultat) {
                                    var data = $.parseJSON(resultat);
                                    $("#name_task_modif").val(data.name);
                                    $("#id_tache").val(data.id);
                                }
                            })

                            $("#form_modif").modal();

                        })
                    }
                })
            }
        });

        // vidage du formulaire et retour du bouton
        $("#add_btn_task").removeClass("hidden");
        $("#form_ajout").addClass("hidden");
        $("#name_task").val("");



    })

    // icone de suppression
    $(".fa-times").click(function() {
        $.ajax({
            url: 'API/apiTdl.php', // La ressource ciblée
            type: 'POST',
            data: {
                id_tache: $(this).closest('li').attr('id')
            }
        });

        $(this).closest('li').remove();

    })

    $('li').click(function(e) {

        $.ajax({
            url: 'API/apiTdl.php',
            type: 'POST',
            data: {
                id_tache: $(e.currentTarget).attr("id")
            },
            success: function(resultat) {
                var data = $.parseJSON(resultat);
                $("#name_task_modif").val(data.name);
                $("#id_tache").val(data.id);
            }
        })

        $("#form_modif").modal();

    })

    $('#form_modif').submit(function(e) {
        e.preventDefault();
        $.modal.close();

        $.ajax({
            url: 'API/apiTdl.php',
            type: 'POST',
            data: {
                id_tache: $("#id_tache").val(),
                name: $("#name_task_modif").val()
            },
            success: function(id) {
                $("#" + id).children(".name_task").text($("#name_task_modif").val())
            }
        })

    });


})