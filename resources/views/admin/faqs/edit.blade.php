@extends('admin.layouts.app')

@section('content')
    <h4>ویرایش سئوال متداول</h4>
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="title">عنوان* :</label>
                                        <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="عنوان را وارد کنید" name="title" value="{{$faq->title}}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="description">محتوا :</label>
                                        <textarea id="description" class="form-control @error('description') is-invalid @enderror ckeditor" name="description" placeholder="محتوا">{!! $faq->description !!}</textarea>
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
            <button id="createFaqs" class="btn btn-outline-success btn-sm mr-1 mb-1 waves-effect waves-light">بروزرسانی</button>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            CKEDITOR.replace('.ckeditor');

            $("#createFaqs").click(function (event) {
                event.preventDefault()
                $("#createFaqs").text('صبر کنید ...');

                var title = $("input[name='title']").val();
                var description = CKEDITOR.instances["description"].getData();

                $.ajax({
                    url: "{{route('admin.faqs.update', [$faq->id])}}",
                    type: "PUT",
                    data: {
                        _token: '{{csrf_token()}}',
                        title: title,
                        description: description,
                    },
                    success: function (data) {
                        toastr.success('با موفقیت ذخیره شد.')
                        window.location.href = "/admin/faqs";
                    },
                    error: function (response) {
                        toastr.success('مشکلی پیش اومده بعدا امتحان کن.')
                        $("#createFaqs").text('بروزرسانی');
                    }
                });
            });
        })
    </script>
@endsection
