////////////////////////////////////////////GENERALES///////////////////////////////////////////////////
$(document).ready(function () {
    // verifica si hay inicio de sesion
    entry_pass();
    // carga el menu lateral
    var parametros = {
        "accion"   : "menu_lateral",
    };
    $.ajax({              
        data:  parametros,
        url:'accion.php',
        type:'post',
        success:function (response) {
            $("#menu-lateral").html(response);
            var menu = $('body').attr('class');
            // carga caracteristicas de cada pagina
            $("a.list-group-item").removeClass('active');
            $("#"+menu).addClass('active');
            if (menu == "verifica") {
                tabla_verificados();
            }
        }
    })

});

$("#boton-menu").click(function() {
    const bsOffcanvas = new bootstrap.Offcanvas('#offcanvasExample');
    bsOffcanvas.toggle()
});

function entry_pass() {
    $.ajax({
        url: "seguridad.php",
        type:'post',
        success:function (response) {
            if (response == "error") {
                window.location.href = "login.html";
            }
        }
    });
}

function end_sesion() {
    var parametros = {
        "accion"   : "fin_sesion",
    };
    $.ajax({              
        data:  parametros,
        url:'accion.php',
        type:'post',
        success: function (response) {
            window.location.href = "login.html";
        }
      })
}
function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}

////////////////////////////////////////////VERIFICADOR.HTML///////////////////////////////////////////////////
    function tabla_verificados() {
        var parametros = {
            "accion"   : "busca_verificados",
        };
        $.ajax({              
            data:  parametros,
            url:'accion.php',
            type:'post',
            success:function (response) {
                $("#resultado_verificados").html(response);
                
            }
        })
    }

    $('#fecha-ingreso-v').ready(function () {
        var f=new Date();
        //console.log(f);
        fecha = formatDate(f);
        var calculada = f.setDate(f.getDate()+180);
        calculada = formatDate(calculada);
        //fecha=( f.getDate()+"-"+mes+"-"+ f.getFullYear() );
        //console.log(fecha);
        //console.log(calculada);
        $('#fecha-ingreso-v').val(fecha);
        $('#fecha-expira-v').val(calculada);

    });

////////////////////////////////////////////RECURSOS.HTML///////////////////////////////////////////////////
function mostrar_tabla_r(estado) {
    var parametros = {
        "accion"   : "mostrar_tabla_r",
        "estado": estado
    };
    $.ajax({              
        data:  parametros,
        url:'accion.php',
        type:'post',
        success:function (response) {
            if (estado == "0") {
                $("#resultado_pendientes").html(response);
            }
            if (estado == "1") {
                $("#resultado_tramitacion").html(response);
            }
            
            
            
        }
    })
}
