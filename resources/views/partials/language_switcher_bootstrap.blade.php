<div class="position-relative">
    <button class="btn btn-link d-flex align-items-center py-2 font-weight-bold text-left rounded-lg" data-toggle="dropdown">
        <span class="d-flex align-items-center">
            <img src="{{asset('media/images/flags/'.$current_locale.'.png')}}" width="25px">
            <i class="fas fa-chevron-down ml-1"></i>
        </span>
    </button>
    <div class="dropdown-menu mt-2 shadow-lg">
        @foreach($available_locales as $locale_name => $available_locale)
            <a class="dropdown-item d-flex align-items-center" href="/language/{{$available_locale}}">
                <img src="{{asset('media/images/flags/'.$available_locale.'.png')}}" width="25px">
                &nbsp;&nbsp;{{ $locale_name }}
            </a>
        @endforeach
    </div>
</div>
