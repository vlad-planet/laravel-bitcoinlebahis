<?
/*1. Anasayfa
2. Bitcoinle Bahis
    2.1 Bitcoin ile 1xBIT'e Yatırım ve Çekim İşlemleri
    2.2 En Kolay Nasıl Bitcoin Alırım?
    2.3 Neden Bitcoinle Bahis Yapmalıyım?
3. Diğer Kripto Paralar
    3.1 Ethereum
    3.2 Litecoin
    3.3 Dogecoin
    3.4 Monero
4. Bitcoin SSS
5. Bitcoin Çevirici
6. İletişim
*/

use App\Menu;
$arResult = Menu::orderBy("sort", "ASC")->get(["id", "name", "level", "url", "icon"])->toArray();
$arMenu = []; $previousLevel = $i = 0;
foreach ($arResult as $arItem) {
    if($arItem["level"] >  0 ) //&& $previousLevel <= $arItem["level"]
    {
        $arMenu[$i-1]["items"][] = $arItem;    
    }
    else
    {
        $arMenu[$i] = $arItem;
        $i++;
    } 
    $previousLevel = $arItem["level"];
}?>


 <!-- Navigation Menu-->
    <ul class="navigation-menu">
        <?foreach($arMenu as $arItem):?>
            <li class="has-submenu">
                <a href="<?=(!empty($arItem["url"])) ? $arItem["url"] : "#";?>"><i class="<?=(!empty($arItem["icon"])) ? $arItem["icon"] : "zmdi zmdi-view-list";?>"></i> <span><?=$arItem["name"]?></span></a>                        
                <?if(!empty($arItem["items"])):?>
                    <ul class="submenu">
                         <?foreach($arItem["items"] as $arSubItem):?>
                            <li><a href="<?=(!empty($arSubItem["url"])) ? $arSubItem["url"] : "#";?>"><?=$arSubItem["name"]?></a></li>
                         <?endforeach;?>                   
                    </ul>
                <?endif;?>
            </li>
        <?endforeach;?>
        
        <?/*
        <li class="has-submenu">
            <a href="#"><i class="zmdi zmdi-money"></i> <span>Bitcoinle Bahis</span></a>                        <?//Ставки с биткойном?>
            <ul class="submenu">
                <li><a href="/page1">Bitcoin ile 1xBIT'e Yatırım ve Çekim İşlemleri</a></li>                    <?//Инвестирование и съемка в 1xBIT с биткойном?>
                <li><a href="/page2">En Kolay Nasıl Bitcoin Alırım?</a></li>                                    <?//Самый простой способ получить биткойн??>
                <li><a href="/page3">Neden Bitcoinle Bahis Yapmalıyım?</a></li>                                 <?//Почему я должен делать ставки на Биткойн??>
            </ul>
        </li>
        <li class="has-submenu">
            <a href="#"><i class="zmdi zmdi-collection-text"></i><span>Diğer Kripto Paralar</span></a>          <?//Другие Crypto Money?>
            <ul class="submenu">
                <li><a href="/page4">Ethereum</a></li>
                <li><a href="/page5">Litecoin</a></li>
                <li><a href="/page6">Dogecoin</a></li>
                <li><a href="/page7">Monero</a></li>
            </ul>
        </li>

        <li>
            <a href="/page8"><i class="zmdi zmdi-format-list-bulleted"></i><span>Bitcoin SSS</span></a>         <?//Часто задаваемые вопросы о биткойне?>
        </li>

         <li>
            <a href="/page9"><i class="zmdi zmdi-format-list-bulleted"></i><span>Bitcoin Çevirici</span></a>    <?//Конвертер биткойнов?>
        </li>

         <li>
            <a href="/page10"><i class="zmdi zmdi-format-list-bulleted"></i><span>İletişim</span></a>            <?//Контакты?>
        </li> */?>

    </ul>
    <!-- End navigation menu  -->
    
