<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Galerias
            <small>Manutenção e cadastro de galeria de fotos</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="galeria">Galerias</a></li>
            <li><a href="galeria/editar/<?php echo !empty($this->album) ? $this->album['id_album'] : '' ?>">Editar</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        
        <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <div class="box-title">
                        <input type="text" class="form-control gal-title" 
                               value="<?php echo !empty($this->album) ? $this->album['no_album'] : '' ?>" 
                               placeholder="Digite o título da galeria" />
                    </div>
                  <div class="box-tools">
                    <div class="input-group pull-right">
                        <button href="#" class="btn btn-primary btn-xs" id="bt-add" title="Adicionar Fotos">
                            <i class="fa fa-plus"></i> 
                            Adicionar Fotos
                        </button>
                    </div>
                      
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="progress">
                        <div id="progresso" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0"
                        aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                    </div>
                    <form enctype="multipart/form-data" id="form-fotos" 
                          data-album="<?php echo !empty($this->album) ? $this->album['id_album'] : '' ?>">
                        <input type="file" name="imagem" id="imagem" class="hidden" accept="image/*" multiple />
                        <div class="row" id="fotos-galeria">
                            <?php 
                            if(!empty($this->fotos)) { 
                                foreach ($this->fotos as $f){
                                    $nome = $f['id_foto'] . '.'.$f['dc_extensao'];
                                    $foto = "img/albuns/{$f['id_album']}/thumb/$nome";
                            ?>
                            <div class="col-md-3 col-sm-6">
                                <div class="thumbnail <?php echo $f['id_capa'] ? 'active' : '' ?>">
                                    <img src="<?php echo file_exists($foto) ? $foto : 'img/albuns/img-not-found.jpg'  ?>" class="img-responsive" />
                                    <div class="caption text-center">
                                        <button type="button" class="btn btn-default btn-xs bt-capa-img" data-img="<?php echo $nome ?>">
                                            <i class="fa fa-picture-o"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-xs bt-del-img" data-img="<?php echo $nome ?>">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
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
                    </form>
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="galeria" class="btn btn-default">Voltar</a>
                </div>
              </div><!-- /.box -->
        </div>
    </section><!-- /.content -->
</aside>