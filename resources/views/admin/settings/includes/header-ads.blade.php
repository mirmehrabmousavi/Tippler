<div role="tabpanel" class="tab-pane {{(request()->tab == 'headerAds')? 'active' : ' fade'}}" id="headerAds"
     aria-labelledby="settings-header-ads" aria-expanded="true">
    <form novalidate="">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <div class="controls">
                        <label for="heightHeader">ارتفاع تبلیغ بالا هدر(px) : </label>
                        <input type="text" class="form-control" name="heightHeader" id="heightHeader" placeholder="مثال : 20" value="{{$heightHeader}}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <div class="controls">
                        <label for="imageHeader">لینک تضویر : </label>
                        <input type="text" class="form-control" name="imageHeader" id="imageHeader" placeholder="مثال : upload/picture.jpg/" value="{{$imageHeader}}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <div class="controls">
                        <label for="linkHeader">آدرس (URL) : </label>
                        <input type="text" class="form-control" name="linkHeader" id="linkHeader" placeholder="مثال : example/" value="{{$linkHeader}}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="custom-control custom-switch custom-control-inline">
                    <input type="checkbox" name="adHeaderStatus" class="custom-control-input" id="adHeaderStatus" {{$adHeaderStatus === 'on'? 'checked' : ''}}>
                    <label class="custom-control-label" for="adHeaderStatus"></label>
                    <span class="switch-label">فعال سازی</span>
                </div>
            </div>
            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                <button type="submit" id="createHeaderAds" class="btn btn-outline-success btn-sm mr-sm-1 mb-1 mb-sm-0 waves-effect waves-light">ذخیره</button>
            </div>
        </div>
    </form>
</div>

@section('script-settings-header-ads')
    <script>
        //HeaderADs Update Data
        $("#createHeaderAds").click(function (event) {
            event.preventDefault()
            $("#createHeaderAds").text('صبر کنید ...');

            var heightHeader = $('input[name="heightHeader"]').val();
            var imageHeader = $('input[name="imageHeader"]').val();
            var linkHeader = $('input[name="linkHeader"]').val();
            var adHeaderStatus = $('input[name="adHeaderStatus"]').val();

            $.ajax({
                url: "{{route('admin.settings.headerAdsUpdate')}}",
                type: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    heightHeader: heightHeader,
                    imageHeader: imageHeader,
                    linkHeader: linkHeader,
                    adHeaderStatus: adHeaderStatus,
                },
                success: function (data) {
                    toastr.success('با موفقیت ذخیره شد.');
                    window.location.href = "/admin/settings?tab=headerAds";
                },
                error: function (response) {
                    toastr.success('مشکلی پیش اومده بعدا امتحان کن.')
                    $("#createHeaderAds").text('ذخیره');
                }
            });
        });
    </script>
@endsection
