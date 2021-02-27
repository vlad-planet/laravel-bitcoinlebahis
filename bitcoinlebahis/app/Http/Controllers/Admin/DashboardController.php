<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Resource;
use App\Type;
use App\Reviews;
use Illuminate\View\View;
use App\Http\Controllers\Tools\Prepare;
use App\Http\Controllers\Tools\Filds;
use Image;
use File;
use LaravelLocalization;

class DashboardController extends Controller
{
    public function __construct()
    {

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

    public function showTypeAdmin(Request $request, $type) {
        $arData = $this->getTypeAdmin($request, $type);
        return view("admin.edit_list_resource",  $arData);
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
//            $pathToStore = $file->storeAs("/public".$sPath, $fileNameToStore);

            $origPath = storage_path("app/public".$sPath);

            if(!File::exists($origPath)) File::makeDirectory($origPath, 0777, true);
            $pathToStore = Image::make($file)->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($origPath."/".$fileNameToStore);

            $arUpdate[$inputName] = $sPath."/".$fileNameToStore;

            $previewPath = storage_path("app/public/preview".$sPath);

            if(!File::exists($previewPath)) File::makeDirectory($previewPath, 0777, true);
            $pathToStore = Image::make($file)->resize(null, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($previewPath."/".$fileNameToStore);

        }

        if( !empty($arUpdate) ) DB::table($obType->model)->where('id', $resourceId)->update($arUpdate);

        //return redirect("/dashboard/resourceList/$codeId")->with('status', 'updated');
        return redirect("/dashboard/editResource/$typeId/$resourceId")->with('status', 'Success!');
    }

    public function getTypeAdmin(Request $request, $type) {

        $obType = Type::where('code', '=', $type)->first();

        $iOffset = 0;
        if(!empty($request->input("offset")))
            $iOffset = (int) $request->input("offset");

        $iLimit =9;
        if(!empty($request->input("limit")))
            $iLimit  = (int) $request->input("limit");

        if(empty($obType))
            abort(404);

//        $arSelect = $this->getFields($obType->model);
        $arSelect = Filds::get($obType->model);

        if(!empty($request->input("select")))
            $arSelect = explode(",", $request->input("select"));

        $obQuery = DB::table($obType->model)->where('lang',LaravelLocalization::getCurrentLocale())->select($arSelect);

        if($obType->model == "resource")
            $obQuery = $obQuery->where('resource.type','=', $obType->id);


        if($obType->model == "resource")
        {
            $countAll = DB::table($obType->model)->where("type", "=", $obType->id)->where('lang',LaravelLocalization::getCurrentLocale())->count();
        }
        else
        {
            $countAll = DB::table($obType->model)->where('lang',LaravelLocalization::getCurrentLocale())->count();
        }



        $arItems = $obQuery
            ->orderBy("id", "desc")
            ->offset($iOffset)
            ->limit($iLimit)
            ->get();

        if(empty($arItems))
            abort(404);

        return ["arList" => $arItems, "type" => $obType, "countAll" => $countAll, "offset" => $iOffset, "limit" => $iLimit];
    }

}
