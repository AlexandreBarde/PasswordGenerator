<!DOCTYPE html>
<html>
	<head>
		<title>Générateur de mot de passe</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>
	<body>
		<h1 class="header center orange-text">Taille du mot de passe : <span id="size_pwd">10</span></h1>
		<form action="" method="post">
			<input type="range" min="5" max="25" step="1" value="10" name="size" onchange="document.getElementById('size_pwd').innerHTML = this.value;"/> 
			<button class="btn waves-effect waves-light orange" type="submit" name="submit" value="Générer">Générer<i class="material-icons right">send</i></button>
		</form>
		<?php
			if(!empty($_POST[submit])){
				if(isset($_POST['size'])){
					$size = $_POST['size'];
					if($size < 5 || $size > 25){ //Modification du code par l'utilisateur
						echo "<p>Erreur lors de la génération du mot de passe</p>";
					}else{
						if(ctype_digit($size)){ //Vérifier si c'est bien un int

							unset($_COOKIE['size']);
							setcookie('size', $size, (time() + 3600));

							//Quelques caractères sympatique
							$chars='abcdefghijklmnopqrstuvwxyz0123456789&%!)(-[]}=+';

							//Mélange de la variable $chars
							$pwd = str_shuffle($chars);

							//On garde que x caractères
							$pwd = substr($pwd, 0, $size);

							//Mettre en majuscule 
							for($i = 0; $i < strlen($pwd); $i++){ //
								$rand = rand(0, 1);
								if($rand == 0){
									$pwd{$i} = strtoupper($pwd{$i});
								}
							}

							//Affichage du MDP
							echo "<p id='pwd' class='header col s12 light'  >" . $pwd . "</p>";

						}else{
							echo "<p>Erreur lors de la génération du mot de passe</p>";
						}
					}
				}
			}
		?>
		<footer class="page-footer orange">
			<div class="container">
				<div class="row">
					<div class="col l12 s12">
						<h5 class="white-text">Génération de mot de passe</h5>
						<p class="grey-text text-lighten-4">Script qui permet de générer un mot de passe.</p>
					</div>
				</div>
			</div>
			<div class="footer-copyright">
				<div class="container">Fait avec le <a class="orange-text text-lighten-3" href="/lol">♥</a></div>
			</div>
		</footer>
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="js/materialize.min.js"></script>
	</body>
</html>