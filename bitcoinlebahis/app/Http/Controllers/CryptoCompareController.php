<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Coins;

class CryptoCompareController extends Controller
{
    public function getHistory($currency1, $currency2)
    {
            
        $sJson = file_get_contents("https://min-api.cryptocompare.com/data/histohour?aggregate=1&e=CCCAGG&extraParams=CryptoCompare&fsym={$currency1}&limit=24&tryConversion=false&tsym={$currency2}");

        $arResult = json_decode($sJson, true);
        if (json_last_error() !== JSON_ERROR_NONE || empty($arResult) || !is_array($arResult))
            return ["Data" => []];
        
        $iFirstElement = $arResult["Data"][0]["close"];
        $iLastElement = $arResult["Data"][count($arResult["Data"]) - 1]["close"];
        
        $iFirstOneProsent =  $iFirstElement / 100;
        $iDiff =  $iFirstElement - $iLastElement;
        $iProsent =  round ($iDiff / $iFirstOneProsent, 2);
        $bGrowth = ($iLastElement > $iFirstElement);
        
        $arResult["CurrencyPair"] = array(
            "name" => "{$currency1}-{$currency2}",
            "value" => intval($iLastElement),
            "growth" => $bGrowth,
            "prosent" => ($bGrowth ? "+" : "-" ).abs($iProsent)."%",
        );
        
        
        return $arResult;
    }
    
    public function getCourse()
    {
        $sData = file_get_contents("https://api.exmo.com/v1/ticker/");
        return $sData;
    }
    
    public function streamer()
    {
        return view('streamer');
    }
    
    
    public function getCoinList(){
       
        $sJson = file_get_contents("https://www.cryptocompare.com/api/data/coinlist/");
        $arData = json_decode($sJson, true);
        if (json_last_error() !== JSON_ERROR_NONE || empty($arData["Data"]) || !is_array($arData["Data"]))
            return [];
        
        
         foreach ($arData["Data"] as $key => $arItem) {
             
             $arInsert[] = [
                "Algorithm" => $arItem["Algorithm"],
                "CoinName" => $arItem["CoinName"],
                "FullName" =>  $arItem["FullName"],
                "FullyPremined" =>  $arItem["FullyPremined"],
                "CryptocompareId" => $arItem["Id"],
                "ImageUrl" =>  !empty($arItem["ImageUrl"]) ? $arItem["ImageUrl"] : "",
                "Name" => $arItem["Name"],
                "PreMinedValue" => $arItem["PreMinedValue"],
                "ProofType" => $arItem["ProofType"],
                "SortOrder" => $arItem["SortOrder"],
                "Sponsored" => $arItem["Sponsored"],
                "Symbol" => $arItem["Symbol"],
                "TotalCoinSupply" => $arItem["ProofType"],
                "TotalCoinsFreeFloat" => $arItem["TotalCoinsFreeFloat"],
                "Url" => $arItem["Url"],
                "seo_title" => "",
                "seo_description" => "",
                "anonce" => "",
                "text" => "",
                "rating" => 0,
                "code" => $arItem["Symbol"],
            ];
             
         }   

        //Coins::insert($arInsert); // Eloquent approach
        
        return $arInsert;
    }
    
    public function getOldPriceList()
    {   
        $sJson = file_get_contents("https://www.cryptocompare.com/api/data/toplistvolumesnapshot/?limit=ALL&symbol=usd");
        
        // /return $sJson;
        
        $arData = json_decode($sJson, true);
        
        if (json_last_error() !== JSON_ERROR_NONE || empty($arData["Data"]) || !is_array($arData["Data"]))
            return ["Data" => []];
        
        $arResult = [];    
        foreach ($arData["Data"] as $key => $sItem) {
            $arItem =  explode("~", $sItem);
            $arResult[$arItem[2]] = [
                "FromCurrency" => $arItem[2],
                "ToCurrency" =>  $arItem[3],
                "Price" => $arItem[5],
                "LastUpdate" => $arItem[6],
            ];
        };
        
        return $arResult;
        
    }
    
    
    public function getPriceList(Request $request)
    {
        
        $iOffset = 0;
        if(!empty($request->input("page")))
            $iOffset = (int) $request->input("page");
            
        $iLimit = 100;
        if(!empty($request->input("limit")))   
            $iLimit  = (int) $request->input("limit");
           
        $sJson = file_get_contents("https://min-api.cryptocompare.com/data/top/totalvol?limit=".$iLimit."&page=".$iOffset."&tsym=USD");
        $arData = json_decode($sJson, true);
        if (json_last_error() !== JSON_ERROR_NONE || empty($arData["Data"]) || !is_array($arData["Data"]))
            return ["Data" => []];
        foreach ($arData["Data"] as $key => $arItem) {
            $sVolume = "-"; 
            if(!empty($arItem["ConversionInfo"]["RAW"][0])){
                $arRaw =  explode("~", $arItem["ConversionInfo"]["RAW"][0]);
                $sVolume = $arRaw[5];
            }
            $arData["Data"][$key]["ConversionInfo"]["currentVolume"] = $sVolume;
        };
        
        return  $arData["Data"];
        
    }
    
    

}
