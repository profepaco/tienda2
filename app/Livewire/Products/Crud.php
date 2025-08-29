<?php

namespace App\Livewire\Products;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class Crud extends Component
{
    use WithPagination;

    public $search = '';
    public $name, $description, $price, $productId;
    public $isOpen = false; // para modal

    protected $rules = [
        'name' => 'required|string|min:3',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
   
        $products = Product::query()
            ->where('name', 'like', "%{$this->search}%")
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.products.crud', [
            'products' => $products
        ]);
    }

    public function create()
    {
        $this->resetInput();
        $this->isOpen = true;
    }

    public function edit(Product $product)
    {
        $this->productId = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->isOpen = true;
    }

    public function save()
    {
        $this->validate();

        Product::updateOrCreate(
            ['id' => $this->productId],
            [
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
            ]
        );

        session()->flash('message', 
            $this->productId ? 'Producto actualizado correctamente.' : 'Producto creado correctamente.'
        );

        $this->closeModal();
        $this->resetInput();
    }

    public function delete(Product $product)
    {
        $product->delete();
        session()->flash('message', 'Producto eliminado correctamente.');
    }

    private function resetInput()
    {
        $this->productId = null;
        $this->name = '';
        $this->description = '';
        $this->price = '';
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }
}