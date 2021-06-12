<?php
$id=$_GET['id'];
$con=Conn();
$req=$con->prepare('SELECT * FROM document,film WHERE document.NO_DOCUMENT=film.NO_DOCUMENT AND film.NO_DOCUMENT=:id');
$req->BindParam(':id',$id);
$req->execute();
$ligne=$req->fetch();
$nom=$ligne['NOM'];
$description=$ligne['Description'];
$date=$ligne['Date'];
$temps=$ligne['TEMPS'];
$photo=$ligne['Photo'];

?>


<body style="font-family:Marmelad; font-size: 18px;">
   
    <div class="container" style="margin-top:50px; text-left;">
	<div style='border: 1px solid black;border-radius: 2%;background-color: lightblue;'>
	<div style='margin-left: 5px; margin-top:5px;margin-right:5px'>
    	 <h3 class="font-weight-bold text-center text-uppercase mb-4">Modifier  <?php  echo $nom;?> </h3>
<form action=''method='POST' enctype='multipart/form-data'>

  <div class="form-group">
	<label for='Nom'>Nom du Film</label>
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
   <div class="form-group">
	<label for='date'>Date</label>
	<input type='date' class='form-control' name='date' value=<?php echo $date?> >
  </div>
  <div class="form-group">
	<label for='temps'>Temps</label>
	<input type='number' class='form-control' name='temps' value=<?php echo $temps?>>
  </div>
  <div class="form-row">
	<div class="col">
		<button type="submit" class="btn btn-warning"name='Modifier' onclick="return confirm('Voulez vous vraiment modifier cette saison ?')"><i class="fas fa-edit"></i> Modifier</button>
	</div>
	</div>

	<?php 
	if(isset($_POST['Modifier']))
	{
		
		  $photo = $_FILES['image']['name'];

		  if($photo!=null)
		  {
			    $target = "test/Serie/".basename($photo);
		$req=$con->prepare('UPDATE DOCUMENT SET NOM=:nom,Description=:description,Photo=:photo WHERE NO_DOCUMENT=:id');
		$req->BindParam(':nom',$_POST['Nom']);
		$req->BindParam(':description',$_POST['description']);
		$req->BindParam(':photo',$photo);
		$req->BindParam(':id',$_GET['id']);
		   if($req->execute())
    {
      	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) 
			{///verification que la photo a bien été envoyé//
			$msg = "Image exporter ";
		}
		else{

			$msg = "Failed to upload image";
		}
		  }
		 $req2=$con->prepare('UPDATE FILM SET TEMPS=:temps,Date=:date WHERE NO_DOCUMENT=:id') ;
		 $req2->BindParam(':temps',$_POST['temps']);
		  $req2->BindParam(':date',$_POST['date']);
		   $req2->BindParam(':id',$_GET['id']);
		   $req2->execute();
		   ?>
		   <script>
		   document.location.href='index.php?page=unFilm&id=<?php echo $_GET['id']?>';
		   </script>
		   <?php

		}
		else
		{
			$req=$con->prepare('UPDATE DOCUMENT SET NOM=:nom,Description=:description WHERE NO_DOCUMENT=:id');
		$req->BindParam(':nom',$_POST['Nom']);
		$req->BindParam(':description',$_POST['description']);
		$req->BindParam(':id',$_GET['id']);
		$req->execute();
		 $req2=$con->prepare('UPDATE FILM SET TEMPS=:temps,Date=:date WHERE NO_DOCUMENT=:id') ;
		 $req2->BindParam(':temps',$_POST['temps']);
		  $req2->BindParam(':date',$_POST['date']);
		   $req2->BindParam(':id',$_GET['id']);
		   $req2->execute();
		     ?>
		   <script>
		   document.location.href='index.php?page=unFilm&id=<?php echo $_GET['id']?>';
		   </script>
		   <?php
		}
       
	
}

