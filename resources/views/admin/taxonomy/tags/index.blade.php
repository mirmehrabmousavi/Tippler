@extends('admin.layouts.app')

@section('content')
    @if(session()->has('success'))
        <p class="alert alert-success"><i class="fa fa-info-circle"></i> {{session()->get('success')}}</p>
    @endif
    @if(session()->has('failed'))
        <p class="alert alert-danger"><i class="fa fa-close"></i> {{session()->get('failed')}}</p>
    @endif
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-7">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">برچسب ها</h4>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-sm btn-danger delete_all">حذف موارد انتخاب شده</button>
                        </div>
                        <form action="/admin/tags" class="d-flex justify-content-end">
                            <div class="d-flex justify-content-center">
                                <input type="text" name="search" id="search" value="{{str_replace('search=', "", request()->getQueryString())}}" class="form-control form-control-sm d-inline" style="margin-left: 5px" placeholder="جستجو ..." @if(request()->getQueryString()) autofocus @endif>
                                <button type="submit" class="btn btn-sm btn-outline-primary d-inline"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive mt-1">
                            @if(count($tags) > 0)
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th width="50px">
                                        <fieldset>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="checkbox" id="master">
                                                <label class="custom-control-label" for="master"></label>
                                            </div>
                                        </fieldset>
                                    </th>
                                    <th>#</th>
                                    <th>عنوان</th>
                                    <th>نوع برچسب</th>
                                    <th>تاریخ</th>
                                    <th>اقدامات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tags as $tag)
                                <tr id="dataRow-{{$tag->id}}">
                                    <td>
                                        <fieldset>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input sub_chk" name="checkbox[]" data-id="{{$tag->id}}" id="check-{{$tag->id}}">
                                                <label class="custom-control-label" for="check-{{$tag->id}}"></label>
                                            </div>
                                        </fieldset>
                                    </td>
                                    <script>
                                        $('#check-{{$tag->id}}').on('change', function() {
                                            var isChecked = $(this).prop('checked');
                                            var $tr = $('#dataRow-{{$tag->id}}');

                                            if (isChecked) {
                                                $tr.css('background-color', 'rgba(115,103,240,0.2)').css('border', '1px solid rgba(115,103,240,0.7)');
                                                $('.delete_all').show()
                                            } else {
                                                $tr.css('background-color', '').css('border', '');
                                                $('.delete_all').hide()
                                            }
                                        });
                                    </script>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$tag->name}}</td>
                                    <td><span class="badge" style="background: {{($tag->type == 'product')? 'darkblue' : ''}}{{($tag->type == 'mag')? 'darkred' : ''}}{{($tag->type == 'page')? 'darkgreen' : ''}}">{{($tag->type == 'product')? 'محصول' : ''}}{{ ($tag->type == 'mag')? 'مقاله': ''}} {{($tag->type == 'page')? 'صفحه': ''}}</span></td>
                                    <td>{{verta($tag->crteated_at)->format('%A, %d %B %y H:i:s')}}</td>
                                    <td>
                                        <a class="text-secondary mr-1 waves-effect waves-light" data-toggle="modal" data-target="#show-{{$tag->id}}"><i class="feather icon-eye"></i></a>
                                        <div class="modal fade text-left" id="show-{{$tag->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-secondary white">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row d-flex justify-content-center">
                                                            <ul class="list-unstyled users-list" style="height: 60px; width: 60px;">
                                                                <li class="avatar pull-up m-0">
                                                                    <img class="media-object rounded-circle" src="@if($tag->image != '[]'){{asset(json_decode($tag->image)[0]->image)}}@endif" alt="Avatar" height="60" width="60">
                                                                </li>
                                                            </ul>
                                                            <div class="col-12 mt-1">
                                                                <p class="text-center">نام</p>
                                                                <p class="text-center text-white">{{$tag->name}}</p>
                                                            </div>

                                                            <div class="col-12 mt-1">
                                                                <p class="text-center">پیوند</p>
                                                                <p class="text-center text-white">{{$tag->slug}}</p>
                                                            </div>

                                                            <div class="col-12 mt-1">
                                                                <p class="text-center">نوع دسته بندی</p>
                                                                <p class="text-center text-white">{{($tag->type === 'product')? 'محصول' : 'مقاله'}}</p>
                                                            </div>

                                                            <div class="col-12 mt-1">
                                                                <p class="text-center">توضیحات</p>
                                                                <span class="text-center text-white">{!! $tag->description !!}</span>
                                                            </div>

                                                            <div class="col-12 mt-1">
                                                                <p class="text-center">عنوان سئو</p>
                                                                <p class="text-center text-white">{{$tag->meta_title}}</p>
                                                            </div>

                                                            <div class="col-12 mt-1">
                                                                <p class="text-center">کلمات کلیدی سئو</p>
                                                                <p class="text-center text-white">{{$tag->meta_keyword}}</p>
                                                            </div>

                                                            <div class="col-12 mt-1">
                                                                <p class="text-center">توضیحات سئو</p>
                                                                <p class="text-center text-white">{{$tag->meta_desc}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="text-secondary mr-1 waves-effect waves-light" data-toggle="modal" data-target="#edit-{{$tag->id}}"><i class="feather icon-edit"></i></a>
                                        <div class="modal fade text-left" id="edit-{{$tag->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-secondary white">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form" action="{{route('admin.tags.update', [$tag->id])}}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="form-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="name1">نام</label>
                                                                            <input type="text" id="name1" value="{{$tag->name}}" class="form-control @error('name') is-invalid @enderror" placeholder="نام" name="name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="main_slug1">پیوند :</label>
                                                                            <input type="text" id="main_slug1" value="{{$tag->slug}}" class="form-control @error('slug') is-invalid @enderror" placeholder="پیوند را وارد کنید" name="slug">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="main_type1">نوع برچسب :</label>
                                                                            <select name="type" id="main_type1" class="form-control @error('type') is-invalid @enderror">
                                                                                <option value="product" {{($tag->type === 'product')? 'selected' : ''}}>محصول</option>
                                                                                <option value="mag" {{($tag->type === 'mag')? 'selected' : ''}}>مقاله</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="main_description1">توضیحات* :</label>
                                                                            <textarea id="main_description1" name="description" class="form-control ckeditor">{!! $tag->description !!}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="meta_title1">عنوان متا :</label>
                                                                            <input type="text" id="meta_title1" value="{{$tag->meta_title}}" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" placeholder="عنوان متا را وارد کنید">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="meta_keyword1">کلمه کلیدی متا :</label>
                                                                            <textarea id="meta_keyword1" class="form-control @error('meta_keyword') is-invalid @enderror" name="meta_keyword" placeholder="با , جدا کنید">{!! $tag->meta_keyword !!}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="meta_desc1">توضیحات متا :</label>
                                                                            <textarea id="meta_desc1" class="form-control @error('meta_desc') is-invalid @enderror" name="meta_desc" placeholder="توضیحات متا را وارد کنید">{!! $tag->meta_desc !!}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <button type="submit" class="btn btn-outline-success btn-sm mr-1 mb-1 waves-effect waves-light">بروزرسانی</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="text-secondary mr-1 waves-effect waves-light text-danger" data-toggle="modal" data-target="#delete-{{$tag->id}}"><i class="feather icon-trash"></i></a>
                                        <div class="modal fade text-left" id="delete-{{$tag->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger white">
                                                        <h5 class="modal-title" id="myModalLabel120">مطمئنی می خوای این تصویر رو حذف کنی؟</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{route('admin.tags.destroy', [$tag->id])}}"
                                                              method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">منصرف شدم</button>
                                                            <button type="submit" class="btn btn-danger waves-effect waves-light">آره مطمئنم</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$tags->links('admin.pagination.paginate')}}
                            @else
                                <div class="alert alert-danger mx-1 text-center"><i class="fa fa-info-circle"></i> برچسبی وجود ندارد</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">افزودن برچسب</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="main_name">نام* :</label>
                                            <input type="text" id="main_name" class="form-control @error('name') is-invalid @enderror" placeholder="نام را وارد کنید" name="name">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="main_slug">پیوند :</label>
                                            <input type="text" id="main_slug" class="form-control @error('slug') is-invalid @enderror" placeholder="پیوند را وارد کنید" name="slug">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="main_type">نوع برچسب :</label>
                                            <select name="type" id="main_type" class="form-control @error('type') is-invalid @enderror">
                                                <option value="product">محصول</option>
                                                <option value="mag">مقاله</option>
                                                <option value="page">صفحه</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="main_description">توضیحات* :</label>
                                            <textarea id="main_description" name="description" class="form-control ckeditor"></textarea>
                                        </div>
                                    </div>
                                    @include('admin.galleries.file-manager-mini')
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
                                    <div class="col-12">
                                        <button id="createTag" class="btn btn-outline-success btn-sm mr-1 mb-1 waves-effect waves-light w-100 d-block">ذخیره</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
        let theEditor;
        ClassicEditor
            .create( document.querySelector( '#main_description' ),{
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
            $('.delete_all').hide();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#showMeta").on('click', function () {
                $('#meta').slideToggle('slow');
            });

            $("#createTag").click(function (event) {
                event.preventDefault()
                $("#createTag").text('صبر کنید ...');

                var name = $("#main_name").val();
                var slug = $("#main_slug").val();
                var type = $("#main_type").val();
                var description = theEditor.getData();
                var image = $("#imageContainer #getImagePic").map(function () {
                    var name = $(this).find('.name').html()
                    var image = $(this).find('img').attr('src')
                    var size = $(this).find('.size').html()
                    var type = $(this).find('.type').html()
                    return {name: name, image: image, size: size, type: type};
                }).get();
                var meta_title = $("#meta_title").val();
                var meta_keyword = $("#meta_keyword").val();
                var meta_desc = $("#meta_desc").val();

                $.ajax({
                    url: "{{route('admin.tags.store')}}",
                    type: "post",
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
                        toastr.success('با موفقیت ذخیره شد.');
                        window.location.href = "/admin/tags";
                    },
                    error: function (response) {
                        toastr.success('مشکلی پیش اومده بعدا امتحان کن.')
                    }
                });
            });

            //Select All Category
            $('#master').on('click', function (e) {
                if ($(this).is(':checked', true)) {
                    $("tr").css('background-color', 'rgba(115,103,240,0.2)').css('border', '1px solid rgba(115,103,240,0.7)'); // Change to your desired color
                    $(".sub_chk").prop('checked', true);
                    $('.delete_all').show()
                } else {
                    $("tr").css('background-color', '').css('border', '');
                    $(".sub_chk").prop('checked', false);
                    $('.delete_all').hide()
                }
            });

            //Delete All Categories || Selected Categories
            $('.delete_all').on('click', function(e) {
                var allVals = [];

                $(".sub_chk:checked").each(function() {
                    allVals.push($(this).attr('data-id'));
                });

                if(allVals.length <=0)
                {
                    alert("لطفا یک دسته بندی انتخاب کنید");
                }  else {

                    var check = confirm("مطمئنی می خوای این دسته بندی ها رو پاک کنی؟");
                    if(check === true){
                        var join_selected_values = allVals.join(",");
                        $.ajax({
                            url: '{{route('admin.tags.destroyAll')}}',
                            type: 'DELETE',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids='+join_selected_values,
                            success: function (data) {
                                if (data['success']) {
                                    $(".sub_chk:checked").each(function() {
                                        $(this).parents("tr").remove();
                                    });
                                    //alert(data['success']);
                                    window.location.href='/admin/tags'
                                } else if (data['error']) {
                                    alert(data['error']);
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function (data) {
                                alert(data.responseText);
                            }
                        });
                        $.each(allVals, function( index, value ) {
                            $('table tr').filter("[data-row-id='" + value + "']").remove();
                        });
                    }
                }
            });
        })
    </script>
@endsection
