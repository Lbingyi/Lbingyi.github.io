<?php
//记录log的函数
function writeLog($msg,$folder = 'default')
{
    $date = date('Y-m-d');
    $path = ROOT_PATH."Log/".$folder;
    $filename = $date.".txt";
    if(is_object($msg))
        $strdata = var_export((array)$msg,TRUE);
    else
        $strdata = var_export($msg,TRUE);
    $str = date('Y-m-d H:i:s')."\r\n".$strdata."\r\n";
    if(!file_exists($path."/".$filename)){
        mkdir($path,0777,true);
    }
    $file = fopen($path."/".$filename, "a") or die("Unable to open log file!");
    fwrite($file, $str);
    fclose($file);
}
?>