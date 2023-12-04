function init(){
    if(document.querySelector('#tblbodylista_practica')){
        ListarPracticas();
    }
    if(document.querySelector('#tblbodylista_empleo')){
        ListarEmpleo();
    }
    if(document.querySelector('#formulario_insercion')){
        let formulario_insercion = document.querySelector('#formulario_insercion');
        formulario_insercion.onsubmit = function(e){
            e.preventDefault();
            GuardarPractica();
        }
    }
    if(document.querySelector('#formulario_laboral')){
        HabilitarInput();
        let formulario_laboral = document.querySelector('#formulario_laboral');
        formulario_laboral.onsubmit = function(e){
            e.preventDefault();
            GuardarEmpleo();
        }
    }
}
function ShowModal(btn, id){
    if(btn == 'btn-add-insercion'){
        document.getElementById('modal-insercion').classList.add('modal-show');
        document.getElementById('formulario_insercion').reset();
        document.querySelectorAll('.input-form').forEach(function(e){
            e.nextElementSibling.classList.remove('fijar');
        });
        document.getElementById('idegresado_insercion').value = id;
    }
    else if(btn == 'btn-add-laboral'){
        document.getElementById('modal-laboral').classList.add('modal-show');
        document.getElementById('formulario_laboral').reset();
        document.getElementById('fechafin_laboral').disabled = true;
        document.getElementById('fechafin_laboral').nextElementSibling.textContent = document.getElementById('fechafin_laboral').nextElementSibling.textContent.replace(' *', '');
        document.querySelectorAll('.input-form').forEach(function(e){
            e.nextElementSibling.classList.remove('fijar');
        });
        document.getElementById('idegresado_laboral').value = id;
    }
}
function CloseModal(){
    let modal_insercion = document.getElementById('modal-insercion');
    let modal_laboral = document.getElementById('modal-laboral');
    modal_insercion.classList.remove('modal-show');
    modal_laboral.classList.remove('modal-show');
}
function SearchByRuc(idinputruc,idinputempresa){
    try {
        ruc = document.getElementById(idinputruc).value;
        $.ajax({
            url : '../config/api_reniec_ruc.php',
            type: 'post',
            data: 'ruc='+ruc,
            dataType: 'json',
            success: function(e){
                if(e.numeroDocumento == ruc){
                    document.getElementById(idinputempresa).nextElementSibling.classList.add('fijar');
                    document.getElementById(idinputempresa).value = e.nombre;
                }
                else{
                    Swal.fire(
                        "¡Ocurrio un error!",
                        "No se encontro a la empresa",
                        "warning"
                    )
                }
            } 
        })
        
    } catch (error) {
        console.log(error)
    }
}
function HabilitarInput(){
    var radio = document.querySelectorAll('.input-radio_laboral');
    radio.forEach(function (e) {
        e.addEventListener("change", function () {
            if (e.checked) {
                if (e.value === '1') {
                    document.getElementById('fechafin_laboral').disabled = false;
                    document.getElementById('fechafin_laboral').nextElementSibling.textContent += ' *';
                }
                else if (e.value === '2') {
                    document.getElementById('fechafin_laboral').disabled = true;
                    document.getElementById('fechafin_laboral').nextElementSibling.textContent = document.getElementById('fechafin_laboral').nextElementSibling.textContent.replace(' *', '');
                }
            }
        });
    });
}
async function ListarPracticas(){
    document.querySelector("#tblbodylista_practica").innerHTML = "";
    let id = document.getElementById('id').value;
    const formData = new FormData();
    formData.append('idegresado',id)
    try {
        let resp = await fetch ('../controller/practicascontroller.php?op=listar',{
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        json = await resp.json();
        if(json.status){
            let data = json.data;
            var i = 0;
            data.forEach((item)=>{
                i++;
                let modulo = '';
                let newtr = document.createElement("tr");
                newtr.id = "row_"+item.Id_Practicas;
                if(item.Id_Modulo == 1){
                    modulo = 'MODULO I';
                }
                else if(item.Id_Modulo == 2){
                    modulo = 'MODULO II';
                }
                else if(item.Id_Modulo == 3){
                    modulo = 'MODULO III';
                }
                newtr.innerHTML = `<td class="opacity">${i}</td>
                                    <td data-label="Módulo" class="rcab">${modulo}</td>
                                    <td data-label="Cargo">${item.Car_Practicas}</td>
                                    <td data-label="Empresa">${item.Nom_Empresa}</td>
                                    <td data-label="Fecha Inicio">${FormatDate( item.Fecha_Inicio)}</td>
                                    <td data-label="Fecha fin">${FormatDate(item.Fecha_Fin)}</td>
                                    <td data-label="Horas / Dia">${item.Hora_ByDia} Hora(s)</td>
                                    <td data-label="Acciones">
                                        <div class="data-action">
                                            <a class="fa-solid fa-trash-can" onclick="EliminarPractica(${item.Id_Practicas})" title="Eliminar"></a>
                                        </div>
                                    </td>`;
                document.querySelector("#tblbodylista_practica").appendChild(newtr);
            });
        }
    }
    catch (error) {
        console.log(error)
    }
}
async function GuardarPractica(){
    let idmodulo = document.getElementById('idmodulo_insercion').value;
    let ruc = document.getElementById('ruc_insercion').value;
    let empresa = document.getElementById('empresa_insercion').value;
    let cargo = document.getElementById('cargo_insercion').value;
    let medio = document.getElementById('idmedio_insercion').value;
    let fechainicio = document.getElementById('fechainicio_insercion').value;
    let fechafin = document.getElementById('fechafin_insercion').value;
    let horas = document.getElementById('horas_insercion').value;
    if(idmodulo == 0 || ruc == "" || empresa == "", cargo == "" || medio == 0 || fechainicio == "" || fechafin == "" || horas == ""){
        Swal.fire({
            icon: 'warning',
            title: '¡Ooh no!',
            text: 'Los campos con (*) son obligatorios'
        })
        return;
    }
    try {
        const data = new FormData(formulario_insercion);
        let resp = await fetch ('../controller/practicascontroller.php?op=guardar',{
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: data
        });
        json = await resp.json();
        if(json.status){
            Swal.fire(
                "¡Exito!",
                json.msg,
                "success"
            )
            formulario_insercion.reset();
            document.getElementById('modal-insercion').classList.remove('modal-show');
            ListarPracticas();
        }
        else{
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: json.msg
            })
        }
    } catch (error) {
        console.log(error)
    }
}
function EliminarPractica(id){
    Swal.fire({
        title: '¿Estás seguro?',
        text: "El registro sera eliminado definitivamente",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Si, eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            ConfigDeletePractica(id)
        }
    })
}
async function ConfigDeletePractica(id){
    let formData = new FormData();
    formData.append('idpractica',id);
    try {
        let resp = await fetch ('../controller/practicascontroller.php?op=eliminar',{
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        json = await resp.json();
        if(json.status){
            Swal.fire(
                "¡Exito!",
                json.msg,
                "success"
            )
            ListarPracticas();
        }
        else{
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: json.msg
            })
        }   
    } catch (error) {
        console.log(error)
    }
}
async function GuardarEmpleo(){
    let Tcontrato;
    let ruc = document.getElementById('ruc_laboral').value;
    let empresa = document.getElementById('empresa_laboral').value;
    let cargo = document.getElementById('cargo_laboral').value;
    let condicion = document.getElementById('idcondicion_laboral').value;
    let ingreso = document.getElementById('idingreso_laboral').value;
    let fechainicio = document.getElementById('fechainicio_laboral').value;
    let fechafin = document.getElementById('fechafin_laboral').value;
    let radioTcontrato = document.querySelectorAll('.input-radio_laboral');
    radioTcontrato.forEach(function(e) {
        if (e.checked) {
            Tcontrato = e.value;
        }
    });
    if(Tcontrato == 1){
        if(ruc == "" || empresa == "" || cargo == "" || condicion == 0 || ingreso == 0 || fechainicio == "" || fechafin == ""){
            Swal.fire({
                icon: 'warning',
                title: '¡Ooh no!',
                text: 'Los campos con (*) son obligatorios'
            })
            return;
        }
    }else if (Tcontrato == 2){
        if(ruc == "" || empresa == "" || cargo == "" || condicion == 0 || ingreso == 0 || fechainicio == ""){
            Swal.fire({
                icon: 'warning',
                title: '¡Ooh no!',
                text: 'Los campos con (*) son obligatorios'
            })
            return;
        }
    }
    else{
        Swal.fire({
            icon: 'warning',
            title: '¡Ooh no!',
            text: 'Debe seleccionar una opción (Termino de contrato)'
        })
        return;
    }
    try {
        const data = new FormData(formulario_laboral);
        let resp = await fetch ('../controller/empleocontroller.php?op=guardar',{
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: data
        });
        json = await resp.json();
        if(json.status){
            Swal.fire(
                "¡Exito!",
                json.msg,
                "success"
            )
            formulario_laboral.reset();
            document.getElementById('modal-laboral').classList.remove('modal-show');
            ListarEmpleo();
        }
        else{
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: json.msg
            })
        }
    } catch (error) {
        console.log(error)
    }
}
async function ListarEmpleo(){
    document.querySelector("#tblbodylista_empleo").innerHTML = "";
    let id = document.getElementById('id').value;
    const formData = new FormData();
    formData.append('idegresado',id)
    try {
        let resp = await fetch ('../controller/empleocontroller.php?op=listar',{
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        json = await resp.json();
        if(json.status){
            let data = json.data;
            var i = 0;
            data.forEach((item)=>{
                i++;
                let ffin = '';
                let condicion = '';
                let ingreso = '';
                if(item.Fecha_Fin == '0000-00-00' || item.Fecha_Fin == null){
                    ffin = 'ACTUALIDAD';
                }
                else{
                    ffin = FormatDate(item.Fecha_Fin);
                }
                if(item.Id_EstLaboral == 1){
                    condicion = 'NOMBRADO';
                }
                else if(item.Id_EstLaboral == 2){
                    condicion = 'CONTRATO INDEFINIDO, PERMANENTE';
                }
                else if(item.Id_EstLaboral == 3){
                    condicion = 'CONTRATO A PLAZO FIJO';
                }
                else if(item.Id_EstLaboral == 4){
                    condicion = 'CONTRATO POR LOCACIÓN DE SERVICIOS';
                }
                else if(item.Id_EstLaboral == 5){
                    condicion = 'SIN CONTRATO';
                }
                else if(item.Id_EstLaboral == 6){
                    condicion = 'OTRO';
                }
                if(item.Id_Ingreso == 1){
                    ingreso = 'MENOS SUELDO BASICO';
                }
                else if(item.Id_Ingreso == 2){
                    ingreso = 'SUELDO BÁSICO';
                }
                else if(item.Id_Ingreso == 3){
                    ingreso = 'E S/. 1001 A S/. 1500';
                }
                else if(item.Id_Ingreso == 4){
                    ingreso = 'DE S/. 1501 A S/. 2000';
                }
                else if(item.Id_Ingreso == 5){
                    ingreso = 'DE S/. 2001 A S/. 2500';
                }
                else if(item.Id_Ingreso == 6){
                    ingreso = 'DE S/. 2501 A MAS';
                }
                let newtr = document.createElement("tr");
                newtr.id = "row_"+item.Id_Empleo;
                newtr.innerHTML = `<td class="opacity">${i}</td>
                                    <td data-label="Empresa" class="rcab">${item.Nom_Empresa}</td>
                                    <td data-label="Cargo">${item.Car_Empresa}</td>
                                    <td data-label="Condición">${condicion}</td>
                                    <td data-label="Fecha Inicio">${FormatDate(item.Fecha_Inicio)}</td>
                                    <td data-label="Fecha fin">${ffin}</td>
                                    <td data-label="Ingreso Mensual">${ingreso}</td>
                                    <td data-label="Acciones">
                                        <div class="data-action">
                                            <a class="fa-solid fa-trash-can" onclick="EliminarEmpleo(${item.Id_Empleo})" title="Eliminar"></a>
                                        </div>
                                    </td>`;
                document.querySelector("#tblbodylista_empleo").appendChild(newtr);
            });
        }
    }
    catch (error) {
        console.log(error)
    }
}
function EliminarEmpleo(id){
    Swal.fire({
        title: '¿Estás seguro?',
        text: "El registro sera eliminado definitivamente",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡Si, eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            ConfigDeleteEmpleo(id)
        }
    })
}
async function ConfigDeleteEmpleo(id){
    let formData = new FormData();
    formData.append('idempleo',id);
    try {
        let resp = await fetch ('../controller/empleocontroller.php?op=eliminar',{
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        json = await resp.json();
        if(json.status){
            Swal.fire(
                "¡Exito!",
                json.msg,
                "success"
            )
            ListarEmpleo();
        }
        else{
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: json.msg
            })
        }   
    } catch (error) {
        console.log(error)
    }
}
function FormatDate(date){
    const fecha = new Date(date);
    const offsetMinutos = fecha.getTimezoneOffset();
    fecha.setMinutes(fecha.getMinutes() + offsetMinutos);
    const opciones = {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        timeZone: 'America/Lima'
    };
    const formatoFecha = new Intl.DateTimeFormat('es-PE', opciones);

    return formatoFecha.format(fecha);
}

init()