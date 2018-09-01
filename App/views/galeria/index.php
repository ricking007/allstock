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
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        
        <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Lista de Galerias</h3>
                  <div class="box-tools">
                    <div class="input-group pull-right">
                        <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#criar-galeria" title="Nova Galeria de fotos">
                            <i class="fa fa-plus"></i> 
                            Nova
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
                            <th class="text-center">Qtd. Fotos</th>
                            <th width="80"></th>
                        </tr>
                      </thead>
                    <tbody>
                        <?php 
                        if(!empty($this->galerias)){
                            foreach ($this->galerias as $c){
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $c['id_album'] ?></td>
                            <td><?php echo $c['no_album'] ?></td>
                            <td class="text-center"><?php echo $c['qtd_fotos'] ?></td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="galeria/editar/<?php echo $c['id_album'] ?>" class="btn btn-default btn-xs" title="Editar">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="#" class="btn btn-default btn-xs btn-del" data-galeria="<?php echo $c['id_album'] ?>" title="Excluir">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </div>
                             </td>
                        </tr>
                        <?php 
                            }
                        } else {
                        ?>
                        <tr>
                            <td colspan="4" class="text-center">Nenhuma galeria cadastrada</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                    <!--
                    <ul class="pagination pagination-sm no-margin">
                      <li><a href="#">«</a></li>
                      <li><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">»</a></li>
                    </ul>
                    -->
                </div>
              </div><!-- /.box -->
            </div>
        <div class="modal fade" id="criar-galeria">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <form method="post" action="galeria/criar/">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Nova Galeria de Fotos</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nome"></label>
                                <input type="text" name="nome" class="form-control" required placeholder="Informe o título da galeria" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Continuar</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </section><!-- /.content -->
</aside>