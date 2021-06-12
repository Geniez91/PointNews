
<?php
$con=Conn();
$nodocument=$_GET['id'];
$req=$con->prepare('SELECT *,DATE_FORMAT(Date, "%e %M %Y") AS DATEMODIF FROM film,document WHERE document.NO_DOCUMENT=film.NO_DOCUMENT AND document.NO_DOCUMENT=:nodocument');
$req->BindParam(':nodocument',$nodocument);
$req->execute();
$ligne=$req->fetch();
$nom=$ligne['NOM'];
$temps=$ligne['TEMPS'];
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
       <button class='btn btn-primary' style="margin-top: 2px;margin-bottom: 2px;">Présentation</button>
       <?php echo "<a href='index.php?page=lesArticlesFilm&id=$nodocument' class='btn btn-secondary'style='margin-top: 2px;margin-bottom: 2px;'>Articles</a>";?>
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
           <hr>
        <div class='text-center'>
         <h4 style='color:revert;'><i class="fas fa-tv"></i> Details</h4>
        
                <div style='background:wheat;margin-left: 20px;margin-right: 20px;margin-bottom:10px;'>

                <div>
              <i class="fas fa-clock"></i>   Temps : <?php echo $temps;?> minutes
                
                </div>
                <div>
               <i class="fas fa-calendar-alt"></i>  Date : <?php echo $date;?>
                
                </div>
        </div>
        <?php 
        if($_SESSION['type']==='4')
        {
            $id=$_GET['id'];
             echo "<a class='btn btn-warning' style='margin-right:10px;' href='index.php?page=ModifierFilm&id=".$id."'><i class='fas fa-edit'></i> Modifier</a>";
            echo "<a class='btn btn-danger' href='index.php?page=SupprimerFilm&id=".$id."'><i class='fas fa-trash-alt'></i> Supprimer</a>";
        }
       
    
                
    
    
    
    