<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="flux1.css">
    <title>Liste de flux d'accés</title>
</head>
<body>

   <div class="container">
    <h2>Liste de flux d'accés</h2>

     <table class="table">
       <thead>
          <tr>
              <th>ID</th>
              <th>ID véhicule</th>
              <th>Numéro badge</th>
              <th>Nom </th>
              <th>Type</th>
              <th>Immatricule</th>
              <th>Date</th>
              <th>Heure</th>
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

          // Vérifier si la table des flux est vide
$emptyCheckQuery = "SELECT COUNT(*) AS count FROM `flux` WHERE 1";
$emptyCheckResult = $conn->query($emptyCheckQuery);
$emptyCheckRow = $emptyCheckResult->fetch_assoc();
if ($emptyCheckRow['count'] == 0) {
 // Réinitialiser l'ID à 1 si la table est vide
 $resetIdQuery = "ALTER TABLE `flux` AUTO_INCREMENT = 1";
 $conn->query($resetIdQuery);
}


          // Read all rows from the database table, sorted by ID in ascending order
          
          $sql = "SELECT * FROM `flux` WHERE 1";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // Output data of each row 
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>
                          <td>{$row['idflux']}</td>
                          <td>{$row['idvehicule']}</td>
                          <td>{$row['numerobadge']}</td> 
                          <td>{$row['nom']}</td>
                          <td>{$row['immatricule']}</td>
                        <td>{$row['type']}</td>  
                          <td>{$row['date']}</td>
                          <td>{$row['heure']}</td>
                          
                        </tr>";
              }
          } else {
              echo "<tr><td colspan='8'>Aucun flux d'accés trouvé</td></tr>";
          }
          ?>
        </tbody>
    </table>
   </div> 
   <script>
     // Rafraîchir la page toutes les 60 secondes
     setInterval(function() {
       location.reload();
     }, 60000);
   </script>
</body>
</html>