<?php
$nosaison=$_GET['id'];
$serie=$_GET['serie'];
$con=Conn();
$req=$con->prepare("DELETE FROM saison WHERE NO_SAISON=:nosaison ");
$req->BindParam(":nosaison",$nosaison);
$req->execute();
?>
<script>
document.location.href='index.php?page=uneserie&id=<?php echo $serie;?>';
</script>
