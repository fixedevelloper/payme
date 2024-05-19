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
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Countries</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
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
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label">Name</label>
                                                <input name="name" value="{!! $country->name !!}" type="text" class="form-control" placeholder="Name" required>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Phone code</label>
                                                <input name="phonecode" value="{!! $country->phonecode !!}" type="text" class="form-control" placeholder="Phone code" required>
                                            </div>
                                            <div class="col-12 example">
                                                <label class="form-label">Code ISO</label>
                                                <div class="example">
                                                    <input name="iso" type="text" class=" form-control" value="{!! $country->iso !!}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Status</label>
                                            <div class="example">
                                              <select name="status" class="form-select">
                                                  <option value="1">Activate</option>
                                                  <option value="0">Desactivate</option>
                                              </select>
                                            </div>
                                        </div>
                                        <img src="{!! asset('storage/'.$country->flag) !!}">
                                        <div>
                                            <label class="form-label">Image Flag</label>
                                            <div class="input-group custom_file_input mb-3">
                                                <div class="form-file">
                                                    <input name="flag" type="file" class="form-file-input form-control">
                                                </div>
                                                <span class="input-group-text">Flag</span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                    </div>
                        <div class="row">

                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
