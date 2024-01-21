@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="row">
            <!-- left menu section -->
            <div class="col-md-12 mb-2 mb-md-0">
                <ul class="nav nav-pills flex-row mt-md-0 mt-1">
                    <li class="nav-item col-6">
                        <a class="nav-link d-flex justify-content-center py-75 active" id="ticket" data-toggle="pill" href="#tickets"
                           aria-expanded="true">
                            <i class="fa fa-comments mr-50 font-medium-3"></i>
                            همه درخواست ها
                            @if(count($tickets) > 0)
                            <span class="badge badge badge-warning badge-pill float-right mr-2" style="margin: 0 5px;">{{count($tickets)}}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item col-6">
                        <a class="nav-link d-flex justify-content-center py-75" id="counseling" data-toggle="pill" href="#counselings"
                           aria-expanded="false">
                            <i class="fa fa-commenting mr-50 font-medium-3"></i>
                            مشاوره ها
                            @if(count($counselings) > 0)
                            <span class="badge badge badge-warning badge-pill float-right mr-2" style="margin: 0 5px;">{{count($counselings)}}</span>
                            @endif
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
                                <div class="tab-pane active show" role="tabpanel" id="tickets"
                                     aria-labelledby="ticket" aria-expanded="true">
                                    <div class="card">
                                        @if(count($tickets) > 0)
                                            <table class="table table-striped mb-0">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>عنوان</th>
                                                    <th>وضعیت پاسخ</th>
                                                    <th>وضعیت درخواست</th>
                                                    <th>زمان ثبت</th>
                                                    <th>اقدامات</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($tickets as $ticket)
                                                    <tr>
                                                        <td>{{$loop->index+1}}</td>
                                                        <td>{{$ticket->title}}</td>
                                                        <td>
                                                            @if($ticket->answer)
                                                                <span class="badge badge-success">پاسخ داده شده</span>
                                                            @else
                                                                <span class="badge badge-warning">در حال بررسی</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($ticket->status == 0)
                                                                <span class="badge badge-ingo">در حال بررسی</span>
                                                            @endif
                                                            @if($ticket->status == 1)
                                                                <span class="badge badge-success">تایید شده</span>
                                                            @endif
                                                            @if($ticket->status == 2)
                                                                <span class="badge badge-danger">رد شده</span>
                                                            @endif
                                                            @if($ticket->status == 3)
                                                                <span class="badge badge-secondary">بسته شده</span>
                                                            @endif
                                                        </td>
                                                        <td>{{jdate($ticket->created_at)->format('%A, %d %B %y H:i:s')}}</td>
                                                        <td>
                                                            <a href="{{route('admin.tickets.edit', [$ticket->id])}}" class="text-secondary mr-1 waves-effect waves-light"><i class="feather icon-edit"></i></a>
                                                            <a class="text-secondary mr-1 waves-effect waves-light text-danger" data-toggle="modal" data-target="#delete-{{$ticket->id}}"><i class="feather icon-trash"></i></a>
                                                            <div class="modal fade text-left" id="delete-{{$ticket->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-danger white">
                                                                            <h5 class="modal-title" id="myModalLabel120">از حذف درخواست با نام "{{$ticket->title}}" اطمینان داری؟</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <form action="{{route('admin.tickets.delete', [$ticket->id])}}"
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
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            {{$tickets->links('admin.pagination.paginate')}}
                                        @else
                                            <div class="alert alert-danger mx-1 text-center"><i class="fa fa-info-circle"></i> درخواستی وجود ندارد</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="counselings" aria-labelledby="counseling"
                                     aria-expanded="false">
                                    <div class="card">
                                        @if(count($counselings) > 0)
                                            <table class="table table-striped mb-0">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>تصویر</th>
                                                    <th>عنوان</th>
                                                    <th>زمان ثبت</th>
                                                    <th>اقدامات</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($counselings as $counseling)
                                                    <tr>
                                                        <td>{{$loop->index+1}}</td>
                                                        <td class="p-1">
                                                            <ul class="list-unstyled users-list m-0  d-flex align-items-center">
                                                                <li class="avatar pull-up">
                                                                    <img class="media-object rounded-circle" src="@if($counseling->product && $counseling->product->image != '[]'){{asset(json_decode($counseling->product->image)[0]->image)}}@else {{asset('images/image.png')}} @endif" alt="Avatar" height="50" width="50">
                                                                </li>
                                                            </ul>
                                                        </td>
                                                        <td>{{$counseling->title}}</td>
                                                        <td>{{jdate($counseling->created_at)->format('%A, %d %B %y H:i:s')}}</td>
                                                        <td>
                                                            <a href="{{route('admin.counselings.edit', [$counseling->id])}}" class="text-secondary mr-1 waves-effect waves-light"><i class="feather icon-edit"></i></a>
                                                            <a class="text-secondary mr-1 waves-effect waves-light text-danger" data-toggle="modal" data-target="#delete-{{$counseling->id}}"><i class="feather icon-trash"></i></a>
                                                            <div class="modal fade text-left" id="delete-{{$counseling->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bg-danger white">
                                                                            <h5 class="modal-title" id="myModalLabel120">از حذف درخواست با نام "{{$counseling->title}}" اطمینان داری؟</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <form action="{{route('admin.counselings.delete', [$counseling->id])}}"
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
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            {{$counselings->links('admin.pagination.paginate')}}
                                        @else
                                            <div class="alert alert-danger mx-1 text-center"><i class="fa fa-info-circle"></i> مشاوره ای وجود ندارد</div>
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
@endsection
