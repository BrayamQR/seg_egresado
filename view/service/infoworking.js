function init(){
    if(document.getElementById('btn-add-insercion') && document.getElementById('btn-add-laboral')){
        ShowModal();
    }
    if(document.getElementById('formulario-modal-laboral')){
        HabilitarInput();
    }
}
function ShowModal(){
    let btn_insercion = document.getElementById('btn-add-insercion');
    let btn_laboral = document.getElementById('btn-add-laboral');

    btn_insercion.addEventListener('click',function(){
        document.getElementById('modal-insercion').classList.add('modal-show');
        document.getElementById('formulario-modal-insercion').reset();
        document.querySelectorAll('.input-form').forEach(function(e){
            e.nextElementSibling.classList.remove('fijar');
        });
    });
    btn_laboral.addEventListener('click',function(){
        document.getElementById('modal-laboral').classList.add('modal-show');
        document.getElementById('formulario-modal-laboral').reset();
        document.getElementById('fechafin-laboral').disabled = true;
        document.getElementById('fechafin-laboral').nextElementSibling.textContent = document.getElementById('fechafin-laboral').nextElementSibling.textContent.replace(' *', '');
        document.querySelectorAll('.input-form').forEach(function(e){
            e.nextElementSibling.classList.remove('fijar');
        });
    })
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
                    document.getElementById('fechafin-laboral').disabled = false;
                    document.getElementById('fechafin-laboral').nextElementSibling.textContent += ' *';
                }
                else if (e.value === '2') {
                    document.getElementById('fechafin-laboral').disabled = true;
                    document.getElementById('fechafin-laboral').nextElementSibling.textContent = document.getElementById('fechafin-laboral').nextElementSibling.textContent.replace(' *', '');
                }
            }
        });
    });
}
init();