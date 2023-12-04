<?php
include('../config/session.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../img/logo.png">
    <title>Situacion laboral | IESTP "AACD"</title>
</head>

<body>
    <div class="container">
        <?php
        include("../include/sidebar.php");
        ?>
        <main>
            <div class="main-content">
                <?php
                include("../include/welcome.php")
                ?>

                <div class="data-info">
                    <div class="content-info">
                        <h3>Datos de inserción laboral</h3>
                        <div class="content-action">
                            <div class="content-search" id="form_search">
                                <div class="content-search-text">

                                </div>

                            </div>

                            <div class="content-btn">
                                <a class="fa-solid fa-plus" title="Agregar" id="btn-add-insercion" onclick="ShowModal('btn-add-insercion',<?php echo $_GET['id'] ?>)"></a>
                            </div>
                        </div>
                        <input type="hidden" id="id" value="<?php echo $_GET['id'] ?>">
                        <div class="content-info-table">
                            <table id="tblDatos">
                                <thead>
                                    <th>#</th>
                                    <th>Modulo</th>
                                    <th>Cargo</th>
                                    <th>Empresa</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Horas / Dia</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody id="tblbodylista_practica">

                                </tbody>
                            </table>
                        </div>
                        <h3>Situación laboral actual</h3>
                        <div class="content-action">
                            <div class="content-search" id="form_search">
                                <div class="content-search-text">

                                </div>

                            </div>

                            <div class="content-btn">
                                <a class="fa-solid fa-plus" title="Agregar" id="btn-add-laboral" onclick="ShowModal('btn-add-laboral', <?php echo $_GET['id'] ?>)"></a>
                            </div>
                        </div>
                        <div class="content-info-table">
                            <table id="tblDatos">
                                <thead>
                                    <th>#</th>
                                    <th>Empresa</th>
                                    <th>Cargo</th>
                                    <th>Condición</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Ingreso Mensual</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody id="tblbodylista_empleo">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal" id="modal-insercion">
                        <div class="content-modal">
                            <div class="modal-title">
                                <h5>Información de las Practicas</h5>
                                <a class="fa-solid fa-xmark btn-close-model" onclick="CloseModal()"></a>
                            </div>
                            <div class="cont-modal">
                                <form id="formulario_insercion" class="formulario">
                                    <input type="hidden" name="idegresado_insercion" id="idegresado_insercion">
                                    <div class="content-input-modal">
                                        <div class="form-input">
                                            <div class="formulario-grupo formulario-grupo-full grupo-action" id="grupo-modulo">
                                                <div class="grupo-input-action">
                                                    <div class="input-content input-select">
                                                        <i class="fa-solid fa-list"></i>
                                                        <select name="idmodulo_insercion" class="select-option input-form" id="idmodulo_insercion">
                                                            <option value="" disabled selected></option>
                                                            <option value="1">MODULO I</option>
                                                            <option value="2">MODULO II</option>
                                                            <option value="3">MODULO III</option>
                                                        </select>
                                                        <label class="input-label" for="">Modulo *</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="formulario-grupo formulario-grupo-full grupo-action" id="grupo-ruc">
                                                <div class="grupo-input-action">
                                                    <div class="input-content input-action">
                                                        <i class="fa-solid fa-industry"></i>
                                                        <input type="text" name="ruc_insercion" id="ruc_insercion" class="input-form">
                                                        <label class="input-label" for="">RUC *</label>
                                                    </div>
                                                    <div class="btn-action">
                                                        <button type="button" id="buscarbyruc_insercion" class="fa-solid fa-magnifying-glass label-search" title="Buscar..." onclick="SearchByRuc('ruc_insercion','empresa_insercion')"></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="formulario-grupo formulario-grupo-full" id="grupo-empresa">
                                                <div class="input-content">
                                                    <i class="fa-regular fa-building"></i>
                                                    <input type="text" name="empresa_insercion" id="empresa_insercion" class="input-form">
                                                    <label class="input-label" for="">Empresa *</label>
                                                </div>
                                            </div>
                                            <div class="formulario-grupo formulario-grupo-full" id="grupo-cargo">
                                                <div class="input-content">
                                                    <i class="fa-solid fa-user-tie"></i>
                                                    <input type="text" name="cargo_insercion" id="cargo_insercion" class="input-form">
                                                    <label class="input-label" for="">Cargo *</label>
                                                </div>
                                            </div>
                                            <div class="formulario-grupo formulario-grupo-full grupo-action" id="grupo-medio">
                                                <div class="grupo-input-action">
                                                    <div class="input-content input-select">
                                                        <i class="fa-regular fa-paper-plane"></i>
                                                        <select name="idmedio_insercion" class="select-option input-form" id="idmedio_insercion">
                                                            <option value="" disabled selected></option>
                                                            <option value="1">BOLSA LABORAL DEL INSTITUTO</option>
                                                            <option value="2">REDES SOCIALES</option>
                                                            <option value="3">OFERTAS LABORALES</option>
                                                            <option value="4">CONTACTO CON AMIGOS Y/O FAMILIARES</option>
                                                            <option value="5">CONTACTO CON OTRO EGRESADO O DOCENTE DEL INSTITUTO</option>
                                                            <option value="6">OTRO</option>
                                                        </select>
                                                        <label class="input-label" for="">Medio informativo *</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="formulario-grupo formulario-grupo-full" id="grupo-fechainicio">
                                                <div class="input-content input-datetime">
                                                    <i class="fa-solid fa-calendar-days"></i>
                                                    <input type="date" class="input-form-date" name="fechainicio_insercion" id="fechainicio_insercion">
                                                    <label class="input-label input-label-date" for="">Fecha Inicio *</label>
                                                </div>
                                            </div>
                                            <div class="formulario-grupo formulario-grupo-full" id="grupo-fechafin">
                                                <div class="input-content input-datetime">
                                                    <i class="fa-solid fa-calendar-days"></i>
                                                    <input type="date" class="input-form-date" name="fechafin_insercion" id="fechafin_insercion">
                                                    <label class="input-label input-label-date" for="">Fecha Fin *</label>
                                                </div>
                                            </div>
                                            <div class="formulario-grupo formulario-grupo-full" id="grupo-horas">
                                                <div class="input-content">
                                                    <i class="fa-solid fa-hourglass"></i>
                                                    <input type="number" name="horas_insercion" id="horas_insercion" class="input-form">
                                                    <label class="input-label" for="">Horas por dia *</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-action">
                                        <input type="submit" value="Enviar" name="submit">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal" id="modal-laboral">
                        <div class="content-modal">
                            <div class="modal-title">
                                <h5>Información de la situacion laboral</h5>
                                <a class="fa-solid fa-xmark btn-close-model" onclick="CloseModal()"></a>
                            </div>
                            <div class="cont-modal">
                                <form id="formulario_laboral" class="formulario">
                                    <input type="hidden" name="idegresado_laboral" id="idegresado_laboral">
                                    <div class="content-input-modal">
                                        <div class="form-input">
                                            <div class="formulario-grupo formulario-grupo-full grupo-action" id="grupo-ruc">
                                                <div class="grupo-input-action">
                                                    <div class="input-content input-action">
                                                        <i class="fa-solid fa-industry"></i>
                                                        <input type="text" name="ruc_laboral" id="ruc_laboral" class="input-form">
                                                        <label class="input-label" for="">RUC *</label>
                                                    </div>
                                                    <div class="btn-action">
                                                        <button type="button" id="buscarbyruc_laboral" class="fa-solid fa-magnifying-glass label-search" title="Buscar..." onclick="SearchByRuc('ruc_laboral','empresa_laboral')"></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="formulario-grupo formulario-grupo-full" id="grupo-empresa">
                                                <div class="input-content">
                                                    <i class="fa-regular fa-building"></i>
                                                    <input type="text" name="empresa_laboral" id="empresa_laboral" class="input-form">
                                                    <label class="input-label" for="">Empresa *</label>
                                                </div>
                                            </div>
                                            <div class="formulario-grupo formulario-grupo-full" id="grupo-cargo">
                                                <div class="input-content">
                                                    <i class="fa-solid fa-user-tie"></i>
                                                    <input type="text" name="cargo_laboral" id="cargo_laboral" class="input-form">
                                                    <label class="input-label" for="">Cargo *</label>
                                                </div>
                                            </div>
                                            <div class="formulario-grupo formulario-grupo-full grupo-action" id="grupo-condicion">
                                                <div class="grupo-input-action">
                                                    <div class="input-content input-select">
                                                        <i class="fa-solid fa-building-user"></i>
                                                        <select name="idcondicion_laboral" class="select-option input-form" id="idcondicion_laboral">
                                                            <option value="" disabled selected></option>
                                                            <option value="1"> NOMBRADO</option>
                                                            <option value="2">CONTRATO INDEFINIDO, PERMANENTE</option>
                                                            <option value="3">CONTRATO A PLAZO FIJO</option>
                                                            <option value="4">CONTRATO POR LOCACIÓN DE SERVICIOS</option>
                                                            <option value="5">SIN CONTRATO</option>
                                                            <option value="6">OTRO</option>
                                                        </select>
                                                        <label class="input-label" for="">Condición laboral *</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="formulario-grupo formulario-grupo-full grupo-action" id="grupo-ingreso">
                                                <div class="grupo-input-action">
                                                    <div class="input-content input-select">
                                                        <i class="fa-solid fa-building-user"></i>
                                                        <select name="idingreso_laboral" class="select-option input-form" id="idingreso_laboral">
                                                            <option value="" disabled selected></option>
                                                            <option value="1">MENOS SUELDO BASICO</option>
                                                            <option value="2">SUELDO BÁSICO</option>
                                                            <option value="3">DE S/. 1001 A S/. 1500</option>
                                                            <option value="4">DE S/. 1501 A S/. 2000</option>
                                                            <option value="5">DE S/. 2001 A S/. 2500</option>
                                                            <option value="6">DE S/. 2501 A MAS</option>
                                                        </select>
                                                        <label class="input-label" for="">Ingreso bruto mensual *</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="formulario-grupo formulario-grupo-full" id="grupo-fechainicio">
                                                <div class="input-content input-datetime">
                                                    <i class="fa-solid fa-calendar-days"></i>
                                                    <input type="date" class="input-form-date" name="fechainicio_laboral" id="fechainicio_laboral">
                                                    <label class="input-label input-label-date" for="">Fecha Inicio *</label>
                                                </div>
                                            </div>
                                            <div class="formulario-grupo-full grupo-radio" id="grupo-radio">
                                                <div class="input-content grupo-radio-input input-content-unalinea">
                                                    <h3>¿Ha terminado su contrato? *</h3>
                                                    <input type="radio" class="input-radio input-radio_laboral" name="termino_contrato" id="termino_si" value="1">
                                                    <label class="label-radio" for="termino_si">Si</label>
                                                    <input type="radio" class="input-radio input-radio_laboral" name="termino_contrato" id="termino_no" value="2">
                                                    <label class="label-radio" for="termino_no">No
                                                    </label>
                                                </div>
                                                <p class="formulario-input-error">Elija una opción</p>
                                            </div>
                                            <div class="formulario-grupo formulario-grupo-full" id="grupo-fechafin">
                                                <div class="input-content input-datetime">
                                                    <i class="fa-solid fa-calendar-days"></i>
                                                    <input type="date" class="input-form-date" name="fechafin_laboral" id="fechafin_laboral">
                                                    <label class="input-label input-label-date" for="">Fecha Fin</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-action">
                                        <input type="submit" value="Enviar" name="submit">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="paginador"></div>
            </div>
        </main>
    </div>

</body>
<?php
include("../config/global_script.php");
?>
<script src="service/infoworking.js"></script>

</html>