@extends('layouts.admin')

@section('content')
    <div ng-controller="resourceListController" class="row" ng-cloak>

        <div style="width: 100%; display: flex; align-items: center;">
            <h1 style="margin: 0; margin-right: 20px;" ng-model="Resource.name">List @{{PageResources.type.name}} </h1>
            <a href="/{{LaravelLocalization::getCurrentLocale()}}/dashboard/editResource/@{{PageResources.type.id}}/0"
               class="btn btn-success">Add new @{{PageResources.type.name}}</a>
        </div>


        <?if(count($arList) > 0):?>
        <div style="width:100%; padding: 10px 10px 0 10px;" class="card">
            <table  id="tech-companies-1" class="table table-striped table-bordered">
                <thead class="thead-default">
                <tr>
                    <th>
                        <b>Id</b>
                    </th>
                    <th>Name</th>
                    <th>Url</th>
                    <th class="text-center">Ctrl</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="item in PageResources.items">
                    <td><b>@{{item.id}}</b></td>
                    <td>
                        <a href="/{{LaravelLocalization::getCurrentLocale()}}/dashboard/editResource/@{{PageResources.type.id}}/@{{item.id}}">@{{item.name}}</a></td>
                    <td><a href="/@{{PageResources.type.code}}/@{{item.code}}">/@{{PageResources.type.code}}/@{{item.code}}</td>
                    <td class="text-center"><button ng-click="fShow(item) " class="btn btn-danger waves-effect waves-light btn-sm" id="danger-alert"><i class="zmdi zmdi-delete"></i></button></td>
                </tr>
                </tbody>
            </table>
        </div>

        <div id="modaldel" style="display: none">
            <div class="sweet-overlay" tabindex="-1" style="opacity: 1.22; display: block;"></div>
            <div class="sweet-alert showSweetAlert visible" tabindex="-1" data-has-cancel-button="true" data-has-confirm-button="true" data-allow-ouside-click="false" data-has-done-function="false" data-timer="null" style="display: block; margin-top: -183px;">
                <div class="icon error animateErrorIcon" style="display: block;">
				<span class="x-mark animateXMark">
					<span class="line left"></span>
					<span class="line right"></span>
				</span>
                </div>
                <div class="icon warning" style="display: none;">
                    <span class="body"></span>
                    <span class="dot"></span>
                </div>
                <div class="icon info" style="display: none;"></div>
                <div class="icon success" style="display: none;">
                    <span class="line tip"></span>
                    <span class="line long"></span>
                    <div class="placeholder"></div>
                    <div class="fix"></div>
                </div>
                <div class="icon custom" style="display: none;"></div>
                <h2>Вы точно хотите удалить материал?</h2>
                <p class="lead text-muted" style="display: block;">Вы удалите материал из базы</p>
                <p>
                    <a ng-click="fClose()" href="#"><button class="cancel btn btn-lg btn-secondary waves-effect" tabindex="2" style="display: inline-block;">Закрыть</button></a>
                    <a ng-click="remove(currentItem); fClose()" href="#"><button class="confirm btn btn-lg btn-danger waves-effect waves-light" tabindex="1" style="display: inline-block;">Удалить</button></a>
                </p>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <?
                if($countAll > $limit):?>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <?if($offset!=0):?>
                        <li class="page-item"><a href="?offset=<?echo $offset-$limit;?>&limit=<?echo $limit?>" class="page-link">«</a></li>
                        <?endif;?>
                        <?
                        $curOffset = 0;
                        $curItem = 1;
                        while ($curOffset < $countAll) {
                        $isActive = ($curOffset == $offset);
                        ?>
                        <?if($isActive):?>
                        <li class="page-item active">
                            <span class="page-link">{{$curItem}}<span class="sr-only">(current)</span></span>
                        </li>
                        <?else:?>
                        <li class="page-item">
                            <a href="?offset=<?echo $curOffset;?>&limit=<?echo $limit?>" class="page-link">{{$curItem}}</a>
                        </li>
                        <?endif;?>
                        </li>
                        <?
                        $curOffset+=$limit;
                        $curItem++;
                        }
                        if(($offset+$limit) < $countAll):?>
                        <li class="page-item"><a href="?offset=<?echo $offset+$limit;?>&limit=<?echo $limit?>" class="page-link">»</a></li>
                        <?endif;?>
                    </ul>
                </nav>
                <?endif;?>
            </div>
        </div>

        <?else:?>

        <p>Для языка {{ LaravelLocalization::getCurrentLocaleName() }} у вас пока ещё нет ни одного материала в этом разделе.</p>

        <?endif;?>
    </div>





@endsection




@section('css')
    <link rel="stylesheet" href="{{ asset('assets_adm/ckeditor/samples/css/samples.css')}}">
    <link rel="stylesheet" href="{{ asset('assets_adm/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/preloader.min.css?c=1')}}">
    <style>
        .content input[type="text"], .content input[type="number"], .content select{
            height: 40px;
        }

    </style>
@endsection

@section('js')
    <script>
        mainApp.controller("resourceListController", function ($scope, $http, $document) {
            $scope.PageResources = {};
            $scope.PageResources.type  = {!! $type !!}
                $scope.PageResources.items = {!! $arList !!};
            $scope.currentItem = {};
            $scope.deleteResource = '{{ route("deleteResource") }}'

            $scope.remove = function(item)
            {
                //console.log(item, $scope.PageResources.type.model);
                var index = $scope.PageResources.items.indexOf(item);
                $http.post($scope.deleteResource,  {"type": $scope.PageResources.type.model, "id" : item.id}, {}).then(function(responce){
                        //$scope.PageResources.items.splice(index, 1);
                        location.reload();
                    }, function(data){
                        console.log("error", data);
                    }
                );

            }
            $scope.fShow = function(item){
                document.getElementById("modaldel").style.display = "block";
                $scope.currentItem = item;
            }
            $scope.fClose = function(){
                document.getElementById("modaldel").style.display = "none";
                //location.reload();

            }

        });

    </script>

@endsection


@section('footer')
@endsection

