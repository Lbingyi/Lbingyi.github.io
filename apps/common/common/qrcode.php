<?php
use \think\Loader;
/*
 * 生成二维码的接口
 */
function QRcode($text, $outfile = false, $level = 'Q', $size = 4, $margin = 4, $saveandprint=false){
    Loader::import('QRcode.qrcode');
    \QRcode::png($text, $outfile , $level , $size , $margin , $saveandprint);
}
?>