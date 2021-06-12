<body style="font-family:Marmelad; font-size: 18px;">
   
    <div class="container" style="margin-top:50px; text-left;">
    	 <h3 class="font-weight-bold text-center text-uppercase mb-4">Recherche Article</h3>
    	 <br>
    	 <form 	action=''method='POST'>
    	 <div class="form-row">
    	 	<div class='col'>
    	 		<label for='nom'> <input type='checkbox' name='recherchenom'> Nom </label>
    	 		<input type="text" name="nom" placeholder="Nom" class="form-control">
    	 	</div>
    	 </div>
    	 <div class="form-row">
    	 	<div class="col">
    	 		<label for='theme'><input type='checkbox' name='recherchetheme'> Theme</label>
    	 		<?php ListeTheme();
    	 		?>
    	 	</div>

    	 </div>
    	 
    	 	
    	 
    	  <div class="form-row">
    	 	<div class="col">
    	 		<label for='theme'><input type='checkbox' name='recherchetype'> Type</label>
    	 		<?php
    	 		SelectType()
    	 		?>
    	 	</div>
    	 </div>
    	 <div class="form-row">
    	 	<div class="col">
    	 		<br>
    	 		<button type='submit'name='recherche'class='btn btn-primary'><i class="fas fa-search"></i> Rechercher</button>
    	 	</div>
    	 </div>
    	 <br>
    	 <br>
    	</form>
		<hr>

