<body style="font-family:Marmelad; font-size: 18px;">
   
    <div class="container" style="margin-top:50px; text-align:center;">
	<div style='border: 1px solid black;border-radius: 2%;background-color: lightblue;'>
	<div style='margin-left: 5px; margin-top:5px;margin-right:5px'>
       <h3 class="font-weight-bold text-center text-uppercase mb-4">Ajout Theme</h3>
	<form action="" method="POST">
	<div class="form-row">
		<div class='col'>
		<label for='libelle'> Libelle</label>
		<input type="text" name="libelle" class='form-control' placeholder="Libelle">

</div>
</div>
<br>
<div class="form-row">
	<div class="col">
		<button type='submit'class='btn btn-primary' name='ajout'>Ajouter</button>
	</div>
	</div>
	</div>
</div>

<?php
if(isset($_POST['ajout']))
{
	$con=Conn();
	$theme=$_POST['libelle'];
	$req=$con->prepare("INSERT INTO theme(libelle) VALUES (:theme)");
	$req->BindParam(':theme',$theme);
//	$req="INSERT INTO theme(libelle) VALUES ('".$theme."')";
$req->execute();
//	$res=mysqli_query($con,$req);
?>
<script>
document.location.href='index.php?page=theme'
</script>
<?php
}