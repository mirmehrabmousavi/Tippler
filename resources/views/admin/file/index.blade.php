@extends('admin.layouts.app')

@section('style')
@endsection

@section('content')
    <form id="uploadForm" action="{{route('admin.file.upload')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" class="dropify" name="file" id="fileInput">
        <button type="submit" class="btn btn-outline-success waves-effect mt-1"><i class="fa fa-upload"></i> بارگذاری اطلاعات</button>
    </form>

    <div id="progressBar" class="progress progress-bar-success progress-lg mt-1">
        <div id="progress" class="progress-bar" role="progressbar" style="width:0%; height: 15px;"><span id="percentLabel" class="text-white"></span></div>
    </div>
@endsection

@section('script')
    <link rel="stylesheet" type="text/css" href="{{asset('css/dropify.min.css')}}">
    <script type="text/javascript" src="{{asset('js/dropify.min.js')}}"></script>
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

            let uploadForm = $('#uploadForm');
            let progressBar = $('#progressBar');
            let progress = $('#progress');
            let percentLabel = $('#percentLabel');

            progressBar.hide()

            uploadForm.submit(function(e) {
                e.preventDefault();

                var fileInput = $('#fileInput')[0].files[0];

                if (fileInput) {
                    var formData = new FormData();
                    formData.append('file', fileInput);
                    formData.append('_token', $('meta[name="csrf-token"]').attr('content')); // Include CSRF token

                    progressBar.show();

                    $.ajax({
                        url: '{{route('admin.gallery.uploadFile')}}',
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
                                }
                            }, false);
                            return xhr;
                        },
                        success: function(response) {
                            progressBar.hide()
                            console.log(response);
                            window.location.href='/admin/file/'
                            // Handle success, if needed
                        },
                        error: function(error) {
                            console.error('Error:', error);
                            // Handle error, if needed
                        },
                    });
                }
            });
        });
    </script>
@endsection
