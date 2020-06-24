<body>
    Congratulations {{ $userChild }}! You have been added to the list of {{ $type }} of {{ $userParent }} {{ $typeChild }}
    @if (!$userChild->user)
        <br>
        Go to the <a href="{{ env('APP_URL',url('/')) }}">site</a>, register and fill out your resume.
    @endif
</body>