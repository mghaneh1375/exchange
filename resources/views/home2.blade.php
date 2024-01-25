<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('assets/css/fontface.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/newStyle.css?v=2.1') }}" />
        <meta name="description" content="{!! html_entity_decode($desc) !!}">
        <meta name="og:description" content="{!! html_entity_decode($desc) !!}">
        <meta property="og:title" content="TehranPage" />
        <meta property="og:url" content="https://echeck.ir/v={{time()}}" />
        <meta property="og:image" content="https://echeck.ir/img/icon.png" />
        <meta property="og:locale" content="fa_IR" />
        <meta property="og:type" content="website" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>TehranPage</title>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script>
            var submitOrderUrl = '{{route('submitOrder')}}';
        </script>
    </head>
    <body>
        <div style="display: flex; margin-top: 20px; margin-bottom: 40px;">
            <nav style="display: none">
                <img src="{{asset('assets/img/logo2.png')}}" width="50px" />
                <p>مبــادلات بین المللـی ارز</p>
            </nav>
            <div class="card">
                <h3>ثبت سفارش حواله</h3>
                <p>نوع ارز را انتخاب کنید:</p>
                <div class="currency-container">
                    @foreach ($currencies as $currency)
                        <div onclick="changeSelectedCurrency('{{$currency['id']}}')" class="currency" id="currency_{{$currency['id']}}">
                            <img src="{{asset('assets/img/' . $currency['icon'])}}" />
                            <p class="currency_name">{{$currency['name']}}</p>
                            <div class="currency_price">
                                <span>{{$currency['price']}}</span>
                                <span>تومان</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="inputs-row">

                    <div class="row-flex">
                        <div class="input-container">
                            <p>کشور مقصد را انتخاب کنید:</p>
                            <select name="country" id="country_options"></select>
                        </div>
                        <div class="input-container">
                            <p>مقدار ارز را وارد نمایید:</p>
                            <input placeholder="مقدار ارز" style="text-align: right" onkeypress="return isNumber(event)" type="text" name="amount" id="amount">
                        </div>
                    </div>

                    <div class="input-row">

                        <p>نوع حساب:</p>

                        <div class="row-flex">
                            <div class="radio-input">
                                <input name="accountType" checked id="individual" value="individual" type="radio" />
                                <label for="individual">شخصی</label>
                            </div>
                            <div class="radio-input">
                                <input name="accountType" id="company" value="company" type="radio" />
                                <div>
                                    <label for="company">شرکتی</label>
                                    <span>یک‌شنبه تا چهارشنبه</span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="input-row">
                        <p>سفارش دهنده:</p>
                        <div class="row-flex">
                            <div class="input-container">
                                <input id="name" type="text" placeholder="نام و نام‌خانوادگی" />
                            </div>
                            <div class="input-container">
                                <input name="phone" id="phone" type="text" onkeypress="return isNumber(event)" placeholder="شماره تماس">
                            </div>
                        </div>
                    </div>
                    
                    <div class="separator"></div>

                    <div class="row-flex should-pay">
                        <p>مبلغ قابل پرداخت</p>
                        <div id="totalPrice"></div>
                    </div>
                </div>

                <button id="submitOrder" class="submit-btn">
                    <span>ثبت سفارش</span>
                    <img src="{{asset('assets/img/left-btn.svg')}}" />
                </button>
                <p id="loading" class="hidden" style="margin-top: 5px; text-align: center; color: var(--main-color)">در حال ارسال درخواست، لطفا شکیبا باشید</p>
                <p class="hidden" id="errText">
                    <span class="fa fa-warning"></span>
                    <span>لطفـا فیلد مورد نظـر را تکمیل نمایید</span>
                </p>
            </div>
            
            <div class="footer" style="display: none">
                <p>تسـهیلات اعتبـاری برای صرافی های معتبر</p>
                <p>شـماره تماس: ۰۹۱۰۲۳۳۱۴۲۷</p>
            </div>
        </div>

        <div>
            <h2>مبادلات بین المللی ارز</h2>
            <img src="{{asset('assets/img/logo2.png')}}" />
        </div>
        
        <script>
            var currencies = {!! json_encode($currencies) !!};
        </script>
        <script src="{{asset('assets/js/script.js?v=2.0')}}"></script>

    </body>
</html>