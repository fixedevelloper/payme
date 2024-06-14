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
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Banners</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
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
                                        <div class="col-12 example">
                                            <label class="form-label">Titre</label>
                                            <div class="example">
                                                <input name="titre" type="text" class=" form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-12 example">
                                            <label class="form-label">Description</label>
                                            <div class="example">
                                                <input name="description" type="text" class=" form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-12 example">
                                            <label class="form-label">Image</label>
                                            <div class="example">
                                                <input name="image" type="file" class=" form-control" required>
                                            </div>
                                        </div>
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>

                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

