<?php
//symlink('/home/bitcoinlebahis/bitcoinlebahis/storage/app/public', '/home/bitcoinlebahis/public_html/storage');
?>

<?php
if(symlink('/home/bitcoinlebahis/bitcoinlebahis/storage/app/public', '/home/bitcoinlebahis/public_html/storage/public'))
    echo "YES";
else
    echo "NO";
?>


<?php
////win 10
////symlink($target, $link);
//// mklink /j "путь, где будет создана символьная ссылка" "путь, где находятся исходный файл или папка"
////if(symlink('/bitcoinlebahis/bitcoinlebahis/storage/app/public', '/bitcoinlebahis/public/storage/public'))
//$link = 'C:\OSPanel\domains\bitcoinlebahis\public\storage\public';
//$target = 'C:\OSPanel\domains\bitcoinlebahis\bitcoinlebahis\storage\app\public';
//if(exec('mklink /j "' . str_replace('/', '\\', $link) . '" "' . str_replace('/', '\\', $target) . '"'))
//    echo "YES";
//else
//    echo "NO";
//?>
