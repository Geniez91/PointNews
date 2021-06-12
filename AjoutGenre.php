<body style="font-family:Marmelad; font-size: 18px;">
   
    <div class="container" style="margin-top:50px; text-left;">
	<div style='border: 1px solid black;border-radius: 2%;background-color: lightblue;'>
	<div style='margin-left: 5px; margin-top:5px;margin-right:5px'>
    	 <h3 class="font-weight-bold text-center text-uppercase mb-4">Ajout d'un Genre</h3>
    	 <br>
    	 <form 	action=''method='POST'>
    	 	<div class="form-row">
    	 		<div class="col">
    	 			<label for='nom'>Nom</label>
    	 			<input type="text" name="nom" placeholder="Nom" class="form-control">
    	 		</div>
    	 	</div>
    	 	<br>
    	 	<div class="form-row">
    	 		<div class="col">
    	 			<button type='submit' name='ajout' class='btn btn-primary'>Ajouter</button>
    	 		</div>
				 </div>
				 </div>
    	 	</div>

   <?php
   if(isset($_POST['ajout']))//Verifie le boutton ajout a été appuyé//
   {
   	$con=Conn();
   	$nom=$_POST['nom'];
	$req=$con->prepare("INSERT INTO genre VALUES(NULL,:nom)");
	$req->BindParam(':nom',$nom);
   	//$req="INSERT INTO Genre VALUES(NULL,'".$nom."')";//Requete d'insertion d'un genre//
	   $req->execute();
   //	$res=mysqli_query($con,$req);
   ?>
   <script>
   document.location.href='index.php?page=genre'
   </script>
   <?php
   	header("Location:index.php?page=genre");
   }