@extends('layouts.admin')

@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div ng-controller="resourceController" ng- class="row" ng-cloak>

        <h1 style="margin: 0;" ng-model="Resource.name">Resource: @{{Resource.name}}</h1>
        <div style="width:100%;" class="card-box">
            <form id="editForm" data-sel-preloader-content class="form-horizontal" method="POST"
                  action="{{ route('saveResource') }}" enctype="multipart/form-data">

                {{ csrf_field() }}

                <?if(!isset($arResource->id)):?>
                <div class="form-group">
                    <label>Type</label>
                    <select
                            style="display:block; width:100%;"
                            name="type"
                            ng-model="currentType"
                            ng-options="type.name for type in resourceTypes track by type.id"
                            ng-change="changeType()">
                    </select>
                </div>
                <?
                endif;?>

                <?
                foreach($arFields as $arField):

                if (in_array($arField["name"], ["id", 'type', 'created_at', 'updated_at']))
                    continue;

                $label = __("labels." . $arField["name"]);
                if ($type->code == "Ad" && $arField["name"] == "code")
                    $label = __("labels." . "addlink");

                $value = $arResource->{$arField["name"]};
                $requered = ($arField["requered"] == "Y" && empty($value)) ? "required" : ""; if ($arField["name"] == 'text'):?>


                <div class="form-group">
                    <label>{{$label}}</label>
                    <div id="editor"></div>
                    <input type="hidden" name="<?=$arField["name"]?>">
                </div>
                <?elseif($arField["name"] == 'anonce'):?>
                <div class="form-group">
                    <label>{{$label}}</label>
                    <div>
                        <textarea <?=$requered?> ng-model="Resource.<?=$arField["name"]?>" name="<?=$arField["name"]?>" class="form-control"
                                  placeholder="Type <?=$label?>"></textarea>
                    </div>
                </div>
                <?elseif(stripos(strtolower($arField["name"]), "image") === 0):
                ?>
                <div class="form-group">
                    <label>{{$label}}</label><br/>


                    <?if(!empty($value)):?>
                    <img src="/storage/public/preview<?=$value?>" height="100"><br/>
                    <?endif;?>

                    <input type="file" name="<?=$arField["name"]?>" <?=$requered?>>
                </div>


                <?else:?>
                <?if($arField["name"] != 'lang'):?>
                <div class="form-group">
                    <label>{{$label}}</label>
                    <input <?=$requered?> ng-model="Resource.<?=$arField["name"]?>" name="<?=$arField["name"]?>" type="text" class="form-control"
                           placeholder="Type <?=$label?>">
                </div>
                <?endif?>
                <?endif?>

                <?endforeach?>
                <input type="hidden" name="lang" value="{{LaravelLocalization::getCurrentLocale()}}">
                <input type="hidden" name="type" value="<?=$type->id?>">
                <input type="hidden" name="id" value="<?=(isset($arResource->id)) ? $arResource->id : 0?>">

                <div class="form-group">
                    <div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            Save
                        </button>
                    </div>
                </div>
            </form>


        </div>

    </div>
@endsection


@section('css')
    <link rel="stylesheet" href="{{ asset('assets_adm/ckeditor/samples/css/samples.css')}}">
    <link rel="stylesheet" href="{{ asset('assets_adm/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/preloader.min.css?c=1')}}">
    <style>
        .content input[type="text"], .content input[type="number"], .content select {
            height: 40px;
        }

        .content form label {
            text-transform: capitalize;
        }

    </style>
@endsection

@section('js')
    <script src="{{ asset('assets_adm/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets_adm/ckeditor/samples/js/sample.js') }}"></script>
    <script src="/assets_adm/pages/resource.js?c=<?=rand(10000, 99999)?>"></script>
    <script src="/assets/js/preloader.js?>"></script>
    <script>
        initSample();
        var Resource = <?=json_encode($arResource)?>;
        var ResourceTypes = <?=json_encode($arResourceTypes)?>;
        CKEDITOR.instances.editor.setData(Resource.text);

        $(document).on('submit', '#editForm', function (e) {

            obForm = $('#editForm');
            obTitle = obForm.find("input[name = title]");
            obDesc =  obForm.find("input[name = description]");
            if(obTitle.val() == "")
            {
                obTitle.val(obForm.find("input[name = name]").val());
            }
            if(obDesc.val() == "")
            {
                obDesc.val(obForm.find("textarea[name = anonce]").val());
            }

            ob = $($("<div/>").append(CKEDITOR.instances.editor.getData()));
            ob.find("a").each(function (index, value) {
                link = $(value);
                href = link.attr("href");
                host = window.location.hostname;
                if( href.indexOf("http") == -1 ||
                    href.indexOf("http://" + host) == 0 ||
                    href.indexOf("https://" + host) == 0 )
                    return true;

                if (link.attr("rel") == undefined)
                    link.attr("rel", "nofollow");
                if (link.attr("target") == undefined)
                    link.attr("target", "_blank");
            });
            CKEDITOR.instances.editor.setData(ob.html());
            $('input[name=text]').val(ob.html());
        });
    </script>
    <!-- Toastr js -->
    <script src="assets/plugins/toastr/toastr.min.js"></script>
    {{--<script src="{{ asset('assets_adm/plugins/toastr/toastr.min.js') }}"></script>--}}
@endsection


@section('footer')




@endsection

