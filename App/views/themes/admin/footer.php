</div><!-- ./wrapper -->

<!-- JavaScript -->
<script src="js/default/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="js/default/app.js"></script>
<script src="js/default/ga.js"></script>


<?php 
if(isset($this->js) && is_array($this->js)){
    foreach ($this->js as $js){
        echo '<script src="'.$js.'"></script>'.PHP_EOL;
    }
}
?>

            
</body>

</html>