<?php
if (!empty($this->produtos)) {
    foreach ($this->produtos as $p) {
        $img = file_exists("img/produtos/{$p['foto']}") && !empty($p['foto']) ? "img/produtos/{$p['foto']}" : "img/produtos/img-not-found.jpg";
        $valor = explode('.', $p['nm_valor_venda']);
        ?>
        <div class="col-md-4 col-sm-6 animated fadeIn">
            <a href="produtos/detalhe/<?php echo $p['id_produto'] . '/' . $this->urlEncode($p['dc_produto']) ?>" class="thumbnail wrapper" title="<?php echo $p['dc_produto'] ?>">
                <?php if ($p['id_promocao']) { ?>
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
                        $noProduto .=!empty($p['no_embalagem']) && !empty($p['qt_embalagem']) ? ' ' . $p['no_embalagem'] . ' C/ ' . $p['qt_embalagem'] : '';
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
}
                        