@extends('layouts.admin')

@section('content')
    <div ng-controller="menuController" class="row">
        <div  style="width:100%;" class="card-box">
            <table class="table table-hover bls-adm-menu">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Level</th>
                    <th>Sort</th>
                    <th>Url</th>
                    <th>Del</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-class="{'bg-primary': item.id == Menu.selectedItem.id, 'level-@{{item.lavel}}' : item.level > 0}" ng-model="Menu.items" ng-repeat="item in Menu.items | orderBy: '+sort'">
                    <th>
                        <input type="text" class="form-control col-xs-2" ng-model="item.name" value="@{{item.name}}">
                    </th>
                    <td>
                        <select
                                class="form-control"
                                ng-model="item.level"
                                ng-options="c.value as c.label for c in Menu.levels">
                        </select>
                    </td>
                    <td>
                        <input type="number" class="form-control col-xs-2" ng-model="item.sort" value="@{{item.sort}}">
                    </td>
                    <td>
                        <input type="text" class="form-control col-xs-2" ng-model="item.url" value="@{{item.url}}">
                    </td>
                    <td>
                        <button class="btn bg-danger" ng-click="remove(item)">remove</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>



        <div id="addForm" ng-class="{'show': Menu.showAddForm, 'hide' : !Menu.showAddForm}" style="width:100%;" class="card-box addformBox">
            <form action="#" data-parsley-validate novalidate>
                <div class="form-group">
                    <label for="fName">Name</label>
                    <input ng-model="Menu.AddForm.name" id="fName" type="text" name="name" required
                           placeholder="Enter name item" class="form-control">
                </div>
                <div class="form-group">
                    <label for="fLevel">Level</label>
                    <select
                            class="form-control"
                            ng-model="Menu.AddForm.level"
                            ng-options="c.value as c.label for c in Menu.levels">
                    </select>
                </div>
                <div class="form-group">
                    <label for="fSort">Sort</label>
                    <input ng-model="Menu.AddForm.sort" id="fSort" type="number" placeholder="Enter sort item" required
                           class="form-control">
                </div>
                <div class="form-group">
                    <label for="fUrl">Url</label>
                    <input ng-model="Menu.AddForm.url" id="fUrl" type="text" required
                           placeholder="Enter url item" class="form-control">
                </div>
                <div class="form-group text-right m-b-0">
                    <div ng-click="sendAddForm()" class="btn btn-primary waves-effect waves-light" >
                        Add Item
                    </div>
                </div>
            </form>
        </div>



    </div>
@endsection


@section('css')
    <style>


        .min-width {
            width: 105px;
        }

        .footer {
            position: fixed;
            background-color: #fff;
        }
        th,
        td {
            vertical-align: middle !important;
        }

        th.select{
            width: 60px;
        }

        th.select input{
            cursor: pointer;
        }

        .addformBox.hide {
            display: none;
        }
        .addformBox.show {
            display: block;
        }

    </style>
@endsection

@section('js')
    <script>
        var Menu = {
            AddForm : { id : 0, name : "", level : 0, sort : 0,  url : "", },
            showAddForm: false,
            items : <?=$items?>
        }

        var addMenu = '{{ route("addMenu")}}';
        var deleteMenu = '{{ route("deleteMenu")}}';
        var updateMenu = '{{ route("updateMenu")}}';

    </script>
    <script src="/assets_adm/pages/menu.js?c=<?=rand(10000, 99999)?>"></script>
@endsection


@section('footer')

    <div ng-controller="menuController" >
        <div class="pull-left">
            <div class="col-xs-3">
                <span>Add menu items: </span>
                <a href="#addForm" ng-click="showAddForm();" type="button" class="btn btn-secondary waves-effect"><span class="ion-plus-round"></span></a>
            </div>
        </div>

        <div class="pull-right">
            <button ng-click="saveMenu();" type="button" class="btn btn-success waves-effect waves-light">Save</button>
        </div>
@endsection

