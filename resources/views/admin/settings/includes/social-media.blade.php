<div role="tabpanel" class="tab-pane {{(request()->tab == 'social-media')? 'active' : ' fade'}}" id="social-media"
     aria-labelledby="settings-social-media" aria-expanded="true">
    <form novalidate="" action="{{route('admin.settings.socialMediaStore')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="key">شبکه اجتماعی خودتو انتخاب کن : </label>
                        <select class="form-control select2" name="key" id="key">
                            @php $fontAwesomes = \App\Models\FontAwesome::all(); @endphp
                            @foreach($fontAwesomes as $item)
                                <option value="{{$item->icon}}">{{$item->icon}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="value">آدرس شبکه اجتماعی تو وارد کن : </label>
                        <input type="text" class="form-control" name="value" id="value" placeholder="مثال : https://t.me/example">
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
                    <h4 class="mb-0">شبکه های اجتماعی</h4>
                </div>
                <div class="card-content">
                    <div class="table-responsive mt-1">
                        @if(count($socialMedias) > 0)
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>شبکه اجتماعی</th>
                                    <th>آدرس (example.com)</th>
                                    <th>اقدامات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($socialMedias as $socialMedia)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td><i class="{{$socialMedia->key}} text-warning"></i> {{$socialMedia->key}}</td>
                                        <td>{{$socialMedia->value}}</td>
                                        <td>
                                            <a class="text-secondary mr-1 waves-effect waves-light" data-toggle="modal" data-target="#link-show-{{$socialMedia->id}}"><i class="feather icon-eye"></i></a>
                                            <div class="modal fade text-left" id="link-show-{{$socialMedia->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-secondary white">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row d-flex justify-content-center">
                                                                <div class="col-12 mt-1">
                                                                    <p class="text-center">نام شبکه اجتماعی</p>
                                                                    <p class="text-center text-white"><i class="{{$socialMedia->key}} text-warning"></i> {{$socialMedia->key}}</p>
                                                                </div>
                                                                <div class="col-12 mt-1">
                                                                    <p class="text-center">آدرس شبکه اجتماعی</p>
                                                                    <p class="text-center text-white">{{$socialMedia->value}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="text-secondary mr-1 waves-effect waves-light d-none" data-toggle="modal" data-target="#link-edit-{{$socialMedia->id}}"><i class="feather icon-edit"></i></a>
                                            <div class="modal fade text-left" id="link-edit-{{$socialMedia->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                                <form action="{{route('admin.settings.socialMediaUpdate', [$socialMedia->id])}}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="key">شبکه اجتماعی خودتو انتخاب کن : </label>
                                                                    <select class="form-control" name="key" id="key">
                                                                        @foreach($fontAwesomes as $item)
                                                                            <option value="{{$item->icon}}">{{$item->icon}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="value">آدرس شبکه اجتماعی تو وارد کن : </label>
                                                                    <input type="text" class="form-control" name="value" id="value" value="{{$socialMedia->value}}" placeholder="مثال : https://t.me/example">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <button type="submit" class="btn btn-outline-success btn-sm mr-sm-1 mb-1 mb-sm-0 waves-effect waves-light">بروزرسانی</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <a class="text-secondary mr-1 waves-effect waves-light text-danger" data-toggle="modal" data-target="#link-delete-{{$socialMedia->id}}"><i class="feather icon-trash"></i></a>
                                            <div class="modal fade text-left" id="link-delete-{{$socialMedia->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger white">
                                                            <h5 class="modal-title" id="myModalLabel120">مطمئنی می خوای این لینک رو حذف کنی؟</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{route('admin.settings.socialMediaDestroy', [$socialMedia->id])}}"
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

@section('script-settings-social-media')
    <script>
        $('#key').select2({
            placeholder: 'شَبکه اجتماعی را انتخاب کنید ...',
            "language": {
                "noResults": function () {
                    return "موردی پیدا نشد";
                }
            },
        });
    </script>
@endsection
