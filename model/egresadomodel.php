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
        $sql = "SELECT * FROM egresado";
        $query = mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
    public function Insertar($documento, $codigo, $nombre, $apaterno, $amaterno, $fechanacimiento, $email, $telefono, $direccion, $idprograma, $idcondicion, $fechaobtencion, $imagenactual)
    {
        $sql = "INSERT INTO egresado(Doc_Egresado, Cod_Egresado, Nom_Egresado, Apa_Egresado, Ama_Egresado, Fech_Nacimiento, Email_Egresado, Tel_Egresado, Dir_Egresado, Id_Condicion, Fech_Obtencion, Foto_Egresado, Id_Programa) VALUES ('$documento',UPPER('$codigo'),UPPER('$nombre'),UPPER('$apaterno'),UPPER('$amaterno'),'$fechanacimiento','$email','$telefono',UPPER('$direccion'),$idcondicion,'$fechaobtencion','$imagenactual',$idprograma)";
        $query = mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
    public function Editar($id, $documento, $codigo, $nombre, $apaterno, $amaterno, $fechanacimiento, $email, $telefono, $direccion, $idprograma, $idcondicion, $fechaobtencion, $imagenactual)
    {
        $sql = "UPDATE egresado SET Doc_Egresado='$documento',Cod_Egresado=UPPER('$codigo'),Nom_Egresado=UPPER('$nombre'),Apa_Egresado=UPPER('$apaterno'),Ama_Egresado=UPPER('$amaterno'),Fech_Nacimiento='$fechanacimiento',Email_Egresado='$email',Tel_Egresado='$telefono',Dir_Egresado=UPPER('$direccion'),Id_Condicion=$idcondicion,Fech_Obtencion='$fechaobtencion',Foto_Egresado='$imagenactual',Id_Programa=$idprograma WHERE Id_Egresado = $id";
        $query = mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
    public function Eliminar($id)
    {
        $sql = "DELETE FROM egresado WHERE Id_Egresado = $id";
        $query = mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
    public function Mostrar($id)
    {
        $sql = "SELECT * FROM egresado WHERE Id_Egresado = $id";
        $query = mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
    public function ListarPrograma()
    {
        $sql = "SELECT * FROM programa";
        $query = mysqli_query($this->cnx, $sql);
        mysqli_close($this->cnx);
        return $query;
    }
}
