<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Notificações
            <small>Suas Mensagens e Lembretes</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="product">Notificações</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        
        <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Lista de Notificações</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover table-list">
                      <thead>
                        <tr>
                            <th class="text-center">Cod.</th>
                            <th>Assunto</th>
                            <th>Data</th>
                            <th>Concluída</th>
                            <th width="80"></th>
                        </tr>
                      </thead>
                    <tbody>
                        <?php 
                        if(!empty($this->notificacoes)){
                            foreach ($this->notificacoes as $n){
                        ?>
                        <tr class="<?php echo $n['id_status'] == 1 ? 'text-bold' : ''?>">
                            <td class="text-center"><?php echo $n['id_notificacao'] ?></td>
                            <td><?php echo $n['dc_titulo'] ?></td>
                            <td><?php echo $n['dt_notificacao'] ?></td>
                            <td><?php echo $n['dt_leitura'] ?></td>
                            
                          <!--<td><span class="label label-success">Ativo</span></td>-->
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="notification/read/<?php echo $n['id_notificacao'] ?>" class="btn btn-default btn-xs" title="Ver">
                                        <i class="fa fa-search"></i>
                                    </a>
                                    <?php if(file_exists(DIR_XML.$n['id_pedido'].'.xml')) { ?>
                                    <a href="notification/download/<?php echo $n['id_pedido'] ?>" class="btn btn-default btn-xs" title="Baixar Arquivo">
                                        <i class="fa fa-file-excel-o"></i>
                                    </a>
                                    <?php } ?>
                                </div>
                             </td>
                        </tr>
                        <?php 
                            }
                        } else {
                        ?>
                        <tr>
                            <td colspan="5" class="text-center">Nenhuma notificação no momento</td>
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