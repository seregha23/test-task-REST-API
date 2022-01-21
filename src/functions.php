<?php

namespace App;

//Вывод функции в папке debug
function debugLog($ar, $file_name = 'debug.txt')
{
    $info = debug_backtrace();
    $file = $info[0]['file'];
    $line = $info[0]['line'];
    $function = '';
    if (isset($info[1]['function'])):
        //Отображение функции с которой был вызов
        $function = "FUNC: " . $info[1]['function'] . "()";
    endif;
    if (!empty($file) && !empty($line)):
        $f = fopen($_SERVER['DOCUMENT_ROOT'] . "/debug/" . $file_name, "a");
        //if($utf_8!==false) fwrite($f,'<meta http-equiv="Content-Type" content="text/html; charset='.$utf_8.'" />\n');
        fwrite($f, date("d.m.Y H:i:s") . "\n");
        fwrite($f, "FILE: " . $file . "\n");
        fwrite($f, "LINE: " . $line . "\n");
        fwrite($f, $function . "\n");
        if (is_bool($ar) === true):
            fwrite($f, "bool(" . var_export($ar, true) . ")\n\n");
        else:
            fwrite($f, print_r($ar, true) . "\n\n");
        endif;
        fclose($f);
    else:
        die("debug: не указан файл или строка");
    endif;
}