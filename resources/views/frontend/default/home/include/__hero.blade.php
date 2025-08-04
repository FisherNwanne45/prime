<section class="banner light-blue-bg">
    <div class="slider">
        <div class="slides">
            <!-- Slide 1 -->
            <div class="slide">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-7 col-lg-7 col-md-12 col-12">
                            <div class="banner-content">
                                <h2 data-aos="fade-right" data-aos-duration="1000">
                                    {{ $data['hero_title'] }}
                                </h2>
                                <p data-aos="fade-up" data-aos-duration="1500">
                                    {{ $data['hero_content'] }}
                                </p>
                                <div class="banner-anchors">
                                    <a href="{{ $data['hero_button1_url'] }}" class="site-btn grad-btn mb-2"
                                        data-aos="fade-up" target="{{ $data['hero_button1_target'] }}"
                                        data-aos-duration="2000"><i
                                            class="anticon {{ $data['hero_button1_icon'] }}"></i>{{ $data['hero_button1_level'] }}
                                    </a>
                                    <a href="{{ $data['hero_button2_url'] }}" class="site-btn white-btn"
                                        data-aos="fade-up" target="{{ $data['hero_button2_target'] }}"
                                        data-aos-duration="2500"><i
                                            class="anticon {{ $data['hero_button2_icon'] }}"></i>{{ $data['hero_button2_lavel'] }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-12 col-12">
                            <div class="banner-right">
                                <img src="{{ asset($data['hero_right_img']) }}" alt="" class="banner-img"
                                    data-aos="fade-left" data-aos-duration="2000" />
                                <div class="dots"
                                    style="background: url({{ asset($data['hero_right_top_img']) }}) repeat;"
                                    data-aos="fade-down-left" data-aos-duration="1500"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 (replica) -->
            <div class="slide">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-7 col-lg-7 col-md-12 col-12">
                            <div class="banner-content">
                                <h2 data-aos="fade-right" data-aos-duration="1000">
                                    Small Business Trade Option / Partnership

                                </h2>
                                <p data-aos="fade-up" data-aos-duration="1500">
                                    This provides opportunities for collaborative growth, shared resources, and
                                    increased market reach through strategic alliances.
                                </p>
                                <div class="banner-anchors">
                                    <a href="{{ $data['hero_button1_url'] }}" class="site-btn grad-btn mb-2"
                                        data-aos="fade-up" target="{{ $data['hero_button1_target'] }}"
                                        data-aos-duration="2000"><i
                                            class="anticon {{ $data['hero_button1_icon'] }}"></i>{{ $data['hero_button1_level'] }}
                                    </a>
                                    <a href="{{ $data['hero_button2_url'] }}" class="site-btn white-btn"
                                        data-aos="fade-up" target="{{ $data['hero_button2_target'] }}"
                                        data-aos-duration="2500"><i
                                            class="anticon {{ $data['hero_button2_icon'] }}"></i>{{ $data['hero_button2_lavel'] }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-12 col-12">
                            <div class="banner-right">
                                <img src="{{ asset('global/images/trade.jpg') }}" alt="" class="banner-img"
                                    data-aos="fade-left" data-aos-duration="2000" />
                                <div class="dots"
                                    style="background: url({{ asset($data['hero_right_top_img']) }}) repeat;"
                                    data-aos="fade-down-left" data-aos-duration="1500"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slide 3 (replica) -->
            <div class="slide">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-7 col-lg-7 col-md-12 col-12">
                            <div class="banner-content">
                                <h2 data-aos="fade-right" data-aos-duration="1000">
                                    Precious Metals - Gold

                                </h2>
                                <p data-aos="fade-up" data-aos-duration="1500">
                                    Precious metals investment in gold offers a stable, time-tested asset with strong
                                    value retention and potential for long-term growth.
                                </p>
                                <div class="banner-anchors">
                                    <a href="{{ $data['hero_button1_url'] }}" class="site-btn grad-btn mb-2"
                                        data-aos="fade-up" target="{{ $data['hero_button1_target'] }}"
                                        data-aos-duration="2000"><i
                                            class="anticon {{ $data['hero_button1_icon'] }}"></i>{{ $data['hero_button1_level'] }}
                                    </a>
                                    <a href="{{ $data['hero_button2_url'] }}" class="site-btn white-btn"
                                        data-aos="fade-up" target="{{ $data['hero_button2_target'] }}"
                                        data-aos-duration="2500"><i
                                            class="anticon {{ $data['hero_button2_icon'] }}"></i>{{ $data['hero_button2_lavel'] }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-12 col-12">
                            <div class="banner-right">
                                <img src="{{ asset('global/images/gold.jpg') }}" alt="" class="banner-img"
                                    data-aos="fade-left" data-aos-duration="2000" />
                                <div class="dots" style="background: url({{ asset($data['hero_right_top_img']) }}) repeat;"
                                    data-aos="fade-down-left" data-aos-duration="1500"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Slide 4 (replica) -->
            <div class="slide">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-7 col-lg-7 col-md-12 col-12">
                            <div class="banner-content">
                                <h2 data-aos="fade-right" data-aos-duration="1000">
                                    Technology- Crypto Trading
                                </h2>
                                <p data-aos="fade-up" data-aos-duration="1500">
                                    Technology investment in crypto trading offers high-risk, high-reward potential
                                    through innovative digital assets and fast-paced market opportunities.
                                </p>
                                <div class="banner-anchors">
                                    <a href="{{ $data['hero_button1_url'] }}" class="site-btn grad-btn mb-2"
                                        data-aos="fade-up" target="{{ $data['hero_button1_target'] }}"
                                        data-aos-duration="2000"><i
                                            class="anticon {{ $data['hero_button1_icon'] }}"></i>{{ $data['hero_button1_level'] }}
                                    </a>
                                    <a href="{{ $data['hero_button2_url'] }}" class="site-btn white-btn"
                                        data-aos="fade-up" target="{{ $data['hero_button2_target'] }}"
                                        data-aos-duration="2500"><i
                                            class="anticon {{ $data['hero_button2_icon'] }}"></i>{{ $data['hero_button2_lavel'] }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-12 col-12">
                            <div class="banner-right">
                                <img src="{{ asset('global/images/crypto.jpg') }}" alt="" class="banner-img"
                                    data-aos="fade-left" data-aos-duration="2000" />
                                <div class="dots"
                                    style="background: url({{ asset($data['hero_right_top_img']) }}) repeat;"
                                    data-aos="fade-down-left" data-aos-duration="1500"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slider Arrows -->
        <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
        <a class="next" onclick="changeSlide(1)">&#10095;</a>
    </div>
    <style>
        .slider {
            position: relative;
            max-width: 100%;
            margin: auto;
        }

        .prev,
        .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 10px 20px;
            font-size: 24px;
            border-radius: 50%;
            cursor: pointer;
            user-select: none;
            transition: background-color 0.3s ease;
        }

        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .prev {
            left: 10px;
        }

        .next {
            right: 10px;
        }
    </style>

    <script>
        let slideIndex = 0;
        autoSlide();

        function autoSlide() {
            let slides = document.getElementsByClassName("slide");
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1
            }
            slides[slideIndex - 1].style.display = "block";
            setTimeout(autoSlide, 5000); // Change slide every 5 seconds
        }

        function changeSlide(n) {
            let slides = document.getElementsByClassName("slide");
            slides[slideIndex - 1].style.display = "none";
            slideIndex += n;
            if (slideIndex > slides.length) {
                slideIndex = 1
            }
            if (slideIndex < 1) {
                slideIndex = slides.length
            }
            slides[slideIndex - 1].style.display = "block";
        }
    </script>
</section>
<section class="why-choose-us section-style-2">
    <!-- TradingView Widget BEGIN -->
    <div class="tradingview-widget-container">
        <div class="tradingview-widget-container__widget"></div>
        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js"
            async>
            {
                "symbols": [{
                        "proName": "FOREXCOM:SPXUSD",
                        "title": "S&P 500 Index"
                    },
                    {
                        "proName": "FOREXCOM:NSXUSD",
                        "title": "US 100 Cash CFD"
                    },
                    {
                        "proName": "FX_IDC:EURUSD",
                        "title": "EUR to USD"
                    },
                    {
                        "proName": "BITSTAMP:BTCUSD",
                        "title": "Bitcoin"
                    },
                    {
                        "proName": "BITSTAMP:ETHUSD",
                        "title": "Ethereum"
                    },
                    {
                        "description": "",
                        "proName": "OANDA:XAUUSD"
                    }
                ],
                "showSymbolLogo": true,
                "isTransparent": true,
                "displayMode": "compact",
                "colorTheme": "dark",
                "locale": "en"
            }
        </script>
    </div>
    <!-- TradingView Widget END -->
</section>
<section class="section-style-2 light-blue-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="section-title centered">
                    <h4 data-aos="fade-down" data-aos-duration="2000">Projects</h4>
                    <h2 data-aos="fade-down" data-aos-duration="1500">Our Investment Categories</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-sm-12">
                <div class="single-blog" data-aos="fade-down" data-aos-duration="1000">
                    <div class="thumb">
                        <img src="{{ asset('global/images/agric.jpg') }}" alt="" />

                    </div>
                    <div class="content">

                        <div class="title">
                            <h3><a href="{{ url('/page/agriculture') }}">Agriculture </a></h3>
                        </div>
                        <div class="des">
                            Agriculture investment in CBD oil, timber, and manure offers a diverse portfolio of
                            high-demand, sustainable products with strong growth potential.
                        </div>
                        <div class="link">
                            <a href="{{ url('/page/agriculture') }}">{{ __('See More') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-12">
                <div class="single-blog" data-aos="fade-down" data-aos-duration="1000">
                    <div class="thumb">
                        <img src="{{ asset('global/images/trade.jpg') }}" alt="" />
                    </div>
                    <div class="content">

                        <div class="title">
                            <h3><a href="{{ url('/page/business') }}">Small Business </a></h3>
                        </div>
                        <div class="des">
                            This provides opportunities for collaborative growth, shared resources, and
                            increased market reach through strategic alliances.
                        </div>
                        <div class="link">
                            <a href="{{ url('/page/business') }}">{{ __('See More') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-12">
                <div class="single-blog" data-aos="fade-down" data-aos-duration="1000">
                    <div class="thumb">
                        <img src="{{ asset('global/images/gold.jpg') }}" alt="" />
                    </div>
                    <div class="content">

                        <div class="title">
                            <h3><a href="{{ url('/page/metals') }}">Precious Metals </a></h3>
                        </div>
                        <div class="des">
                            Precious metals investment in gold offers a stable, time-tested asset with strong
                            value retention and potential for long-term growth.
                        </div>
                        <div class="link">
                            <a href="{{ url('/page/metals') }}">{{ __('See More') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-sm-12">
                <div class="single-blog" data-aos="fade-down" data-aos-duration="1000">
                    <div class="thumb">
                        <img src="{{ asset('global/images/crypto.jpg') }}" alt="" />
                    </div>
                    <div class="content">
                        <div class="title">
                            <h3><a href="{{ url('/page/technology') }}">Technology</a></h3>
                        </div>
                        <div class="des">
                            Technology investment in crypto trading offers high-risk, high-reward potential
                            through innovative digital assets and fast-paced market opportunities.
                        </div>
                        <div class="link">
                            <a href="{{ url('/page/technology') }}">{{ __('See More') }}</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
 

