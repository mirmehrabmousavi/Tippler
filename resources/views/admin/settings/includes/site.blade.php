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
            var about = $("#site-about").val();
            var address = $("#site-address").val();
            var email = $("#site-email").val();
            var number = $("#site-number").val();
            var fanavari = $("#site-fanavari").val();
            var etemad = $("#site-etemad").val();
            var productId = $("#site-productId").val();
            $.ajax({
                url: "{{route('admin.settings.siteUpdate')}}",
                type: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    name: name,
                    title: title,
                    logo: logo,
                    about: about,
                    address: address,
                    email: email,
                    number: number,
                    fanavari: fanavari,
                    etemad: etemad,
                    productId: productId,
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
