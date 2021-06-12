<body style="font-family:Marmelad; font-size: 18px;">
   
    <div class="container" style="margin-top:50px; text-left;">
	<div style='border: 1px solid black;border-radius: 2%;background-color: lightblue;'>
	<div style='margin-left: 5px; margin-top:5px;margin-right:5px'>
    	 <h3 class="font-weight-bold text-center text-uppercase mb-4">Ajout d'un Episode</h3>
    	 <br>
    	 <form 	action=''method='POST'>
    	 	<div class="form-row">
    	 		<div class="col">
    	 			<label for='nom'>Nom</label>
    	 			<input type="text" name="nom" placeholder="Nom" class="form-control">
    	 		</div>
    	 	</div>
             <div class="form-row">
    	 		<div class="col">
    	 			<label for='temps'>Temps</label>
    	 			<input type="number" name="temps" placeholder="Temps de l episode" class="form-control">
    	 		</div>
    	 	</div>
    	 	<br>
    	 	<div class="form-row">
    	 		<div class="col">
    	 			<button type='submit' name='ajoutepisode' class='btn btn-primary'>Ajouter</button>
    	 		</div>
				 </div>
				 </div>
    	 	</div>

<?php 

if(isset($_POST['ajoutepisode']))
{
       $nosaison=$_GET['nosaison'];
       $con=Conn();
    $req1=$con->prepare('SELECT MAX(NUMERO_EP) AS NB_MAX FROM saison WHERE NO_SAISON=:nosaison');
$req1->BindParam(':nosaison',$nosaison);
$req1->execute();
$ligne1=$req1->fetch();
$maxnumero=$ligne1['NB_MAX'];
 $maxnumero1=$maxnumero+2;


    $nom=$_POST['nom'];
    $temps=$_POST['temps'];
 
    $con=Conn();
    $req=$con->prepare('INSERT INTO episodes(NO_SAISON, NOM_EPISODE, TEMPS,NUMERO_EP) VALUES (:nosaison,:nom,:temps,:numero)');
    $req->BindParam(':nosaison',$nosaison);
    $req->BindParam(':nom',$nom);
    $req->BindParam(':temps',$temps);
     $req->BindParam(':numero',$maxnumero1);
    $req->execute();
    $id=$_GET['idserie'];
    ?>
     <script>
     document.location.href='index.php?page=uneserie&id=<?php echo $id;?>'
     </script>
   
     <?php
}