<?php
session_start();
require('config/config.php');
require('model/functions.fn.php');

/*===============================
    Register
===============================*/

include 'view/_header.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $error = ''; 

    // Vérification que les champs ne sont pas vides
    if (empty($username) || empty($email) || empty($password)) {
        $error = "Tous les champs sont obligatoires. Veuillez remplir tous les champs.";
    } else {
        
        if (!isUsernameAvailable($db, $username)) {
            $error = "Nom d'utilisateur indisponible. Veuillez en choisir un autre.";
        } elseif (!isEmailAvailable($db, $email)) {
            $error = "Adresse e-mail indisponible. Veuillez en choisir une autre.";
        } else {

            userRegistration($db, $username, $email, $password);
            header('Location: dashboard.php');
            exit;
        }
    }
}

if (!empty($error)) {
    echo $error;
}

include 'view/register.php';
include 'view/_footer.php';
?>
