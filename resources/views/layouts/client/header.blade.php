<div class="row mx-0 bg-dark headerborder py-2">
    <div class="col-12 col-lg-3 px-1 text-right">
        <img src="/media/cite/logo/logo.png" class="px-lg-5 px-1">
    </div>
    <div class="col-12 col-lg-5 px-lg-1 mt-auto">
        <search_compo></search_compo>
    </div>
    <div class="col-12 col-lg-4 pl-lg-4 mt-auto">
        @if (Route::has('login'))
            <div class="links">
                @auth
                    @if(auth()->user()->id == 1)
                        <label class="logintxt px-1">
                            {{auth()->user()->name}}
عزیز خوش آمدید.
                        </label>
                        <label class="px-2 logintxt">|</label>
                        <a href="{{ url('/dashboard') }}" class="logintxt px-1">پنل مدیریت</a>
                    @else
                        <label class="logintxt px-1">
                            {{auth()->user()->name}}
                            عزیز خوش آمدید.
                        </label>
                    @endif
                        <label class="px-2 logintxt">|</label>
                    <a class="logintxt px-1" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        خروج
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="logintxt px-1">ورود</a>
<label class="px-2 logintxt">|</label>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="logintxt px-1">ثبت نام</a>
                    @endif
                @endauth

            </div>
        @endif
    </div>

</div>
