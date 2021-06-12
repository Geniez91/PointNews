
 <body style="font-family:Marmelad; font-size: 18px;">
   
    <div class="container" style="margin-top:50px; text-align:center;">
    <div style='border: 1px solid black;border-radius: 5%;background-color: lightblue;'>
    <div style='margin-left: 5px; margin-top:5px'>
       <h3 class="font-weight-bold text-center text-uppercase mb-4">Ajout d'article</h3>
	<form action="" method="POST" enctype="multipart/form-data">
  <div class='form-group'> 
     <label for='theme'>
     Article sur
     </label>
     <select name='theme'class='form-control'>
     <option value='0'>Serie</option>
     <option value='1'>Film</option>
     </select>
     </div>

     <button class='btn btn-success' name='test'>
     
     Valider
     </button>
     </form>
   
<?php
if(isset($_POST['test'])&& !isset($_POST['envoyer']))
{
  $theme=$_POST['theme'];
  
  if($theme==1)
  {
    $con=Conn();
    $req=$con->prepare('SELECT document.NO_DOCUMENT AS NO_DOCUMENT,NOM FROM document,film WHERE document.NO_DOCUMENT=film.NO_DOCUMENT ORDER BY NOM ASC ');
    $req->execute();
    echo' <form action="" method="POST" enctype="multipart/form-data">';
    echo"<div class='form-group' style='margin-top:10px;>";
    echo "<label for='film'>Nom du Film</label>";
    echo "<select name='film' class='form-control' style='margin-top:10px;'>";
    
    while($ligne=$req->fetch()){
      $id=$ligne['NO_DOCUMENT'];
      $nom=$ligne['NOM'];
      echo "<option value='$id'>$nom</option>";
    }

   echo" </select>";
    
    
  }
  else
  {
   $con=Conn();
    $req=$con->prepare('SELECT document.NO_DOCUMENT AS NO_DOCUMENT,NOM FROM document,serie WHERE document.NO_DOCUMENT=serie.NO_DOCUMENT ORDER BY NOM ASC');
    $req->execute();
   echo' <form action="" method="POST" enctype="multipart/form-data">';
    echo"<div class='form-group' style='margin-top:10px;>";
    echo "<label for='film'>Nom de la Série</label>";
    echo "<select name='film' class='form-control' '>";
    
    while($ligne=$req->fetch()){
      $id=$ligne['NO_DOCUMENT'];
      $nom=$ligne['NOM'];
      echo "<option value='$id'>$nom</option>";
    }

   echo" </select>";
  echo" </div>";
  }


}
?>

  <div class="form-group">
      <label for="type"> <i class="fas fa-book-open"></i> Type</label>
      <?php
        $con=Conn();
        ///requete qui affiche les informations de la table Type_Article
        $req2=$con->prepare('SELECT * FROM type_article');
 // $req2="SELECT * FROM Type_Article";
 $req2->execute();
//  $res2=mysqli_query($con,$req2);
  echo "<select name='type' class='form-control'>";
  while ($ligne2=$req2->fetch()) {//boucle qui parcourt les enregistrements
    $idtype=$ligne2['No_Type_Art'];
    $nomtype=$ligne2['Nom'];    

    echo"<option value='".$idtype."'>";echo $nomtype;
    echo"</option>";

  }
  echo "</select>";
  ?>
      
    </div>
   </div>
	<div class="form-group">
    	<label for="Login"> <i class="fas fa-book-open"></i> Titre</label>
    	<input type="texte" class="form-control" name="titre" id="Login" placeholder="Entrez Ici le Titre"  class="form-control">
   	</div>
   Description<br>
   <div class="form-group">

   	<textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="description" placeholder="Decrivez en quelques les sujets principaux de votre article"></textarea>
   </div>
   <div class="form-group"><i class="fas fa-align-left"></i>
Texte
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name="saisie" placeholder="Inserer ici le texte de votre article"></textarea>
   </div>
   <div class="form-group">

   		<label for="photo"><i class="fas fa-camera"></i> Photo(Image pour mettre en avant l'article)</label>
    <input type="file" class="form-control-file" id="photo" name="photo">
  </div>


  		<button type="submit" class="btn btn-primary" name="envoyer"> <i class="fas fa-envelope"></i> Envoyer</button>
  		<?php	AjoutArticle();	
?>
   </div>


 	</form>
   </div>
</div>
</div>

