<form action="{{ route('login') }}" method="POST">
    @csrf

    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" required autofocus>
    </div>

    <div>
        <label for="password">Senha:</label>
        <input type="password" name="password" required>
    </div>

    <button type="submit">Login</button>
</form>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif