<?php
$con=Conn();
$id=$_GET['id'];
$req=$con->prepare('SELECT * FROM document,serie WHERE document.NO_DOCUMENT=serie.NO_DOCUMENT AND serie.NO_DOCUMENT=:id');
$req->BindParam(':id',$id);
$req->execute();
$ligne=$req->fetch();
$nom=$ligne['NOM'];
$description=$ligne['Description'];
$photo=$ligne['Photo'];
$dateair=$ligne['Date_Air'];
?>




<body style="font-family:Marmelad; font-size: 18px;">
   
    <div class="container" style="margin-top:50px; text-left;">
	<div style='border: 1px solid black;border-radius: 2%;background-color: lightblue;'>
	<div style='margin-left: 5px; margin-top:5px;margin-right:5px'>
    	 <h3 class="font-weight-bold text-center text-uppercase mb-4">Modifier <?php echo $nom;?> </h3>
<form action=''method='POST' enctype='multipart/form-data'>

  <div class="form-group">
	<label for='Nom'>Nom de la Serie</label>
	<textarea class='form-control' name='Nom'><?php echo $nom?></textarea>
  </div>
   <div class="form-group">
	<label for='description'>Description</label>
<textarea class='form-control'name='description'><?php echo $description?>  </textarea>
  </div>
  <div class="form-group">
<h5>Photo</h5>
<div class="custom-file ">
    <input type="file" id="validatedCustomFile" name="image" value=<?php echo $photo?>>
    <label class="custom-file-label" for="validatedCustomFile" id='l'>
Choisir Fichier
	</label>
  </div>
  </div>
  <div class='form-group'>
  <label for='date'>Date de la Première Diffusion : </label>
  <input type='date' class='form-control' value=<?php echo $dateair?>>
  </div>