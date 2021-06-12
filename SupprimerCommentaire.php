<?php
$con=Conn();
$id=$_GET['id'];
//requete de suppresion d'un commentaire
$req=$con->prepare("DELETE FROM commentaire WHERE No_Commentaire=:id");
$req->BindParam(':id',$id);
//$req="DELETE FROM Commentaire WHERE No_Commentaire='".$id."'";
$req->execute();
//$res=mysqli_query($con,$req);
?>
<script>
document.location.href='index.php?page=Article&id=<?php echo $_GET["article"];?>'
</script>