<?php 
include('server.php');

// Récupération des données
$driverCount = getDriverCount();
$vehicleCount = getVehicleCount();
$UserCount = getUserCount();
$directionCount = getdirectionCount();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <nav>
        <div class="button">
          <i class="bx bx-menu menubtn"></i>
          <span class="dashboard">Accueil</span>
        
        </div>
        <div class="search-box">
          <input type="text" placeholder="Recherche..." />
          <i class="bx bx-search"></i>
        </div>
        <div class="profile-details">
          <!--<img src="images/profile.jpg" alt="">-->
          <span class="admin_name">

          <?php echo $nom ; ?></span>
          <i class="bx bx-chevron-down"></i>
        </div>
      </nav>

      <div class="home">
      
        <div class="boxes">
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Chauffeurs</div>
              <div class="number"><?php echo $driverCount; ?></div>
              <div class="indicator">
                <i class="bx bx-history"></i>
                <span class="text">Depuis hier</span>
              </div>
            </div>
            <i class="bx bx-user"></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Véhicules</div>
              <div class="number"><?php echo $vehicleCount; ?></div>
              <div class="indicator">
                <i class="bx bx-history"></i>
                <span class="text">Depuis hier</span>
              </div>
            </div>
            <i class="bx bx-car"></i>
          </div>
          <!-- Ajoutez d'autres boîtes de données de la même manière -->
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Utilisateur</div>
              <div class="number"><?php echo $UserCount; ?></div>
              <div class="indicator">
                <i class="bx bx-history"></i>
                <span class="text">Aujourd'hui</span>
              </div>
            </div>
            <i class="bx bx-user"></i>
          </div>
      
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Direction</div>
              <div class="number"><?php echo $directionCount; ?></div>
              <div class="indicator">
                <i class="bx bx-history"></i>
                <span class="text">Aujourd'hui</span>
              </div>
            </div>
            <i class="bx bx-user"></i>
          </div>

    <!-- Assurez-vous que vous avez une définition pour la variable menu et menubtn -->
    <script>
      menu.onclick = function () {
        menu.classList.toggle("active");
        if (menu.classList.contains("active")) {
          menubtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } menubtn.classList.replace("bx-menu-alt-right", "bx-menu");
      };
    </script>
   

</body>
</html>

