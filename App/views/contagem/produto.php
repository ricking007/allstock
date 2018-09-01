<input type="hidden" id="contagem" value="<?php echo!empty($this->produto) ? $this->produto['nm_quantidade'] : 0; ?>">
<input type="hidden" id="produtos" value="<?php echo!empty($this->produto) ? $this->produto['nm_estoque'] : 0; ?>">

<script>
    window.onload = function () {
        //gráfico 1
        //buscando os dados na tabela
        var qtd_contagem = $("#contagem").val();
        var qtd_produtos = $("#produtos").val();
        var options = {
            animationEnabled: true,
            title: {
                text: "Dados da Contagem"
            },
            data: [{
                    type: "doughnut",
                    innerRadius: "40%",
                    showInLegend: true,
                    legendText: "{label}",
                    indexLabel: "{label}: #percent%",
                    dataPoints: [
                        {label: "Qtd. contados no estoque", y: qtd_contagem},
                        {label: "Qtd. cadastrado no sistema", y: qtd_produtos}
                    ]
                }]
        };
        $("#chartContainer").CanvasJSChart(options);
    }
</script>

<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Informações gerais
            <small>Produto contado</small>
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
                    <h3 class="box-title">
                        <?php echo!empty($this->produto) ? $this->produto['dc_produto'] : 0; ?>
                    </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                </div>
            </div><!-- /.box -->
        </div>
    </section><!-- /.content -->
</aside>