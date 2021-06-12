<div class="container" style='margin-top:70px; text-left;' >
<div style='border: 1px solid black;border-radius: 2%;background-color: lightblue;'>
 <h3 class="font-weight-bold text-center text-uppercase mb-4">Créer un Film</h3>
 <form method='POST' action=""  enctype='multipart/form-data' style='margin-left:5px;margin-right:5px;'>
 <div class="form-group">
<label for='Nom' style='display:flex;'><h5>Nom du Film</h5></label>
<input type='text'name="Nom" class='form-control' placeholder='Ecrit un Nom de Film'>
</div>
 <div class='form-group'><h5>Genre de la Serie</h5>
<?php
$con=Conn();
$req=$con->prepare("SELECT * FROM genre");
//$req="SELECT * FROM GENRE";
$req->execute();
//$res=mysqli_query($con,$req);
while($ligne=$req->fetch())
{
    $idgenre=$ligne["No_Genre"];
    $nomtype=$ligne["Nom_Genre"];
    echo'<div class="form-check">';
    echo'<input class="form-check-input" name="genre[]"type="checkbox" id="inlineCheckbox1" value="'.$idgenre.'">';
   echo' <label class="form-check-label" for="inlineCheckbox1">';echo $nomtype;echo"</label>";
   echo"</div>";
}
?>
</div>
<div class="form-group">
<label for='date' style='display:flex;'><h5>Date du Film</h5></label>
<input type='date'name="date" class='form-control'>
</div>
<div class="form-group">
<label for='description' style='display:flex'><h5>Description</h5></label>
<textarea class='form-control' name='description' placeholder="Decrivez la Serie" onc></textarea>

</div>
<div class="form-group">
<label for='duree' style='display:flex;'><h5>Durée du Film (en minutes)</h5></label>
<input type='number'name="duree" class='form-control'>
</div>
<div class="form-group">
<h5>Photo</h5>
<div class="custom-file ">
    <input type="file" id="validatedCustomFile" name="image" required>
    <label class="custom-file-label" for="validatedCustomFile" id='l'>
Choisir Fichier
	</label>
  </div>
  </div>
   <input type='submit' name='valider'>
 </form>

</div>
</div>
<?php 
if(isset($_POST['valider']))
{
$nom=$_POST['Nom'];
$description=$_POST['description'];
$photo = $_FILES['image']['name'];
$genre=$_POST['genre'];
$target = "test/Serie/".basename($photo);
  $req=$con->prepare('INSERT INTO document(NOM,Description,Photo) VALUES (:nom,:description,:image)');
    $req->BindParam(':nom',$nom);
    $req->BindParam(':description',$description);
     $req->BindParam(':image',$photo);

  if($req->execute())
    {
      	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) 
			{///verification que la photo a bien été envoyé//
			$msg = "Image exporter ";
		}
		else{

			$msg = "Failed to upload image";
		}
        $req2=$con->prepare('SELECT LAST_INSERT_ID() AS NO_DOCUMENT;');
    $req2->execute();
    $ligne=$req2->fetch();
    $id=$ligne['NO_DOCUMENT'];
    $req4=$con->prepare('INSERT INTO film VALUES(:id,:temps,:date)');
    $req4->BindParam(':id',$id);
     $req4->BindParam(':date',$_POST['date']);
     $req4->BindParam(':temps',$_POST['duree']);
     $req4->execute();
        
}
 foreach($_POST['genre'] as $element)
    {
      $req=$con->prepare('INSERT INTO a_plusieurs VALUES(:id,:genre)');
      $req->BindParam(':id',$id);
      $req->BindParam(':genre',$element);
      $req->execute();
    }
     ?>
  <script type="text/javascript">
  document.location.href='index.php?page=Accueil'
  </script>
  <?php

  }

?>