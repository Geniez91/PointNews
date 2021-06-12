<?php
$con=Conn();
$req=$con->prepare('SELECT * FROM  type_article WHERE type_article.No_Type_Art=:id');
$req->BindParam(':id',$_GET['id']);
//$req="SELECT * FROM  Type_Article WHERE Type_Article.No_Type_Art='".$_GET['id']."'";
$req->execute();
//$res=mysqli_query($con,$req);
$ligne=$req->fetch();
$nom=$ligne['Nom'];
?>
<body style="font-family:Marmelad; font-size: 18px;">
   
    <div class="container" style="margin-top:50px; text-left;">
	<div style='border: 1px solid black;border-radius: 2%;background-color: lightblue;'>
	<div style='margin-left: 5px; margin-top:5px;margin-right:5px'>
    	 <h3 class="font-weight-bold text-center text-uppercase mb-4">Modifier Type Article</h3>
<form action=''method='POST'>
	<div class="form-row">
		<div class="col">
			<label for='nom'>Nom</label>
	<?php	echo"	<input type='text' class='form-control'name='nom' value='".$nom."'>";
	?>
</div>
</div>
<br>
<div class="form-row">
	<div class="col">
		<button type="submit" class="btn btn-warning"name='Modifier' onclick="return confirm('Voulez vous vraiment modifier ce type ?')">Modifier</button>
	</div>
	</div>
	</div>
</div>
<?php
if(isset($_POST['Modifier']))
{
	$id=$_GET['id'];
	$nom=$_POST['nom'];
	//requete modification d'un typeArticle//
	$req2=$con->prepare('UPDATE type_article SET Nom=:nom WHERE No_Type_Art=:id');
	$req2->BindParam(':nom',$nom);
	$req2->BindParam(':id',$id);
	//$req2="UPDATE Type_Article SET Nom='".$nom."'  WHERE No_Type_Art='".$id."'";
	$req2->execute();
	//$res2=mysqli_query($con,$req2);
	?>
	<script>document.location.href='index.php?page=typearticle'</script>
	<?php

}