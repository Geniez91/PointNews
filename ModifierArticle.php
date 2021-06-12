<?php
$con=Conn();
//Requete d'affichage modification article
$req=$con->prepare('SELECT * FROM article WHERE article.NO_ARTICLE=:id');
$req->BindParam(':id',$_GET['id']);
//$req="SELECT * FROM article WHERE article.NO_ARTICLE='".$_GET['id']."'";
$req->execute();
$ligne=$req->fetch();
//$ligne=mysqli_fetch_array($res);
?>
<body style="font-family:Marmelad; font-size: 18px;">
   
    <div class="container" style="margin-top:50px; text-left;">
	<div style='border: 1px solid black;border-radius: 2%;background-color: lightblue;'>
	<div style='margin-left: 5px; margin-top:5px;margin-right:5px'>
    	 <h3 class="font-weight-bold text-center text-uppercase mb-4">Modifier Article</h3>
<form action=''method='POST'>
    	 <div class='form-row'>
    	 	<div class="col">
    	 		<label for='nom'>Nom</label>
    	 		<?php echo"<input type='text' name='nom'class='form-control'value='".$ligne['NOM_ARTICLE']."'>";
    	 		?>
    	 	</div>
    	 </div>	
    	 <div class='form-row'>
    	 	<div class="col">
    	 		<label for='photo'>Photo</label>
    	 		<?php echo"<input type='file' class='form-control' name='photo'>";
    	 		?>
    	 	</div>
    	 </div>	
    	 <br>
    	  <div class='form-row'>
    	 	<div class="col">
    	 		<label for='description'>Description</label>
    	 		<?php echo"<textarea class='form-control' name='description'>".$ligne['Description']."</textarea>";?>
    	 	</div>
    	 </div>	
    	  <br>
    	  <div class='form-row'>
    	 	<div class="col">
    	 		<label for='texte'>Texte</label>
    	 		<?php echo"<textarea class='form-control' name='texte'>".$ligne['Saisie']."</textarea>";?>
    	 	</div>
    	 </div>	
    	 <br>
    	 <div class="form-row">
    	 	<div class='col'>
    	 		<label for='theme'>Theme</label>
    	 		<?php 
				 $req1=$con->prepare('SELECT * FROM theme');
				 //$req1="SELECT * FROM theme";
				 $req1->execute();
	//$res2=mysqli_query($con,$req1);
	echo "<select name='theme'class='form-control'>";
	while ($ligne1=$req1->fetch()) {
		$idtheme=$ligne1['No_Theme'];
		$nomtheme=$ligne1['libelle'];		

		echo"<option value='".$idtheme."'>";echo $nomtheme;
		echo"</option>";

	}
	echo "</select>";
?>
</div>
</div>
<br>
 <div class='form-row'>
    	 	<div class="col">
    	 		<button type="submit"class='btn btn-warning' name='modif' onclick="return confirm('Voulez vous vraiment modifier cette article')"><i class="fas fa-edit"></i> Modifier</button>
    	 	</div>
</div>
</div>
</div>


<?php
///Traitement Modification Article//////
if(isset($_POST['modif']))
{
	$con=Conn();
	$utlisateur=$ligne['NO_UTILISATEUR'];
	$id=$_GET['id'];
	$theme=$_POST['theme'];
	$req2=$con->prepare('UPDATE article SET NO_THEME=:theme,NOM_ARTICLE=:nom,Photo=:photo,Description=:description,Saisie=:texte WHERE NO_ARTICLE=:id');
	$req2->BindParam(':theme',$theme);
	$req2->BindParam(':nom',$_POST['nom']);
	$req2->BindParam(':photo',$_POST['photo']);
	$req2->BindParam(':description',$_POST['description']);
	$req2->BindParam(':texte',$_POST['texte']);
	$req2->BindParam(':id',$id);
	//$req2="UPDATE article SET NO_THEME='".$theme."',NOM_ARTICLE='".$_POST['nom']."',Photo='".$_POST['photo']."',Description='".$_POST['description']."',Saisie='".$_POST['texte']."' WHERE NO_ARTICLE='".$id."'";
	$req2->execute();
	
	?>
	<script>   document.location.href="index.php?page=Article&id=<?php echo $_GET['id']?>"</script>

<?php
	//$res3=mysqli_query($con,$req2);
}
?>

<?php
?>
