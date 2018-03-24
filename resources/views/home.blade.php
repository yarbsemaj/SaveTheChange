@extends('layouts.sidebar')

@section('panel_left')
    <h1 class="text-center">{{_t("Welcome to :name",["name"=>config('app.name', 'Pre-Empt 2')] )}}</h1>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-10">
                    <h3 style="margin-top: 0px">{{_t("Start a new session or retrieve a previous session")}}</h3>
                </div>
                <div class="col-lg-2">
                    <a href="{{route("runthrough_settings")}}" class="btn btn-primary btn-lg">
                        {{_t("Start")}}
                        <i class="fas fa-chevron-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection()
@php $sidebar = true @endphp
@section("sidebar")
    <div class="panel panel-info">
        <div class="panel-heading"><h4 class="panel-title">{{_t("Started Sessions")}}</h4></div>
        <div class="panel-body">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>{{_t("Name")}}</th>
                    <th>{{_t("User")}}</th>
                    <th>{{_t("Date")}}</th>
                </tr>
                </thead>
                @foreach($runthroughs as $runthrough)
                    <tr>
                        <td>
                            {{$runthrough->runthroughSetting->name}}
                            <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus"
                               title="{{_t("More Information")}}"
                               data-content="{{$runthrough->runthroughSetting->description}}"><i
                                        class="fas fa-info-circle"></i></a>
                        </td>
                        <td>
                            {{$runthrough->user->name}}
                        </td>
                        <td>
                            <a href="{{route("runthrough.part_2.jumpIn",["id"=>$runthrough->id])}}">
                                {{_t($runthrough->created_at->diffForHumans())}}</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
