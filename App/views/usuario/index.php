<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Usuários
            <small>Manutenção e cadastro de usuários do sistema</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="usuario">Usuários</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        
        <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Lista de Usuários</h3>
                  <div class="box-tools">
                    <div class="input-group pull-right">
                        <a href="usuario/form" class="btn btn-primary btn-xs" title="Cadastrar Usuário">
                            <i class="fa fa-plus"></i> 
                            Novo
                        </a>
                    </div>
                      
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body ">
                  <table class="table table-hover table-list">
                      <thead>
                        <tr>
                            <th class="text-center">Cod.</th>
                            <th>Nome</th>
                            <th class="text-center">Tipo</th>
                            <th class="text-center">Último Login</th>
                            <th width="80"></th>
                        </tr>
                      </thead>
                    <tbody>
                        <?php 
                        if(!empty($this->usuarios)){
                            foreach ($this->usuarios as $u){
                        ?>
                        <tr class="<?php echo $u['id_usuario_bloqueado'] ? 'alert-danger' : '' ?>">
                            <td class="text-center"><?php echo $u['id_pessoa'] ?></td>
                            <td>
                                <?php
                                $img = !empty($u['dc_img_perfil']) ? '<img src="img/'.$u['dc_img_perfil'].'" class="img-circle img-perfil min" alt="Avatar"/>' : '<img src="img/no-img.gif" title="Sem imagem" alt="Sem imagem" class="img-circle img-perfil min"/>';
                                echo $img. ' '. $u['no_nome_completo'];
                                echo $u['id_usuario_bloqueado'] ? ' <i class="fa fa-ban" data-toggle="tooltip" title="Usuário bloqueado"></i>' : '';
                                ?>
                            </td>
                            <td class="text-center">
                                <?php 
                                $icon = $u['id_pessoa_tipo'] == 1 ? 'fa-user-secret' : 'fa-user';
                                $text = $u['id_pessoa_tipo'] == 1 ? 'Admin' : 'Usuário';
                                $classe = $u['id_pessoa_tipo'] == 1 ? 'danger' : 'success';
                                ?>
                                <span class="label label-<?php echo $classe ?>">
                                    <i class="fa <?php echo $icon ?>"></i>
                                    <?php echo $text;?>
                                </span>
                            </td>
                            <td class="text-center"><?php echo $u['dt_ultimo_acesso'] ?></td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="usuario/form/<?php echo $u['id_pessoa'] ?>" class="btn btn-default btn-xs" title="Editar">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="#" class="btn btn-default btn-xs btn-del" data-pessoa="<?php echo $u['id_pessoa'] ?>" title="Excluir">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </div>
                             </td>
                        </tr>
                        <?php 
                            }
                        } else {
                        ?>
                        <tr>
                            <td colspan="5" class="text-center">Nenhuma categoria cadastrada</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
                <div class="box-footer text-center">
                    <!--
                    <ul class="pagination pagination-sm no-margin">
                      <li><a href="#">«</a></li>
                      <li><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">»</a></li>
                    </ul>
                    -->
                </div>
              </div><!-- /.box -->
            </div>
        
    </section><!-- /.content -->
</aside>