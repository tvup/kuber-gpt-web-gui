@if (session('msg-success'))
    <div class="alert alert-success">
        {{ session('msg-success') }}
    </div>
@endif

@if (session('msg-danger'))
    <div class="alert alert-danger">
        {{ session('msg-danger') }}
    </div>
@endif