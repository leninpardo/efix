<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Reporte grafico</title>

        <script type="text/javascript" src="js/jquery-2.0.2.min.js"></script>
        
        <script type="text/javascript">
            $(function() {
                {{JSGRAFICO}}
            });
        </script>
    </head>
    <body>
        <script src="<?php echo URL::asset('js/highcharts/highcharts.js'); ?>"></script>
        <script src="<?php echo URL::asset('js/highcharts/modules/exporting.js'); ?>"></script>

        <div id="container" style="min-width: 310px; height: 380px; margin: 0 auto">
            jj
        </div>

    </body>
</html>
