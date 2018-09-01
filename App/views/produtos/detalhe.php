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
                    <?php if(!empty($this->produto)){
                        $img = file_exists("img/produtos/{$this->produto['foto']}") && !empty($this->produto['foto']) ? "img/produtos/{$this->produto['foto']}" : "img/produtos/img-not-found.jpg";
                        $valor = str_replace('.',',', $this->produto['nm_valor_venda']);
                    ?>
                    <h3 class="heading">
                        <span>
                        <?php 
                            $noProduto = !empty($this->produto['cd_produto_cliente']) ? $this->produto['cd_produto_cliente'] . ' - ' : '';
                            $noProduto .= $this->produto['dc_produto'];
                            $noProduto .= !empty($this->produto['no_embalagem']) && !empty($this->produto['qt_embalagem']) ? ' '.$this->produto['no_embalagem']. ' C/ '.$this->produto['qt_embalagem'] : '';
                            echo $noProduto;
                        ?>
                        </span>
                    </h3>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="thumbnail img-block">
                                
                                <img src="<?php echo $img; ?>" class="img-responsive" />
                            </div>
                            <ul class="list-inline gridmin">
                                <?php 
                                if(!empty($this->fotos)) {
                                    foreach ($this->fotos as $f){
                                        $img = file_exists("img/produtos/{$f['id_foto']}.{$f['dc_extensao']}") ? "img/produtos/{$f['id_foto']}.{$f['dc_extensao']}" : "img/produtos/img-not-found.jpg";
                                ?>
                                
                                <li>
                                    <a href="#" class="thumbnail" title="Produto">
                                        <img src="<?php echo $img ?>" class="img-responsive" />
                                    </a>
                                </li>
                                
                                <?php 
                                    }
                                }?>
                            </ul>
                        </div>
                        <div class="col-sm-6 bg-light-gray product-detail">
                            <?php if($this->produto['id_promocao']) {?>
                                    <div class="ribbon"><span>PROMOÇÃO</span></div>
                            <?php } ?>
                                    
                            <?php if($this->produto['nm_estoque'] > 0) {?>
                                    
                            <h2>R$ <?php echo $valor ?></h2>
                            <p>
                                <?php if($this->produto['qt_embalagem'] > 1) { 
                                    echo 'A unidade sai por R$ '. $this->formatValor($this->produto['nm_valor_venda'] / $this->produto['qt_embalagem']); 
                                } ?>
                            </p>
                            <?php } else {?>
                            <h2>PRODUTO INDISPONÍVEL</h2>
                            <?php } ?>
                            
                            <?php if($this->produto['id_promocao']) { ?>
                            <p class="text-uppercase text-danger">
                                Promoção válida até <?php echo $this->produto['dt_exp_promocao'] ?> ou enquanto durarem os estoques
                            </p>
                            <?php } ?>
                            <h3 class="heading">DESCRIÇÃO</h3>
                            <div>
                                <?php 
                                echo $this->produto['dc_descricao'];
                                ?>
                            </div>
                        </div>
                    </div> <!--/.row-->
                    <?php } else { ?>
                    <h3 class="text-muted">PRODUTO NÃO ENCONTRADO</h3>
                    <?php } ?>
                </div>
            </div>
            
        </div> <!--/.container-->
    </section>
</div>