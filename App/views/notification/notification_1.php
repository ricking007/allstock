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
                    <div class="row">
                        <div class="col-xs-12">
                            <h3>FORMULÁRIO PARA ENVIO DO ARQUIVO XML</h3>
                            <hr/>
                        </div>
                    </div>
                    <form id="form-xml">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <input type="hidden" name="not" value="<?php echo $this->notification['id_notificacao']; ?>" />
                                <input type="hidden" name="pedido" value="<?php echo $this->notification['id_pedido']; ?>" />
                                <label for="email">Email do Cliente</label>
                                <input type="text" name="email" id="email" class="form-control"
                                       value="<?php echo $this->notification['dc_email'] ?>"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="assunto">Assunto</label>
                                <input type="text" name="assunto" id="assunto" class="form-control"
                                       value="Nota Fiscal Eletrônica"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="mensagem">Mensagem</label>
                                <textarea name="mensagem" id="mensagem" class="form-control" rows="5">Olá Sr(a) Cliente,
A Nota Fiscal Eletrônica (NF-e) do pedido #<?php echo str_pad($this->notification['id_pedido'],4,"0",STR_PAD_LEFT); ?> foi emitida. Segue em anexo o arquivo XML da referida nota.
Att.
Doces Puro Sabor</textarea>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="email">Selecione o arquivo XML</label>
                                <input type="file" name="file" id="file" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group ajax-response">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <button type="submit" class="btn btn-primary btn-action-ajax">Enviar Arquivo</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <a href="notification/complete/<?php echo $this->notification['id_notificacao'] ?>" title="Marcar como Concluída">Marcar como Concluída</a>
                            </div>
                        </div>
                    </form>
                </div><!-- /.box-body -->
                <div class="box-footer text-center">

                </div>
                <?php } ?>
            </div><!-- /.box -->
        </div>
    </section><!-- /.content -->
</aside>