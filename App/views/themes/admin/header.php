<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta property="og:site_name" content=""/>
        <meta property="og:title" content=""/>
        <title><?php echo isset($this->PageTitle) ? $this->PageTitle : DEFAULT_PAGE_TITLE; ?></title>
        <base href="<?= BASE_URL ?>"/>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="img/favicon.ico?v=<?php echo md5_file('img/favicon.ico') ?>" />
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link href="css/default/animate.css" rel="stylesheet"/>
        <link href="css/default/admin.css" rel="stylesheet"/>

        <?php
        if (isset($this->css) && is_array($this->css)) {
            foreach ($this->css as $css) {
                echo '<link href="' . $css . '"rel="stylesheet"/>' . PHP_EOL;
            }
        }
        ?>

    </head>
    <body class="<?php echo $this->getUser('dc_tema') ? $this->getUser('dc_tema') : 'skin-yellow' ?>">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="dashboard" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                All Stock
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                         <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell icon-animated-bell" data-notifications="0"></i>
                                <span class="label label-danger animated bounceIn"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header total-notifications">Você tem Notificações</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-exclamation-triangle danger"></i> Nenhuma notificação
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="notification">Ver Todas</a></li>
                            </ul>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <span><?php echo $this->getUser('no_nome'); ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?php echo $this->getUser('dc_img_perfil') ? 'img/'.$this->getUser('dc_img_perfil') : 'img/no-img.gif' ?>" 
                                         class="img-circle img-perfil" alt="User Image" />
                                    <p>
                                        <?php echo $this->getUser('no_nome_completo') ?>
                                        <small><?php echo $this->getUser('dc_email') ?></small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-12 text-center">
                                        <ul class="list-inline choose-theme">
                                            <li class="<?php echo $this->getUser('dc_tema') == 'skin-blue' ? 'active' : '' ?>">
                                                <span class="bg-blue" data-theme="skin-blue"></span>
                                            </li>
                                            <li class="<?php echo $this->getUser('dc_tema') == 'skin-green' ? 'active' : '' ?>">
                                                <span class="bg-olive" data-theme="skin-green"></span>
                                            </li>
                                            <li class="<?php echo $this->getUser('dc_tema') == 'skin-black' ? 'active' : '' ?>">
                                                <span class="bg-black" data-theme="skin-black"></span>
                                            </li>
                                            <li class="<?php echo $this->getUser('dc_tema') == 'skin-yellow' ? 'active' : '' ?>">
                                                <span class="bg-yellow" data-theme="skin-yellow"></span>
                                            </li>
                                            <li class="<?php echo $this->getUser('dc_tema') == 'skin-pink' ? 'active' : '' ?>">
                                                <span class="bg-pink" data-theme="skin-pink"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="perfil" class="btn btn-default btn-flat">Perfil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="login/logout" class="btn btn-default btn-flat">Sair</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo $this->getUser('dc_img_perfil') ? 'img/'.$this->getUser('dc_img_perfil') : 'img/no-img.gif' ?>" 
                                 class="img-circle img-perfil" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Olá, <?php echo $this->getUser('no_nome'); ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="produto/search/" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Pesquisar Produto..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat" value="1"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="<?php echo $this->getActive('dashboard'); ?>">
                            <a href="dashboard">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="<?php echo $this->getActive('product'); ?>">
                            <a href="produto">
                                <i class="fa fa-cube"></i> <span>Produtos</span>
                            </a>
                        </li>
                        <li class="<?php echo $this->getActive('contagem'); ?>">
                            <a href="contagem">
                                <i class="fa fa-cubes"></i> <span>Contagens</span>
                            </a>
                        </li>
                        <li class="<?php echo $this->getActive('marca'); ?>">
                            <a href="marca">
                                <i class="fa fa-registered"></i> <span>Marcas</span>
                            </a>
                        </li>
                        <li class="<?php echo $this->getActive('categoria'); ?>">
                            <a href="categoria">
                                <i class="fa fa-files-o"></i> <span>Categorias</span>
                            </a>
                        </li>
                        <li class="<?php echo $this->getActive('embalagem'); ?>">
                            <a href="embalagem">
                                <i class="fa fa-briefcase"></i> <span>Embalagens</span>
                            </a>
                        </li>
                        <li class="<?php echo $this->getActive('notification'); ?>">
                            <a href="notification">
                                <i class="fa fa-bell"></i> <span>Notificacões</span>
                            </a>
                        </li>
                        <!--
                        <li class="<?php //echo $this->getActive('sobre'); ?>">
                            <a href="sobre/form">
                                <i class="fa fa-info-circle"></i> <span>Sobre</span>
                            </a>
                        </li>
                        <li class="<?php //echo $this->getActive('slides'); ?>">
                            <a href="carousel">
                                <i class="fa fa-picture-o"></i> <span>Slides</span>
                            </a>
                        </li>
                        <li class="<?php //echo $this->getActive('galeria'); ?>">
                            <a href="galeria">
                                <i class="fa fa-picture-o"></i> <span>Galerias</span>
                            </a>
                        </li>
                        <?php //if($this->validaPermissaoUsuario(5,1)) { ?>
                        <li class="<?php //echo $this->getActive('usuario'); ?>">
                            <a href="usuario">
                                <i class="fa fa-users"></i> <span>Usuários</span>
                            </a>
                        </li>
                        <?php //} ?>
                       --> 
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
    
