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

<script type="text/javascript">
  var date = new Date();
  var d = date.getDate(),
      m = date.getMonth(),
      a = date.getFullYear()

  $('#calendario').fullCalendar(
    {
      defaultView: 'agendaWeek',
    // ocultar dias en el calendario
      hiddenDays: [0,6],

      //horarios
      scrollTime: "08:00",
      minTime: "08:00",
      maxTime: "16:00"

    }
  );
</script>

</body>
</html>
