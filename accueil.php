<?php
$con=Conn();
$req=$con->prepare("SELECT NOM_ARTICLE,Photo,Description From article ORDER By `DATE`");
//$req="SELECT NOM_ARTICLE,Photo,Description From article ORDER By `DATE`";
$req->execute();
//$res=mysqli_query($con,$req);
$nombreelement=$req->RowCount();
//$nombreelement=count(mysqli_fetch_row($res));

?>

<body style="font-family:Marmelad; font-size: 18px;background-image:url('test/wallpapertest2.jpg');background-size: cover;
    background-repeat: no-repeat;">
   
	<div class="container" style="margin-top:50px; text-left;">
	<div style="color:white;">
    	 <h3 class="font-weight-bold text-center text-uppercase mb-4"> Bienvenue sur PointNews</h3>
			<div class='carousel slide' id='carouselNews' data-ride="carousel">


		<!------	<ol class='carousel-indicators'>
			<?php
			/*
			$i=0;
			while($ligne=mysqli_fetch_array($res))
			{
				echo "<li data-target='#carouselNews' data-slide-to='".$i."'></li>";
				$i=$i+1;
			}
			*/
			?>
			</ol>----->
				
			
		
<!----------------- Donnes carrousel-->
				<div class='carousel-inner'>
				<div class='carousel-item active '>
				<img class='img-fluid w-100' src='test/marvelstudios.png'>
				<div class='carousel-caption d-none d-md-block'>
						<h5>Bienvenue sur Mon site</h5>
						<p>Description</p>
				</div>
				</div>
				<?php
				$j=0;
				
				//while($ligne=mysqli_fetch_array($res))
				while($ligne=$req->fetch())
				{
				
					$nom=$ligne['NOM_ARTICLE'];
					$photo=$ligne['Photo'];
					$description=$ligne['Description'];
					echo "<div class='carousel-item '>
					
					<img class='img-fluid' src='test/".$photo."' style='width: 100%; height: auto; max-height: 520px;'>";
				
					
					echo "<div class='carousel-caption d-none d-md-block'>
						<h5>".$nom."</h5>
						<p>".$description."</p>
					</div>";
					echo "</div>";
				
				}
				

					?>	
			</div>
			<a class='carousel-control-prev' href='#carouselNews'role='button' data-slide="prev">
			<span class='carousel-control-prev-icon' aria-hidden='true'></span>
			<span class='sr-only'>Previous</span>
			</a>
			<a class='carousel-control-next' href='#carouselNews'role='button' data-slide="next">
			<span class='carousel-control-next-icon' aria-hidden='true'></span>
			<span class='sr-only'>Next</span>
			</a>
</div>
		<div class='text-center' style="margin:10px;border-bottom: 5px solid floralwhite;margin-bottom: 10px;">Les Dernières News</div>
</div>
<?php
///Page en cours
if(isset($_GET['numero']))
{
	$currentpage=$_GET['numero'];
}
else
{
	$currentpage='1';
}



$con=Conn();
$req=$con->prepare("SELECT Count(*) AS NBARTICLE  FROM article ORDER BY DATE_ART Desc");
//$req="SELECT Count(*) AS NBARTICLE  FROM article WHERE No_Type='1' ORDER BY DATE Desc";
$req->execute();
//$res=mysqli_query($con,$req);
$ligne=$req->fetch();
//$ligne=mysqli_fetch_array($res);
$nbarticles=$ligne["NBARTICLE"];//Nombre Total d'articles
$parpage='6';///Nombre d'element par page
$pages=ceil($nbarticles/$parpage);///calcul du nombre de page

//Determiner la premiere page
$premier=($currentpage*$parpage)-$parpage;



$con=Conn();
//Reque pour Afficher les articles qui sont des News///
$req=$con->prepare("SELECT *,DATE_FORMAT(DATE_ART, '%e %M %Y') AS DATEMODIF FROM article ORDER BY DATE_ART Desc LIMIT $premier,$parpage");
//$req="SELECT *,DATE_FORMAT(DATE, '%e %M %Y') AS DATEMODIF  FROM article WHERE No_Type='1' ORDER BY DATE Desc LIMIT $premier,$parpage";
$req->execute();


