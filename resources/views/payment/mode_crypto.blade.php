@extends('auth.layout')

@section('content')

    <div class="row justify-content-center h-100 align-items-center">
        <div class="col-xl-8 col-md-8">

            <div class="auth-form card">
                <div class="card-header">
                    <h4 class="card-title">  Complete your sell <span class="text-danger">{!! $trade->quantity !!}</span> <span class="text-success">{!! $trade->crypto->name !!}</span> </h4>
                </div>
                <div class="card-body">
                        <div class="card h-unset no-shadow">
                            <div class="card-header">
                                <h4 class="card-title">Automatic payment</h4>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                            <span class="me-3 icon-circle icon-circle-2 bg-black text-white"
                            ><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 234 48"><path fill="currentColor" d="M69.472 36.676c4.785 0 7.792-3.004 8.613-5.735l-3.896-1.57c-.581 2.048-2.29 3.448-4.614 3.448-2.905 0-5.16-2.185-5.16-5.53s2.255-5.53 5.126-5.53c2.324 0 3.964 1.4 4.545 3.482l3.896-1.536c-.82-2.799-3.828-5.803-8.51-5.803-5.433 0-9.398 4.096-9.398 9.421 0 5.325 4.033 9.353 9.398 9.353Zm15.283-16.384v-2.014h-4.1v17.988h4.34v-10.24c0-2.423 1.982-4.096 5.126-4.096v-4.062c-2.256 0-4.135.99-5.365 2.424Zm20.287-2.014-5.093 14.507-4.647-14.507h-4.478l6.357 17.988h1.367l-2.46 6.11h4.272l2.323-6.11 6.87-17.988h-4.511Zm16.732-.41c-2.563 0-4.647 1.024-6.049 2.765v-2.355h-4.032v24.098h4.34v-8.021c1.367 1.467 3.281 2.32 5.639 2.32 5.16 0 8.92-4.027 8.92-9.386 0-5.393-3.657-9.42-8.818-9.42Zm-.683 14.985c-3.11 0-5.229-2.287-5.229-5.564s2.119-5.564 5.229-5.564c2.973 0 5.16 2.355 5.16 5.564 0 3.174-2.187 5.564-5.16 5.564m20.226 3.413h2.837v-3.789h-1.982c-1.948 0-3.008-1.126-3.008-3.208v-7.27h4.853v-3.721h-4.716v-4.676h-4.238v2.833c0 1.228-.581 1.843-1.777 1.843h-1.64v3.72h3.144v7.749c0 3.96 2.221 6.52 6.527 6.52Zm13.632.41c5.605 0 9.604-4.028 9.604-9.387 0-5.393-3.999-9.42-9.604-9.42-5.639 0-9.603 4.027-9.603 9.42 0 5.359 3.964 9.387 9.603 9.387m.034-3.857c-3.144 0-5.297-2.321-5.297-5.53 0-3.243 2.153-5.53 5.297-5.53 3.11 0 5.195 2.287 5.195 5.496 0 3.243-2.119 5.564-5.195 5.564m34.004-14.951c-3.041 0-5.092 1.263-6.083 2.936-1.025-1.878-2.837-2.936-5.707-2.936-2.427 0-4.306 1.024-5.434 2.39v-1.98h-4.101v17.954h4.34V25.343c.034-1.706 1.401-3.584 3.862-3.618 2.426 0 3.759 1.81 3.759 4.165v10.342h4.34V25.343c.035-1.672 1.367-3.584 3.862-3.618 2.427 0 3.725 1.843 3.725 4.165v10.342h4.341V25.105c0-4.062-2.427-7.237-6.904-7.237Zm22.846.41v10.888c0 1.98-1.572 3.619-3.999 3.653-2.426 0-3.964-1.605-3.964-3.926V18.278h-4.34v11.161c0 4.165 2.46 7.237 7.04 7.237 2.324 0 4.272-.99 5.536-2.39v1.98h4.067V18.278zm14.717 18.398c4.511 0 7.45-2.117 7.45-5.7 0-6.588-9.877-4.711-9.877-7.988 0-1.092.855-1.775 2.461-1.775 1.504 0 2.563.649 3.042 2.014l3.793-1.468c-.752-2.457-3.281-3.89-6.767-3.89-4.237 0-6.972 2.047-6.972 5.324 0 6.178 9.877 4.54 9.877 8.09 0 1.263-1.093 1.98-2.836 1.98-2.188 0-3.589-.99-4.101-2.663l-3.794 1.468c.991 3.038 3.828 4.608 7.724 4.608ZM43.535 11.345 25.277.817a2.688 2.688 0 0 0-2.675 0L4.344 11.345a2.676 2.676 0 0 0-1.34 2.317v21.055c0 .951.513 1.837 1.34 2.317l18.258 10.528a2.67 2.67 0 0 0 1.34.356c.471 0 .933-.125 1.34-.356L43.54 37.034a2.676 2.676 0 0 0 1.34-2.316V13.662c0-.95-.513-1.837-1.34-2.317h-.005M24.353 22.884a.828.828 0 0 1-.827 0L5.776 12.65l17.75-10.23a.85.85 0 0 1
                             .827 0l17.75 10.232-17.75 10.233Zm-1.751 1.596c.13.074.268.139.416.19v20.99L5.268 35.433a.831.831 0 0 1-.416-.715v-20.47l17.75 10.232Z"></path></svg></span>
                                    <div>
                                        <h5 class="mb-0">
                                            You haven't authorized any applications yet.
                                        </h5>
                                        <p>
                                            After connecting an application with your
                                            account, you can manage or revoke its access
                                            here.
                                        </p>
                                        <a class="btn btn-primary" href="{!! route('payment.web3bnb',['id'=>$trade->id]) !!}">Cryptomus</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card h-unset no-shadow">
                            <div class="card-header">
                                <h4 class="card-title">Manuel payment</h4>
                            </div>
                            <div class="card-body">
                                <h4>
                                  Upload proof
                                </h4>
                                <form method="POST" class="row g-3" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <input required type="file" class="form-control" placeholder="***********">
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary btn-block">Send</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
            </div>

        </div>
    </div>
    <a href="{!! route('back.trade') !!}" class="scroll-to-top scroll-to-target"><span class="icofont-arrow-left"></span></a>
@endsection
