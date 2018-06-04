<?php

function limpar($string){
  return strtr(utf8_decode($string),utf8_decode('ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ '),'SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy_');
}

setcookie("unidade", 'spd_' . limpar($_POST['unidade']), time() + (86400 * 30), "/");

echo 0;
