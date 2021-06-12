
<div class="container" style='margin-top:70px; text-left;' >
<div style='border: 1px solid black;border-radius: 2%;background-color: lightblue;'>

 <h3 class="font-weight-bold text-center text-uppercase mb-4">Créer une Série</h3>
<form method='POST' action=""  enctype='multipart/form-data' style='margin-left:5px;margin-right:5px;'>
<div class="form-group">
<label for='Nom' style='display:flex;'><h5>Nom de la Serie</h5></label>
<input type='text'name="Nom" class='form-control' placeholder='Ecrit un Nom de Serie'>
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
<label for='description' style='display:flex'><h5>Description</h5></label>
<textarea class='form-control' name='description' placeholder="Decrivez la Serie" onc></textarea>

</div>

<div class='form-group'>
<label for='saison'><h5>Saisons</h5></label>
<input type='number' class='form-control' name='numbersaison' id='inpute'>
</div>
<div class='form-group'>
<label for='datepremiere'><h5>Date de la Première Diffusion</h5></label>
<input type='date' class='form-control' name='datepremiere'>
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

  <?php
if(isset($_POST['valider']))
{
  /*
  $photo = $_FILES['image']['name'];
  $target = "test/Serie/".basename($photo);
    $description=$_POST['description'];
    $nom=$_POST['Nom'];

    $con=Conn();
    $req1="INSERT INTO document(NOM,Photo,Description) VALUES('".$nom."','".$photo."','".$description."')";
    $res1=mysqli_query($con,$req1);
    if($res=mysqli_query($con,$req))
		{
			if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) 
			{///verification que la photo a bien été envoyé//
			$msg = "Image exporter ";
		}
		else{

			$msg = "Failed to upload image";
    }
    echo $msg;
    */
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
    $req4=$con->prepare('INSERT INTO serie VALUES(:id,:date)');
    $req4->BindParam(':id',$id);
     $req4->BindParam(':date',$_POST['datepremiere']);
     $req4->execute();
    }

    ?>
    <script> alert('Coucou'+<?php $id?>);</script>
    <?php


    foreach($_POST['genre'] as $element)
    {
      $req=$con->prepare('INSERT INTO a_plusieurs VALUES(:id,:genre)');
      $req->BindParam(':id',$id);
      $req->BindParam(':genre',$element);
      $req->execute();
    }

  for($i=1;$i<=$_POST['numbersaison'];$i=$i+1){
    $req=$con->prepare('INSERT INTO saison(NO_DOCUMENT,NUMERO) VALUES(:id,:i)');
    $req->BindParam(':id',$id);
    $req->BindParam(':i',$i);
    $req->execute();
  }
  ?>
  <script type="text/javascript">
  document.location.href='index.php?page=Accueil'
  </script>
  <?php

  }

?>
  </div>
</div>


<script type="text/javascript">

//$('#btnsaison').click(function(){
// saison=$('#inpute').val();
// console.log(saison);
// for (let i = 0; i < saison; i++) {

//console.log('1');
//$('#listsaison').append('<div class="form-group"><p>Saison '+(i+1) +' </p><label for="nbepisodes">Nombre d episodes </label><input type="number"name=value[] class="form-control"></div>');
//}
//})

  

       
  



  


</script>
  
