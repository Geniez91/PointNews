<?php
require("fonction.php");

session_start();
?>
<head>
  <link rel="icon" type="image/png" href="clap.png" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css" />
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/79267a7612.js" crossorigin="anonymous"></script>
  <title>PointNews</title>

  
</head>

	
<nav class="navbar navbar-expand-sm navbar-dark" style="
    background-color: cornflowerblue;">

  <a class="navbar-brand" href="index.php?page=Accueil"><img src='clap.png' style='width:30px;margin-top:-10px'/>  PointNews</a>
  <button class="navbar-toggler" type="button" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <ul class="navbar-nav mr-auto">
    <?php
    if(isset($_SESSION['type']))//verifie si l'utilisateur est connecté
    {
    if($_SESSION['type']=='4')//verifie si l'utilisateur est un administrateur
    {
      ?>
      <li class="nav-item active">
        <a class="nav-link" href="index.php?page=ajoutarticle"><i class="fas fa-plus-circle" style='color:chartreuse;'></i> Ajouter Article</a>
      </li> 
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <i class="fas fa-user-cog" style='color:chocolate'></i> Gestion
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="index.php?page=Compte"> <i class="fas fa-user" style='color:green;'></i> Compte </a>
          <a class="dropdown-item" href="index.php?page=type"> <i class="fas fa-users-cog" style='color:blueviolet'></i> Type Compte </a>
          <a class="dropdown-item" href="index.php?page=typearticle"> <i class="fas fa-users-cog"> Type Article </i></a>
          <a class="dropdown-item" href="index.php?page=genre"> <i class="fas fa-users-cog"> Genre </i></a>
        </div>
        </li>
        <li class="nav-item active">
        <a class="nav-link" href="index.php?page=topArticle"><i class="fas fa-award"></i> Top Article</a>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <i class="fas fa-user-cog"> Creer</i>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="index.php?page=CreerSerie"> <i class="fas fa-user"> Serie </i></a>
          <a class="dropdown-item" href="index.php?page=CreerFilm"> <i class="fas fa-user"> Film </i></a>
      <?php
    }
  

    ?>
     <li class="nav-item active">
        <a class="nav-link" href="index.php?page=consulter"><i class="fas fa-book-open"></i> Consulter Article</a>
      </li>
       <li class="nav-item active">
        <a class="nav-link" href="index.php?page=Series">Series</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="index.php?page=Films"> Films</a>
      </li>

     
      </ul>
      
      
        <a class="nav-link" href="index.php?page=profil"  style='color:white' ><i class="fas fa-user" style='color:green'></i> Mon Profil </a>
      
        <a class="nav-link" href="index.php?page=Deconnexion"  style='color:white'><i class="fas fa-power-off" style='color:yellow'></i> Deconnexion</a>
     
  

  
              
            
      <?php
    }
      if(empty($_SESSION['type']))//verifie si l'utilisateur n'est pas connecté
        {?>
        <li class="nav-item active">
        <a class="nav-link" href="index.php?page=conn" style='color:white'><i class="fas fa-user-alt"></i> Connexion</a>
      </li>
       <li class="nav-item active">
        <a class="nav-link" href="index.php?page=inscription"style='color:white'><i class="fas fa-user-plus"></i> S'inscrire</a>
      </li>
      <?php
    }
    else
      {?>
       
         

      
     
      


    <?php }?>
  </ul>
</nav>
<?php 
if(isset($_GET['page']))
{
	switch ($_GET['page']) {
    case 'conn':
     include("Connexion.php");
      break;
       case 'modifiertheme':
      include("trt_modifier_theme.php");
      break;
    case 'inscription':
      include("Inscription.php");
      break;
      case 'Deconnexion':
      include("Deconnexion.php");
      break;
      case 'profil':
      include("profil.php");
      break;
      case 'ajoutarticle':
      include("AjoutArticle.php");
      break;
      case 'consulter':
      include("Consulter.php");
      break;
       case 'Article':
      include("Article.php");
      break;
      case 'Commentaire':
      include("Commentaire.php");
      break;
      case 'theme':
      include("Theme.php");
      break;
      case 'ajoutTheme':
      include("AjoutTheme.php");
      break;
      case 'Compte':
      include("GestionCompte.php");
      break;
      case 'type':
      include("GestionType.php");
      break;
      case 'ajouttype':
      include("AjoutType.php");
      break;
      case 'modifierarticle':
      include("ModifierArticle.php");
      break;
       case 'supprimerarticle':
      include("SupprimerArticle.php");
      break;
       case 'modifiercommentaire':
      include("ModifierCommentaire.php");
      break;
      case 'supprimercommentaire':
      include("SupprimerCommentaire.php");
      break;
      case 'ModifierCompte':
      include("ModifierCompte.php");
      break;
      case 'Accueil':
      include("accueil.php");
      break;
       case 'typearticle':
      include("GestionTypeArticle.php");
      break;
       case 'ModifierTypeArticle':
      include("ModifierTypeArticle.php");
      break;
       case 'SupprimerTypeArticle':
      include("SupprimerTypeArticle.php");
      break;
       case 'ajouttypeArticle':
      include("AjoutTypeArticle.php");
      break;
        case 'topArticle':
      include("TopArticle.php");
      break;
      case 'genre':
      include("GestionGenre.php");
      break;
       case 'ModifierGenre':
      include("ModifierGenre.php");
      break;
       case 'SupprimerGenre':
      include("SupprimerGenre.php");
      break;
      case 'ajoutgenre':
      include("AjoutGenre.php");
      break;
      case 'CreerSerie':
        include("CreerSerie.php");
        break;
        case 'CreerFilm':
          include("CreerFilm.php");
          break;
        case 'Series':
        include("LesSeries.php");
        break;
          case 'Films':
        include("LesFilms.php");
        break;
        case 'uneserie':
          include('Serie.php');
          break;
        case 'ModifierSaison':
          include('Modifsaison.php');
          break;
        case 'SupprimerSaison':
        include('SupprimerSaison.php');
        break;
        case 'unFilm':
          include('Film.php');
        break;
        case 'ModifierFilm':
          include('ModifierFilm.php');
          break;
          case 'SupprimerFilm':
            include('SupprimerFilm.php') ;
          break;
          case 'ModifierSerie':
            include('ModifierSerie.php');
            break;
            case 'lesArticlesFilm':
              include('LesArticlesFilm.php');
            break;
            case 'lesArticlesSeries':
              include('LesArticlesSeries.php');
              break;
            case 'SaisonsSeries':
              include('SaisonsSeries.php');
              break;
              case 'ajouterepisode':
              include('AjouterEpisode.php');
              break;

    default:
      include("accueil.php");
      break;
  }
}
else
{
  include("accueil.php");
}
  


 ?>


