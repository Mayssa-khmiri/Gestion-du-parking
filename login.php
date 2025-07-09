<html>
 <head>
 <meta charset="utf-8">
 <!-- importer le fichier de style -->
 <link rel="stylesheet" href="login.css" media="screen" type="text/css" />
 </head>
 <body>
 <div id="container">
 <!-- zone de connexion -->
 
 <form action="verification.php" method="POST">
 <h1>Connexion</h1>
 
 <label><b>Nom</b></label>
 <input type="text" placeholder="Entrer le nom " name="nom" required>

 <label><b>Mot de passe</b></label>
 <input type="password" placeholder="Entrer le mot de passe" name="motdepasse" required>

 
 <label><b>Email</b></label>
 <input type="text" placeholder="Entrer l'email" name="email" required>

 <input type="submit" id='submit' value='LOGIN' >
 <?php
 if(isset($_GET['erreur'])){
 $err = $_GET['erreur'];
 if($err==1 || $err==2)
 echo "<p style='color:red'>nom ou mot de passe incorrect</p>";
 }
 ?>
 </form>
 </div>
 </body>
</html>