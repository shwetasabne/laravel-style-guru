@extends ('master.template')

@section('content')

    <section id="login" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-left">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="section-heading text-muted">Login</h2>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                    <label for="username" class="col-md-4 control-label label-heading text-muted">Username</label>
                                    <div class="col-md-6">
                                        <input id="username" type="username" class="form-control" name="username" value="{{ old('username') }}">

                                        @if ($errors->has('username'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label label-heading text-muted">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password">

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember"> Remember Me
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Login
                                        </button>

                                        <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                                    </div>
                                </div>

                                
                            </form>
                        </div>
                        <div class="panel-footer">
                           New to Style Guru ?<a class="btn btn-link" href="{{ url('/register') }}">Register Here</a>
                        </div>
                    </div>                
                </div>
            </div>
        </div>
    </section>
@stop