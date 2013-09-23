<label>Registration</label><p>{{ $user->created_at }}</p>
<label>Last update</label><p>{{ $user->updated_at }}</p>
<label>Last login</label><p>{{ $user->last_login }}</p>
<label>IP address</label><p>{{ $throttle->ip_address }}</p>