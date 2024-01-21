@extends('admin.layouts.app')

@section('style')

@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0"><i class="fa fa-hdd-o"></i> ویجت ها</h4>
                    <a href="{{route('admin.widgets.create')}}" class="btn btn-sm btn-outline-primary waves-effect waves-light"><i class="fa fa-plus-circle"></i> افزودن ویجت</a>
                </div>
                <div class="card-content">
                    <div class="table-responsive mt-1">
                        @if(count($widgets) > 0)
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>نوع</th>
                                    <th>عنوان</th>
                                    <th>وضعیت نمایش</th>
                                    <th>اقدامات</th>
                                </tr>
                                </thead>
                                <tbody id="sort-1">
                                @foreach($widgets as $widget)
                                    <tr>
                                        <td id="{{$widget->id}}">{{$widget->name}}</td>
                                        <td>{{$widget->title}}</td>
                                        <td>
                                            @if($widget->status == 0)
                                                پیشنویس
                                            @else
                                                منتشر شده
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.widgets.edit', [$widget->id])}}" class="text-secondary mr-1 waves-effect waves-light"><i class="feather icon-edit"></i></a>
                                            <a class="text-secondary mr-1 waves-effect waves-light text-danger" data-toggle="modal" data-target="#delete-{{$widget->id}}"><i class="feather icon-trash"></i></a>
                                            <div class="modal fade text-left" id="delete-{{$widget->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger white">
                                                            <h5 class="modal-title" id="myModalLabel120">از حذف محتوا با نام "{{$widget->title}}" اطمینان داری؟</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{route('admin.widgets.destroy', [$widget->id])}}"
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
                            {{--{{$widgets->links('admin.pagination.paginate')}}--}}
                        @else
                            <div class="alert alert-danger text-center mx-1"><i class="fa fa-info-circle"></i> ویجتی وجود ندارد</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        var typeWidget = {!! json_encode($type, JSON_HEX_TAG) !!};
        $( "#sort-1" ).sortable({
            update: function(event, ui) {
                var data = [];
                $('tbody tr').each(function(){
                    data.push(this.firstElementChild.id);
                })
                var form = {
                    "_token": "{{ csrf_token() }}",
                    widget:data,
                    type:typeWidget,
                };

                $.ajax({
                    url: "/admin/widget",
                    type: "post",
                    data: form,
                });
            }
        });
    </script>
    <script src="/js/jquery-ui.min.js"></script>
@endsection
