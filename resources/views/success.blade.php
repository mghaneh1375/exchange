<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('assets/css/fontface.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/style.css?v=1.9') }}" />
        <meta property="og:title" content="TehranPage" />
        <meta property="og:url" content="{{route('home2') . '/v=' . time()}}" />
        <meta property="og:image" content="{{asset('assets/img/logo2.png')}}" />
        <meta property="og:locale" content="fa_IR" />
        <meta property="og:type" content="website" />
    </head>
    <body>
        <div class="top-nav">
            <h2>ثبت سفارش حواله</h2>
        </div>
        <div class="flag">
            <p>مبــادلات بین المللـی ارز</p>
            <img width="40px" height="40px" src="{{asset('assets/img/logo.png')}}" />
        </div>
        <div class="success-page">
            <img width="100px" src="{{asset('assets/img/ok.png')}}" />
            <p>سفارش شـما با موفقیت ثبت شد</p>
            <p>کد پیگیری: {{$trackingCode}}</p>
        </div>
        <footer>
            <p>
                <span>تسـهیلات اعتبـاری برای صرافی های معتبر</span>
                <span>|</span>
                <span>شـماره تماس: 09102331427</span>
            </p>
        </footer>

    </body>
</html>