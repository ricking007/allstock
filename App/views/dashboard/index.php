<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Painel de Controle</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            <?php echo!empty($this->Produtos) ? $this->Produtos : '0'; ?>
                        <!--<sup style="font-size: 20px">%</sup>-->
                        </h3>
                        <p>
                            PRODUTOS
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cube"></i>
                    </div>
                    <a href="produto" class="small-box-footer">
                        Mais info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php echo!empty($this->Galeria) ? $this->Galeria : '0'; ?>
                        </h3>
                        <p>
                            <?php echo empty($this->Galeria) || $this->Galeria != 1 ? 'CONTAGENS' : 'CONTAGEM' ?>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cubes" aria-hidden="true"></i>
                    </div>
                    <a href="galeria/" class="small-box-footer">
                        Mais info <i class="fa fa-arrow-circle-o-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>
                            <?php echo!empty($this->Carousel) ? $this->Carousel : '0'; ?>
                        </h3>
                        <p>
                            <?php echo empty($this->Carousel) || $this->Carousel != 1 ? 'SLIDES' : 'SLIDES'; ?>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-newspaper-o"></i>
                    </div>
                    <a href="carousel/" class="small-box-footer">
                        Mais info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>
                            <?php echo!empty($this->Categoria) ? $this->Categoria : '0'; ?>
                        </h3>
                        <p>
                            <?php echo empty($this->Categoria) || $this->Categoria != 1 ? 'CATEGORIAS' : 'CATEGORIA'; ?>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-thumbs-o-up"></i>
                    </div>
                    <a href="categoria" class="small-box-footer">
                        Mais info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 history-invoice">                            
                <!-- Custom tabs (Charts with tabs)-->
                <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right">
                        <li class="active"><a href="#revenue-chart" data-toggle="tab">MARCAS</a></li>
                        <!--<li><a href="#sales-chart" data-toggle="tab">Tipo</a></li>-->
                        <li class="pull-left header"><i class="fa fa-history"></i> PRODUTOS EM PROMOÇÃO</li>
                    </ul>
                    <div class="tab-content no-padding">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane active text-center" style="position: relative; padding: 20px;">
                            <div class="" style="padding: 5px;">
                                <canvas id="line-chart"></canvas>    
                            </div>

                        </div>
                        <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
                    </div>
                </div><!-- /.nav-tabs-custom -->

            </section><!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5"> 

                <!-- solid sales graph -->
                <div class="box box-solid bg-light-gray">
                    <div class="box-header bg-teal">
                        <i class="fa fa-th"></i>
                        <h3 class="box-title">CATEGORIA EM PROMOÇÃO</h3>
                        <div class="box-tools pull-right">
                            <button class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn bg-teal btn-sm bt-remove-pie" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body border-radius-none text-center">
                        <div id="canvas-holder">
                            <canvas id="chart-area" height="300"/>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer no-border bg-light-gray">

                    </div><!-- /.box-footer -->
                </div><!-- /.box -->                            

            </section><!-- right col -->
        </div><!-- /.row (main row) -->

    </section><!-- /.content -->
</aside><!-- /.right-side -->
</div><!-- ./wrapper -->
