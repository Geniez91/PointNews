<?php
function Conn()
{
	$dsn='mysql:dbname=dbs2203948;host=db5002762303.hosting-data.io';
	$user='dbu1663233';
	$password='2uR35hqtVJ-Z@8J';
	$con=new PDO($dsn,$user,$password,array
(
    PDO::MYSQL_ATTR_INIT_COMMAND
    => 
    "SET lc_time_names='fr_FR'"
));
	$con->exec("SET NAMES 'UTF8'");
	//$con=mysqli_connect('localhost','root','','pointnews');
	//mysqli_set_charset ( $con , 'utf8' );
	return $con;
}
function SeConnecter()
{
	$con=Conn();
	if(isset($_POST['connexion']))	
	{
	$login=$_POST['login'];
	$mdp=$_POST['mdp'];
	$mdp=sha1($mdp);
	if(empty($login)&&empty($mdp))
	{
		echo "Veuillez Saisir Votre Login ou Votre Mot de Passe";
	}
	else{
	$req=$con->prepare("SELECT NO_UTILISATEUR,NO_TYPE FROM utilisateur WHERE login=:login AND MDP=:mdp");
	$req->BindParam(':login',$login);
	$req->BindParam(':mdp',$mdp);
	
	//$req="SELECT NO_UTILISATEUR,NO_TYPE FROM utilisateur WHERE login='".$login."' AND MDP='".$mdp."'";

	$req->execute();
		if($req->rowCount()==0)
		{
			echo"Login ou Mot de Passe Incorrect";
		}
		else
		{
$donnes=$req->fetch();
echo"Vous etes Connecté";
$_SESSION['id']=$donnes['NO_UTILISATEUR'];
$_SESSION['type']=$donnes['NO_TYPE'];
?>
<script>
document.location.href="index.php?page=Accueil"
</script>
<?php
		}

	}
	

	//$res=mysqli_query($con,$req);
	
	//	if(mysqli_num_rows($res)==0)
	//	{
	//		echo"Login ou Mot de Passe Incorrect";
	//	}
	//	else 
	//	{
	//	$ligne=mysqli_fetch_array($res);
	//	echo"Vous etes Connecté";
	//	$_SESSION['id']=$ligne['NO_UTILISATEUR'];
	//	$_SESSION['type']=$ligne['NO_TYPE'];
	//	header("Location:index.php");
    //
	//	}

	
	
	
	
	
	

}
}
function TraitementInscription()
{
	$con=Conn();
if(isset($_POST['inscription']))
{
	$login=$_POST['login'];
	$mdp=$_POST['mdp'];
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$datenaiss=$_POST['datenaiss'];
	$email=$_POST['email'];
	if(empty($login)&empty($mdp)&empty($nom)&empty($prenom
	)&empty($datenaiss)&empty($email))
	{
		echo"Veuillez saiisir Tous les champs demander";
	}
	else
	{
		$mdp=sha1($mdp);
	$image1 = $_FILES['image']['name'];//creation de la variable files
	$target = "test/Profil/".basename($image1);//saisie du dossier ou souhaite le mettre

	$req=$con->prepare("INSERT INTO utilisateur(LOGIN,MDP,NOM,PRENOM,DATENAISS,EMAIL,NO_TYPE,Photo)VALUES(:login,:mdp,:nom,:prenom,:datenaiss,:email,'3',:image)");
	//$req="INSERT INTO utilisateur(LOGIN,MDP,NOM,PRENOM,DATENAISS,EMAIL,NO_TYPE,	Photo)VALUES('".$login."','".$mdp."','".$nom."','".$prenom."','"	.$datenaiss."','".$email."','3','".$image1."')";
    $req->BindParam(':login',$login);
	 $req->BindParam(':mdp',$mdp);
	 $req->BindParam(':nom',$nom);
	 $req->BindParam(':prenom',$prenom);
	  $req->BindParam(':datenaiss',$datenaiss);
	  $req->BindParam(':email',$email);
      $req->BindParam(':image',$image1);
	  if($req->execute())
		{
			if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) 
			{///verification que la photo a bien été envoyé//
			$msg = "Image exporter ";
		}
		else{

			$msg = "Failed to upload image";
		}
		echo"Compte Crée";
			header("index.php");

		}
		else
			{
				echo"Erreur";
			}
	  
	///if($res=mysqli_query($con,$req))
	//	{
	//		if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) 
			///verification que la photo a bien été envoyé//
//			$msg = "Image exporter ";
//		}
//		else{

//			$msg = "Failed to upload image";
//		}
//			echo"Compte Crée";
//			header("index.php");	
//		}
//		else
//			{
//				echo"Erreur";
//			}

		
}
}
}
function AfficherProfil()
{
	$con=Conn();
	$id=$_SESSION['id'];
	$req=$con->prepare('SELECT * FROM utilisateur WHERE NO_UTILISATEUR=:id');
	//$req="SELECT * FROM utilisateur WHERE NO_UTILISATEUR='".$id."'";
	$req->BindParam(':id',$id);
	//$res=mysqli_query($con,$req);
	$req->execute();
	$ligne=$req->fetch();
	//$ligne=mysqli_fetch_array($res);
	$login=$ligne['LOGIN'];
	$MDP=$ligne['MDP'];
	$NOM=$ligne['NOM'];
	$PRENOM=$ligne['PRENOM'];
	$DATENAISS =$ligne['DATENAISS'];
	$EMAIL=$ligne['EMAIL'];
	echo"
	<div class='form-row'>
			<div class='col'><i class='fas fa-user'></i> Login : ";echo $login; echo"</div>
	</div>
	<br>
	<div class='form-row'>
			<div class='col'><i class='fas fa-key'></i> Mot de Passe :  ";echo $MDP;echo"</div>
		</div>
		<br>
		<div class='form-row'>
			<div class='col'><i class='fas fa-user'></i> Nom :  ";echo $NOM;echo"</div>
		</div>
		<br>
		<div class='form-row'>
			<div class='col'><i class='fas fa-user'></i> Prenom : ";echo $PRENOM;echo"</div>
		</div>
		<br>	
		<div class='form-row'>
			<div class='col'><i class='fas fa-calendar'></i> Date de Naissance &nbsp: ";echo $DATENAISS ;echo"</div>
		</div>
		<br>
		<div class='form-row'>
			<div class='col'><i class='fas fa-envelope-open'></i> Email: ";echo $EMAIL;echo"</div>
		</div>";



	
}	
function Traitementmodif()
{
	$con=Conn();
	$id=$_SESSION['id'];
	$req=$con->prepare("SELECT * FROM utilisateur WHERE NO_UTILISATEUR=:id");
	$req->BindParam(':id',$id);
	//$req="SELECT * FROM utilisateur WHERE NO_UTILISATEUR='".$id."'";
	$req->execute();
	//$res=mysqli_query($con,$req);
	$ligne=$req->fetch();
	//$ligne=mysqli_fetch_array($res);
	$login=$ligne['LOGIN'];
	$MDP=$ligne['MDP'];
	$NOM=$ligne['NOM'];
	$PRENOM=$ligne['PRENOM'];
	$DATENAISS =$ligne['DATENAISS'];
	$EMAIL=$ligne['EMAIL'];


	if(empty($_POST['mdp']))
	{
		$mdp1=$MDP;
	}
	else
	{
		$mdp1=$_POST['mdp'];
	}
	if(empty($_POST['nom']))
	{
		$nom1=$NOM;
	}
	else
	{
		$nom1=$_POST['nom'];
	}
	if(empty($_POST['prenom']))
	{
		$prenom1=$PRENOM;
	}
	else
	{
		$prenom1=$_POST['prenom'];
	}
	if(empty($_POST['mail']))
	{
		$mail1=$EMAIL;
	}
	else
	{
		$mail1=$_POST['mail'];
	}

if(isset($_POST['traitementmodif']))
{
	$id=$_SESSION['id'];
	$req2=$con->prepare("UPDATE utilisateur SET MDP=:mdp1,NOM=:nom1,PRENOM=:prenom1,EMAIL=:mail1 WHERE NO_UTILISATEUR=:id");
	$req2->BindParam(':mdp1',$mdp1);
	$req2->BindParam(':nom1',$nom1);
	$req2->BindParam(':prenom1',$prenom1);
	$req2->BindParam(':mail1',$mail1);
	$req2->BindParam(':id',$id);
	
	//$req2="UPDATE utilisateur SET MDP='".$mdp1."',NOM='".$nom1."',PRENOM='".$prenom1."',EMAIL='".$mail1."'WHERE NO_UTILISATEUR='".$_SESSION['id']."'";
	$req2->execute();
	//$res2=mysqli_query($con,$req2);
}
	
		
		
}
function ListeTheme()
{

	echo "<select name='theme' class='form-control'>";
		echo"<option value='0'>Serie";
		echo"<option value='1'>Film";
		echo"</option>";
		echo "</select>";

	}
	



