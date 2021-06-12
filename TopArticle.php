<body style="font-family:Marmelad; font-size: 18px;">
   
    <div class="container" style="margin-top:50px; text-left;">
    	 <h3 class="font-weight-bold text-center text-uppercase mb-4">Top Article</h3>
    	 <br>
    	 <form 	action=''method='POST'>
    	 	<div class="form-row">
    	 		<div class="col"><input type='checkbox' name='recherche'> Recherche par Theme
    	 			<?php ListeTheme();
    	 			?>
    	 		</div>
    	 		<div class="col"><input type='checkbox' name='test'> Recherche par Type
    	 		<?php 
				 $con=Conn();
				 $req=$con->prepare('SELECT * FROM type_article');
				 $req->execute();
				  echo"<select class='form-control' name='typeart'>";
				 while($ligne=$req->fetch())
				 {
					 $no_type=$ligne['No_Type_Art'];
					 $nom_type=$ligne['Nom'];
					echo "<option value=$no_type>$nom_type</option>";
				 }
				
				 
				echo" </select>";
    	 		?>
    	 	</div>
    	 	<div class="col"><br><button type="submit" name="valider" class="btn btn-success">Valider</button>
    	 	</div>
    	 </div>


    	 <?php 

$con=Conn();
if(empty($_POST['recherche'])&empty($_POST['test']))//Aucun bouton selectionner
{
	$req=$con->prepare("SELECT NOM_ARTICLE,COUNT(*) AS NB_COMMENTAIRE FROM article,commentaire WHERE commentaire.No_Article=article.NO_ARTICLE GROUP BY article.NOM_ARTICLE ORDER by NB_COMMENTAIRE DESC");
//$req="SELECT NOM_ARTICLE,COUNT(*) AS NB_COMMENTAIRE FROM article,Commentaire WHERE Commentaire.No_Article=article.NO_ARTICLE GROUP BY article.NOM_ARTICLE ORDER by NB_COMMENTAIRE DESC";
$req->execute();
//$res=mysqli_query($con,$req);
$i='0';
echo "<br>";

echo"<table class='table table-striped table-dark'>";
echo "<tr class='thead-light'>";
echo "<th><i class='fas fa-trophy' style='color:orange'></i> Position</th> ";
echo "<th>Nom</th>";
echo"<th>Nombre Commentaire</th>";
echo "</tr>";
while($ligne=$req->fetch())
{
	$i=$i+1;
	$nom=$ligne['NOM_ARTICLE'];
	$nbcommentaire=$ligne['NB_COMMENTAIRE'];
	echo"<tr>";
		echo"<td>".$i."</td>";
		echo"<td>".$ligne['NOM_ARTICLE']."</td>";
		echo"<td>".$nbcommentaire."</td>";
	echo"</tr>";

}
}
///Recherche par theme
else if(isset($_POST['recherche'])&empty($_POST['test']))
{
	$theme=$_POST['theme'];
	if($theme==0)
	{
$req2=$con->prepare("SELECT NOM_ARTICLE,COUNT(*) AS NB_COMMENTAIRE FROM article,commentaire,serie WHERE article.NO_DOCUMENT=serie.NO_DOCUMENT AND commentaire.No_Article=article.NO_ARTICLE GROUP BY article.NOM_ARTICLE ORDER by NB_COMMENTAIRE DESC");
	$req2->execute();
	$i='0';
echo "<br>";

echo"<table class='table table-striped table-dark'>";
echo "<tr class='thead-light'>";
echo "<th><i class='fas fa-trophy'></i> Position</th> ";
echo "<th>Nom</th>";
echo"<th>Nombre Commentaire</th>";
echo "</tr>";
while($ligne=$req2->fetch())
{
	$i=$i+1;
	$nom=$ligne['NOM_ARTICLE'];
	$nbcommentaire=$ligne['NB_COMMENTAIRE'];
	echo"<tr>";
		echo"<td>".$i."</td>";
		echo"<td>".$ligne['NOM_ARTICLE']."</td>";
		echo"<td>".$nbcommentaire."</td>";
	echo"</tr>";

}	

}
	else
	{
$req2=$con->prepare("SELECT NOM_ARTICLE,COUNT(*) AS NB_COMMENTAIRE FROM article,commentaire,film WHERE article.NO_DOCUMENT=film.NO_DOCUMENT AND commentaire.No_Article=article.NO_ARTICLE GROUP BY article.NOM_ARTICLE ORDER by NB_COMMENTAIRE DESC");
	$req2->BindParam(':theme',$theme);
		$req2->execute();
	$i='0';
echo "<br>";

echo"<table class='table table-striped table-dark'>";
echo "<tr class='thead-light'>";
echo "<th><i class='fas fa-trophy'></i> Position</th> ";
echo "<th>Nom</th>";
echo"<th>Nombre Commentaire</th>";
echo "</tr>";
while($ligne=$req2->fetch())
{
	$i=$i+1;
	$nom=$ligne['NOM_ARTICLE'];
	$nbcommentaire=$ligne['NB_COMMENTAIRE'];
	echo"<tr>";
		echo"<td>".$i."</td>";
		echo"<td>".$ligne['NOM_ARTICLE']."</td>";
		echo"<td>".$nbcommentaire."</td>";
	echo"</tr>";

}
	}
}
else if(empty($_POST['recherche'])&isset($_POST['test']))
{

		$req3=$con->prepare("SELECT NOM_ARTICLE,COUNT(*) AS NB_COMMENTAIRE FROM article,Commentaire WHERE Commentaire.No_Article=article.NO_ARTICLE AND article.NO_TYPE_ART=:typeart GROUP BY article.NOM_ARTICLE ORDER by NB_COMMENTAIRE DESC");
		$req3->BindParam(':typeart',$_POST['typeart']);
		
		
	
	//$req3="SELECT NOM_ARTICLE,COUNT(*) AS NB_COMMENTAIRE FROM article,Commentaire WHERE Commentaire.No_Article=article.NO_ARTICLE AND No_Genre ='".$genre."' GROUP BY article.NOM_ARTICLE ORDER by NB_COMMENTAIRE DESC";
	$req3->execute();
	//$res=mysqli_query($con,$req3);
	$i='0';
echo "<br>";

echo"<table class='table table-striped table-dark'>";
echo "<tr class='thead-light'>";
echo "<th><i class='fas fa-trophy'></i> Position</th> ";
echo "<th>Nom</th>";
echo"<th>Nombre Commentaire</th>";
echo "</tr>";
while($ligne=$req3->fetch())
{
	$i=$i+1;
	$nom=$ligne['NOM_ARTICLE'];
	$nbcommentaire=$ligne['NB_COMMENTAIRE'];
	echo"<tr>";
		echo"<td>".$i."</td>";
		echo"<td>".$ligne['NOM_ARTICLE']."</td>";
		echo"<td>".$nbcommentaire."</td>";
	echo"</tr>";

}
	}
