<div role="tabpanel" class="tab-pane {{(request()->tab == 'fab')? 'active' : ' fade'}}" id="fab"
     aria-labelledby="settings-fab" aria-expanded="true">
    <form novalidate="" action="{{route('admin.settings.fabStore')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="title">عنوان : </label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="عنوان را وارد کنید">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="link">لینک : </label>
                        <input type="text" class="form-control" name="link" id="link" placeholder="مثال : https://t.me/example">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="type">نوع : </label>
                        <select class="form-control" name="type" id="type">
                            <option value="شبکه اجتماعی">شبکه اجتماعی</option>
                            <option value="لینک">لینک</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="icon">آیکون : </label>
                        <select class="form-control" name="icon" id="icon">
                            @php $fontAwesomes = \App\Models\FontAwesome::all(); @endphp
                            @foreach($fontAwesomes as $item)
                                <option value="{{$item->icon}}">{{$item->icon}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                <button type="submit" class="btn btn-outline-success btn-sm mr-sm-1 mb-1 mb-sm-0 waves-effect waves-light">ذخیره</button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">دکمه های شناور</h4>
                </div>
                <div class="card-content">
                    <div class="table-responsive mt-1">
                        @if(count($fabs) > 0)
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>عنوان</th>
                                    <th>لینک</th>
                                    <th>نوع</th>
                                    <th>آیکون</th>
                                    <th>اقدامات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($fabs as $fab)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$fab->title}}</td>
                                        <td>{{$fab->link}}</td>
                                        <td>{{$fab->type}}</td>
                                        <td><i class="{{$fab->icon}} text-warning"></i></td>
                                        <td>
                                            <a class="text-secondary mr-1 waves-effect waves-light" data-toggle="modal" data-target="#link-show-{{$fab->id}}"><i class="feather icon-eye"></i></a>
                                            <div class="modal fade text-left" id="link-show-{{$fab->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-secondary white">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row d-flex justify-content-center">
                                                                <div class="col-12 mt-1">
                                                                    <p class="text-center">عنوان</p>
                                                                    <p class="text-center text-white"><i class="{{$fab->title}} text-warning"></i> {{$fab->key}}</p>
                                                                </div>
                                                                <div class="col-12 mt-1">
                                                                    <p class="text-center">لینک</p>
                                                                    <p class="text-center text-white">{{$fab->link}}</p>
                                                                </div>
                                                                <div class="col-12 mt-1">
                                                                    <p class="text-center">نوع</p>
                                                                    <p class="text-center text-white">{{$fab->type}}</p>
                                                                </div>
                                                                <div class="col-12 mt-1">
                                                                    <p class="text-center">آیکون</p>
                                                                    <p class="text-center text-white"><i class="{{$fab->icon}} text-warning"></i></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="text-secondary mr-1 waves-effect waves-light" data-toggle="modal" data-target="#link-edit-{{$fab->id}}"><i class="feather icon-edit"></i></a>
                                            <div class="modal fade text-left" id="link-edit-{{$fab->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-secondary white">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('admin.settings.fabUpdate', [$fab->id])}}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="title">عنوان : </label>
                                                                    <input type="text" class="form-control" name="title" value="{{$fab->title}}" id="title" placeholder="مثال : https://t.me/example">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="link">لینک : </label>
                                                                    <input type="text" class="form-control" name="link" value="{{$fab->link}}" id="link" placeholder="مثال : https://t.me/example">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="type">نوع : </label>
                                                                    <select class="form-control select2" name="type" id="type">
                                                                        <option value="شبکه اجتماعی" {{$fab->type === 'شبکه اجتماعی'? 'selected' : ''}}>شبکه اجتماعی</option>
                                                                        <option value="لینک" {{$fab->type === 'لینک'? 'selected' : ''}}>لینک</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="icon">آیکون : </label>
                                                                    <select class="form-control select2" name="icon" id="icon">
                                                                        @php $fontAwesomes = \App\Models\FontAwesome::all(); @endphp
                                                                        @foreach($fontAwesomes as $item)
                                                                            <option value="{{$item->icon}}" {{$fab->icon === $item->icon? 'selected' : ''}}>{{$item->icon}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                            <button type="submit" class="btn btn-outline-success btn-sm mr-sm-1 mb-1 mb-sm-0 waves-effect waves-light">ذخیره</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                        </div>
                                                        <div class="modal-footer"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="text-secondary mr-1 waves-effect waves-light text-danger" data-toggle="modal" data-target="#link-delete-{{$fab->id}}"><i class="feather icon-trash"></i></a>
                                            <div class="modal fade text-left" id="link-delete-{{$fab->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger white">
                                                            <h5 class="modal-title" id="myModalLabel120">مطمئنی می خوای این لینک رو حذف کنی؟</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{route('admin.settings.fabDestroy', [$fab->id])}}"
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
    </div>
</div>

@section('script-settings-fab')
    <script>
        $('#icon').select2({
            placeholder: 'آیکون را انتخاب کنید ...',
            "language": {
                "noResults": function () {
                    return "موردی پیدا نشد";
                }
            },
        });
    </script>
@endsection
