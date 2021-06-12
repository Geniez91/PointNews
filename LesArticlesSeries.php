

<?php
$con=Conn();
$nodocument=$_GET['id'];
$req=$con->prepare('SELECT *,DATE_FORMAT(Date_Air, "%e %M %Y") AS DATEMODIF FROM serie,document WHERE document.NO_DOCUMENT=serie.NO_DOCUMENT AND document.NO_DOCUMENT=:id');
$req->BindParam(':id',$nodocument);
$req->execute();
$ligne=$req->fetch();
$nom=$ligne['NOM'];
$date=$ligne['DATEMODIF'];

?>

<body style="font-family:Marmelad; font-size: 18px;background-image:url('test/wallpapertest2.jpg');background-size: cover;
    background-repeat: no-repeat;">
   
    <div class="container" style="margin-top:50px;">
    <div class='divborder' style="background-color:peru;margin-left:5px">
    <h3 style='display:flex;justify-content:center;'><?php echo $nom;?></h3>
    <div class='text-center'>
     <?php  echo"<img style='width: 400px;margin-bottom:5px;' class='img img-thumbnail img-responsive'src='test/Serie/".$ligne["Photo"]."'>";?>
       </div>
       <div class='text-center' style="border: 1px solid;border-color: inherit;border-radius: 5px">
      <?php echo " <a href='index.php?page=uneserie&id=$nodocument' class='btn btn-primary' style='margin-top: 2px;margin-bottom: 2px;'>Présentation</a>";?>
       <?php echo "<a href='index.php?page=lesArticlesFilm&id=$nodocument' class='btn btn-secondary'style='margin-top: 2px;margin-bottom: 2px;'>Articles</a>";?>
       </div>
       <div class='text-center'>
     <h4> Liste d'articles</h4>

     <?php 
     $req=$con->prepare("SELECT *,DATE_FORMAT(DATE_ART, '%e %M %Y') AS DATEMODIF FROM article,serie WHERE article.NO_DOCUMENT=serie.NO_DOCUMENT AND article.NO_DOCUMENT=:film");
     $req->BindParam(':film',$_GET['id']);
     $req->execute();
     $nbligne=$req->RowCount();
     if($nbligne==0)
     {
       echo "Aucun Article";
     }
     else
     {
  while($ligne=$req->fetch()){
     echo"<form action='index.php?page=Article'>";
			$req2=$con->prepare("SELECT NOM,PRENOM FROM utilisateur WHERE NO_UTILISATEUR=:UTILISATEUR");
			$req2->BindParam(':UTILISATEUR',$ligne['NO_UTILISATEUR']);
      $req2->execute();
			//$req1="SELECT NOM,PRENOM FROM utilisateur WHERE NO_UTILISATEUR='".$ligne1['NO_UTILISATEUR']."'";
			//$res2=mysqli_query($con,$req1);
			$ligne2=$req2->fetch();

      


				echo"<div class='form'>";
		echo "<a type='submit' style='text-decoration-color:black;text-decoration:none;display:flex;margin-bottom:10px;font-size: 20px;margin-left:5px;margin-right:5px' class='btn btn-secondary' href='index.php?page=Article&id=".$ligne['NO_ARTICLE']."'>";	
			echo"<div class='col-2'><img class='img-thumbnail img-fluid'src='test/Serie/".$ligne["Photo"]. "'>";echo"</div>";	
				echo"<div class='col float-right'>";echo "<h2 style='color:black'>";echo $ligne['NOM_ARTICLE'];echo "</h2>";	
				echo"<br><div>";echo $ligne['Description'];echo"</div>";
				
				
				echo" </div>";
				echo"<div class='col-sm col-lg-2'>";
				echo $ligne['DATEMODIF'];
				echo"<br>";
				echo "<br>";
				echo "<br>";
				echo "<br>";
				echo "Ecrit par ";echo $ligne2['NOM']; echo "&nbsp";echo $ligne2['PRENOM']; 
				echo "</div>";
				echo "</a>";
		echo "</div>";		
		}
     }
   
     
     ?>
   <br>