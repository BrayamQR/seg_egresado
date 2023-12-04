<?php
require "../config/cnx.php";
class Empleo
{
    private $cnx;
    public function __construct()
    {
        $this->cnx = connection();
    }
    public function Listar($id)
    {
        $sql = "SELECT * FROM empleo INNER JOIN egresado ON empleo.Id_Egresado = egresado.Id_Egresado WHERE egresado.Id_Egresado = $id";
        $query = mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
    public function Insertar($ruc_laboral, $empresa_laboral, $cargo_laboral, $idcondicion_laboral, $idingreso_laboral, $fechainicio_laboral, $fechafin_laboral, $idegresado_laboral)
    {
        $sql = "INSERT INTO empleo(Ruc_Empresa, Nom_Empresa, Car_Empresa, Id_EstLaboral, Id_Ingreso, Fecha_Inicio, Fecha_Fin, Id_Egresado) VALUES ('$ruc_laboral',UPPER('$empresa_laboral'),UPPER('$cargo_laboral'),$idcondicion_laboral,$idingreso_laboral,'$fechainicio_laboral','$fechafin_laboral',$idegresado_laboral)";
        $query = mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
    public function Eliminar($id)
    {
        $sql = "DELETE FROM empleo WHERE Id_Empleo = $id";
        $query = mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
}