<?php
if(isset($_POST['recherche']))//verifie si l'utilisateur a valider la recherche
{
	$con=Conn();

	if(isset($_POST['recherchenom'])&isset($_POST['recherchetheme'])&empty($_POST['recherchetype']))
	{
		///recherche par nom,theme
			$_POST['nom']="%".$_POST['nom']."%";
		$nom=$_POST['nom'];
		$theme=$_POST['theme'];

		if($theme==0){
	$req=$con->prepare("SELECT *,DATE_FORMAT(DATE_ART, '%e %M %Y') AS DATEMODIF FROM article,serie WHERE article.No_document=serie.No_document AND NOM_ARTICLE LIKE :nom");
		$req->BindParam(":nom",$nom);
			$req->execute();
		while($ligne1=$req->fetch())
		{
			///Recuperer le nom prenom de l'utilisateur/////
			echo"<form action='index.php?page=Article'>";
			$req1=$con->prepare("SELECT NOM,PRENOM FROM utilisateur WHERE NO_UTILISATEUR=:NO_UTILISATEUR");
			$req1->BindParam(':NO_UTILISATEUR',$ligne1['NO_UTILISATEUR']);
			//$req1="SELECT NOM,PRENOM FROM utilisateur WHERE NO_UTILISATEUR='".$ligne1['NO_UTILISATEUR']."'";
			$req1->fetch();
			//$res2=mysqli_query($con,$req1);

			$ligne4=$req1->fetch();


				echo"<div class='form'>";
		echo "<a type='submit' style='text-decoration-color:black;text-decoration:none;display:flex;margin-bottom:10px;font-size: 20px;' class='btn btn-secondary' href='index.php?page=Article&id=".$ligne1['NO_ARTICLE']."'>";	
		

		
			
			
			echo"<div class='col-2'><img class='img-thumbnail img-fluid'src='test/Serie/".$ligne1["Photo"]. "'>";echo"</div>";	
				echo"<div class='col float-right'>";echo "<h2 style='color:black'>";echo $ligne1['NOM_ARTICLE'];echo "</h2>";	
				echo"<br><div>";echo $ligne1['Description'];echo"</div>";
				
				
				echo" </div>";
				echo"<div class='col-sm col-lg-2'>";
				echo $ligne1['DATEMODIF'];
				echo"<br>";
				echo "<br>";
				echo "<br>";
				echo "<br>";
				echo "Ecrit par ";echo $ligne4['NOM']; echo "&nbsp";echo $ligne4['PRENOM']; 
				echo "</div>";
				echo "</a>";
		echo "</div>";		
		}
		}
		else
		{
			$req=$con->prepare("SELECT *,DATE_FORMAT(DATE_ART, '%e %M %Y') AS DATEMODIF FROM article,film WHERE article.No_document=film.No_document AND NOM_ARTICLE LIKE :nom");
		$req->BindParam(":nom",$nom);
			$req->execute();
		while($ligne1=$req->fetch())
		{
			///Recuperer le nom prenom de l'utilisateur/////
			echo"<form action='index.php?page=Article'>";
			$req1=$con->prepare("SELECT NOM,PRENOM FROM utilisateur WHERE NO_UTILISATEUR=:NO_UTILISATEUR");
			$req1->BindParam(':NO_UTILISATEUR',$ligne1['NO_UTILISATEUR']);
			//$req1="SELECT NOM,PRENOM FROM utilisateur WHERE NO_UTILISATEUR='".$ligne1['NO_UTILISATEUR']."'";
			$req1->fetch();

			$ligne4=$req1->fetch();


				echo"<div class='form'>";
		echo "<a type='submit' style='text-decoration-color:black;text-decoration:none;display:flex;margin-bottom:10px;font-size: 20px;' class='btn btn-secondary' href='index.php?page=Article&id=".$ligne1['NO_ARTICLE']."'>";	
		

		
			
			
			echo"<div class='col-2'><img class='img-thumbnail img-fluid'src='test/Serie/".$ligne1["Photo"]. "'>";echo"</div>";	
				echo"<div class='col float-right'>";echo "<h2 style='color:black'>";echo $ligne1['NOM_ARTICLE'];echo "</h2>";	
				echo"<br><div>";echo $ligne1['Description'];echo"</div>";
				
				
				echo" </div>";
				echo"<div class='col-sm col-lg-2'>";
				echo $ligne1['DATEMODIF'];
				echo"<br>";
				echo "<br>";
				echo "<br>";
				echo "<br>";
				echo "Ecrit par ";echo $ligne4['NOM']; echo "&nbsp";echo $ligne4['PRENOM']; 
				echo "</div>";
				echo "</a>";
		echo "</div>";		
		}
		}
		}
	
	///recherche par Nom
	if(isset($_POST['recherchenom'])&empty($_POST['recherchetheme'])&empty($_POST['recherchetype']))
	{
	$_POST['nom']="%".$_POST['nom']."%";
	$nom=$_POST['nom'];
		$req=$con->prepare("SELECT *,DATE_FORMAT(DATE_ART, '%e %M %Y') AS DATEMODIF FROM article  WHERE NOM_ARTICLE LIKE :nom");
		$req->BindParam(':nom',$nom);
		$req->execute();
		while($ligne2=$req->fetch())
		{
			$req1=$con->prepare("SELECT NOM,PRENOM FROM utilisateur WHERE NO_UTILISATEUR=:NO_UTILISATEUR");
			$req1->BindParam(':NO_UTILISATEUR',$ligne2['NO_UTILISATEUR']);
			$req1->execute();
			$ligne4=$req1->fetch();
	
				echo"<div class='form'>";
		echo "<a type='submit' style='text-decoration-color:black;text-decoration:none;display:flex;margin-bottom:10px;font-size: 20px;' class='btn btn-secondary' href='index.php?page=Article&id=".$ligne2['NO_ARTICLE']."'>";	
		

		
			
			
			echo"<div class='col-2'><img class='img-thumbnail img-fluid'src='test/Serie/".$ligne2["Photo"]. "'>";echo"</div>";	
				echo"<div class='col float-right'>";echo "<h2 style='color:black'>";echo $ligne2['NOM_ARTICLE'];echo "</h2>";	
				echo"<br><div>";echo $ligne2['Description'];echo"</div>";
				
				
				echo" </div>";
				echo"<div class='col-sm col-lg-2'>";
				echo $ligne2['DATEMODIF'];
				echo"<br>";
				echo "<br>";
				echo "<br>";
				echo "<br>";
				echo "Ecrit par ";echo $ligne4['NOM']; echo "&nbsp";echo $ligne4['PRENOM']; 
				echo "</div>";
				echo "</a>";
		echo "</div>";	
		}
	}
	///Recherche par Theme
	if(empty($_POST['recherchenom'])&isset($_POST['recherchetheme'])&empty($_POST['recherchetype']))
	{
		echo"<form action='index.php?page=Article'>";
		$theme=$_POST['theme'];

		if($theme==0)
		{
$req=$con->prepare("SELECT *,DATE_FORMAT(DATE_ART, '%e %M %Y') AS DATE_MODIF FROM article,serie  WHERE article.No_Document=serie.No_Document");
$req->execute();
while($ligne3=$req->fetch())
		{
			$req1=$con->prepare("SELECT NOM,PRENOM FROM utilisateur WHERE NO_UTILISATEUR=:NO_UTILISATEUR");
			$req1->BindParam(":NO_UTILISATEUR",$ligne3['NO_UTILISATEUR']);
			$req1->execute();
			$ligne4=$req1->fetch();
			echo"<div class='form'>";
			


			echo "<a type='submit' style='text-decoration-color:black;text-decoration:none;display:flex;margin-bottom:10px;font-size: 20px;' class='btn btn-secondary' href='index.php?page=Article&id=".$ligne3['NO_ARTICLE']."'>";	
		

		
			
			
			echo"<div class='col-2'><img class='img-thumbnail img-fluid'src='test/Serie/".$ligne3["Photo"]. "'>";echo"</div>";	
				echo"<div class='col float-right'>";echo "<h2 style='color:black'>";echo $ligne3['NOM_ARTICLE'];echo "</h2>";	
				echo"<br><div>";echo $ligne3['Description'];echo"</div>";
				
				
				echo" </div>";
				echo"<div class='col-sm col-lg-2'>";
				echo $ligne3['DATE_MODIF'];
				echo"<br>";
				echo "<br>";
				echo "<br>";
				echo "<br>";
				echo "Ecrit par ";echo $ligne4['NOM']; echo "&nbsp";echo $ligne4['PRENOM']; 
				echo "</div>";
				echo "</a>";
		echo "</div>";	
		}
}
		else
		{
$req=$con->prepare("SELECT *,DATE_FORMAT(DATE_ART, '%e %M %Y') AS DATE_MODIF FROM article,film  WHERE article.No_Document=film.No_Document");
$req->execute();
while($ligne3=$req->fetch())
		{
			$req1=$con->prepare("SELECT NOM,PRENOM FROM utilisateur WHERE NO_UTILISATEUR=:NO_UTILISATEUR");
			$req1->BindParam(":NO_UTILISATEUR",$ligne3['NO_UTILISATEUR']);
			$req1->execute();
			$ligne4=$req1->fetch();
			echo"<div class='form'>";
			


			echo "<a type='submit' style='text-decoration-color:black;text-decoration:none;display:flex;margin-bottom:10px;font-size: 20px;' class='btn btn-secondary' href='index.php?page=Article&id=".$ligne3['NO_ARTICLE']."'>";	
		

		
			
			
			echo"<div class='col-2'><img class='img-thumbnail img-fluid'src='test/Serie/".$ligne3["Photo"]. "'>";echo"</div>";	
				echo"<div class='col float-right'>";echo "<h2 style='color:black'>";echo $ligne3['NOM_ARTICLE'];echo "</h2>";	
				echo"<br><div>";echo $ligne3['Description'];echo"</div>";
				
				
				echo" </div>";
				echo"<div class='col-sm col-lg-2'>";
				echo $ligne3['DATE_MODIF'];
				echo"<br>";
				echo "<br>";
				echo "<br>";
				echo "<br>";
				echo "Ecrit par ";echo $ligne4['NOM']; echo "&nbsp";echo $ligne4['PRENOM']; 
				echo "</div>";
				echo "</a>";
		echo "</div>";	
		}

		}
		
		
	
	}
	///Recherche par Nom,Theme,Type
	if(isset($_POST['recherchenom'])&isset($_POST['recherchetheme'])&isset($_POST['recherchetype']))
	{
		echo"<form action='index.php?page=Article'>";
		$_POST['nom']="%".$_POST['nom']."%";
		$theme=$_POST['theme'];
		$type=$_POST['type'];
		$nom=$_POST['nom'];

		if($theme==0)
		{
			$req=$con->prepare("SELECT DISTINCT NO_ARTICLE ,NO_UTILISATEUR,Photo,NOM_ARTICLE,Description,DATE_FORMAT(DATE_ART, '%e %M %Y') AS DATE_MODIF FROM article,serie WHERE article.No_document=serie.No_document AND NOM_ARTICLE LIKE :nom AND No_Type_Art =:type");
		$req->BindParam(":nom",$nom);
		$req->BindParam(":type",$type);
		$req->execute();
		
		while($ligne5=$req->fetch())
		{
			$req1=$con->prepare("SELECT NOM,PRENOM FROM utilisateur WHERE NO_UTILISATEUR=:NO_UTILISATEUR");
			$req1->BindParam(":NO_UTILISATEUR",$ligne5['NO_UTILISATEUR']);
			$req1->execute();
			$ligne4=$req1->fetch();
			echo"<div class='form'>";
		echo "<a type='submit' style='text-decoration-color:black;text-decoration:none;display:flex;margin-bottom:10px;font-size: 20px;' class='btn btn-secondary' href='index.php?page=Article&id=".$ligne5['NO_ARTICLE']."'>";	
		

		
			
			
			echo"<div class='col-2'><img class='img-thumbnail img-fluid'src='test/Serie/".$ligne5["Photo"]. "'>";echo"</div>";	
				echo"<div class='col float-right'>";echo "<h2 style='color:black'>";echo $ligne5['NOM_ARTICLE'];echo "</h2>";	
				echo"<br><div>";echo $ligne5['Description'];echo"</div>";
				
				
				echo" </div>";
				echo"<div class='col-sm col-lg-2'>";
				echo $ligne5['DATE_MODIF'];
				echo"<br>";
				echo "<br>";
				echo "<br>";
				echo "<br>";
				echo "Ecrit par ";echo $ligne4['NOM']; echo "&nbsp";echo $ligne4['PRENOM']; 
				echo "</div>";
				echo "</a>";
		echo "</div>";	
		}
		}
		else
		{
			$req=$con->prepare("SELECT DISTINCT NO_ARTICLE ,NO_UTILISATEUR,Photo,NOM_ARTICLE,Description ,DATE_FORMAT(DATE_ART, '%e %M %Y') AS DATE_MODIF FROM article,film WHERE NOM_ARTICLE LIKE :nom AND No_Type_Art =:type");
		$req->BindParam(":nom",$nom);
		$req->BindParam(":type",$type);
		$req->execute();
		
		while($ligne5=$req->fetch())
		{
			$req1=$con->prepare("SELECT NOM,PRENOM FROM utilisateur WHERE NO_UTILISATEUR=:NO_UTILISATEUR");
			$req1->BindParam(":NO_UTILISATEUR",$ligne5['NO_UTILISATEUR']);
			$req1->execute();
			$ligne4=$req1->fetch();
			echo"<div class='form'>";
		echo "<a type='submit' style='text-decoration-color:black;text-decoration:none;display:flex;margin-bottom:10px;font-size: 20px;' class='btn btn-secondary' href='index.php?page=Article&id=".$ligne5['NO_ARTICLE']."'>";	
		

		
			
			
			echo"<div class='col-2'><img class='img-thumbnail img-fluid'src='test/Serie/".$ligne5["Photo"]. "'>";echo"</div>";	
				echo"<div class='col float-right'>";echo "<h2 style='color:black'>";echo $ligne5['NOM_ARTICLE'];echo "</h2>";	
				echo"<br><div>";echo $ligne5['Description'];echo"</div>";
				
				
				echo" </div>";
				echo"<div class='col-sm col-lg-2'>";
				echo $ligne5['DATE_MODIF'];
				echo"<br>";
				echo "<br>";
				echo "<br>";
				echo "<br>";
				echo "Ecrit par ";echo $ligne4['NOM']; echo "&nbsp";echo $ligne4['PRENOM']; 
				echo "</div>";
				echo "</a>";
		echo "</div>";	
		}
		}
		
	}
	///Recherche par Nom,theme,type
	if(isset($_POST['recherchenom'])&isset($_POST['recherchetheme'])&isset($_POST['recherchetype']))
	{
		echo"<form action='index.php?page=Article'>";
		$theme=$_POST['theme'];
		$type=$_POST['type'];
		$_POST['nom']='%'+$_POST['nom']+'%';
		$nom=$_POST['nom'];
		
		$req=$con->prepare("SELECT *,DATE_FORMAT(DATE_ART, '%e %M %Y') AS DATEMODIF FROM article WHERE NOM_ARTICLE LIKE :nom %'AND NO_THEME=:theme AND No_Type =:type");
		$req->BindParam(':nom',$nom);
		$req->BindParam(':theme',$theme);
		$req->BindParam(':type',$type);
		$req->execute();
		while($ligne5=$req->fetch())
		{
			$req1=$con->prepare("SELECT NOM,PRENOM FROM utilisateur WHERE NO_UTILISATEUR=:NO_UTILISATEUR");
			$req1->BindParam(":NO_UTILISATEUR",$ligne5['NO_UTILISATEUR']);
			$req1->execute();
			$ligne4=$req1->fetch();
			echo"<div class='form'>";
		echo "<a type='submit' style='text-decoration-color:black;text-decoration:none;display:flex;margin-bottom:10px;font-size: 20px;' class='btn btn-secondary' href='index.php?page=Article&id=".$ligne5['NO_ARTICLE']."'>";	
			echo"<div class='col-2'><img class='img-thumbnail img-fluid'src='test/".$ligne5["Photo"]. "'>";echo"</div>";	
				echo"<div class='col float-right'>";echo "<h2 style='color:black'>";echo $ligne5['NOM_ARTICLE'];echo "</h2>";	
				echo"<br><div>";echo $ligne5['Description'];echo"</div>";
				
				
				echo" </div>";
				echo"<div class='col-sm col-lg-2'>";
				echo $ligne5['DATEMODIF'];
				echo"<br>";
				echo "<br>";
				echo "<br>";
				echo "<br>";
				echo "Ecrit par ";echo $ligne4['NOM']; echo "&nbsp";echo $ligne4['PRENOM']; 
				echo "</div>";
				echo "</a>";
		echo "</div>";	
		}
	}
	///Recherche par type
	if(empty($_POST['recherchenom'])&empty($_POST['recherchetheme'])&isset($_POST['recherchetype'])&empty($_POST['recherchegenre']))
	{
		echo"<form action='index.php?page=Article'>";
		$type=$_POST['type'];
		
		$req=$con->prepare("SELECT *,DATE_FORMAT(DATE_ART, '%e %M %Y') AS DATEMODIF FROM article WHERE No_Type_ART =:type");
		$req->BindParam(":type",$type);
		$req->execute();
		while($ligne5=$req->fetch())
		{
			$req1=$con->prepare("SELECT NOM,PRENOM FROM utilisateur WHERE NO_UTILISATEUR=:NO_UTILISATEUR");
			$req1->BindParam(":NO_UTILISATEUR",$ligne5['NO_UTILISATEUR']);
			$req1->execute();
			$ligne4=$req1->fetch();
			echo"<div class='form'>";
		echo "<a type='submit' style='text-decoration-color:black;text-decoration:none;display:flex;margin-bottom:10px;font-size: 20px;' class='btn btn-secondary' href='index.php?page=Article&id=".$ligne5['NO_ARTICLE']."'>";	
		

		
			
			
			echo"<div class='col-2'><img class='img-thumbnail img-fluid'src='test/Serie/".$ligne5["Photo"]. "'>";echo"</div>";	
				echo"<div class='col float-right'>";echo "<h2 style='color:black'>";echo $ligne5['NOM_ARTICLE'];echo "</h2>";	
				echo"<br><div>";echo $ligne5['Description'];echo"</div>";
				
				
				echo" </div>";
				echo"<div class='col-sm col-lg-2'>";
				echo $ligne5['DATEMODIF'];
				echo"<br>";
				echo "<br>";
				echo "<br>";
				echo "<br>";
				echo "Ecrit par ";echo $ligne4['NOM']; echo "&nbsp";echo $ligne4['PRENOM']; 
				echo "</div>";
				echo "</a>";
		echo "</div>";	
		}
	}
	///Recherche par genre
	if(empty($_POST['recherchenom'])&empty($_POST['recherchetheme'])&empty($_POST['recherchetype'])&isset($_POST['recherchegenre']))
	{
		echo"<form action='index.php?page=Article'>";
		$genre=$_POST['genre'];
		
		$req=$con->prepare("SELECT *,DATE_FORMAT(DATE_ART, '%e %M %Y') AS DATEMODIF FROM article WHERE No_Genre =:genre");
		$req->BindParam(':genre',$genre);
		$req->execute();
		while($ligne5=$req->fetch())
		{
			$req1=$con->prepare("SELECT NOM,PRENOM FROM utilisateur WHERE NO_UTILISATEUR=:NO_UTILISATEUR");
			$req1->BindParam(':NO_UTILISATEUR',$ligne5['NO_UTILISATEUR']);
			$req1->execute();
			$ligne4=$req1->fetch();
			echo"<div class='form'>";
		echo "<a type='submit' style='text-decoration-color:black;text-decoration:none;display:flex;margin-bottom:10px;font-size: 20px;' class='btn btn-secondary' href='index.php?page=Article&id=".$ligne5['NO_ARTICLE']."'>";	
		

		
			
			
			echo"<div class='col-2'><img class='img-thumbnail img-fluid'src='test/".$ligne5["Photo"]. "'>";echo"</div>";	
				echo"<div class='col float-right'>";echo "<h2 style='color:black'>";echo $ligne5['NOM_ARTICLE'];echo "</h2>";	
				echo"<br><div>";echo $ligne5['Description'];echo"</div>";
				
				
				echo" </div>";
				echo"<div class='col-sm col-lg-2'>";
				echo $ligne5['DATEMODIF'];
				echo"<br>";
				echo "<br>";
				echo "<br>";
				echo "<br>";
				echo "Ecrit par ";echo $ligne4['NOM']; echo "&nbsp";echo $ligne4['PRENOM']; 
				echo "</div>";
				echo "</a>";
		echo "</div>";	
		}
	}
		///Recherche par Nom,type
	if(isset($_POST['recherchenom'])&empty($_POST['recherchetheme'])&isset($_POST['recherchetype']))
	{
		echo"<form action='index.php?page=Article'>";
		$type=$_POST['type'];
		$_POST['nom']="%".$_POST['nom']."%";
		$nom=$_POST['nom'];
		
		$req=$con->prepare("SELECT *,DATE_FORMAT(DATE_ART, '%e %M %Y') AS DATEMODIF FROM article WHERE NOM_ARTICLE LIKE :nom  AND No_Type_Art = :type");
		$req->BindParam(':nom',$nom);
		$req->BindParam(':type',$type);
		$req->execute();
		while($ligne5=$req->fetch())
		{
			$req1=$con->prepare("SELECT NOM,PRENOM FROM utilisateur WHERE NO_UTILISATEUR=:NO_UTILISATEUR");
			$req1->BindParam(':NO_UTILISATEUR',$ligne5['NO_UTILISATEUR']);
			$req1->execute();
			$ligne4=$req1->fetch();
			echo"<div class='form'>";
		echo "<a type='submit' style='text-decoration-color:black;text-decoration:none;display:flex;margin-bottom:10px;font-size: 20px;' class='btn btn-secondary' href='index.php?page=Article&id=".$ligne5['NO_ARTICLE']."'>";	
			echo"<div class='col-2'><img class='img-thumbnail img-fluid'src='test/Serie/".$ligne5["Photo"]. "'>";echo"</div>";	
				echo"<div class='col float-right'>";echo "<h2 style='color:black'>";echo $ligne5['NOM_ARTICLE'];echo "</h2>";	
				echo"<br><div>";echo $ligne5['Description'];echo"</div>";
				echo" </div>";
				echo"<div class='col-sm col-lg-2'>";
				echo $ligne5['DATEMODIF'];
				echo"<br>";
				echo "<br>";
				echo "<br>";
				echo "<br>";
				echo "Ecrit par ";echo $ligne4['NOM']; echo "&nbsp";echo $ligne4['PRENOM']; 
				echo "</div>";
				echo "</a>";
		echo "</div>";	
		}
	}
	///Recherche par theme,type
	if(empty($_POST['recherchenom'])&isset($_POST['recherchetheme'])&isset($_POST['recherchetype'])&empty($_POST['recherchegenre']))
	{
		echo"<form action='index.php?page=Article'>";
		$theme=$_POST['theme'];
		$type=$_POST['type'];
		
		if($theme==0)
		{
$req=$con->prepare("SELECT *,DATE_FORMAT(DATE_ART, '%e %M %Y') AS DATEMODIF FROM article,serie WHERE article.No_Document=serie.No_Document AND No_Type_Art =:type");
		$req->BindParam(':type',$type);
		$req->execute();
		while($ligne5=$req->fetch())
		{
			$req1=$con->prepare("SELECT NOM,PRENOM FROM utilisateur WHERE NO_UTILISATEUR=:NO_UTILISATEUR");
			$req1->BindParam(':NO_UTILISATEUR',$ligne5['NO_UTILISATEUR']);
			$req1->execute();
			$ligne4=$req1->fetch();
			echo"<div class='form'>";
		echo "<a type='submit' style='text-decoration-color:black;text-decoration:none;display:flex;margin-bottom:10px;font-size: 20px;' class='btn btn-secondary' href='index.php?page=Article&id=".$ligne5['NO_ARTICLE']."'>";		
			echo"<div class='col-2'><img class='img-thumbnail img-fluid'src='test/Serie/".$ligne5["Photo"]. "'>";echo"</div>";	
				echo"<div class='col float-right'>";echo "<h2 style='color:black'>";echo $ligne5['NOM_ARTICLE'];echo "</h2>";	
				echo"<br><div>";echo $ligne5['Description'];echo"</div>";
				echo" </div>";
				echo"<div class='col-sm col-lg-2'>";
				echo $ligne5['DATEMODIF'];
				echo"<br>";
				echo "<br>";
				echo "<br>";
				echo "<br>";
				echo "Ecrit par ";echo $ligne4['NOM']; echo "&nbsp";echo $ligne4['PRENOM']; 
				echo "</div>";
				echo "</a>";
		echo "</div>";	
		}
		}
		else
		{
$req=$con->prepare("SELECT *,DATE_FORMAT(DATE_ART, '%e %M %Y') AS DATEMODIF FROM article,film WHERE film.No_Document=article.No_Document AND No_Type_Art =:type");
		$req->BindParam(':type',$type);
		$req->execute();
		while($ligne5=$req->fetch())
		{
			$req1=$con->prepare("SELECT NOM,PRENOM FROM utilisateur WHERE NO_UTILISATEUR=:NO_UTILISATEUR");
			$req1->BindParam(':NO_UTILISATEUR',$ligne5['NO_UTILISATEUR']);
			$req1->execute();
			$ligne4=$req1->fetch();
			echo"<div class='form'>";
		echo "<a type='submit' style='text-decoration-color:black;text-decoration:none;display:flex;margin-bottom:10px;font-size: 20px;' class='btn btn-secondary' href='index.php?page=Article&id=".$ligne5['NO_ARTICLE']."'>";		
			echo"<div class='col-2'><img class='img-thumbnail img-fluid'src='test/Serie/".$ligne5["Photo"]. "'>";echo"</div>";	
				echo"<div class='col float-right'>";echo "<h2 style='color:black'>";echo $ligne5['NOM_ARTICLE'];echo "</h2>";	
				echo"<br><div>";echo $ligne5['Description'];echo"</div>";
				echo" </div>";
				echo"<div class='col-sm col-lg-2'>";
				echo $ligne5['DATEMODIF'];
				echo"<br>";
				echo "<br>";
				echo "<br>";
				echo "<br>";
				echo "Ecrit par ";echo $ligne4['NOM']; echo "&nbsp";echo $ligne4['PRENOM']; 
				echo "</div>";
				echo "</a>";
		echo "</div>";	
		}
		}

	}






}

/////Modif a faire ici///
$con=Conn();
$req=$con->prepare("SELECT MAX(NB) AS NB,Nom_Genre FROM compter,genre WHERE genre.No_Genre=compter.No_Genre");
$req->execute();
$ligne=$req->fetch(
	
);
