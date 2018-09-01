<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Marcas
            <small>Manutenção e cadastro de Marcas</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="marca">Marcas</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        
        <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Lista de Marcas</h3>
                  <div class="box-tools">
                    <div class="input-group pull-right">
                        <a href="marca/form" class="btn btn-primary btn-xs" title="Cadastrar Marca">
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
                            <th width="80"></th>
                        </tr>
                      </thead>
                    <tbody>
                        <?php 
                        if(!empty($this->marcas)){
                            foreach ($this->marcas as $m){
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $m['id_marca'] ?></td>
                            <td><?php echo $m['no_marca'] ?></td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="marca/form/<?php echo $m['id_marca'] ?>" class="btn btn-default btn-xs" title="Editar">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="#" class="btn btn-default btn-xs btn-del" data-marca="<?php echo $m['id_marca'] ?>" title="Excluir">
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
                            <td colspan="5" class="text-center">Nenhuma Marca cadastrada</td>
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
        
    </section><!-- /.content -->
</aside>