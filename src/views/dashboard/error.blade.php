@extends(Config::get('syntara::views.master'))

@section('content')
<script src="{{ asset('packages/mrjuliuss/syntara/assets/js/dashboard/user.js') }}"></script> 

<div class="container" id="main-container">
    <div class="row">
        <div class="col-lg-12 offset3">
            <section class="module">
                <div class="module-head">
                    <b>{{ trans('syntara::all.error') }}</b>
                </div>
                <div class="module-body">
                    <div class="alert alert-danger">
                        <strong>{{ $message }}</strong>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@stop