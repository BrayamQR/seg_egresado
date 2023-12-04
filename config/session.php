<?php
session_start();
if (!$_SESSION['Id_Usuario']) {
    session_destroy();
    header("location: login.php");
}
$user_nombre = $_SESSION['Nom_Usuario'];
$user_perfi = $_SESSION['Desc_Perfil'];
$user_idperfil = $_SESSION['Id_Perfil'];
$act_egresado = $_SESSION['Act_Egresado'];
$act_usuarios = $_SESSION['Act_Usuario'];
$act_perfiles = $_SESSION['Act_Perfil'];
