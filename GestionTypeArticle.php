<?php
$con=Conn();
//requete pour afficher les informations d'un typearticle
$req=$con->prepare('SELECT * FROM 
type_article');
//$req="SELECT * FROM 
//Type_Article";
$req->execute();
//$res=mysqli_query($con,$req);
?>
<body style="font-family:Marmelad; font-size: 18px;">
   
    <div class="container" style="margin-top:50px; text-left;">
    	 <h3 class="font-weight-bold text-center text-uppercase mb-4">Gestion des Types d'Articles</h3>
    	 <br>
    	 <form 	action=''method='POST'>
    	 	 	<table class='table table-striped table-dark'>
				  <tr class='thead-light'>
    	 	 		<th>Nom</th>
					  <th></th>
					  <th></th>
				</tr>
    	 	 		<?php
    	 	 		 while($ligne=$req->fetch())
        	 {
        	 	echo "<tr><td>";
        	 	echo $ligne['Nom'];
        	 	echo "</td>";
        	 	$id=$ligne['No_Type_Art'];
        	 	echo"<td>";
        	 	echo "<a type='submit'class='btn btn-warning' href='index.php?page=ModifierTypeArticle&id=".$id."'><i class='fas fa-edit'></i> Modifier </button>";
        	 	echo "</td>";
        	 	echo"<td>";
        	 	echo "<a type='submit'class='btn btn-danger' href='index.php?page=SupprimerTypeArticle&id=".$id."'><i class='fas fa-edit'></i> Supprimer </button>";
        	 	echo "</td>";
        	 	echo "</tr>";

        	 	}
        	 	?>
      </table>
        	 	 <a type='submit'class='btn btn-success'href='index.php?page=ajouttypeArticle'><i class="fas fa-plus"></i> Ajouter</button>