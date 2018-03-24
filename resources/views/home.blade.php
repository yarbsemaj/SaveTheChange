@extends('layouts.app')


@section("content")
    {{getCurrentUser()->goals}}
@endsection
