<h1>Hello {{$user->name}}</h1>
You have changed your email address , so verify your email . Click on the link below :

{{route('verify', $user->verification_token)}}

