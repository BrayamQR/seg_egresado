<?php
require "../config/cnx.php";
class Perfil
{
    private $cnx;
    public function __construct()
    {
        $this->cnx = connection();
    }
    public function Listar()
    {
        $sql = "SELECT * FROM perfil";
        $query = mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
    public function CambiarEstado($id, $estado)
    {
        $sql = "UPDATE perfil SET Vigente=$estado WHERE Id_Perfil = $id";
        $query = mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
    public function InsertarPermisos($graduate, $user, $profile, $idtipo)
    {
        $sql = "INSERT INTO permiso(Act_Egresado, Act_Usuario, Act_Perfil, Id_Perfil) VALUES ($graduate,$user,$profile,$idtipo)";
        $query = mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
    public function EditarPermisos($id, $graduate, $user, $profile)
    {
        $sql = "UPDATE permiso SET Act_Egresado=$graduate,Act_Usuario=$user,Act_Perfil=$profile WHERE Id_Permiso = $id";
        $query = mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
    public function MostrarPermisos($id)
    {
        $sql = "SELECT * FROM permiso WHERE Id_Perfil = $id";
        $query = mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
    public function InsertarPerfil($perfil)
    {
        $sql = "INSERT INTO perfil(Desc_Perfil, Vigente) VALUES (upper('$perfil'),1)";
        $query = mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
    public function ListarVigentes()
    {
        $sql = "SELECT * FROM perfil WHERE Vigente = 1";
        $query = mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
    public function EliminarPerfil($id)
    {
        $sql = "DELETE FROM perfil WHERE Id_Perfil = $id";
        $query = mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
}
