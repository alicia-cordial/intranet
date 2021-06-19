<?php



require_once('Database.php');

// Servira à générer le html d'un message.
function printMessage($message) {
	print
		'<div class="message">'
		.	'<span class="utilisateur">'.$message->utilisateur.'</span>'
		.	'<p class="contenu">'.nl2br($message->contenu).'</p>'
		.'</div>';
}

// Si un message est envoyé au script PHP en post, on l'ajoute dans la base de donnée.
// On retourne simplement le html du message au client qui sera traité par le javascript
if (isset($_POST['utilisateur']) && isset($_POST['contenu']) && !empty($_POST['utilisateur']) && !empty($_POST['contenu'])) {
	$message = new stdClass();
	$message->utilisateur = $_SESSION['user']['id'];
	$message->contenu = $_POST['contenu'];
	$query = $this->pdo->prepare("INSERT INTO `message` (utilisateur, contenu, `date`) VALUES ('?, ?, NOW() '");
	mysqli_query($mysqli, $query);
	
	printMessage($message);
	exit;
}
// Sinon, il s'agit uniquement d'une consultation de page, et on affiche la liste.
// Il vaut mieux séparer ces deux tâches en modifiant la cible de l'attribut action du formulaire
else
{
	$messages = array();
	// On boucle sur les 30 derniers messages et on les ajoute au tableau
	$result = mysqli_query($mysqli, "SELECT * FROM messages ORDER BY posted DESC LIMIT 30");
	if($result) {
		while($message = mysqli_fetch_object($result)) {
			$messages[] = $message;
		}
	}
?>
<html>
	<head>
		<title>Démo AJAX</title>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script type="text/javascript">
			$(function() {
				// Lorsque le formulaire est validé, on intercepte le clic...
				$('#messagerie form').submit(function() {
					// On récupère les données du formulaire
					var author = $('#messagerie #author').val();
					var body = $('#messagerie #body').val();
					// On simule l'envoi des données en AJAX et on récupère la réponse.
					$.ajax({
						type: "POST",
						// Ici, on pourrait utiliser un script spécial pour ne retourner qu'un extrait html.
						// Mais on le fait déjà en supposant que le script fonctionnera toujours.
						url: "ajax.php",
						data: 'author=' + author + '&body=' + body,
						// Une réponse déclenchera l'ajout du html dans la page
						success: function(data) {
							$('#messages').prepend(data);
							$('#nopost').hide(); // peut avoir besoin d'un test avant.
						}
					});
					// On retourne false pour bloquer la soumission normale du formulaire
					return false;
				});
			});
		</script>
		<style type="text/css">
			input, textarea { display:block; }
			#messagerie { width: 280px; float:left;}
			#messages { padding-left: 300px;}
			#messages .author { font-weight: bold; }
			#messages .body {font-style: italic; }
		</style>
	</head>
	<body>
		<h1>Messagerie</h1>
		<?php print ( empty($messages) ) ? '<p id="nopost">Aucun message !</p>' :''; ?>
		<div id="messagerie">
			<?php // Ici le formulaire sera traité par le même script. ?>
			<form action="ajax.php">
				<label for="author">Auteur :</label><input type="text" id="author" size="20" />
				<label for="body">Message :</label><textarea id="body" cols="30" rows="7"></textarea>
				<input type="submit" value="Envoyer" />
			</form>
		</div>
		<div id="messages">
			<?php
			// On génère le html des messages.
			foreach($messages as $message) {
				printMessage($message);
			}
			?>
		</div>
	</body>
</html>
<?php
}

// Fermeture de connexion à la BDD
mysqli_close($mysqli);
?>