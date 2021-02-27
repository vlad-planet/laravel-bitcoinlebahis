<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Resource;
use App\Type;
use Illuminate\View\View;
use App\Http\Controllers\Tools\Prepare;

class ResourceController extends Controller
{
    
    public function getFields($code)
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
    
    public function getByID($id)
    {
        if($id > 0) 
        {
            $arData["arResource"] = Resource::find($id);
        }
        else
        {
            
             $obNewRes = new Resource;
             $obNewRes->name = "New resource";
             $obNewRes->code = "new_resource";
             $obNewRes->rating = 0;
             $obNewRes->type = 1;
             $obNewRes->sort = 500;
             $arData = ["arResource" => $obNewRes];
        }
                
        
        $arData["arResourceTypes"] = Type::all();
        $arData["arDisplayProps"] = [];
        
        foreach ($arData["arResourceTypes"] as $key => $item) {            
            if($item["id"] == $arData["arResource"]["type"])
                $arData["arDisplayProps"] = explode(",", $item["fields"]); 
        }
       
        return view('admin.edit_list_resource.blade.php', $arData);
    }
    
    
    public function showResourceAdmin($type, $id = 0){
        
        $obType = Type::where('id', '=', $type)->first();
        
        if(empty($obType))
            abort(404);
        
        if($id <= 0) 
        {
            $obNewRes = new Resource;
            $obNewRes->name = "New resource";
            $obNewRes->code = "new_resource";
            $obNewRes->rating = 0;
            $obNewRes->type = $type;
            $obNewRes->sort = 500;
            $arData = ["arResource" => $obNewRes];
        
        }
        else
        {
            $arResource = DB::table($obType->model)->where('id','=', $id)->first();             
            $arData =  ["arResource" =>  $arResource];     
                     
        }
                
        $arData["type"] = $obType;   
        
        $arTypes = [];
        $obTypes = Type::all();
        foreach ($obTypes as $obCurType) {
            $arTypes[$obCurType->id] = $obCurType;
        }
        $arFields = [];
        $columns = DB::select('show columns from ' . $obType->model);
        foreach ($columns as $value) {
           $arFields[] = ["name" => $value->Field, "type" => $value->Type, "requered" => $value->Null == "NO" ? 'Y' : 'N' ];
        }
        
        
        $arData["arFields"] = $arFields;
        $arData["arResourceTypes"] = $arTypes;
        return view("admin.edit_resource",  $arData);  
     }
    
    public function getResource($type, $code){
        
        $obType = Type::where('code', '=', $type)->first(); 

        if(empty($obType))
            abort(404);
    
        $obQuery = DB::table($obType->model)->where('code','=', $code);
           
         if($obType->model == "resource")
            $obQuery = $obQuery->where('resource.type','=', $obType->id);
          
        $arResource = $obQuery->first();
        
       
        if(empty($arResource))
            abort(404);
        
        return ["arResource" =>  $arResource, "type" => $obType]; 
    }
    
    
    public function showType(Request $request, $type) {
        $arData = $this->getType($request, $type);    
        if(view()->exists(strtolower("type.$type"))) 
            return view(strtolower("type.$type"), $arData);
        else return view("type.default", $arData);
    }
    
    public function showTypeAdmin(Request $request, $type) {
        $arData = $this->getType($request, $type);
        return view("admin.edit_list_resource",  $arData);   
    }
    
    
     
    
    public function showResource($type, $code){
        $arData = $this->getResource($type, $code);
        
        if(view()->exists(strtolower("resource.$type"))) 
            return view(strtolower("resource.$type"), $arData);
        else return view("resource.default", $arData);
    }
    
    
    public function getType(Request $request, $type) {
        
        $obType = Type::where('code', '=', $type)->first(); 
        
        $iOffset = 0;
        if(!empty($request->input("offset")))
            $iOffset = (int) $request->input("offset");
            
        $iLimit = 10;
        if(!empty($request->input("limit")))   
            $iLimit  = (int) $request->input("limit");
        
        if(empty($obType))
            abort(404);
        
        $arSelect = $this->getFields($obType->model);
        
        if(!empty($request->input("select")))   
            $arSelect = explode(",", $request->input("select"));
        
        $obQuery = DB::table($obType->model)->select($arSelect);
        
        if($obType->model == "resource")
            $obQuery = $obQuery->where('resource.type','=', $obType->id);
        
        
        $arItems = $obQuery
            ->offset($iOffset)
            ->limit($iLimit)
            ->get();
                
        if(empty($arItems))
            abort(404);
        
        return ["arList" => $arItems, "type" => $obType];
    }
     
     
    public function remove(Request $request)
    {
        
        if(empty($request->input("id")))
            return false;
        
        $obQuery = DB::table($request->input("type"))->where('id','=', $request->input("id"))->delete(); 
    } 
    
    public function update(Request $request)
    {
        
        
         if(empty($request->input("type")))
            return  ["error" => ""];  
       
        $arData = $request->all();

        $obType = Type::where('id', '=', $request->input("type"))->first(); 
        
        $typeId = $obType->id;
        $resourceId = 0;
        if($request->input("id"))
            $resourceId = $request->input("id");
        
        $arFilds = DB::getSchemaBuilder()->getColumnListing(strtolower($obType->model));
        
        $arUpdate = [];
        foreach ($arData as $propName => $value) {
            if(!in_array($propName, $arFilds) || $propName == "id" || stripos($propName, "image") === 0)
                continue;
            $arUpdate[$propName] = $value;
        } 
        
        if($resourceId > 0)
        {
            $redirect = false;
            DB::table($obType->model)
                ->where('id', $resourceId)
                ->update($arUpdate);
        }
        else
        {
            $redirect = true;
            $resourceId = DB::table($obType->model)->insertGetId($arUpdate);
        }
        
        
        $arUpdate = [];
        
        foreach ($request->file() as $inputName => $file) {
            $fileNameExt = $file->getClientOriginalName();
            $fileName = pathinfo($fileNameExt, PATHINFO_FILENAME);
            $fileExt = $file->getClientOriginalExtension();
            $fileNameToStore = $inputName.".".$fileExt;
            $sPath = "/files/resources/{$typeId}/{$resourceId}";
            $pathToStore = $file->storeAs("/public".$sPath, $fileNameToStore);     
            $arUpdate[$inputName] = "/storage".$sPath."/".$fileNameToStore;
        }
        
        if( !empty($arUpdate) ) DB::table($obType->model)->where('id', $resourceId)->update($arUpdate);    
        
        return redirect("/dashboard/editResource/$typeId/$resourceId")->with('status', 'updated');
    }
    
    


}
