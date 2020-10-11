@extends('layouts.app')

@section('content')
@push('css')
    <link href="{{asset('css/style.css')}}" rel="stylesheet" />
@endpush

<a href="#"><button type="submit" id="go-back"class="go-back btn btn-primary">ADD PRODUCT</button></a>



@endsection
