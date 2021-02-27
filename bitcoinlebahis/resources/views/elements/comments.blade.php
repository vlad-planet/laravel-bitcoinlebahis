<?
            
$url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
$url .= ( $_SERVER["SERVER_PORT"] != 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
$url .= $_SERVER["REQUEST_URI"];

?>
    
<div   data-width="100%" class="fb-comments" data-href="<?=$url?>" data-numposts="5"></div>    