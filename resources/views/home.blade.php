@extends('layouts.app')


@section("content")
    @php print_r(getCurrentUser()->goals)@endphp
@endsection
