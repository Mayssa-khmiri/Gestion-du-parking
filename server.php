<?php
session_start();

// initializing variables
$nom =  '';
$email = "";
$motdepasse = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'gestion de parking');

// REGISTER USER
if (isset($_POST['register'])) {
  // receive all input values from the form
  $nom = mysqli_real_escape_string($db, $_POST['nom']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $motdepasse = mysqli_real_escape_string($db, $_POST['motdepasse']);
  $motdepasse_2 = mysqli_real_escape_string($db, $_POST['motdepasse_2 ']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($nom)) { array_push($errors, "nom is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($motdepasse)) { array_push($errors, "motdepasse is required"); }
  if ($motdepasse != $motdepasse_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user WHERE 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['nom'] === $nom) {
      array_push($errors, "nom already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
    if ($user['motdepasse'] === $motdepasse) {
      array_push($errors, "password already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$motdepasse = md5($motdepasse);//encrypt the password before saving in the database

  	$query = "INSERT INTO user (nom, email, motdepasse) 
  			  VALUES('$nom', '$email', '$motdepasse')";
  	mysqli_query($db, $query);
  	$_SESSION['nom'] = $nom;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: login.php');
  }
}

// LOGIN USER
if (isset($_POST['login'])) {
  $nom = mysqli_real_escape_string($db, $_POST['nom']);
  $motdepasse = mysqli_real_escape_string($db, $_POST['motdepasse']);
  $email = mysqli_real_escape_string($db, $_POST['email']);

}
$nom = isset($_SESSION['nom']) ? $_SESSION['nom'] : '';


// Fonction pour récupérer le nombre de chauffeurs
function getDriverCount() {
  global $db;
  $sql = "SELECT COUNT(*) AS count FROM chauffeur";
  $result = mysqli_query($db, $sql);
  if ($result && mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      return $row["count"];
  } else {
      return 0;
  }
}

// Fonction pour récupérer le nombre de véhicules
function getVehicleCount() {
  global $db;
  $sql = "SELECT COUNT(*) AS count FROM véhicule";
  $result = mysqli_query($db, $sql);
  if ($result && mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      return $row["count"];
  } else {
      return 0;
  }
}
function getUserCount() {
  global $db;
  $sql = "SELECT COUNT(*) AS count FROM utilisateur";
  $result = mysqli_query($db, $sql);
  if ($result && mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      return $row["count"];
  } else {
      return 0;
  }
}
function getdirectionCount() {
  global $db;
  $sql = "SELECT COUNT(*) AS count FROM direction";
  $result = mysqli_query($db, $sql);
  if ($result && mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      return $row["count"];
  } else {
      return 0;
  }
}
?>