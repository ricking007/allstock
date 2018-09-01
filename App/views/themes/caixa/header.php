<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta property="og:site_name" content=""/>
        <meta property="og:title" content=""/>
        <title><?php echo isset($this->PageTitle) ? $this->PageTitle : DEFAULT_PAGE_TITLE; ?></title>
        <base href="<?= BASE_URL ?>"/>

        <link rel="shortcut icon" href="img/favicon.ico?v=<?php echo md5_file('img/favicon.ico') ?>" type="image/x-icon" />
        <link rel="icon" href="img/favicon.ico?v=<?php echo md5_file('img/favicon.ico') ?>" type="image/x-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
        <!-- Bootstrap Core Css -->
        <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
        <!-- Waves Effect Css -->
        <link href="plugins/node-waves/waves.css" rel="stylesheet" />
        <!-- Animation Css -->
        <link href="plugins/animate-css/animate.css" rel="stylesheet" />
        <!-- Morris Chart Css-->
        <link href="plugins/morrisjs/morris.css" rel="stylesheet" />
        <!-- Custom Css -->
        <link href="css/style.css" rel="stylesheet">
        <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
        <link href="css/themes/all-themes.css" rel="stylesheet" />
        <?php
        if (isset($this->css) && is_array($this->css)) {
            foreach ($this->css as $css) {
                echo '<link href="' . $css . '" rel="stylesheet"/>' . PHP_EOL;
            }
        }
        ?>
        <script src="js/default/jquery.min.js"></script>
    </head>

    <body class="theme-red" ng-app="allstockApp">
        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="preloader">
                    <div class="spinner-layer pl-red">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
                <p>Aguarde...</p>
            </div>
        </div>
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                    <a href="javascript:void(0);" class="bars"></a>
                    <a class="navbar-brand" href="javascript:void(0);"><?php echo DEFAULT_PAGE_TITLE; ?></a>
                </div>
            </div>
        </nav>
        <!-- #Top Bar -->
        <section>
            <!-- Left Sidebar -->
            <aside id="leftsidebar" class="sidebar">
                <!-- User Info -->
                <div class="user-info">
                    <div class="image">
                        <img class="img-perfil" src="<?php echo $this->getUser('dc_img_perfil') ? 'img/' . $this->getUser('dc_img_perfil') : 'images/user.png' ?>" width="48" height="48" alt="User" />
                    </div>
                    <div class="info-container">
                        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $this->getUser('no_nome'); ?></div>
                        <div class="email"><?php echo $this->getUser('dc_email') ?></div>
                        <div class="btn-group user-helper-dropdown">
                            <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="perfil/user"><i class="material-icons">person</i>Perfil</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="login/logout"><i class="material-icons">input</i>Sair</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #User Info -->
                <!-- Menu -->
                <div class="menu">
                    <ul class="list">
                        <li class="header">MENU</li>
                        <li>
                            <a href="caixa">
                                <i class="material-icons col-black">home</i>
                                <span>Caixa</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <i class="material-icons col-red">shopping_basket</i>
                                <span>Minhas Vendas</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <i class="material-icons col-amber">widgets</i>
                                <span>Produtos</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <i class="material-icons col-light-blue">view_list</i>
                                <span>Categorias</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- #Menu -->
                <!-- Footer -->
                <div class="legal">
                    <div class="copyright">
                        &copy; 2016 - 2018 <a href="javascript:void(0);">All Stock - Controle de Estoque</a>.
                    </div>
                    <div class="version">
                        <b>Version: </b> 2.0.5
                    </div>
                </div>
                <!-- #Footer -->
            </aside>
        </section>
