<div role="tabpanel" class="tab-pane {{(request()->tab == 'sms')? 'active' : ' fade'}}" id="sms"
     aria-labelledby="settings-sms" aria-expanded="true">
    <form novalidate="" action="{{route('admin.settings.smsUpdate')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="messageAuth">کد پترن برای ثبتنام (یک متغیر : متغیر اول کد یکبار مصرف) : </label>
                        <input type="text" class="form-control" name="messageAuth" id="messageAuth" placeholder="مثال : 2222" value="{{$messageAuth}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="messageSuccess">کد پترن ثبت سفارش (دو متغیر : متغیر اول نام کاربر و متغیر دوم شماره سفارش) : </label>
                        <input type="text" class="form-control" name="messageSuccess" id="messageSuccess" placeholder="مثال : 2222" value="{{$messageSuccess}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="messageSuggest">کد پترن اطلاع از فروش ویژه(دو متغیر : متغیر اول نام کاربر و متغیر دوم نام محصول) : </label>
                        <input type="text" class="form-control" name="messageSuggest" id="messageSuggest" placeholder="مثال : 2222" value="{{$messageSuggest}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="messageCancel">کد پترن لغو سفارش(دو متغیر : متغیر اول نام کاربر و متغیر دوم شماره سفارش) : </label>
                        <input type="text" class="form-control" name="messageCancel" id="messageCancel" placeholder="مثال : 2222" value="{{$messageCancel}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="messageBack">کد پترن بازگشت پول(سه متغیر : متغیر اول نام کاربر و متغیر دوم شماره سفارش و متغیر سوم مبلغ) : </label>
                        <input type="text" class="form-control" name="messageBack" id="messageBack" placeholder="مثال : 2222" value="{{$messageBack}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="messageManager">کد پترن اطلاع به مدیر از ثبت سفارش(سه متغیر : متغیر اول نام خریدار و متغیر دوم شماره سفارش و متغیر سوم مبلغ) : </label>
                        <input type="text" class="form-control" name="messageManager" id="messageManager" placeholder="مثال : 2222" value="{{$messageManager}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="messageCounseling">کد پترن مشاوره فوری(دو متغیر : متغیر اول شماره تماس و متغیر دوم عنوان محصول) : </label>
                        <input type="text" class="form-control" name="messageCounseling" id="messageCounseling" placeholder="مثال : 2222" value="{{$messageCounseling}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="userSms">نام کاربری ملی پیامک : </label>
                        <input type="text" class="form-control" name="userSms" id="userSms" placeholder="نام کاربری ملی پیامک را وارد کنید" value="{{$userSms}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="passSms">رمز عبور ملی پیامک : </label>
                        <input type="text" class="form-control" name="passSms" id="passSms" placeholder="رمز عبور ملی پیامک را وارد کنید" value="{{$passSms}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="kaveKey">کلید کاوه نگار : </label>
                        <input type="text" class="form-control" name="kaveKey" id="kaveKey" placeholder="کلید کاوه نگار را وارد کنید" value="{{$kaveKey}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="userFaraz">نام کاربری فراز : </label>
                        <input type="text" class="form-control" name="userFaraz" id="userFaraz" placeholder="نام کاربری فراز را وارد کنید" value="{{$userFaraz}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="passFaraz">رمز عبور فراز : </label>
                        <input type="text" class="form-control" name="passFaraz" id="passFaraz" placeholder="رمز عبور فراز را وارد کنید" value="{{$passFaraz}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="numberFaraz">شماره تماس فراز : </label>
                        <input type="text" class="form-control" name="numberFaraz" id="numberFaraz" placeholder="شماره تماس فراز را وارد کنید" value="{{$numberFaraz}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="typeSms">سامانه پیامکی شما : </label>
                        <select class="form-control" name="typeSms" id="typeSms">
                            <option value="0" {{$typeSms == 0? 'selected' : ''}}>قاصدک</option>
                            <option value="1" {{$typeSms == 1? 'selected' : ''}}>ملی پیامک</option>
                            <option value="2" {{$typeSms == 2? 'selected' : ''}}>کاوه نگار</option>
                            <option value="3" {{$typeSms == 3? 'selected' : ''}}>فراز اس ام اس</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                <button type="submit" class="btn btn-outline-success btn-sm mr-sm-1 mb-1 mb-sm-0 waves-effect waves-light">ذخیره</button>
            </div>
        </div>
    </form>
</div>

@section('script-settings-sms')
    <script>

    </script>
@endsection
