@extends('auth.layout')
  
@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/fontface.css') }}" />
<style>
    table {
        direction: rtl;
        font-family: IRANSans;
        margin: 50px auto;
    }
    td, th {
        padding: 10px;
        border: 1px solid;
        text-align: center;
    }
    .modal {
        font-family: IRANSans;
    }
    .modal .modal-body {
        direction: rtl;
        text-align: right;
    }
    input {
        text-align: left;
        direction: ltr;
    }
</style>
<script>
    var selectedCountry;
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
  
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <table>
                        <thead>
                            <th>ردیف</th>
                            <th>نام ارز</th>
                            <th>کشور</th>
                            <th>اختلاف قیمت</th>
                            <th>آخرین تغییر</th>
                            <th>عملیات</th>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($currencies as $currency)
                                @foreach ($currency['countries'] as $country)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$currency['name']}}</td>
                                        <td>{{$country['name']}}</td>
                                        <td id="country_{{$country['id']}}_price">{{$country['price']}}</td>
                                        <td>{{$country['updated_at']}}</td>
                                        <td>
                                            <button onclick="selectedCountry = '{{$country['id']}}'; $('#newPrice').val('{{str_replace(',', '', $country['price'])}}')" type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">
                                                <span class="fa fa-edit"></span>
                                            </button>
                                        </td>
                                    </tr>
                                    
                                    <?php $i++; ?>

                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="exampleModal" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تغییر اختلاف قیمت</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>اختلاف قیمت روز را وارد نمایید</p>
                    <input onkeypress="return isNumber(event)" type="text" id="newPrice" />
                </div>
                <div class="modal-footer">
                    <button onclick="changePrice()" type="button" class="btn btn-primary">ثبت تغییرات</button>
                    <button id="closeBtn" type="button" class="btn btn-secondary" data-dismiss="modal">انصراف</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    
    function isNumber(evt) {
        evt = evt ? evt : window.event;
        var charCode = evt.which ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

    function changePrice() {
        
        let price = parseInt($("#newPrice").val().toString());
        if(price === undefined) {
            alert('لطفا اختلاف قیمت موردنظر را وارد نمایید');
            return;
        }

        $.ajax({
            type: 'post',
            url: '{{route('updatePrice')}}',
            data: {
                country: selectedCountry,
                price: price
            },
            success: function(res) {
                if(res.status === 'ok') {
                    $("#country_" + selectedCountry + "_price").empty().append(price.formatPrice(0, ",", ""));
                    $("#closeBtn").click();
                }
            }
        });
    }

</script>

@endsection