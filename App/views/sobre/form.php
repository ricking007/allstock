<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sobre
            <small>Manutenção de texto sobre a empresa</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="sobre">Sobre</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <form method="post" id="form-sobre">
        <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Edição de texto</h3>
                </div><!-- /.box-header -->
                <div class="box-body ">
                        <fieldset>
                            <legend class="text-center">Sobre</legend>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <textarea name="sobre" id="sobre"><?php 
                                    echo !empty($this->sobre) ? $this->sobre : '';
                                    ?></textarea>
                                </div>
                            </div>
                            
                        </fieldset>
                        
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
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