echo"<div class='row'>";
while($ligne=$req->fetch())//boucle qui parcourt les enregistrements///
{
	$date=setlocale(LC_TIME, "fr_FR", "French");
		 $req1=$con->prepare('SELECT NOM,PRENOM FROM utilisateur WHERE NO_UTILISATEUR=:NO_UTILISATEUR');
		 $req1->BindParam(':NO_UTILISATEUR',$ligne['NO_UTILISATEUR']);
    	//$req1="SELECT NOM,PRENOM FROM utilisateur WHERE NO_UTILISATEUR='".$ligne['NO_UTILISATEUR']."'";
			$req1->execute();
			$ligne4=$req1->fetch();
			
			echo "<div class='col-12 list-group-item' style='background-color:cadetblue;margin-bottom:10px;border-radius:5px;'>";
			echo "<a style='color:inherit;text-decoration:none;' href='index.php?page=Article&id=".$ligne['NO_ARTICLE']."'>";	
				echo "<div class='row'>";
					echo  "<div class='col'>";
			echo"<img  class='img-fluid img-thumbnail' style='width:200px;height:200px' src='image/".$ligne["Photo"]. "'>";
		//echo"
			echo "</div>";
			echo  "<div class='col'>";
				echo"<h3>";echo $ligne['NOM_ARTICLE'];	echo"</h3>";
				echo "<br>";echo $ligne['Description'];

				
				echo  "</a>";
				echo "</div>";
				echo "</div>";
				echo "<div class='row'>
				
				<div class='col-6'>
				Ecrit par ";echo $ligne4['NOM']; echo "&nbsp";echo $ligne4['PRENOM'];echo" </div>
				<div class='col-6' style='text-align: end;'>";
				echo $ligne['DATEMODIF'];
				echo"</div>
				
				</div>";
				echo "</div>";
				
		
	
		}
		echo"</div>";
		echo"<br>";
		?>
	
<!-----Pagination--->

<?php
$precedent=$currentpage-1;
$suivant=$currentpage+1;
?>

	
		<nav aria-label='paginationtext'>
			<ul class='pagination justify-content-center'>
		<?php	
		if($precedent==0)
		{
			echo"	<li class='page-item disabled'><a class='page-link' href='index.php?page=Accueil&numero=".$precedent."' aria-label='Previous' tabindex='-1'>";
		}
		else
		{
			echo"	<li class='page-item'><a class='page-link' href='index.php?page=Accueil&numero=".$precedent."' aria-label='Previous' tabindex='-1'>";
		}
		?>
			
			<span aria-hidden='true'>&laquo;</span>
				<span class='sr-only'>Previous</span>
				</a>
				</li>

				
				<?php 
					for($i=1;$i<=$pages;$i=$i+1)
					{
						if(!isset($_GET['numero']))
						{
							if($i===1)
							{
								echo "<li class='page-item active' active><a class='page-link' href='index.php?page=Accueil&numero=".$i."'>$i</a></li>";
							}
							else
							{
								echo "<li class='page-item'><a class='page-link' href='index.php?page=Accueil&numero=".$i."'>$i</a></li>";
							}
						}
						else
						{
							if($i==$_GET['numero'])
							{
								echo "<li class='page-item active'><a class='page-link' href='index.php?page=Accueil&numero=".$i."'>$i</a></li>";
							}
							else
							{
								echo "<li class='page-item'><a class='page-link' href='index.php?page=Accueil&numero=".$i."'>$i</a></li>";
							}
							
						}

						
					}
					?>



			<?php	
			if($suivant>$pages)
			{
				echo" <li class='page-item disabled'><a class='page-link' href='index.php?page=Accueil&numero=".$suivant."'' aria-label='Next'>";
			}
			else
			{
				echo" <li class='page-item'><a class='page-link' href='index.php?page=Accueil&numero=".$suivant."'' aria-label='Next'>";
			}
			

			?>

					


					<span aria-hidden='true'>&raquo;</span>
					<span class='sr-only'>Next</span>
					</a></li>
			</ul>
		</nav>
		<div style='color:black;font-Weight:bold;margin-bottom:10px'>
		<?php
		echo "Nombre de News : "; echo $nbarticles;
		
		?>
		</div>
	
	
<script>
const ActivePagination=(id)=>{
	const id=documentgetElementById(id)
	console.log(id);
}

</script>