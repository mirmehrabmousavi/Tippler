@if(session()->has('primary'))
    <div class="alert alert-primary"><i class="fa fa-info-circle"></i> {{session()->get('primary')}}</div>
@endif

@if(session()->has('success'))
    <div class="alert alert-success"><i class="fa fa-info-circle"></i> {{session()->get('success')}}</div>
@endif

@if(session()->has('info'))
    <div class="alert alert-info"><i class="fa fa-info-circle"></i> {{session()->get('info')}}</div>
@endif

@if(session()->has('warning'))
    <div class="alert alert-warning"><i class="fa fa-info-circle"></i> {{session()->get('warning')}}</div>
@endif

@if(session()->has('failed'))
    <div class="alert alert-danger"><i class="fa fa-info-circle"></i> {{session()->get('failed')}}</div>
@endif
