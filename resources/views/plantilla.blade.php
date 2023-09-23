<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> CitaGriVet</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="http://localhost/citagro.com.gt/public/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="http://localhost/citagro.com.gt/public/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="http://localhost/citagro.com.gt/public/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="http://localhost/citagro.com.gt/public/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="http://localhost/citagro.com.gt/public/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="http://localhost/citagro.com.gt/public/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="http://localhost/citagro.com.gt/public/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="http://localhost/citagro.com.gt/public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="http://localhost/citagro.com.gt/public/bower_components/bootstrap-daterangepicker/daterangepicker.css">
 
  <!-- DATA TABLE -->
 <link rel="stylesheet" href="http://localhost/citagro.com.gt/public/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
 <link rel="stylesheet" href="http://localhost/citagro.com.gt/public/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

<!-- componente calendar -->
<link rel="stylesheet" href="http://localhost/citagro.com.gt/public/bower_components/fullcalendar/dist/fullcalendar.min.css">
<link rel="stylesheet" href="http://localhost/citagro.com.gt/public/bower_components/fullcalendar/dist/fullcalendar.print.css" media="print">

<!-- select -->
<link rel="stylesheet" href="http://localhost/citagro.com.gt/public/bower_components/select2/dist/css/select2.min.css">


<!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini login-page">

@if(Auth::user())

<div class="wrapper">

  @include('modulos.cabecera')

  @if(auth()->user()->rol == "Secretaria")

  @include('modulos.menuSecretaria')

  @elseif(auth()->user()->rol == "Doctor")

  @include('modulos.menuDoctor')

  @endif

  @yield('content')
  
  </div>

@else

  @yield('contenido')

@endif


<script src="http://localhost/citagro.com.gt/public/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="http://localhost/citagro.com.gt/public/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="http://localhost/citagro.com.gt/public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="http://localhost/citagro.com.gt/public/bower_components/raphael/raphael.min.js"></script>
<script src="http://localhost/citagro.com.gt/public/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="http://localhost/citagro.com.gt/public/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="http://localhost/citagro.com.gt/public/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="http://localhost/citagro.com.gt/public/bower_components/moment/min/moment.min.js"></script>
<script src="http://localhost/citagro.com.gt/public/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="http://localhost/citagro.com.gt/public/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Slimscroll -->
<script src="http://localhost/citagro.com.gt/public/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="http://localhost/citagro.com.gt/public/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="http://localhost/citagro.com.gt/public/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="http://localhost/citagro.com.gt/public/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="http://localhost/citagro.com.gt/public/dist/js/demo.js"></script>

<!-- Data tables -->
<script src="http://localhost/citagro.com.gt/public/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="http://localhost/citagro.com.gt/public/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>

<script src="http://localhost/citagro.com.gt/public/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


<!-- FULLCALENDAR -->
<script src="http://localhost/citagro.com.gt/public/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>

<script src="http://localhost/citagro.com.gt/public/bower_components/fullcalendar/dist/locale/es.js"></script>

<script src="http://localhost/citagro.com.gt/public/bower_components/moment/moment.js"></script>


<!-- select -->
<script src="http://localhost/clinica-l8/public/bower_components/select2/dist/js/select2.js"></script>


<script type="text/javascript">

  $(".table").DataTable({

    "language": {
    
    "sSearch": "Buscar:",
    "sEmptyTable": "No hay datos en la tabla",
    "sZeroRecords": "No se encontraron resultados",
    "sInfo": "Mostrando registros del _START_ al _END_ de un total _TOTAL_",
    "SInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered": "(filtrando de un total de _MAX_ registros)",
    "oPaginate": {

      "sFirst": "Primero",
      "sLast": "Último",
      "sNext": "Siguiente",
      "sPrevious": "Anterior",

    },
    
    "sLoadingRecords": "cargando....",
    "sLengthMenu": "Mostrar _MENU_ registros"
  }

  });

// select
$('#select2').select2();

</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('Agregado') == 'Si')
 <script type="text/javascript">
    Swal.fire(
      'El paciente ha sido agregado',
      '',
      'success'
    )
 </script>

