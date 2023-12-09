<?php
require_once '../model/egresadomodel.php';
class egresadoController
{
    private $egresadoModel;
    public function __construct()
    {
        $this->egresadoModel = new Egresado();
    }
    private function DataForm()
    {
        return array_map('trim', $_POST);
    }
    public function egresadoMethod($op)
    {
        switch ($op) {
            case 'listar':
                $data = array();
                $arrayResponse = array('status' => false, 'data' => '');
                $rspta = $this->egresadoModel->Listar();
                while ($obj = $rspta->fetch_object()) {
                    array_push($data, $obj);
                }
                if (!empty($data)) {
                    for ($i = 0; $i < count($data); $i++) {
                        $idegresado = $data[$i]->Id_Egresado;
                        $options = '
                            <a href="infoworking.php?id=' . $idegresado . '&rute=msituation" class="fa-solid fa-eye" title="Ver situacion laboral"> </a>
                            <a href="graduateform.php?id=' . $idegresado . '&rute=agraduate" class="fa-solid fa-tags" title="Modificar"> </a>
                            <a class="fa-solid fa-trash-can" onclick="Eliminar(' . $idegresado . ')" title="Eliminar"></a>';
                        $data[$i]->options  = $options;
                    }
                    $arrayResponse['status'] = true;
                    $arrayResponse['data'] = $data;
                }
                echo json_encode($arrayResponse);
                break;
            case 'guardaryeditar':
                if ($_POST) {
                    $data = $this->DataForm();
                    $namesrc = $data['documento'];
                    if (!file_exists($_FILES['foto']['tmp_name']) || !is_uploaded_file($_FILES['foto']['tmp_name'])) {
                        $data['imagenactual'] = "photo_" . $namesrc . ".jpg";
                    } else {
                        $ext = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
                        if ($_FILES['foto']['type'] == "image/jpg" || $_FILES['foto']['type'] == "image/jpeg" || $_FILES['foto']['type'] == "image/png") {
                            $data['imagenactual'] = "photo_" . $namesrc . ".jpg";
                            move_uploaded_file($_FILES["foto"]["tmp_name"], "../src/img-egresado/" . $data['imagenactual']);
                        }
                    }
                    if (empty($data["id"])) {
                        if (empty($data["documento"]) || empty($data["codigo"]) || empty($data["nombre"]) || empty($data["apaterno"]) || empty($data["amaterno"]) || empty($data["fechanacimiento"]) || empty($data["email"]) || empty($data["telefono"]) || empty($data["direccion"]) || empty($data["idprograma"]) || empty($data["idcondicion"]) || empty($data["fechaobtencion"])) {
                            $arrayResponse = array('status' => false, 'msg' => 'Error de datos');
                        } else {
                            unset($data['id']);
                            unset($data['submit']);
                            $rspta = $this->egresadoModel->Insertar(...$data);
                            if ($rspta) {
                                $arrayResponse = array('status' => true, 'msg' => 'Datos guardados correctamente');
                            } else {
                                $arrayResponse = array('status' => false, 'msg' => 'Error al guardar los datos');
                            }
                        }
                    } else {
                        if (empty($data["documento"]) || empty($data["codigo"]) || empty($data["nombre"]) || empty($data["apaterno"]) || empty($data["amaterno"]) || empty($data["fechanacimiento"]) || empty($data["email"]) || empty($data["telefono"]) || empty($data["direccion"]) || empty($data["idprograma"]) || empty($data["idcondicion"]) || empty($data["fechaobtencion"])) {
                            $arrayResponse = array('status' => false, 'msg' => 'Error de datos');
                        } else {
                            unset($data['submit']);
                            $rspta = $this->egresadoModel->Editar(...$data);
                            if ($rspta) {
                                $arrayResponse = array('status' => true, 'msg' => 'Datos modificados correctamente');
                            } else {
                                $arrayResponse = array('status' => false, 'msg' => 'Error al modificar los datos');
                            }
                        }
                    }
                    echo json_encode($arrayResponse);
                }
                break;
            case 'mostrar':
                if ($_POST) {
                    $idegresado = intval($_POST['idegresado']);
                    $rspta = $this->egresadoModel->Mostrar($idegresado);
                    $rspta = $rspta->fetch_object();
                    if (empty($rspta)) {
                        $arrayResponse = array('status' => false, 'msg' => 'Datos no encontrados');
                    } else {
                        $arrayResponse = array('status' => true, 'msg' => 'Datos encontrados', 'data' => $rspta);
                    }
                    echo json_encode($arrayResponse);
                }
                break;
            case 'eliminar':
                if ($_POST) {
                    if (empty($_POST['idegresado'])) {
                        $arrayResponse = array('status' => false, 'msg' => 'Error de datos');
                    } else {
                        $idegresado = intval($_POST['idegresado']);
                        $rspta = $this->egresadoModel->Eliminar($idegresado);
                        if ($rspta) {
                            $arrayResponse = array('status' => true, 'msg' => 'Registro eliminado exitosamente');
                        } else {
                            $arrayResponse = array('status' => false, 'msg' => 'No se puedo eliminar el registro');
                        }
                    }
                    echo json_encode($arrayResponse);
                }
                break;
            case 'buscar':
                if ($_POST) {
                    $data = array();
                    if (empty($_POST["search_input"])) {
                        $arrayResponse = array('status' => false, 'msg' => "Error de datos");
                    } else {
                        $search = trim($_POST["search_input"]);
                        $arrayResponse = array('status' => false, 'found' => 0, 'data' => '');
                        $rspta = $this->egresadoModel->Buscar($search);
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
        }
    }
}
$controller = new egresadoController();
$op = $_REQUEST["op"];

$controller->egresadoMethod($op);
