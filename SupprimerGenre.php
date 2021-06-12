<?php
$con=Conn();
$id=$_GET['id'];
//Requete de suppresion d'un genre
$req=$con->prepare("DELETE FROM genre WHERE No_Genre=:id");
$req->BindParam(':id',$id);
//$req="DELETE FROM Genre WHERE No_Genre='".$id."'";
$req->execute();
//$res=mysqli_query($con,$req);
?>
<script>
document.location.href='index.php?page=genre'
</script>
<?php
header("Location:index.php?page=genre");
?>