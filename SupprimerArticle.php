<?php
$con=Conn();
$id=$_GET['id'];
//requete de suppresion d'un article
$req=$con->prepare("DELETE FROM article WHERE NO_ARTICLE=:id");
$req->BindParam(':id',$id);
$req->execute();
//$req="DELETE FROM article WHERE NO_ARTICLE='".$id."'";
//$res=mysqli_query($con,$req);
header("Location:index.php?page=consulter");
?>