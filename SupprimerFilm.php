<?php 
$id=$_GET['id'];
$con=Conn();
$req=$con->prepare('DELETE FROM Document WHERE NO_DOCUMENT=:id');
$req->BindParam(':id',$id);
$req->execute();
$req2=$con->prepare('DELETE FROM film WHERE NO_DOCUMENT=:id');
$req2->BindParam(':id',$id);
$req2->execute();
$req3=$con->prepare('DELETE FROM a_plusieurs WHERE NO_DOCUMENT=:id');
$req3->BindParam(':id',$id);
$req3->execute();
?>
<script>
document.location.href='index.php?page=Films';
</script>
<?php
