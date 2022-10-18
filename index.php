<?php
    include_once('connexion.php');
    //Nous vérifions que l'utilisateur a bien envoyé les informations demandées
if(isset($_POST["email"]) && isset($_POST["password"])){
	//Nous allons demander le hash pour cet utilisateur à notre base de données :
	$query = $pdo->prepare('SELECT password FROM users WHERE email = :email');
	$query->bindParam(':email', $_POST["email"]);
	$query->execute();
	$result = $query->fetch();
	$hash = $result[0];

	//Nous vérifions si le mot de passe utilisé correspond bien à ce hash à l'aide de password_verify :
	$correctPassword = password_verify($_POST["password"], $hash);

	if($correctPassword){
		//Si oui nous accueillons l'utilisateur identifié
	     header('Location:creation.html');
	}else {
    //  echo "login/pass incorect..";
  }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Générateur de mêmes</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.min.css">
</head>

<body>
    <form method="post" action="index.php" id="form" style="font-family:Quicksand, sans-serif;background-color:rgba(44,40,52,0.73);width:320px;padding:40px;">
        <h1 id="head" style="color:rgb(193,166,83);">Générateur de même</h1>
        <div class="form-group">
          <input class="form-control" name="email" type="email" id="formum" placeholder="Email">
          <span id="eremail"></span>
        </div>
        <div class="form-group">
          <input class="form-control" name="password" type="password" id="formum2" placeholder="Mot de passe"></div>
          <span id="erepass"></span>
        <button class="btn btn-light" name="bouton"  id="butonas"  style="width:100%;height:100%;margin-bottom:10px;background-color:rgb(106,176,209);" onclick="validation();" >
          Connexion</button>
        <a href="inscription.php" id="linkas" style="font-size:12px;margin:auto;margin-left:0;margin-right:0;margin-bottom:0;margin-top:0;padding-left:0;padding-right:0;color:rgb(177,151,70);">
          Inscription</a>
    </form>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script>
        function validation()
        {
      var email=document.getElementById('formum');
      var pass=document.getElementById('formum2');
      var afficher='veuillez remplir \n';


            if(email.value=='')
            {
                afficher+="votre email svp \n";
                document.getElementById('formum');
                document.getElementById('eremail').innerHTML="champs vide";
            }
            if(pass.value=='')
            {
                afficher+=" votre Password svp \n";
                document.getElementById('formum2');
                document.getElementById('erepass').innerHTML="champs vide";
            }
        }

    </script>
</body>

</html>
