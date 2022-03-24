@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--7">
    
    <div class="card">
        <div class="row justify-content-center text-center">
            <div class="col-lg-5 col-md-6">
                <div class="text-muted text-center mt-2 mb-3" style="padding-top: 50px">
                    <img src="/img/oikoumeneLogo.png" style="height: 300px;">
                </div>
                <h1 class="text" style="padding-bottom: 50px">{{ __('Welcome to Pouk-KG') }}</h1>
                @if($role=="user")
                    
                @endif
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush