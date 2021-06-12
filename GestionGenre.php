<?php
$con=Conn();
$req=$con->prepare("SELECT * FROM genre");
//$req="SELECT * FROM Genre";
//requete pour afficher les informations d'un genre
$req->execute();
//$res=mysqli_query($con,$req);
?>
<body style="font-family:Marmelad; font-size: 18px;">
   
    <div class="container" style="margin-top:50px; text-left;">
         <h3 class="font-weight-bold text-center text-uppercase mb-4">Gestion des Genres</h3>
         <br>
         <form  action=''method='POST'>
            <table class='table table-striped table-dark'>
            <tr class='thead-light'>
            <th> <i class='fas fa-user'></i> Libelle</th>
            <th></th>
            <th></th>
            </tr>
            <?php
       while($ligne=$req->fetch())
             {
                echo "<tr><td>";
                echo $ligne['Nom_Genre'];
                echo "</td>";
                echo "<td>";
                $id=$ligne['No_Genre'];
                echo "<a type='submit'class='btn btn-warning' href='index.php?page=ModifierGenre&id=".$id."'><i class='fas fa-edit'></i> Modifier </a>";
                echo "</td>";
                echo"<td>";
                echo "<a type='submit'class='btn btn-danger' href='index.php?page=SupprimerGenre&id=".$id."'><i class='fas fa-trash'></i> Supprimer </a>";
                echo "</td>";

                echo"</tr>";
             }
                ?>
</table>
            <a type='submit'class='btn btn-success'href='index.php?page=ajoutgenre'><i class="fas fa-plus"></i> Ajouter</button>