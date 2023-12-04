<?php
require "../config/cnx.php";
class Login
{
    private $cnx;
    public function __construct()
    {
        $this->cnx = connection();
    }
    public function ValidarUsuario($user, $password)
    {
        $sql = "SELECT * FROM usuario INNER JOIN perfil ON usuario.Id_Perfil = perfil.Id_Perfil INNER JOIN permiso ON permiso.Id_Perfil = perfil.Id_Perfil WHERE User_Usuario = '$user' AND Pass_Usuario = '$password' AND Vigente = 1;";
        $query = mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
}
