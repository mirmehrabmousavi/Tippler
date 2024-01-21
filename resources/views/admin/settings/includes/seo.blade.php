<div role="tabpanel" class="tab-pane {{(request()->tab == 'seo')? 'active' : ' fade'}}" id="seo"
     aria-labelledby="settings-seo" aria-expanded="true">
    <form novalidate="">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <div class="controls">
                        <label for="site-meta-title">عنوان فعالیت سایت : </label>
                        <input type="text" class="form-control" name="meta_title" id="site-meta-title" placeholder="عنوان فعالیت سایت را وارد کنید" value="{{$meta_title}}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <div class="controls">
                        <label for="site-meta-keyword">کلمات کلیدی سایت : </label>
                        <input type="text" class="form-control" name="meta_keyword" id="site-meta-keyword" placeholder="با , جدا کنید" value="{{$meta_keyword}}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <div class="controls">
                        <label for="site-meta-desc">توضیحات سئو سایت : </label>
                        <textarea class="form-control" name="meta_desc" id="site-meta-desc" placeholder="توضیحات سئو را وارد کنید">{{$meta_desc}}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                <button type="submit" id="createSeo" class="btn btn-outline-success btn-sm mr-sm-1 mb-1 mb-sm-0 waves-effect waves-light">ذخیره</button>
            </div>
        </div>
    </form>
</div>

@section('script-settings-seo')
    <script>
        //Seo Update Data
        $("#createSeo").click(function (event) {
            event.preventDefault()
            $("#createSeo").text('صبر کنید ...');

            var meta_title = $("#site-meta-title").val();
            var meta_keyword = $("#site-meta-keyword").val();
            var meta_desc = $("#site-meta-desc").val();

            $.ajax({
                url: "{{route('admin.settings.seoUpdate')}}",
                type: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    meta_title: meta_title,
                    meta_keyword: meta_keyword,
                    meta_desc: meta_desc,
                },
                success: function (data) {
                    toastr.success('با موفقیت ذخیره شد.');
                    window.location.href = "/admin/settings?tab=seo";
                },
                error: function (response) {
                    toastr.success('مشکلی پیش اومده بعدا امتحان کن.')
                    $("#createSeo").text('ذخیره');
                }
            });
        });
    </script>
@endsection
