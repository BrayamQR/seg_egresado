<?php
require "../config/cnx.php";
class Practicas
{
    private $cnx;
    public function __construct()
    {
        $this->cnx = connection();
    }
    public function Listar($id)
    {
        $sql = "SELECT * FROM practicas INNER JOIN egresado ON practicas.Id_Egresado = egresado.Id_Egresado WHERE egresado.Id_Egresado = $id";
        $query = mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
    public function Insertar($idmodulo_insercion, $ruc_insercion, $empresa_insercion, $cargo_insercion, $idmedio_insercion, $fechainicio_insercion, $fechafin_insercion, $horas_insercion, $idegresado_insercion)
    {
        $sql = "INSERT INTO practicas(Id_Modulo, Ruc_Empresa, Nom_Empresa, Car_Practicas, Id_Medio, Fecha_Inicio, Fecha_Fin, Hora_ByDia, Id_Egresado) VALUES ($idmodulo_insercion,'$ruc_insercion',UPPER('$empresa_insercion'),UPPER('$cargo_insercion'),$idmedio_insercion,'$fechainicio_insercion','$fechafin_insercion',$horas_insercion,$idegresado_insercion)";
        $query = mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
    public function Eliminar($id)
    {
        $sql = "DELETE FROM practicas WHERE Id_Practicas = $id";
        $query = mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
}
