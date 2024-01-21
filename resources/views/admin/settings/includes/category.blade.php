<div role="tabpanel" class="tab-pane {{(request()->tab == 'category')? 'active' : ' fade'}}" id="category"
     aria-labelledby="settings-category" aria-expanded="true">
    <form novalidate="">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <div class="controls">
                        <label for="catHeader">دسته بندی</label>
                        <select class="form-control" name="catHeader" id="catHeader" multiple="multiple">
                            @if(json_decode($catHeader) > 0)
                                @foreach(json_decode($catHeader) as $item1)
                                <option value="{{$item1}}" selected>{{$item1}}</option>
                                @endforeach
                                @php $categories = \App\Models\Category::where('type', 'product')->where('name', '!==', json_decode($catHeader))->get(); @endphp
                                @foreach($categories as $val)
                                    <option value="{{$val->name}}">{{$val->name}}</option>
                                @endforeach
                            @else
                                @php $categories = \App\Models\Category::where('type', 'product')->get(); @endphp
                                @foreach($categories as $item)
                                <option value="{{$item->name}}">{{$item->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                <button id="createCategory" class="btn btn-outline-success btn-sm mr-sm-1 mb-1 mb-sm-0 waves-effect waves-light">ذخیره</button>
            </div>
        </div>
    </form>
</div>

@section('script-settings-category')
    <script>
        $('#catHeader').select2({
            placeholder: 'دسته بندی ها را انتخاب کنید ...',
            "language": {
                "noResults": function () {
                    return "موردی پیدا نشد";
                }
            },
        });
        //Category Update Data
        $("#createCategory").click(function (event) {
            event.preventDefault()
            $("#createCategory").text('صبر کنید ...');

            var categories = $("select[name='catHeader'] :selected").map(function(){
                return $(this).val();
            }).get();

            $.ajax({
                url: "{{route('admin.settings.categoryUpdate')}}",
                type: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    catHeader: categories,
                },
                success: function (data) {
                    toastr.success('با موفقیت ذخیره شد.');
                    window.location.href = "/admin/settings?tab=category";
                },
                error: function (response) {
                    toastr.success('مشکلی پیش اومده بعدا امتحان کن.')
                    $("#createCategory").text('ذخیره');
                }
            });
        });
    </script>
@endsection
