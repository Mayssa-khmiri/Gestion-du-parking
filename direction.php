<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="direction.css">
    <title>Liste de direction</title>
</head>
<body>
   
   <div class="container">
    <h2>Liste de direction</h2>
    <a class="button-new" href="create5.php"  role="button">Nouveau direction</a>
    <br>
     <table class="table">
       <thead>
          <tr>
              <th>ID</th>
              <th>Nom direction</th>
              <th>Description</th>
              <th>Créer le</th>
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
$emptyCheckQuery = "SELECT COUNT(*) AS count FROM direction";
$emptyCheckResult = $conn->query($emptyCheckQuery);
$emptyCheckRow = $emptyCheckResult->fetch_assoc();
if ($emptyCheckRow['count'] == 0) {
 // Réinitialiser l'ID à 1 si la table est vide
 $resetIdQuery = "ALTER TABLE direction AUTO_INCREMENT = 1";
 $conn->query($resetIdQuery);
}


          // Read all rows from the database table, sorted by ID in ascending order
          $sql = "SELECT * FROM direction ORDER BY iddirection ASC";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // Output data of each row 
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>
                          <td>{$row['iddirection']}</td>
                          <td>{$row['nomdirection']}</td>
                          <td>{$row['description']}</td>
                          <td>{$row['creerle']}</td>
                          <td>
                              <a class='edit'  href='/gestion/update5.php?iddirection={$row['iddirection']}'>Modifier</a>
                              <a class='delete' href='/gestion/delete5.php?iddirection={$row['iddirection']}'>Supprimer</a>
                          </td>
                        </tr>";
              }
          } else {
              echo "<tr><td colspan='8'>Aucun direction trouvé</td></tr>";
          }
          ?>
        </tbody>
    </table>
   </div>
</body>
</html>