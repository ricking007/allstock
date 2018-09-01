<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta property="og:site_name" content=""/>
        <meta property="og:title" content=""/>
        <title><?php echo isset($this->PageTitle) ? $this->PageTitle : DEFAULT_PAGE_TITLE; ?></title>
        <base href="<?= BASE_URL ?>"/>
        
        <link rel="shortcut icon" href="img/favicon.ico?v=<?php echo md5_file('img/favicon.ico') ?>" type="image/x-icon" />
        <link rel="icon" href="img/favicon.ico?v=<?php echo md5_file('img/favicon.ico') ?>" type="image/x-icon">
        <link href='http://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900' rel='stylesheet' type='text/css'>
        <link href="css/default/bootstrap.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link href="css/default/animate.css" rel="stylesheet"/>
        <link href="css/default/style.css" rel="stylesheet"/>
        <?php
        if (isset($this->css) && is_array($this->css)) {
            foreach ($this->css as $css) {
                echo '<link href="' . $css . '" rel="stylesheet"/>' . PHP_EOL;
            }
        }
        ?>
        <script src="js/default/jquery.min.js"></script>
    </head>

    <body>
        <!--<div id="top-bar">
            
        </div>-->
        <!--Header-->
        <header id="header">
            <nav class="navbar navbar-default" role="banner">
                <div class="container">
                    <div class="row brand">
                        <div class="col-xs-12 col-sm-2">
                            <div class="logo">
                                <a href="index" title="<?php echo DEFAULT_PAGE_TITLE ?>">
                                    <img src="img/logo.png" alt="Logotipo" class="img-responsive"/> 
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-7">
                            <div id="search">
                                <form action="produtos/search/" method="get">
                                    <div class="input-group">
                                        <input type="text" name="query" class="form-control input-lg" 
                                               id="s-prod" placeholder="Procure pelo código ou nome do produto" autocomplete="off">
                                        <span class="input-group-btn">
                                            <button class="btn btn-lg" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                            <div class="pull-right">
                                <a href="tel:7132937300" class="call-us"><i class="fa fa-phone-square"> </i> +55 71 3293-7300 </a>
                                <ul class="list-inline social-links">
                                    <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#" class="gplus"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                    
                </div><!--/.container-->
                <div class="cotainer-fluid main-menu">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse-default">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="collapse navbar-collapse navbar-collapse-default">
                            <ul class="nav navbar-nav navbar-menu">
                                <li class="<?php echo $this->getActive('index') ?>">
                                    <a href="index" title="Página Principal">
                                        HOME
                                    </a>
                                </li>
                                <li class="<?php echo $this->getActive('sobre') ?>">
                                    <a href="sobre" title="Sobre Nós">
                                        SOBRE
                                    </a>
                                </li>
                                <li class="<?php echo $this->getActive('promocoes') ?>">
                                    <a href="produtos/promocoes" title="">
                                        PROMOÇÕES
                                    </a>
                                </li>
                                <li class="<?php echo $this->getActive('produtos') ?>" >
                                    <a  href="produtos" title="produtos">
                                       PRODUTOS
                                    </a>
                                </li>
                                <li class="<?php echo $this->getActive('contato') ?>">
                                    <a href="contato" title="Entre em Contato">
                                        CONTATO
                                    </a>
                                </li>
                            </ul>
                        </div>
                </div>
                </div>
                
            </nav><!--/nav-->
        </header>
        <!--End Header-->