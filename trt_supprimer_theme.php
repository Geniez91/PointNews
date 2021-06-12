	<?php
include("fonction.php");
$con=Conn();
$theme=$_GET['supprimertheme'];
//requete de suppresion d'un theme
$req=$con->prepare("DELETE FROM theme WHERE No_Theme=:theme");
$req->BindParam(':theme',$theme);
//$req="DELETE FROM theme WHERE No_Theme='".$theme."'";
$req->execute();
//$res=mysqli_query($con,$req);
?>

<script>
document.location.href='index.php?page=theme'
</script>
<?php