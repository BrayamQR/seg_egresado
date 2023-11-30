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
                                <a class="fa-solid fa-plus" title="Agregar" id="btn-add-insercion"></a>
                            </div>
                        </div>
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
                                <tbody id="tblbodylista">

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
                                <a class="fa-solid fa-plus" title="Agregar" id="btn-add-laboral"></a>
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
                                <tbody id="tblbodylista">

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
                                <form id="formulario-modal-insercion" class="formulario">
                                    <div class="content-input-modal">
                                        <div class="form-input">
                                            <div class="formulario-grupo formulario-grupo-full grupo-action" id="grupo-modulo">
                                                <div class="grupo-input-action">
                                                    <div class="input-content input-select">
                                                        <i class="fa-solid fa-list"></i>
                                                        <select name="idmodulo-insercion" class="select-option input-form" id="idmodulo-insercion">
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
                                                        <input type="text" name="ruc-insercion" id="ruc-insercion" class="input-form">
                                                        <label class="input-label" for="">RUC *</label>
                                                    </div>
                                                    <div class="btn-action">
                                                        <button type="button" id="buscarbyruc-insercion" class="fa-solid fa-magnifying-glass label-search" title="Buscar..." onclick="SearchByRuc('ruc-insercion','empresa-insercion')"></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="formulario-grupo formulario-grupo-full" id="grupo-empresa">
                                                <div class="input-content">
                                                    <i class="fa-regular fa-building"></i>
                                                    <input type="text" name="empresa-insercion" id="empresa-insercion" class="input-form">
                                                    <label class="input-label" for="">Empresa *</label>
                                                </div>
                                            </div>
                                            <div class="formulario-grupo formulario-grupo-full" id="grupo-cargo">
                                                <div class="input-content">
                                                    <i class="fa-solid fa-user-tie"></i>
                                                    <input type="text" name="cargo-insercion" id="cargo-insercion" class="input-form">
                                                    <label class="input-label" for="">Cargo *</label>
                                                </div>
                                            </div>
                                            <div class="formulario-grupo formulario-grupo-full grupo-action" id="grupo-medio">
                                                <div class="grupo-input-action">
                                                    <div class="input-content input-select">
                                                        <i class="fa-regular fa-paper-plane"></i>
                                                        <select name="medio-insercion" class="select-option input-form" id="medio-insercion">
                                                            <option value="" disabled selected></option>
                                                            <option value="BOLSA LABORAL DEL INSTITUTO">BOLSA LABORAL DEL INSTITUTO</option>
                                                            <option value="REDES SOCIALES">REDES SOCIALES</option>
                                                            <option value="OFERTAS LABORALES">OFERTAS LABORALES</option>
                                                            <option value="CONTACTO CON AMIGOS Y/O FAMILIARES">CONTACTO CON AMIGOS Y/O FAMILIARES</option>
                                                            <option value="CONTACTO CON OTRO EGRESADO O DOCENTE DEL INSTITUTO">CONTACTO CON OTRO EGRESADO O DOCENTE DEL INSTITUTO</option>
                                                            <option value="OTRO">OTRO</option>
                                                        </select>
                                                        <label class="input-label" for="">Medio informativo *</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="formulario-grupo formulario-grupo-full" id="grupo-fechainicio">
                                                <div class="input-content input-datetime">
                                                    <i class="fa-solid fa-calendar-days"></i>
                                                    <input type="date" class="input-form-date" name="fechainicio-insercion" id="fechainicio-insercion">
                                                    <label class="input-label input-label-date" for="">Fecha Inicio *</label>
                                                </div>
                                            </div>
                                            <div class="formulario-grupo formulario-grupo-full" id="grupo-fechafin">
                                                <div class="input-content input-datetime">
                                                    <i class="fa-solid fa-calendar-days"></i>
                                                    <input type="date" class="input-form-date" name="fechafin-insercion" id="fechafin-insercion">
                                                    <label class="input-label input-label-date" for="">Fecha Fin *</label>
                                                </div>
                                            </div>
                                            <div class="formulario-grupo formulario-grupo-full" id="grupo-horas">
                                                <div class="input-content">
                                                    <i class="fa-solid fa-hourglass"></i>
                                                    <input type="number" name="horas-insercion" id="horas-insercion" class="input-form">
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
                                <form id="formulario-modal-laboral" class="formulario">
                                    <div class="content-input-modal">
                                        <div class="form-input">
                                            <div class="formulario-grupo formulario-grupo-full grupo-action" id="grupo-ruc">
                                                <div class="grupo-input-action">
                                                    <div class="input-content input-action">
                                                        <i class="fa-solid fa-industry"></i>
                                                        <input type="text" name="ruc-laboral" id="ruc-laboral" class="input-form">
                                                        <label class="input-label" for="">RUC *</label>
                                                    </div>
                                                    <div class="btn-action">
                                                        <button type="button" id="buscarbyruc-laboral" class="fa-solid fa-magnifying-glass label-search" title="Buscar..." onclick="SearchByRuc('ruc-laboral','empresa-laboral')"></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="formulario-grupo formulario-grupo-full" id="grupo-empresa">
                                                <div class="input-content">
                                                    <i class="fa-regular fa-building"></i>
                                                    <input type="text" name="empresa-laboral" id="empresa-laboral" class="input-form">
                                                    <label class="input-label" for="">Empresa *</label>
                                                </div>
                                            </div>
                                            <div class="formulario-grupo formulario-grupo-full" id="grupo-cargo">
                                                <div class="input-content">
                                                    <i class="fa-solid fa-user-tie"></i>
                                                    <input type="text" name="cargo-laboral" id="cargo-laboral" class="input-form">
                                                    <label class="input-label" for="">Cargo *</label>
                                                </div>
                                            </div>
                                            <div class="formulario-grupo formulario-grupo-full grupo-action" id="grupo-condicion">
                                                <div class="grupo-input-action">
                                                    <div class="input-content input-select">
                                                        <i class="fa-solid fa-building-user"></i>
                                                        <select name="condicion-laboral" class="select-option input-form" id="condicion-laboral">
                                                            <option value="" disabled selected></option>
                                                            <option value="NOMBRADO"> NOMBRADO</option>
                                                            <option value="CONTRATO INDEFINIDO, PERMANENTE">CONTRATO INDEFINIDO, PERMANENTE</option>
                                                            <option value="CONTRATO A PLAZO FIJO">CONTRATO A PLAZO FIJO</option>
                                                            <option value="CONTRATO POR LOCACIÓN DE SERVICIOS">CONTRATO POR LOCACIÓN DE SERVICIOS</option>
                                                            <option value="SIN CONTRATO">SIN CONTRATO</option>
                                                            <option value="OTRO">OTRO</option>
                                                        </select>
                                                        <label class="input-label" for="">Condición laboral *</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="formulario-grupo formulario-grupo-full grupo-action" id="grupo-ingreso">
                                                <div class="grupo-input-action">
                                                    <div class="input-content input-select">
                                                        <i class="fa-solid fa-building-user"></i>
                                                        <select name="ingreso-laboral" class="select-option input-form" id="ingreso-laboral">
                                                            <option value="" disabled selected></option>
                                                            <option value="MENOS SUELDO BASICO">MENOS SUELDO BASICO</option>
                                                            <option value="SUELDO BÁSICO">SUELDO BÁSICO</option>
                                                            <option value="DE S/. 1001 A S/. 1500 SOLES">DE S/. 1001 A S/. 1500 SOLES</option>
                                                            <option value="DE S/. 1501 A S/. 2000 SOLES">DE S/. 1501 A S/. 2000 SOLES</option>
                                                            <option value="DE S/. 2001 A S/. 2500 SOLES">DE S/. 2001 A S/. 2500 SOLES</option>
                                                            <option value="DE S/. 2501 A MAS">DE S/. 2501 A MAS</option>
                                                        </select>
                                                        <label class="input-label" for="">Ingreso bruto mensual *</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="formulario-grupo formulario-grupo-full" id="grupo-fechainicio">
                                                <div class="input-content input-datetime">
                                                    <i class="fa-solid fa-calendar-days"></i>
                                                    <input type="date" class="input-form-date" name="fechainicio-laboral" id="fechainicio-laboral">
                                                    <label class="input-label input-label-date" for="">Fecha Inicio *</label>
                                                </div>
                                            </div>
                                            <div class="formulario-grupo-full grupo-radio" id="grupo-radio">
                                                <div class="input-content grupo-radio-input input-content-unalinea">
                                                    <h3>¿Ha terminado su contrato?</h3>
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
                                                    <input type="date" class="input-form-date" name="fechafin-laboral" id="fechafin-laboral">
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