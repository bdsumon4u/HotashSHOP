<?php

namespace App\Http\Livewire;

use App\Product;
use Livewire\Component;

class SectionProduct extends Component
{
    public string $search = '';
    public array $products = [];
    public array $selectedIds = [];
    public array $categoryIds = [];

    public function mount(array $selectedIds = [])
    {
        $this->selectedIds = $selectedIds;
    }

    public function updatedSearch()
    {
        $this->products = Product::whereNull('parent_id')
            ->where('name', 'like', "%{$this->search}%")
            ->take(5)->get()->map(function ($product, $i) {
                return [
                    'order' => $i + 1,
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'image' => optional($product->base_image)->src,
                ];
            })->toArray();
    }

    public function updateTaskOrder($data)
    {
        $this->selectedIds = [];
        foreach ($data as $item) {
            $this->selectedIds[] = $item['value'];
        }
    }

    public function addProduct($id)
    {
        $this->selectedIds[] = $id;

        $this->dispatchBrowserEvent('notify', ['message' => 'Product added successfully.']);
    }

    public function removeProduct($id)
    {
        $this->selectedIds = array_diff($this->selectedIds, [$id]);
    }

    public function render()
    {
        return view('livewire.section-product', [
            'selectedProducts' => Product::whereIn('id', $this->selectedIds)
                ->get()->mapWithKeys(function ($product, $i) {
                    return [$product->id => [
                        'order' => array_search($product->id, $this->selectedIds) + 1,
                        'id' => $product->id,
                        'name' => $product->name,
                        'slug' => $product->slug,
                        'image' => optional($product->base_image)->src,
                    ]];
                })->sortBy('order')->toArray(),
        ]);
    }
}
