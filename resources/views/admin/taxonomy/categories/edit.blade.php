@extends('admin.layouts.app')

@section('style')
@endsection

@section('content')
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">ویرایش دسته بندی</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-body">
                                {{--<form action="{{route('admin.categories.store')}}" method="POST">
                                    @csrf--}}
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="main_name">نام* :</label>
                                                <input type="text" name="name" value="{{$category->name}}" id="main_name" class="form-control @error('name') is-invalid @enderror" placeholder="نام را وارد کنید">
                                            </div>
                                        </div> <div class="col-6">
                                            <div class="form-group">
                                                <label for="main_parent_id">والد</label>
                                                <select id="main_parent_id" class="form-control @error('parent_id') is-invalid @enderror disabled" name="parent_id" disabled>
                                                    <option value="">بدون دسته بندی</option>
                                                    @foreach($categories as $k => $v)
                                                        <option value="{{ $v['id'] }}" >{{ $v['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="main_slug">پیوند :</label>
                                                <input type="text" value="{{$category->slug}}" id="main_slug" class="form-control @error('slug') is-invalid @enderror" placeholder="پیوند را وارد کنید" name="slug">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="main_type">نوع دسته بندی :</label>
                                                <select name="type" id="main_type" class="form-control @error('type') is-invalid @enderror">
                                                    <option value="product" {{($category->type === 'product')? 'selected' : ''}}>محصول</option>
                                                    <option value="mag" {{($category->type === 'mag')? 'selected' : ''}}>مقاله</option>
                                                </select>
                                            </div>
                                        </div>
                                        @include('admin.galleries.file-manager')
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="main_description">توضیحات* :</label>
                                                <textarea id="main_description" name="description" class="form-control ckeditor">{!! $category->description !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <a id="showMeta" class="text-secondary mr-1 waves-effect waves-light rounded-pill" style="padding: 5px"><i class="feather icon-plus-circle"></i> افزودن متا</a>
                                        </div>
                                        <div class="col-12">
                                            <div id="meta" class="row" style="display: none">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="meta_title">عنوان متا :</label>
                                                        <input type="text" value="{{$category->meta_title}}" id="meta_title" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" placeholder="عنوان متا را وارد کنید">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="meta_keyword">کلمه کلیدی متا :</label>
                                                        <textarea id="meta_keyword" class="form-control @error('meta_keyword') is-invalid @enderror" name="meta_keyword" placeholder="با , جدا کنید">{{$category->meta_keyword}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="meta_desc">توضیحات متا :</label>
                                                        <textarea id="meta_desc" class="form-control @error('meta_desc') is-invalid @enderror" name="meta_desc" placeholder="توضیحات متا را وارد کنید">{{$category->meta_desc}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button {{--type="submit"--}} id="editCategory" class="btn btn-outline-success btn-sm mr-1 mb-1 waves-effect waves-light w-100 d-block">بروزرسانی</button>
                                        </div>
                                    </div>
                               {{-- </form>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            let category = {!! $category->toJson(); !!}
            CKEDITOR.replace('.ckeditor');

            if(category.image){
                $.each(JSON.parse(category.image),function(){
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

            $("#showMeta").on('click', function () {
                $('#meta').slideToggle('slow');
            });

            $("#editCategory").click(function (event) {
                event.preventDefault()
                $("#editCategory").text('صبر کنید ...');

                var name = $("#main_name").val();
                var slug = $("#main_slug").val();
                var type = $("#main_type").val();
                var description = CKEDITOR.instances["main_description"].getData();
                var image = $("#imageContainer #getImagePic").map(function () {
                    var name = $(this).find('.name').html()
                    var image = $(this).find('img').attr('src')
                    var size = $(this).find('.size').html()
                    var type = $(this).find('.type').html()
                    return {name: name, image: image, size: size, type: type};
                }).get();
                var meta_title = $("input[name='meta_title']").val();
                var meta_keyword = $("textarea[name='meta_keyword']").val();
                var meta_desc = $("textarea[name='meta_desc']").val();

                $.ajax({
                    url: "{{route('admin.categories.update', [$category->id])}}",
                    type: "put",
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: name,
                        slug: slug,
                        type: type,
                        description: description,
                        image: JSON.stringify(image),
                        meta_title: meta_title,
                        meta_keyword: meta_keyword,
                        meta_desc: meta_desc,
                    },
                    success: function (data) {
                        window.location.href = "/admin/categories";
                        toastr.success('با موفقیت ذخیره شد.');
                    },
                    error: function (response) {
                        toastr.success('مشکلی پیش اومده بعدا امتحان کن.')
                    }
                });
            });
        });
    </script>
@endsection
