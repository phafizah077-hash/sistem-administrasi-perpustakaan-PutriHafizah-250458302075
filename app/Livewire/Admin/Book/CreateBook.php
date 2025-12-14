<?php

namespace App\Livewire\Admin\Book;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class CreateBook extends Component
{
    use WithFileUploads;

    public $title;
    public $author_id;
    public $category_id;
    public $isbn;
    public $publisher;
    public $publication_year;
    public $stock;
    public $sinopsis;
    public $image;
    public $searchAuthor = '';
    public $searchCategory = '';

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            // UBAH: Gunakan regex agar hanya menerima angka dan strip (-)
            'isbn' => ['required', 'unique:books,isbn', 'regex:/^[0-9-]+$/'],
            'publisher' => 'required|string',
            'publication_year' => 'required|numeric',
            'stock' => 'required|numeric|min:1',
            'sinopsis' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Judul buku wajib diisi.',
            'author_id.required' => 'Penulis wajib dipilih.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'isbn.required' => 'ISBN wajib diisi.',
            'isbn.unique' => 'Nomor ISBN ini sudah terdaftar.',
            // Pesan error khusus jika user memaksa input huruf
            'isbn.regex' => 'Format ISBN salah. Hanya boleh angka dan tanda hubung (-).',
            'publisher.required' => 'Penerbit wajib diisi.',
            'publication_year.required' => 'Tahun terbit wajib diisi.',
            'publication_year.numeric' => 'Tahun harus berupa angka.',
            'stock.required' => 'Stok buku wajib diisi.',
            'stock.numeric' => 'Stok harus berupa angka.',
            'stock.min' => 'Stok minimal 1.',
            'image.image' => 'File harus berupa gambar.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function selectAuthor($id, $name)
    {
        $this->author_id = $id;
        $this->searchAuthor = $name;
        $this->resetValidation('author_id');
    }

    public function selectCategory($id, $name)
    {
        $this->category_id = $id;
        $this->searchCategory = $name;
        $this->resetValidation('category_id');
    }

    public function save()
    {
        $this->validate();

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('books', 'public');
        }

        Book::create([
            'title' => $this->title,
            'author_id' => $this->author_id,
            'category_id' => $this->category_id,
            'isbn' => $this->isbn,
            'publisher' => $this->publisher,
            'publication_year' => $this->publication_year,
            'stock' => $this->stock,
            'sinopsis' => $this->sinopsis ?? '-',
            'image' => $imagePath,
        ]);

        session()->flash('message', 'Buku berhasil ditambahkan.');
        return $this->redirect(route('admin.books'), navigate: true);
    }

    public function render()
    {
        $authors = Author::query()
            ->when($this->searchAuthor, function ($query) {
                $query->where('author', 'like', '%' . $this->searchAuthor . '%');
            })
            ->take(10)->get();

        $categories = Category::query()
            ->when($this->searchCategory, function ($query) {
                $query->where('category', 'like', '%' . $this->searchCategory . '%');
            })
            ->take(10)->get();

        return view('livewire.admin.book.create-book', [
            'authors' => $authors,
            'categories' => $categories
        ]);
    }
}
