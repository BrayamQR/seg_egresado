<?php
require_once '../model/empleomodel.php';
class empleoController
{
    private $empleoModel;
    public function __construct()
    {
        $this->empleoModel = new Empleo();
    }
    private function DataForm()
    {
        return array_map('trim', $_POST);
    }
    public function empleoMethod($op)
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
                        $rspta = $this->empleoModel->Listar($idegresado);
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
                    if (empty($data['ruc_laboral']) || empty($data['empresa_laboral']) || empty($data['cargo_laboral']) || empty($data['idcondicion_laboral']) || empty($data['idingreso_laboral']) || empty($data['fechainicio_laboral'])) {
                        $arrayResponse = array('status' => false, 'msg' => 'Error de datos');
                    } else {
                        unset($data['submit']);
                        unset($data['termino_contrato']);
                        if (empty($data['fechafin_laboral'])) {
                            $data['fechafin_laboral'] = '';
                        }
                        $rspta = $this->empleoModel->Insertar(...$data);
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
                    if (empty($_POST['idempleo'])) {
                        $arrayResponse = array('status' => false, 'msg' => 'Error de datos');
                    } else {
                        $idempleo = intval($_POST['idempleo']);
                        $rspta = $this->empleoModel->Eliminar($idempleo);
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
$controller = new empleoController();
$op = $_REQUEST["op"];

$controller->empleoMethod($op);
