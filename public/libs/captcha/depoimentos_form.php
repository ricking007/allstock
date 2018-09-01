<?php
ini_set("display_errors", 1	); // exibir erros
error_reporting(E_ALL); // exibir avisos e erros

session_start();
$resposta = '';

if(isset($_POST['verificador']))
{


$verificador = $_POST['verificador'];

	// seguran�a, sessao precisa ter alguma coisa , verificador tem que ter alguma coisa
	if( isset($_SESSION['session_textoCaptcha']) &&  $_SESSION['session_textoCaptcha'] != '' &&  $_SESSION['session_textoCaptcha']  == $verificador )
	{
		$resposta = 'sucesso.';
	}
	else
	{
		session_destroy();
		$resposta = 'C�digo Verificador Errado.';
	}
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="iframetheme.css" type="text/css" rel="stylesheet" />


</head>
<body >


<form name="form1" target="_self" method="post" >
<div style="padding-left:20px">

<?  echo $resposta;  ?>

   
  <table width="264" border="0" cellspacing="0" cellpadding="0">
 
    <tr>
      <td height="35" colspan="2">Digite o C�digo abaixo: (apenas n&uacute;meros)</td>
    </tr>
   <tr>
      <td height="35" width="100"><img src="captcha.php" width="90" height="30"> </td>
      <td ><input name="verificador" type="text" maxlength="4" /></td>
    </tr>

  </table> 
  <p><input type="submit" name="enviar" value="Enviar" id="enviar"  class="botao"/></p>

</div>
</form>



</body>
</html>
