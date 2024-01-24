<div role="tabpanel" class="tab-pane {{(request()->tab == '')? 'active' : ' fade'}}" id="general"
     aria-labelledby="settings-general" aria-expanded="true">
    <form novalidate="" action="{{route('admin.settings.siteUpdate')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="site-name">نام سایت : </label>
                        <input type="text" class="form-control" name="name" id="site-name" placeholder="نام سایت را وارد گنید" value="{{$name}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="site-title">عنوان سایت : </label>
                        <input type="text" class="form-control" name="title" id="site-title" placeholder="عنوان سایت را وارد کنید" value="{{$title}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="site-favicon">فویکون سایت : </label>
                        <input type="file" class="form-control" name="favicon" id="site-favicon" placeholder="فویکون سایت را وارد کنید" value="{{$favicon}}">
                        <ul class="list-unstyled users-list m-0  d-flex align-items-center">
                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="" class="avatar pull-up">
                                <img class="media-object rounded-circle" src="{{$favicon}}" alt="Avatar" height="60" width="60">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="site-logo">لوگو سایت : </label>
                        <input type="file" class="form-control" name="logo" id="site-logo" placeholder="لوگو سایت را وارد کنید" value="{{$logo}}">
                        <ul class="list-unstyled users-list m-0  d-flex align-items-center">
                            <li data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="" class="avatar pull-up">
                                <img class="media-object rounded-circle" src="{{$logo}}" alt="Avatar" height="60" width="60">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="site-email">ایمیل سایت : </label>
                        <input type="text" class="form-control" name="email" id="site-email" placeholder="ایمیل سایت را وارد کنید" value="{{$email}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="site-number">شماره تماس : </label>
                        <input type="text" class="form-control" name="number" id="site-number" placeholder="شماره تماس را وارد کنید" value="{{$number}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="site-fanavari">کد نماد فناوری اطلاعات : </label>
                        <input type="text" class="form-control" name="fanavari" id="site-fanavari" placeholder="کد نماد فناوری اطلاعات را وارد کنید" value="{{$fanavari}}">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="controls">
                        <label for="site-etemad">کد نماد اعتماد : </label>
                        <input type="text" class="form-control" name="etemad" id="site-etemad" placeholder="کد نماد اعتماد را وارد کنید" value="{{$etemad}}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <div class="controls">
                        <label for="site-address">آدرس سایت : </label>
                        <input type="text" class="form-control" name="address" id="site-address" placeholder="آدرس سایت را وارد کنید" value="{{$address}}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <div class="controls">
                        <label for="site-about">درباره ما : </label>
                        <textarea class="form-control" name="about" id="site-about" placeholder="درباره ما را وارد کنید">{{$about}}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                <button type="submit" id="createSite" class="btn btn-outline-success btn-sm mr-sm-1 mb-1 mb-sm-0 waves-effect waves-light">ذخیره</button>
            </div>
        </div>
    </form>
</div>
