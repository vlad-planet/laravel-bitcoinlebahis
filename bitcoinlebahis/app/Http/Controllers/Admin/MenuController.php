<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;
use LaravelLocalization;

class MenuController extends Controller
{
    public function __construct()
    {
//        $this->middleware('admin');
    }

    public function index()
    {
        $lang = LaravelLocalization::getCurrentLocale();
        return view('admin.edit_menu', ['items' => Menu::where('lang',$lang)->orderBy('sort', 'asc')->get()->toJson(), 'lang' => $lang]);
    }

    public function update(Request $request)
    {
        $arMenuItems = json_decode($request->data, true);

        foreach ($arMenuItems as $item) {
            $obMenuItem = Menu::find($item["id"]);
            $obMenuItem->name = $item["name"];
            $obMenuItem->url = $item["url"];
            $obMenuItem->level = $item["level"];
            $obMenuItem->icon = $item["icon"];
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

        $sIcon = 0;
        if($request->input("icon"))
            $sIcon = $request->input("icon");

        $sSort = 1;
        if($request->input("sort"))
            $sSort = $request->input("sort");


        $obMenuItem = new Menu;
        $obMenuItem->name = $sName;
        $obMenuItem->lang = LaravelLocalization::getCurrentLocale();
        $obMenuItem->url = $sUrl;
        $obMenuItem->level = $sLevel;
        $obMenuItem->icon = $sIcon;
        $obMenuItem->sort = $sSort;
        $obMenuItem->save();

        return [
            "id"    => $obMenuItem->id,
            "name"  => $obMenuItem->name,
            "url"   => $obMenuItem->url,
            "sort"  => $obMenuItem->sort,
            "icon"  => $obMenuItem->icon,
            "level" => $obMenuItem->level,
        ];
    }


}
