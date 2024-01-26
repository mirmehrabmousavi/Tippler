@extends('admin.layouts.app')

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
                                        <input type="text" value="{{$mag->title}}" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="عنوان را وارد کنید" name="title">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="slug">پیوند :</label>
                                        <input type="text" value="{{$mag->slug}}" id="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="پیوند را وارد کنید" name="slug">
                                    </div>
                                </div>
                                @include('admin.galleries.file-manager')
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="content">محتوا :</label>
                                        <textarea id="content" class="form-control @error('content') is-invalid @enderror ckeditor" name="content" placeholder="محتوا">{!! $mag->content !!}</textarea>
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
                                                <input type="text" value="{{$mag->meta_title}}" id="meta_title" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" placeholder="عنوان متا را وارد کنید">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="meta_keyword">کلمه کلیدی متا :</label>
                                                <textarea id="meta_keyword" class="form-control @error('meta_keyword') is-invalid @enderror" name="meta_keyword" placeholder="با , جدا کنید">{{$mag->meta_keyword}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="meta_desc">توضیحات متا :</label>
                                                <textarea id="meta_desc" class="form-control @error('meta_desc') is-invalid @enderror" name="meta_desc" placeholder="توضیحات متا را وارد کنید">{{$mag->meta_desc}}</textarea>
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
                                                <option value="{{$category->id}}" {{ in_array($category->id, $selectedCats) ? 'selected' : '' }}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="tag">برجسب :</label>
                                        <select name="tags" id="tag" class="form-control" multiple="multiple">
                                            @foreach($tags as $tag)
                                                <option value="{{$tag->id}}" {{ in_array($tag->id, $selectedTags) ? 'selected' : '' }}>{{$tag->name}}</option>
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
            <button id="editMag" class="btn btn-outline-success btn-sm mr-1 mb-1 waves-effect waves-light">ذخیره</button>
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
        $(document).ready(function () {
            var mag = {!! $mag->toJson() !!};

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

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

            if (mag.image) {
                $.each(JSON.parse(mag.image), function () {
                    $('#gallery').modal('hide');
                    $('#imageTooltip').hide();
                    $('#imageContainer').append(
                        $(`<div id="getImagePic" class="col-lg-4 col-md-6 l-sm-12 parent">
                                <a>
                                    <div class="card overlay-img-card text-white dataGallery">
                                        <img src="${this.image}" class="card-img" alt="card-img-6" height="200">
                                        <div class="card-img-overlay overlay-black">
                                            <h5 class="font-medium-5 text-white text-center mt-4 name">${this.name}</h5>
                                                    <p class="text-secondary text-center"><span class="size">Size : ${this.size}</span> | <span class="type">Type : ${this.type}</span></p>
                                            <div class="d-flex justify-content-center">
                                                 <a href="#" id="deleteImg" class="btn-secondary text-danger waves-effect waves-light p-1 rounded-pill text-center"><i class="feather icon-trash" style="font-size: 18px"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>`)
                            .on('click', '#deleteImg', function (ss) {
                                ss.currentTarget.parentElement.parentElement.parentElement.parentElement.remove();
                                if (ss.currentTarget.parentElement.parentElement.parentElement.parentElement.length !== '<img id="deleteImg" src="' + ss.currentTarget.parentElement.parentElement.parentElement.parentElement + '" width="150">') {
                                    $('#imageTooltip').show();
                                }
                            })
                    );
                });
            }

            $("#editMag").click(function (event) {
                event.preventDefault()

                var title = $("input[name='title']").val();
                var slug = $("input[name='slug']").val();
                var images = $("#imageContainer #getImagePic").map(function() {
                    var name = $(this).find('.name').html()
                    var image = $(this).find('img').attr('src')
                    var size = $(this).find('.size').html()
                    var type = $(this).find('.type').html()
                    return { name: name, image: image, size: size, type: type };
                }).get();

                var category = []
                $("select[name='categories'] :selected").map(function(){
                    category.push($(this).val());
                });

                var tag = []
                $("select[name='tags'] :selected").map(function(){
                    tag.push($(this).val());
                });
                var content = theEditor.getData();
                var meta_title = $("input[name='meta_title']").val();
                var meta_keyword = $("textarea[name='meta_keyword']").val();
                var meta_desc = $("textarea[name='meta_desc']").val();

                $.ajax({
                    url: "{{route('admin.mags.update', [$mag->id])}}",
                    type: "PUT",
                    data: {
                        _token: '{{csrf_token()}}',
                        title: title,
                        slug: slug,
                        categories: JSON.stringify(category),
                        tags: JSON.stringify(tag),
                        image: JSON.stringify(images),
                        content: content,
                        meta_title: meta_title,
                        meta_keyword: meta_keyword,
                        meta_desc: meta_desc,
                    },
                    success: function (data) {
                        toastr.success('با موفقیت بروزرسانی شد.')
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
