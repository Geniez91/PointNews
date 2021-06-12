<?php
$con=Conn();
$id=$_GET['id'];
//Requete d'affichage d'article avec information sur le créateur de l'article
$req=$con->prepare("SELECT *,article.Photo as PhotoA,DATE_FORMAT(DATE_Art, '%e %M %Y') AS DATEMODIF FROM article,utilisateur WHERE article.NO_ARTICLE=:id AND utilisateur.NO_UTILISATEUR=article.NO_UTILISATEUR");
$req->BindParam('id',$id);
//$req="SELECT *,article.Photo as PhotoA,DATE_FORMAT(DATE, '%e %M %Y') AS DATEMODIF FROM article,utilisateur WHERE article.NO_ARTICLE='".$id."'AND utilisateur.NO_UTILISATEUR=article.NO_UTILISATEUR ";
$req->execute();
//$res=mysqli_query($con,$req);
$ligne=$req->fetch();
$date=setlocale(LC_TIME, "fr_FR", "French");
?>


<body style="font-family:Marmelad; font-size: 18px;background-image:url('test/wallpapertest2.jpg');background-size: cover;
    background-repeat: no-repeat;">
   
    <div class="container" style="margin-top:50px;">
    <div class='divborder' style="background-color:peru">
    <br>
    	 <h3 class="font-weight-bold text-center text-uppercase mb-4"style='color:black'><?php echo $ligne['NOM_ARTICLE']; ?></h3>
       <div class='text-center'>
     <?php  echo"<img style='width: 400px;height:400px' class='img img-thumbnail'src='image/".$ligne["PhotoA"]."'>";?>
       </div>
    	 <br>
    	    <div class='card'>
            <div class='card-body'>
    	 	<?php
         echo "<h4 class='text-center'>";
           echo $ligne['Description'];
           echo"</h4>";
           echo "<br>";
    	 		echo $ligne['Saisie'];
    	 		?>
           </div>
           </div>
           <br>
           <br>
             <div class='row'>
        <div class='col text-left' style='color:black;margin-left:5px;'>
    <?php echo"Le "; echo "&nbsp";echo $ligne['DATEMODIF'];
    ?>
        </div>
        
       <div class='col text-right'style='color:black;margin-right:5px;'> 
     Ecrit par <?php echo $ligne['NOM']; echo '&nbsp';echo $ligne['PRENOM'];?>
    
      </div>
      </div>
    	 
         <?php
         if(isset($_SESSION['type']))//Verifie si utilisateur est connecté
         {
          if($_SESSION['type']=='4')//verifie si l'utilisateur est un administrateur
          {?>
          <br>
          <div class='text-center'>

           <?php echo" <a type='submit' name='modif' class='btn btn-warning' href='index.php?page=modifierarticle&id=".$id."'><i class='fas fa-edit'></i> Modifier</a>";
           ?>
            <?php echo"<a type='submit' name='Supprimer' class='btn btn-danger' href='index.php?page=supprimerarticle&id=".$id."'"?>onclick="return confirm('Voulez vous vraiment supprimer cette article ?')"><i class='fas fa-trash'> </i> Supprimer</a>
        </div>
        <?php
          }
        }
          ?>

      <br>
      
    <?php
    //nombre commentaire//
    $id=$id=$_GET['id'];
    $req3=$con->prepare("SELECT COUNT(*) AS NB_COMMENTAIRE FROM commentaire WHERE No_Article=:id");
    $req3->BindParam(':id',$id);
    //$req3="SELECT COUNT(*) AS NB_COMMENTAIRE FROM Commentaire WHERE No_Article='".$_GET['id']."'";
    $req3->execute();
    $ligne3=$req3->fetch();
    $nbcommentaire=$ligne3['NB_COMMENTAIRE'];
    ?>
    <hr>
    <h5 class="text-center "style='color:white'><i class="fas fa-comment"></i> <?php echo $nbcommentaire;?>  Commentaires  </h5>
    <div class="card text-center">
  <div class="card-body">
    		<?php
            $req1=$con->prepare("SELECT *,Count(*) AS NB_COMMENTAIRE,DATE_FORMAT(DATENAISS,'%d/%m/%Y') AS DATENAISSMODIF,utilisateur.Photo AS PHOTOPROFIL FROM article,commentaire,utilisateur WHERE commentaire.No_Article=article.NO_ARTICLE AND commentaire.No_Utilisateur=utilisateur.NO_UTILISATEUR AND article.No_Article=:id GROUP BY commentaire.libelle,utilisateur.LOGIN ORDER BY article.DATE_ART");
           $req1->BindParam(':id',$id);
            // $req1="SELECT *,Count(*) AS NB_COMMENTAIRE,DATE_FORMAT(DATENAISS,'%d/%m/%Y') AS DATENAISSMODIF,utilisateur.Photo AS PHOTOPROFIL FROM article,Commentaire,utilisateur WHERE Commentaire.No_Article=article.NO_ARTICLE AND Commentaire.No_Utilisateur=utilisateur.NO_UTILISATEUR AND article.No_Article=".$id." GROUP BY Commentaire.libelle,utilisateur.LOGIN ORDER BY article.DATE  ";
          $req1->execute();
            // $res1=mysqli_query($con,$req1);
            while ($ligne=$req1->fetch()) {
              $photoprofil=$ligne['PHOTOPROFIL'];
                echo"<div class='form-row'>";
                
                echo "<div class='col text-left'>";
                echo "<img style='width:300px;height:300px'; class='img-fluid img-thumbnail'src='test/Profil/".$photoprofil."'>";
                echo "<br>";
                    echo $ligne['LOGIN'];
                    
                        echo"<br>".$ligne['DATENAISSMODIF']."";
                        echo"</div>";
                        echo"<div class='col text-left'>".$ligne['LIBELLE']."";
                        echo"</div>";
                        $commentaire=$ligne['NO_COMMENTAIRE'];
                        if(isset($_SESSION['type']))//verifie si l'utilisateur est connecté
                        {

                        
                        if($_SESSION['type']=='4')//verifie si l'utilisateur est un administrateur
                        {
                          echo "<br>";
                          echo "</div>";
                          echo "<div class='row>";
                          echo "<div class='col'>";
                      echo "<a style='margin-right: 10px;' type='submit'class='btn btn-warning'href='index.php?page=modifiercommentaire&id=".$commentaire."&article=".$id."'><i class='fas fa-edit'></i>Modifier</a>";
                       
                      echo"<a type='submit'class='btn btn-danger'href='index.php?page=supprimercommentaire&article=".$_GET['id']."&id=".$commentaire."'><i class='fas fa-trash'></i> Supprimer</a>";
                      echo "</div>";


                        
            }
            
          }

                    echo "<hr>";



            }

            if(isset($_SESSION['type']))
            {
              echo"<form action='' method='POST'>"; 
              echo"<br>"; 
              echo "<h3 class='font-weight-bold text-center text-uppercase mb-4'>Ajouter Commentaire </h3>";
              echo "<div class='form-row'>";
              echo "<div class='col'>";
              echo"<label for='LIBELLE'>Commentaire</label>";
              echo"<textarea class='form-control'rows='5' placeholder='Commentaire' name='libelle'></textarea>";
             echo" </div>	";
            echo"</div>";
           echo" <div class='form-row'>";
             echo"<div class='col'>";
             echo "<br>";
              echo"<button type='submit' class='btn btn-primary' name='ajout'>Valider</button>";
        echo "</div>";
        echo " </div>";
        echo "</div>";
        echo "</div>";
        
            }
          
      
if(isset($_POST['ajout']))
{
	if(empty($_POST['libelle']))
	{
		echo"Vous devez renseigner le champs de saisie d'un Commentaire !";
	}
	else
	{
		$id=$_GET['id'];
		$libelle=$_POST['libelle'];
		$user=$_SESSION['id'];
		$con=Conn();
    $req=$con->prepare("INSERT INTO commentaire(NO_ARTICLE, LIBELLE, No_Utilisateur) VALUES (:id,:libelle,:user)");
    $req->BindParam(':id',$id);
    $req->BindParam(':libelle',$libelle);
    $req->BindParam(':user',$user);
	//	$req="INSERT INTO Commentaire(NO_ARTICLE, LIBELLE, No_Utilisateur) VALUES ('".$id."','".$libelle."','".$user."')";
    $req->execute();
  $res=mysqli_query($con,$req);
  ?>
  <script>  document.location.href="index.php?page=Article&id=<?php echo $_GET['id'];?>"</script>
  <?php
	}
}
