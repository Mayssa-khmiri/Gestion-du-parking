<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="véhicule.css">
    <title>Liste de véhicule</title>
</head>
<body>
   
   <div class="container">
    <h2>Liste de véhicule</h2>
    <a class="button-new" href="create2.php"  role="button">Nouveau véhicule</a>
    <br>
     <table class="table">
       <thead>
          <tr>
              <th>ID</th>
              <th>Immatricule</th>
              <th>Marque</th>
              <th>Modéle</th>
              <th>Couleur</th>
              <th>Catégorie</th>
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
$emptyCheckQuery = "SELECT COUNT(*) AS count FROM véhicule";
$emptyCheckResult = $conn->query($emptyCheckQuery);
$emptyCheckRow = $emptyCheckResult->fetch_assoc();
if ($emptyCheckRow['count'] == 0) {
 // Réinitialiser l'ID à 1 si la table est vide
 $resetIdQuery = "ALTER TABLE véhicule AUTO_INCREMENT = 1";
 $conn->query($resetIdQuery);
}


          // Read all rows from the database table, sorted by ID in ascending order
          $sql = "SELECT * FROM véhicule ORDER BY idvéhicule ASC";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // Output data of each row 
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>
                          <td>{$row['idvéhicule']}</td>
                          <td>{$row['immatricule']}</td>
                          <td>{$row['marque']}</td>
                          <td>{$row['modéle']}</td>
                          <td>{$row['couleur']}</td>
                          <td>{$row['catégorie']}</td>
                        
                          <td>.
                              <a class='edit'  href='/gestion/update2.php?idvéhicule={$row['idvéhicule']}'>Modifier </a>
                              <a class='delete' href='/gestion/delete2.php?idvéhicule={$row['idvéhicule']}'>Supprimer</a>
                          </td>
                        </tr>";
              }
          } else {
              echo "<tr><td colspan='8'>Aucun véhicule trouvé</td></tr>";
          }
          ?>
        </tbody>
    </table>
   </div>
</body>
</html>