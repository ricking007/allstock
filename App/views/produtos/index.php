<div id="main">
    <section id="page-produtos">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h3 class="heading"><span>CATEGORIAS</span></h3>
                    <div class="list-group">
                        <?php 
                        if(!empty($this->categorias)){ 
                            foreach ($this->categorias as $c){
                        ?>
                        <a href="produtos/categoria/<?php echo $c['id_categoria'] . '/'. $this->urlEncode($c['no_categoria']) ?>" 
                           title="<?php echo $c['no_categoria']?>" class="list-group-item 
                           <?php echo !empty($this->categoria) && $this->categoria == $c['id_categoria'] ? 'active' : ''  ?>">
                            <?php echo $c['no_categoria']?>
                        </a>
                        <?php
                            }
                        } else { ?>
                        <a href="produtos" title="Nenhuma categoria encontrada"
                           class="list-group-item">
                            Nenhuma categoria
                        </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-9">
                    <h3 class="heading">
                        <span class="text-uppercase">
                            <?php echo !empty($this->titulo) ? $this->titulo : 'PRODUTOS' ?>
                        </span>
                    </h3>
                    <div>
                        <div class="row" id="produtos-container" data-total="<?php echo !empty($this->total) ? $this->total : 0  ?>">
                            <?php
                            if (!empty($this->produtos)) {
                                foreach ($this->produtos as $p) {
                                    $img = file_exists("img/produtos/{$p['foto']}") && !empty($p['foto']) ? "img/produtos/{$p['foto']}" : "img/produtos/img-not-found.jpg";
                                    $valor = explode('.', $p['nm_valor_venda']);
                                    ?>
                                    <div class="col-md-4 col-sm-6 animated fadeIn">
                                        <a href="produtos/detalhe/<?php echo $p['id_produto'] . '/' . $this->urlEncode($p['dc_produto']) ?>" class="thumbnail wrapper" title="<?php echo $p['dc_produto'] ?>">
                                            <?php if($p['id_promocao']) {?>
                                            <div class="ribbon"><span>PROMOÇÃO</span></div>
                                            <?php } ?>
                                            <div class="product-img">
                                                <img src="<?php echo $img; ?>" class="img-responsive" />
                                            </div>
                                            <div class="product-caption">
                                                <h3>
                                                <?php 
                                                $noProduto = !empty($p['cd_produto_cliente']) ? $p['cd_produto_cliente'] . ' - ' : '';
                                                $noProduto .= $p['dc_produto'];
                                                $noProduto .= !empty($p['no_embalagem']) && !empty($p['qt_embalagem']) ? ' '.$p['no_embalagem']. ' C/ '.$p['qt_embalagem'] : '';
                                                echo $noProduto;
                                                ?>
                                                </h3>
                                                <div class="product-price">
                                                    <?php if($p['nm_estoque'] > 0) { ?>
                                                    <h4>
                                                        <span class="symbol">R$</span>
                                                        <?php 
                                                        if(sizeof($valor) == 2){
                                                        ?>
                                                            <?php echo $valor[0]; ?><small>,<?php echo $valor[1]; ?></small>
                                                        <?php } ?>
                                                    </h4>
                                                    <span class="vl-unit">
                                                        <?php if($p['qt_embalagem'] > 1) { 
                                                        echo 'A unidade sai por R$ '. $this->formatValor($p['nm_valor_venda'] / $p['qt_embalagem']); 
                                                        } ?>
                                                    </span>
                                                    <?php } else {?>
                                                    <h4>
                                                        <span class="symbol">R$</span>
                                                        -
                                                    </h4>
                                                    <span class="vl-unit">
                                                        <span class="text-danger">PRODUTO INDISPONÍVEL</span>
                                                    </span>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php } ?>
                        </div>
                            <?php if(!empty($this->produtos) && !empty($this->total) && sizeof($this->produtos) < $this->total) { ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-lg btn-block btn-action-ajax" id="show-more">
                                        <i class="fa fa-spin fa-spinner"></i> 
                                        CARREGAR MAIS
                                    </button>
                                </div>
                            </div>
                            <?php }?>
                        <?php
                        } else {
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="text-muted">Nenhum produto encontrado!</h3>
                            </div>
                            <?php } ?>
                        </div><!--/.row-->
                    
                    </div>
                </div>
            </div>
            
        </div> <!--/.container-->
    </section>
</div>