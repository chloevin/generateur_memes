<?php
include_once('connexion.php');
//On vérifie que l'utilisateur a bien envoyé les informations demandées
if(isset($_POST["first_name"]) && isset($_POST["last_name"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["password2"])){
	//On vérifie que password et password2 sont identiques
	if($_POST["password"] == $_POST["password2"]){
		//On utilise alors notre fonction password_hash :
		$hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
		//Puis on stock le résultat dans la base de données :
		$query = $pdo->prepare('INSERT INTO users (first_name, last_name, email, password) VALUES(:first_name, :last_name, :email, :password);');
    $query->bindParam(':first_name', $_POST["first_name"]);
    $query->bindParam(':last_name', $_POST["last_name"]);
		$query->bindParam(':email', $_POST["email"]);
		$query->bindParam(':password', $hash);
		$query->execute();
		header('Location: index.php');
		exit();
	}
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
    <link rel="stylesheet" href="assets/css/style_users.css">
</head>

<body>
    <div class="row register-form">
        <div class="col-md-8 offset-md-2">
            <form class="custom-form" method="post" action="inscription.php">
                <h1>Inscription</h1>
                <div class="form-row form-group">
                    <div class="col-sm-4 label-column"><label class="col-form-label" for="name-input-field">Nom </label></div>
                    <div class="col-sm-6 input-column">
                      <input class="form-control" type="text" name="first_name"></div>
                </div>
                <div class="form-row form-group">
                    <div class="col-sm-4 label-column"><label class="col-form-label" for="name-input-field">Prénom </label></div>
                    <div class="col-sm-6 input-column">
                      <input class="form-control" type="text" name="last_name"></div>
                </div>
                <div class="form-row form-group">
                    <div class="col-sm-4 label-column"><label class="col-form-label" for="email-input-field">Email </label></div>
                    <div class="col-sm-6 input-column">
                      <input class="form-control" type="email" name="email"></div>
                </div>
                <div class="form-row form-group">
                    <div class="col-sm-4 label-column"><label class="col-form-label" for="repeat-pawssword-input-field">&nbsp;Mot de passe </label></div>
                    <div class="col-sm-6 input-column">
                      <input class="form-control" type="password" name="password"></div>
                </div>
                <div class="form-row form-group">
                    <div class="col-sm-4 label-column"><label class="col-form-label" for="repeat-pawssword-input-field">&nbsp;Confirmez votre mot de passe </label></div>
                    <div class="col-sm-6 input-column">
                      <input class="form-control" type="password" name="password2"></div>
                </div>
                <br>
                <div class="btn_inscrip">
                  <button class="btn btn-success" >Valider</button>
                  <button class="btn btn-danger btn_valide" type="button">Annuler</button>

                </div>
              </form>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