@elseif(session('actualizadop') == 'Si')
 <script type="text/javascript">
    Swal.fire(
      'El registro de paciente ha sido actualizado',
      '',
      'success'
    )
 </script>

@elseif(session('registrado') == 'Si')
 <script type="text/javascript">
    Swal.fire(
      'El Doctor ha sido agegado',
      '',
      'success'
    )
 </script>

@endif

<!-- eliminar -->
<script type="text/javascript">
$('.table').on('click','.EliminarPaciente',function(){

  var Pid = $(this).attr('Pid');
  var Paciente = $(this).attr('Paciente');

  Swal.fire({

     title: '¿Seguro que desea eliminar este a paciente: '+Paciente+'?',
     icon: 'warning',
     showCancelButton: true,
     cancelButtonText: 'Cancelar',
     cancelButtonColor: '#d33',
     confirmButtonText: 'Eliminar',
     confirmButtonColor: '#3085d6'

  }).then((result) => {
    if(result.isConfirmed){
      window.location = "Eliminar-Paciente/"+Pid;
    }
  })

})





$('.table').on('click','.EliminarDoctor',function(){

var Did = $(this).attr('Did');

Swal.fire({

   title: '¿Seguro que desea eliminar este a Doctor?',
   icon: 'warning',
   showCancelButton: true,
   cancelButtonText: 'Cancelar',
   cancelButtonColor: '#d33',
   confirmButtonText: 'Eliminar',
   confirmButtonColor: '#3085d6'

}).then((result) => {
  if(result.isConfirmed){
    window.location = "Eliminar-Doctor/"+Did;
  }
})

})
</script>


<?php

$exp = explode("/", $_SERVER["REQUEST_URI"]);

?>
@if($exp[3] == "Citas")

<script type="text/javascript">
  var date = new Date();
  var d = date.getDate(),
      m = date.getMonth(),
      a = date.getFullYear()

  $('#calendario').fullCalendar(
    {
      defaultView: 'agendaWeek',
      diffenDays : [0,7],

      events:[
        @foreach($citas as $cita)

        @if(auth()->user()->rol == "Doctor")
{
          id: '{{ $cita->id }}',
          title: '{{ $cita->PAC->name }}',
          start: '{{ $cita->FyHinicio }}',
          end: '{{ $cita->FyHfinal }}',
},
          @endif


        @endforeach
      ],

      @if($horarios != null)

        scrollTime: "{{ $hora->horaInicio }}",
        minTime: "{{ $hora->horaInicio }}",
        maxTime: "{{ $hora->horaFin }}",

      @else

        scrollTime: null,
        minTime: null,
        maxTime: null,

      @endif


      dayClick:function(date,jsEvent,view){

        var fecha = date.format();

        var hora = ("01:00:00").split(":");

        fecha = fecha.split("T");

        var hora1 = (fecha[1].split(":"));

        HI = parseFloat(hora1[0])
        HA = parseFloat(hora[0])

        var horaFinal = HI + HA;

        if(horaFinal < 10 && horaFinal > 0){

          var HF = "0"+horaFinal+":00:00";
        }else{
          var HF = horaFinal + ":00:00";
        }

        //no citar dias antes
        n = new Date();
        y = n.getFullYear();
        m = n.getMonth() + 1;
        d = n.getDate();

        if(m < 10){
          M = "0"+m;
          if(d < 10){
            D = 0 + d;

            diaActual = y +"-"+M+"-"+D;
          }else{
            diaActual = y +"-"+M+"-"+d;
          }

        }if(diaActual <= fecha[0]){
          $('#CitaModal').modal();
        }

        $('#Fecha').val(fecha[0]);
        $('#Hora').val(hora1[0]+":00:00");
        $('#FyHinicio').val(fecha[0]+" "+hora1[0]+":00:00");
        $('#FyHfinal').val(fecha[0]+" "+HF);

      },

      eventClick:function(calEvent,jsEvent, view){


        if("{{ auth()->user()->rol }}" == "Doctor"){

          $('#EventoModal').modal();


        }


          $('#paciente').html(calEvent.title);
      
      
        }

    });
</script>
@endif

</body>
</html>
