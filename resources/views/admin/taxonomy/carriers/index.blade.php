@extends('admin.layouts.app')

@section('content')
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-7">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">حامل ها</h4>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-sm btn-danger delete_all">حذف موارد انتخاب شده</button>
                        </div>
                        <form action="/admin/carriers" class="d-flex justify-content-end">
                            <div class="d-flex justify-content-center">
                                <input type="text" name="search" id="search" value="{{str_replace('search=', "", request()->getQueryString())}}" class="form-control form-control-sm d-inline" style="margin-left: 5px" placeholder="جستجو ..." @if(request()->getQueryString()) autofocus @endif>
                                <button type="submit" class="btn btn-sm btn-outline-primary d-inline"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive mt-1">
                            @if(count($carriers) > 0)
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
                                    <th>#</th>
                                    <th>عنوان</th>
                                    <th>قیمت</th>
                                    <th>اقدامات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($carriers as $carrier)
                                <tr id="dataRow-{{$carrier->id}}">
                                    <td>
                                        <fieldset>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input sub_chk" name="checkbox[]" data-id="{{$carrier->id}}" id="check-{{$carrier->id}}">
                                                <label class="custom-control-label" for="check-{{$carrier->id}}"></label>
                                            </div>
                                        </fieldset>
                                    </td>
                                    <script>
                                        $('#check-{{$carrier->id}}').on('change', function() {
                                            var isChecked = $(this).prop('checked');
                                            var $tr = $('#dataRow-{{$carrier->id}}');

                                            if (isChecked) {
                                                $tr.css('background-color', 'rgba(115,103,240,0.2)').css('border', '1px solid rgba(115,103,240,0.7)');
                                                $('.delete_all').show()
                                            } else {
                                                $tr.css('background-color', '').css('border', '');
                                                $('.delete_all').hide()
                                            }
                                        });
                                    </script>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$carrier->name}}</td>
                                    <td>{{number_format($carrier->price)}}</td>
                                    <td>
                                        <a class="text-secondary mr-1 waves-effect waves-light" data-toggle="modal" data-target="#edit-{{$carrier->id}}"><i class="feather icon-edit"></i></a>
                                        <div class="modal fade text-left" id="edit-{{$carrier->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-secondary white">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form" action="{{route('admin.carriers.update', [$carrier->id])}}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="form-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="name1">عنوان* :</label>
                                                                            <input type="text" id="name1" value="{{$carrier->name}}" class="form-control @error('name') is-invalid @enderror" placeholder="عنوان را وراد کنید" name="name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="price">قیمت* :</label>
                                                                            <input type="number" id="price" value="{{$carrier->price}}" class="form-control @error('price') is-invalid @enderror" placeholder="قیمت را وراد کنید" name="price">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="limit">بیشتر از این مبلغ حامل رایگان است* : </label>
                                                                            <input type="number" id="limit" value="{{$carrier->limit}}" class="form-control @error('limit') is-invalid @enderror" placeholder="قیمت را وراد کنید" name="limit">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <button type="submit" class="btn btn-outline-success btn-sm mr-1 mb-1 waves-effect waves-light">بروزرسانی</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="text-secondary mr-1 waves-effect waves-light text-danger" data-toggle="modal" data-target="#delete-{{$carrier->id}}"><i class="feather icon-trash"></i></a>
                                        <div class="modal fade text-left" id="delete-{{$carrier->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger white">
                                                        <h5 class="modal-title" id="myModalLabel120">مطمئنی می خوای این حامل رو حذف کنی؟</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{route('admin.carriers.destroy', [$carrier->id])}}"
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
                            {{$carriers->links('admin.pagination.paginate')}}
                            @else
                                <div class="alert alert-danger mx-1 text-center"><i class="fa fa-info-circle"></i> حاملی ایی وجود ندارد</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">افزودن حامل</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{route('admin.carriers.store')}}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="name">عنوان* :</label>
                                                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="عنوان را وراد کنید" name="name">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="price">قیمت* :</label>
                                                <input type="number" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="قیمت را وراد کنید" name="price">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="limit">بیشتر از این مبلغ حامل رایگان است* : </label>
                                                <input type="number" id="limit" class="form-control @error('limit') is-invalid @enderror" placeholder="قیمت را وراد کنید" name="limit">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-outline-success btn-sm mr-1 mb-1 waves-effect waves-light w-100 d-block">ذخیره</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.delete_all').hide();

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
                    alert("لطفا یک حامل انتخاب کنید");
                }  else {

                    var check = confirm("مطمئنی می خوای این حامل ها رو پاک کنی؟");
                    if(check ===true){
                        var join_selected_values = allVals.join(",");
                        $.ajax({
                            url: '{{route('admin.carriers.destroyAll')}}',
                            type: 'DELETE',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids='+join_selected_values,
                            success: function (data) {
                                if (data['success']) {
                                    $(".sub_chk:checked").each(function() {
                                        $(this).parents("tr").remove();
                                    });
                                    //alert(data['success']);
                                    window.location.href='/admin/carriers'
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
        })
    </script>
@endsection
