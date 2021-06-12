
<?php
$con=Conn();
$theme=$_GET['id'];
$req=$con->prepare('SELECT * FROM theme WHERE No_Theme=:theme');
$req->BindParam(':theme',$theme);
//$req="SELECT * FROM theme WHERE No_Theme='".$theme."'";
$req->execute();
//$res=mysqli_query($con,$req);

$ligne=$req->fetch();
?>
<body style="font-family:Marmelad; font-size: 18px;">
   
    <div class="container" style="margin-top:50px; text-left;">
	<div style='border: 1px solid black;border-radius: 2%;background-color: lightblue;'>
	<div style='margin-left: 5px; margin-top:5px;margin-right:5px'>
    	 <h3 class="font-weight-bold text-center text-uppercase mb-4">Modifier Theme</h3>
<form action=""method='POST'>
<div class='row'>
	<div class='col'>
		<label for='libelle'> Libelle </label>
			<?php echo "<input type='text'value='".$ligne['libelle']."'class='form-control'name='libelle'>";
			?>
	</div>
</div>
<br>
	<div class="row">
	<div class='col'>
		<button class='btn btn-warning'type='submit' name='modiftheme'><i class="fas fa-edit"></i> Modifier</button>

</div>
</div>
</div>

<?php
if(isset($_POST['modiftheme']))
{
	$libelle=$_POST['libelle'];
	//requete de modification d'un theme
	$req=$con->prepare('UPDATE `theme` SET libelle=:libelle WHERE No_Theme=:theme');
	$req->BindParam(':libelle',$libelle);
	$req->BindParam(':theme',$theme);
	//$req='UPDATE `theme` SET libelle="'.$libelle.'" WHERE No_Theme="'.$theme.'"';
	$req->execute();
	//$res=mysqli_query($con,$req);
	?>
	<script>
	document.location.href='index.php?page=theme'
	</script>
	<?php
}