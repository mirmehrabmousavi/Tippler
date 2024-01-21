@extends('admin.layouts.app')

@section('content')
    <section id="dashboard-analytics">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">سئوالات متداول</h4>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-sm btn-danger delete_all">حذف موارد انتخاب شده</button>
                        </div>
                        <form action="/admin/faqs" class="d-flex justify-content-end">
                            <div class="d-flex justify-content-center">
                                <input type="text" name="search" id="search" value="{{str_replace('search=', "", request()->getQueryString())}}" class="form-control form-control-sm d-inline" style="margin-left: 5px" placeholder="جستجو ..." @if(request()->getQueryString()) autofocus @endif>
                                <button type="submit" class="btn btn-sm btn-outline-primary d-inline"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive mt-1">
                            @if(count($faqs) > 0)
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
                                    @foreach($faqs as $faq)
                                        <tr id="dataRow-{{$faq->id}}">
                                            <td>
                                                <fieldset>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input sub_chk" name="checkbox[]" data-id="{{$faq->id}}" id="check-{{$faq->id}}">
                                                        <label class="custom-control-label" for="check-{{$faq->id}}"></label>
                                                    </div>
                                                </fieldset>
                                            </td>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$faq->title}}</td>
                                            <td>{{jdate($faq->created_at)->format('%A, %d %B %y H:i:s')}}</td>
                                            <td>
                                                <a href="{{route('admin.faqs.edit', ['faq' => $faq->id])}}" class="text-secondary mr-1 waves-effect waves-light"><i class="feather icon-edit"></i></a>
                                                <a class="text-secondary mr-1 waves-effect waves-light text-danger" data-toggle="modal" data-target="#delete-{{$faq->id}}"
                                                   data-tr="tr_{{$faq->id}}"
                                                   data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"
                                                   data-btn-ok-class="btn btn-sm btn-danger"
                                                   data-btn-cancel-label="Cancel"
                                                   data-btn-cancel-icon="fa fa-chevron-circle-left"
                                                   data-btn-cancel-class="btn btn-sm btn-default"
                                                   data-title="Are you sure you want to delete ?"
                                                   data-placement="left" data-singleton="true"><i class="feather icon-trash"></i></a>
                                                <div class="modal fade text-left" id="delete-{{$faq->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-danger white">
                                                                <h5 class="modal-title" id="myModalLabel120">از حذف محتوا با نام "{{$faq->title}}" اطمینان داری؟</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="{{route('admin.faqs.destroy', [$faq->id])}}"
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

                                        <script>
                                            $('#check-{{$faq->id}}').on('change', function() {
                                                var isChecked = $(this).prop('checked');
                                                var $tr = $('#dataRow-{{$faq->id}}');

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
                                {{$faqs->links('admin.pagination.paginate')}}
                            @else
                                <div class="alert alert-danger mx-1 text-center"><i class="fa fa-info-circle"></i> سئوالات متداول وجود ندارد</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
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
                    alert("لطفا یک سئوالات متداول انتخاب کنید");
                }  else {

                    var check = confirm("مطمئنی می خوای این سیئوالات متداول رو پاک کنی؟");
                    if(check === true){
                        var join_selected_values = allVals.join(",");
                        $.ajax({
                            url: '{{route('admin.faqs.destroyAll')}}',
                            type: 'DELETE',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids='+join_selected_values,
                            success: function (data) {
                                if (data['success']) {
                                    $(".sub_chk:checked").each(function() {
                                        $(this).parents("tr").remove();
                                    });
                                    //alert(data['success']);
                                    window.location.href='/admin/faqs'
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
