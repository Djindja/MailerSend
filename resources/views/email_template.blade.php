<p>Hello, <br/>I am <b>{{ $data['emailFrom'] }}</b></p>

<p>My subject is this:</p>
<p>{{ $data['subject'] }}</p>

<br/>
<p>My Text Content is this:</p>
<p>{{ $data['textContent'] }}</p>

<br/>
<p>My HTML message is this:</p>
<p>{!! $data['htmlMessage'] !!}</p>
