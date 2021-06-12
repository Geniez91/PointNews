




<body style="font-family:Marmelad; font-size: 18px;">
   
    <div class="container" style="margin-top:50px; text-left;">
    	 <h3 class="font-weight-bold text-center text-uppercase mb-4">Consulter Theme</h3>
    		<table class='table table-striped table-dark'>
                  <tr class='thead-light'>
       		<th> Code <br> <i class='fas fa-user-shield'></i>  </th>
       		<th>Libelle <br> <i class='fas fa-user-cog'></i></th>
                     <th></th>
                     <th></th>
              </tr>
       
       <?php	
       $con=Conn();
       //requete d'affichage des themes
       $req=$con->prepare("SELECT * FROM theme");

//$req="SELECT * FROM theme";
$req->execute();
//$res=mysqli_query($con,$req);
       while ($ligne=$req->fetch()) 
       {  
        $num=$ligne['No_Theme'];
       	echo"<tr>";
       	echo "<td>".$ligne['No_Theme']."</td>";
       	 echo "<td>".$ligne['libelle']."</td>";
         
         echo"<td><a type='submit'class='btn btn-outline-warning' href='index.php?page=modifiertheme&id=".$num."'><i class='fas fa-edit'></i> Modifier</button></td>";
          echo"<input type='hidden' name='modifier' value=".$num."></td>";
         echo"</form>";
         echo"<form action='trt_supprimer_theme.php'>";
         echo"<td><button type='submit'class='btn btn-outline-danger'name='supprimer'><i class='fas fa-trash'></i> Supprimer</button></td>";
         echo"<input type='hidden' name='supprimertheme' value=".$num."></td>";
         echo"</form>";
       	 echo"</tr>";

       	}
        echo "</table>";
        echo"Ajouter Theme <br>";
        echo"<a type='submit'class='btn btn-success' href='index.php?page=ajoutTheme'> <i class='fas fa-plus'></i></a>";
        

    	 

?>


