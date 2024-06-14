@extends('front.layout')
@section('content')
<!--==============================
Hero Area
==============================-->
<div class="hero-wrapper bg-smoke hero-1" id="hero" style="background-image: url(assets/img/hero/hero_bg_1_1.png);">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-xl-6">
                <div class="hero-style1">
                    <h1 class="hero-title">Simple and secure payment</h1>
                    <p class="hero-text">A business consultant is a professional who provides expert advice and
                        guidance to businesses on various aspects such</p>

                </div>
            </div>
            <div class="col-xl-6">
                <div class="hero-i">
                    <div class="pricing-card">
                        <div class="pricing-card-details">
                            <div class="col-md-12 form-group">
                                <label>Your send</label>
                                <div class="input-group">
                                        <span class=" input-group-text">
                                             <span class="btn" data-bs-toggle="modal" data-bs-target="#modalDefault">
                                                <img width="40" class="rounded-circle" src="{!! asset('storage/'.$current_country->flag) !!}" id="send_src">
                                                 <span id="send_id" data-id="{!! $current_country->id !!}">{!! $current_country->iso3 !!}</span>
                                                 <i class="fa fa-angle-down"></i></span>

                                        </span>

                                <input type="text" placeholder="" class="form-control style-border"  id="input_send">
                                    <span class="input-group-text" data-bs-toggle="modal" data-bs-target="#modalDefault">

                                    </span>
                                </div>
                            </div>
                            <div class="row mb-3">
                               <div class="col-md-6 text-left">
                                   0.0 FCFA
                               </div>
                                <div class="col-md-6 text-end">
                                    Rate Bank
                                </div>
                                <div class="col-md-6 text-left">
                                    0.0 FCFA
                                </div>
                                <div class="col-md-6 text-end">
                                    Total rate
                                </div>

                            </div>
                            <div class="col-md-12 form-group">
                                <label>Your Beneficiary receive</label>
                                <div class="input-group">
                                        <span class=" input-group-text">
                                             <span class="btn" data-bs-toggle="modal" data-bs-target="#modalReceiver">
                                                <img width="40" class="rounded-circle" src="{!! asset('storage/'.$current_country->flag) !!}" id="receive_src">
                                                 <span id="receive_id" data-id="{!! $current_country->id !!}">{!! $current_country->iso3 !!}</span> <i class="fa fa-angle-down"></i></span>

                                        </span>

                                    <input  type="text" placeholder="" class="form-control style-border" id="input_receive">
                                    <span class="input-group-text" data-bs-toggle="modal" data-bs-target="#modalReceiver">

                                    </span>
                                </div>

                            </div>
                            <a class="global-btn style-border" href="#">Send <img src="{!! asset("site/img/icon/right-icon.svg") !!}" alt=""></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!--==============================
Service Area 01
==============================-->
<div class="service-area-1 space overflow-hidden">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7">
                <div class="title-area text-center">
                        <span class="sub-title"><img src="assets/img/icon/title_left.svg" alt="shape">Latest
                            service</span>
                    <h2 class="sec-title style2">Empowering Business The Excellence</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row gx-30 gy-30 justify-content-center">
            <div class="col-md-6">
                <div class="service-card">
                    <div class="service-card_img">
                        <img src="assets/img/service/service-1-1.jpg" alt="img">
                    </div>
                    <div class="service-card_content">
                        <h4 class="service-card_title"><a href="service-details.html">Efficiency Experts</a></h4>
                        <p class="service-card_text">Many desktop publishing packages web page editors now use Lorem
                            Ipsum a default model text, and a search</p>
                        <a href="service-details.html" class="link-btn">Read More <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="service-card">
                    <div class="service-card_img">
                        <img src="assets/img/service/service-1-2.jpg" alt="img">
                    </div>
                    <div class="service-card_content">
                        <h4 class="service-card_title"><a href="service-details.html">Management Mastery</a></h4>
                        <p class="service-card_text">Many desktop publishing packages web page editors now use Lorem
                            Ipsum a default model text, and a search</p>
                        <a href="service-details.html" class="link-btn">Read More <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="service-card">
                    <div class="service-card_img">
                        <img src="assets/img/service/service-1-3.jpg" alt="img">
                    </div>
                    <div class="service-card_content">
                        <h4 class="service-card_title"><a href="service-details.html">Success Accelerators</a></h4>
                        <p class="service-card_text">Many desktop publishing packages web page editors now use Lorem
                            Ipsum a default model text, and a search</p>
                        <a href="service-details.html" class="link-btn">Read More <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="service-card">
                    <div class="service-card_img">
                        <img src="assets/img/service/service-1-4.jpg" alt="img">
                    </div>
                    <div class="service-card_content">
                        <h4 class="service-card_title"><a href="service-details.html">Growth and Innovation</a></h4>
                        <p class="service-card_text">Many desktop publishing packages web page editors now use Lorem
                            Ipsum a default model text, and a search</p>
                        <a href="service-details.html" class="link-btn">Read More <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!--==============================
