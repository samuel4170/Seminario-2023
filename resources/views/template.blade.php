<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CITAGRO DEMO</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="http://localhost/citagro_demo/public/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome (necesary to be able to use icons with "i" tags and its classes) -->
    <link rel="stylesheet" href="http://localhost/citagro_demo/public/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="http://localhost/citagro_demo/public/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="http://localhost/citagro_demo/public/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="http://localhost/citagro_demo/public/dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="http://localhost/citagro_demo/public/bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="http://localhost/citagro_demo/public/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="http://localhost/citagro_demo/public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="http://localhost/citagro_demo/public/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    {{-- DataTables --}}
    <link rel="stylesheet" href="http://localhost/citagro_demo/public/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="http://localhost/citagro_demo/public/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        select:hover{
            cursor: pointer;
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini login-page">
    <div class="wrapper">
    </div>
    <!-- ./wrapper -->
    @if(Auth::user())
        @include('modules.header')
        @if (auth()->user()->role == "Secretaria")
            @include('modules.SecretaryMenu')
        @endif
        @yield('content-logged-in')
    @else
        @yield('content')
    @endif
    <!-- jQuery 3 -->
    <script src="http://localhost/citagro_demo/public/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="http://localhost/citagro_demo/public/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="http://localhost/citagro_demo/public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="http://localhost/citagro_demo/public/bower_components/raphael/raphael.min.js"></script>
    <script src="http://localhost/citagro_demo/public/bower_components/morris.js/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="http://localhost/citagro_demo/public/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="http://localhost/citagro_demo/public/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="http://localhost/citagro_demo/public/bower_components/moment/min/moment.min.js"></script>
    <script src="http://localhost/citagro_demo/public/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="http://localhost/citagro_demo/public/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- Slimscroll -->
    <script src="http://localhost/citagro_demo/public/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="http://localhost/citagro_demo/public/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="http://localhost/citagro_demo/public/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="http://localhost/citagro_demo/public/dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="http://localhost/citagro_demo/public/dist/js/demo.js"></script>
    {{-- DataTables --}}
    <script src="http://localhost/citagro_demo/public/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="http://localhost/citagro_demo/public/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="http://localhost/citagro_demo/public/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
    <script>
        $(".table").DataTable({
            "language":{
                "sSearch": "Buscar:",
                "sEmptyTable": "No hay datos en la Tabla",
                "sZeroRecrods": "No se encontraron resultados",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
                "sInfoFiltered": "(filtrando de un total de _MAX_ registros)",
                "oPaginate":{
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "sLoadingRecords": "Cargando...",
                "sLengthMenu": "Mostrar _MENU_ registros"
            }
        });
    </script>
    {{-- SWEET ALERT 2 --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    {{-- Mensaje de operaciones de @registro exitosas --}}
    @if(session('registered_successfully'))
        <script>
            Swal.fire(
                '¡Excelente!',
                'Los datos han sido REGISTRADOS correctamente',
                'success'
            )
        </script>
    @endif
    {{-- Mensaje de operaciones de @eliminacion exitosa --}}
    @if(session('delete_successfully'))
        <script>
            Swal.fire(
                '¡Excelente!',
                'Los datos han sido ELIMINADOS correctamente',
                'success'
            )
        </script>
    @endif
    {{-- Mensaje de operaciones de @elimiacion fallida --}}
    @if(session('delete_unsuccessfully'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No fue posible ELIMINAR este registro.'
            })
        </script>
    @endif
    {{-- Mensaje de operaciones de @actualizacion exitosa --}}
    @if(session('update_successfully'))
        <script>
            Swal.fire(
                '¡Excelente!',
                'Los datos han sido ACTUALIZADOS correctamente',
                'success'
            )
        </script>
    @endif
    <script>
        //Template para mensajes de eliminar registros
        function templateConfirmDeleteMessage($path){
            Swal.fire({
                title: '¿Deseas eliminar el registro?',
                text: 'Esto podría causar daños en el sistema y pérdida de algunos datos.',
                icon: 'warning',
                showDenyButton: true,
                denyButtonText: 'Cancelar',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar'
            }).then((result)=>{
                if(result.isConfirmed){
                    window.location = $path;
                }else if(result.isDenied){
                    Swal.fire({
                        text: 'NO se ha eliminado el registro.',
                        icon: 'info',
                        confirmButtonText: 'De acuerdo'
                    });
                }
            })
        }
        //Ventana interactiva para eliminar registros de @doctor
        $('.table').on('click', '.deleteDoctorBtn', function(){
            // Esta funcion recibe una ruta y el id del registro del boton que fue clickeado para confirmar la eliminacion
            templateConfirmDeleteMessage("Delete-Doctor/" + $(this).attr('DoctorId'));
        })
        //Ventana interactiva para eliminar registros de @especies
        $('.table').on('click', '.btn-delete-specie', function(){
            // Esta funcion recibe una ruta y el id del registro del boton que fue clickeado para confirmar la eliminacion
            templateConfirmDeleteMessage("Delete-Specie/" + $(this).attr('SpecieId'));
        })
        // Ventana interactiva para eliminar registro de @razas
        $('.table').on('click', '.btn-delete-breed', function(){
            // Esta funcion recibe una ruta y el id del registro del boton que fue clickeado para confirmar la eliminacion
            templateConfirmDeleteMessage("Delete-Breed/" + $(this).attr('BreedId'));
        })
        // Ventana interactiva para eliminar registro de @colores
        $('.table').on('click', '.btn-delete-color', function(){
            // Esta funcion recibe una ruta y el id del registro del boton que fue clickeado para confirmar la eliminacion
            templateConfirmDeleteMessage("Delete-Color/" + $(this).attr('ColorId'));
        })
    </script>

    {{-- Se desmenuza la url gestionada por $_SEVER para validar las peticiones de edicion --}}
    <?php
        $exp = explode('/', $_SERVER['REQUEST_URI']);
    ?>

    {{--    Cuando la URL tenga "Edit-Specie", hay intencion de edicion, se muestra el modal con los datos basados en el ID --}}
    {{-- Modal con los datos actuales basados en el ID @Specie --}}
    @if($exp[3] == 'Edit-Specie')
        <script type="text/javascript">
            $(document).ready(()=>{
                $('#edit-modal-specie').modal('toggle');
            })
        </script>
    @endif
    {{-- Es necesario @volver_atras, si el usuario abre la ventana de edicion pero no edita el registro como tal --}}
    <script>
        $('#edit-modal-specie').on('hidden.bs.modal', function (e) {
            history.back();
        });
    </script>

    {{-- Cuando la URL tenga "Edit-Breed", hay intencion de edicion  --}}
    {{-- Se muestra el Modal con los datos actuales basados en el ID @Breed --}}
    @if($exp[3] == 'Edit-Breed')
        <script type="text/javascript">
            $(document).ready(()=>{
                $('#edit-modal-breed').modal('toggle');
            })
        </script>
    @endif
    {{-- Es necesario @volver_atras, si el usuario abre la ventana de edicion pero no edita el registro como tal --}}
    <script>
        $('#edit-modal-breed').on('hidden.bs.modal', function (e) {
            history.back();
        });
    </script>

    {{-- Cuando la URL tenga "Edit-Color", hay intencion de edicion  --}}
    {{-- Se muestra el Modal con los datos actuales basados en el ID @Color --}}
    @if($exp[3] == 'Edit-Color')
        <script type="text/javascript">
            $(document).ready(()=>{
                $('#edit-modal-color').modal('toggle');
            })
        </script>
    @endif
    {{-- Es necesario @volver_atras, si el usuario abre la ventana de edicion pero no edita el registro como tal --}}
    <script>
        $('#edit-modal-color').on('hidden.bs.modal', function (e) {
            history.back();
        });
    </script>

</body>

</html>
