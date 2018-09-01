</div>

<!-- JavaScript -->
<script src="js/default/jquery.min.js"></script>
<script src="js/default/bootstrap.min.js"></script>
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