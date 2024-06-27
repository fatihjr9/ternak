@props(['route', 'confirmMessage'])

<form action="{{ $route }}" method="POST" onsubmit="return confirm('{{ $confirmMessage }}');">
    @csrf
    @method('DELETE')
    <button type="submit" class="bg-red-50 text-red-500 p-2 rounded-lg text-sm font-semibold">Hapus</button>
</form>