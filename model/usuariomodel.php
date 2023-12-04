<?php
require "../config/cnx.php";

class Usuario
{
    private $cnx;
    public function __construct()
    {
        $this->cnx = connection();
    }
    public function Listar()
    {
        $sql = "SELECT * FROM usuario INNER JOIN perfil ON usuario.Id_Perfil = perfil.Id_Perfil";
        $query = mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
    public function Insertar($nombre, $apellido, $user, $password, $idtipo)
    {
        $sql = "INSERT INTO usuario(Nom_Usuario, Ape_Usuario, User_Usuario, Pass_Usuario, Id_Perfil) VALUES (UPPER('$nombre'),UPPER('$apellido'),'$user','$password',$idtipo)";
        $query =  mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
    public function Editar($id, $nombre, $apellido, $user, $password, $idtipo)
    {
        $sql = "UPDATE usuario SET Nom_Usuario=UPPER('$nombre'),Ape_Usuario=UPPER('$apellido'),User_Usuario='$user',Pass_Usuario='$password',Id_Perfil=$idtipo WHERE Id_Usuario = $id";
        $query =  mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
    public function Eliminar($id)
    {
        $sql = "DELETE FROM usuario WHERE Id_Usuario = $id";
        $query = mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
    public function Mostrar($id)
    {
        $sql = "SELECT * FROM usuario WHERE Id_Usuario = $id";
        $query = mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
    public function Buscar($dato)
    {
        $sql = "SELECT * FROM usuario INNER JOIN perfil ON usuario.Id_Perfil = perfil.Id_Perfil WHERE usuario.Nom_Usuario LIKE '$dato%' OR usuario.Ape_Usuario LIKE '$dato%' OR perfil.Desc_Perfil LIKE '$dato%'";
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
    public function RestaurarPassword($id, $password)
    {
        $sql = "UPDATE usuario SET Pass_Usuario='$password' WHERE Id_Usuario = $id";
        $query = mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
}