function AjoutArticle()
{
	$con=Conn();
	
	if(isset($_POST['envoyer']))
	{
	$film=$_POST['film'];
	$utilisateur=$_SESSION['id'];
	$titre=$_POST['titre'];
	$description=$_POST['description'];
	$saisie=$_POST['saisie'];
	$type=$_POST['type'];

	///Traitement image
	$image1 = $_FILES['photo']['name'];
	$target = "image/".basename($image1);

	$req1=$con->prepare("INSERT INTO article(NO_DOCUMENT,NO_UTILISATEUR,NOM_ARTICLE,DATE_ART,Photo,Description,Saisie,NO_TYPE_ART)VALUES(:film,:utilisateur,:titre,Now(),:image1,:description,:saisie,:type)");
	$req1->BindParam(':film',$film);
	$req1->BindParam(':utilisateur',$utilisateur);
	$req1->BindParam(':titre',$titre);
	$req1->BindParam(':image1',$image1);
	$req1->BindParam(':description',$description);
	$req1->BindParam(':saisie',$saisie);
	$req1->BindParam(':type',$type);
	//$req1="INSERT INTO article(NO_THEME,NO_UTILISATEUR,NOM_ARTICLE,DATE,Photo,Description,Saisie,No_Type,No_Genre)VALUES('".$theme."','".$utilisateur."','".$titre."',Now(),'".$image1."','".$description."','".$saisie."','".$type."','".$genre."')";
		
	if($req1->execute())
	{
		move_uploaded_file($_FILES['photo']['tmp_name'], $target) ;
		?>
		<script>
		document.location.href="index.php?page=Accueil"
		</script>
		<?php
		
	}

	}
	}
