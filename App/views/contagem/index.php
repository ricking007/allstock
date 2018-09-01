<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Contagens
            <small>Minhas contagens de Estoque</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="contagem">Contagem</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Ultimas Contagens</h3>
                    <div class="box-tools">
                        <!--                    <div class="input-group pull-right">
                                                <a href="categoria/form" class="btn btn-primary btn-xs" title="Cadastrar Categoria">
                                                    <i class="fa fa-plus"></i> 
                                                    Nova
                                                </a>
                                            </div>-->
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-hover table-list" 
                           data-total="<?php echo!empty($this->total) ? $this->total : 0; ?>"
                           data-pagesize="<?php echo NUM_ITENS_GRID ?>">
                        <thead>
                            <tr>
                                <th class="text-center">Cod.</th>
                                <th>Data</th>
                                <th>Status</th>
                                <th width="80"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($this->contagens)) {
                                foreach ($this->contagens as $c) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $c['id_contagem'] ?></td>
                                        <td><?php echo $c['dt_data'] ?></td>
                                        <td><?php echo $c['no_status'] ?></td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="contagem/view/<?php echo $c['id_contagem'] ?>" class="btn btn-default btn-xs" title="Ver Contagem">
                                                    <i class="fa fa-bar-chart" aria-hidden="true"></i> Analisar
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="5" class="text-center">Nenhuma contagem feita ultimamente</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                </div>
            </div><!-- /.box -->
        </div>
    </section><!-- /.content -->
</aside>