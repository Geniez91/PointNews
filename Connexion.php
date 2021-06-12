
<center>
	<br>
	<br>
	<br>
<div class="container-fluid	" >
	<div style='border: 1px solid black;border-radius: 10px;background-color: lightblue;'>
	<div style='margin-left: 5px; margin-top:5px;margin-right:5px;margin-bottom:5px'>
 <div class="form-group col-lg-6">
 	<form action="" method="POST">
   
    <label for="Login">Votre Login</label>
    <input type="texte" class="form-control" id="Login1" aria-describedby="emailHelp" placeholder="Entrez Votre Login" name="login">
    <small id="login" class="form-text text-muted">Ne jamais partagez son Login a n'importe qui</small>
 </div>
 <div class="form-group col-lg-6">
    <label for="MotPasse">Mot de Passe</label>
    <input type="password" class="form-control" id="mdp" placeholder="Entrez Votre Mot de Passe" name="mdp">
  </div>
 <button type="submit" class="btn btn-success" name="connexion" >Valider</button>
 <a type="submit" class="btn btn-warning" name="inscription" href="index.php?page=inscription">S'inscrire</a>
 </center>
</div>
</div>
</div>
</div>
<?php SeConnecter();
?>