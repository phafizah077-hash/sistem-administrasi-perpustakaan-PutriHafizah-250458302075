<div class="modal fade" id="modalDetailBook" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered"> {{-- Pakai modal-lg biar lebar & centered --}}
        <div class="modal-content">

            {{-- HEADER --}}
            <div class="modal-header bg-light">
                <h5 class="modal-title">
                    <i class="fas fa-book me-2"></i> Detail Buku
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- BODY --}}
            <div class="modal-body">

                @if ($book)
                <div class="row">
                    {{-- KOLOM KIRI: GAMBAR BUKU --}}
                    <div class="col-md-4 text-center mb-3 mb-md-0">
                        @if ($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}"
                            class="img-fluid rounded shadow-sm border"
                            alt="Cover Buku"
                            style="max-height: 300px; object-fit: cover;">
                        @else
                        {{-- Placeholder kalau gak ada gambar --}}
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center rounded shadow-sm"
                            style="height: 250px; width: 100%;">
                            <span>No Image</span>
                        </div>
                        @endif
                    </div>

                    {{-- KOLOM KANAN: TABEL DETAIL --}}
                    <div class="col-md-8">
                        <h4 class="fw-bold text-primary mb-3">{{ $book->title }}</h4>

                        <table class="table table-borderless table-sm">
                            <tbody>
                                <tr>
                                    <th width="30%" class="text-muted">ISBN</th>
                                    <td class="fw-bold">: {{ $book->isbn ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Penulis</th>
                                    <td>: {{ $book->author->author ?? 'Tidak Diketahui' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Kategori</th>
                                    <td>: <span class="badge bg-info text-dark">{{ $book->category->category ?? 'Umum' }}</span></td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Penerbit</th>
                                    <td>: {{ $book->publisher ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Tahun Terbit</th>
                                    <td>: {{ $book->publication_year ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Stok</th>
                                    <td>
                                        :
                                        @if($book->stock > 0)
                                        <span class="badge bg-success">{{ $book->stock }} Tersedia</span>
                                        @else
                                        <span class="badge bg-danger">Habis</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                {{-- Tampilan saat data belum ter-load --}}
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="text-muted mt-2">Mengambil data buku...</p>
                </div>
                @endif

            </div>

            {{-- FOOTER --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>