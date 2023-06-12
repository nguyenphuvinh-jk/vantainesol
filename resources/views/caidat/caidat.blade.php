@extends('index')

@section('title')
    <title>NESOL | Cài đặt</title>
@endsection

@section('header')
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/normalize.css') }}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/main.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
    <!-- Date Picker CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/datepicker.min.css') }}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/all.min.css') }}">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('public/fonts/flaticon.css') }}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/animate.min.css') }}">
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/select2.min.css') }}">
    <!-- Data Table CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/jquery.dataTables.min.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
    <!-- Modernize js -->
    <script src="{{ asset('public/js/modernizr-3.6.0.min.js') }}"></script>
@endsection

@section('contents')
    <div class="row">
        <div class="col-12-xxxl col-md-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="item-title">
                        <h3>Cài đặt</h3>
                        @include('components.errors')
                    </div>
                    <form method="POST" class="new-added-form" action="{{ URL::to('/cai-dat/luu') }}">
                        @csrf
                        <div class="col-2">
                            <div class="row my-2">
                                <div class="row form-group">
                                    <label class="col-7 my-auto">Thời hạn cảnh báo</label>
                                    <div class="col-5">
                                        <input type="number" placeholder="(số ngày)" class="form-control" name="songay"
                                            value="{{ $caidat->songay }}">
                                        @if ($errors->has('songay'))
                                            <p class="text-danger font-italic">{{ $errors->first('songay') }}</p>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="row my-2">
                                <div class="row form-group">
                                    <label class="col-7 my-auto">Số lít xăng tối đa</label>
                                    <div class="col-5">
                                        <input type="number" placeholder="(số lít)" class="form-control" name="solit"
                                            value="{{ $caidat->solit }}">
                                        @if ($errors->has('solit'))
                                            <p class="text-danger font-italic">{{ $errors->first('solit') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" form-group">
                            <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <!-- jquery-->
    <script src="{{ asset('public/js/jquery-3.3.1.min.js') }}"></script>
    <!-- Plugins js -->
    <script src="{{ asset('public/js/plugins.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('public/js/popper.min.js') }}"></script>
    <!-- Bootstrap js -->
    <script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
    <!-- Select 2 Js -->
    <script src="{{ asset('public/js/select2.min.js') }}"></script>
    <!-- Scroll Up Js -->
    <script src="{{ asset('public/js/jquery.scrollUp.min.js') }}"></script>
    <!-- Data Table Js -->
    <script src="{{ asset('public/js/jquery.dataTables.min.js') }}"></script>
    <!-- Date Picker Js -->
    <script src="{{ asset('public/js/datepicker.min.js') }}"></script>

    <script src="{{ asset('public/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/js/jszip.min.js') }}"></script>
    <script src="{{ asset('public/js/buttons.html5.min.js') }}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('public/js/main.js') }}"></script>
@endsection
