<?php

declare(strict_types=1);

namespace App\Http\Livewire\Front;

use App\Models\Category;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class Index extends Component
{
 
    public $selectedCategory;
    public $selectedProduct;
    public $category_id;
    public $product;

    public function selectCategory($categoryId)
    {
        $this->selectedCategory = Category::find($categoryId);
        $this->selectedProduct = null;
    }

    public function selectProduct($productId)
    {
        $this->selectedProduct = Product::find($productId);
    }

    public function getProductsProperty(): Collection
    {
        if (!$this->selectedCategory) {
            return collect();
        }

        return Product::where('category_id', $this->selectedCategory->id)->limit(4)->get();
    }

    public function getSectionsProperty(): Collection
    {
        return Section::where('page', Section::HOME_PAGE)
            ->orderBy('id', 'asc')
            ->active()
            ->get();
    }
 
    public function getCategoriesProperty(): Collection
    {
        return Category::select('id','name')
                        ->active()->get();
    }


    public function render(): View|Factory
    {
        return view('livewire.front.index');
    }
}
