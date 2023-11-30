<?php
require "../config/cnx.php";
class Egresado
{
    private $cnx;
    public function __construct()
    {
        $this->cnx = connection();
    }
    public function Listar()
    {
        $sql = "SELECT * FROM programa";
        $query = mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
    public function Insertar()
    {
        $sql = "INSERT INTO programa(Nom_Programa, Dir_Programa) VALUES ('[value-2]','[value-3]')";
        $query = mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
}