function ConsulterArticle()
{
	$con=Conn();
	$req=$con->prepare('SELECT * FROM article');
	//$req="SELECT * FROM article ";
	$req->execute();
	//$res=mysqli_query($con,$req);
	

	while($ligne=$req->fetch())
	{
		echo"<div class='row'>";
				

		
				echo"<div class='col-sm col-lg-4'><img src='test/".$ligne["Photo"] . "'>";echo"</div>";	
				echo"<div class='col-sm col-lg-4'>";echo $ligne['NOM_ARTICLE'];	
				echo"<br>";echo $ligne['NO_UTILISATEUR'];
				echo"<br>";echo $ligne['DATE'];
				echo "<br>";echo $ligne['Description'];echo" </div>";
				echo"<div class='col-sm col-lg-4'>";echo "<button type='submit' class='btn btn-primary'> <i class='fas fa-book-open'></i> Voir </button>";	
				echo "</div>";
		echo "</div>";		




				 
			
					

	}
}
function SelectType()
{
	$con=Conn();
	$req=$con->prepare('SELECT * FROM type_article');
	//$req="SELECT * FROM Type_Article";
	$req->execute();
	//$res=mysqli_query($con,$req);
	echo "<select name='type' class='form-control'>";
	while ($ligne=$req->fetch()) {
		$idtype=$ligne['No_Type_Art'];
		$nomtype=$ligne['Nom'];		

		echo"<option value='".$idtype."'>";echo $nomtype;
		echo"</option>";

	}
	echo "</select>";
}



