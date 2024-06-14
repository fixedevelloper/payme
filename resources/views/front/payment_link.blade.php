@extends('auth.layout')
<style>
    .form-select{
        height: 56px !important;
    }
</style>
@section('content')

    <div class="row justify-content-center h-100 align-items-center">

                <div class="col-md-6">
                    <div class="mini-logo text-center my-4">
                        <a href="{!! route('home') !!}"
                        ><img src="{!! asset('site/img/logo.png') !!}" alt="" width="200"
                            /></a>
                        <h4 class="card-title mt-3">Payment facture</h4>
                    </div>
                    <div class="text-center">
                        <ul>
                            <li>Amount: {!! $payment->amount !!} {!! $payment->country->currency->code !!}</li>
                            <li>Receiver: {!! $payment->account->first_name !!} {!! $payment->account->last_name !!}</li>
                        </ul>
                    </div>
                </div>
                <div class="auth-form col-md-6">
                    <div class="card-body">
                        <form method="POST" class="row g-3">
                            @csrf
                            <div class="col-12">
                                <label class="form-label">Name</label>

                                <input type="text" class="form-control" placeholder="" name="name">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Phone number</label>

                                <input type="text" class="form-control" placeholder="" name="phone">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Operator</label>

                                <select class="form-select" name="operator">
                                    @foreach($operators as $operator)
                                    <option value="{!! $operator->id !!}">
                                        {!! $operator->name !!}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-block">I pay {!! $payment->amount !!} {!! $payment->country->currency->code !!}</button>
                            </div>
                        </form>
                        <div class="new-account mt-3">

                        </div>
                    </div>
                </div>

    </div>

@endsection
