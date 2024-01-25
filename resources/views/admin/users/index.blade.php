@extends('admin.layouts.app')

@section('style')
    <link rel="stylesheet" type="text/css" href="/admin/app-assets/css-rtl/pages/data-list-view.css">
@endsection

@section('content')
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">کاربران</h4>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-sm btn-danger delete_all">حذف موارد انتخاب شده</button>
                        </div>
                        <form action="/admin/users" class="d-flex justify-content-end">
                            <div class="d-flex justify-content-center">
                                <input type="text" name="search" id="search" value="{{str_replace('search=', "", request()->getQueryString())}}" class="form-control form-control-sm d-inline" style="margin-left: 5px" placeholder="جستجو ..." @if(request()->getQueryString()) autofocus @endif>
                                <button type="submit" class="btn btn-sm btn-outline-primary d-inline"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive mt-1">
                            @if(count($users) > 0)
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th width="50px">
                                        <fieldset>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="checkbox" id="master">
                                                <label class="custom-control-label" for="master"></label>
                                            </div>
                                        </fieldset>
                                    </th>
                                    <th></th>
                                    <th>اقدامات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr id="dataRow-{{$user->id}}">
                                        <td>
                                            <fieldset>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input sub_chk" name="checkbox[]" data-id="{{$user->id}}" id="check-{{$user->id}}">
                                                    <label class="custom-control-label" for="check-{{$user->id}}"></label>
                                                </div>
                                            </fieldset>
                                        </td>
                                        <td>
                                            <div class="row">
                                               <div class="col-1 d-flex align-items-center">
                                                   <ul class="list-unstyled users-list m-0  d-flex align-items-center align-content-center">
                                                       <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="{{$user->name}}" class="avatar pull-up">
                                                           <img class="media-object rounded-circle" src="{{asset($user->profile)}}" alt="Avatar" height="60" width="60">
                                                       </li>
                                                   </ul>
                                               </div>
                                                <div class="col-11">
                                                    <div class="d-flex align-items-center align-content-center w-100 p-2">
                                                        <div class="w-100">
                                                            <p class="text-muted d-block w-100">
                                                                <span class="mx-1">آیدی کاربر : {{$user->id}}</span>
                                                                <span class="mx-1">uuid : {{$user->uuid}}</span>
                                                                <span class="mx-2">نام : {{$user->name}}</span>
                                                                <span class="mx-2">
                                                                    <a class="btn btn-sm btn-outline-secondary text-white" data-toggle="modal" data-target="#promote-{{$user->id}}">ارتقا کاربر <i class="fa fa-user-plus"></i></a>
                                                                    <div class="modal fade text-left" id="promote-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header bg-secondary white">
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form class="form" action="{{route('admin.users.promote', [$user->id])}}" method="POST">
                                                                                        @csrf
                                                                                        <div class="form-body">
                                                                                            <div class="row">
                                                                                                <div class="col-12">
                                                                                                    <div class="form-group">
                                                                                                        <label for="promote">ارتقا* :</label>
                                                                                                        <select name="promote" id="promote" class="form-control">
                                                                                                            <option value="user">User</option>
                                                                                                            <option value="manager">Manager</option>
                                                                                                            <option value="admin">Admin</option>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-12">
                                                                                                    <button type="submit" class="btn btn-outline-success btn-sm mr-1 mb-1 waves-effect waves-light">ارتقای کابر <i class="fa fa-user-plus"></i></button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                                <div class="modal-footer"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </span>
                                                            </p>
                                                            <p class="mt-1 w-100 alert alert-secondary">
                                                                <span class="mx-1">نام کاربری : {{$user->username}}</span>
                                                                <span class="mx-2">ایمیل : {{$user->email}}</span>
                                                                <span class="mx-2">شماره تماس : {{$user->phone}}</span>
                                                            </p>
                                                            <p class="mt-1 w-100 alert alert-secondary">
                                                                <span class="mx-1">کیف پول : 0 تومان</span>
                                                                <span class="mx-1">مبلغ کل سفارش : 0 تومان</span>
                                                                <span class="mx-2">زمان ثبت : {{verta($user->crteated_at)->format('%A, %d %B %y H:i:s')}}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @can('user-edit')
                                            <a class="text-secondary mr-1 waves-effect waves-light" data-toggle="modal" data-target="#show-{{$user->id}}"><i class="feather icon-eye"></i></a>
                                            <div class="modal fade text-left" id="show-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-secondary white">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row d-flex justify-content-center">
                                                                <ul class="list-unstyled users-list" style="height: 60px; width: 60px;">
                                                                    <li class="avatar pull-up m-0">
                                                                        <img class="media-object rounded-circle" src="{{asset($user->profile)}}" alt="Avatar" height="60" width="60">
                                                                    </li>
                                                                </ul>
                                                                <div class="col-12" style="margin-top: 5px;">
                                                                    <p class="text-center m-0">آیدی کاربر :</p>
                                                                    <p class="text-center text-white">{{$user->id}}</p>
                                                                </div>
                                                                <div class="col-12" style="margin-top: 5px;">
                                                                    <p class="text-center m-0">آیدی uuid :</p>
                                                                    <p class="text-center text-white">{{$user->uuid}}</p>
                                                                </div>
                                                                <div class="col-12" style="margin-top: 5px;">
                                                                    <p class="text-center m-0">نام و نام خانوادگی :</p>
                                                                    <p class="text-center text-white">{{$user->name}}</p>
                                                                </div>
                                                                <div class="col-12" style="margin-top: 5px;">
                                                                    <p class="text-center m-0">نام کاربری :</p>
                                                                    <p class="text-center text-white">{{$user->username}}</p>
                                                                </div>
                                                                <div class="col-12" style="margin-top: 5px;">
                                                                    <p class="text-center m-0">شماره تماس کاربر :</p>
                                                                    <p class="text-center text-white">{{$user->phone}}</p>
                                                                </div>
                                                                <div class="col-12" style="margin-top: 5px;">
                                                                    <p class="text-center m-0">ایمیل کاربر :</p>
                                                                    <p class="text-center text-white">{{$user->email}}</p>
                                                                </div>
                                                                <div class="col-12" style="margin-top: 5px;">
                                                                    <p class="text-center m-0">ip کاربر :</p>
                                                                    <p class="text-center text-white">{{$user->ip_address}}</p>
                                                                </div>
                                                                <div class="col-12" style="margin-top: 5px;">
                                                                    <p class="text-center m-0">client ip کاربر :</p>
                                                                    <p class="text-center text-white">{{$user->client_ip_address}}</p>
                                                                </div>
                                                                <div class="col-12" style="margin-top: 5px;">
                                                                    <p class="text-center m-0">user agent کاربر :</p>
                                                                    <p class="text-center text-white">{{$user->user_agent}}</p>
                                                                </div>
                                                                <div class="col-12" style="margin-top: 5px;">
                                                                    <p class="text-center m-0">زمان ثبت :</p>
                                                                    <p class="text-center text-white">{{verta($user->crteated_at)->format('%A, %d %B %y H:i:s')}}</p>
                                                                </div>

                                                                <div class="col-12" style="margin-top: 5px;">
                                                                    <p class="text-center m-0">توضیحات</p>
                                                                    <span class="text-center text-white">{!! $user->description !!}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endcan
                                            @can('user-edit')
                                            <a href="{{route('admin.users.edit', ['user' => $user->id])}}" class="text-secondary mr-1 waves-effect waves-light"><i class="feather icon-edit"></i></a>
                                            @endcan
                                            @can('user-delete')
                                            <a class="text-secondary mr-1 waves-effect waves-light text-danger" data-toggle="modal" data-target="#delete-{{$user->id}}"
                                               data-tr="tr_{{$user->id}}"
                                               data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"
                                               data-btn-ok-class="btn btn-sm btn-danger"
                                               data-btn-cancel-label="Cancel"
                                               data-btn-cancel-icon="fa fa-chevron-circle-left"
                                               data-btn-cancel-class="btn btn-sm btn-default"
                                               data-title="Are you sure you want to delete ?"
                                               data-placement="left" data-singleton="true"><i class="feather icon-trash"></i></a>
                                            <div class="modal fade text-left" id="delete-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger white">
                                                            <h5 class="modal-title" id="myModalLabel120">از حذف محتوا با نام "{{$user->title}}" اطمینان داری؟</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{route('admin.users.destroy', [$user->id])}}"
                                                                  method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">منصرف شدم</button>
                                                                <button type="submit" class="btn btn-danger waves-effect waves-light">آره مطمدنم</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endcan
                                        </td>
                                    </tr>

                                    <script>
                                        $('#check-{{$user->id}}').on('change', function() {
                                            var isChecked = $(this).prop('checked');
                                            var $tr = $('#dataRow-{{$user->id}}');

                                            if (isChecked) {
                                                $tr.css('background-color', 'rgba(115,103,240,0.2)').css('border', '1px solid rgba(115,103,240,0.7)').css('border-radius', '25px');
                                                $('.delete_all').show()
                                            } else {
                                                $tr.css('background-color', '').css('border', '');
                                                $('.delete_all').hide()
                                            }
                                        });
                                    </script>
                                @endforeach
                                </tbody>
                            </table>
                            {{$users->links('admin.pagination.paginate')}}
                            @else
                                <div class="alert alert-danger mx-1 text-center"><i class="fa fa-info-circle"></i> کاربری وجود ندارد</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="/admin/app-assets/js/scripts/ui/data-list-view.js"></script>
    <script>
        $(document).ready(function () {

            $('.delete_all').hide()

            //Select All Category
            $('#master').on('click', function (e) {
                if ($(this).is(':checked', true)) {
                    $("tr").css('background-color', 'rgba(115,103,240,0.2)').css('border', '1px solid rgba(115,103,240,0.7)'); // Change to your desired color
                    $(".sub_chk").prop('checked', true);
                    $('.delete_all').show()
                } else {
                    $("tr").css('background-color', '').css('border', '');
                    $(".sub_chk").prop('checked', false);
                    $('.delete_all').hide()
                }
            });

            //Delete All Categories || Selected Categories
            $('.delete_all').on('click', function(e) {
                var allVals = [];

                $(".sub_chk:checked").each(function() {
                    allVals.push($(this).attr('data-id'));
                });

                if(allVals.length <=0)
                {
                    alert("لطفا یک کاربر انتخاب کنید");
                }  else {

                    var check = confirm("مطمئنی می خوای این کاربران رو پاک کنی؟");
                    if(check === true){
                        var join_selected_values = allVals.join(",");
                        $.ajax({
                            url: '{{route('admin.users.destroyAll')}}',
                            type: 'DELETE',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids='+join_selected_values,
                            success: function (data) {
                                if (data['success']) {
                                    $(".sub_chk:checked").each(function() {
                                        $(this).parents("tr").remove();
                                    });
                                    //alert(data['success']);
                                    window.location.href='/admin/users'
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
                        $.each(allVals, function( index, value ) {
                            $('table tr').filter("[data-row-id='" + value + "']").remove();
                        });
                    }
                }
            });
        });
    </script>
@endsection
