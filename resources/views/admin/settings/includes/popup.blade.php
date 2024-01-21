<div role="tabpanel" class="tab-pane {{(request()->tab == 'popup')? 'active' : ' fade'}}" id="popup"
     aria-labelledby="settings-popup" aria-expanded="false">
    <form novalidate="">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="imagePopUp">لینک تصویر را قرار بدید : </label>
                        <input type="text" class="form-control" name="imagePopUp" id="imagePopUp" placeholder="مثال : upload/picture.jpg/" value="{{$imagePopUp}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="titlePopUp">عنوان پاپ آپ* : </label>
                        <input type="text" class="form-control" name="titlePopUp" id="titlePopUp" placeholder="عنوان پاپ آپ را وارد کنید" value="{{$titlePopUp}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="addressPopUp">آدرس (url) انتقال : </label>
                        <input type="text" class="form-control" name="addressPopUp" id="addressPopUp" placeholder="مثال : example/products/" value="{{$addressPopUp}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="buttonPopUp">عنوان دکمه : </label>
                        <input type="text" class="form-control" name="buttonPopUp" id="buttonPopUp" placeholder="مثال : مشاهده" value="{{$buttonPopUp}}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <div class="controls">
                        <label for="descriptionPopUp">توضیحات پاپ آپ : </label>
                        <textarea class="form-control" name="descriptionPopUp" id="descriptionPopUp" placeholder="توضیحات را وارد کنید">{{$descriptionPopUp}}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="custom-control custom-switch custom-control-inline">
                    <input type="checkbox" name="popUpStatus" class="custom-control-input" id="popUpStatus" {{$popUpStatus === 'on'? 'checked' : ''}}>
                    <label class="custom-control-label" for="popUpStatus"></label>
                    <span class="switch-label">فعال سازی</span>
                </div>
            </div>
            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                <button type="submit" id="createPopUp" class="btn btn-outline-success btn-sm mr-sm-1 mb-1 mb-sm-0 waves-effect waves-light">ذخیره</button>
            </div>
        </div>
    </form>
</div>

@section('script-settings-popup')
    <script>
        //PopUp Update Data
        $("#createPopUp").click(function (event) {
            event.preventDefault()
            $("#createPopUp").text('صبر کنید ...');

            var imagePopUp = $('input[name="imagePopUp"]').val();
            var titlePopUp = $('input[name="titlePopUp"]').val();
            var addressPopUp = $('input[name="addressPopUp"]').val();
            var popUpStatus = $('input[name="popUpStatus"]').val();
            var descriptionPopUp = $('textarea[name="descriptionPopUp"]').val();
            var buttonPopUp = $('input[name="buttonPopUp"]').val();

            $.ajax({
                url: "{{route('admin.settings.popupUpdate')}}",
                type: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    imagePopUp: imagePopUp,
                    titlePopUp: titlePopUp,
                    addressPopUp: addressPopUp,
                    popUpStatus: popUpStatus,
                    descriptionPopUp: descriptionPopUp,
                    buttonPopUp: buttonPopUp,
                },
                success: function (data) {
                    toastr.success('با موفقیت ذخیره شد.');
                    window.location.href = "/admin/settings?tab=popup";
                },
                error: function (response) {
                    toastr.success('مشکلی پیش اومده بعدا امتحان کن.')
                    $("#createPopUp").text('ذخیره');
                }
            });
        });
    </script>
@endsection
