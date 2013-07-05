@extends('syntara::layouts.dashboard.master')

@section('content')
<script type="text/javascript" src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/login.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/mrjuliuss/syntara/assets/js/forms/check.js') }}"></script>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span4 offset4">
            <div class="widget-box">
                <div class="widget-title">
                    <h5>Login</h5>
                </div>
                <div class="widget-content nopadding">
                    <form id="login-form" method="post" class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">Login :</label>
                            <div class="controls">
                                <input type="text" id="userLogin" name="userLogin"  placeholder="Login" class="span10">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Password : </label>
                            <div class="controls">
                                <input type="password" id="userPass" name="userPass" placeholder="Password" class="span10">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" name="commit" class="btn btn-success">Login</button>
                        </div>
                    </form>
                </div>
            </div>						
        </div>
    </div>
</div>
@stop