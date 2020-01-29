    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Task Failed!</strong> {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endforeach
    @endif

    @if(Session::has('success'))
        toastr.success(" {{ Session::get('success') }}", "Success Here!");
    @endif
    @if(Session::has('info'))
        toastr.info(" {{ Session::get('info') }}", "Information Here!");
    @endif
    @if(Session::has('error'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Task Failed!</strong> {{ Session::get('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
