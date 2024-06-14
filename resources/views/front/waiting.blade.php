@extends('auth.layout')
<style>
    .form-select{
        height: 56px !important;
    }
</style>
@section('content')

    <div class="row justify-content-center h-100 align-items-center">


                    <div class="mini-logo text-center my-4">
                        <a href="{!! route('home') !!}"
                        ><img src="{!! asset('site/img/icon/process-icon-1-1.svg') !!}" alt="" width="200"
                            /></a>
                        <h4 class="card-title mt-3">Operation Processing</h4>
                        <h6 class="card-title mt-3">Please send code</h6>
                    </div>

                </div>


@endsection
