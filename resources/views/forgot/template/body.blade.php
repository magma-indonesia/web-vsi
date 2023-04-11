<form action="{{ route('login.post') }}" method="post">
    @csrf
    <input name="username" type="text">
    <input name="password" type="password">
    <button type="submit">Submit</button>
</form>
