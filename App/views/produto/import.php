<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Produtos
            <small>Importação de produtos</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="produto">Produtos</a></li>
            <li><a href="produto/import/">Importação</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <form method="post" id="form-import" enctype="multipart/form-data" method="post">
        <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Importação de Produtos</h3>
                </div><!-- /.box-header -->
                <div class="box-body ">
                    
                    <h3>SELECIONE O ARQUIVO</h3>
                    
                    <div class="form-group">
                        <label for="arquivo">Arquivo <small class="text-danger">(Somente txt separado por ponto vírgula ";")</small></label>
                        <input type="file" name="arquivo" id="arquivo" class="form-control" />
                    </div>
                    <div class="form-group">
                        <div class="progress">
                            <div id="progresso" class="progress-bar progress-bar-striped progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                        </div>
                    </div>
                    <div class="form-group ajax-response">
                    </div>
                            
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="produto" title="Cancelar" class="btn btn-default">Voltar</a>
                    <button type="submit" class="btn btn-primary btn-action-ajax" name="salvar" value="1"> 
                        Importar
                    </button>
                </div>
              </div><!-- /.box -->
            </div>
            <div class="col-xs-12 hidden" id="report-import">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Relatório da Importação</h3>
                </div><!-- /.box-header -->
                <div class="box-body ">
                    <table class="table table-condensed table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Cod.</th>
                                <th>Descrição</th>
                                <th>Dist.</th>
                                <th>Preço</th>
                                <th>Qtd.Est.</th>
                                <th>Marca</th>
                                <th>Apl.</th>
                                <th>Emb.</th>
                                <th>Qtd.Emb.</th>
                                <th>Msg</th>
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
        </form>
        <div class="modal fade" id="modal-alert" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <p></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="modal fade" id="modal-add-opt" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" id="opt-add" class="form-control" placeholder="Informe o nome" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary " id="btn-save-opt">Salvar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="modal fade" id="modal-add-img" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
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