<?php

namespace App\Http\Livewire;

use App\Models\SubCategory;
use Livewire\Component;

class CascadingDropdown extends Component
{
    public $categories,$category_id,$sub_category_id, $product, $sub_categories = [];
    

    public function mount($categories, $product)
    {
        $this->categories = $categories;
        $this->product = $product;
        
    }

    public function render()
    {
        if(!empty($this->category_id)) {
            $this->sub_categories = SubCategory::where('category_id', $this->category_id)->get();
        }else{
            // dd(false);
            $this->reset(['sub_categories']);
        }

        return view('livewire.cascading-dropdown', [
            'categories' => $this->categories,
            'sub_categories' => $this->sub_categories,
        ]);
    }
}
