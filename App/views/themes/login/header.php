<!DOCTYPE html>
<html lang="pt-br" class="bg-black">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Doces">
        <meta name="keywords" content="Doces">
        <meta property="og:site_name" content="Doces"/>
        <meta property="og:title" content="Doces"/>
        <title><?php echo isset($this->PageTitle) ? $this->PageTitle : DEFAULT_PAGE_TITLE; ?></title>
        <base href="<?= BASE_URL ?>"/>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="img/favicon.ico?v=<?php echo md5_file('img/favicon.ico') ?>" />
        <link href="css/default/bootstrap.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
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

    <body class="bg-black">
