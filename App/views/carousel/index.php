<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Slides
            <small>Manutenção e cadastro de imagens no carrosel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="carousel">Carousel</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        
        <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Carrosel</h3>
                  <div class="box-tools">
                    <div class="input-group pull-right">
                        <a href="#" data-toggle="modal" data-target="#modal-add-img" class="btn btn-primary btn-xs" title="Cadastrar Categoria">
                            <i class="fa fa-plus"></i> 
                            Nova imagem
                        </a>
                    </div>
                      
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                    <?php if(!empty($this->carousel)) {?>
                    <div id="carousel-promo" class="carousel slide carousel-fade" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <?php for($i = 0; $i < sizeof($this->carousel); $i++){?>
                                <li data-target="#carousel-promo" data-slide-to="<?php echo $i ?>" 
                                    class="<?php echo $i == 0 ? 'active' : '' ?>"></li>
                            <?php } ?>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <?php 
                            foreach ($this->carousel as $k => $c){
                                $img = "img/carousel/{$c['id_carousel']}.{$c['dc_imagem']}";
                            ?>
                            <div class="item <?php echo $k == 0 ? 'active' : '' ?>">
                                <img src="<?php echo $img ?>" alt="slide">
                                
                                <div class="carousel-caption animated fadeInUp">
                                    <?php echo $c['dc_caption']?>
                                    <p>
                                    <button class="btn btn-default btn-edit-caption" data-toggle="modal" 
                                            data-target="#modal-edit-caption" data-caption="<?php echo $c['id_carousel']?>">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <button class="btn btn-danger btn-del-img" 
                                            data-img="<?php echo $c['id_carousel'].'.'.$c['dc_imagem']; ?>">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    </p>
                                </div>
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
                    <?php } else { echo '<p class="text-center"> Nenhuma imagem no carrosel</p>';}?>
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                   
                </div>
              </div><!-- /.box -->
        </div>
        <div class="modal fade modal-fullscreen force-fullscreen" id="modal-add-img" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="form-add-img">
                        <div class="modal-body">
                            <div class="image-editor">
                                <input type="file" class="cropit-image-input hidden" accept="image/*"/>
                                <div class="cropit-image-preview carousel-crop"></div>
                                <div class="image-size-label">
                                    <i class="fa fa-picture-o "></i>
                                    <input type="range" class="cropit-image-zoom-input">
                                    <i class="fa fa-picture-o fa-2x"></i>
                                </div>
                                <input type="hidden" name="image-data" class="hidden-image-data" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-select-img btn-xs">
                                <i class="fa fa-picture-o"></i> SELECIONAR IMAGEM
                            </button>
                            <button type="button" class="btn btn-default btn-xs" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary btn-xs btn-action-ajax">Salvar</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
        <div class="modal fade" id="modal-edit-caption" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="form-edit-caption" method="post" action="carousel/edit">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Editar Configurações do Slide</h4>
                        </div>
                        <div class="modal-body">
                                
                            <div class="form-group">
                                <input type="hidden" name="id_carousel_edit" id="id_carousel_edit" />
                                <label for="caption">Caption</label>
                                <textarea name="caption" id="caption" rows="4" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="link">Link</label>
                                <input type="text" name="link" id="link" class="form-control" placeholder="Digite o link completo, exemplo: http://www.jsatacado.com.br" />
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary btn-action-ajax">Salvar</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
    </section><!-- /.content -->
</aside>