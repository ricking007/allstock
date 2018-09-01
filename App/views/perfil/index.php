<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Perfil
            <small>Dados do Usuário</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="perfil">Perfil</a></li>
        </ol>
    </section>

        <!-- Main content -->
    <section class="content">
        <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Meus dados</h3>
                </div><!-- /.box-header -->
                <div class="box-body ">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="<?php echo $this->getUser('dc_img_perfil') ? 'img/'.$this->getUser('dc_img_perfil') : 'img/no-img.gif' ?>" 
                                 class="thumbnail img-perfil"/>
                            <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#modal-img">Trocar Imagem</button>
                        </div>
                        <div class="col-md-10">
                            <h3><?php echo $this->getUser('no_nome_completo'); ?></h3>
                            <p><?php echo $this->getUser('dc_email'); ?></p>
                            <p>
                                <a href="#" title="Alterar Senha" class="change-pass">
                                    Alterar Senha
                                </a>
                            </p>
                            
                        </div>
                        <div class="col-md-4">
                            
                            <form class="hidden" id="form-change-pass">
                                <div class="form-group">
                                    <input type="password" name="senhaa" id="senhaa" class="form-control" placeholder="Senha Atual" />
                                </div>
                                <div class="form-group">
                                    <input type="password" name="senha" id="senha" class="form-control" placeholder="Nova Senha" />
                                </div>
                                <div class="form-group">
                                    <input type="password" name="rsenha" id="rsenha" class="form-control" placeholder="Repetir Senha" />
                                </div>
                                <p class="ajax-response"></p>
                                <button type="submit" class="btn btn-primary btn-action-ajax">Alterar Senha</button>
                            </form>
                        </div>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                  
                </div>
              </div><!-- /.box -->
            </div>
        <div class="modal fade" id="modal-img">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">ESCOLHA SEU AVATAR</h4>
                    </div>
                    <div class="modal-body text-center">
                        <ul class="list-inline choose-avatar">
                            <li><img src="img/avatar.png" data-img="avatar.png" class="thumbnail" alt="avatar"/></li>
                            <li><img src="img/avatar2.png" data-img="avatar2.png" class="thumbnail" alt="avatar"/></li>
                            <li><img src="img/avatar3.png" data-img="avatar3.png" class="thumbnail" alt="avatar"/></li>
                            <li><img src="img/avatar4.png" data-img="avatar4.png" class="thumbnail" alt="avatar"/></li>
                            <li><img src="img/avatar5.png" data-img="avatar5.png" class="thumbnail" alt="avatar"/></li>
                            <li><img src="img/avatar6.jpg" data-img="avatar6.jpg" class="thumbnail" alt="avatar"/></li>
                            <li><img src="img/avatar7.jpg" data-img="avatar7.jpg" class="thumbnail" alt="avatar"/></li>
                            <li><img src="img/avatar8.jpg" data-img="avatar8.jpg" class="thumbnail" alt="avatar"/></li>
                            <li><img src="img/avatar21.jpg" data-img="avatar21.jpg" class="thumbnail" alt="avatar"/></li>
                            <li><img src="img/avatar9.jpg" data-img="avatar9.jpg" class="thumbnail" alt="avatar"/></li>
                            <li><img src="img/avatar10.jpg" data-img="avatar10.jpg" class="thumbnail" alt="avatar"/></li>
                            <li><img src="img/avatar11.jpg" data-img="avatar11.jpg" class="thumbnail" alt="avatar"/></li>
                            <li><img src="img/avatar12.jpg" data-img="avatar12.jpg" class="thumbnail" alt="avatar"/></li>
                            <li><img src="img/avatar13.jpg" data-img="avatar13.jpg" class="thumbnail" alt="avatar"/></li>
                            <li><img src="img/avatar14.jpg" data-img="avatar14.jpg" class="thumbnail" alt="avatar"/></li>
                            <li><img src="img/avatar15.jpg" data-img="avatar15.jpg" class="thumbnail" alt="avatar"/></li>
                            <li><img src="img/avatar16.jpg" data-img="avatar16.jpg" class="thumbnail" alt="avatar"/></li>
                            <li><img src="img/avatar17.jpg" data-img="avatar17.jpg" class="thumbnail" alt="avatar"/></li>
                            <li><img src="img/avatar18.jpg" data-img="avatar18.jpg" class="thumbnail" alt="avatar"/></li>
                            <li><img src="img/avatar19.jpg" data-img="avatar19.jpg" class="thumbnail" alt="avatar"/></li>
                            <li><img src="img/avatar20.jpg" data-img="avatar20.jpg" class="thumbnail" alt="avatar"/></li>
                            
                            
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->