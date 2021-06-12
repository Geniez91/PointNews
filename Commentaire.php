<body style="font-family:Marmelad; font-size: 18px;">
	<form action="" method="POST">   
    <div class="container" style="margin-top:50px; text-left;">
    	 <h3 class="font-weight-bold text-center text-uppercase mb-4">Ajouter Commentaire </h3>
    	 <br>
    	 <div class="form-row">
    	 	<div class="col">
    	 		<label for='LIBELLE'>Commentaire</label>
    	 		<textarea class="form-control"rows='5' placeholder="Commentaire" name='libelle'></textarea>
    	 	</div>	
    	 </div>
    	<div class="form-row">
    		    		<div class="col">
    						<button type='submit' class="btn btn-primary" name="ajout">Valider</button>
    	</div>
    </div>

<?php
if(isset($_POST['ajout']))
{
	if(empty($_POST['libelle']))
	{
		echo"Vous devez renseigner le champs de saisie d'un Commentaire !";
	}
	else
	{
		$id=$_GET['id'];
		$libelle=$_POST['libelle'];
		$user=$_SESSION['id'];
		$con=Conn();
		$req="INSERT INTO commentaire(NO_ARTICLE, LIBELLE, No_Utilisateur) VALUES ('".$id."','".$libelle."','".$user."')";
		$res=mysqli_query($con,$req);
		header("index.php?page=Article&id=".$id."");
	}
}