<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="gestionparking.css">
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
    <title>Admin Dashboard</title>
</head>
<body>
    <body>
        <div class="menu">
            <div class="logo">
                <i class="bx bx-water"></i>
                <span class="sonede" >SONEDE</span>
   
        </div>
              <div class="liste">
                <ul>
                    <li>
                  <a href="dashboard.php"  target="iframecontent" >
                    <i class="bx bx-home"></i>
                    <span class="barre_name">Accueil</span>
                  </a>
                </li>
              
                
                <li>
                  <a href="chauffeur.php" target="iframecontent">
                    <i class="bx bx-user"></i>
                    <span class="barre_name">Gérer les chauffeurs</span>
                  </a>
                </li>
                <li>
                  <a href="véhicule.php" target="iframecontent">
                    <i class="bx bx-car"></i>
                    <span class="barre_name">Gérer les véhicules</span>
                  </a>
                </li>
                
                <li>
                  <a href="flux.php"target="iframecontent">
                    <i class="bx bx-lock"></i>
                    <span class="barre_name">Consulter les flux d'accés</span>
                  </a>
                </li>
                <li>
                  <a href="barcode.php" target="iframecontent">
                  <i class="bx bx-barcode" ></i>
                    <span class="barre_name">Générer les tickets de code à barre</span>
                  </a>
                </li>
                <li>
                  <a href="direction.php" target="iframecontent">
                  <i class="bx bx-user" ></i>
                    <span class="barre_name">Gérer la direction</span>
                  </a>
                </li>
                <li>
                  <a href="rapport.php"target="iframecontent">
                  <i class="bx bx-printer"></i>
                    <span class="barre_name">Gérer le rapport</span>
                  </a>
                </li>
               
                  <li>
                    <a href="utilisateur.php" target="iframecontent">
                    <i class="bx bx-user"></i>
                      <span class="barre_name">Gérer les utilisateurs</span>
                    </a>
                  </li>
                 
                <li>
                  <a href="login.php">
                    <i class="bx bx-log-out"></i>
                    <span class="barre_name">Déconnexion</span>
                  </a>
                </li>
            </ul>
            </div>
        </div>
            <section class="home-section">
                <iframe name="iframecontent" width="100%" height="710px" frameborder="0"></iframe>  
            
            </section>
        </div>
        <script>
      sidebarBtn.onclick = function () {
        sidebar.classList.toggle("active");
        if (sidebar.classList.contains("active")) {
          sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      };
    </script>
        </body>
        </html>