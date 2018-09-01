/*
 * Script global Caixa
 * @Autor {Ricardo Oliveira} 
 * @type {JS - Angular v.6}
 * @Controllers PHP {Produto,Usuario}
 */

/* global app */
app.controller('caixaCtrl', function ($scope, $http, API_URL) {

    //modal informativo;
    var alert = $("#modal-alert");
    $scope.itens = [];
    //carregar produtos na wiew
    $scope.clientes = function (pessoa) {
        if (pessoa.no_nome_completo.length > 3) {
            var data = {
                q: pessoa.no_nome_completo};
            $http({
                url: API_URL + 'usuario/get',
                method: "POST",
                data: data
            }).then(function (response) {
                $scope.compl = true;
                $scope.pessoas = response.data;
            });
        } else {
            $scope.pessoas = "";
        }
    };
    //inserir pessoa
    $scope.cliente = function (pessoa) {
        $scope.pessoa = pessoa;
        $scope.compl = false;
    };
    //carregar produtos na wiew
    $scope.pesquisar = function (produto) {
        if (produto.dc_produto.length > 3) {
            var data = {
                q: produto.dc_produto};
            $http({
                url: API_URL + 'produto/get',
                method: "POST",
                data: data
            }).then(function (response) {
                // Coloca o autocomplemento
                $scope.completing = true;
                // JSON retornado do banco
                $scope.produtos = response.data;
            });
        } else {
            $scope.produtos = "";
        }
    };
    //inserir item
    $scope.item = function (produto) {
        $scope.produto = produto;
        $scope.completing = false;
    };

    //inserir item na venda
    $scope.insertItem = function (produto) {
        $scope.produto = produto;
        var total = $scope.qtd * produto.nm_valor;
        var itens = {
            id: produto.id_produto,
            descricao: produto.dc_produto,
            valor: produto.nm_valor,
            qtd: $scope.qtd,
            total: total};
        $scope.itens.push(itens);
//        $scope.produto = "";
//        $scope.qtd = "";
    };
    //excluir item na venda
    $scope.delItem = function (item) {
        $scope.itens.splice(item,1);
    };
    
    //venda
    $scope.venda = function(){
        console.log($scope.pessoa);
        console.log($scope.itens);
    };

    //load page
    $scope.load = function () {
        location.reload();
    };
});





