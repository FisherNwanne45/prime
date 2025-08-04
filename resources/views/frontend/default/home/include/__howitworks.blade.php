@php
    $landingContent =\App\Models\LandingContent::where('type','howitworks')->where('locale',app()->getLocale())->get();
@endphp

<section class="how-it-works section-style-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-12">
                <div class="section-title text-center">
                    <h4 data-aos="fade-down" data-aos-duration="2000">{{ $data['title_small'] }}</h4>
                    <h2 data-aos="fade-down" data-aos-duration="1500">
                        {{ $data['title_big'] }}
                    </h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach($landingContent as $content)
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="how-it-works-single" data-aos="fade-left" data-aos-duration="1000">
                        <div class="icon-box">
                            <img class="icon-box-icon" src="{{ asset($content->icon) }}" alt=""><span><i
                                    class="anticon anticon-check"></i></span>
                        </div>
                        <h4>{{ $content->title }}</h4>
                        <p>
                            {{ $content->description }}
                        </p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
<section class="section-style-2 light-blue-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-12">
                <div class="section-title text-center">
                    <h4 data-aos="fade-down" data-aos-duration="2000">Payment Gateways </h4>
                    <h2 data-aos="fade-down" data-aos-duration="1500">Payment Gateway We Accept </h2>
                </div>
            </div>
        </div>
        <div class="row brands-logo justify-content-center">
             
                <div class="col-xl-2 col-lg-2 col-md-2 col-6">
                    <div class="single-brands-logo" data-aos="fade-down" data-aos-duration="2000">
                        <img src="{{ asset('global/images/NryhftbpnSKeuLPC9SPq.png') }} " alt=""/>
                    </div>
                </div>
                
                
                <div class="col-xl-2 col-lg-2 col-md-2 col-6">
                    <div class=" single-brands-logo"  >
                        <img src="{{ asset('global/images/EDkbniTHyKbF9EstAfg6.png') }} " alt=""/>
                    </div>
                </div>
               
                <div class="col-xl-2 col-lg-2 col-md-2 col-6">
                    <div class="single-brands-logo " data-aos="fade-down" data-aos-duration="2000">
                        <img src="{{ asset('global/images/ltc.png') }} " alt=""/>
                    </div>
                </div>
                 
                <div class="col-xl-2 col-lg-2 col-md-2 col-6">
                    <div class="single-brands-logo " data-aos="fade-down" data-aos-duration="2000">
                        <img src="{{ asset('global/images/eth.png') }} " alt=""/>
                    </div>
                </div>
            

        </div>
    </div>
</section>
