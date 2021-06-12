<?php 
$con=Conn();
$id=$_GET['id'];
$numero=$_GET['numero'];
$req=$con->prepare('SELECT * FROM document,serie,saison WHERE document.No_Document=serie.No_Document AND document.No_Document=:id AND serie.No_Document=saison.No_Document AND saison.NUMERO=:saison');
$req->BindParam(':saison',$numero);
$req->BindParam(':id',$id);
$req->execute();
$ligne=$req->fetch();
$nom=$ligne['NOM'];
$req1=$con->prepare('SELECT MAX(NUMERO) AS NB_MAX FROM saison WHERE NO_DOCUMENT=:id');
$req1->BindParam(':id',$id);
$req1->execute();
$ligne1=$req1->fetch();
$maxnumero=$ligne1['NB_MAX'];
$idsaison=$_GET['idsaison'];

$idsaison=$_GET['idsaison'];
$req2=$con->prepare('SELECT * FROM episodes,saison WHERE episodes.NO_SAISON=saison.NO_SAISON AND episodes.NO_SAISON=:nosaison');
$req2->BindParam(':nosaison',$idsaison);
$req2->execute();



?>

<body style="font-family:Marmelad; font-size: 18px;background-image:url('test/wallpapertest2.jpg');background-size: cover;
    background-repeat: no-repeat;">
   
    <div class="container" style="margin-top:50px;">
    <div class='divborder' style="background-color:peru;margin-left:5px">
    <h3 style='display:flex;justify-content:center;'><?php echo $nom ?></h3>
    <div class='text-center'>
     <?php  echo"<img style='width: 400px;margin-bottom:5px;' class='img img-thumbnail img-responsive'src='test/Serie/Saison/".$ligne["PhotoSaison"]."'>";?>
       </div>
       <h4 style='display:flex;justify-content:center;'>Saison <?php echo $numero ?></h4>
       <hr>
         <div class='text-center'>
        Les Episodes
        </div>
        <div style='background:wheat;margin-left: 20px;margin-right: 20px;margin-bottom:10px'>
      <?php 
      while($ligne3=$req2->fetch())
      {
          echo"Episode".$ligne3['NUMERO_EP'];
          echo "<br>";
      }
      ?>
        <br>
        </div>
        <div class='text-center' style='margin-bottom:10px;'>
       
       <?php echo" <a class='btn btn-success' href='index.php?page=ajouterepisode&nosaison=$idsaison&idserie=$id'>Ajouter</a>";
       echo "</div>";