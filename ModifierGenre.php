<?php
$con=Conn();
$req=$con->prepare("SELECT * FROM genre WHERE genre.No_Genre=:id");
$req->BindParam(':id',$_GET['id']);
//$req="SELECT * FROM Genre WHERE Genre.No_Genre='".$_GET['id']."'";
$req->execute();
//$res=mysqli_query($con,$req);
$ligne=$req->fetch();
?>
<body style="font-family:Marmelad; font-size: 18px;">
   
    <div class="container" style="margin-top:50px; text-left;">
	<div style='border: 1px solid black;border-radius: 2%;background-color: lightblue;'>
	<div style='margin-left: 5px; margin-top:5px;margin-right:5px'>
    	 <h3 class="font-weight-bold text-center text-uppercase mb-4">Modifier Genre</h3>
<form action=''method='POST'>
    	 <div class='form-row'>
    	 	<div class="col">
    	 		<label for='nom'>Nom</label>
    	 		<?php echo"<input type='text' name='nom'class='form-control'value='".$ligne['Nom_Genre']."'>";
    	 		?>
    	 	</div>
    	 </div>	
    	 <br>
    	 <div class='form-row'>
    	 	<div class="col">
    	 		<button type="submit" class="btn btn-warning" name='modif'>Modifier</button>
    	 	</div>
			 </div>
			 </div>
    	 </div>	

  <?php
  if(isset($_POST['modif']))
  {
  	$nom=$_POST['nom'];
	  $id=$_GET['id'];
	  //requete modification d'un genre
	  $req2=$con->prepare("UPDATE genre SET Nom_Genre=:nom WHERE No_Genre=:id");
	  $req2->BindParam(':id',$id);
	  $req2->BindParam(':nom',$nom);
  //	$req2="UPDATE Genre SET Nom_Genre='".$nom."' WHERE No_Genre='".$id."'";
  $req2->execute();
  //	$res2=mysqli_query($con,$req2);
  ?>
  <script>
  document.location.href='index.php?page=genre'
  </script>
  <?php
  	header("Location:index.php?page=genre");
  }