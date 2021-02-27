<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;

class MenuController extends Controller
{
    
    public function index()
    {
        return view('admin.edit_menu', ['items' => Menu::orderBy('sort', 'asc')->get()->toJson()]);
    }
    
    
    public function update(Request $request)
    {
        $arMenuItems = json_decode($request->data, true);
        
        foreach ($arMenuItems as $item) {
             $obMenuItem = Menu::find($item["id"]);
             $obMenuItem->name = $item["name"];
             $obMenuItem->url = $item["url"];
             $obMenuItem->level = $item["level"];
             $obMenuItem->sort = $item["sort"];
             $obMenuItem->save();
        }
        
    }
    
    
    public function remove(Request $request)
    {
         if(empty($request->input("id")))
            return false;
         
        $item = Menu::find($request->input("id"));    
        $item->delete();
         
    }
    
    
    
    public function add(Request $request)
    {
        
        $sName = "";
        if($request->input("name"))
            $sName = $request->input("name");
        
        $sUrl = "";
        if($request->input("url"))
            $sUrl = $request->input("url");
        
        $sLevel = 0;
        if($request->input("level"))
            $sLevel = $request->input("level");
        
        $sSort = 1;
        if($request->input("sort"))
            $sSort = $request->input("sort");
        
        
         $obMenuItem = new Menu;
         $obMenuItem->name = $sName;
         $obMenuItem->url = $sUrl;
         $obMenuItem->level = $sLevel;
         $obMenuItem->sort = $sSort;
         $obMenuItem->save();
         
         return [
            "id"    => $obMenuItem->id,
            "name"  => $obMenuItem->name,
            "url"   => $obMenuItem->url,
            "sort"  => $obMenuItem->sort,
            "level" => $obMenuItem->level,
         ];
    }
    
    
}
