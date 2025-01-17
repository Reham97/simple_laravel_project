 
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="{{url('/')}}">MYBLOGS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">
          @guest
            
          @else 
              <a class="nav-item nav-link active" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
              <a class="nav-item nav-link" href="{{url('/about')}}">About</a>
              <a class="nav-item nav-link" href="{{url('/services')}}">Services</a>
              <a class="nav-item nav-link" href="{{url('/posts')}}">Posts</a>
              <a class=" btn btn-primary" href="{{url('/posts/create')}}">Create a Post</a>
              @endguest
 
          </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
              <a  class="nav-item nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              @if (Route::has('register'))
                <a  class="nav-item nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
              @endif
            @else 
              
              <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
             @endguest
          </div>
        </div>
      </nav>