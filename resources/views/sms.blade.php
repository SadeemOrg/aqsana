<form action="{{ route('send.text') }}" method="POST">
    @csrf
    <button type="submit">Send Text</button>
</form>
