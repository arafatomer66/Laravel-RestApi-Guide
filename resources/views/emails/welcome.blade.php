<h1>Hello {{$user->name}}</h1>
Thank you for creating an account . pLease verify your email clicking the link :

{{route('verify', $user->verification_token)}}
