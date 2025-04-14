<!doctype html>
<html lang="es-MX">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Vendors Min CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/vendors.min.css'); ?>">
    <!-- Style CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/responsive.css') ?>">

    <title><?php echo $title; ?></title>

    <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/favicon.png') ?>">

    <!-- General Js -->
    <script src="<?php echo base_url('assets/js/general.js') ?>"></script>

    <!-- Vendors Min JS -->
    <script src="<?php echo base_url('assets/js/vendors.min.js') ?>"></script>

    <!-- ApexCharts JS -->
    <script src="<?php echo base_url('assets/js/apexcharts/apexcharts.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/apexcharts/apexcharts-stock-prices.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/apexcharts/apexcharts-irregular-data-series.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/dashboard.js') ?>"></script>
    <!-- <script src="<?php echo base_url('assets/js/apexcharts/apex-custom-pie-donut-chart.js') ?>"></script> -->
    <script src="<?php echo base_url('assets/js/apexcharts/apex-custom-area-charts.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/apexcharts/apex-custom-column-chart.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/apexcharts/apex-custom-bar-charts.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/apexcharts/apex-custom-mixed-charts.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/apexcharts/apex-custom-radialbar-charts.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/apexcharts/apex-custom-radar-chart.js') ?>"></script>

    <!-- ChartJS -->
    <script src="<?php echo base_url('assets/js/chartjs/chartjs.min.js') ?>"></script>
    <div class="chartjs-colors"> <!-- To use template colors with Javascript -->
        <div class="bg-primary"></div>
        <div class="bg-primary-light"></div>
        <div class="bg-secondary"></div>
        <div class="bg-info"></div>
        <div class="bg-success"></div>
        <div class="bg-success-light"></div>
        <div class="bg-danger"></div>
        <div class="bg-warning"></div>
        <div class="bg-purple"></div>
        <div class="bg-pink"></div>
    </div>

    <!-- jvectormap Min JS -->
    <script src="<?php echo base_url('assets/js/jvectormap-1.2.2.min.js') ?>"></script>
    <!-- jvectormap World Mil JS -->
    <script src="<?php echo base_url('assets/js/jvectormap-world-mill-en.js') ?>"></script>
    <!-- Custom JS -->
    <script src="<?php echo base_url('assets/js/custom.js') ?>"></script>

	<script src="<?php echo base_url('assets/js/utilidades.js') ?>"></script>

    <!-- Agrega los estilos CSS de DataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/1.0.7/css/responsive.dataTables.min.css">
	<script src="https://cdn.datatables.net/responsive/1.0.7/js/dataTables.responsive.js"></script>
	<script src="https://cdn.datatables.net/responsive/1.0.7/js/responsive.dataTables.js"></script>
	

    <!-- Agrega SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Agrega los estilos CSS de Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Autocomplete -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>

    <!-- Datepicker script -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/datepicker/bootstrap-datetimepicker.min.css') ?>">
    <script src="<?php echo base_url('assets/js/datepicker/bootstrap-datepicker.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/datepicker/locales/bootstrap-datepicker.es.js') ?>"></script>

    <style>
        /* Agregar código CSS para un loader más bonito */
        .loader {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999;
        }

        .loader:before {
            content: "";
            box-sizing: border-box;
            position: absolute;
            top: 50%;
            left: 50%;
            width: 60px;
            height: 60px;
            margin-top: -30px;
            margin-left: -30px;
            border-radius: 50%;
            border: 6px solid #3498db;
            border-top-color: transparent;
            animation: spin 1s ease-in-out infinite;
        }


        .select2-container--default .select2-selection--single {
            height: calc(2.25rem + 2px);
            /* Ajusta esto según la altura de tu input */
            border-radius: 0.25rem;
            /* Ajusta esto para que coincida con el estilo de tu input */
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            line-height: calc(2.25rem + 2px);
            /* Ajusta esto para alinear el texto dentro del select */
        }

        .select2-container .select2-selection--single .select2-selection__arrow {
            height: 100%;
            /* Asegura que la flecha esté alineada verticalmente */
            display: flex;
            align-items: center;
        }

        .input-group .input-group-text {
            display: flex;
            align-items: center;
        }

        .bx-search {
            font-size: 1rem;
            /* Ajusta el tamaño del ícono según sea necesario */
            margin-left: 5px;
            /* Ajusta el margen izquierdo para separar el ícono del texto */
        }

        /* Estilo para el input de tipo file personalizado */
        .custom-file-input {
            cursor: pointer;
        }

        /* Estilo para el botón de búsqueda */
        .input-group-append button {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        /* Estilo para la imagen de vista previa */
        #preview1 {
            max-width: 100%;
            max-height: 300px;
            display: none;
            margin-top: 10px;
        }




        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

</head>

<body>
