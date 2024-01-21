<div role="tabpanel" class="tab-pane {{(request()->tab == 'links')? 'active' : ' fade'}}" id="header-links"
     aria-labelledby="settings-header-links" aria-expanded="true">
    <form novalidate="">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">لینک های هدر</h4>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive mt-1">
                            @if(count($links) > 0)
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>عنوان</th>
                                        <th>پیوند</th>
                                        <th>اقدامات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($links as $link)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$link->name}}</td>
                                            <td>{{$link->slug}}</td>
                                            <td>
                                                <a class="text-secondary mr-1 waves-effect waves-light" data-toggle="modal" data-target="#link-show-{{$link->id}}"><i class="feather icon-eye"></i></a>
                                                <div class="modal fade text-left" id="link-show-{{$link->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-secondary white">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row d-flex justify-content-center">
                                                                    <div class="col-12 mt-1">
                                                                        <p class="text-center">نام</p>
                                                                        <p class="text-center text-white">{{$link->name}}</p>
                                                                    </div>
                                                                    <div class="col-12 mt-1">
                                                                        <p class="text-center">پیوند</p>
                                                                        <p class="text-center text-white">{{$link->slug}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a class="text-secondary mr-1 waves-effect waves-light d-none" data-toggle="modal" data-target="#link-edit-{{$link->id}}"><i class="feather icon-edit"></i></a>
                                                <div class="modal fade text-left" id="link-edit-{{$link->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                                    <form action="#" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"></button>
                                                    </form>
                                                </div>
                                                <a class="text-secondary mr-1 waves-effect waves-light text-danger" data-toggle="modal" data-target="#link-delete-{{$link->id}}"><i class="feather icon-trash"></i></a>
                                                <div class="modal fade text-left" id="link-delete-{{$link->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-danger white">
                                                                <h5 class="modal-title" id="myModalLabel120">مطمئنی می خوای این لینک رو حذف کنی؟</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="{{route('admin.settings.links.destroy', [$link->id])}}"
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
                            @else
                                <div class="alert alert-danger text-center"><i class="fa fa-info-circle"></i> لینکی وجود ندارد</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">افزودن لینک هدر</h4>
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
                                            <label for="main_slug">پیوند* :</label>
                                            <input type="text" id="main_slug" class="form-control @error('slug') is-invalid @enderror" placeholder="پیوند را وارد کنید" name="slug">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button id="createLink" class="btn btn-outline-success btn-sm mr-1 mb-1 waves-effect waves-light w-100 d-block">ذخیره</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@section('script-settings-links')
    <script>
        //Link Update Data
        $("#createLink").click(function (event) {
            event.preventDefault()
            $("#createLink").text('صبر کنید ...');

            var name = $("#main_name").val();
            var slug = $("#main_slug").val();

            $.ajax({
                url: "{{route('admin.settings.links.store')}}",
                type: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    name: name,
                    slug: slug,
                },
                success: function (data) {
                    toastr.success('با موفقیت ذخیره شد.');
                    window.location.href = "/admin/settings?tab=links";
                },
                error: function (response) {
                    toastr.success('مشکلی پیش اومده بعدا امتحان کن.')
                    $("#createLink").text('ذخیره');
                }
            });
        });
    </script>
@endsection
