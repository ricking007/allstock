<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Produtos
            <small>Manutenção e cadastro de produtos</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="produto">Produtos</a></li>
            <li><a href="produto/form/<?php echo !empty($this->produto) ? $this->produto['id_produto'] : '' ?>">Cadastro</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <form method="post" id="form-produto">
        <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Cadastro</h3>
                </div><!-- /.box-header -->
                <div class="box-body ">
                        <fieldset>
                            
                            <input type="hidden" id="id-produto" name="id" 
                            value="<?php echo !empty($this->produto) ? $this->produto['id_produto'] : NULL ?>"/>
                            
                            <legend class="text-center">Dados do Produto</legend>
                            
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="nome">Nome / Descrição</label>
                                    <input type="text" name="nome" id="nome" class="form-control" 
                                           value="<?php echo !empty($this->produto['dc_produto']) ? $this->produto['dc_produto'] : '' ?>"
                                           placeholder="Informe o nome do produto" />
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="valor">Valor</label>
                                    <div class="input-group" id="valor">
                                        <span class="input-group-addon">R$</span>
                                        <input type="text" name="valor" class="form-control" 
                                            value="<?php echo !empty($this->produto) ? 
                                            str_replace('.', ',', $this->produto['nm_valor']) : '' ?>" 
                                            placeholder="99,99"/>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="embalagem">Embalagem</label>
                                    <select name="embalagem" id="embalagem" class="form-control">
                                        <option value="">Selecione</option>
                                        <?php 
                                        if(!empty($this->embalagens)){
                                            foreach ($this->embalagens as $e){
                                        ?>
                                        <option value="<?php echo $e['id_embalagem']?>" 
                                            <?php echo !empty($this->produto) && 
                                                  $this->produto['id_embalagem'] == $e['id_embalagem'] ? 'selected' : '' ?>>
                                            <?php echo $e['no_embalagem']?>
                                        </option>
                                        <?php 
                                            }
                                        } //fim do if
                                        ?>
                                    </select>
                                    <a href="#" class="dyn-add" data-toggle="modal" data-target="#modal-add-opt" 
                                       title="Adicionar Embalagem" data-add="embalagem">
                                        <small class="pull-right">Adicionar</small>
                                    </a>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="qt_emb">Qtd. Embalagem</label>
                                    <input type="number" name="qt_emb" class="form-control" id="qt_emb" min="1" 
                                            value="<?php echo !empty($this->produto) ? 
                                            $this->produto['qt_embalagem'] : '' ?>" 
                                            />
                                    <small class="text-info pull-right info-valor-unit">
                                        A unidade sai por R$ 
                                        <span>
                                        <?php if(!empty($this->produto)){ 
                                            $valorVenda = $this->produto['nm_valor'] - ($this->produto['nm_valor'] * $this->produto['nm_porcentagem'] / 100);
                                            if(!empty($this->produto) && $this->produto['qt_embalagem'] > 0){
                                                $valorVendaUnit = $valorVenda / $this->produto['qt_embalagem'];
                                                echo $this->formatValor($valorVendaUnit);
                                            } else {
                                                echo $this->formatValor($valorVenda);
                                            }
                                        
                                            } else {
                                                echo '-';
                                            }
                                        ?>    
                                        </span>
                                    </small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label for="estoque">Estoque</label>
                                    <div class="input-group" id="estoque">
                                        <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                                        <input type="number" name="estoque" class="form-control" min="0"
                                            value="<?php echo !empty($this->produto) ? 
                                            $this->produto['nm_estoque'] : 0 ?>" 
                                            placeholder="99"/>
                                    </div>
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="promocao">Promoção</label>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="1" name="promocao"
                                            <?php echo !empty($this->produto) && $this->produto['id_promocao'] ? 
                                            'checked' : '' ?> id="promo" /> Sim
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-2 pc-desc animated 
                                     <?php echo empty($this->produto) || empty($this->produto['id_promocao']) ? 
                                            'hidden' : '' ?>">
                                    <label for="desconto">Desconto</label>
                                    <div class="input-group" id="nm_porcentagem">
                                        <input type="number"  name="nm_porcentagem" class="form-control" min="0" max="100" step="0.01"
                                            value="<?php echo !empty($this->produto) ? 
                                            $this->produto['nm_porcentagem'] : 0 ?>" 
                                            placeholder="10"/>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                                <div class="form-group col-md-2 vl-venda animated 
                                     <?php echo empty($this->produto) || empty($this->produto['id_promocao']) ? 
                                            'hidden' : '' ?>">
                                    <label>Valor</label>
                                    <h4 class="text-info">R$ 
                                    <span>
                                    <?php if(!empty($this->produto['id_promocao'])){
                                        //var venda = (valor - (valor * pc / 100)).toFixed(2);
                                        echo number_format($this->produto['nm_valor'] - ($this->produto['nm_valor'] * $this->produto['nm_porcentagem'] / 100),2,',','.');
                                    }  else {
                                        echo '-';
                                    }
                                    ?>
                                    </span></h4>
                                </div>
                                <div class="form-group col-md-3 dt-exp 
                                     <?php echo empty($this->produto) || empty($this->produto['id_promocao']) ? 
                                            'hidden' : '' ?>">
                                    <label for="expira">Expira</label>
                                    <div class="input-group date" id="expira">
                                        <input type="text"  name="expira" class="form-control"
                                            value="<?php echo !empty($this->produto) ? 
                                            $this->produto['dt_exp_promocao'] : '' ?>" 
                                            placeholder="<?php echo date('d/m/Y H:i') ?>"/>
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                                
                                
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="marca">Marca</label>
                                    <select name="marca" id="marca" class="form-control">
                                        <option value="">Selecione</option>
                                        <?php 
                                        if(!empty($this->marcas)){
                                            foreach ($this->marcas as $m){
                                        ?>
                                        <option value="<?php echo $m['id_marca']?>" 
                                            <?php echo !empty($this->produto) && 
                                                  $this->produto['id_marca'] == $m['id_marca'] ? 'selected' : '' ?>>
                                            <?php echo $m['no_marca']?>
                                        </option>
                                        <?php 
                                            }
                                        } //fim do if
                                        ?>
                                    </select>
                                    <a href="#" class="dyn-add" data-toggle="modal" data-target="#modal-add-opt" 
                                       title="Adicionar Marca" data-add="marca">
                                        <small class="pull-right">Adicionar</small>
                                    </a>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="categoria">Categoria</label>
                                    <select name="categoria" id="categoria" class="form-control">
                                        <option value="">Selecione</option>
                                        <?php 
                                        if(!empty($this->categorias)){
                                            foreach ($this->categorias as $c){
                                        ?>
                                        <option value="<?php echo $c['id_categoria']?>" 
                                            <?php echo !empty($this->produto) && 
                                                  $this->produto['id_categoria'] == $c['id_categoria'] ? 'selected' : '' ?>>
                                            <?php echo $c['no_categoria']?>
                                        </option>
                                        <?php 
                                            }
                                        } //fim do if
                                        ?>
                                    </select>
                                    <a href="#" class="dyn-add" data-toggle="modal" data-target="#modal-add-opt" 
                                       title="Adicionar Marca" data-add="categoria">
                                        <small class="pull-right">Adicionar</small>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="descricao">Descrição</label>
                                    <textarea name="descricao" id="descricao" class="form-control" rows="4"><?php echo !empty($this->produto['dc_descricao']) ? $this->produto['dc_descricao'] : '' ?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    
                                    <ul class="list-inline thumbs 
                                        <?php echo empty($this->produto) ? 'hidden' : '' ?>">
                                        <?php 
                                        if(!empty($this->fotos)){ 
                                            foreach ($this->fotos as $f){
                                                $nome = $f['id_foto'] . '.'.$f['dc_extensao'];
                                                $foto = "img/produtos/$nome";
                                        ?>
                                        <li>
                                            <div class="thumbnail">
                                                <img src="<?php echo file_exists($foto) ? $foto : 'img/produtos/img-not-found.jpg'  ?>" 
                                                     alt="<?php echo $nome; ?>" />
                                                <div class="caption">
                                                    <button type="button" class="btn btn-default btn-xs bt-capa-img" data-img="<?php echo $nome ?>">
                                                        <i class="fa fa-picture-o"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-xs bt-del-img" data-img="<?php echo $nome ?>">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                        <?php 
                                            } // fim do foreach
                                        } 
                                        ?>
                                        <li class="new" data-toggle="modal" data-target="#modal-add-img">
                                            <div class="thumbnail">
                                                <img src="img/img-add.png" />
                                            </div>
                                        </li>
                                    </ul>
                                    
                                </div>
                            </div>
                        </fieldset>
                        
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="produto" title="Cancelar" class="btn btn-default">Voltar</a>
                    <button type="submit" class="btn btn-primary btn-action-ajax" name="salvar" value="1"> 
                        Salvar
                    </button>
                    <a href="produto/form" class="pull-right" title="Cadastrar novo produto">Cadastrar Novo</a>
                </div>
              </div><!-- /.box -->
            </div>
        </form>
        <div class="modal fade" id="modal-alert" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <p></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="modal fade" id="modal-add-opt" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" id="opt-add" class="form-control" placeholder="Informe o nome" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary " id="btn-save-opt">Salvar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="modal fade" id="modal-add-img" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="form-add-img">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Adicionar Imagem</h4>
                        </div>
                        <div class="modal-body">
                            <div class="image-editor">
                                <input type="file" class="cropit-image-input hidden" accept="image/*"/>
                                <p class="text-center">
                                    <button type="button" class="btn btn-primary btn-select-img">
                                        <i class="fa fa-picture-o"></i> SELECIONAR IMAGEM
                                    </button>
                                </p>
                                <div class="cropit-image-preview"></div>
                                <div class="image-size-label">
                                    <i class="fa fa-picture-o "></i>
                                    <input type="range" class="cropit-image-zoom-input">
                                    <i class="fa fa-picture-o fa-2x"></i>
                                </div>
                                <input type="hidden" name="image-data" class="hidden-image-data" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary btn-action-ajax">Salvar</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </section><!-- /.content -->
</aside>