CTA Area
==============================-->
<div class="cta-area-1 space-bottom">
    <div class="container">
        <div class="cta-wrap1">
            <div class="row gy-4 justify-content-md-between align-items-center">
                <div class="col-lg-6 col-md-8">
                    <div class="title-area mb-md-0">
                        <h2 class="sec-title style2 ">Let’s Do Great!</h2>
                        <p class="cta-desc text-white mb-0">Dictum ultrices porttitor amet nec sollicitudin mi
                            molestie</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="client-box mb-sm-0 mb-5">
                        <div class="client-thumb">
                            <div class="client-thumb-group">
                                <div class="thumb"><img src="assets/img/client/client-img-1-1.png" alt="avater">
                                </div>
                                <div class="thumb"><img src="assets/img/client/client-img-1-2.png" alt="avater">
                                </div>
                                <div class="thumb"><img src="assets/img/client/client-img-1-3.png" alt="avater">
                                </div>
                                <div class="thumb icon"><i class="fas fa-plus"></i></div>
                            </div>
                            <div class="client-box-content">
                                <h4 class="cilent-box_counter"><span class="counter-number">2.8 </span> million+
                                </h4>
                                <span class="cilent-box_title">Worldwide clients</span>
                            </div>
                        </div>
                        <div class="cta-btn">
                            <a class="global-btn style-border" href="contact.html">contact us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Trigger Code -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDefault">Modal Default</button>

<!-- Modal Content Code -->
<div class="modal fade" tabindex="-1" id="modalDefault">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <a href="#" class="close text-end" data-bs-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </a>
            <div class="modal-body row">
                <div class="widget widget_tag_cloud">
                    <h3 class="widget_title">Countries</h3>
                    <div class="tagcloud">
                        @foreach($countries as $country)
                            <a data-id="{!! $country->id !!}" onclick="getId({!! $country->id !!})" id="{!! $country->id !!}" data-name="{!! $country->iso3 !!}" data-img="{!! asset("storage/".$country->flag) !!}">
                                <img width="50" src="{!! asset("storage/".$country->flag) !!}" alt=""/>
                                <span>{!! $country->iso3 !!}</span></a>
                        @endforeach
                    </div>
                </div>



            </div>
            <div class="modal-footer">

            </div>

        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="modalReceiver">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <a href="#" class="close text-end" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </a>
            <div class="modal-body row">
                <div class="widget widget_tag_cloud">
                    <h3 class="widget_title">Countries</h3>
                    <div class="tagcloud">
                        @foreach($countries as $country)
                            <a onclick="getIdReceiver({!! $country->id !!})" id="{!! $country->id !!}"
                               data-id="{!! $country->id !!}" data-name="{!! $country->iso3 !!}" data-img="{!! asset("storage/".$country->flag) !!}">
                                <img width="50" src="{!! asset("storage/".$country->flag) !!}" alt=""/>
                                <span>{!! $country->iso3 !!}</span></a>
                        @endforeach
                    </div>
                </div>



            </div>
            <div class="modal-footer">

            </div>

        </div>
    </div>
</div>
@endsection
@push('js')
    <script>
        function getId(id) {
            var id_=$("#"+id)

            $('#send_id').text(id_.data('name'))
            $('#send_id').data("id",id)
            $('#modalDefault').modal('hide')
            $('#send_src').attr("src",id_.data('img'))
            console.log($("#send_id").data('id'))
            $.ajax({
                url: configs.routes.home_change_ajax,
                type: "GET",
                dataType: "JSON",
                data: {
                    'sender_id':$("#send_id").data('id'),
                    'receiver_id':$("#receive_id").data('id'),
                },
                success: function (data) {
                    console.log(data)

                },
                error: function (err) {
                    console.log(err.responseJSON)
                    alert("An error ocurred while loading data ...");
                    //window.location.reload(true);
                }
            });
        }
        function getIdReceiver(id) {
            var id_=$("#"+id)
            $('#receive_id').text(id_.data('name'))
            $('#modalReceiver').modal('hide')
            $('#receive_src').attr("src",id_.data('img'))
            $('#receive_id').data("id",id)
            $.ajax({
                url: configs.routes.home_change_ajax,
                type: "GET",
                dataType: "JSON",
                data: {
                    'sender_id':$("#send_id").data('id'),
                    'receiver_id':$("#receive_id").data('id'),
                },
                success: function (data) {
                    console.log(data)

                },
                error: function (err) {
                    console.log(err.responseJSON)
                    alert("An error ocurred while loading data ...");
                    //window.location.reload(true);
                }
            });
        }
        $('#input_receive').keyup(function (value) {
            console.log($(this).val())
        })
        $('#input_send').keyup(function (value) {
            console.log($(this).val())
        })
    </script>
@endpush
