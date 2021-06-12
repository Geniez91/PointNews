<?php
$con=Conn();
$req=$con->prepare("SELECT * FROM commentaire WHERE commentaire.No_Commentaire=:id");
$req->BindParam(':id',$_GET['id']);
//$req="SELECT * FROM Commentaire WHERE Commentaire.No_Commentaire='".$_GET['id']."'";
$req->execute();
//$res=mysqli_query($con,$req);
$ligne=$req->fetch();
?>
<body style="font-family:Marmelad; font-size: 18px;">
   
    <div class="container" style="margin-top:50px; text-left;">
	<div style='border: 1px solid black;border-radius: 2%;background-color: lightblue;'>
	<div style='margin-left: 5px; margin-top:5px;margin-right:5px'>
    	 <h3 class="font-weight-bold text-center text-uppercase mb-4">Modifier Commentaire</h3>
<form action=''method='POST'>
    	 <div class='form-row'>
    	 	<div class="col">
    	 		<label for="Commentaire">Commentaire</label>
    	 		<textarea class="form-control" name='Commentaire' ><?php echo $ligne['libelle'];?></textarea>
    	 	</div>
    	 </div>
    	 <br>
    	 <div class="form-row">
    	 	<div class="col">
    	 		<button type="submit"name='modifcommentaire'class='btn btn-warning'onclick="return confirm('Voulez-vous vraiment modifier ce commentaire')"><i class="fas fa-edit"></i>Modifier</button>
    	 	</div>
    	 </div>
		 </div>
		 </div>
    	</form>


<?php
if(isset($_POST['modifcommentaire']))
{
	//requete modification d'un commentaire
	$req2=$con->prepare('UPDATE commentaire SET libelle=:Commentaire WHERE No_Commentaire=:id');
	$req2->BindParam(':Commentaire',$_POST['Commentaire']);
	$req2->BindParam(':id',$_GET['id']);
//	$req2="UPDATE Commentaire SET libelle='".$_POST['Commentaire']."' WHERE No_Commentaire='".$_GET['id']."'";
$req2->execute();
//$res2=mysqli_query($con,$req2);
?>
<script>   document.location.href="index.php?page=Article&id=<?php echo $_GET['article']?>"</script>
<?php
}
