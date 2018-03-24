@extends('layouts.app')


@section("content")
    {{getUser()->goals}}
@endsection
