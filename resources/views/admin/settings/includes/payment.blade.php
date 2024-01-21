<div role="tabpanel" class="tab-pane {{(request()->tab == 'payment')? 'active' : ' fade'}}" id="payment"
     aria-labelledby="settings-payment" aria-expanded="true">
    <form novalidate="" action="{{route('admin.settings.paymentUpdate')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="zarinpal">کد مرچنت زرین پال : </label>
                        <input type="text" class="form-control" name="zarinpal" id="zarinpal" placeholder="کد مرچنت زرین پال را وارد کنید" value="{{$zarinpal}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="zibal">کد مرچنت زیبال : </label>
                        <input type="text" class="form-control" name="zibal" id="zibal" placeholder="کد مرچنت زیبال را وارد کنید" value="{{$zibal}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="idpay">کد مرچنت آیدی پی : </label>
                        <input type="text" class="form-control" name="idpay" id="idpay" placeholder="کد مرچنت آیدی پی را وارد کنید" value="{{$idpay}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="nextpay">کد مرچنت نکست پی : </label>
                        <input type="text" class="form-control" name="nextpay" id="nextpay" placeholder="کد مرچنت نکست پی را وارد کنید" value="{{$nextpay}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="terminalBeh">ترمینال آیدی به پرداخت : </label>
                        <input type="text" class="form-control" name="terminalBeh" id="terminalBeh" placeholder="ترمینال آیدی به پرداخت را وارد کنید" value="{{$terminalBeh}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="userBeh">نام کاربری به پرداخت : </label>
                        <input type="text" class="form-control" name="userBeh" id="userBeh" placeholder="نام کاربری به پرداخت را وارد کنید" value="{{$userBeh}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="passwordBeh">رمز به پرداخت : </label>
                        <input type="text" class="form-control" name="passwordBeh" id="passwordBeh" placeholder="رمز به پرداخت را وارد کنید" value="{{$passwordBeh}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="keySadad">کلید سداد : </label>
                        <input type="text" class="form-control" name="keySadad" id="keySadad" placeholder="کلید سداد را وارد کنید" value="{{$keySadad}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="merchantSadad">کد پذیرنده سداد : </label>
                        <input type="text" class="form-control" name="merchantSadad" id="merchantSadad" placeholder="کد پذیرنده سداد را وارد کنید" value="{{$merchantSadad}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="terminalSadad">پایانه سداد : </label>
                        <input type="text" class="form-control" name="terminalSadad" id="terminalSadad" placeholder="پایانه سداد را وارد کنید" value="{{$terminalSadad}}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <div class="controls">
                        <label for="choicePay">درگاه خود را انتخاب کنید : </label>
                        <select class="form-control" name="choicePay" id="choicePay">
                            <option value="0">زرینپال</option>
                            <option value="1">زیبال</option>
                            <option value="2">نکست پی</option>
                            <option value="3">آیدی پی</option>
                            <option value="4">به پرداخت ملت</option>
                            <option value="5">سداد</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="cardText">اطلاعات حساب شما جهت خرید :</label>
                    <textarea id="cardText" class="form-control @error('cardText') is-invalid @enderror ckeditor" name="cardText" placeholder="اطلاعات حساب شما جهت خرید را وارد کنید"></textarea>
                </div>
            </div>
            <div class="col-3 p-1">
                <fieldset>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="" name="installment" id="installment" {{$installment? 'checked' : ''}}>
                        <label class="custom-control-label" for="installment">پرداخت اقساطی</label>
                    </div>
                </fieldset>
            </div>
            <div class="col-3 p-1">
                <fieldset>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="" name="spot" id="spot" {{$spot? 'checked' : ''}}>
                        <label class="custom-control-label" for="spot">پرداخت در محل</label>
                    </div>
                </fieldset>
            </div>
            <div class="col-3 p-1">
                <fieldset>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="" name="gateway" id="gateway" {{$gateway? 'checked' : ''}}>
                        <label class="custom-control-label" for="gateway">پرداخت از درگاه</label>
                    </div>
                </fieldset>
            </div>
            <div class="col-3 p-1">
                <fieldset>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="" name="card" id="card" {{$card? 'checked' : ''}}>
                        <label class="custom-control-label" for="card">خرید کارت به کارت</label>
                    </div>
                </fieldset>
            </div>
            <div class="col-3 p-1">
                <fieldset>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="" name="zarinpalStatus" id="zarinpalStatus" {{$zarinpalStatus? 'checked' : ''}}>
                        <label class="custom-control-label" for="zarinpalStatus">امکان خرید از زرینپال</label>
                    </div>
                </fieldset>
            </div>
            <div class="col-3 p-1">
                <fieldset>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="" name="zibalStatus" id="zibalStatus" {{$zibalStatus? 'checked' : ''}}>
                        <label class="custom-control-label" for="zibalStatus">امکان خرید از زیبال</label>
                    </div>
                </fieldset>
            </div>
            <div class="col-3 p-1">
                <fieldset>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="" name="nextpayStatus" id="nextpayStatus" {{$nextpayStatus? 'checked' : ''}}>
                        <label class="custom-control-label" for="nextpayStatus">امکان خرید از نکست پی</label>
                    </div>
                </fieldset>
            </div>
            <div class="col-3 p-1">
                <fieldset>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="" name="idpayStatus" id="idpayStatus" {{$idpayStatus? 'checked' : ''}}>
                        <label class="custom-control-label" for="idpayStatus">امکان خرید از آیدی پی</label>
                    </div>
                </fieldset>
            </div>
            <div class="col-3 p-1">
                <fieldset>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="" name="statusBeh" id="statusBeh" {{$statusBeh? 'checked' : ''}}>
                        <label class="custom-control-label" for="statusBeh">امکان خرید از به پرداخت ملت</label>
                    </div>
                </fieldset>
            </div>
            <div class="col-3 p-1">
                <fieldset>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="" name="statusSadad" id="statusSadad" {{$statusSadad? 'checked' : ''}}>
                        <label class="custom-control-label" for="statusSadad">امکان خرید از سداد</label>
                    </div>
                </fieldset>
            </div>
            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                <button type="submit" class="btn btn-outline-success btn-sm mr-sm-1 mb-1 mb-sm-0 waves-effect waves-light">ذخیره</button>
            </div>
        </div>
    </form>
</div>

@section('script-settings-payment')
    <script>
        CKEDITOR.replace('.ckeditor');
    </script>
@endsection
