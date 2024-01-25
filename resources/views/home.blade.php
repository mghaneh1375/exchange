<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('assets/css/fontface.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/style.css?v=3.4') }}" />
        <meta name="description" content="{!! html_entity_decode($desc) !!}">
        <meta name="og:description" content="{!! html_entity_decode($desc) !!}">
        <meta property="og:title" content="TehranPage" />
        <meta property="og:url" content="{{route('home2') . '/v=' . time()}}" />
        <meta property="og:image" content="{{asset('assets/img/logo2.png')}}" />
        <meta property="og:locale" content="fa_IR" />
        <meta property="og:type" content="website" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/img/apple-touch-icon.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/img/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/img/favicon-16x16.png')}}">
        <link rel="manifest" href="{{asset('assets/img/site.webmanifest')}}">
        <title>TehranPage</title>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script>
            var submitOrderUrl = '{{route('submitOrder')}}';
        </script>
    </head>
    <body>
        <div class="top-nav">
            <h2>ثبت سفارش حواله</h2>
        </div>
        <div class="flag">
            <p>مبــادلات بین المللـی ارز</p>
            <img width="40px" height="40px" src="{{asset('assets/img/logo.png')}}" />
        </div>
        <div class="form">
            <div class="row-input">
                <label>مقدار ارز</label>
                <div class="amount">
                    <input placeholder="مقدار ارز" style="text-align: right" onkeypress="return isNumber(event)" type="text" name="amount" id="amount">
                    <div class="currency-panel">
                        <?php $first = true; ?>
                        @foreach ($currencies as $currency)
                            <div>
                                <input {{$first ? 'checked' : ''}} name="currency" value="{{$currency['id']}}" id="{{$currency['id']}}" type="radio">
                                <label for="{{$currency['id']}}">
                                    <span>{{$currency['name']}}</span>
                                    <div class="currency_price">
                                        <span>{{$currency['countries'][0]['price']}}</span>
                                        <span>تومان</span>
                                    </div>
                                </label>
                            </div>    
                            <?php if($first) $first = false; ?>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row-input">
                <label>کشـور مقصـد</label>
                <div class="country" id="countries">
                </div>
            </div>
            
            <div class="row-input">
                <label>مبلغ قابل پرداخت</label>
                <div id="totalPrice">
                </div>
            </div>

            
            <div class="row-input">
                <label>نوع حسـاب</label>
                <div class="accountType">
                    <div>
                        <input name="accountType" value="individual" id="accountType" type="radio">
                        <label for="accountType">
                            <span>شخصی</span>
                        </label>
                    </div>
                    <div>
                        <input name="accountType" value="company" id="accountType" type="radio">
                        <label for="accountType">
                            <span>شـرکتی</span>
                            <span>( یک شنبه، دوشنبه، سه شـنبه، چهارشنبه )</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="row-input">
                <label>سفارش دهنده</label>
                <div class="buyer">
                    <div>
                        <label for="name">نام</label>
                        <input name="name" id="name" type="text" placeholder="نام">
                    </div>
                    <div>
                        <label for="phone">شماره تماس</label>
                        <input name="phone" id="phone" type="text" placeholder="شماره تماس">
                    </div>
                </div>
            </div>

            <button id="submitOrder">ثبت سفارش</button>
            <p id="loading" class="hidden" style="margin-top: 5px; text-align: center; color: var(--main-color)">در حال ارسال درخواست، لطفا شکیبا باشید</p>
            <p class="hidden" id="errText">
                <span class="fa fa-warning"></span>
                <span>لطفـا فیلد مورد نظـر را تکمیل نمایید</span>
            </p>
        </div>

        <footer>
            <p>
                <span>تسـهیلات اعتبـاری برای صرافی های معتبر</span>
                <span>|</span>
                <span>شـماره تماس: 09102331427</span>
            </p>
        </footer>

        <script>
            var currencies = {!! json_encode($currencies) !!};
        </script>
        <script src="{{asset('assets/js/script.js?v=1.5')}}"></script>
    </body>
</html>