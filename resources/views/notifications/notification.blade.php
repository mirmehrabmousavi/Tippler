<script>
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: 'toast-top-left',
        timeOut: 7000, // 7 seconds
        extendedTimeOut: 1000, // 1 second after hover
        showEasing: 'swing',
        hideEasing: 'linear',
        showMethod: 'fadeIn',
        hideMethod: 'fadeOut'
    };
    @if(session()->has('success'))
    toastr.success('{{session()->get('success')}}')
    @endif
    @if(session()->has('error'))
    toastr.error('{{session()->get('error')}}')
    @endif
    @if(session()->has('info'))
    toastr.info('{{session()->get('info')}}')
    @endif
    @if(session()->has('warning'))
    toastr.warning('{{session()->get('warning')}}')
    @endif
</script>

