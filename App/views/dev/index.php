<div id="main">
    <section id="carousel-banner">
        <div class="container">
                <?php if (!empty($this->carousel)) { ?>
                <div id="carousel-promo" class="carousel slide carousel-fade" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <?php for ($i = 0; $i < sizeof($this->carousel); $i++) { ?>
                            <li data-target="#carousel-promo" data-slide-to="<?php echo $i ?>" 
                                class="<?php echo $i == 0 ? 'active' : '' ?>"></li>
                            <?php } ?>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <?php
                        foreach ($this->carousel as $k => $c) {
                            $img = "img/carousel/{$c['id_carousel']}.{$c['dc_imagem']}";
                            ?>
                            <div class="item <?php echo $k == 0 ? 'active' : '' ?>">
                            <?php if(!empty($c['dc_link'])) { ?>
                                <a href="<?php echo $c['dc_link'] ?>" target="_blank" title="<?php echo $c['dc_link'] ?>">
                            <?php }?>
                                <img src="<?php echo $img ?>" alt="slide">
                                <div class="carousel-caption animated fadeInUp">
                                    <?php echo $c['dc_caption'] ?>
                                </div>
                            <?php if(!empty($c['dc_link'])) { ?>
                                </a>
                            <?php }?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-promo" role="button" data-slide="prev">
                        <span class="icon-prev fa fa-angle-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-promo" role="button" data-slide="next">
                        <span class="icon-next fa fa-angle-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div><!--/.carousel-->
            <?php } ?>
        </div>
    </section>
    <section id="produtos" class="bg-light-gray">
        <div class="container">
            <h2 class="heading">
                <span class="text-uppercase">EM DESTAQUE</span>
            </h2>
            <div class="row">
                <?php 
                if(!empty($this->promocoes)){
                    foreach ($this->promocoes as $p){
                        $img = file_exists("img/produtos/{$p['foto']}") && !empty($p['foto']) ? "img/produtos/{$p['foto']}" : "img/produtos/img-not-found.jpg";
                        $valor = explode('.',$p['nm_valor_venda']);
                ?>
                <div class="col-md-3 col-sm-6">
                    <a href="produtos/detalhe/<?php echo $p['id_produto'] . '/'.$this->urlEncode($p['dc_produto']) ?>" class="thumbnail wrapper" title="<?php echo $p['dc_produto'] ?>">
                        <div class="ribbon"><span>PROMOÇÃO</span></div>
                        <div class="product-img">
                            <img src="<?php echo $img;?>" class="img-responsive" />
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
                <?php }

                } else {
                ?>
                <div class="col-md-12">
                    <h3>
                        Nenhum produto em destaque no momento
                        <small><a href="produtos">Visite a seção de produtos</a></small>
                    </h3>
                </div>
                <?php } ?>
            </div><!--/.row-->
        </div>
        
    </section>
</div>
