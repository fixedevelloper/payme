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
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Currencies</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-outline-dark float-end" data-bs-toggle="modal" data-bs-target="#basicModal">Add currency</a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive-md">
                                <thead>
                                <tr>
                                    <th style="width:80px;"><strong>#</strong></th>
                                    <th><strong>Name</strong></th>
                                    <th><strong>Code</strong></th>
                                    <th><strong>Symbol</strong></th>
                                    <th><strong>Value</strong></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td><strong>{!! $loop->index+1 !!}</strong></td>
                                        <td>{!! $item->name !!}</td>
                                        <td>{!! $item->code !!}</td>
                                        <td>{!! $item->symbol !!}</td>
                                        <td>{!! $item->exchange !!}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-success light sharp" data-bs-toggle="dropdown">
                                                    <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{!! route('admin.bc_country_id',['id'=>$item->id]) !!}">Edit</a>
                                                    <a class="dropdown-item" href="{!! route('admin.bc_country_add_currency',['id'=>$item->id]) !!}">Countries</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                            <nav aria-label="Page navigation example" class="custom-pagination">
                                {{$items->links('vendor.pagination.custompage')}}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="basicModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add currency</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POSt">
                        @csrf
                        <div class="col-12">
                            <label class="form-label">Name</label>
                            <input name="name" type="text" class="form-control" placeholder="Name" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Code</label>
                            <input name="code" type="text" class="form-control" placeholder="Code" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Symbol</label>
                            <input name="symbol" type="text" class="form-control" placeholder="symbol" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Value</label>
                            <input name="exchange" type="text" class="form-control" placeholder="Value" required>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
