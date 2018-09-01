@extends('backend.layout.master')

<?php
$isEdit = true;
?>
@section('title')
    CENTRARLEAL - Quản trị
@endsection
@section('content')
    <div class="user-edit">
        @include('backend.user._form')
    </div>
@endsection