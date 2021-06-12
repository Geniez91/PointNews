<body style="font-family:Marmelad; font-size: 18px;">
   
    <div class="container" style="margin-top:50px; text-left;">
       <h3 class="font-weight-bold text-center text-uppercase mb-4">Profil</h3>
	   <center>
	<div class="list-group col-lg-6">
	<form action="" method="POST">
	<center>
	<div class="card mb-3" style="max-width: 540px;">
	<?php 
$con=Conn();
$id=$_SESSION['id'];
$req=$con->prepare("SELECT *,DATE_FORMAT(DATENAISS, '%e/%m/%Y') AS DATEMODIF FROM utilisateur WHERE NO_UTILISATEUR=:id");
$req->BindParam(':id',$id);
//$req="SELECT *,DATE_FORMAT(DATENAISS, '%e/%m/%Y') AS DATEMODIF FROM utilisateur WHERE NO_UTILISATEUR='".$id."'";
$req->execute();
//$res=mysqli_query($con,$req);
$ligne=$req->fetch();
$login=$ligne['LOGIN'];
$MDP=$ligne['MDP'];
$NOM=$ligne['NOM'];
$PRENOM=$ligne['PRENOM'];
$DATENAISS =$ligne['DATEMODIF'];
$EMAIL=$ligne['EMAIL'];
$photo=$ligne['Photo'];
?><div class="row no-gutters">
<div class="col-12">
<?php
echo "<img class='img-fluid img-thumbnail'src='test/Profil/".$photo. "'>";
  ?>
  </div>
  <div class="col">
  <div class="card-body">
    <h3 class="card-title"><?php echo $PRENOM;echo "&nbsp";echo $NOM ;?></h3>
    <p class="card-text"> <b>Mes Information Personnelles :</b></p>
	<p class="card-text">Login : <?php echo $login;?>
	<p class="card-text"><i class="fas fa-lock"></i> <?php echo $MDP;?>
	<p class="card-text"><i class="fas fa-envelope-open"></i> <?php echo $ligne['EMAIL'];?>
	<p class="card-text">Date de Naissance : <?php echo $DATENAISS;?>
	<p class="card-text">
	<a type="submit" class="btn btn-warning	" id="t1"><i class="fas fa-edit"></i> Modifier</a>
  </div>
</div>
		

	
	</form>
	
	
</div>
</div>
<div class="list-group col-lg-6" id="d1" style="display:none">
	Modifier
	<form action=""method="POST">
	<div class="form-group">
				<label for='mdp'> Mot de Passe</label>
				<input type="password" name="mdp">
	</div>
	<div class="form-group">		
			<label for='nom'><i class='fas fa-user'></i> Nom</label>
				<input type="texte" name="nom">
			</div>
	<div class="form-group">
				<label for='prenom'><i class='fas fa-user'></i> Prenom </label>
				<input type="texte" name="prenom">
		</div>
		<div class="form-group">
				<label for='mail'> <i class='fas fa-envelope-open'></i> Email</label>
				<input type="mail" name="mail">
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-outline-success" name="traitementmodif">Valider <i class="fas fa-check"></i> </button>
			</div>
			<?php Traitementmodif();
			?>
		</form>
	</div>	

	
<script src="script.js">

</script>