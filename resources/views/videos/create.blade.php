<form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="title" placeholder="Título" required>
    <input type="file" name="video" required>
    <button type="submit">Subir</button>
</form>