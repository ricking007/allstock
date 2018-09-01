<?php 
if(!empty($this->produto)){
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title text-uppercase">DETALHES DO PRODUTO</h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-sm-6 col-md-4 product-img">
            <img src="<?php echo $this->produto['url_img']; ?>" alt="pacoca" width="300" height="300" class="img-responsive"/>
        </div>
        <div class="col-sm-6 col-md-8">
            <h3 class="text-uppercase"><?php echo $this->produto['no_produto']; ?></h3>
            <h4><?php echo $this->produto['dc_produto']; ?></h4>
            <hr/>
            <h5>INGREDIENTES:</h5>
            <p><?php echo $this->produto['dc_ingredientes']; ?></p>
            <p><?php echo $this->produto['dc_peso']; ?></p>
            <p class="text-uppercase"><strong><?php echo $this->produto['dc_quantidade']; ?></strong></p>
            
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
</div>
<?php 
} else {
?>
<p class="loading">Produto não encontrado</p>
<?php 
}
?>