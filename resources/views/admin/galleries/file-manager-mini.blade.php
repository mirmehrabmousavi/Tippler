<div class="col-12">
    <!-- Button trigger modal -->
    <button type="button" id="btn-add-gallery" class="btn btn-sm btn-outline-white waves-effect waves-light mb-1" data-toggle="modal" data-target="#gallery">تصاویر خود را وارد کنید</button>
    <!-- Modal -->
    <div class="modal fade text-left show" id="gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">گالری</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- left menu section -->
                        <div class="col-md-12 mb-2 mb-md-0">
                            <ul class="nav nav-pills flex-row mt-md-0 mt-1">
                                <li class="nav-item w-50">
                                    <a class="nav-link d-flex py-75 active" id="gallery" data-toggle="pill" href="#gallerys" aria-expanded="true">
                                        <i class="feather icon-image mr-50 font-medium-3"></i>
                                        گالری
                                    </a>
                                </li>
                                <li class="nav-item w-50">
                                    <a class="nav-link d-flex py-75" id="upload" data-toggle="pill" href="#uploads" aria-expanded="false">
                                        <i class="feather icon-upload mr-50 font-medium-3"></i>
                                        آپلود
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
                                            <div class="tab-pane active show" role="tabpanel" id="gallerys" aria-labelledby="gallery" aria-expanded="true">
                                                <div id="images" class="row"></div>
                                            </div>
                                            <div class="tab-pane" role="tabpanel" id="uploads" aria-labelledby="upload" aria-expanded="false">
                                                <form action="{{ route('admin.galleries.upload') }}" method="post" enctype="multipart/form-data"
                                                      id="image-upload" class="dropzone">
                                                    @csrf
                                                    <div class="dz-message text-success">
                                                        <i class="feather icon-upload-cloud"></i>
                                                        برای آپلود فایل ها بکشید و رها کنید یا کلیک کنید
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-12 mb-1">
    <div class="container-fluid">
        <div id="imageContainer" class="row d-flex justify-content-center align-items-center p-1" style="min-height: 150px; border: 2px dashed white; border-radius: 0.4rem">
            <p id="imageTooltip" class="text-center">تصاویر خود را وارد کنید</p>
        </div>
    </div>
</div>
@section('external-style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js" integrity="sha512-U2WE1ktpMTuRBPoCFDzomoIorbOyUv0sP8B+INA3EzNAhehbzED1rOJg6bCqPf/Tuposxb5ja/MAUnC8THSbLQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('external-script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#btn-add-gallery').show()

        $.ajax({
            type: 'GET',
            url: `{{route('admin.galleries.getImages')}}`,
            contentType: false,
            processData: false,
            success: (response) => {
                //console.log(response)
                $.each(response, function () {
                    let imageUrl = this.url
                    let imageName = this.name
                    let imageSize = this.size
                    let imageType = this.type
                    $('#images').append(
                        $(`<div class="col-lg-2 col-md-3 col-sm-6">
                            <a>
                                <div class="card overlay-img-card text-white dataGallery">
                                <img src="${this.url}" class="card-img" alt="card-img-6" height="175">
                                <div class="card-img-overlay overlay-black">
                                    <h5 class="font-medium-5 text-white text-center mt-4">${this.name}</h5>
                                    <p class="text-secondary text-center">Size : ${this.size} | Type : ${this.type}</p>
                                </div>
                                </div>
                            </a>
                        </div>`)
                            .click(function () {
                                $('#gallery').modal('hide');
                                $('#imageTooltip').hide();
                                $('#imageContainer').append(
                                    $(`<div id="getImagePic" class="col-lg-8 col-md-8 col-sm-8">
                                    <a>
                                        <div class="card overlay-img-card text-white dataGallery">
                                            <img src="${imageUrl}" class="card-img" alt="card-img-6" height="150">
                                            <div class="card-img-overlay overlay-black">
                                                <h5 class="font-medium-5 text-white text-center mt-4 name">${imageName}</h5>
                                                <p class="text-secondary text-center"><span class="size">Size : ${imageSize}</span> | <span class="type">Type : ${imageType}</span></p>
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
                                            $('#btn-add-gallery').show()
                                        })
                                );
                                $('#btn-add-gallery').hide()
                            }));
                });
            },
        });

        Dropzone.autoDiscover = false;
        let dropzone = new Dropzone('#image-upload', {
            thumbnailWidth: 200,
            uploadMultiple: false,
            maxFilesize: 100,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.mp4,.mkv"
        });
        dropzone.on("complete", function(file) {
            console.log('on complete')
            $.ajax({
                type: 'GET',
                url: `{{route('admin.galleries.getLastImage')}}`,
                contentType: false,
                processData: false,
                success: (response) => {
                    //console.log(response)
                    let image_url = response.url
                    let image_name = response.name
                    let image_size = response.size
                    let image_type = response.type
                    $('#gallery').modal('hide');
                    $('#imageTooltip').hide();
                    $('#imageContainer').append(
                        $(`<div id="getImagePic" class="col-lg-8 col-md-8 col-sm-8 parent">
                                <a>
                                    <div class="card overlay-img-card text-white dataGallery">
                                        <img src="${image_url}" class="card-img" alt="card-img-6" height="150">
                                        <div class="card-img-overlay overlay-black">
                                            <h5 class="font-medium-5 text-white text-center mt-4 name">${image_name}</h5>
                                                    <p class="text-secondary text-center"><span class="size">Size : ${image_size}</span> | <span class="type">Type : ${image_type}</span></p>
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
                },
            });
        });
    </script>
@endsection
