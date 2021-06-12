<?php
$con=Conn();

?>


<body style="font-family:Marmelad; font-size: 18px;">
   
    <div class="container" style="margin-top:50px; text-left;">
	<div style='border: 1px solid black;border-radius: 2%;background-color: lightblue;'>
	<div style='margin-left: 5px; margin-top:5px;margin-right:5px'>
    	 <h3 class="font-weight-bold text-center text-uppercase mb-4">Modifier Saison <?php  echo $_GET['numero'];?> </h3>
<form action=''method='POST' enctype='multipart/form-data'>
	<div class="form-group">
<h5>Photo</h5>
<div class="custom-file ">
    <input type="file" id="validatedCustomFile" name="image" required>
    <label class="custom-file-label" for="validatedCustomFile" id='l'>
Choisir Fichier
	</label>
  </div>
  </div>
<div class="form-row">
	<div class="col">
		<button type="submit" class="btn btn-warning"name='Modifier' onclick="return confirm('Voulez vous vraiment modifier cette saison ?')">Modifier</button>
	</div>
	</div>

    <?php 
    if(isset($_POST['Modifier']))
    {
        $photo = $_FILES['image']['name'];
         $target = "test/Serie/Saison/".basename($photo);
        $req=$con->prepare('UPDATE saison SET PhotoSaison=:photo WHERE NO_SAISON=:nosaison');
        $req->BindParam(':photo',$photo);
        $req->BindParam(':nosaison',$_GET['id']);
        if($req->execute())
    {
      	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) 
			{///verification que la photo a bien été envoyé//
			$msg = "Image exporter ";
		}
		else{

			$msg = "Failed to upload image";
		}
        ?>
        <script>
        document.location.href='index.php?page=uneserie&id=<?php echo $_GET["serie"];?>';
        
        </script>
     <?php
    }
}

