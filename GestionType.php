<?php
$con=Conn();
//requete pour afficher les informations d'un type d'utilisateur
$req=$con->prepare('SELECT * FROM type_utilisateur');
//$req="SELECT * FROM type_utilisateur";
$req->execute();
//$res=mysqli_query($con,$req);
?>
<body style="font-family:Marmelad; font-size: 18px;">
   
    <div class="container" style="margin-top:50px; text-left;">
    	 <h3 class="font-weight-bold text-center text-uppercase mb-4">Gestion des Types Compte</h3>
    	 <br>
    	 <form 	action=''method='POST'>
    	 	<table class='table table-striped table-dark'>
			 <tr class='thead-light'>
        	 <th><i class='fas fa-user'></i> Libelle</th></tr>
        	<?php
       while($ligne=$req->fetch())
        	 {
        	 	echo "<tr><td>";
        	 	echo $ligne['libelle'];
        	 	echo "</td>";
        	 	echo"</tr>";
        	 }
        	 	?>
</table>

        	 <a type='submit'class='btn btn-success'href='index.php?page=ajouttype'><i class="fas fa-plus"></i> Ajouter</button>