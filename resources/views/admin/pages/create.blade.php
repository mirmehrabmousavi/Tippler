@extends('admin.layouts.app')

@section('style')
@endsection

@section('content')
    <h4>افزودن برگه</h4>
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="title">عنوان* :</label>
                                        <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="عنوان را وارد کنید" name="title">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="slug">پیوند :</label>
                                        <input type="text" id="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="پیوند را وارد کنید" name="slug">
                                    </div>
                                </div>
                                @include('admin.galleries.file-manager', ['col12' => 'col-12', 'btn' => 'btn-sm'])
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="content">محتوا :</label>
                                        <textarea id="content" class="form-control @error('content') is-invalid @enderror ckeditor" name="content" placeholder="محتوا"></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <a id="showMeta" class="text-secondary mr-1 waves-effect waves-light rounded-pill" style="padding: 5px"><i class="feather icon-plus-circle"></i> افزودن متا</a>
                                </div>
                                <div class="col-12">
                                    <div id="meta" class="row" style="display: none">

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="meta_title">عنوان متا :</label>
                                                <input type="text" id="meta_title" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" placeholder="عنوان متا را وارد کنید">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="meta_keyword">کلمه کلیدی متا :</label>
                                                <textarea id="meta_keyword" class="form-control @error('meta_keyword') is-invalid @enderror" name="meta_keyword" placeholder="با , جدا کنید"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="meta_desc">توضیحات متا :</label>
                                                <textarea id="meta_desc" class="form-control @error('meta_desc') is-invalid @enderror" name="meta_desc" placeholder="توضیحات متا را وارد کنید"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <button id="createPage" class="btn btn-outline-success btn-sm mr-1 mb-1 waves-effect waves-light">ذخیره</button>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            CKEDITOR.replace('.ckeditor');

            $("#showMeta").on('click', function () {
                $('#meta').slideToggle('slow');
            });

            $("#createPage").click(function (event) {
                event.preventDefault()
                $("#createPage").text('صبر کنید ...');
                var images = $("#imageContainer #getImagePic").map(function () {
                    var name = $(this).find('.name').html()
                    var image = $(this).find('img').attr('src')
                    var size = $(this).find('.size').html()
                    var type = $(this).find('.type').html()
                    return {name: name, image: image, size: size, type: type};
                }).get();

                var title = $("input[name='title']").val();
                var slug = $("input[name='slug']").val();
                var image = images;
                var content = CKEDITOR.instances["content"].getData();
                var meta_title = $("input[name='meta_title']").val();
                var meta_keyword = $("input[name='meta_keyword']").val();
                var meta_desc = $("textarea[name='meta_desc']").val();

                $.ajax({
                    url: "{{route('admin.pages.store')}}",
                    type: "post",
                    data: {
                        _token: '{{csrf_token()}}',
                        title: title,
                        slug: slug,
                        image: JSON.stringify(image),
                        content: content,
                        meta_title: meta_title,
                        meta_keyword: meta_keyword,
                        meta_desc: meta_desc,
                    },
                    success: function (data) {
                        toastr.success('با موفقیت ذخیره شد.')
                        window.location.href = "/admin/pages";
                    },
                    error: function (response) {
                        toastr.success('مشکلی پیش اومده بعدا امتحان کن.')
                    }
                });
            });
        })
    </script>
@endsection
