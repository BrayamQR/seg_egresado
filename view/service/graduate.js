function init(){
    if(document.querySelector('#tblbodylista')){
        Listar();
    }
    if(document.querySelector('#formulario')){
        SelectImage();
        let formulario = document.querySelector("#formulario");
        formulario.onsubmit = function(e){
            e.preventDefault();
            GuardaryEditar();
        }
    }
    if(document.querySelector('#form_search')){
        let inputsearch = document.querySelector("#search_input");
        inputsearch.addEventListener("keyup",InputSearch,true);
    }
}
async function Listar(){
    
    document.querySelector("#tblbodylista").innerHTML = "";
    try {
        let resp = await fetch("../controller/egresadocontroller.php?op=listar");
        json = await resp.json();
        if(json.status){
            let data = json.data;
            var i = 0;
            data.forEach((item) =>{
                i++;
                let condicion = '';
                if(item.Id_Condicion == 1){
                    condicion = 'EGRESADO';
                }
                if(item.Id_Condicion == 2){
                    condicion = 'TITULADO';
                }
                let newtr = document.createElement("tr");
                newtr.id = "row_"+item.Id_Egresado;
                newtr.innerHTML = `<td class="opacity">${i}</td>
                                    <td data-label="Documento" class="rcab">${item.Doc_Egresado}</td>
                                    <td data-label="Código">${item.Cod_Egresado}</td>
                                    <td data-label="Nombre">${item.Nom_Egresado} ${item.Apa_Egresado} ${item.Ama_Egresado}</td>
                                    <td data-label="Email" >${item.Email_Egresado}</td>
                                    <td data-label="Teléfono" >${item.Tel_Egresado}</td>
                                    <td data-label="Programa" >${item.Id_Programa}</td>
                                    <td data-label="Condición" >${condicion}</td>
                                    <td data-label="Acciones">
                                        <div class="data-action">
                                            ${item.options}
                                        </div>
                                    </td>`;
                document.querySelector("#tblbodylista").appendChild(newtr);
            });
        }
    } catch (error) {
        console.log(error)
    }
}
async function GuardaryEditar(){
    let documento = document.querySelector("#documento").value;
    let codigo = document.querySelector("#codigo").value;
    let nombre = document.querySelector("#nombre").value;
    let apaterno = document.querySelector("#apaterno").value;
    let amaterno = document.querySelector("#amaterno").value;
    let fechanacimiento = document.querySelector("#fechanacimiento").value;
    let email = document.querySelector("#email").value;
    let telefono = document.querySelector("#telefono").value;
    let direccion = document.querySelector("#direccion").value;
    let idprograma = document.querySelector("#idprograma").value;
    let idcondicion = document.querySelector("#idcondicion").value;
    let fechaobtencion = document.querySelector("#fechaobtencion").value;
    if(documento == "" || codigo == "" || nombre == "" || apaterno == "" ||amaterno == "" || fechanacimiento == "" || email == "" || telefono == "" ||  direccion == ""|| idprograma == 0 || idcondicion == 0 || fechaobtencion == "" ){
        Swal.fire({
            icon: 'warning',
            title: '¡Ooh no!',
            text: 'Los campos con (*) son obligatorios'
        })
        return;
    }
    try {
        const data = new FormData(formulario);
        let resp = await fetch ('../controller/egresadocontroller.php?op=guardaryeditar',{
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: data
        });
        json = await resp.json();
        if(json.status){
            window.location.href = 'graduate.php?exito=1&msg='+encodeURIComponent(json.msg)+'&rute=mgraduate';
            formulario.reset();
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
async function Mostrar(id){
    const formData = new FormData();
    formData.append('idegresado',id)
    try {
        let resp = await fetch ('../controller/egresadocontroller.php?op=mostrar',{
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        json = await resp.json();
        if(json.status){
            document.querySelector("#id").value = json.data.Id_Egresado;
            document.querySelector("#documento").value = json.data.Doc_Egresado;
            document.querySelector("#documento").nextElementSibling.classList.add('fijar');
            document.querySelector("#codigo").value = json.data.Cod_Egresado;
            document.querySelector("#codigo").nextElementSibling.classList.add('fijar');
            document.querySelector("#nombre").value = json.data.Nom_Egresado;
            document.querySelector("#nombre").nextElementSibling.classList.add('fijar');
            document.querySelector("#apaterno").value = json.data.Apa_Egresado;
            document.querySelector("#apaterno").nextElementSibling.classList.add('fijar');
            document.querySelector("#amaterno").value = json.data.Ama_Egresado;
            document.querySelector("#amaterno").nextElementSibling.classList.add('fijar');
            document.querySelector("#fechanacimiento").value = json.data.Fech_Nacimiento;
            document.querySelector("#fechanacimiento").nextElementSibling.classList.add('fijar');
            document.querySelector("#email").value = json.data.Email_Egresado;
            document.querySelector("#email").nextElementSibling.classList.add('fijar');
            document.querySelector("#telefono").value = json.data.Tel_Egresado;
            document.querySelector("#telefono").nextElementSibling.classList.add('fijar');
            document.querySelector("#direccion").value = json.data.Dir_Egresado;
            document.querySelector("#direccion").nextElementSibling.classList.add('fijar');
            document.querySelector("#idprograma").value = json.data.	Id_Programa;
            document.querySelector("#idprograma").nextElementSibling.classList.add('fijar');
            document.querySelector("#idcondicion").value = json.data.Id_Condicion;
            document.querySelector("#idcondicion").nextElementSibling.classList.add('fijar');
            document.querySelector("#fechaobtencion").value = json.data.Fech_Obtencion;
            document.querySelector("#fechaobtencion").nextElementSibling.classList.add('fijar');
            document.querySelector("#imagenactual").value = json.data.Foto_Egresado;
            if(json.data.Foto_Egresado == null || json.data.Foto_Egresado == ""){
                document.querySelector("#imagenmuestra").src = "../img/student.png";
            }
            else{
                document.querySelector("#imagenmuestra").src = "../src/img-egresado/"+json.data.Foto_Egresado;
            }
        }
    } catch (error) {
        console.log(error)
    }
}
function Eliminar(id){
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
            ConfigDelete(id)
        }
    })
}
async function ConfigDelete(id){
    let formData = new FormData();
    formData.append('idegresado',id);
    try {
        let resp = await fetch ('../controller/egresadocontroller.php?op=eliminar',{
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
            Listar();
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
function SelectImage(){
    const defaultFile = '../img/student.png';
    const file = document.getElementById('foto');
    const img = document.getElementById('imagenmuestra');
    file.addEventListener('change', e=>{
        if(e.target.files[0]){
            const reader = new FileReader();
            reader.onload = function(e){
                img.src = e.target.result; 
            }
            reader.readAsDataURL(e.target.files[0])
        }
        else{
            img.src = defaultFile
        }

    })
}
function SearchByDni(){
    try {
        documento = document.getElementById('documento').value;
        $.ajax({
            url : '../config/api_reniec_dni.php',
            type: 'post',
            data: 'dni='+documento,
            dataType: 'json',
            success: function(e){
                if(e.numeroDocumento == documento){
                    document.querySelector("#nombre").nextElementSibling.classList.add('fijar');
                    document.querySelector("#nombre").value = e.nombres;
                    document.querySelector("#apaterno").nextElementSibling.classList.add('fijar');
                    document.querySelector("#apaterno").value = e.apellidoPaterno;
                    document.querySelector("#amaterno").nextElementSibling.classList.add('fijar');
                    document.querySelector("#amaterno").value = e.apellidoMaterno;
                }
                else{
                    Swal.fire(
                        "¡Ocurrio un error!",
                        "No se encontro a la persona",
                        "warning"
                    )
                }
            } 
        })
    } catch (error) {
        console.log(error)
    }
}
async function Buscar(){
    let search = document.querySelector("#search_input").value;
    if(search == ""){
        Listar();
    }
    document.querySelector("#tblbodylista").innerHTML = "";
    try {
        let formData = new FormData();
        formData.append('search_input',search)
        let resp = await fetch ('../controller/egresadocontroller.php?op=buscar',{
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        console.log(resp);
        json = await resp.json();
        if(json.status){
            let data = json.data;
            var i = 0;
            data.forEach((item)=>{
                i++;
                let condicion = '';
                if(item.Id_Condicion == 1){
                    condicion = 'EGRESADO';
                }
                if(item.Id_Condicion == 2){
                    condicion = 'TITULADO';
                }
                let newtr = document.createElement("tr");
                newtr.id = "row_"+item.Id_Egresado;
                newtr.innerHTML = `<td class="opacity">${i}</td>
                                    <td data-label="Documento" class="rcab">${item.Doc_Egresado}</td>
                                    <td data-label="Código">${item.Cod_Egresado}</td>
                                    <td data-label="Nombre">${item.Nom_Egresado} ${item.Apa_Egresado} ${item.Ama_Egresado}</td>
                                    <td data-label="Email" >${item.Email_Egresado}</td>
                                    <td data-label="Teléfono" >${item.Tel_Egresado}</td>
                                    <td data-label="Programa" >${item.Id_Programa}</td>
                                    <td data-label="Condición" >${condicion}</td>
                                    <td data-label="Acciones">
                                        <div class="data-action">
                                            <a href="infoworking.php?id=${item.Id_Egresado}&rute=msituation" class="fa-solid fa-eye" title="Ver situacion laboral"> </a>
                                            <a href="graduateform.php?id=${item.Id_Egresado}'&rute=agraduate" class="fa-solid fa-tags" title="Modificar"> </a>
                                            <a class="fa-solid fa-trash-can" onclick="Eliminar(${item.Id_Egresado})" title="Eliminar"></a>
                                        </div>
                                    </td>`;
                document.querySelector("#tblbodylista").appendChild(newtr);
            });
        }
        
    } catch (error) {
        console.log(error);
    }
}
function InputSearch(){
    let searchBus = document.querySelector("#search_input").value;
    if(searchBus == ""){
        Listar();
    }
    else{
        Buscar();
    }
}
init()