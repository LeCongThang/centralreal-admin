@extends('backend.layout.master')

<?php
$isEdit = false;
?>
@section('title')
    The Five - Quản trị
@endsection
@section('content')
    <div class="user-create">
        @include('backend.user._form')
    </div>
@endsection