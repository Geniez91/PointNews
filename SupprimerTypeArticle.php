<?php
$con=Conn();
$id=$_GET['id'];
//requete de suppresion d'un type d'article
$req=$con->prepare("DELETE FROM type_article WHERE No_Type_Art=:id");
$req->BindParam('id',$id);
//$req="DELETE FROM Type_Article WHERE No_Type_Art='".$id."'";
$req->execute();
//$res=mysqli_query($con,$req);
?>
<script>
document.location.href='index.php?page=typearticle'
</script>

<?php
header("Location:index.php?page=typearticle");
?>