<?php 
if (isset($_GET["idvéhicule"]) ) {
    
    $idvéhicule = $_GET["idvéhicule"];
    $servername="localhost" ;
    $username="root";
    $password= "";
    $database= "gestion de parking";

    // create connection 
    $conn =new mysqli($servername, $username, $password, $database);

    $sql ="DELETE FROM véhicule WHERE idvéhicule=$idvéhicule";
    $conn->query($sql);
}

header("location: véhicule.php");
exit;

?>
