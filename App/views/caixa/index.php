<section class="content" ng-controller="caixaCtrl">
    <div class="container-fluid">
        <!-- Form Caixa -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-6">
                                <h2>CAIXA</h2>
                            </div>
                        </div>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Cancelar Pedido</a></li>
                                    <li><a href="javascript:void(0);">Fechar o Caixa</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box-3 bg-blue hover-expand-effect" data-toggle="modal" data-target="#modal-venda">
                    <div class="icon">
                        <i class="material-icons">equalizer</i>
                    </div>
                    <div class="content">
                        <div class="text">NOVA</div>
                        <div class="number">VENDA</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal-Venda -->
        <div class="modal fade" id="modal-venda" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="largeModalLabel">Formulário de Vendas</h4>
                    </div>
                    <div class="modal-body">
                        <!-- Informações gerais -->
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="header">
                                        <h2>
                                            Detalhes 
                                            <small>Não é necessário cadastrar um cliente!</small>
                                        </h2>
                                    </div>
                                    <div class="body">
                                        <div class="row clearfix">
                                            <div class="col-md-2">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">assignment_turned_in</i>
                                                    </span>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control date" ng-model="pessoa.id_pessoa" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">account_circle</i>
                                                    </span>
                                                    <div class="form-line">
                                                        <input type="text" ng-keyup="clientes(pessoa)" ng-model="pessoa.no_nome_completo" class="form-control" placeholder="Quem você procura?" autofocus autocomplete="off">
                                                        <div class="autocomplete" ng-show="compl">
                                                            <ul class="list-group" style="display:block;
                                                                position:absolute;
                                                                margin-top:15px;
                                                                padding:10px;">
                                                                <li class="list-group-item" ng-repeat="pessoa in pessoas">
                                                                    <p ng-click="cliente(pessoa)">
                                                                        {{pessoa.no_nome_completo}}
                                                                    </p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">monetization_on</i>
                                                    </span>
                                                    <select class="form-control show-tick">
                                                        <option>Forma de Pagamento</option>
                                                        <option>Dinheiro</option>
                                                        <option>Débito</option>
                                                        <option>Crédito</option>
                                                        <option>Vale</option>
                                                        <option>Cheque</option>
                                                        <option>Crediário</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="header">
                                        <h2>
                                            ITENS DA VENDA
                                        </h2>
                                        <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                                <a  data-toggle="modal" data-target="#modal-produto" class="btn bg-purple waves-effect">
                                                    <i class="material-icons">search</i>
                                                    <span>ADICIONAR</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="body">
                                        <div class="table-responsive" style="height: 200px; overflow: auto">
                                            <table class="table table-hover table-list">
                                                <thead>
                                                    <tr>
                                                        <th width="80" class="text-center">Qtd</th>
                                                        <th>Descrição</th>
                                                        <th class="text-center">Vl. Unit.</th>
                                                        <th class="text-center">Total</th>
                                                        <th class="text-center"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="item in itens">
                                                        <td class="text-center">{{item.qtd}}</td>
                                                        <td>{{item.descricao}}</td>
                                                        <td class="text-center">{{item.valor}}</td>
                                                        <td class="text-center">{{item.total}}</td>
                                                        <td class="text-center">
                                                            <button type="button" ng-click="delItem(item)" class="btn btn-danger  btn-circle waves-effect waves-circle waves-float">
                                                                <i class="material-icons">delete</i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCELAR</button>
                        <button type="button" class="btn btn-success btn-link waves-effect" ng-click="venda()">CONCLUIR VENDA</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Adicionar Produtos -->
        <div class="modal fade" id="modal-produto" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="smallModalLabel">Adicionar Produto</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-9">
                                <input type="text" ng-keyup="pesquisar(produto)" ng-model="produto.dc_produto" class="form-control input-lg" placeholder="O que você procura?" autofocus autocomplete="off">
                                <div class="autocomplete" ng-show="completing">
                                    <ul class="list-group">
                                        <li class="list-group-item btn" ng-repeat="produto in produtos">
                                            <p ng-click="item(produto)">
                                                {{produto.dc_produto}}
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <input type="number" ng-model="qtd" class="form-control input-lg" placeholder="Qtd">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCELAR</button>
                        <button type="button" class="btn btn-success btn-link waves-effect" ng-click="insertItem(produto)">INCLUIR</button>
                    </div>
                </div>
            </div>
        </div>
</section>
