<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="chauffeur.css">
    <title>Liste de chauffeur</title>
</head>
<body>
   
   <div class="container">
    <h2>Liste de chauffeur</h2>
    <a class="button-new" href="create1.php"  role="button">Nouveau chauffeur</a>
    <br>
     <table class="table">
       <thead>
          <tr>
              <th>ID</th>
              <th>Nom</th>
              <th>Prénom</th>
              <th>Téléphone</th>
              <th>Numéro badge</th>
              <th>Action</th>
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
$emptyCheckQuery = "SELECT COUNT(*) AS count FROM chauffeur";
$emptyCheckResult = $conn->query($emptyCheckQuery);
$emptyCheckRow = $emptyCheckResult->fetch_assoc();
if ($emptyCheckRow['count'] == 0) {
 // Réinitialiser l'ID à 1 si la table est vide
 $resetIdQuery = "ALTER TABLE chauffeur AUTO_INCREMENT = 1";
 $conn->query($resetIdQuery);
}


          // Read all rows from the database table, sorted by ID in ascending order
          $sql = "SELECT * FROM chauffeur ORDER BY idchauffeur ASC";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // Output data of each row 
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>
                          <td>{$row['idchauffeur']}</td>
                          <td>{$row['nom']}</td>
                          <td>{$row['prénom']}</td>
                          <td>{$row['téléphone']}</td>
                          <td>{$row['numerobadge']}</td>
                        
                          <td>
                              <a class='edit'  href='/gestion/update1.php?idchauffeur={$row['idchauffeur']}'>Modifier</a>
                              <a class='delete' href='/gestion/delete1.php?idchauffeur={$row['idchauffeur']}'>Supprimer</a>
                          </td>
                        </tr>";
              }
          } else {
              echo "<tr><td colspan='8'>Aucun chauffeur trouvé</td></tr>";
          }
          ?>
        </tbody>
    </table>
   </div>
</body>
</html>