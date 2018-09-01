<input type="hidden" id="contagem" value="<?php echo!empty($this->contagem) ? $this->contagem['qtd_contagem'] : 0; ?>">
<input type="hidden" id="produtos" value="<?php echo!empty($this->contagem) ? $this->contagem['qtd_produtos'] : 0; ?>">
<?php

function abrevia($nome) {
    $nome = explode(" ", $nome); // cria o array $nome com as partes da string
    $nome = $nome[0];
    return $nome; // retorna novo nome
}
?>
<?php
$dataPoints1 = array();
$dataPoints2 = array();
if (!empty($this->produto)) {
    foreach ($this->produto as $p) {
        array_push($dataPoints1, array("label" => abrevia($p['dc_produto']), "y" => $p['nm_estoque']));
        array_push($dataPoints2, array("label" => abrevia($p['dc_produto']), "y" => $p['nm_quantidade']));
    }
}
?>
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
                        {label: "Produtos contados", y: qtd_contagem},
                        {label: "Produtos restantes", y: qtd_produtos}
                    ]
                }]
        };
        $("#chartContainer").CanvasJSChart(options);
        //grafico 2
        var chart = new CanvasJS.Chart("chartContainer1", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Produtos que não conferem no estoque"
            },
            legend: {
                cursor: "pointer",
                verticalAlign: "center",
                horizontalAlign: "right",
                itemclick: toggleDataSeries
            },
            data: [{
                    type: "column",
                    name: "Cadastrado no sistema",
                    indexLabel: "{y}",
                    yValueFormatString: "###",
                    showInLegend: true,
                    dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
                }, {
                    type: "column",
                    name: "Estoque",
                    indexLabel: "{y}",
                    yValueFormatString: "###",
                    showInLegend: true,
                    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                }]
        });
        chart.render();
        function toggleDataSeries(e) {
            if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
                e.dataSeries.visible = true;
            }
            chart.render();
        }
    }
</script>

<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Contagem iniciada em: <span><?php echo!empty($this->contagem) ? $this->contagem['dt_data'] : '00/00/00'; ?></span>

            <small><?php echo!empty($this->contagem) ? $this->contagem['no_status'] : 'Indefinido'; ?></small>
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
                    <h3 class="box-title">Levantamento Geral</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                        </div>
                        <div class="col-md-6">
                            <div id="chartContainer1" style="height: 300px; width: 100%;"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Todos os Produtos</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-hover table-list" 
                                           data-total="<?php echo!empty($this->total) ? $this->total : 0; ?>"
                                           data-pagesize="<?php echo NUM_ITENS_GRID ?>">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Produto</th>
                                                <th width="120">Qtd. Cadastrado</th>
                                                <th width="120">Qtd. Encontrado</th>
                                                <th width="80"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($this->produtos)) {
                                                foreach ($this->produtos as $p) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $p['dc_produto'] ?></td>
                                                        <td><?php echo $p['nm_estoque'] ?></td>
                                                        <td><?php echo $p['nm_quantidade'] ?></td>
                                                        <td class="text-center">
                                                            <div class="btn-group">
                                                                <a href="contagem/produto/<?php echo $p['id_contagem_produto'] ?>" class="btn btn-default btn-xs" title="Ver Contagem">
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
                                                    <td colspan="4" class="text-center">Nenhum produto contado até agora</td>
                                                </tr>
<?php } ?>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                                <div class="box-footer text-center">
                                </div>
                            </div><!-- /.box -->
                        </div>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                </div>
            </div><!-- /.box -->
        </div>
    </section><!-- /.content -->
</aside>