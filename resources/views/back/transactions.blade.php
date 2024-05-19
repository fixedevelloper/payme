@extends('back.layout')
@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Settings</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Transactions</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                <tr>
                                    <th style="width:80px;"><strong>#</strong></th>
                                    <th><strong>SENDER</strong></th>
                                    <th><strong>RECEIVER</strong></th>
                                    <th><strong>AMOUNT</strong></th>
                                    <th><strong>TOTAL</strong></th>
                                    <th><strong>MODE</strong></th>
                                    <th><strong>STATUS</strong></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td><strong>{!! $loop->index+1 !!}</strong></td>
                                        <td>   @if($item->transaction_type === "withdraw")
                                                <button type="button" class="btn btn-danger light sharp">

                                                    <i class="fa fa-arrow-up"></i>
                                                </button>
                                                @else
                                                <button type="button" class="btn btn-success light sharp">
                                                    <i class="fa fa-arrow-down"></i>
                                                </button>
                                                @endif
                                           {!! $item->sender->first_name !!}</td>
                                        @if($item->transaction_type === "withdraw")
                                        <td>{!! $item->name_withdraw !!}</td>
                                        @else
                                            <td>{!! $item->sender->first_name !!}</td>
                                        @endif
                                        <td>{!! $item->amount !!}</td>
                                        <td>{!! $item->total !!}</td>
                                        <td>{!! $item->mode !!}</td>
                                        <td>{!! $item->status !!}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-success light sharp" data-bs-toggle="dropdown">
                                                    <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
