<!-- jQuery -->
<script src="{{asset('vendors/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('vendors/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('vendors/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('vendors/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('vendors/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('vendors/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('vendors/plugins/jqvmap/maps/jquery.vmap.honduras.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('vendors/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('vendors/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('vendors/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('vendors/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('vendors/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('vendors/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('vendors/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes 
<script src="{{asset('vendors/dist/js/demo.js')}}"></script>-->
<!-- AdminLTE dashboard demo (This is only for demo purposes) 
<script src="{{asset('vendors/dist/js/pages/dashboard.js')}}"></script>-->
<!-- DataTables  & Plugins -->
<script src="{{asset('vendors/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('vendors/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('vendors/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('vendors/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('vendors/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('vendors/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('vendors/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('vendors/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('vendors/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- pnotify -->
<script src="{{asset('vendors/plugins/pnotify/dist/pnotify.js')}}"></script>

<script>
    var languageOptionsDatatables={

        "decimal":        "",
        "emptyTable":     "Datos no disponibles",
        "info":           "Mostrando desde _START_ a _END_ de _TOTAL_ registros",
        "infoEmpty":      "Mostrando desde 0 a 0 de 0 registros",
        "infoFiltered":   "(Filrado de _MAX_ registros totales)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "Mostrar _MENU_ registros",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search":         "Buscar:",
        "zeroRecords":    "Sin resultados",
        "paginate": {
            "first":      "Primero",
            "last":       "Ultimo",
            "next":       "Siguiente",
            "previous":   "Anterior"
        },
        "aria": {
            "sortAscending":  ": activar ordenamiento por columna ascendente",
            "sortDescending": ": activar ordenamiento por columna descendente"
        }
    }
    
    var monthNames= [
        "Enero",
        "Febreo",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre"
    ];
    var daysOfWeek= [
        "Dom",
        "Lun",
        "Mar",
        "Mie",
        "Jue",
        "Vie",
        "Sab"
    ];

    $(document).ready(function () {          
        PNotify.prototype.options.styling = "fontawesome";
    });
    
        var localeTextAgGrid= {
            page: 'Pagina',
        more: 'Mas',
        to: 'a',
        of: 'de',
        next: 'Siguiente',
        last: 'Ultimo',
        first: 'Primero',
        previous: 'Anterior',
        loadingOoo: 'Cargando...',

        // for set filter
        selectAll: 'Seleccionar Todo',
        searchOoo: 'Buscar...',
        blanks: 'En blanco',

        // for number filter and text filter
        filterOoo: 'Filtrar...',
        applyFilter: 'Aplicar Filtro...',
        equals: 'Igual',
        notEqual: 'No Igual',

        // for number filter
        lessThan: 'Menor que',
        greaterThan: 'Mayor que',
        lessThanOrEqual: 'Menor o Igual que',
        greaterThanOrEqual: 'Mayor o Igual que',
        inRange: 'En Rango',

        // for text filter
        contains: 'Contiene',
        notContains: 'No Contiene',
        startsWith: 'Inicia con',
        endsWith: 'Finaliza con',

        // filter conditions
        andCondition: 'Y',
        orCondition: 'O',
        };



    $('[data-toggle="tooltip"]').tooltip(); 
    </script>
    