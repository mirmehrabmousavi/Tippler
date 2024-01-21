@extends('admin.layouts.app')

@section('content')
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-7">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">ارز ها</h4>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-sm btn-danger delete_all">حذف موارد انتخاب شده</button>
                        </div>
                        <form action="/admin/currency" class="d-flex justify-content-end">
                            <div class="d-flex justify-content-center">
                                <input type="text" name="search" id="search" value="{{str_replace('search=', "", request()->getQueryString())}}" class="form-control form-control-sm d-inline" style="margin-left: 5px" placeholder="جستجو ..." @if(request()->getQueryString()) autofocus @endif>
                                <button type="submit" class="btn btn-sm btn-outline-primary d-inline"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive mt-1">
                            @if(count($currencies) > 0)
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
                                    <th>مبلغ</th>
                                    <th>تاریخ</th>
                                    <th>اقدامات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($currencies as $currency)
                                <tr id="dataRow-{{$currency->id}}">
                                    <td>
                                        <fieldset>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input sub_chk" name="checkbox[]" data-id="{{$currency->id}}" id="check-{{$currency->id}}">
                                                <label class="custom-control-label" for="check-{{$currency->id}}"></label>
                                            </div>
                                        </fieldset>
                                    </td>
                                    <script>
                                        $('#check-{{$currency->id}}').on('change', function() {
                                            var isChecked = $(this).prop('checked');
                                            var $tr = $('#dataRow-{{$currency->id}}');

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
                                    <td>{{$currency->name}}</td>
                                    <td>{{number_format($currency->price)}}</td>
                                    <td>{{jdate($currency->created_at)->ago()}}</td>
                                    <td>
                                        <a class="text-secondary mr-1 waves-effect waves-light" data-toggle="modal" data-target="#show-{{$currency->id}}"><i class="feather icon-eye"></i></a>
                                        <div class="modal fade text-left" id="show-{{$currency->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-secondary white">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row d-flex justify-content-center">
                                                            <div class="col-12 mt-1">
                                                                <p class="text-center">نام</p>
                                                                <p class="text-center text-white">{{$currency->name}}</p>
                                                            </div>

                                                            <div class="col-12 mt-1">
                                                                <p class="text-center">قیمت</p>
                                                                <p class="text-center text-white">{{$currency->price}}</p>
                                                            </div>

                                                            <div class="col-12 mt-1">
                                                                <p class="text-center">تاریخ ثبت</p>
                                                                <p class="text-center text-white">{{jdate($currency->created_at)->ago()}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="text-secondary mr-1 waves-effect waves-light" data-toggle="modal" data-target="#edit-{{$currency->id}}"><i class="feather icon-edit"></i></a>
                                        <div class="modal fade text-left" id="edit-{{$currency->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-secondary white">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form" action="{{route('admin.currency.update', [$currency->id])}}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="form-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="name1">نام* :</label>
                                                                            <input type="text" id="name1" value="{{$currency->name}}" class="form-control @error('name') is-invalid @enderror" placeholder="نام را وراد کنید" name="name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="main_price1">قیمت* :</label>
                                                                            <input type="text" id="main_price1" value="{{$currency->price}}" class="form-control @error('price') is-invalid @enderror" placeholder="قیمت را وارد کنید" name="price">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <button type="submit" class="btn btn-outline-success btn-sm mr-1 mb-1 waves-effect waves-light">بروزرسانی</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="text-secondary mr-1 waves-effect waves-light text-danger" data-toggle="modal" data-target="#delete-{{$currency->id}}"><i class="feather icon-trash"></i></a>
                                        <div class="modal fade text-left" id="delete-{{$currency->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger white">
                                                        <h5 class="modal-title" id="myModalLabel120">مطمئنی می خوای این تصویر رو حذف کنی؟</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{route('admin.currency.destroy', [$currency->id])}}"
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
                            {{$currencies->links('admin.pagination.paginate')}}
                            @else
                                <div class="alert alert-danger mx-1 text-center"><i class="fa fa-info-circle"></i> ارزی وجود ندارد</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">افزودن ارز</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="main_name">عنوان* :</label>
                                            <input type="text" id="main_name" class="form-control @error('name') is-invalid @enderror" placeholder="عنوان را وارد کنید" name="name">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="main_price">قیمت* :</label>
                                            <input type="number" max="10" id="main_price" class="form-control @error('price') is-invalid @enderror" placeholder="قیمت را وارد کنید" name="price">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button id="createTag" class="btn btn-outline-success btn-sm mr-1 mb-1 waves-effect waves-light w-100 d-block">ذخیره</button>
                                    </div>
                                </div>
                            </div>
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

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#showMeta").on('click', function () {
                $('#meta').slideToggle('slow');
            });

            $("#createTag").click(function (event) {
                event.preventDefault()
                $("#createTag").text('صبر کنید ...');

                var name = $("#main_name").val();
                var price = $("#main_price").val();

                $.ajax({
                    url: "{{route('admin.currency.store')}}",
                    type: "post",
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: name,
                        price: price,
                    },
                    success: function (data) {
                        toastr.success('با موفقیت ذخیره شد.');
                        window.location.href = "/admin/currency";
                    },
                    error: function (response) {
                        toastr.success('مشکلی پیش اومده بعدا امتحان کن.')
                        toastr.success('قیمت بایستی حداکثر 10 رقم باشد.')
                    }
                });
            });

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
                    alert("لطفا یک دسته بندی انتخاب کنید");
                }  else {

                    var check = confirm("مطمئنی می خوای این دسته بندی ها رو پاک کنی؟");
                    if(check === true){
                        var join_selected_values = allVals.join(",");
                        $.ajax({
                            url: '{{route('admin.currency.destroyAll')}}',
                            type: 'DELETE',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids='+join_selected_values,
                            success: function (data) {
                                if (data['success']) {
                                    $(".sub_chk:checked").each(function() {
                                        $(this).parents("tr").remove();
                                    });
                                    //alert(data['success']);
                                    window.location.href='/admin/currency'
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
