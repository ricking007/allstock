<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Embalagem
            <small>Manutenção e cadastro de embalagens</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="embalagem">Marcas</a></li>
            <li><a href="embalagem/form/<?php echo !empty($this->embalagem) ? $this->embalagem['id_embalagem'] : '' ?>">Cadastro</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <form method="post" id="form-embalagem">
        <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Cadastro</h3>
                </div><!-- /.box-header -->
                <div class="box-body ">
                        <fieldset>
                            <?php 
                            if(!empty($this->embalagem)){
                            ?>
                                <input type="hidden" id="id-embalagem" name="id" value="<?php echo $this->embalagem['id_embalagem']?>"/>
                            <?php }?>
                            <legend class="text-center">Dados da Embalagem</legend>
                            
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="nome">Nome</label>
                                    <input type="text" name="nome" id="nome" class="form-control" 
                                           value="<?php echo !empty($this->embalagem['no_embalagem']) ? $this->embalagem['no_embalagem'] : '' ?>"
                                           placeholder="Informe o nome da embalagem" />
                                </div>
                            </div>
                            
                        </fieldset>
                        
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="embalagem" title="Cancelar" class="btn btn-default">Voltar</a>
                    <button type="submit" class="btn btn-primary btn-action-ajax" name="salvar" value="1"> 
                        Salvar
                    </button> 
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
    </section><!-- /.content -->
</aside>