else if(isset($_POST['recherche'])&isset($_POST['test']))
{
	$theme=$_POST['theme'];

	if($theme==0)
	{
	$req3=$con->prepare("SELECT NOM_ARTICLE,COUNT(*) AS NB_COMMENTAIRE FROM article,commentaire,serie WHERE article.No_Document=serie.No_Document AND commentaire.No_Article=article.NO_ARTICLE AND article.NO_TYPE_ART=:typeart GROUP BY article.NOM_ARTICLE ORDER by NB_COMMENTAIRE DESC");
		$req3->BindParam(':typeart',$_POST['typeart']);
			$req3->execute();
	//$res=mysqli_query($con,$req3);
	$i='0';
echo "<br>";

echo"<table class='table table-striped table-dark'>";
echo "<tr class='thead-light'>";
echo "<th><i class='fas fa-trophy'></i> Position</th> ";
echo "<th>Nom</th>";
echo"<th>Nombre Commentaire</th>";
echo "</tr>";
while($ligne=$req3->fetch())
{
	$i=$i+1;
	$nom=$ligne['NOM_ARTICLE'];
	$nbcommentaire=$ligne['NB_COMMENTAIRE'];
	echo"<tr>";
		echo"<td>".$i."</td>";
		echo"<td>".$ligne['NOM_ARTICLE']."</td>";
		echo"<td>".$nbcommentaire."</td>";
	echo"</tr>";

}

	}
	else
	{
		$req3=$con->prepare("SELECT NOM_ARTICLE,COUNT(*) AS NB_COMMENTAIRE FROM article,commentaire,film WHERE article.No_Document=film.No_Document AND commentaire.No_Article=article.NO_ARTICLE AND article.NO_TYPE_ART=:typeart GROUP BY article.NOM_ARTICLE ORDER by NB_COMMENTAIRE DESC");
		$req3->BindParam(':typeart',$_POST['typeart']);
			$req3->execute();
	//$res=mysqli_query($con,$req3);
	$i='0';
echo "<br>";

echo"<table class='table table-striped table-dark'>";
echo "<tr class='thead-light'>";
echo "<th><i class='fas fa-trophy'></i> Position</th> ";
echo "<th>Nom</th>";
echo"<th>Nombre Commentaire</th>";
echo "</tr>";
while($ligne=$req3->fetch())
{
	$i=$i+1;
	$nom=$ligne['NOM_ARTICLE'];
	$nbcommentaire=$ligne['NB_COMMENTAIRE'];
	echo"<tr>";
		echo"<td>".$i."</td>";
		echo"<td>".$ligne['NOM_ARTICLE']."</td>";
		echo"<td>".$nbcommentaire."</td>";
	echo"</tr>";

}
	}

}
	

    	 