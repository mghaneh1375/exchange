<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('assets/css/fontface.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/newStyle.css?v=2.0') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/success.css?v=2.1') }}" />
        <meta property="og:title" content="TehranPage" />
        <meta property="og:url" content="{{route('home2') . '/v=' . time()}}" />
        <meta property="og:image" content="{{asset('assets/img/logo2.png')}}" />
        <meta property="og:locale" content="fa_IR" />
        <meta property="og:type" content="website" />
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/img/apple-touch-icon.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="href="{{asset('assets/img/favicon-32x32.png')}}"">
        <link rel="icon" type="image/png" sizes="16x16" href="href="{{asset('assets/img/favicon-16x16.png')}}"">
        <link rel="manifest" href="href="{{asset('assets/img/site.webmanifest')}}"">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>TehranPage</title>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    </head>
    <body>
        <div style="display: flex; margin-top: 20px; margin-bottom: 40px; align-items: center">
            <nav style="display: none">
                <img onclick="document.location.href = '{{route('home2')}}'" src="{{asset('assets/img/logo2.png')}}" width="50px" />
                <p>مبــادلات بین المللـی ارز</p>
            </nav>
            <div class="card">
                
                <img src="{{asset('assets/img/newerr.png')}}" />
                <p class="err-msg">خطا در ثبت</p>
                <p class="success-desc">در فرآیند ثبت سفارش حواله شما خطایی رخ داده<br/>لطفا مجدد تلاش کنید.</p>

                <button onclick="document.location.href = '{{route('home2')}}'" class="submit-btn">
                    <span>ثبت سفارش جدید</span>
                    <img src="{{asset('assets/img/left-btn-group.svg')}}" />
                </button>
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

    </body>
</html>