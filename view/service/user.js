function init(){
    if(document.querySelector('#tblbodylista')){
        Listar();
    }
    if(document.querySelector('#formulario')){
        let formulario = document.querySelector("#formulario");
        ListarTipoUsuario()
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
        let resp = await fetch("../controller/usuariocontroller.php?op=listar");
        json = await resp.json();
        if(json.status){
            let data = json.data;
            var i = 0;
            data.forEach((item) =>{
                i++;
                let newtr = document.createElement("tr");
                newtr.id = "row_"+item.Id_Usuario;
                    newtr.innerHTML = `<td class="opacity">${i}</td>
                                        <td data-label="Nombre" class="rcab">${item.Nom_Usuario} ${item.Ape_Usuario}</td>
                                        <td data-label="Usuario">${item.User_Usuario}</td>
                                        <td data-label="Tipo">${item.Desc_Perfil}</td>
                                        <td data-label="Acciones">
                                            <div class="data-action">
                                                ${item.options}
                                            </div>
                                        </td>`;
                document.querySelector("#tblbodylista").appendChild(newtr);
            });
            
        }
        console.log(json);
    } catch (error) {
        console.log(error);
    }
}
async function ListarTipoUsuario(){
    document.querySelector("#idtipo").innerHTML = "";
    try {
        let resp = await fetch("../controller/usuariocontroller.php?op=listarselect");
        json = await resp.json();
        if(json.status){
            let data = json.data;

            let initialOption = document.createElement("option");
            initialOption.value = ""; 
            initialOption.disabled = true;
            initialOption.selected = true;
            document.querySelector("#idtipo").appendChild(initialOption);

            data.forEach((item) =>{
                let newop = document.createElement("option");
                newop.value = item.Id_Perfil;
                newop.innerHTML = item.Desc_Perfil;
                
                document.querySelector("#idtipo").appendChild(newop);
            });
        }
    } catch (error) {
        console.log(error);
    }
}
async function GuardaryEditar(){
    let nombre = document.querySelector("#nombre").value;
    let user = document.querySelector("#user").value;
    let password = document.querySelector("#password").value;
    let confipass = document.querySelector("#confipass").value;
    let idtipo = document.querySelector("#idtipo").value;
    if(nombre == "" || user == "" || password == "" || confipass == "" || idtipo == 0){
        Swal.fire({
            icon: 'warning',
            title: '¡Ooh no!',
            text: 'Los campos con (*) son obligatorios'
        })
        return;
    }
    try {
        if(password == confipass){
            const data = new FormData(formulario);
            let resp = await fetch ('../controller/usuariocontroller.php?op=guardaryeditar',{
                method: 'POST',
                mode: 'cors',
                cache: 'no-cache',
                body: data
            });
            json = await resp.json();
            if(json.status){
                
                window.location.href = 'user.php?exito=1&msg='+encodeURIComponent(json.msg)+'&rute=muser';
                formulario.reset();
            }
            else{
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: json.msg
                })
            }
        }
        else{
            Swal.fire({
                icon: 'warning',
                title: '¡Oh no!',
                text: 'Las contraseñas no coinsiden'
            })
        }
        
    } catch (error) {
        console.log(error)
    }

}
async function Mostrar(id){
    const formData = new FormData();
    formData.append('idusuario',id)
    try {
        let resp = await fetch ('../controller/usuariocontroller.php?op=mostrar',{
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        json = await resp.json();
        if(json.status){
            document.querySelector("#id").value = json.data.Id_Usuario;
            
            document.querySelector("#nombre").value = json.data.Nom_Usuario;
            document.querySelector("#nombre").nextElementSibling.classList.add('fijar');
            document.querySelector("#apellido").value = json.data.Ape_Usuario;
            document.querySelector("#apellido").nextElementSibling.classList.add('fijar');
            document.querySelector("#user").value = json.data.User_Usuario;
            document.querySelector("#user").nextElementSibling.classList.add('fijar');
            document.querySelector("#password").value = json.data.Pass_Usuario;
            document.querySelector("#password").nextElementSibling.classList.add('fijar');
            document.querySelector("#confipass").value = json.data.Pass_Usuario;
            document.querySelector("#confipass").nextElementSibling.classList.add('fijar');
            document.querySelector("#idtipo").value = json.data.Id_Pefil;
            document.querySelector("#idtipo").nextElementSibling.classList.add('fijar');
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
    formData.append('idusuario',id);
    try {
        let resp = await fetch ('../controller/usuariocontroller.php?op=eliminar',{
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

async function Buscar(){
    let search = document.querySelector("#search_input").value;
    if(search == ""){
        Listar();
    }
    document.querySelector("#tblbodylista").innerHTML = "";
    try {
        let formData = new FormData();
        formData.append('search_input',search)
        let resp = await fetch ('../controller/usuariocontroller.php?op=buscar',{
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
                let newtr = document.createElement("tr");
                newtr.id = "row_"+item.Id_Usuario;
                    newtr.innerHTML = `<td class="opacity">${i}</td>
                                        <td data-label="Nombre" class="rcab">${item.Nom_Usuario} ${item.Ape_Usuario}</td>
                                        <td data-label="Usuario">${item.User_Usuario}</td>
                                        <td data-label="Tipo">${item.Desc_Perfil}</td>
                                        <td data-label="Acciones">
                                            <div class="data-action">
                                            <a onclick="RestaurarPassword(${item.Id_Usuario})"class="fa-solid fa-arrow-rotate-left" title="Restaurar contraseña"> </a> 
                                            <a href="userform.php?id=${item.Id_Usuario}&rute=auser" class="fa-solid fa-tags" title="Modificar"> </a>
                                            <a class="fa-solid fa-trash-can" onclick="Eliminar(${item.Id_Usuario})" title="Eliminar"></a>
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
async function RestaurarPassword(id){
    const formData = new FormData();
    formData.append('idusuario',id)
    try {
        let resp = await fetch ('../controller/usuariocontroller.php?op=mostrar',{
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        json = await resp.json();
        if(json.status){
            Swal.fire({
                title: '¿Estás seguro?',
                text: "La contraseña tomara su valor por defecto",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Si, restaurar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    ConfirmRestorePassword(id,json.data.User_Usuario);
                }
            })
        }
    }catch(error){
        console.log(error)
    }
}
async function ConfirmRestorePassword(id,password){
    let formData = new FormData();
    formData.append('idusuario',id);
    formData.append('password',password);
    try {
        let resp = await fetch ('../controller/usuariocontroller.php?op=restaurarpassword',{
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
init()