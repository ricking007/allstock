<section id="bottom" class="bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-3 ">
                <div class="">
                    <h3>CONTATO</h3>
                    <address>
                        <p>Av. Cardeal Avelar Brandão Villela, 2696 - Mata Escura<br/>
                        Salvador - BA<br/>
                        CEP 41219-600</p>
                        <p>
                        Telefone: +55 (71) 3293-7300
                        </p>
                    </address>
                </div>
            </div>
            <div class="col-md-3 ">
                <div class="">
                    <h3>FUNCIONAMENTO</h3>
                    <address>
                        <p> 
                            Seg à Sex das 7:00hs às 17:00hs <br/> 
                        </p>
                    </address>
                    <h3>AVISO</h3>
                    <p><small>* IMAGENS DOS PRODUTOS MERAMENTE ILUSTRATIVAS</small></p>
                </div>
            </div>
            <div class="col-md-3 ">
                <div class="">
                    <h3>PAGUE COM</h3>
                    <ul class="list-inline gridmin">
                        <li><img src="img/flag-cc/50x25/visa.png"/></li>
                        <li><img src="img/flag-cc/50x25/mastercard.png"/></li>
                        <li><img src="img/flag-cc/50x25/diners.png"/></li>
                        <li><img src="img/flag-cc/50x25/hipercard.png"/></li>
                        <li><img src="img/flag-cc/50x25/ticket-alimentacao.png"/></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="">
                    <h3>GALERIAS</h3>
                    <div class="custom">
                        <ul class="list-inline gridmin">
                            <?php 
                            if(!empty($this->galeriasFooter)){ 
                                foreach ($this->galeriasFooter as $gf){
                                    $img = "img/albuns/{$gf['id_album']}/thumb/{$gf['foto']}";
                            ?>
                            <li>
                                <a href="galeria/exibir/<?php echo $gf['id_album'].'/'.$this->urlEncode($gf['no_album']) ?>" 
                                   title="<?php echo $gf['no_album'] ?>">
                                    <img src="<?php echo file_exists($img) && $gf['foto'] ? $img : 'img/albuns/img-not-found.jpg'; ?>"/>
                                </a>
                            </li>
                            <?php 
                                }
                            } else { 
                            ?>
                            <li>
                                Não há galerias
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!--/row-->
    </div>
</section>
<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="copyright">
                    <span class="pull-left">© <?php echo date('Y');?> JS ATACADO</span>
                    <span class="pull-right">
                        Desenvolvido por <a href="http://www.andti.com.br/" title="AndTI">AndTI</a> &
                        <a href="http://www.portalwebconexoes.com.br/" title="Portal Web Conexões">Portal Web</a>
                    </span>
                    
                </p>
            </div>
        </div><!-- .row -->
    </div><!-- .container -->
</footer>
<!-- JavaScript -->
<script src="js/default/bootstrap.min.js"></script>
<script src="js/default/typeahead.js"></script>
<script src="js/default/default.js"></script>
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
