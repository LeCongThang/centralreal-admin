@extends('backend.layout.master')
<?php

$isEdit = false;
?>
@section('title')
    CENTRARLEAL - Tin tức
@endsection
@section('content')
    @include('backend.news._form')
    <!-- Main content -->
@endsection
