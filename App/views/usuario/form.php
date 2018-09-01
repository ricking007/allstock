<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Usuários
            <small>Manutenção e cadastro de usuários</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="usuario">Usuários</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <form method="post" id="form-usuario">
        <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Cadastro</h3>
                </div><!-- /.box-header -->
                <div class="box-body ">
                        <fieldset>
                            <?php 
                            if(!empty($this->usuario)){
                            ?>
                                <input type="hidden" id="id-usuario" name="id" value="<?php echo $this->usuario['id_pessoa']?>"/>
                            <?php }?>
                            <legend class="text-center">Dados do Usuário</legend>
                            
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="nome">Nome</label>
                                    <input type="text" name="nome" id="nome" class="form-control" 
                                           value="<?php echo !empty($this->usuario['no_nome_completo']) ? $this->usuario['no_nome_completo'] : '' ?>"
                                           placeholder="Informe o nome completo do usuário" />
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" class="form-control" 
                                           value="<?php echo !empty($this->usuario['dc_email']) ? $this->usuario['dc_email'] : '' ?>"
                                           placeholder="Informe o email do usuário" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="email">Senha</label>
                                    <input type="password" name="senha" id="senha" class="form-control" 
                                           placeholder="Informe a senha" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="email">Repita a Senha</label>
                                    <input type="password" name="rsenha" id="rsenha" class="form-control" 
                                           placeholder="Repita a senha" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="tipo">Tipo de Usuário</label>
                                    <select name="tipo" class="form-control" id="tipo">
                                        <option value="">Selecione</option>
                                        <option value="1" <?php echo !empty($this->usuario['id_pessoa_tipo']) && $this->usuario['id_pessoa_tipo'] == 1 ? 'selected' : '' ?>>Administrador</option>
                                        <option value="2" <?php echo !empty($this->usuario['id_pessoa_tipo']) && $this->usuario['id_pessoa_tipo'] == 2 ? 'selected' : '' ?>>Usuário</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="notificar" value="1" /> Notificar o usuário por e-mail
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="bloqueado" value="1" 
                                            <?php echo !empty($this->usuario['id_usuario_bloqueado']) && $this->usuario['id_usuario_bloqueado'] ? 'checked' : '' ?> /> Usuário Bloqueado
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group ajax-response">
                                    
                                </div>
                            </div>
                            
                        </fieldset>
                        
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="usuario" title="Cancelar" class="btn btn-default">Voltar</a>
                    <button type="submit" class="btn btn-primary btn-action-ajax" name="salvar" value="1"> 
                        Salvar
                    </button> 
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
    </section><!-- /.content -->
</aside>