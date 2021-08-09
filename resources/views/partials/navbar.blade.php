<div id="header-top">
    <section class="container clearfix">
        <nav class="header-top-nav">
            <ul>
                @auth
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();"
                        >
                            <i class="icon-user"></i>Logout
                        </a>
                    </li>

                @else

                    <li><a href="{{  route ('login') }}" id="login-panel"><i class="icon-user"></i>Login Area</a></li>
                @endauth
            </ul>
        </nav>
        <div class="header-search">
            <form method="GET" action="{{ route('search') }}">
                <input type="text" name="search" value="Search here ..." onfocus="if(this.value=='Search here ...')this.value='';" onblur="if(this.value=='')this.value='Search here ...';">
                <button type="submit" class="search-submit"></button>
            </form>
        </div>
    </section><!-- End container -->
</div><!-- End header-top -->
<header id="header">
    <section class="container clearfix">
        <div class="logo"><a href="index.html"><img alt="" src="images/logo.png"></a></div>
        <nav class="navigation">
            <ul>
                <li class="current_page_item"><a href="index.html">Home</a>

                </li>
                <li class="ask_question"><a href="{{ route('questions.create') }}">Ask Question</a></li>
                @auth
                <li class="ask_question"><a href="{{ route('questions.index') }}">My Questions</a></li>

                <li class="ask_question"><a href="{{ route('profile.index') }}">Edit Profile</a></li>
                @endauth



            </ul>
        </nav>
    </section><!-- End container -->
</header><!-- End header -->
