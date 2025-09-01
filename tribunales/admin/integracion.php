<?php
include("conecta.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
</head>
 
<body class="integracion" style="background-color:#EAEAEA">

<div id="menu-lateral"></div>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-2">
                <a class="btn btn-dark" id="boton-menu">
                    <i class="fa fa-bars" aria-hidden="true"></i> Menu
                </a>
            </div>
        </div>
    </div>    
     
    <div class="container-fluid mt-3 ">
        
        <div class="row">
            <div class="col-sm-2">
                <select id="year" class="form-control" onchange="carga_año()">
                </select>
            </div>
            <div class="col-sm-8">
                <div class="container-fluid">
                    <div class="row"> 
                        <div class="col-sm-3">
                            <button class="btn btn-sm btn-dark w-100 h-100" id="atras" onclick="semanaPasada()"> <-- Anterior</button>
                        </div> 
                        <div class="col-sm-6">
                            <select id="semanav2" class="form-control" onchange="obtenerRangoSemana()" > </select> 
                        </div>  
                        <div class="col-sm-3">
                            <button class="btn btn-sm btn-dark w-100 h-100" id="adelante" onclick="semanaSiguiente()">Siguiente --> </button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-sm-2"></div>
        </div>
        <hr>
        <div class="row" id="tabla1">
        </div>
    </div>

    <div class="modal fade bd-example-modal-xl" id="modal_agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="modal-title">Asignación a sala:</h5>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="list-group" id="modal-agregar">  
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-xl" id="modal_comentario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title"> Comentario:</h5> 
                    <h5 class="modal-title" id="error" style="margin-left:20px; color:red" ></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="list-group" id="modal-comentario">  
                       
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="js/script.js"></script>

<script>

    $(document).ready(function() {
        var yearActual = new Date().getFullYear();
        var yearAnterior = yearActual-1;
        var yearSiguiente = yearActual+1;

        $("#year").html(`
            <option value="`+yearAnterior+`">`+yearAnterior+`</option>
            <option value="`+yearActual+`" selected>`+yearActual+`</option>
            <option value="`+yearSiguiente+`">`+yearSiguiente+`</option>
        `);
        
        calcula_semanas(yearActual);
        obtenerRangoSemana();
    
    });

    function carga_año() {
        var anio = $('#year').val();
        calcula_semanas(anio);
    }

    function calcula_semanas(año) {
        // Obtén el año actual
        var miFecha = new Date();

        // Extraer el año de la fecha
        var año_actual = miFecha.getFullYear();

        if (año_actual == año) {
            var yearActual = año_actual;
            fecha = new Date();
        }
        if (año_actual > año) {
            var yearActual = miFecha.getFullYear() - 1;
            fecha = new Date(yearActual+"-12-30T00:00:00");
        }
        if (año_actual < año) {
            var yearActual = miFecha.getFullYear() + 1;
            fecha = new Date(yearActual+"-01-01T00:00:00");
        }
        
        //console.log(fecha, yearActual);
        
        
        // Obtén el número de la semana actual
        var semanaActual = obtenerNumeroSemana(fecha);
        
        // Selecciona el elemento <select>
        var selectSemana = $('#semanav2');

        $("#semanav2").empty();

        // Itera sobre las 52 semanas (o 53 en algunos casos) del año
        for (var semana = 1; semana <= 53; semana++) {
            // Calcula la fecha de inicio de la semana
            var fechaInicio = obtenerFechaInicioSemana(yearActual, semana);

            // Calcula la fecha de fin de la semana
            var fechaFin = obtenerFechaFinSemana(yearActual, semana);

            // Genera el valor del atributo "value" solo con la fecha del primer día
            var valorSemana = fechaInicio.toISOString().split('T')[0];

            // Crea un nuevo elemento <option> con el texto de inicio y fin y el valor de la fecha del primer día
            var opcion = '<option value="' + valorSemana + '" data-pos="'+semana+'" >Semana ' + semana + ': ' + fechaInicio.toISOString().split('T')[0] + ' - ' + fechaFin.toISOString().split('T')[0] + '</option>';

            // Establece el atributo "selected" si la semana es la semana actual
            if (semana === semanaActual) {
                opcion = opcion.replace('<option', '<option selected="true"');
            }

            // Agrega la opción al select
            selectSemana.append(opcion);
        }
        obtenerRangoSemana();
    }

    // Función para obtener el número de la semana
    function obtenerNumeroSemana(fecha) {
        var d = new Date(Date.UTC(fecha.getFullYear(), fecha.getMonth(), fecha.getDate()));
        var dayNum = d.getUTCDay() || 7;
        d.setUTCDate(d.getUTCDate() + 4 - dayNum);
        var yearStart = new Date(Date.UTC(d.getUTCFullYear(), 0, 1));
        return Math.ceil((((d - yearStart) / 86400000) + 1) / 7);
    }

    // Función para obtener la fecha de inicio de la semana
    function obtenerFechaInicioSemana(year, semana) {
        var fechaInicio = new Date(year, 0, 1 + (semana - 1) * 7);
        fechaInicio.setDate(fechaInicio.getDate() - fechaInicio.getDay() + 1); // Ajusta al primer día de la semana (lunes)
        return fechaInicio;
    }

    // Función para obtener la fecha de fin de la semana
    function obtenerFechaFinSemana(year, semana) {
        var fechaInicio = obtenerFechaInicioSemana(year, semana);
        var fechaFin = new Date(fechaInicio);
        fechaFin.setDate(fechaFin.getDate() + 6); // Ajusta al último día de la semana (domingo)
        return fechaFin;
    }

    function datos(rango1, rango2, fecha2, fecha3, fecha4, fecha5){

        data = {
            "accion" : 0,
            "rango1": rango1,
            "rango2": rango2,
            "dia2": fecha2,
            "dia3": fecha3,
            "dia4": fecha4,
            "dia5": fecha5,
        };
        $.ajax({
            data: data,
            url: 'integracion_accion.php',
            method: 'post',
            success: function(response){
                $('#tabla1').html(response)
            }
        })
    }

    function obtenerRangoSemana(){

        var semanaSelect = document.getElementById('semanav2').value; 

        var range1 = new Date(semanaSelect);

        var range2 = new Date(range1);

        range2.setDate(range1.getDate()+5);

        //console.log(range1, range2);

        var ra1 = range1.toISOString().split('T')[0];
        var ra2 = range2.toISOString().split('T')[0];

        //---------------------------------------------------------------------------------

        var martes = new Date(range1);
        var miercoles = new Date(range1);
        var jueves = new Date(range1);
        var viernes = new Date(range1);

        martes.setDate(range1.getDate() + 1 );
        miercoles.setDate(range1.getDate() + 2 );
        jueves.setDate(range1.getDate() + 3 );
        viernes.setDate(range1.getDate() + 4 );

        var fecha2 = martes.toISOString().split('T')[0];
        var fecha3 = miercoles.toISOString().split('T')[0];
        var fecha4 = jueves.toISOString().split('T')[0];
        var fecha5 = viernes.toISOString().split('T')[0];

        $('#rango1').html(ra1);
        $('#rango2').html(ra2);
        // -----------------------------------------------------------------------------

        //range1.setMinutes(range1.getMinutes()+ range1.getTimezoneOffset());

        //var semanaActual = obtenerNumeroSemana(range1);

        var opcionSeleccionada = $('#semanav2').find(":selected");
        var valorNuevaPropiedad = opcionSeleccionada.data("pos");

        if (valorNuevaPropiedad == 1) {
            $("#atras").prop("disabled", true);
            $("#adelante").prop("disabled", '');
        }
        else{
            if (valorNuevaPropiedad == 53){
                $("#adelante").prop("disabled", true);
                $("#atras").prop("disabled", '');
            }
            else{
                $("#atras").prop("disabled", '');
                $("#adelante").prop("disabled", '');
            }
        } 
        //----------------------------------------------------------------------------
        datos(ra1,ra2, fecha2, fecha3, fecha4, fecha5);
    }

    function semanaPasada(){
        var semanaSelect = document.getElementById('semanav2').value;
        var range1 = new Date(semanaSelect);
        range1.setMinutes(range1.getMinutes()+ range1.getTimezoneOffset());
        //console.log(range1)
        var atras = new Date(range1);
        atras.setDate(range1.getDate()-7);
        var a1 = atras.toISOString().split('T')[0];
        $('#semanav2').val(a1);
        obtenerRangoSemana();
    }

    function semanaSiguiente(){
        var semanaSelect = document.getElementById('semanav2').value;
        var range1 = new Date(semanaSelect);
        range1.setMinutes(range1.getMinutes()+ range1.getTimezoneOffset());
        //console.log(range1)
        var adelante = new Date(range1);
        adelante.setDate(range1.getDate()+7);
        var a1 = adelante.toISOString().split('T')[0];
        $('#semanav2').val(a1);
        obtenerRangoSemana();
    }

    function enviarPosicion(sala, posicion, fecha, r1, r2){
        $('#modal_agregar').modal('show');

        var f1 = new Date(r1);
        var f2 = new Date(r1);
        var f3 = new Date(r1);
        var f4 = new Date(r1);
        var f5 = new Date(r1);

        f2.setDate(f1.getDate()+1);
        f3.setDate(f1.getDate()+2);
        f4.setDate(f1.getDate()+3);
        f5.setDate(f1.getDate()+4);

        var d2 = f2.toISOString().split('T')[0];
        var d3 = f3.toISOString().split('T')[0];
        var d4 = f4.toISOString().split('T')[0];
        var d5 = f5.toISOString().split('T')[0];

        var pos = 0;
        if(fecha == r1){
            pos = 1;
        }
        if(fecha == d2){
            pos = 2;
        }
        if(fecha == d3){
            pos = 3;
        }
        if(fecha == d4){
            pos = 4;
        }
        if(fecha == d5){
            pos = 5;
        }
        if(fecha == r2){
            pos = 6;
        }

        console.log(pos);
        data = {
            "accion": 1,
            "sala": sala,
            "posicion": posicion,
            "fecha": fecha,
            "r1": r1,
            "r2": r2,
            "pos": pos
        };
        $.ajax({
            data: data,
            url: 'integracion_accion.php',
            method: 'post',
            success: function(response){
                $('#modal-agregar').html(response);
            }

        })
    }

    function enviarPosicionD(fecha, sala, r1, r2, posicion){
        //console.log(posicion);
        $('#modal_comentario').modal('show');
        data = {
            "accion": 6,
            "fecha": fecha,
            "sala": sala,
            "r1": r1,
            "r2": r2,
            "posicion": posicion
        };
        $.ajax({
            data: data,
            url: 'integracion_accion.php',
            method: 'post',
            success: function(response){
                $('#modal-comentario').html(response);
            }
        })
    }

    function insertarFuncionario(rut, sala, posicion, fecha){
        data = {
            "accion": 2,
            "rut": rut,
            "sala": sala,
            "posicion": posicion,
            "fecha": fecha
        };
        $.ajax({
            
            data : data,
            url: 'integracion_accion.php',
            method: 'post',
            success: function(response){
                obtenerRangoSemana();
            }
            
        })
    }

    function confirmar(fecha){
        data = {
            "accion": 3,
            "fecha": fecha,
        }
        $.ajax({
            data: data,
            url:'integracion_accion.php',
            method:'post',
            success: function(response){
                obtenerRangoSemana();
                if (response != 0){
                    alert("Faltan Datos!");
                }
            }
        })
    }

    function desconfirmar(fecha){
        data = {
            "accion": 4,
            "fecha": fecha,
        }
        $.ajax({
            data: data,
            url:'integracion_accion.php',
            method: 'post',
            success: function(response){
                obtenerRangoSemana();
            }
        })
    }

    function eliminarFuncionario(sala, posicion, fecha){
        data = {
            "accion": 5,
            "sala": sala,
            "posicion": posicion,
            "fecha": fecha
        };
        $.ajax({
            data: data,
            url:'integracion_accion.php',
            method: 'post',
            success: function(response){
                obtenerRangoSemana();
            }
        })
    }
    
    function agregarComentario(fecha, sala, r1, r2, posicion){

        var check = document.getElementsByName("exampleRadios");

        for (var i =0; i < check.length; i++){
            if (check[i].checked){
                var tipo = check[i].value;
            }
        }
        
        var comentario = $('#comentario').val();
        if (comentario == ""){
            $('#error').html('Debe ingresar un comentario');
        }else{
                var date = new Date();

                var year = date.getFullYear();
                var month = date.getMonth()+1;
                var day = date.getDate();

                var hora = date.getHours();
                var minu = date.getMinutes();
                var segu = date.getSeconds();

                month = (month < 10) ? "0" + month : month;
                day = (day < 10) ? "0" + day : day;
                hora = (hora < 10) ? "0" + hora : hora;
                minu = (minu < 10) ? "0" + minu : minu;
                segu = (segu < 10) ? "0" + segu : segu;
                var fechaActual = year + "-" + month + "-" + day + " " + hora + ":" + minu + ":" + segu;

                var txt = document.getElementById('comentario');
                txt.value='';

                data = {
                    "accion": 7,
                    "fecha": fecha,
                    "sala": sala,
                    "comentario": comentario,
                    "fechaActual": fechaActual,
                    "tipo": tipo
                };
                $.ajax({
                    
                    data : data,
                    url: 'integracion_accion.php',
                    method: 'post',
                    success: function(response){
                        enviarPosicionD(fecha, sala, r1, r2, posicion);
                        $('#error').html('');
                    }
                    
                })
        }
        
    }

    function eliminarComentario(fechaA, sala, posicion, fecha, r1, r2, modal){

        data = {
            "accion": 8,
            "fecha": fechaA,
        };
        $.ajax({
            
            data : data,
            url: 'integracion_accion.php',
            method: 'post',
            success: function(response){
                if (modal == 'modal-a'){
                    
                    enviarPosicion(sala, posicion, fecha, r1, r2);
                }else{
                    enviarPosicionD(fecha, sala, r1, r2, posicion);
                }   
            }  
        })
    }


</script>