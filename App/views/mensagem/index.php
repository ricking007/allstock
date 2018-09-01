<?php
if (isset($this->msg) && is_array($this->msg)) {
    $aclass = array('danger','info','warning','success');
?>
    <div class="alert alert-<?php echo in_array($this->msg['class'],$aclass) ? $this->msg['class'] : 'danger' ?> alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Fechar</span></button>
        <?php echo $this->msg['msg'] ?>
    </div>
<?php 
    
}
