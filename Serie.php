<?php 
$con=Conn();
$id=$_GET['id'];
$req=$con->prepare('SELECT * FROM document,serie WHERE document.No_Document=serie.No_Document AND document.No_Document=:id');
$req->BindParam(':id',$id);
$req->execute();
$ligne=$req->fetch();
$nom=$ligne['NOM'];
$req1=$con->prepare('SELECT MAX(NUMERO) AS NB_MAX FROM saison WHERE NO_DOCUMENT=:id');
$req1->BindParam(':id',$id);
$req1->execute();
$ligne1=$req1->fetch();
$maxnumero=$ligne1['NB_MAX'];
?>

<body style="font-family:Marmelad; font-size: 18px;background-image:url('test/wallpapertest2.jpg');background-size: cover;
    background-repeat: no-repeat;">
   
    <div class="container" style="margin-top:50px;">
    <div class='divborder' style="background-color:peru;margin-left:5px">
    <h3 style='display:flex;justify-content:center;'><?php echo $nom ?></h3>
    <div class='text-center'>
     <?php  echo"<img style='width: 400px;margin-bottom:5px;' class='img img-thumbnail img-responsive'src='test/Serie/".$ligne["Photo"]."'>";?>
       </div>
       <div class='text-center' style="border: 1px solid;border-color: inherit;border-radius: 5px">
       <button class='btn btn-primary' style="margin-top: 2px;margin-bottom: 2px;">Présentation</button>
    <?php echo"   <a href='index.php?page=lesArticlesSeries&id=$id' class='btn btn-secondary'style='margin-top: 2px;margin-bottom: 2px;'>Articles</a>";?>
       </div>
       <br>
       <div class='card'>
            <div class='card-body'>
    	 	<?php
         echo "<h4 class='text-center'>";
           echo $ligne['Description'];
           echo"</h4>";
        ?>
        </div>
        
        </div>
        <div>
        </div>           
        <?php
        $req=$con->prepare('SELECT NUMERO,PhotoSaison,NO_SAISON FROM serie,saison WHERE serie.NO_DOCUMENT=saison.NO_DOCUMENT AND serie.NO_DOCUMENT=:id');
        $req->BindParam(':id',$id);
        $req->execute();
        ?>
        <hr>
        <div class='text-center'>
         <h4 style='color:revert;'><i class="fas fa-tv"></i> Les Saisons</h4>
        
                <div style='background:wheat;margin-left: 20px;margin-right: 20px;margin-bottom:2px'>
         <?php
         while($ligne=$req->fetch())
         {
            $numero=$ligne['NUMERO'];
            $nosaison=$ligne['NO_SAISON'];
          echo "<a style='text-decoration-color:black;text-decoration:none;' href='index.php?page=SaisonsSeries&numero=$numero&id=$id&idsaison=$nosaison'>";
 echo" <div>";
            echo "<h4>Saison ";echo $ligne["NUMERO"];echo "</h4>";
            echo "<br>";
            echo "<img style='width:300px'; class='img-thumbnail'src='test/Serie/Saison/".$ligne["PhotoSaison"]. "'>";
            if($_SESSION['type']==='4')
            {
              $nosaison=$ligne['NO_SAISON'];
              $numero=$ligne['NUMERO'];

            echo "<br>";
             echo "<br>";
            echo "<a class='btn btn-warning' style='margin-right:10px;' href='index.php?page=ModifierSaison&id=".$nosaison."&numero=".$numero."&serie=".$id."'><i class='fas fa-edit'></i> Modifier</a>";
            echo "<a class='btn btn-danger' href='index.php?page=SupprimerSaison&id=".$nosaison."&serie=".$id."'><i class='fas fa-trash-alt'></i> Supprimer</a>";
              
          }
            echo "<hr style='border-color:black;'>";
            
           echo " </div>";
           echo "</a>";
         }
         
           
           ?>
           </div>
          
          
           <?php 
           if($_SESSION['type']==='4')
         {
              echo "<div style='margin-bottom:5px'>";
            echo "<button class='btn btn-success' data-toggle='modal' data-target='#exampleModal'><i class='fas fa-plus'></i> Ajout Saison </button>";
            echo "<a class='btn btn-warning' href='index.php?page=ModifierSerie&id=".$_GET['id']."'><i class='fas fa-edit'></i> Modifier Serie </a>";
            echo "<a class='btn btn-danger' href='index.php?page=SupprimerSerie&id=".$_GET['id']."'><i class='fas fa-trash-alt'></i> Supprimer Serie </a>";
        echo '<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form method="POST" action=""  enctype="multipart/form-data">
        <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Ajouter une Saison </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
<h5>Photo</h5>
<div class="custom-file ">
    <input type="file" id="validatedCustomFile" name="image" required>
    <label class="custom-file-label" for="validatedCustomFile" id="l">
Choisir Fichier
	</label>
  </div>
  </div>
      </div>
      <div class="modal-footer">
      
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="ajout"></input>
      </div>
    </div>
  </div>
  </form>
</div>';
           echo  "</div>";
         }

       
    

        if(isset($_POST['ajout']))
        {
            
      
            $maxnumero1=$maxnumero+1;
            $photo=$photo = $_FILES['image']['name'];
             $target = "test/Serie/Saison/".basename($photo);
             $req=$con->prepare("INSERT INTO saison VALUES(NULL,:id,:numero,:photo)");
             $req->BindParam(':id',$id);
             $req->BindParam(':numero',$maxnumero1);
             $req->BindParam(':photo',$photo);

    if($req->execute())
    {
      	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) 
			{///verification que la photo a bien été envoyé//
			$msg = "Image exporter ";
		}
    
		else{

			$msg = "Failed to upload image";
	}

     ?>
     <script>
     document.location.href='index.php?page=uneserie&id=<?php echo $id;?>'
     </script>
     
    <?php
      }
    }
        
        ?>
    
    
         
        
         
         
        

        </div>
        