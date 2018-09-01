
<script src="js/jquery.min.js"></script>
<!--Angular e dependencias -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.2/angular.min.js"></script>
<script src="js/app.js"></script>
<script src="js/dirPagination.js"></script>
<script src="plugins/bootstrap/js/bootstrap.js"></script>
<script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="plugins/node-waves/waves.js"></script>
<script src="plugins/jquery-countto/jquery.countTo.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/morrisjs/morris.js"></script>
<!-- ChartJs -->
<script src="plugins/chartjs/Chart.bundle.js"></script>
<!-- Flot Charts Plugin Js -->
<script src="plugins/flot-charts/jquery.flot.js"></script>
<script src="plugins/flot-charts/jquery.flot.resize.js"></script>
<script src="plugins/flot-charts/jquery.flot.pie.js"></script>
<script src="plugins/flot-charts/jquery.flot.categories.js"></script>
<script src="plugins/flot-charts/jquery.flot.time.js"></script>
<!-- Sparkline Chart Plugin Js -->
<script src="plugins/jquery-sparkline/jquery.sparkline.js"></script>
<!-- Custom Js -->
<script src="js/admin.js"></script>
<script src="js/pages/index.js"></script>
<!-- Demo Js -->
<script src="js/demo.js"></script>

<?php
if (isset($this->js) && is_array($this->js)) {
    foreach ($this->js as $js) {
        echo '<script src="' . $js . '"></script>' . PHP_EOL;
    }
}
?>        
</body>

</html>
