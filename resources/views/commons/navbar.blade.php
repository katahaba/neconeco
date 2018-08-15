<header>
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">All Photos</a>
                <form action="/microposts/search" method="GET">
                  　<div id="search_field" class="input-group">
                        <input  type="text" class="form-control" name="search_words"  placeholder="検索ワード入力。 　OR検索の場合は「 , 」で繋げてください。">
                        <span class="input-group-btn">
                        	<button type="submit" class="btn btn-default">写真検索</button>
                        </span>
                    </div>
                </form>
            </div>
            
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right"> 
                @if (Auth::check()) 
                    <li>{!! link_to_route('users.index','Other Users') !!}</li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>{!! link_to_route('users.show', 'My_profile', ['id'=>Auth::id()]) !!}</li>
                            <li role="separator" class="divider"></li>
                            <li>{!! link_to_route('logout.get', 'Logout') !!}</li>
                        </ul>
                    </li>
                @else
                    <li>{!! link_to_route('signup.get', 'Signup') !!}</li>
                    <li>{!! link_to_route('login', 'Login') !!}</li>
                @endif
                </ul>
            </div>
        </div>
    </nav>
</header>