<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Notificação
            <small>Leitura</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="notification">Notificações</a></li>
            <li><a href="notification/read/<?php echo !empty($this->notification) ? $this->notification['id_notificacao'] : ''; ?>">
                <?php echo !empty($this->notification) ? $this->notification['dc_titulo'] : ''; ?>
                </a>
            </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        
        <div class="col-xs-12">
            <div class="box">
                <?php if(!empty($this->notification)) { ?>
                <div class="box-header">
                    <h3 class="box-title"><?php echo $this->notification['dc_titulo']; ?></h3>

                </div><!-- /.box-header -->
                <div class="box-body">
                    <?php echo $this->notification['dc_mensagem']; ?>
                </div><!-- /.box-body -->
                <div class="box-footer text-center">

                </div>
                <?php } ?>
            </div><!-- /.box -->
        </div>
    </section><!-- /.content -->
</aside>