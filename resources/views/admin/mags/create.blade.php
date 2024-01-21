@extends('admin.layouts.app')

@section('style')
@endsection

@section('content')
    <h4>افزودن مقاله</h4>
    <div class="row">
        <div class="col-md-8 col-8">
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
                                @include('admin.galleries.file-manager')
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
        <div class="col-md-4 col-4">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="category">دسته بندی :</label>
                                        <select name="categories" id="category" class="form-control" multiple="multiple">
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="tag">برجسب :</label>
                                        <select name="tags" id="tag" class="form-control" multiple="multiple">
                                            @foreach($tags as $tag)
                                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                                            @endforeach
                                        </select>
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
            <button id="createBlog" class="btn btn-outline-success btn-sm mr-1 mb-1 waves-effect waves-light">ذخیره</button>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        let theEditor;
        ClassicEditor
            .create( document.querySelector( '#content' ),{
                ckfinder: {
                    uploadUrl: '{{route('admin.galleries.ckeditorUpload').'?_token='.csrf_token()}}',
                },
                language: 'fa',
            })
            .then(editor => {
                theEditor = editor;
            })
            .catch( error => {

            } );

        $(document).ready(function() {

            $("#showMeta").on('click', function () {
                $('#meta').slideToggle('slow');
            });

            $('#category').select2({
                placeholder: 'دسته بندی را انتخاب کنید ...',
                "language": {
                    "noResults": function () {
                        return "موردی پیدا نشد";
                    }
                },
            });

            $('#tag').select2({
                placeholder: 'برچسب را انتخاب کنید ...',
                "language": {
                    "noResults": function () {
                        return "موردی پیدا نشد";
                    }
                },
            });

            $("#createBlog").click(function (event) {
                event.preventDefault()
                $("#createBlog").text('صبر کنید ...');
                var images = $("#imageContainer #getImagePic").map(function () {
                    var name = $(this).find('.name').html()
                    var image = $(this).find('img').attr('src')
                    var size = $(this).find('.size').html()
                    var type = $(this).find('.type').html()
                    return {name: name, image: image, size: size, type: type};
                }).get();

                var tags1 = [];
                var cats = [];

                $("select[name='tags'] :selected").map(function(){
                    tags1.push($(this).val());
                });

                $("select[name='categories'] :selected").map(function(){
                    cats.push($(this).val());
                });

                var title = $("input[name='title']").val();
                var slug = $("input[name='slug']").val();
                var categories = cats;
                var tags = tags1;
                var image = images;
                var content = theEditor.getData();
                var meta_title = $("input[name='meta_title']").val();
                var meta_keyword = $("textarea[name='meta_keyword']").val();
                var meta_desc = $("textarea[name='meta_desc']").val();

                $.ajax({
                    url: "{{route('admin.mags.store')}}",
                    type: "post",
                    data: {
                        _token: '{{csrf_token()}}',
                        title: title,
                        slug: slug,
                        category: JSON.stringify(categories),
                        tags: JSON.stringify(tags),
                        image: JSON.stringify(image),
                        content: content,
                        meta_title: meta_title,
                        meta_keyword: meta_keyword,
                        meta_desc: meta_desc,
                    },
                    success: function (data) {
                        toastr.success('با موفقیت ذخیره شد.')
                        window.location.href = "/admin/mags";
                    },
                    error: function (response) {
                        toastr.success('مشکلی پیش اومده بعدا امتحان کن.')
                    }
                });
            });
        })
    </script>
@endsection
