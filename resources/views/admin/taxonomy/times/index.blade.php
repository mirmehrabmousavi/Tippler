@extends('admin.layouts.app')

@section('content')
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-7">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">زمان ها</h4>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-sm btn-danger delete_all">حذف موارد انتخاب شده</button>
                        </div>
                        <form action="/admin/times" class="d-flex justify-content-end">
                            <div class="d-flex justify-content-center">
                                <input type="text" name="search" id="search" value="{{str_replace('search=', "", request()->getQueryString())}}" class="form-control form-control-sm d-inline" style="margin-left: 5px" placeholder="جستجو ..." @if(request()->getQueryString()) autofocus @endif>
                                <button type="submit" class="btn btn-sm btn-outline-primary d-inline"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive mt-1">
                            @if(count($times) > 0)
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
                                    <th>تاریخ</th>
                                    <th>اقدامات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($times as $time)
                                <tr id="dataRow-{{$time->id}}">
                                    <td>
                                        <fieldset>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input sub_chk" name="checkbox[]" data-id="{{$time->id}}" id="check-{{$time->id}}">
                                                <label class="custom-control-label" for="check-{{$time->id}}"></label>
                                            </div>
                                        </fieldset>
                                    </td>
                                    <script>
                                        $('#check-{{$time->id}}').on('change', function() {
                                            var isChecked = $(this).prop('checked');
                                            var $tr = $('#dataRow-{{$time->id}}');

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
                                    <td>{{$time->name}}</td>
                                    <td>{{jdate($time->created_at)->format('%A, %d %B %y')}}</td>
                                    <td>
                                        <a class="text-secondary mr-1 waves-effect waves-light" data-toggle="modal" data-target="#edit-{{$time->id}}"><i class="feather icon-edit"></i></a>
                                        <div class="modal fade text-left" id="edit-{{$time->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-secondary white">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form" action="{{route('admin.times.update', [$time->id])}}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="form-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="name1">عنوان* :</label>
                                                                            <input type="text" id="name1" value="{{$time->name}}" class="form-control @error('name') is-invalid @enderror" placeholder="عنوان را وراد کنید" name="name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="day">بازه زمانی ارسال (روز) :</label>
                                                                            <select name="day" id="day" class="form-control">
                                                                                @for($i=0;$i<=9;$i++)
                                                                                <option value="{{$i}}" {{$time->day == $i ? 'selected' : ''}}>{{$i}}</option>
                                                                                @endfor
                                                                               {{-- <option value="2" {{$time->day == 2 ? 'selected' : ''}}>2</option>
                                                                                <option value="3" {{$time->day == 3 ? 'selected' : ''}}>3</option>
                                                                                <option value="4" {{$time->day == 4 ? 'selected' : ''}}>4</option>
                                                                                <option value="5" {{$time->day == 5 ? 'selected' : ''}}>5</option>
                                                                                <option value="6" {{$time->day == 6 ? 'selected' : ''}}>6</option>
                                                                                <option value="7" {{$time->day == 7 ? 'selected' : ''}}>7</option>
                                                                                <option value="8" {{$time->day == 8 ? 'selected' : ''}}>8</option>
                                                                                <option value="9" {{$time->day == 9 ? 'selected' : ''}}>9</option>--}}
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label for="from">از چه ساعت* :</label>
                                                                            <select name="from" id="from" class="form-control">
                                                                                <option value="1" {{$time->from == 1 ? 'selected' : ''}}>1</option>
                                                                                <option value="2" {{$time->from == 2 ? 'selected' : ''}}>2</option>
                                                                                <option value="3" {{$time->from == 3 ? 'selected' : ''}}>3</option>
                                                                                <option value="4" {{$time->from == 4 ? 'selected' : ''}}>4</option>
                                                                                <option value="5" {{$time->from == 5 ? 'selected' : ''}}>5</option>
                                                                                <option value="6" {{$time->from == 6 ? 'selected' : ''}}>6</option>
                                                                                <option value="7" {{$time->from == 7 ? 'selected' : ''}}>7</option>
                                                                                <option value="8" {{$time->from == 8 ? 'selected' : ''}}>8</option>
                                                                                <option value="9" {{$time->from == 9 ? 'selected' : ''}}>9</option>
                                                                                <option value="10" {{$time->from == 10 ? 'selected' : ''}}>10</option>
                                                                                <option value="11" {{$time->from == 11 ? 'selected' : ''}}>11</option>
                                                                                <option value="12" {{$time->from == 12 ? 'selected' : ''}}>12</option>
                                                                                <option value="13" {{$time->from == 13 ? 'selected' : ''}}>13</option>
                                                                                <option value="14" {{$time->from == 14 ? 'selected' : ''}}>14</option>
                                                                                <option value="15" {{$time->from == 15 ? 'selected' : ''}}>15</option>
                                                                                <option value="16" {{$time->from == 16 ? 'selected' : ''}}>16</option>
                                                                                <option value="17" {{$time->from == 17 ? 'selected' : ''}}>17</option>
                                                                                <option value="18" {{$time->from == 18 ? 'selected' : ''}}>18</option>
                                                                                <option value="19" {{$time->from == 19 ? 'selected' : ''}}>19</option>
                                                                                <option value="20" {{$time->from == 20 ? 'selected' : ''}}>20</option>
                                                                                <option value="21" {{$time->from == 21 ? 'selected' : ''}}>21</option>
                                                                                <option value="22" {{$time->from == 22 ? 'selected' : ''}}>22</option>
                                                                                <option value="23" {{$time->from == 23 ? 'selected' : ''}}>23</option>
                                                                                <option value="24" {{$time->from == 24 ? 'selected' : ''}}>24</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label for="to">تا چه ساعت* :</label>
                                                                            <select name="to" id="to" class="form-control">
                                                                                <option value="1" {{$time->to == 1 ? 'selected' : ''}}>1</option>
                                                                                <option value="2" {{$time->to == 2 ? 'selected' : ''}}>2</option>
                                                                                <option value="3" {{$time->to == 3 ? 'selected' : ''}}>3</option>
                                                                                <option value="4" {{$time->to == 4 ? 'selected' : ''}}>4</option>
                                                                                <option value="5" {{$time->to == 5 ? 'selected' : ''}}>5</option>
                                                                                <option value="6" {{$time->to == 6 ? 'selected' : ''}}>6</option>
                                                                                <option value="7" {{$time->to == 7 ? 'selected' : ''}}>7</option>
                                                                                <option value="8" {{$time->to == 8 ? 'selected' : ''}}>8</option>
                                                                                <option value="9" {{$time->to == 9 ? 'selected' : ''}}>9</option>
                                                                                <option value="10" {{$time->to == 10 ? 'selected' : ''}}>10</option>
                                                                                <option value="11" {{$time->to == 11 ? 'selected' : ''}}>11</option>
                                                                                <option value="12" {{$time->to == 12 ? 'selected' : ''}}>12</option>
                                                                                <option value="13" {{$time->to == 13 ? 'selected' : ''}}>13</option>
                                                                                <option value="14" {{$time->to == 14 ? 'selected' : ''}}>14</option>
                                                                                <option value="15" {{$time->to == 15 ? 'selected' : ''}}>15</option>
                                                                                <option value="16" {{$time->to == 16 ? 'selected' : ''}}>16</option>
                                                                                <option value="17" {{$time->to == 17 ? 'selected' : ''}}>17</option>
                                                                                <option value="18" {{$time->to == 18 ? 'selected' : ''}}>18</option>
                                                                                <option value="19" {{$time->to == 19 ? 'selected' : ''}}>19</option>
                                                                                <option value="20" {{$time->to == 20 ? 'selected' : ''}}>20</option>
                                                                                <option value="21" {{$time->to == 21 ? 'selected' : ''}}>21</option>
                                                                                <option value="22" {{$time->to == 22 ? 'selected' : ''}}>22</option>
                                                                                <option value="23" {{$time->to == 23 ? 'selected' : ''}}>23</option>
                                                                                <option value="24" {{$time->to == 24 ? 'selected' : ''}}>24</option>
                                                                            </select>
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
                                        <a class="text-secondary mr-1 waves-effect waves-light text-danger" data-toggle="modal" data-target="#delete-{{$time->id}}"><i class="feather icon-trash"></i></a>
                                        <div class="modal fade text-left" id="delete-{{$time->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger white">
                                                        <h5 class="modal-title" id="myModalLabel120">مطمئنی می خوای این زمان رو حذف کنی؟</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{route('admin.times.destroy', [$time->id])}}"
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
                            {{$times->links('admin.pagination.paginate')}}
                            @else
                                <div class="alert alert-danger mx-1 text-center"><i class="fa fa-info-circle"></i> زمانی وجود ندارد</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">افزودن زمان</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{route('admin.times.store')}}" method="POST">
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
                                                <label for="day">بازه زمانی ارسال (روز) :</label>
                                                <select name="day" id="day" class="form-control">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="from">از چه ساعت* :</label>
                                                <select name="from" id="from" class="form-control">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="to">تا چه ساعت* :</label>
                                                <select name="to" id="to" class="form-control">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                </select>
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
                    alert("لطفا یک زمان انتخاب کنید");
                }  else {

                    var check = confirm("مطمئنی می خوای این زمان ها رو پاک کنی؟");
                    if(check ===true){
                        var join_selected_values = allVals.join(",");
                        $.ajax({
                            url: '{{route('admin.times.destroyAll')}}',
                            type: 'DELETE',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids='+join_selected_values,
                            success: function (data) {
                                if (data['success']) {
                                    $(".sub_chk:checked").each(function() {
                                        $(this).parents("tr").remove();
                                    });
                                    //alert(data['success']);
                                    window.location.href='/admin/times'
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
