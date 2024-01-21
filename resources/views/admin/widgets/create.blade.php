@extends('admin.layouts.app')

@section('content')
    <h4>افزودن ویجت</h4>
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group change1">
                                        <label for="name">نوع ویجت* :</label>
                                        <select name="name" id="name" class="form-control">
                                            <option value="تبلیغ اسلایدری">تبلیغ اسلایدری</option>
                                            <option value="تبلیغ ساده">تبلیغ ساده</option>
                                            <option value="اسلایدر بزرگ">اسلایدر بزرگ</option>
                                            <option value="دسته بندی">دسته بندی</option>
                                            <option value="خبر">خبر</option>
                                            <option value="گردونه دسته بندی">گردونه دسته بندی</option>
                                            <option value="پک محصولات">پک محصولات</option>
                                            <option value="لیستی">لیستی</option>
                                            <option value="جستجو2">جستجو2</option>
                                            <option value="جستجو">جستجو</option>
                                            <option value="بهترین ها">بهترین ها</option>
                                            <option value="شگفت انگیز">شگفت انگیز</option>
                                            <option value="پیشنهاد لحظه ای">پیشنهاد لحظه ای</option>
                                            <option value="محصولات اسلایدری" selected>محصولات اسلایدری</option>
                                            <option value="محصول عرضی">محصول عرضی</option>
                                            <option value="استوری">استوری</option>
                                            <option value="وام">وام</option>
                                            <option value="جشنواره">جشنواره</option>
                                            <option value="فروشندگان">فروشندگان</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group change2">
                                        <label for="title">نمایش عنوان :</label>
                                        <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="عنوان را وارد کنید" name="title">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group change3">
                                        <label for="more">عنوان مشاهده بیشتر :</label>
                                        <input type="text" id="more" class="form-control @error('more') is-invalid @enderror" placeholder="عنوان مشاهده بیشتر را وارد کنید" name="more">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group change5">
                                        <label for="description">توضیحات :</label>
                                        <input type="text" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="توضیحات را وارد کنید" name="description">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group change6">
                                        <label for="background">رنگ پس زمینه :</label>
                                        <input type="color" id="background" class="form-control @error('background') is-invalid @enderror" placeholder="رنگ پس زمینه را وارد کنید" name="background">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group change7">
                                        <label for="slug">پیوند یکتا (slug) :</label>
                                        <input type="text" id="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="پیوند را وارد کنید" name="slug">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group change8">
                                        <label for="background2">آدرس تصویر :</label>
                                        <input type="text" id="background2" class="form-control @error('background2') is-invalid @enderror" placeholder="آدرس تصویر را وارد کنید" name="background2">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group change9">
                                        <label for="count">تعداد نمایش :</label>
                                        <input type="text" id="count" class="form-control @error('count') is-invalid @enderror" placeholder="تعداد نمایش را وارد کنید" name="count">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group change18">
                                        <label for="height">ارتفاع تصویر(rem) :</label>
                                        <input type="number" id="height" class="form-control @error('height') is-invalid @enderror" placeholder="ارتفاع تصویر(rem) را وارد کنید" name="height">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group change21">
                                        <label for="number">زمان شروع یا پایان جشنواره :</label>
                                        <input type="text" id="number" class="form-control @error('number') is-invalid @enderror" placeholder="زمان شروع یا پایان جشنواره را وارد کنید" name="number">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group change19">
                                        <label for="move">امکان حرکت :</label>
                                        <select class="form-control" name="move" id="move">
                                            <option value="0" selected>بدون حرکت</option>
                                            <option value="1">حرکت اسلایدر</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="responsive">نوع :</label>
                                        <select class="form-control" name="responsive" id="responsive">
                                            <option value="0" selected>حالت دسکتاپ</option>
                                            <option value="1">حالت موبایل</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group change10">
                                        <label for="cats">دسته بندی :</label>
                                        <select class="form-control" name="cats" id="cats" class="form-control" multiple="multiple">
                                            @foreach($cats as $category)
                                                <option value="{{$category->name}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group change11">
                                        <label for="brands">برند :</label>
                                        <select class="form-control" name="brands" id="brands" class="form-control" multiple="multiple">
                                            @foreach($brands as $brand)
                                                <option value="{{$brand->name}}">{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group change12">
                                        <label for="sort">نمایش براساس :</label>
                                        <select class="form-control" name="sort" id="sort">
                                            <option value="0">جدید ترین</option>
                                            <option value="1">محبوب ترین</option>
                                            <option value="2">پربازدید ترین</option>
                                            <option value="3">ارزان ترین</option>
                                            <option value="4">گران ترین</option>
                                            <option value="5">پرفروش ترین</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group change13">
                                        <label for="type">نوع کالا :</label>
                                        <select class="form-control" name="type" id="type">
                                            <option value="3">همه</option>
                                            <option value="0">فقط موجود</option>
                                            <option value="1">تخفیف خورده</option>
                                            <option value="2">پیشنهادی</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group change14">
                                        <label for="status">وضعیت نمایش :</label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="0">پیشنویس</option>
                                            <option value="1" selected>انتشار</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 py-1 mt-1 border-secondary change15">
                                    <div class="d-flex justify-content-between px-1">
                                        <a id="addAd1"><i class="feather icon-plus-circle font-size-large"></i></a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>تصویر تبلیغ</th>
                                                <th>آدرس تبلیغ</th>
                                                <th>حذف</th>
                                            </tr>
                                            </thead>
                                            <tbody id="ads1"></tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12 py-1 mt-1 border-secondary change16">
                                    <div class="d-flex justify-content-between px-1">
                                        <a id="addAd2"><i class="feather icon-plus-circle font-size-large"></i></a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>تصویر تبلیغ سمت راست</th>
                                                <th>آدرس تبلیغ سمت راست</th>
                                                <th>حذف</th>
                                            </tr>
                                            </thead>
                                            <tbody id="ads2"></tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12 py-1 mt-1 border-secondary change17">
                                    <div class="d-flex justify-content-between px-1">
                                        <a id="addAd3"><i class="feather icon-plus-circle font-size-large"></i></a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>تصویر تبلیغ سمت چپ</th>
                                                <th>آدرس تبلیغ سمت چپ</th>
                                                <th>حذف</th>
                                            </tr>
                                            </thead>
                                            <tbody id="ads3"></tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12 py-1 mt-1 border-secondary change20">
                                    <div class="d-flex justify-content-between px-1">
                                        <a id="addAd4"><i class="feather icon-plus-circle font-size-large"></i></a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>آدرس استوری(تصویر یا ویدئو)</th>
                                                <th>تصویر کاور</th>
                                                <th>نوع</th>
                                                <th>زمان پایان (روز)</th>
                                                <th>حذف</th>
                                            </tr>
                                            </thead>
                                            <tbody id="ads4"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <button id="createWidget" class="btn btn-outline-success btn-sm mr-1 mb-1 waves-effect waves-light">ذخیره</button>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#brands').select2({
                placeholder: 'برند را انتخاب کنید ...',
                "language": {
                    "noResults": function(){
                        return "موردی پیدا نشد";
                    }
                },
            });
            $('#cats').select2({
                placeholder: 'دسته بندی را انتخاب کنید ...',
                "language": {
                    "noResults": function(){
                        return "موردی پیدا نشد";
                    }
                },
            });
            $('#addAd1').click(function (){
                $('#ads1').append(
                    $(`<tr>
                            <td><input type="text" class="form-control border-secondary" name="image" placeholder="تصویر را وارد کنید"></td>
                            <td><input type="text" class="form-control border-secondary" name="address" placeholder="آدرس را وارد کنید"></td>
                            <td><a id="deleteAbility" class="text-danger"><i class="feather icon-trash text-danger"></i></a></td>
                        </tr>`)
                        .on('click' , '#deleteAbility',function(ss){
                            ss.currentTarget.parentElement.parentElement.remove();
                        })
                );
            })
            $('#addAd2').click(function (){
                $('#ads2').append(
                    $(`<tr>
                            <td><input type="text" class="form-control border-secondary" name="image" placeholder="تصویر را وارد کنید"></td>
                            <td><input type="text" class="form-control border-secondary" name="address" placeholder="آدرس را وارد کنید"></td>
                            <td><a id="deleteAbility" class="text-danger"><i class="feather icon-trash text-danger"></i></a></td>
                        </tr>`)
                        .on('click' , '#deleteAbility',function(ss){
                            ss.currentTarget.parentElement.parentElement.remove();
                        })
                );
            })
            $('#addAd3').click(function (){
                $('#ads3').append(
                    $(`<tr>
                            <td><input type="text" class="form-control border-secondary" name="image" placeholder="تصویر را وارد کنید"></td>
                            <td><input type="text" class="form-control border-secondary" name="address" placeholder="آدرس را وارد کنید"></td>
                            <td><a id="deleteAbility" class="text-danger"><i class="feather icon-trash text-danger"></i></a></td>
                        </tr>`)
                        .on('click' , '#deleteAbility',function(ss){
                            ss.currentTarget.parentElement.parentElement.remove();
                        })
                );
            })
            $('#addAd4').click(function (){
                $('#ads4').append(
                    $(`<tr>
                            <td><input type="text" class="form-control border-secondary" name="image" placeholder="تصویر یا ویدئو را وارد کنید"></td>
                            <td><input type="text" class="form-control border-secondary" name="cover" placeholder="آدرس تصویر را وارد کنید"></td>
                            <td><select class="form-control border-secondary" name="type" id="type">
                                    <option value="0">تصویر</option>
                                    <option value="1">ویدئو</option>
                                </select></td>
                            <td><input type="text" class="form-control border-secondary" name="day" placeholder="تعداد روز"></td>
                            <td><a id="deleteAbility" class="text-danger"><i class="feather icon-trash text-danger"></i></a></td>
                        </tr>`)
                        .on('click' , '#deleteAbility',function(ss){
                            ss.currentTarget.parentElement.parentElement.remove();
                        })
                );
            })
            if($("select[name='name']").val() === 'لیستی'){
                $('.change4').hide();
                $('.change5').hide();
                $('.change6').hide();
                $('.change8').hide();
                $('.change15').hide();
                $('.change16').hide();
                $('.change17').hide();
                $('.change20').hide();
                $('.change19').hide();
                $('.change21').hide();
            }
            if($("select[name='name']").val() == 'تبلیغ اسلایدری'){
                $('.change2').hide();
                $('.change3').hide();
                $('.change4').hide();
                $('.change5').hide();
                $('.change6').hide();
                $('.change7').hide();
                $('.change8').hide();
                $('.change9').hide();
                $('.change10').hide();
                $('.change11').hide();
                $('.change12').hide();
                $('.change13').hide();
                $('.change15').hide();
                $('.change18').hide();
                $('.change19').hide();
                $('.change21').hide();
            }
            if($("select[name='name']").val() == 'تبلیغ ساده'){
                $('.change2').hide();
                $('.change3').hide();
                $('.change4').hide();
                $('.change5').hide();
                $('.change6').hide();
                $('.change7').hide();
                $('.change8').hide();
                $('.change9').hide();
                $('.change10').hide();
                $('.change11').hide();
                $('.change12').hide();
                $('.change13').hide();
                $('.change16').hide();
                $('.change17').hide();
                $('.change20').hide();
                $('.change18').hide();
                $('.change19').hide();
                $('.change21').hide();
            }
            if($("select[name='name']").val() == 'اسلایدر بزرگ'){
                $('.change2').hide();
                $('.change3').hide();
                $('.change4').hide();
                $('.change5').hide();
                $('.change6').hide();
                $('.change7').hide();
                $('.change8').hide();
                $('.change9').hide();
                $('.change10').hide();
                $('.change11').hide();
                $('.change12').hide();
                $('.change13').hide();
                $('.change16').hide();
                $('.change17').hide();
                $('.change20').hide();
                $('.change18').hide();
                $('.change19').hide();
                $('.change21').hide();
            }
            if($("select[name='name']").val() == 'دسته بندی'){
                $('.change2').hide();
                $('.change3').hide();
                $('.change4').hide();
                $('.change5').hide();
                $('.change6').hide();
                $('.change7').hide();
                $('.change8').hide();
                $('.change9').hide();
                $('.change11').hide();
                $('.change12').hide();
                $('.change13').hide();
                $('.change15').hide();
                $('.change16').hide();
                $('.change17').hide();
                $('.change20').hide();
                $('.change18').hide();
                $('.change19').hide();
                $('.change21').hide();
            }
            if($("select[name='name']").val() == 'خبر' || $("select[name='name']").val() == 'پک محصولات' || $("select[name='name']").val() == 'فروشندگان'){
                $('.change3').hide();
                $('.change4').hide();
                $('.change5').hide();
                $('.change6').hide();
                $('.change7').hide();
                $('.change8').hide();
                $('.change9').hide();
                $('.change10').hide();
                $('.change11').hide();
                $('.change12').hide();
                $('.change13').hide();
                $('.change15').hide();
                $('.change16').hide();
                $('.change17').hide();
                $('.change20').hide();
                $('.change18').hide();
                $('.change19').hide();
                $('.change21').hide();
            }
            if($("select[name='name']").val() == 'جستجو' ||$("select[name='name']").val() == 'جستجو2'){
                $('.change2').hide();
                $('.change3').hide();
                $('.change4').hide();
                $('.change5').hide();
                $('.change6').hide();
                $('.change7').hide();
                $('.change8').hide();
                $('.change9').hide();
                $('.change10').hide();
                $('.change11').hide();
                $('.change12').hide();
                $('.change13').hide();
                $('.change15').hide();
                $('.change16').hide();
                $('.change17').hide();
                $('.change20').hide();
                $('.change18').hide();
                $('.change19').hide();
                $('.change21').hide();
            }
            if($("select[name='name']").val() == 'استوری'){
                $('.change3').hide();
                $('.change4').hide();
                $('.change5').hide();
                $('.change6').hide();
                $('.change7').hide();
                $('.change8').hide();
                $('.change9').hide();
                $('.change10').hide();
                $('.change11').hide();
                $('.change12').hide();
                $('.change13').hide();
                $('.change15').hide();
                $('.change16').hide();
                $('.change17').hide();
                $('.change18').hide();
                $('.change19').hide();
                $('.change21').hide();
            }
            if($("select[name='name']").val() == 'وام'){
                $('.change3').hide();
                $('.change4').hide();
                $('.change5').hide();
                $('.change6').hide();
                $('.change7').hide();
                $('.change8').hide();
                $('.change9').hide();
                $('.change10').hide();
                $('.change11').hide();
                $('.change12').hide();
                $('.change13').hide();
                $('.change15').hide();
                $('.change16').hide();
                $('.change17').hide();
                $('.change20').hide();
                $('.change18').hide();
                $('.change19').hide();
                $('.change21').hide();
            }
            if($("select[name='name']").val() == 'جشنواره'){
                $('.change3').hide();
                $('.change4').hide();
                $('.change5').hide();
                $('.change6').hide();
                $('.change7').hide();
                $('.change8').hide();
                $('.change9').hide();
                $('.change10').hide();
                $('.change11').hide();
                $('.change12').hide();
                $('.change13').hide();
                $('.change15').hide();
                $('.change16').hide();
                $('.change17').hide();
                $('.change20').hide();
                $('.change18').hide();
                $('.change19').hide();
            }
            if($("select[name='name']").val() == 'گردونه دسته بندی'){
                $('.change2').hide();
                $('.change3').hide();
                $('.change4').hide();
                $('.change5').hide();
                $('.change6').hide();
                $('.change7').hide();
                $('.change8').hide();
                $('.change9').hide();
                $('.change11').hide();
                $('.change12').hide();
                $('.change13').hide();
                $('.change15').hide();
                $('.change16').hide();
                $('.change17').hide();
                $('.change20').hide();
                $('.change18').hide();
                $('.change19').hide();
                $('.change21').hide();
            }
            if($("select[name='name']").val() == 'بهترین ها'){
                $('.change3').hide();
                $('.change4').hide();
                $('.change5').hide();
                $('.change6').hide();
                $('.change7').hide();
                $('.change8').hide();
                $('.change9').hide();
                $('.change10').hide();
                $('.change11').hide();
                $('.change13').hide();
                $('.change15').hide();
                $('.change16').hide();
                $('.change17').hide();
                $('.change20').hide();
                $('.change18').hide();
                $('.change19').hide();
                $('.change21').hide();
            }
            if($("select[name='name']").val() == 'شگفت انگیز'){
                $('.change15').hide();
                $('.change16').hide();
                $('.change17').hide();
                $('.change20').hide();
                $('.change21').hide();
            }
            if($("select[name='name']").val() == 'محصولات اسلایدری'){
                $('.change6').hide();
                $('.change8').hide();
                $('.change15').hide();
                $('.change16').hide();
                $('.change17').hide();
                $('.change20').hide();
                $('.change21').hide();
            }
            if($("select[name='name']").val() == 'محصول عرضی'){
                $('.change6').hide();
                $('.change8').hide();
                $('.change15').hide();
                $('.change16').hide();
                $('.change17').hide();
                $('.change20').hide();
                $('.change21').hide();
            }
            if($("select[name='name']").val() == 'پیشنهاد لحظه ای'){
                $('.change4').hide();
                $('.change3').hide();
                $('.change7').hide();
                $('.change5').hide();
                $('.change6').hide();
                $('.change8').hide();
                $('.change15').hide();
                $('.change16').hide();
                $('.change17').hide();
                $('.change20').hide();
                $('.change21').hide();
                $('.change18').hide();
                $('.change19').hide();
            }
            $("select[name='name']").change(function (){
                $('.change2').show();
                $('.change3').show();
                $('.change4').show();
                $('.change5').show();
                $('.change6').show();
                $('.change7').show();
                $('.change8').show();
                $('.change9').show();
                $('.change10').show();
                $('.change11').show();
                $('.change12').show();
                $('.change13').show();
                $('.change14').show();
                $('.change15').show();
                $('.change16').show();
                $('.change17').show();
                $('.change18').show();
                $('.change19').show();
                if(this.value == 'لیستی'){
                    $('.change4').hide();
                    $('.change5').hide();
                    $('.change6').hide();
                    $('.change8').hide();
                    $('.change15').hide();
                    $('.change16').hide();
                    $('.change17').hide();
                    $('.change19').hide();
                }
                if(this.value == 'پیشنهاد لحظه ای'){
                    $('.change4').hide();
                    $('.change3').hide();
                    $('.change7').hide();
                    $('.change5').hide();
                    $('.change6').hide();
                    $('.change8').hide();
                    $('.change15').hide();
                    $('.change16').hide();
                    $('.change17').hide();
                    $('.change18').hide();
                    $('.change19').hide();
                }
                if(this.value == 'تبلیغ اسلایدری'){
                    $('.change2').hide();
                    $('.change3').hide();
                    $('.change4').hide();
                    $('.change5').hide();
                    $('.change6').hide();
                    $('.change7').hide();
                    $('.change8').hide();
                    $('.change9').hide();
                    $('.change10').hide();
                    $('.change11').hide();
                    $('.change12').hide();
                    $('.change13').hide();
                    $('.change15').hide();
                    $('.change18').hide();
                    $('.change19').hide();
                }
                if(this.value == 'تبلیغ ساده'){
                    $('.change2').hide();
                    $('.change3').hide();
                    $('.change4').hide();
                    $('.change5').hide();
                    $('.change6').hide();
                    $('.change7').hide();
                    $('.change8').hide();
                    $('.change9').hide();
                    $('.change10').hide();
                    $('.change11').hide();
                    $('.change12').hide();
                    $('.change13').hide();
                    $('.change16').hide();
                    $('.change17').hide();
                    $('.change18').hide();
                    $('.change19').hide();
                }
                if(this.value == 'اسلایدر بزرگ'){
                    $('.change2').hide();
                    $('.change3').hide();
                    $('.change4').hide();
                    $('.change5').hide();
                    $('.change6').hide();
                    $('.change7').hide();
                    $('.change8').hide();
                    $('.change9').hide();
                    $('.change10').hide();
                    $('.change11').hide();
                    $('.change12').hide();
                    $('.change13').hide();
                    $('.change16').hide();
                    $('.change17').hide();
                }
                if(this.value == 'دسته بندی'){
                    $('.change3').hide();
                    $('.change4').hide();
                    $('.change5').hide();
                    $('.change6').hide();
                    $('.change7').hide();
                    $('.change8').hide();
                    $('.change9').hide();
                    $('.change11').hide();
                    $('.change12').hide();
                    $('.change13').hide();
                    $('.change15').hide();
                    $('.change16').hide();
                    $('.change17').hide();
                    $('.change18').hide();
                    $('.change19').hide();
                }
                if(this.value == 'خبر' ||this.value == 'پک محصولات' || this.value == 'فروشندگان'){
                    $('.change3').hide();
                    $('.change4').hide();
                    $('.change5').hide();
                    $('.change6').hide();
                    $('.change7').hide();
                    $('.change8').hide();
                    $('.change9').hide();
                    $('.change10').hide();
                    $('.change11').hide();
                    $('.change12').hide();
                    $('.change13').hide();
                    $('.change15').hide();
                    $('.change16').hide();
                    $('.change17').hide();
                    $('.change18').hide();
                    $('.change19').hide();
                }
                if(this.value == 'جستجو' || this.value == 'جستجو2'){
                    $('.change2').hide();
                    $('.change3').hide();
                    $('.change4').hide();
                    $('.change5').hide();
                    $('.change6').hide();
                    $('.change7').hide();
                    $('.change8').hide();
                    $('.change9').hide();
                    $('.change10').hide();
                    $('.change11').hide();
                    $('.change12').hide();
                    $('.change13').hide();
                    $('.change15').hide();
                    $('.change16').hide();
                    $('.change17').hide();
                    $('.change18').hide();
                    $('.change19').hide();
                }
                if(this.value == 'استوری'){
                    $('.change3').hide();
                    $('.change4').hide();
                    $('.change5').hide();
                    $('.change6').hide();
                    $('.change7').hide();
                    $('.change8').hide();
                    $('.change9').hide();
                    $('.change10').hide();
                    $('.change11').hide();
                    $('.change12').hide();
                    $('.change13').hide();
                    $('.change15').hide();
                    $('.change16').hide();
                    $('.change17').hide();
                    $('.change18').hide();
                    $('.change19').hide();
                    $('.change20').show();
                }
                if(this.value == 'وام'){
                    $('.change3').hide();
                    $('.change4').hide();
                    $('.change5').hide();
                    $('.change6').hide();
                    $('.change7').hide();
                    $('.change8').hide();
                    $('.change9').hide();
                    $('.change10').hide();
                    $('.change11').hide();
                    $('.change12').hide();
                    $('.change13').hide();
                    $('.change15').hide();
                    $('.change16').hide();
                    $('.change17').hide();
                    $('.change18').hide();
                    $('.change19').hide();
                    $('.change20').hide();
                }
                if(this.value == 'جشنواره'){
                    $('.change3').hide();
                    $('.change4').hide();
                    $('.change5').hide();
                    $('.change6').hide();
                    $('.change7').hide();
                    $('.change8').hide();
                    $('.change9').hide();
                    $('.change10').hide();
                    $('.change11').hide();
                    $('.change12').hide();
                    $('.change13').hide();
                    $('.change15').hide();
                    $('.change16').hide();
                    $('.change17').hide();
                    $('.change18').hide();
                    $('.change19').hide();
                    $('.change20').hide();
                    $('.change21').show();
                }
                if( this.value == 'گردونه دسته بندی'){
                    $('.change2').hide();
                    $('.change3').hide();
                    $('.change4').hide();
                    $('.change5').hide();
                    $('.change6').hide();
                    $('.change7').hide();
                    $('.change8').hide();
                    $('.change9').hide();
                    $('.change11').hide();
                    $('.change12').hide();
                    $('.change13').hide();
                    $('.change15').hide();
                    $('.change16').hide();
                    $('.change17').hide();
                    $('.change18').hide();
                }
                if(this.value == 'بهترین ها'){
                    $('.change3').hide();
                    $('.change4').hide();
                    $('.change5').hide();
                    $('.change6').hide();
                    $('.change7').hide();
                    $('.change8').hide();
                    $('.change9').hide();
                    $('.change10').hide();
                    $('.change11').hide();
                    $('.change13').hide();
                    $('.change15').hide();
                    $('.change16').hide();
                    $('.change17').hide();
                    $('.change18').hide();
                    $('.change19').hide();
                }
                if(this.value == 'شگفت انگیز'){
                    $('.change15').hide();
                    $('.change16').hide();
                    $('.change17').hide();
                }
                if(this.value == 'محصولات اسلایدری'){
                    $('.change6').hide();
                    $('.change8').hide();
                    $('.change15').hide();
                    $('.change16').hide();
                    $('.change17').hide();
                }
                if(this.value == 'محصول عرضی'){
                    $('.change6').hide();
                    $('.change8').hide();
                    $('.change15').hide();
                    $('.change16').hide();
                    $('.change17').hide();
                }
            })

            $("#createWidget").click(function(event){
                var name = $("select[name='name']").val();
                var title = $("input[name='title']").val();
                var more = $("input[name='more']").val();
                var move = $("select[name='move']").val();
                var height = $("input[name='height']").val();
                var number = $("input[name='number']").val();
                var description = $("input[name='description']").val();
                var background = $("input[name='background']").val();
                var slug = $("input[name='slug']").val();
                var background2 = $("input[name='background2']").val();
                var count = $("input[name='count']").val();
                var sort = $("select[name='sort']").val();
                var type = $("select[name='type']").val();
                var status = $("select[name='status']").val();
                var responsive = $("select[name='responsive']").val();

                var brands = [];
                var cats = [];
                $("select[name='brands'] :selected").each(function(){
                    brands.push($(this).val());
                });
                $("select[name='cats'] :selected").each(function(){
                    cats.push($(this).val());
                });
                var ads1 = [];
                $("#ads1 tr").each(function(){
                    if($(this).find("input").length >= 1){
                        var ad1 = {
                            image:"",
                            address:"",
                        };
                        $(this).find("input").each(function(){
                            if (this.name == 'image') {
                                ad1.image = this.value;
                            }
                            if (this.name == 'address') {
                                ad1.address = this.value;
                            }
                        })
                        ads1.push(ad1);
                    }
                });

                var ads2 = [];
                $("#ads2 tr").each(function(){
                    if($(this).find("input").length >= 1){
                        var ad2 = {
                            image:"",
                            address:"",
                        };
                        $(this).find("input").each(function(){
                            if (this.name == 'image') {
                                ad2.image = this.value;
                            }
                            if (this.name == 'address') {
                                ad2.address = this.value;
                            }
                        })
                        ads2.push(ad2);
                    }
                });

                var ads3 = [];
                $("#ads3 tr").each(function(){
                    if($(this).find("input").length >= 1){
                        var ad3 = {
                            image:"",
                            address:"",
                        };
                        $(this).find("input").each(function(){
                            if (this.name == 'image') {
                                ad3.image = this.value;
                            }
                            if (this.name == 'address') {
                                ad3.address = this.value;
                            }
                        })
                        ads3.push(ad3);
                    }
                });

                var ads4 = [];
                $("#ads4 tr").each(function(){
                    if($(this).find("input").length >= 1){
                        var ad4 = {
                            image:"",
                            cover:"",
                            type:"",
                            day:"",
                        };
                        $(this).find("input").each(function(){
                            if (this.name == 'image') {
                                ad4.image = this.value;
                            }
                            if (this.name == 'cover') {
                                ad4.cover = this.value;
                            }
                            if (this.name == 'day') {
                                ad4.day = this.value;
                            }
                        })
                        $(this).find("select").each(function(){
                            if (this.name == 'type') {
                                ad4.type = this.value;
                            }
                        })
                        ads4.push(ad4);
                    }
                });

                var form = {
                    "_token": "{{ csrf_token() }}",
                    name:name,
                    title:title,
                    more:more,
                    description:description,
                    background:background,
                    slug:slug,
                    background2:background2,
                    count:count,
                    sort:sort,
                    type:type,
                    status:status,
                    number:number,
                    responsive:responsive,
                    move:move,
                    height:height,
                    brands:JSON.stringify(brands),
                    cats:JSON.stringify(cats),
                    ads1:JSON.stringify(ads1),
                    ads2:JSON.stringify(ads2),
                    ads3:JSON.stringify(ads3),
                    ads4:JSON.stringify(ads4),
                };

                $.ajax({
                    url: "/admin/widgets/store",
                    type: "post",
                    data: form,
                    success: function (data) {
                        $.toast({
                            text: "ویجت اضافه شد", // Text that is to be shown in the toast
                            heading: 'موفقیت آمیز', // Optional heading to be shown on the toast
                            icon: 'success', // Type of toast icon
                            showHideTransition: 'fade', // fade, slide or plain
                            allowToastClose: true, // Boolean value true or false
                            hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                            position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                            textAlign: 'left',  // Text alignment i.e. left, right or center
                            loader: true,  // Whether to show loader or not. True by default
                            loaderBg: '#9EC600',  // Background color of the toast loader
                        });
                        window.location.href="/admin/widgets";
                    },
                    error: function (xhr) {
                        $.toast({
                            text: "فیلد های ستاره دار را پر کنید", // Text that is to be shown in the toast
                            heading: 'دقت کنید', // Optional heading to be shown on the toast
                            icon: 'error', // Type of toast icon
                            showHideTransition: 'fade', // fade, slide or plain
                            allowToastClose: true, // Boolean value true or false
                            hideAfter: 3000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
                            stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
                            position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
                            textAlign: 'left',
                            loader: true,
                            loaderBg: '#c60000',
                        });
                        $.each(xhr.responseJSON.errors, function(key,value) {
                            $('#validation-' + key).append('<div class="alert alert-danger">'+value+'</div');
                        });
                    }
                });
            });
        })
    </script>
@endsection
