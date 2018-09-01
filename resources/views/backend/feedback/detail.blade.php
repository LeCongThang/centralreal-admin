@extends('backend.layout.master')
<?php

$isEdit = true;
?>
@section('title')
    CENTRARLEAL - Phản hồi
@endsection
@section('content')
    @include('backend.feedback._form')
    <!-- Main content -->

@endsection
