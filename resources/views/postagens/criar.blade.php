<form action="{{ route('postagem.criar') }}" method="POST">
    @csrf
    <label for="conteudo">Escreva sua postagem:</label>
    <textarea name="conteudo" required maxlength="250"></textarea>

    <button type="submit">Postar</button>
</form>
