<div class="container" style='margin-top:70px; ' >
       <h3 class="font-weight-bold text-center text-uppercase mb-4">Les Series</h3>

<div>
<?php 
$con=Conn();
$req1=$con->prepare('SELECT COUNT(*)AS NB_SERIES FROM document,serie WHERE document.NO_DOCUMENT=serie.NO_DOCUMENT ORDER BY DATE_air Desc');
$req1->execute();
$ligne=$req1->fetch();
//pagination
$nbseries= $ligne['NB_SERIES'];
$parpage='6';
$pages=ceil($nbseries/$parpage);
//Determiner la premiere page
if(isset($_GET['numero']))
{
	$currentpage=$_GET['numero'];
}
else
{
	$currentpage='1';
}

$precedent=$currentpage-1;
$suivant=$currentpage+1;

$premier=($currentpage*$parpage)-$parpage;


$req=$con->prepare("SELECT *,DATE_FORMAT(DATE_air, '%e %M %Y') AS DATEMODIF FROM document,serie WHERE document.NO_DOCUMENT=serie.NO_DOCUMENT ORDER BY DATE_air Desc LIMIT $premier,$parpage");
$req->execute();
while($ligne=$req->fetch()){
	$no_document=$ligne['NO_DOCUMENT'];
    	echo"<div class='form'>";
		echo "<a type='submit' style='text-decoration-color:black;text-decoration:none;display:flex;margin-bottom:10px;font-size: 20px;' class='btn btn-secondary' href='index.php?page=uneserie&id=$no_document'>";	
		

		
			
			
			echo"<div class='col-4'><img class='img-thumbnail img-fluid'src='test/Serie/".$ligne["Photo"]. "'>";echo"</div>";	
				echo"<div class='col float-right'>";echo "<h2 style='color:black'>";echo $ligne['NOM'];echo "</h2>";	
				echo"<div>";echo $ligne['Description'];echo"</div>";
				
				
				echo" </div>";
				echo"<div class='col-sm col-lg-2'>";
				echo $ligne['DATEMODIF'];
				echo"<br>";
				echo "<br>";
				echo "<br>";
				echo "<br>";
				echo "</div>";
				echo "</a>";
		echo "</div>";	
        
}


?>
</div>
<nav aria-label='paginationtext'>
			<ul class='pagination justify-content-center'>
		<?php	
		if($precedent==0)
		{
			echo"	<li class='page-item disabled'><a class='page-link' href='index.php?page=Series&numero=".$precedent."' aria-label='Previous' tabindex='-1'>";
		}
		else
		{
			echo"	<li class='page-item'><a class='page-link' href='index.php?page=Series&numero=".$precedent."' aria-label='Previous' tabindex='-1'>";
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
								echo "<li class='page-item active' active><a class='page-link' href='index.php?page=Series&numero=".$i."'>$i</a></li>";
							}
							else
							{
								echo "<li class='page-item'><a class='page-link' href='index.php?page=Series&numero=".$i."'>$i</a></li>";
							}
						}
						else
						{
							if($i==$_GET['numero'])
							{
								echo "<li class='page-item active'><a class='page-link' href='index.php?page=Series&numero=".$i."'>$i</a></li>";
							}
							else
							{
								echo "<li class='page-item'><a class='page-link' href='index.php?page=Series&numero=".$i."'>$i</a></li>";
							}
							
						}

						
					}
					?>



			<?php	
			if($suivant>$pages)
			{
				echo" <li class='page-item disabled'><a class='page-link' href='index.php?page=Series&numero=".$suivant."'' aria-label='Next'>";
			}
			else
			{
				echo" <li class='page-item'><a class='page-link' href='index.php?page=Series&numero=".$suivant."'' aria-label='Next'>";
			}
			

			?>

					


					<span aria-hidden='true'>&raquo;</span>
					<span class='sr-only'>Next</span>
					</a></li>
			</ul>
		</nav>
<?php

