<body style="font-family:Marmelad; font-size: 18px;">
   
    <div class="container" style="margin-top:50px; text-left;">
	<div style='border: 1px solid black;border-radius: 2%;background-color: lightblue;'>
	<div style='margin-left: 5px; margin-top:5px;margin-right:5px'>
    	 <h3 class="font-weight-bold text-center text-uppercase mb-4">Ajout d'un Type d'Article</h3>
    	 <br>
    	 <form 	action=''method='POST'>
    	 	<div class="form-row">
    	 		<div class="col">
    	 			<label for='libelle'>Libelle</label>
    	 			<input type="text" name="libelle" class="form-control" placeholder="Libelle">
    	 		</div>
    	 </div>
    	 <br>
    	 <div class="form-row">
    	 	<div class="col">
    	 		<button type='submit' class='btn btn-primary'onclick="return confirm('Voulez vous vraiment ajout ce nouveau type d Article') "name='ajout'>Ajouter </button>
    	 	</div>
			 </div>
			 </div>
    	 </div>
    	 <?php
    	 if(isset($_POST['ajout']))//Verifie le boutton ajouttype a été appuyé//
    	 {
    	 	$libelle=$_POST['libelle'];
    	 	$con=Conn();
			$req=$con->prepare("INSERT INTO type_article VALUES (NULL,:libelle)");
			$req->BindParam(':libelle',$libelle);
    	 	//$req="INSERT INTO Type_Article VALUES (NULL,'".$libelle."')";//requete d'insetion d'un type d'article
    	 	$req->execute();
			// $res=mysqli_query($con,$req);
			?>
			<script>
			document.location.href='index.php?page=typearticle'
			</script>
			<?php
    	 	header("Location:index.php?page=typearticle");
    	 }