@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">فایل هات رو اینجا آپلود کن</h4>
                    <p class="text-left float-left">تعداد تصاویر : <span class="badge badge-primary rounded-pill">{{count($galleries)}}</span></p>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('admin.galleries.upload') }}" method="post" enctype="multipart/form-data"
                              id="image-upload" class="dropzone">
                            @csrf
                            <div class="dz-message text-success"><i class="feather icon-upload-cloud"></i> برای آپلود
                                عکس هات بکش بنداز اینجا یا روم کلیک کن
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


        @if(count($galleries) == 0)
        <div class="row">
            <div class="col-12">
               <div class="card p-4">
                   <div class="text-center"><i class="feather icon-slash text-danger" style="font-size: 48px"></i></div>
                   <p class="text-danger text-center mt-2">هیچ تصویر آپلود شده ای نداری</p>
               </div>
            </div>
        </div>
        @else
        <div class="d-flex justify-content-start align-items-center p-2">
            <fieldset class="mr-1">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="checkbox" id="master">
                    <label class="custom-control-label" for="master">انتخاب همه</label>
                </div>
            </fieldset>
            <button type="button" class="btn btn-sm btn-danger delete_all">حذف موارد انتخاب شده</button>
        </div>
        <div class="row">
            @foreach($galleries as $gallery)
                <div class="col-lg-3 col-md-6 col-sm-12 parent">
                    <fieldset style="padding: 5px 0">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input sub_chk" name="checkbox[]" data-id="{{$gallery->id}}" id="check-{{$gallery->id}}">
                            <label class="custom-control-label" for="check-{{$gallery->id}}">انتخاب</label>
                        </div>
                    </fieldset>
                    <a data-toggle="popover" data-placement="top"
                       data-content="{{'نام: '.$gallery->name.'<br>'.' نام اصلی: '.$gallery->main_name.' سایز: '.$gallery->size.' پسوند: '.$gallery->type.' محل ذخیره: '.$gallery->path}}" data-trigger="hover" {{--data-original-title="Hover Triggered"--}}>
                        <div id="dataGallery-{{$gallery->id}}" class="card overlay-img-card text-white dataGallery">
                            @if($gallery->type === "jpg" or $gallery->type === "JPG" or $gallery->type === "png" or $gallery->type === "PNG" or $gallery->type === "jpeg" or $gallery->type === "svg" or $gallery->type === "tif" or $gallery->type === "gif" or $gallery->type === "jfif")
                                <img src="{{asset($gallery->url)}}" class="card-img" alt="card-img-6" height="250">
                            @elseif($gallery->type === 'mp4' or $gallery->type === 'mkv' or $gallery->type == '')
                                <video src="{{asset($gallery->url)}}" class="card-img" height="250"></video>
                            @endif
                            <div class="card-img-overlay overlay-black">
                                <script>
                                    $('#check-{{$gallery->id}}').on('change', function() {
                                        var isChecked = $(this).prop('checked');
                                        var gallery = $('#dataGallery-{{$gallery->id}}');

                                        if (isChecked) {
                                            gallery.css('background-color', 'rgba(115,103,240,0.5)').css('border', '1px solid rgba(115,103,240,0.7)');
                                            $('.delete_all').show()
                                        } else {
                                            gallery.css('background-color', '').css('border', '');
                                            $('.delete_all').hide()
                                        }
                                    });
                                </script>
                                <h5 class="font-medium-5 text-white text-center mt-4">{{$gallery->name}}</h5>
                                <p class="text-secondary text-center">Size : {{$gallery->size}} | Type : {{$gallery->type}}</p>
                                <p class="text-secondary text-center">Date : {{$gallery->created_at->diffForHumans()}}</p>
                                <a href="{{asset($gallery->url)}}" class="text-muted waves-effect waves-light p-1 rounded-pill text-center" download><i class="feather icon-download"></i></a>
                                <a class="waves-effect waves-light p-1 rounded-pill text-center" id="copy{{$gallery->id}}"><i class="feather icon-copy"></i></a>
                                <script>
                                    $(document).ready(function () {
                                        $('#copy{{$gallery->id}}').click(function () {
                                            let imageAddress = "{{ env('APP_URL').$gallery->url }}";
                                            let tempInput = document.createElement('input');
                                            tempInput.setAttribute('value', imageAddress);
                                            document.body.appendChild(tempInput);
                                            tempInput.select();
                                            document.execCommand('copy');
                                            document.body.removeChild(tempInput);
                                            toastr.success('کپی شد.');
                                        });
                                    });
                                </script>
                                <a class="waves-effect waves-light p-1 rounded-pill text-danger text-center" data-toggle="modal" data-target="#delete-{{$gallery->id}}"><i class="feather icon-trash"></i></a>
                                <div class="modal fade text-left" id="delete-{{$gallery->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger white">
                                                <h5 class="modal-title" id="myModalLabel120">مطمئنی می خوای این تصویر رو حذف
                                                    کنی؟</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{route('admin.galleries.destroy', [$gallery->id])}}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="button" class="btn btn-secondary waves-effect waves-light"
                                                            data-dismiss="modal">منصرف شدم
                                                    </button>
                                                    <button type="submit" class="btn btn-danger waves-effect waves-light">آره
                                                        مطمئنم
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            {{$galleries->links('admin.pagination.paginate')}}
        </div>
        @endif
@endsection

@section('script')
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        var dropzone = new Dropzone('#image-upload', {
            thumbnailWidth: 200,
            uploadMultiple: false,
            maxFilesize: 100,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.mp4,.mkv"
        });
        dropzone.on("complete", function(file) {
            window.location.href = '{{route('admin.galleries.index')}}'
        });

        $('.delete_all').hide()

        //Select All Category
        @if(count($galleries) != 0)
        $('#master').on('click', function (e) {
            if ($(this).is(':checked', true)) {
                $(".sub_chk").prop('checked', true);
                $(".dataGallery").css('background-color', 'rgba(115,103,240,0.2)').css('border', '1px solid rgba(115,103,240,0.7)'); // Change to your desired color
                $('.delete_all').show()
            } else {
                $(".dataGallery").css('background-color', '').css('border', '');
                $(".sub_chk").prop('checked', false);
                $('.delete_all').hide()
            }
        });
        @endif

        //Delete All Categories || Selected Categories
        $('.delete_all').on('click', function(e) {
            var allVals = [];

            $(".sub_chk:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });

            if(allVals.length <=0)
            {
                alert("لطفا یک عکس از گالری انتخاب کنید");
            }  else {

                var check = confirm("مطمئنی می خوای این عکس از گالری ها رو پاک کنی؟");
                if(check === true){
                    var join_selected_values = allVals.join(",");
                    $.ajax({
                        url: '{{route('admin.galleries.destroyAll')}}',
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {
                                    $(this).parents("parent").remove();
                                });
                                //alert(data['success']);
                                window.location.href='/admin/galleries'
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
                }
            }
        });
    </script>
@endsection
