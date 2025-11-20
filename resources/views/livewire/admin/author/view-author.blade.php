<div class="modal fade" id="viewAuthorModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Penulis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                {{-- KITA HAPUS BAGIAN WIRE:LOADING --}}

                {{-- Langsung cek datanya --}}
                @if ($author)
                <table class="table table-borderless">
                    <tr>
                        <th>Nama Penulis</th>
                        {{-- Pakai operator ?? biar gak error kalau ada kolom kosong --}}
                        <td>: {{ $author->author ?? $author->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Dibuat Tanggal</th>
                        <td>: {{ $author->created_at ? $author->created_at->format('d M Y') : '-' }}</td>
                    </tr>
                </table>
                @else
                {{-- Kalau data belum sampai, biarkan kosong atau kasih strip (-) --}}
                <p class="text-muted text-center">-</p>
                @endif

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>