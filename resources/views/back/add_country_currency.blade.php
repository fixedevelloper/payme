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
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Currencies</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Countries</a></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">
                        <div class="basic-for">
                            <form  method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-md-5">
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Country</label>
                                            <div class="input-group">
                                                <select name="country_id" class="form-select">
                                                    @foreach($alls as $country)
                                                    <option value="{!! $country->id !!}">{!! $country->name !!}</option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-primary">Add currency group</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                            </form>
                        </div>
                        <div class="row">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Code ISO</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($countries as $country)
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div class="media d-flex align-items-center">
                                                <div class="avatar avatar-xl me-2">
                                                    <img width="30" class="rounded-circle img-fluid" alt="" src="{!! asset('storage/'.$country->flag) !!}">
                                                </div>
                                                {!! $country->name !!}
                                            </div>
                                           </td>
                                        <td>{!! $country->iso3 !!}</td>
                                        <td><a class="btn btn-dark"><i class="icon flaticon-381-trash-1"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

