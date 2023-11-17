@extends('layouts.master')

@section('css')
<!--Chartist Chart CSS -->
<link rel="stylesheet" href="{{ base_url('plugins/chartist/css/chartist.min.css') }}">
@endsection

@section('breadcrumb')
<div class="col-sm-6 text-left" >
     <h4 class="page-title"><?php echo translate('dashboard') ?></h4>
     <ol class="breadcrumb">
         <li class="breadcrumb-item active"> <?php echo translate('welcome_to') ?> <?php echo translate('app_name') ?></li>
     </ol>
</div>
@endsection

@section('content')

    <div class="row">
        
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-primary text-white">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="float-left mini-stat-img mr-4">
                            <i class="fa fa-puzzle-piece" style="font-size: 20px"></i>
                        </div>
                        <h6  class="font-16 text-uppercase mt-0 text-white-50" >Total Category</h6>
                        <h4 class="font-500">{{$total_category}}<i class="text-danger ml-2"></i></h4>
                        <span class="fa fa-puzzle-piece"  style="font-size: 71px"></span>
                                   
                    </div>
                    <div class="pt-2">
                        <div class="float-right">
                            <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                        </div>

                        <p class="text-white-50 mb-0">More info</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-primary text-white">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="float-left mini-stat-img mr-4">
                            <i class=" ti-check-box " style="font-size: 20px"></i>
                        </div>
                        <h5 class="font-16 text-uppercase mt-0 text-white-50">Today New Books</h5>
                        <h4 class="font-500"> {{$total_book}}<i class=" text-success ml-2"></i></h4>
                        <span class="fas fa-clipboard"  style="font-size: 71px"></span>
                         
                    </div>
                    <div class="pt-2">
                        <div class="float-right">
                            <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                        </div>

                        <p class="text-white-50 mb-0">More info</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-primary text-white">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="float-left mini-stat-img mr-4">
                            <i class="ti-check-box" style="font-size: 20px"></i>
                        </div>
                        <h5 class="font-16 text-uppercase mt-0 text-white-50">Today Borrow Books</h5>
                        <h4 class="font-500">{{$return_book}}<i class=" text-success ml-2"></i></h4>
                        <span class="fas fa-book-reader"  style="font-size: 43px"></span>
                         
                    </div>
                    <div class="pt-2">
                        <div class="float-right">
                            <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                        </div>

                        <p class="text-white-50 mb-0">More info</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-primary text-white">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="float-left mini-stat-img mr-4">
                            <i class="ti-check-box" style="font-size: 20px"></i>
                        </div>
                        <h5 class="font-16 text-uppercase mt-0 text-white-50">Today Return Books</h5>
                        <h4 class="font-500">{{$return_book}}<i class=" text-success ml-2"></i></h4>
                        <span class="dripicons-to-do"  style="font-size: 43px"></span>
                         
                    </div>
                    <div class="pt-2">
                        <div class="float-right">
                            <a href="#" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                        </div>

                        <p class="text-white-50 mb-0">More info</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card mini-stat bg-primary text-white">
                <div class="card-body">
                    <div class="mb-4">
                        <div class="float-left mini-stat-img mr-4">
                            <span class="ti-id-badge" style="font-size: 20px"></span>
                        </div>
                        <h5 class="font-16 text-uppercase mt-0 text-white-50">Total Member</h5>
                        <h4 class="font-500">{{$total_member}} </h4>
                        <span class="ti-user" style="font-size: 71px"></span><br>
                        <?php print_r(auth()->user()->getRoleNames()[0]); ?>
                    </div>
                    <div class="pt-2">
                        <div class="float-right">
                            <a href="{{route('members.index')}}" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                        </div>
                        <p class="text-white-50 mb-0">More info</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3">
            <img alt='Barcode Generator TEC-IT' src='https://barcode.tec-it.com/barcode.ashx?data=VDCA01D901354&code=Code128&translate-esc=on'/>
        </div>
    </div>
    <!-- end row -->

    
    <!-- end row -->
                        
                        
@endsection

