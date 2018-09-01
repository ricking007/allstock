<?php
error_reporting(E_ALL); // exibir avisos e erros
ini_set("display_errors",1); // exibir erros

  // Adapted for The Art of Web: www.the-art-of-web.com
  // Please acknowledge use of this code by including this header.

  // initialise image with dimensions of 160 x 45 pixels
  $image = @imagecreatetruecolor(160,45);


  // set background and allocate drawing colours
  $background = imagecolorallocate($image, 0x66, 0xCC, 0xFF);
  imagefill($image, 0, 0, $background);
  $linecolor = imagecolorallocate($image, 0x33, 0x99, 0xCC);
  $textcolor1 = imagecolorallocate($image, 0x00, 0x00, 0x00);
  $textcolor2 = imagecolorallocate($image, 0xFF, 0xFF, 0xFF);

  // draw random lines on canvas
  for($i=0; $i < 8; $i++) {
    imagesetthickness($image, rand(1,3)); // mudei aqui
    imageline($image, rand(0,160), 0, rand(0,160), 45, $linecolor);
  }

  session_start();

  // using a mixture of TTF fonts
  $fonts = array();
  $fonts[] = "bnfontboy.ttf";
 // $fonts[] = "Achafont.ttf";
  //$fonts[] = "Aerosol.ttf";

  // add random digits to canvas using random black/white colour
  $digit = '';
  for($x = 20; $x <= 130; $x += 30) {
    $textcolor = (rand() % 2) ? $textcolor1 : $textcolor2;
    $digit .= ($num = rand(0, 9));
    imagettftext($image, 30, rand(-30,30), $x, rand(20, 35), $textcolor, $fonts[array_rand($fonts)], $num);
  }

  // record digits in session variable
  $_SESSION['session_textoCaptcha'] = $digit;
 
  // display image and clean up
  header('Content-type: image/png');
  imagepng($image);
  imagedestroy($image);

/*
/***
* File : captcha.php
* Description : Cria uma imagem captcha e guarda o texto numa vari�vel session
* Autor : Kiran Paul V.J. aka kiranvj aka human
* Licen�a : Freeware
* �ltima atualiza��o : 22-Aug-2007

 
// Inicializa os dados da session
session_start();
 
// Definir o header como image/png para indicar que esta p�gina cont�m dados
// do tipo image->PNG
header("Content-type: image/png");
 
// Criar um novo recurso de imagem a partir de um arquivo
$imagemCaptcha = imagecreatefrompng("captcha.png")
or die("N�o foi poss�vel inicializar uma nova imagem");
 
 
//Carregar uma nova fonte
$fonteCaptcha = imageloadfont("anonymous.gdf");

// Criar o texto para o captcha
$textoCaptcha = substr(md5(uniqid('')),-4,4);
 
// Guardar o texto numa vari�vel session
$_SESSION['session_textoCaptcha'] = $textoCaptcha;
 
// Indicar a cor para o texto
$corCaptcha = imagecolorallocate($imagemCaptcha,102,102,102);
 
// Escrever a string na cor escolhida
imagestring($imagemCaptcha,$fonteCaptcha,0,-5,$textoCaptcha,$corCaptcha);
 
// Mostrar a imagem captha no formato PNG.
// Outros formatos podem ser usados com imagejpeg, imagegif, imagewbmp, etc.
imagepng($imagemCaptcha);
 
// Liberar mem�ria
imagedestroy($imagemCaptcha);
 */
?>