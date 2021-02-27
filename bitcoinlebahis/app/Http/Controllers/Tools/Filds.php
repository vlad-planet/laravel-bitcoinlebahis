<?
namespace App\Http\Controllers\Tools;

class Filds
{
    static public function get($code)
    {
        $arSelect = ["id", "name", "code", "anonce", "rating", "image"];

        if($code == "coins")
            $arSelect = ["id", "name"];

        if($code == "wallets")
            $arSelect = array_merge($arSelect, ["ease_of_use", "anonymity", "coins", "platforms"]);

        if($code == "exchanges")
            $arSelect = array_merge($arSelect, ["type", "country"]);

        if($code == "reviews")
            $arSelect = array_merge($arSelect, ["bonus",]);

        return $arSelect;
    }
}
