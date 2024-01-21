@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">ویرایش برگه {{$page->title}}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" {{--action="{{route('admin.blogs.create')}}" method="POST"--}}>
                            {{--@csrf--}}
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="title">عنوان</label>
                                            <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="عنوان" name="title" value="{{$page->title}}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="slug">پیوند</label>
                                            <input type="text" id="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="پیوند" name="slug" value="{{$page->slug}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <style>
                                            /* The Modal (background) */
                                            .modal {
                                                display: none; /* Hidden by default */
                                                position: fixed; /* Stay in place */
                                                z-index: 9999; /* Sit on top */
                                                left: 0;
                                                top: 0;
                                                width: 100%; /* Full width */
                                                height: 100%; /* Full height */
                                                overflow: auto; /* Enable scroll if needed */
                                                background-color: rgb(0, 0, 0); /* Fallback color */
                                                background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
                                            }

                                            /* Modal Content/Box */
                                            .modal-content {
                                                background-color: #fefefe;
                                                margin: 15% auto; /* 15% from the top and centered */
                                                padding: 20px;
                                                border: 1px solid #888;
                                                width: 80%; /* Could be more or less, depending on screen size */
                                            }

                                            /* The Close Button */
                                            .close {
                                                display: inline;
                                                color: #aaa;
                                                top: 0;
                                                left: 0;
                                                font-size: 28px;
                                                font-weight: bold;
                                                padding: 10px;
                                            }

                                            .close:hover,
                                            .close:focus {
                                                color: black;
                                                text-decoration: none;
                                                cursor: pointer;
                                            }
                                        </style>
                                        <label class="my-1">تصاویر خود را وارد کنید</label>
                                        <div id="gallery" class="modal">
                                            <div class="modal-content">
                                                <span id="close" class="close">&times;</span>
                                                <div id="images"></div>
                                            </div>
                                        </div>
                                        <script>
                                            // Get the modal
                                            var modal = document.getElementById("gallery");

                                            // Get the <span> element that closes the modal
                                            var span = document.getElementById("close");

                                            // When the user clicks on <span> (x), close the modal
                                            span.onclick = function () {
                                                modal.style.display = "none";
                                            }

                                            // When the user clicks anywhere outside of the modal, close it
                                            window.onclick = function (event) {
                                                event.preventDefault()
                                                if (event.target === modal) {
                                                    modal.style.display = "none";
                                                }
                                            }
                                        </script>
                                    </div>
                                    <style>
                                        .sendGallery {
                                            background: transparent;
                                            margin-bottom: 1rem;
                                            border-radius: 0.2rem;
                                            display: grid;
                                            grid-template-columns: 1fr;
                                            justify-content: center;
                                        }

                                        .getImageItem {
                                            min-height: 12rem;
                                            border-radius: 0.4rem;
                                            border: 2px dashed #DFE3E7;
                                            display: grid;
                                            justify-content: center;
                                            align-items: center;
                                            cursor: pointer;
                                            grid-template-columns: repeat(auto-fit, minmax(10rem, auto));
                                            grid-gap: 1rem;
                                            padding: 1rem;
                                        }

                                        .getImageItem span {
                                            color: #494f56;
                                            font-size: 0.7rem;
                                            font-weight: 300;
                                            text-align: center;
                                        }
                                    </style>
                                    <div class="col-12">
                                        <div class="sendGallery" onclick="modal.style.display = 'block'">
                                            <div class="getImageItem">
                                                <span id="imageTooltip">تصاویر خود را وارد کنید</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="content">محتوا</label>
                                            <textarea id="content" class="form-control @error('content') is-invalid @enderror ckeditor" name="content" placeholder="محتوا">{!! $page->content !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <a id="showMeta" class="text-secondary mr-1 waves-effect waves-light rounded-pill" style="padding: 5px"><i class="feather icon-plus-circle"></i> افزودن متا</a>
                                    </div>
                                    <div class="col-12">
                                        <div id="meta" class="row" style="display: none">

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="meta_title">عنوان متا</label>
                                                    <input type="text" id="meta_title" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" placeholder="عنوان متا" value="{{$page->meta_title}}">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="meta_keyword">کلمه کلیدی متا</label>
                                                    <textarea id="meta_keyword" class="form-control @error('meta_keyword') is-invalid @enderror" name="meta_keyword" placeholder="کلمه کلیدی متا">{{$page->meta_keyword}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="meta_desc">توضیحات متا</label>
                                                    <textarea id="meta_desc" class="form-control @error('meta_desc') is-invalid @enderror" name="meta_desc" placeholder="توضیحات متا">{{$page->meta_desc}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" id="createBlog" class="btn btn-outline-success btn-sm mr-1 mb-1 waves-effect waves-light">بروزرسانی</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
            var blog = {!! $page->toJson() !!};

            $("#showMeta").on('click', function () {
                $('#meta').slideToggle('slow');
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            if (blog.image) {
                $.each(JSON.parse(blog.image), function () {
                    $('#imageTooltip').hide();
                    $('.getImageItem').append(
                        $('<div class="getImagePic"><img id="deleteImg" src="' + this + '" width="150"></div>')
                            .on('click', '#deleteImg', function (ss) {
                                ss.currentTarget.parentElement.remove();
                            })
                    );
                });
            }

            $('#tag').select2({
                placeholder: 'یرچسب را انتخاب کنید ...',
                "language": {
                    "noResults": function(){
                        return "موردی پیدا نشد";
                    }
                },
            });

            $.ajax({
                type: 'GET',
                url: `{{route('admin.galleries.getImages')}}`,
                contentType: false,
                processData: false,
                success: (response) => {
                    $.each(response, function () {
                        $('#images').append(
                            $('<span class="m-2"><img class="img-fluid rounded-top" width="150" src="' + this + '" alt="' + this + '"></span>')
                                .click(function () {
                                    $('#gallery').hide();
                                    $('#imageTooltip').hide();
                                    $('.getImageItem').append(
                                        $('<div class="getImagePic">' +
                                            '<img id="deleteImg" src="' + this.lastChild.src + '" width="150">' +
                                            '</div>')
                                            .on('click', '#deleteImg', function (ss) {
                                                ss.currentTarget.parentElement.remove();
                                                if (ss.currentTarget.parentElement.length !== '<img id="deleteImg" src="' + ss.currentTarget.parentElement + '" width="150">') {
                                                    $('#imageTooltip').show();
                                                }
                                            })
                                    );
                                })
                        );
                    });
                },
            });


            $("#createBlog").click(function (event) {
                event.preventDefault()

                var images = []
                $(".getImagePic").each(function () {
                    images.push(this.lastElementChild.src);
                });

                var tag = []
                $("select[name='tags'] :selected").map(function(){
                    tag.push($(this).val());
                });

                var title = $("input[name='title']").val();
                var slug = $("input[name='slug']").val();
                var image = images;
                var tags = tag;
                var content = theEditor.getData();
                var meta_title = $("input[name='meta_title']").val();
                var meta_keyword = $("textarea[name='meta_keyword']").val();
                var meta_desc = $("textarea[name='meta_desc']").val();

                $.ajax({
                    url: "{{route('admin.pages.update', [$page->id])}}",
                    type: "PUT",
                    data: {
                        _token: '{{csrf_token()}}',
                        title: title,
                        slug: slug,
                        image: JSON.stringify(image),
                        tags: JSON.stringify(tags),
                        content: content,
                        meta_title: meta_title,
                        meta_keyword: meta_keyword,
                        meta_desc: meta_desc,
                    },
                    success: function (data) {
                        toastr.success('با موفقیت بروزرسانی شد.')
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
