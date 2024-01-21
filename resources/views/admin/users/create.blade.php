@extends('admin.layouts.app')

@section('content')
    <h4>افزودن کاربر</h4>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="form-body">
                            <form action="{{route('admin.users.store')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name">نام و نام خانوادگی* :</label>
                                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="نام و نام خانوادگی را وارد کنید" name="name">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="username">نام کاربری* :</label>
                                            <input type="text" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="نام کاربری را وارد کنید" name="username">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="phone">شماره تماس* :</label>
                                            <input type="number" id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="شماره تماس را وارد کنید" name="phone">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="email">ایمیل* :</label>
                                            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="ایمیل را وارد کنید" name="email">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="password">گذرواژه* :</label>
                                            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="گذرواژه را وارد کنید" name="password">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="confirm-password">تایید گذرواژه* :</label>
                                            <input type="password" id="confirm-password" class="form-control" placeholder="تایید گذرواژه" name="confirm-password">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="roles">مقام* :</label>
                                            <select class="form-control" name="roles[]" id="roles" multiple>
                                                @foreach($roles as $role)
                                                    <option value="{{$role}}">{{$role}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        @include('admin.galleries.file-manager', ['btn' => 'btn-sm'])
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-outline-success btn-sm mr-1 mb-1 waves-effect waves-light">ذخیره</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#roles').select2({
            placeholder: 'مقام را انتخاب کنید ...',
            "language": {
                "noResults": function () {
                    return "موردی پیدا نشد";
                }
            },
        });
    </script>
@endsection
