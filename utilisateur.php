<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="utilisateur.css">
    <title>Listede  utilisateur</title>
</head>
<body>

   <div class="container">
    <h2>Liste d'utilisateur</h2>
    <a class="button-new" href="create4.php"  role="button">Nouveau utilisateur</a>
    <br>
     <table class="table">
       <thead>
          <tr>
              <th>ID</th>
              <th> Type</th>
              <th>Nom</th>
              <th>Prénom</th>
              <th>Télèphone</th>
              <th>Email</th>
              <th>Mot de passe</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          $database = "gestion de parking";

          // Create connection
          $conn = new mysqli($servername, $username, $password, $database);

          // Check connection
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          // Vérifier si la table des chauffeurs est vide
$emptyCheckQuery = "SELECT COUNT(*) AS count FROM utilisateur";
$emptyCheckResult = $conn->query($emptyCheckQuery);
$emptyCheckRow = $emptyCheckResult->fetch_assoc();
if ($emptyCheckRow['count'] == 0) {
 // Réinitialiser l'ID à 1 si la table est vide
 $resetIdQuery = "ALTER TABLE utilisateur AUTO_INCREMENT = 1";
 $conn->query($resetIdQuery);
}

          // Read all rows from the database table, sorted by ID in ascending order
          $sql = "SELECT * FROM utilisateur ORDER BY idutilisateur ASC";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // Output data of each row 
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>
                          <td>{$row['idutilisateur']}</td>
                          <td>{$row['type']}</td>
                          <td>{$row['nom']}</td>
                          <td>{$row['prenom']}</td>
                          <td>{$row['telephone']}</td>
                          <td>{$row['email']}</td>
                          <td>{$row['motdepasse']}</td>
                        
                          <td>.
                              <a class='edit'  href='/gestion/updat4.php?idutilisateur={$row['idutilisateur']}'>Modifier</a>
                              <a class='delete' href='/gestion/delete4.php?idutilisateur={$row['idutilisateur']}'>Supprimer</a>
                          </td>
                        </tr>";
              }
          } else {
              echo "<tr><td colspan='8'>Aucun utilisateur trouvé</td></tr>";
          }
          ?>
        </tbody>
    </table>
   </div>
</body>
</html>