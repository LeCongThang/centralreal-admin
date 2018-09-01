@extends('backend.layout.master')
<?php

$isEdit = false;
?>
@section('title')
    CENTRARLEAL - Gallery
@endsection
@section('content')
    @include('backend.gallery._form')
    <!-- Main content -->
@endsection
