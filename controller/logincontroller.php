<?php

require_once '../model/loginmodel.php';
class LoginController
{
    private $loginModel;
    public function __construct()
    {
        $this->loginModel = new Login();
    }
    private function DataForm()
    {
        return array_map('trim', $_POST);
    }
    public function LoginMethod($op)
    {
        switch ($op) {
            case 'validar':
                if ($_POST) {
                    $data = $this->DataForm();
                    if (empty($_POST['user']) || empty($_POST['password'])) {
                        $arrayResponse = array('status' => false, 'msg' => 'Error de datos');
                    } else {
                        $rspta = $this->loginModel->ValidarUsuario(...$data);
                        $rspta = $rspta->fetch_object();
                        if (empty($rspta)) {
                            $arrayResponse = array('status' => false, 'msg' => 'El usuario y/o la contraseña son incorrectos');
                        } else {
                            session_start();
                            $_SESSION['Id_Usuario'] = $rspta->Id_Usuario;
                            $_SESSION['Nom_Usuario'] = $rspta->Nom_Usuario;
                            $_SESSION['Id_Perfil'] = $rspta->Id_Perfil;
                            $_SESSION['Desc_Perfil'] = $rspta->Desc_Perfil;
                            $_SESSION['Act_Egresado'] = $rspta->Act_Egresado;
                            $_SESSION['Act_Usuario'] = $rspta->Act_Usuario;
                            $_SESSION['Act_Perfil'] = $rspta->Act_Perfil;
                            $arrayResponse = array('status' => true, 'msg' => 'Datos encontrados', 'data' => $rspta);
                        }
                    }
                    echo json_encode($arrayResponse);
                }
                break;
        }
    }
}
$controller = new LoginController();
$op = $_REQUEST["op"];

$controller->LoginMethod($op);
