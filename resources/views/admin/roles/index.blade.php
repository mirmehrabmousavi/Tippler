@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">مقام ها</h4>
                </div>
                <div class="card-content">
                    <div class="table-responsive mt-1">
                        @if(count($roles) > 0)
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>عنوان</th>
                                    <th>تاریخ ثبت</th>
                                    <th>اقدامات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>{{verta($role->created_at)->format('%A, %d %B %y H:i:s')}}</td>
                                        <td>
                                            <a class="text-secondary mr-1 waves-effect waves-light" data-toggle="modal" data-target="#role-show-{{$role->id}}"><i class="feather icon-eye"></i></a>
                                            <div class="modal fade text-left" id="role-show-{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-dark white">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row d-flex justify-content-center">
                                                                <div class="col-12" style="margin-top: 5px;">
                                                                    <p class="text-center m-0">عنوان :</p>
                                                                    <p class="text-center text-white">{{$role->name}}</p>
                                                                </div>
                                                                <div class="col-12" style="margin-top: 5px;">
                                                                    <p class="text-center m-0">مجوز ها :</p>
                                                                    <p class="text-center text-white" dir="ltr">
                                                                        @php
                                                                            $permissionsID = DB::table("role_has_permissions")->where("role_id", $role->id)->get();
                                                                        @endphp
                                                                        @foreach($permissionsID as $value)
                                                                            @php
                                                                                $rolePermissions = DB::table('permissions')->where('id', $value->permission_id)->get();
                                                                            @endphp
                                                                            @foreach($rolePermissions as $val)
                                                                                @if(str_contains($val->name, 'list'))
                                                                                    <br>
                                                                                    <span>{{str_replace('-list', '', $val->name)}} -> </span>
                                                                                @endif
                                                                                <span class="badge badge-dark">{{$val->name}}</span>
                                                                            @endforeach
                                                                        @endforeach
                                                                    </p>
                                                                </div>
                                                                <div class="col-12" style="margin-top: 5px;">
                                                                    <p class="text-center m-0">تاریخ :</p>
                                                                    <p class="text-center text-white">{{verta($role->crteated_at)->format('%A, %d %B %y H:i:s')}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="text-secondary mr-1 waves-effect waves-light" data-toggle="modal" data-target="#role-edit-{{$role->id}}"><i class="feather icon-edit"></i></a>
                                            <div class="modal fade text-left" id="role-edit-{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-dark white">
                                                            <h5 class="modal-title" id="myModalLabel120">از ویرایش مقام با نام "{{$role->title}}" اطمینان داری؟</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('admin.roles.update', [$role->id])}}" method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="role-name">عنوان* :</label>
                                                                            <input type="text" id="role-name" value="{{$role->name}}" class="form-control @error('name') is-invalid @enderror" placeholder="عنوان را وارد کنید" name="name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="content">مجوز ها* :</label>
                                                                            <br>
                                                                            <fieldset>
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="checkbox" class="custom-control-input" id="edit-master">
                                                                                    <label class="custom-control-label" for="edit-master">انتخاب همه</label>
                                                                                </div>
                                                                            </fieldset>
                                                                            <br>
                                                                            <div class="row">
                                                                                @foreach($permission as $value)
                                                                                    @if(str_contains($value->name, 'delete'))
                                                                                        <br><br>
                                                                                    @endif
                                                                                    <div class="col-6">
                                                                                        <fieldset>
                                                                                            <div class="custom-control custom-checkbox">
                                                                                                @php
                                                                                                    $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$role->id)
                                                                                                                        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                                                                                                                        ->all();
                                                                                                @endphp
                                                                                                <input type="checkbox" class="custom-control-input edit-permissions" value="{{$value->id}}" name="permission[]" id="role-permission-edit-{{$role->name}}-{{$value->id}}" {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }} multiple>
                                                                                                <label class="custom-control-label" for="role-permission-edit-{{$role->name}}-{{$value->id}}">{{$value->name}}</label>
                                                                                            </div>
                                                                                        </fieldset>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <button type="submit" class="roleButton btn btn-outline-success btn-sm mr-1 mb-1 waves-effect waves-light">ذخیره</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="text-secondary mr-1 waves-effect waves-light text-danger" data-toggle="modal" data-target="#role-delete-{{$role->id}}"><i class="feather icon-trash"></i></a>
                                            <div class="modal fade text-left" id="role-delete-{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger white">
                                                            <h5 class="modal-title" id="myModalLabel120">از حذف مقام با نام "{{$role->title}}" اطمینان داری؟</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{route('admin.roles.destroy', [$role->id])}}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">منصرف شدم</button>
                                                                <button type="submit" class="btn btn-danger waves-effect waves-light">آره مطمدنم</button>
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
                            <div class="alert alert-danger mx-1 text-center"><i class="fa fa-info-circle"></i> مقامی وجود ندارد</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-4">
            <div class="card">
                <div class="card-header">
                    <h4>افزودن مقام</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="form-body">
                            <form action="{{route('admin.roles.store')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="role-name">عنوان* :</label>
                                            <input type="text" id="role-name" class="form-control @error('name') is-invalid @enderror" placeholder="عنوان را وارد کنید" name="name">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="content">مجوز ها* :</label>
                                            <br>
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="master">
                                                    <label class="custom-control-label" for="master">انتخاب همه</label>
                                                </div>
                                            </fieldset>
                                            <br>
                                            <div class="row">
                                                @foreach($permission as $value)
                                                    @if(str_contains($value->name, 'delete'))
                                                        <br><br>
                                                    @endif
                                                    <div class="col-6">
                                                        <fieldset>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input permissions" value="{{$value->id}}" name="permissions[]" id="role-permission-{{$value->id}}" multiple>
                                                                <label class="custom-control-label" for="role-permission-{{$value->id}}">{{$value->name}}</label>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="roleButton btn btn-outline-success btn-sm mr-1 mb-1 waves-effect waves-light">ذخیره</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        //Select All Permissions
        $('#master').on('click', function (e) {
            if ($(this).is(':checked', true)) {
                $(".permissions").prop('checked', true);
            } else {
                $(".permissions").prop('checked', false);
            }
        });
        $('#edit-master').on('click', function (e) {
            if ($(this).is(':checked', true)) {
                $(".edit-permissions").prop('checked', true);
            } else {
                $(".edit-permissions").prop('checked', false);
            }
        });
    </script>
@endsection
