<?
use App\Type;
$obTypes = Type::all();
?>
<ul>
    <li class="has_sub">
        <a href="/dashboard" <?// old: /dashboard/editMenu?> class="waves-effect<?if($_SERVER['REQUEST_URI'] == 'editMenu' || $_SERVER['REQUEST_URI'] == '/dashboard'):?> active<?endif;?>"><i class="zmdi zmdi-format-list-bulleted"></i> <span> Menu </span></a>
    </li>

    <li class="has_sub sub"><?
        $openResourceList = false;
        if(strpos($_SERVER['REQUEST_URI'], "/dashboard/resourceList/") !== false || strpos($_SERVER['REQUEST_URI'], "/dashboard/editResource/")  !== false)
        $openResourceList = true;?>

        <a href="javascript:void(0);" class="waves-effec<?=($openResourceList) ? " subdrop" : "";?>"><i class="zmdi zmdi-collection-item"></i><span> Resources </span> <span class="menu-arrow"></span></a>
        <ul <?=($openResourceList) ? 'style="display: block;"' : '';?>>
            <li class="text-muted menu-title">Resource List</li> <?/*Go too resources*/?>
            <?foreach($obTypes as $arType):
            $active = "";
            if(strpos($_SERVER['REQUEST_URI'], "/dashboard/resourceList/".$arType->code) !== false || strpos($_SERVER['REQUEST_URI'], "/dashboard/editResource/".$arType->id."/")  !== false)
            $active = 'class="active"';?>
            <li <?=$active?>><a href="/dashboard/resourceList/<?=$arType->code?>"><?=$arType->name?></a></li>
            <?endforeach;?>
        </ul>
    </li>

</ul>