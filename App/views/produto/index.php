<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Produtos
            <small>Manutenção e cadastro de produtos</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="product">Produtos</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        
        <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Lista de Produtos</h3>
                  <div class="box-tools">
                    <div class="input-group pull-right">
                        <a href="produto/form" class="btn btn-primary btn-xs" title="Cadastrar Produto">
                            <i class="fa fa-plus"></i> 
                            Novo
                        </a>
                        &nbsp;
                        <a href="produto/import" class="btn btn-primary btn-xs" title="Importar Produtos">
                            <i class="fa fa-cloud"></i> 
                            Importar
                        </a>
                    </div>
                      
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-hover table-list" 
                         data-total="<?php echo !empty($this->total) ? $this->total : 0; ?>"
                         data-pagesize="<?php echo NUM_ITENS_GRID ?>">
                      <thead>
                        <tr>
                            <th class="text-center">Cod.</th>
                            <th>Nome</th>
                            <th>Marca</th>
                            <th>Categoria</th>
                            <th width="80">Promo.</th>
                            <th width="50" class="text-center">Disp.</th>
                            <th class="text-center">Valor</th>
                            <th><i class="fa fa-picture-o"></i></th>
                            <th width="50"></th>
                        </tr>
                      </thead>
                    <tbody>
                   
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                    
                </div>
              </div><!-- /.box -->
            </div>
          <div class="modal fade" id="modal-add-img" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <input type="hidden" id="id-produto" name="id_produto" value=""/>
                    <form id="form-add-img">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Adicionar Imagem</h4>
                        </div>
                        <div class="modal-body">
                            <div class="image-editor">
                                
                                <input type="file" class="cropit-image-input hidden" accept="image/*"/>
                                <p class="text-center">
                                    <button type="button" class="btn btn-primary btn-select-img">
                                        <i class="fa fa-picture-o"></i> SELECIONAR IMAGEM
                                    </button>
                                </p>
                                <div class="cropit-image-preview"></div>
                                <div class="image-size-label">
                                    <i class="fa fa-picture-o "></i>
                                    <input type="range" class="cropit-image-zoom-input">
                                    <i class="fa fa-picture-o fa-2x"></i>
                                </div>
                                <input type="hidden" name="image-data" class="hidden-image-data" />
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