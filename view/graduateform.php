<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../img/logo.png">
    <title>Información del egresado | IESTP "AACD"</title>
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
                        <form id="formulario">
                            <div class="form-input">
                                <input type="hidden" name="id" value="" id="id">
                                <div class="formulario-grupo grupo-action" id="grupo-documento">
                                    <div class="grupo-input-action">
                                        <div class="input-content input-action">
                                            <i class="fa-solid fa-address-card"></i>
                                            <input class="input-form" type="text" id="documento" name="documento" value="" maxlength="8">
                                            <label class="input-label" for="">Doc. de Identidad *</label>
                                            <i class="formulario-validacion-estado fa-solid fa-xmark"></i>
                                        </div>
                                        <div class="btn-action">
                                            <button type="button" id="buscarbydni" class="fa-solid fa-magnifying-glass label-search" title="Buscar..." onclick="SearchByDni()"></button>
                                        </div>
                                    </div>
                                    <p class="formulario-input-error">El Documento solo debe contener numeros (8 caracteres)</p>
                                </div>
                                <div class="formulario-grupo" id="grupo-codigo">
                                    <div class="input-content">
                                        <i class="fa-solid fa-user-shield"></i>
                                        <input class="input-form" type="text" name="codigo" value="" id="codigo" maxlength="6">
                                        <label class="input-label" for="">Código del Estudiante *</label>
                                        <i class="formulario-validacion-estado fa-solid fa-xmark"></i>
                                    </div>
                                    <p class="formulario-input-error">El código solo debe contener numeros y letras (6 caracteres).</p>
                                </div>
                                <div class="formulario-grupo" id="grupo-nombre">
                                    <div class="input-content">
                                        <i class="fa-solid fa-user-pen"></i>
                                        <input class="input-form" type="text" name="nombre" value="" id="nombre">
                                        <label class="input-label" for="">Nombres *</label>
                                        <i class="formulario-validacion-estado fa-solid fa-xmark"></i>
                                    </div>
                                    <p class="formulario-input-error">El nombre solo debe contener letras y espacios.</p>
                                </div>
                                <div class="formulario-grupo" id="grupo-apaterno">
                                    <div class="input-content">
                                        <i class="fa-solid fa-user-pen"></i>
                                        <input class="input-form" type="text" name="apaterno" value="" id="apaterno">
                                        <label class="input-label" for="">Apellido Paterno *</label>
                                        <i class="formulario-validacion-estado fa-solid fa-xmark"></i>
                                    </div>
                                    <p class="formulario-input-error">El apellido solo debe contener letras</p>
                                </div>
                                <div class="formulario-grupo" id="grupo-amaterno">
                                    <div class="input-content">
                                        <i class="fa-solid fa-user-pen"></i>
                                        <input class="input-form" type="text" name="amaterno" value="" id="amaterno">
                                        <label class="input-label" for="">Apellido Materno *</label>
                                        <i class="formulario-validacion-estado fa-solid fa-xmark"></i>
                                    </div>
                                    <p class="formulario-input-error">El apellido solo debe contener letras</p>
                                </div>
                                <div class="formulario-grupo" id="grupo-fechanacimiento">
                                    <div class="input-content input-datetime">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <input type="date" class="input-form-date" name="fechanacimiento" id="fechanacimiento">
                                        <label class="input-label input-label-date" for="">Fecha de Nacimiento *</label>
                                        <i class="formulario-validacion-estado fa-solid fa-xmark"></i>
                                    </div>
                                    <p class="formulario-input-error">Debe ingresar una fecha</p>
                                </div>
                                <div class="formulario-grupo" id="grupo-email">
                                    <div class="input-content">
                                        <i class="fa-solid fa-at"></i>
                                        <input class="input-form" type="email" name="email" value="" id="email">
                                        <label class="input-label" for="">Email *</label>
                                        <i class="formulario-validacion-estado fa-solid fa-xmark"></i>
                                    </div>
                                    <p class="formulario-input-error">El correo no aceptado (Formato: example@example.com).</p>
                                </div>
                                <div class="formulario-grupo" id="grupo-telefono">
                                    <div class="input-content">
                                        <i class="fa-solid fa-phone"></i>
                                        <input class="input-form" type="text" name="telefono" value="" id="telefono" maxlength="9">
                                        <label class="input-label" for="">Teléfono *</label>
                                        <i class="formulario-validacion-estado fa-solid fa-xmark"></i>
                                    </div>
                                    <p class="formulario-input-error">El celular solo debe contener numeros de un 6 a 9 digitos.</p>
                                </div>
                                <div class="formulario-grupo" id="grupo-direccion">
                                    <div class="input-content">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <input class="input-form" type="text" name="direccion" value="" id="direccion">
                                        <label class="input-label" for="">Dirección *</label>
                                        <i class="formulario-validacion-estado fa-solid fa-xmark"></i>
                                    </div>
                                    <p class="formulario-input-error">la direccion solo debe contener letras y espacios.</p>
                                </div>
                                <div class="formulario-grupo grupo-action" id="grupo-idprograma">
                                    <div class="grupo-input-action">
                                        <div class="input-content input-select">
                                            <i class="fa-solid fa-user-graduate"></i>
                                            <select name="idprograma" class="select-option input-form" id="idprograma">
                                                <option value="" disabled selected></option>
                                                <option value="1">DISEÑO Y PROGRAMACION WEB</option>
                                            </select>
                                            <label class="input-label" for="">Programa de estudios *</label>
                                            <i class="formulario-validacion-estado fa-solid fa-xmark"></i>
                                        </div>
                                    </div>
                                    <p class="formulario-input-error">Debe seleccionar una opcion.</p>
                                </div>
                                <div class="formulario-grupo grupo-action" id="grupo-idcondicion">
                                    <div class="grupo-input-action">
                                        <div class="input-content input-select">
                                            <i class="fa-solid fa-user-graduate"></i>
                                            <select name="idcondicion" class="select-option input-form" id="idcondicion">
                                                <option value="" disabled selected></option>
                                                <option value="1">EGRESADO</option>
                                                <option value="2">TITULADO</option>
                                            </select>
                                            <label class="input-label" for="">Condición del egresado *</label>
                                            <i class="formulario-validacion-estado fa-solid fa-xmark"></i>
                                        </div>
                                    </div>
                                    <p class="formulario-input-error">Debe seleccionar una opcion.</p>
                                </div>
                                <div class="formulario-grupo" id="grupo-fechaobtencion">
                                    <div class="input-content input-datetime">
                                        <i class="fa-solid fa-calendar-days"></i>
                                        <input type="date" class="input-form-date" name="fechaobtencion" id="fechaobtencion">
                                        <label class="input-label input-label-date" for="">Fecha de obtención de grado *</label>
                                        <i class="formulario-validacion-estado fa-solid fa-xmark"></i>
                                    </div>
                                    <p class="formulario-input-error">Debe ingresar una fecha</p>
                                </div>
                                <div class="formulario-grupo-full formulario-image" id="grupo-foto">
                                    <div class="input-content">
                                        <input type="file" name="foto" id="foto" class="input-image">
                                        <input type="hidden" name="imagenactual" id="imagenactual" value="">
                                        <div class="content-photo">
                                            <button type="button" class="btn-image" onclick="document.getElementById('foto').click()"><i class="fa-solid fa-camera"></i> Subir una foto</button>
                                            <div class="content-image">
                                                <img src="../img/student.png" id="imagenmuestra">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-action">
                                <input type="submit" value="Enviar" name="submit">
                                <a href="graduate.php?rute=mgraduate">Volver</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </main>
    </div>
</body>
<?php
include("../config/global_script.php");
?>
<script src="service/graduate.js"></script>
<script>
    let id = "<?= isset($_GET['id']) ? $_GET['id'] : '' ?>";
    Mostrar(id);
</script>

</html>