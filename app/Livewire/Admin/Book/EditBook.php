<?php

namespace App\Livewire\Admin\Book;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Services\BookService;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
class EditBook extends Component
{
    use WithFileUploads;

    public Book $book;

    // HAPUS variable $form, ganti dengan properti langsung agar sesuai dengan View
    public $title;

    public $author_id;

    public $category_id;

    public $isbn;

    public $publisher;

    public $publication_year;

    public $stock;

    public $sinopsis;

    public $image;

    public $existingImage;

    // Variabel Search
    public $searchAuthor = '';

    public $searchCategory = '';

    public function mount(Book $book)
    {
        $this->book = $book;
        $this->existingImage = $book->image;

        // Isi variabel langsung (tanpa $this->form)
        $this->title = $book->title;
        $this->author_id = $book->author_id;
        $this->category_id = $book->category_id;
        $this->isbn = $book->isbn;
        $this->publisher = $book->publisher;
        $this->publication_year = $book->publication_year;
        $this->stock = $book->stock;
        $this->sinopsis = $book->sinopsis;

        // Isi kolom search dengan data yang ada
        $this->searchAuthor = $book->author->author ?? '';
        $this->searchCategory = $book->category->category ?? '';
    }

    protected function rules()
    {
        return [
            // Perhatikan: Nama rules TIDAK BOLEH pakai 'form.' depannya
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'isbn' => ['required', 'string', 'max:20', 'unique:books,isbn,'.$this->book->id, 'regex:/^[0-9-]+$/'],
            'publisher' => 'required|string|max:150',
            'publication_year' => 'required|integer|digits:4',
            'stock' => 'required|integer|min:1',
            'sinopsis' => 'nullable|string',
            'image' => 'nullable|image|max:1024',
        ];
    }

    // Translate Error ke Indonesia
    public function messages()
    {
        return [
            'title.required' => 'Judul buku wajib diisi.',
            'author_id.required' => 'Penulis wajib dipilih.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'isbn.required' => 'ISBN wajib diisi.',
            'isbn.unique' => 'ISBN ini sudah digunakan.',
            'isbn.regex' => 'Format ISBN salah (hanya angka dan strip).',
            'publisher.required' => 'Penerbit wajib diisi.',
            'publication_year.required' => 'Tahun terbit wajib diisi.',
            'stock.required' => 'Stok wajib diisi.',
            'stock.min' => 'Stok minimal 1.',
            'image.image' => 'File harus berupa gambar.',
            'image.max' => 'Ukuran gambar maksimal 1MB.',
        ];
    }

    // LOGIKA PENTING: Jika user mengetik/mengubah search, reset ID-nya
    // Ini memaksa user untuk KLIK pilihan di dropdown.
    public function updatedSearchAuthor()
    {
        $this->author_id = null;
    }

    public function updatedSearchCategory()
    {
        $this->category_id = null;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function selectAuthor($id, $name)
    {
        $this->author_id = $id;
        $this->searchAuthor = $name;
        $this->resetValidation('author_id'); // Hapus merah-merah
    }

    public function selectCategory($id, $name)
    {
        $this->category_id = $id;
        $this->searchCategory = $name;
        $this->resetValidation('category_id'); // Hapus merah-merah
    }

    public function save(BookService $bookService)
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'author_id' => $this->author_id,
            'category_id' => $this->category_id,
            'isbn' => $this->isbn,
            'publisher' => $this->publisher,
            'publication_year' => $this->publication_year,
            'stock' => $this->stock,
            'sinopsis' => $this->sinopsis ?? '-',
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('books', 'public');
        } else {
            $data['image'] = $this->existingImage;
        }

        $bookService->updateBook($this->book, $data);

        session()->flash('message', 'Buku berhasil diperbarui.');

        return redirect()->route('admin.books');
    }

    public function render()
    {
        $authors = Author::query()
            ->when($this->searchAuthor, function ($query) {
                $query->where('author', 'like', '%'.$this->searchAuthor.'%');
            })
            ->take(10)->get();

        $categories = Category::query()
            ->when($this->searchCategory, function ($query) {
                $query->where('category', 'like', '%'.$this->searchCategory.'%');
            })
            ->take(10)->get();

        return view('livewire.admin.book.edit-book', [
            'authors' => $authors,
            'categories' => $categories,
        ]);
    }
}
