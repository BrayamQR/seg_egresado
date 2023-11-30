<?php
date_default_timezone_set('America/Lima');
$fech = date('d-m-Y');
if (isset($_GET['rute'])) {
    switch ($_GET['rute']) {
        case 'agraduate':
            $tittle = 'Información del Egresado';
            break;
        case 'mgraduate':
            $tittle = 'Mantenimiento del Esgresado';
            break;
        case 'auser':
            $tittle = 'Información del Usuario';
            break;
        case 'muser':
            $tittle = 'Mantenimiento del Usuario';
            break;
        case 'mprofile':
            $tittle = 'Mantenimiento del Perfíl';
            break;
        case 'msituation':
            $tittle = 'Información laboral del Egresado';
            break;
    }
} else {
    $tittle = 'Bienvenido al sistema';
}
?>
<div class="wellcome-content">
    <i class="fa-solid fa-bars btn-menu" id="btn-menu"></i>
    <div class="date-content">
        <p>Fecha actual del sistema: <span><?php echo $fech; ?></span></p>
    </div>
    <h3><?php echo $tittle; ?></h3>
</div>