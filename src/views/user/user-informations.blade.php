<label>{{ trans('syntara::users.registration') }}</label><p>{{ $user->created_at }}</p>
<label>{{ trans('syntara::users.last-update') }}</label><p>{{ $user->updated_at }}</p>
<label>{{ trans('syntara::users.last-login') }}</label><p>{{ $user->last_login }}</p>
<label>{{ trans('syntara::users.ip') }}</label><p>{{ $throttle->ip_address }}</p>
<label>{{ trans('syntara::users.banned-at') }}</label><p>{{ isset($throttle->banned_at) ? $throttle->banned_at : 'none' }}</p>