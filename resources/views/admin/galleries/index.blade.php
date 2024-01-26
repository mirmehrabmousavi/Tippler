@extends('admin.layouts.app')

@section('content')
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <a href="#charts" class="btn btn-outline-secondary waves-effect waves-light mb-1"><i class="fa fa-line-chart"></i> نمودار آپلود</a>
                    </div>
                    <div class="col-md-12 mb-2 mb-md-0">
                        <ul class="nav nav-pills flex-row mt-md-0 mt-1">
                            <li class="nav-item w-50">
                                <a class="nav-link d-flex py-75 {{(request()->tab == 'gallery')? 'active' : ''}}" id="image" data-toggle="pill" href="#images"
                                   aria-expanded="true">
                                    <i class="fa fa-picture-o mr-50 font-medium-3"></i>
                                    گالری تصاویر
                                </a>
                            </li>
                            <li class="nav-item w-50">
                                <a class="nav-link d-flex py-75 {{(request()->tab == 'file')? 'active' : ''}}" id="file" data-toggle="pill" href="#files"
                                   aria-expanded="false">
                                    <i class="fa fa-file-excel-o mr-50 font-medium-3"></i>
                                    فایل های حجیم
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- right content section -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane {{(request()->tab == 'gallery')? 'active' : ' fade'}}" role="tabpanel" id="images"
                                             aria-labelledby="image" aria-expanded="true">
                                            <div class="card">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h4 class="card-title">عکس هات رو اینجا آپلود کن</h4>
                                                                <p class="text-left float-left">تعداد تصاویر : <span class="text-primary">{{count($galleries)}}</span></p>
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
                                            </div>
                                        </div>
                                        <div class="tab-pane {{(request()->tab == 'file')? 'active' : ' fade'}}" role="tabpanel" id="files" aria-labelledby="file"
                                             aria-expanded="false">
                                            <div class="card">

                                                <div class="card-header">
                                                    <h4 class="card-title">
                                                        عکس هات رو اینجا آپلود کن
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <label>تعداد فایل آپلود شده: <span class="text-primary">{{count($files)}}</span></label>
                                                    <label>فایل های قابل آپلود: <span class="text-warning" dir="ltr"> .jpg, .png, .jpeg, .gif, .pdf, .docx, .mp4, .mkv, .zip, .rar</span></label>
                                                    <label>حداقل حجم قابل آپلود: <span class="text-success" dir="ltr">1 Byte</span></label>
                                                    <label>حداکثر حجم قابل آپلود: <span class="text-danger" dir="ltr">1000 MB</span></label>
                                                    <br>
                                                    <br>
                                                    <form id="uploadForm" action="{{route('admin.galleries.uploadFile')}}" method="POST" enctype="multipart/form-data">
                                                        @csrf

                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="name">نام فایل* :</label>
                                                                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="نام فایل را وارد کنید">
                                                            </div>
                                                        </div>

                                                        <input type="file" class="dropify" name="file" id="fileInput">
                                                        <button type="submit" id="btnUpload" class="btn btn-outline-success waves-effect mt-1"><i class="fa fa-upload"></i> بارگذاری اطلاعات</button>
                                                    </form>

                                                    <div id="progressBar" class="progress progress-bar-success progress-lg mt-1">
                                                        <div id="progress" class="progress-bar" role="progressbar" style="width:0%; height: 15px;"><span id="percentLabel" class="text-white"></span></div>
                                                    </div>
                                                </div>

                                                <hr>

                                                @if(count($files) == 0)
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="card p-4">
                                                                <div class="text-center"><i class="feather icon-slash text-danger" style="font-size: 48px"></i></div>
                                                                <p class="text-danger text-center mt-2">هیچ فایل آپلود شده ای نداری</p>
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
                                                        <button type="button" class="btn btn-sm btn-danger delete_all_file">حذف موارد انتخاب شده</button>
                                                    </div>
                                                    <div class="row">
                                                        @foreach($files as $file)
                                                            <div class="col-lg-3 col-md-6 col-sm-12 parent">
                                                                <fieldset style="padding: 5px 0">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input sub_chk_file" name="checkbox[]" data-id="{{$file->id}}" id="check-file-{{$file->id}}">
                                                                        <label class="custom-control-label" for="check-file-{{$file->id}}">انتخاب</label>
                                                                    </div>
                                                                </fieldset>
                                                                <a data-toggle="popover" data-placement="top"
                                                                   data-content="{{'نام: '.$file->name.'<br>'.' نام اصلی: '.$file->main_name.' سایز: '.$file->size.' پسوند: '.$file->type.' محل ذخیره: '.$file->path}}" data-trigger="hover" {{--data-original-title="Hover Triggered"--}}>
                                                                    <div id="dataGalleryFile-{{$file->id}}" class="card overlay-img-card text-white dataGallery">
                                                                        @if($file->type === "jpg" or $file->type === "JPG" or $file->type === "png" or $file->type === "PNG" or $file->type === "jpeg" or $file->type === "svg" or $file->type === "tif" or $file->type === "gif" or $file->type === "jfif")
                                                                            <img src="{{asset($file->url)}}" class="card-img" alt="card-img-6" height="250">
                                                                        @elseif($file->type === 'mp4' or $file->type === 'mkv' or $file->type == '')
                                                                            <video src="{{asset($file->url)}}" class="card-img" height="250"></video>
                                                                        @else
                                                                            <img src="{{asset('images/file.png')}}" class="card-img" alt="card-img-6" height="250">
                                                                        @endif
                                                                        <div class="card-img-overlay overlay-black">
                                                                            <script>
                                                                                $('#check-file-{{$file->id}}').on('change', function() {
                                                                                    var isChecked = $(this).prop('checked');
                                                                                    var gallery = $('#dataGalleryFile-{{$file->id}}');

                                                                                    if (isChecked) {
                                                                                        gallery.css('background-color', 'rgba(115,103,240,0.5)').css('border', '1px solid rgba(115,103,240,0.7)');
                                                                                        $('.delete_all_file').show()
                                                                                    } else {
                                                                                        gallery.css('background-color', '').css('border', '');
                                                                                        $('.delete_all_file').hide()
                                                                                    }
                                                                                });
                                                                            </script>
                                                                            <h5 class="font-medium-5 text-white text-center mt-4">{{$file->name}}</h5>
                                                                            <p class="text-secondary text-center">Size : {{$file->size}} | Type : {{$file->type}}</p>
                                                                            <p class="text-secondary text-center">Date : {{$file->created_at->diffForHumans()}}</p>
                                                                            <a href="{{asset($file->url)}}" class="text-muted waves-effect waves-light p-1 rounded-pill text-center" download><i class="feather icon-download"></i></a>
                                                                            <a class="waves-effect waves-light p-1 rounded-pill text-center" id="copyFile-{{$file->id}}"><i class="feather icon-copy"></i></a>
                                                                            <script>
                                                                                $(document).ready(function () {
                                                                                    $('#copyFile-{{$file->id}}').click(function () {
                                                                                        let imageAddress = "{{ env('APP_URL').$file->url }}";
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
                                                                            <a class="waves-effect waves-light p-1 rounded-pill text-danger text-center" data-toggle="modal" data-target="#delete-file-{{$file->id}}"><i class="feather icon-trash"></i></a>
                                                                            <div class="modal fade text-left" id="delete-file-{{$file->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
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
                                                                                            <form action="{{route('admin.galleries.destroyFile', [$file->id])}}"
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
                                                        {{$files->links('admin.pagination.paginate')}}
                                                    </div>
                                                @endif
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
        <hr>
        <div class="row" id="charts">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">نمودار زمانی آپلود سال جاری</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" height="100px"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        var farvardinGallery = {!! json_encode($farvardinGallery, JSON_HEX_TAG) !!};
        var ordibeheshtGallery = {!! json_encode($ordibeheshtGallery, JSON_HEX_TAG) !!};
        var khordadGallery = {!! json_encode($khordadGallery, JSON_HEX_TAG) !!};
        var tirGallery = {!! json_encode($tirGallery, JSON_HEX_TAG) !!};
        var mordadGallery = {!! json_encode($mordadGallery, JSON_HEX_TAG) !!};
        var shahrivarGallery = {!! json_encode($shahrivarGallery, JSON_HEX_TAG) !!};
        var mehrGallery = {!! json_encode($mehrGallery, JSON_HEX_TAG) !!};
        var abanGallery = {!! json_encode($abanGallery, JSON_HEX_TAG) !!};
        var azarGallery = {!! json_encode($azarGallery, JSON_HEX_TAG) !!};
        var deyGallery = {!! json_encode($deyGallery, JSON_HEX_TAG) !!};
        var bahmanGallery = {!! json_encode($bahmanGallery, JSON_HEX_TAG) !!};
        var esfandGallery = {!! json_encode($esfandGallery, JSON_HEX_TAG) !!};

        var farvardinFile = {!! json_encode($farvardinFile, JSON_HEX_TAG) !!};
        var ordibeheshtFile = {!! json_encode($ordibeheshtFile, JSON_HEX_TAG) !!};
        var khordadFile = {!! json_encode($khordadFile, JSON_HEX_TAG) !!};
        var tirFile = {!! json_encode($tirFile, JSON_HEX_TAG) !!};
        var mordadFile = {!! json_encode($mordadFile, JSON_HEX_TAG) !!};
        var shahrivarFile = {!! json_encode($shahrivarFile, JSON_HEX_TAG) !!};
        var mehrFile = {!! json_encode($mehrFile, JSON_HEX_TAG) !!};
        var abanFile = {!! json_encode($abanFile, JSON_HEX_TAG) !!};
        var azarFile = {!! json_encode($azarFile, JSON_HEX_TAG) !!};
        var deyFile = {!! json_encode($deyFile, JSON_HEX_TAG) !!};
        var bahmanFile = {!! json_encode($bahmanFile, JSON_HEX_TAG) !!};
        var esfandFile = {!! json_encode($esfandFile, JSON_HEX_TAG) !!};

        const labels = [
            'فروردین',
            'اردیبهشت',
            'خرداد',
            'تیر',
            'مرداد',
            'شهریور',
            'مهر',
            'آبان',
            'آذر',
            'دی',
            'بهمن',
            'اسفند',
        ];

        const data = {
            labels: labels,
            datasets: [
                {
                    label: 'تصاویر',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [
                        farvardinGallery,
                        ordibeheshtGallery,
                        khordadGallery,
                        tirGallery,
                        mordadGallery,
                        shahrivarGallery,
                        mehrGallery,
                        abanGallery,
                        azarGallery,
                        deyGallery,
                        bahmanGallery,
                        esfandGallery,
                    ],
                },
                {
                    label: 'فایل ها',
                    borderColor: '#3161d7',
                    backgroundColor: '#1b3b8a',
                    data: [
                        farvardinFile,
                        ordibeheshtFile,
                        khordadFile,
                        tirFile,
                        mordadFile,
                        shahrivarFile,
                        mehrFile,
                        abanFile,
                        azarFile,
                        deyFile,
                        bahmanFile,
                        esfandFile,
                    ],
                }
            ]
        }

        const config = {
            type: 'line',
            data: data,
            options: {}
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        var dropzone = new Dropzone('#image-upload', {
            thumbnailWidth: 200,
            uploadMultiple: false,
            maxFilesize: 100,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.mp4,.mkv"
        });
        dropzone.on("complete", function(file) {
            window.location.href = '{{route('admin.galleries.index', 'tab=gallery')}}'
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
                                window.location.href='/admin/galleries?tab=gallery'
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
    <script>
        $(document).ready(function() {
            $('.dropify').dropify({
                messages: {
                    default: "بکشید و رها کنید یا برای انتخاب کلیک کنید.",
                    replace: "برای جایگزین کردن تصویر بکشید و رها کنید.",
                    remove: "حذف تصویر",
                    error: "خطایی به وجود آمده است. دوباره تلاش کنید.",
                }
            });

            $('.delete_all_file').hide()

            //Select All Category
            @if(count($files) != 0)
            $('#master').on('click', function (e) {
                if ($(this).is(':checked', true)) {
                    $(".sub_chk_file").prop('checked', true);
                    $(".dataGalleryFile").css('background-color', 'rgba(115,103,240,0.2)').css('border', '1px solid rgba(115,103,240,0.7)'); // Change to your desired color
                    $('.delete_all_file').show()
                } else {
                    $(".dataGalleryFile").css('background-color', '').css('border', '');
                    $(".sub_chk_file").prop('checked', false);
                    $('.delete_all_file').hide()
                }
            });
            @endif

            //Delete All Categories || Selected Categories
            $('.delete_all_file').on('click', function(e) {
                var allVals = [];

                $(".sub_chk_file:checked").each(function() {
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
                            url: '{{route('admin.galleries.destroyAllFile')}}',
                            type: 'DELETE',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids='+join_selected_values,
                            success: function (data) {
                                if (data['success']) {
                                    $(".sub_chk_file:checked").each(function() {
                                        $(this).parents("parent").remove();
                                    });
                                    //alert(data['success']);
                                    window.location.href='/admin/galleries?tab=file'
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

            let btnUpload = $('#btnUpload');
            let uploadForm = $('#uploadForm');
            let progressBar = $('#progressBar');
            let progress = $('#progress');
            let percentLabel = $('#percentLabel');

            progressBar.hide()

            uploadForm.submit(function(e) {
                e.preventDefault();

                var nameInput = $('input[name="name"]').val();
                var fileInput = $('#fileInput')[0].files[0];

                if (fileInput) {
                    var formData = new FormData();
                    formData.append('name', nameInput);
                    formData.append('file', fileInput);
                    formData.append('_token', $('meta[name="csrf-token"]').attr('content')); // Include CSRF token

                    progressBar.show();

                    $.ajax({
                        url: '{{route('admin.galleries.uploadFile')}}',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        xhr: function() {
                            var xhr = new XMLHttpRequest();
                            xhr.upload.addEventListener('progress', function(event) {
                                if (event.lengthComputable) {
                                    var percentage = Math.round((event.loaded * 100) / event.total);
                                    progress.width(percentage + '%');
                                    percentLabel.text(percentage + '%');
                                    btnUpload.text('لطفا صبر کنید');
                                }
                            }, false);
                            return xhr;
                        },
                        success: function(response) {
                            progressBar.hide()
                            console.log(response);
                            window.location.href='/admin/galleries?tab=file'
                            // Handle success, if needed
                        },
                        error: function(error) {
                            toastr.error('لطفا فایل های مجاز را آپلود کنید')
                            btnUpload.text('اپلود فایل');
                            // Handle error, if needed
                        },
                    });
                }
            });
        });
    </script>
@endsection
