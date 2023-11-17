@extends('layouts.master')

@section('title', translate('category'))
@section('css')
@endsection

@section('breadcrumb')
<div class="col-sm-6">
    <h4 class="page-title text-left"><?php echo translate('category'); ?></h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('category.index')}}"><?php echo translate('category') ?></a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);"><?php echo translate('category') ?></a></li>

    </ol>
</div>
@endsection
@section('button')
<a href="{{route('category.index')}}" class="btn btn-primary"><?php echo translate('backBtn') ?></a>

@endsection

@section('content')
@include('includes.flash')
    <!--Show Validation Errors here-->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!--End showing Validation Errors here-->
    <?php
        // echo "<pre>";
        // print_r($category);
        // echo "</pre>";
    ?>

    <div class="row">
        <div class="col-8 mx-auto">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <?php echo translate('category') ?>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('category.update', $category->id) }}" enctype='multipart/form-data'>
                        @csrf
                        <input type="hidden" name="id" value="<?php echo $category->id; ?>">
                        <div class="form-group">
                            <label for="name" class="col-sm pl-0 control-label"><?php echo translate('category_name'); ?></label>
                            <input type="text" class="form-control" value="{{ $category->name }}" id="name" name="name" placeholder="<?php echo translate('category_name'); ?>" value="" required>
                        </div>

                        <div class="form-group float-right">
                            <a href="{{route('category.index')}}" class="btn btn-secondary btn-flat"><?php echo translate('cancelBtn') ?></a>
                            <button type="submit" class="btn btn-primary" name="save"><?php echo translate('saveBtn') ?></button>
                        </div>
                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


@endsection

