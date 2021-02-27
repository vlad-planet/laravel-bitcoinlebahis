<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Resource;
use App\Coins;
use App\Type;
use Illuminate\View\View;

class CoinsController extends Controller
{
    
    public function index()
    {
       return view("type.coins");
    }
    
    
    public function getList(Request $request)
    {
        
        $iOffset = 0;
        if(!empty($request->input("page")))
            $iOffset = (int) $request->input("page");
            
        $iLimit = 30;
        if(!empty($request->input("limit")))   
            $iLimit  = (int) $request->input("limit");
           
        $sJson = file_get_contents("https://min-api.cryptocompare.com/data/top/totalvol?limit=".$iLimit."&page=".$iOffset."&tsym=USD");
        $arData = json_decode($sJson, true);
        if (json_last_error() !== JSON_ERROR_NONE || empty($arData["Data"]) || !is_array($arData["Data"]))
            return ["Data" => []];
        
        foreach ($arData["Data"] as $key => $arItem) {
            
            $arData["Data"][$key]["CoinInfo"]["Url"] = $arItem["CoinInfo"]["Name"]."-".str_replace(" ", "-",  $arItem["CoinInfo"]["FullName"]);
            
            $sVolume = "-"; 
            if(!empty($arItem["ConversionInfo"]["RAW"][0])){
                $arRaw =  explode("~", $arItem["ConversionInfo"]["RAW"][0]);
                $sPrice = $arRaw[5];
            }
            
            $arData["Data"][$key]["PRICE_USD"]["PRICE"] = $sPrice;
        };
        
        return  $arData;
        
    }


      

    
    public function getInfo($id)
    {
        
        $sJson  = file_get_contents("https://www.cryptocompare.com/api/data/coinsnapshotfullbyid/?id=".$id);
        $arData = json_decode($sJson, true); 
        
        if (json_last_error() !== JSON_ERROR_NONE || empty($arData["Data"]["General"]) || !is_array($arData["Data"]["General"]))
            return ["Data" => []];
        
        return $arData["Data"]["General"];
        
    }
      
    public function showCoin($id)
    {
        $obCoin = Coins::where("Id", "=", $id)->first();
        if($obCoin && strtotime($obCoin->updated_at) < time() + 3600){
                  
        }else{
           
           $arCoin = $this->getInfo($id);
           
           $bNewCoin = $obCoin === NULL;
           
           if($bNewCoin)
                $obCoin = new Coins(); 
           
           
           //return $arCoin;
           
           if(!empty($arCoin["AffiliateUrl"]))
               $obCoin->AffiliateUrl = $arCoin["AffiliateUrl"];
           
           if(!empty($arCoin["Algorithm"]))
               $obCoin->Algorithm = $arCoin["Algorithm"];
    
           if(!empty($arCoin["BlockNumber"]))
              $obCoin->BlockNumber = $arCoin["BlockNumber"];
           
           if(!empty($arCoin["BlockReward"]))
               $obCoin->BlockReward = $arCoin["BlockReward"];
           
           if(!empty($arCoin["BlockRewardReduction"]))
               $obCoin->BlockRewardReduction = $arCoin["BlockRewardReduction"];
           
           if(!empty($arCoin["BlockRewardReduction"]))
               $obCoin->BlockTime = $arCoin["BlockRewardReduction"];
           
           if(!empty($arCoin["DangerTop"]))
               $obCoin->DangerTop = $arCoin["DangerTop"];
           
           if(!empty($arCoin["DifficultyAdjustment"]))
               $obCoin->DifficultyAdjustment = $arCoin["DifficultyAdjustment"];
           
           if(!empty($arCoin["DocumentType"]))
               $obCoin->DocumentType = $arCoin["DocumentType"];
           
           if(!empty($arCoin["H1Text"]))
               $obCoin->H1Text = $arCoin["H1Text"];
           
           if(!empty($arCoin["ImageUrl"]))
               $obCoin->ImageUrl = $arCoin["ImageUrl"];
           
           if(!empty($arCoin["InfoTop"]))
               $obCoin->InfoTop = $arCoin["InfoTop"];
           
           if(!empty($arCoin["LastBlockExplorerUpdateTS"]))
               $obCoin->LastBlockExplorerUpdateTS = $arCoin["LastBlockExplorerUpdateTS"];
          
          if(!empty($arCoin["Name"]))
               $obCoin->Name = $arCoin["Name"];
           
           if(!empty($arCoin["NetHashesPerSecond"]))
               $obCoin->NetHashesPerSecond = $arCoin["NetHashesPerSecond"];
           
           if(!empty($arCoin["PreviousTotalCoinsMined"]))
               $obCoin->PreviousTotalCoinsMined = $arCoin["PreviousTotalCoinsMined"];
           
           if(!empty($arCoin["ProofType"]))
               $obCoin->ProofType = $arCoin["ProofType"];
           
           if(!empty($arCoin["StartDate"]))
               $obCoin->StartDate = $arCoin["StartDate"];
           
           if(!empty($arCoin["Symbol"]))
               $obCoin->Symbol = $arCoin["Symbol"];
           
           if(!empty($arCoin["TotalCoinSupply"]))
               $obCoin->TotalCoinSupply = $arCoin["TotalCoinSupply"];
           
           if(!empty($arCoin["TotalCoinsMined"]))
               $obCoin->TotalCoinsMined = $arCoin["TotalCoinsMined"];
           
           if(!empty($arCoin["Twitter"]))
               $obCoin->Twitter = $arCoin["Twitter"];
           
           if(!empty($arCoin["Url"]))
               $obCoin->Url = $arCoin["Url"];
           
           if(!empty($arCoin["WarningTop"]))
               $obCoin->WarningTop = $arCoin["WarningTop"];
           
           if(!empty($arCoin["Website"]))
               $obCoin->Website = $arCoin["Website"];
           
           $obCoin->Id = $arCoin["Id"];
               
           
           if($bNewCoin) {
               $obCoin->title = "Default title";
               $obCoin->description = "Default description"; 
               $obCoin->text = "Default text";
           }
           
           $obCoin->save();    
        }
        
        return view("resource.coins", ["arResource" => $obCoin]);
           
    }

}
