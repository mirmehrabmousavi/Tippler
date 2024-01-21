<div role="tabpanel" class="tab-pane {{(request()->tab == '')? 'active' : ' fade'}}" id="general"
     aria-labelledby="settings-general" aria-expanded="true">
    <form novalidate="">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="site-name">نام سایت : </label>
                        <input type="text" class="form-control" name="name" id="site-name" placeholder="نام سایت را وارد گنید" value="{{$name}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="site-title">عنوان سایت : </label>
                        <input type="text" class="form-control" name="title" id="site-title" placeholder="عنوان سایت را وارد کنید" value="{{$title}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="site-logo">لوگو سایت : </label>
                        <input type="text" class="form-control" name="logo" id="site-logo" placeholder="لوگو سایت را وارد کنید" value="{{$logo}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="site-giftDis">حداکثر کد تخفیف در جعبه جادویی : </label>
                        <input type="text" class="form-control" name="giftDis" id="site-giftDis" placeholder="مثال : 2" value="{{$giftDis}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="site-address">آدرس سایت : </label>
                        <input type="text" class="form-control" name="address" id="site-address" placeholder="آدرس سایت را وارد کنید" value="{{$address}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="site-email">ایمیل سایت : </label>
                        <input type="text" class="form-control" name="email" id="site-email" placeholder="ایمیل سایت را وارد کنید" value="{{$email}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="site-fanavari">کد نماد فناوری اطلاعات : </label>
                        <input type="text" class="form-control" name="fanavari" id="site-fanavari" placeholder="کد نماد فناوری اطلاعات را وارد کنید" value="{{$fanavari}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="site-etemad">کد نماد اعتماد : </label>
                        <input type="text" class="form-control" name="etemad" id="site-etemad" placeholder="کد نماد اعتماد را وارد کنید" value="{{$etemad}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="site-headerColor">رنگ هدر : </label>
                        <input type="text" class="form-control" name="headerColor" id="site-headerColor" placeholder="رنگ هدر را وارد کنید" value="{{$headerColor}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="site-sideColor">رنگ ساید بار : </label>
                        <input type="text" class="form-control" name="sideColor" id="site-sideColor" placeholder="رنگ سایدبار را وارد کنید" value="{{$sideColor}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="site-number">شماره تماس : </label>
                        <input type="text" class="form-control" name="number" id="site-number" placeholder="شماره تماس را وارد کنید" value="{{$number}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="site-productId">حروف قبل کد محصول : </label>
                        <input type="text" class="form-control" name="productId" id="site-productId" placeholder="مثال : Product-" value="{{$productId}}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <div class="controls">
                        <label for="site-about">درباره ما : </label>
                        <textarea class="form-control" name="about" id="site-about" placeholder="درباره ما را وارد کنید">{{$about}}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <div class="controls">
                        <label for="site-holidays">روز های تعطیل هفته : </label>
                        <select id="site-holidays" class="form-control w-100" name="holidays" multiple="multiple">
                            <option value="1">شنبه</option>
                            <option value="2">یکشنبه</option>
                            <option value="3">دوشنبه</option>
                            <option value="4">سه شنبه</option>
                            <option value="5">چهارشنبه</option>
                            <option value="6">پنجشنبه</option>
                            <option value="7">جمعه</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="custom-control custom-switch custom-control-inline">
                    <input type="checkbox" name="minifySource" class="custom-control-input" id="site-minifySource">
                    <label class="custom-control-label" for="site-minifySource"></label>
                    <span class="switch-label">فشرده سازی سورس کد</span>
                </div>
            </div>
            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                <button {{--type="submit"--}} id="createSite" class="btn btn-outline-success btn-sm mr-sm-1 mb-1 mb-sm-0 waves-effect waves-light">ذخیره</button>
            </div>
        </div>
    </form>
</div>

@section('script-settings-site')
    <script>
        $('#site-holidays').select2({
            placeholder: 'روز های تعطیل هفته را انتخاب کنید ...',
            "language": {
                "noResults": function () {
                    return "موردی پیدا نشد";
                }
            },
        });
        //Site Update Data
        $("#createSite").click(function (event) {
            event.preventDefault()
            $("#createSite").text('صبر کنید ...');

            var name = $("#site-name").val();
            var title = $("#site-title").val();
            var logo = $("#site-logo").val();
            var giftDis = $("#site-giftDis").val();
            var about = $("#site-about").val();
            var address = $("#site-address").val();
            var email = $("#site-email").val();
            var number = $("#site-number").val();
            var fanavari = $("#site-fanavari").val();
            var etemad = $("#site-etemad").val();
            var productId = $("#site-productId").val();
            var headerColor = $("#site-headerColor").val();
            var sideColor = $("#site-sideColor").val();
            var minifySource = $("#site-minifySource").val();
            var holidays = $("select[name='holidays'] :selected").map(function(){
                var holiday = $(this).val()
                return {holiday};
            }).get();

            $.ajax({
                url: "{{route('admin.settings.siteUpdate')}}",
                type: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    name: name,
                    title: title,
                    logo: logo,
                    giftDis: giftDis,
                    about: about,
                    address: address,
                    email: email,
                    number: number,
                    fanavari: fanavari,
                    etemad: etemad,
                    headerColor: headerColor,
                    sideColor: sideColor,
                    productId: productId,
                    holidays: JSON.stringify(holidays),
                    minifySource: minifySource,
                },
                success: function (data) {
                    toastr.success('با موفقیت ذخیره شد.');
                    window.location.href = "/admin/settings";
                },
                error: function (response) {
                    toastr.success('مشکلی پیش اومده بعدا امتحان کن.')
                    $("#createSite").text('ذخیره');
                }
            });
        });
    </script>
@endsection
