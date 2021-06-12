<body style="font-family:Marmelad; font-size: 18px;">
   
    <div class="container" style="margin-top:50px; text-left;">
	<div style='border: 1px solid black;border-radius: 2%;background-color: lightblue;'>
	<div style='margin-left: 5px; margin-top:5px;margin-right:5px'>
    	 <h3 class="font-weight-bold text-center text-uppercase mb-4">Ajout d'un Type de Compte</h3>
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
                    <button type='submit'name='ajouttype'class='btn btn-primary'><i class="fas fa-plus"></i> Ajouter</button>
                </div>
				</div>
				</div>
            </div>
    	 	<?php
            if(isset($_POST['ajouttype']))//Verifie le boutton ajouttype a été appuyé//
            {
    	 	$con=Conn();
    	 	$libelle=$_POST['libelle'];
			 $req=$con->prepare('INSERT INTO type_utilisateur(libelle) VALUES (:libelle)');
			 $req->BindParam(':libelle',$libelle);
    	 	//$req="INSERT INTO type_utilisateur(libelle) VALUES ('".$libelle."')";//requete d'insertion d'un type d'utilisateur//
    	 	$req->execute();
			 $res=mysqli_query($con,$req);
			 ?>
            <script>document.location.href='index.php?page=type'</script>
			<?php
            }