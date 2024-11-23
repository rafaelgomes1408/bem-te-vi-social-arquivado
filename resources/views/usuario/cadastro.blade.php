<form action="{{ route('registro') }}" method="POST">
    @csrf
    <label for="nomeUsuario">Nome:</label>
    <input type="text" name="nomeUsuario" required>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="senha">Senha:</label>
    <input type="password" name="senha" required>

    <button type="submit">Registrar</button>
</form>
