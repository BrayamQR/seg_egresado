<?php
require_once '../model/practicasmodel.php';
class practicasController
{
    private $practicasModel;
    public function __construct()
    {
        $this->practicasModel = new Practicas();
    }
    private function DataForm()
    {
        return array_map('trim', $_POST);
    }
    public function practicasMethod($op)
    {
        switch ($op) {
            case 'listar':
                if ($_POST) {
                    $data = array();
                    if (empty($_POST["idegresado"])) {
                        $arrayResponse = array('status' => false, 'msg' => "Error de datos");
                    } else {
                        $idegresado = intval($_POST["idegresado"]);
                        $arrayResponse = array('status' => false, 'found' => 0, 'data' => '');
                        $rspta = $this->practicasModel->Listar($idegresado);
                        while ($obj = $rspta->fetch_object()) {
                            array_push($data, $obj);
                        }
                        if (!empty($data)) {
                            $arrayResponse = array('status' => true, 'found' => count($data), 'data' => $data);
                        }
                    }
                    echo json_encode($arrayResponse);
                }
                break;
            case 'guardar':
                if ($_POST) {
                    $data = $this->DataForm();
                    if (empty($data['idmodulo_insercion']) || empty($data['ruc_insercion']) || empty($data['empresa_insercion']) || empty($data['cargo_insercion']) || empty($data['idmedio_insercion']) || empty($data['fechainicio_insercion']) || empty($data['fechafin_insercion']) || empty($data['horas_insercion'])) {
                        $arrayResponse = array('status' => false, 'msg' => 'Error de datos');
                    } else {
                        unset($data['submit']);
                        $rspta = $this->practicasModel->Insertar(...$data);
                        if ($rspta) {
                            $arrayResponse = array('status' => true, 'msg' => 'Datos guardados correctamente');
                        } else {
                            $arrayResponse = array('status' => false, 'msg' => 'Error al guardar los datos');
                        }
                    }
                    echo json_encode($arrayResponse);
                }
                break;
            case 'eliminar':
                if ($_POST) {
                    if (empty($_POST['idpractica'])) {
                        $arrayResponse = array('status' => false, 'msg' => 'Error de datos');
                    } else {
                        $idpractica = intval($_POST['idpractica']);
                        $rspta = $this->practicasModel->Eliminar($idpractica);
                        if ($rspta) {
                            $arrayResponse = array('status' => true, 'msg' => 'Registro eliminado exitosamente');
                        } else {
                            $arrayResponse = array('status' => false, 'msg' => 'No se puedo eliminar el registro');
                        }
                    }
                    echo json_encode($arrayResponse);
                }
                break;
        }
    }
}
$controller = new practicasController();
$op = $_REQUEST["op"];

$controller->practicasMethod($op);
