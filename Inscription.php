<center>
<script type="text/javascript">
    $(document).ready(function() {
    $('input[type="file"]').change(function(e) {
        var file = e.target.files[0].name;
		const l=document.getElementById("l");
		l.innerHTML=file;
       
    });
});
    </script>
	<br>
<div class="container" >
	<div style='border: 1px solid black;border-radius: 2%;background-color: lightblue;'>
	<div style='margin-left: 5px; margin-top:5px;margin-right:5px'>
	<form action="" method="POST" enctype="multipart/form-data">
	<div class="form-group">
    <label for="Login">Votre Login</label>
    <input type="texte" class="form-control" id="Login" placeholder="Entrez Ici votre Login" name="login">
   	</div>
   	<div class="form-group">
    <label for="MotdePasse">Votre Mot de Passe</label>
    <input type="password" class="form-control" id="mdp" placeholder="Entrez Ici votre Mot de Passe" name="mdp">
   	</div>
   	<div class="form-group">
    <label for="Nom">Votre Nom</label>
    <input type="text" class="form-control" id="nom" placeholder="Entrez Ici votre Nom" name="nom">
   	</div>
   	<div class="form-group">
    <label for="Nom">Votre Prenom</label>
    <input type="text" class="form-control" id="prenom" placeholder="Entrez Ici votre Prenom"name="prenom">
   	</div>
   	<div class="form-group">
    <label for="date">Votre Date de Naissance</label>
    <input type="date" class="form-control" id="datenaiss" placeholder="Entrez ici Votre date de Naissance" name="datenaiss">
   	</div>
   	<div class="form-group">
    <label for="date">Votre Email</label>
    <input type="mail" class="form-control" id="email" placeholder="Entrez ici votre Mail" name="email">
   	</div>
	   <div class="form-group">
	   Photo de Profil
	   
	   <div class="custom-file ">
    <input type="file" class="custom-file-input" id="validatedCustomFile" name="image"required>
    <label class="custom-file-label" for="validatedCustomFile" id='l'name>
Choisir Fichier
	</label>
  </div>
  </div>

  
	
   	<button type="submit" class="btn btn-success" name="inscription" text-a>Valider</button>


<?php
TraitementInscription();
?>

   </form>
   </div>
   </div>
