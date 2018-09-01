<div id="main">
    <section id="page-galeria">
        <div class="container">
            <div class="row" id="fotos-galeria">
                <?php 
                if(!empty($this->fotos)) {
                ?>
                <h2 class="heading">
                    <span class="text-uppercase"><?php echo $this->fotos[0]['no_album']; ?></span>
                </h2>
                <?php
                    foreach ($this->fotos as $f){
                        $nome = $f['id_foto'] . '.'.$f['dc_extensao'];
                        $foto = "img/albuns/{$f['id_album']}/thumb/$nome";
                        $href = "img/albuns/{$f['id_album']}/$nome";
                ?>
                <div class="col-md-3 col-sm-6">
                    <a class="thumbnail fancybox" href="<?php echo $href ?>" data-fancybox-group="gallery">
                        <img src="<?php echo file_exists($foto) ? $foto : 'img/albuns/img-not-found.jpg'  ?>" class="img-responsive" />
                    </a>
                </div>
                <?php
                    } 

                } else {
                ?>
                <div class="col-md-12 empty-album">
                    <h4>Nenhuma foto na galeria</h4>
                </div>
                <?php }?>
            </div>
            
        </div> <!--/.container-->
    </section>
</div>