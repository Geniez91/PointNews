<?php
$con=Conn();
$req=$con->prepare('SELECT * FROM utilisateur WHERE utilisateur.NO_UTILISATEUR=:id');
$req->BindParam(':id',$_GET['id']);
//$req="SELECT * FROM utilisateur WHERE utilisateur.NO_UTILISATEUR='".$_GET['id']."'";
$req->execute();
//$res=mysqli_query($con,$req);
$ligne=$req->fetch();
//$ligne=mysqli_fetch_array($res);
?>
<body style="font-family:Marmelad; font-size: 18px;">
   
    <div class="container" style="margin-top:50px; text-left;">
	 <div style='border: 1px solid black;border-radius: 2%;background-color: lightblue;'>
	   <div style='margin-left: 5px; margin-top:5px'>
    	 <h3 class="font-weight-bold text-center text-uppercase mb-4">Modifier Type Utilisateur</h3>
<form action=''method='POST'>
		<div class="form-row">
			<div class="col">
				<label for='type'>Type Utilisateur</label>
				<?php
				$con=Conn();
				$req2=$con->prepare("SELECT * FROM type_utilisateur");

	//$req2="SELECT * FROM type_utilisateur";
	$req2->execute();
	//$res2=mysqli_query($con,$req2);
	echo "<select name='type' class='form-control'>";
	while ($ligne2=$req2->fetch()) {
		$idtype=$ligne2['No_Type'];
		$nomtype=$ligne2['libelle'];	
		
		
			


		echo"<option value='".$idtype."'>";echo $nomtype;
		echo"</option>";

	}
	echo "</select>";
	?>
</div>
</div>
<br>
<div class="form-row">
	<div class="col">
		<button type="submit" name="modifier" class="btn btn-warning"><i class="fas fa-edit"></i> Modifier</button>
	</div>

</div>
</div>
</div>

<?php
if(isset($_POST['modifier']))
{
$type=$_POST['type'];
$id=$_GET['id'];
//requete de modification d'un utilisateur
$req3=$con->prepare("UPDATE utilisateur SET NO_TYPE=:type WHERE NO_UTILISATEUR=:id");
$req3->BindParam(":type",$type);
$req3->BindParam(":id",$id);
//$req3="UPDATE  utilisateur SET NO_TYPE='".$type."' WHERE NO_UTILISATEUR='".$id."'";
$req3->execute();
?>
<script>
document.location.href='index.php?page=Compte'</script>
<?php
}
