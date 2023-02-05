@if(session('message'))
    <div class="alert {{ session('class') }} alert-dismissible fade show" role="alert">
        <div class="alert-body">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
            {{ session('message') }}
        </div>
    </div>
@endif
