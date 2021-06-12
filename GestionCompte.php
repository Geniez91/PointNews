<?php
$con=Conn();
//requete pour afficher les informations d'un utilisateur
$req=$con->prepare('SELECT * FROM utilisateur,type_utilisateur WHERE utilisateur.NO_TYPE=type_utilisateur.No_Type');
//$req="SELECT * FROM utilisateur,type_utilisateur WHERE utilisateur.NO_TYPE=type_utilisateur.No_Type";
$req->execute();
//$res=mysqli_query($con,$req);
?>
<body style="font-family:Marmelad; font-size: 18px;">
   
    <div class="container" style="margin-top:50px; text-left;">
    	 <h3 class="font-weight-bold text-center text-uppercase mb-4">Gestion des Comptes</h3>
    	 <br>
    	 <form 	action=''method='POST' >

    	 	<table class='table table-striped table-dark'>
			
			 <tr class='thead-light'>
        	<th> <i class='fas fa-user'></i> Login</th>
        	<th><i class='fas fa-user-lock'></i> Mot de Passe</th>
        	<th><i class='fas fa-user'></i> Nom</th>
        	<th><i class='fas fa-user'></i> Prenom</th>
        	<th><i class=''></i> Date de Naisance</th>
        	 <th><i class=''></i> Email </th>	
        	 <th><i class=''></i> Type d'utilisateur </th>	
			 <th></th>
			 
			 </tr>
        	 <?php
        	 while($ligne=$req->fetch())
        	 {
        	 	echo "<tr><td>";
        	 	echo $ligne['LOGIN'];
        	 	echo "</td>";
        	 	echo "<td>";
        	 	echo $ligne['MDP'];
        	 	echo "</td>";
        	 	echo "<td>";
        	 	echo $ligne['NOM'];
        	 	echo "</td>";
        	 	echo "<td>";
        	 	echo $ligne['PRENOM'];
        	 	echo "</td>";
        	 	echo "<td>";
        	 	echo $ligne['DATENAISS'];
        	 	echo "</td>";
        	 	echo "<td>";
        	 	echo $ligne['EMAIL'];
        	 	echo "</td>";
        	 		echo "<td>";
        	 	echo $ligne['libelle'];
        	 	echo "</td>";
        	 	echo "<td>";
                $id=$ligne['NO_UTILISATEUR'];
        	 	echo "<a type='submit'class='btn btn-warning' href='index.php?page=ModifierCompte&id=".$id."'><i class='fas fa-edit'></i> Modifier Type Utilisateur</button>";
        	 	echo "</td>";





        	 }
