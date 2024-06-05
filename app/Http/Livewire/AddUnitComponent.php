<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Unit;
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddUnitComponent extends Component
{
    use WithFileUploads;

    public $Model;
    public $image;
    public $category;
    public $subcategory;
    public $Categoryval;

    public function updatedCategoryval($value)
    {
        if(!empty($value)){
            $this->subcategory = SubCategory::where('category_id',$value)->pluck('id', 'name');
        }
        //
    }

    protected $listeners = ['ResetSubCategoryForm' => 'resetForm',];
    public function mount()
    {
        $this->Model['added_by'] = auth()->user()->id;
        $this->category = Category::pluck('id', 'name');
        $this->subcategory = SubCategory::pluck('id', 'name');
        

        // dd($this->Model['category_id']);

    }
    protected function rules()
    {
        return [
            'Model.name' => 'required|string|max:40|unique:sub_categories,name',
            'Model.description' => 'required|string|max:225',
            'Model.SubCategory_id'=>'required|numeric|exists:sub_categories,id',
            'Model.price'=>'required|numeric|min:0|digits_between:1,8',
            'Model.quantity'=>'required|numeric|min:0|digits_between:1,8',
            'image' => 'mimes:jpeg,jpg,png|nullable|max:10000'
        ];
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetForm()
    {
        $this->reset(['Model', 'image']);
    }

    public function submit()
    {
            
        $this->validate();
        try {
            $validatedData = $this->validate();
            if (!empty($validatedData['image'])) {

                $file_name = substr(md5(uniqid(rand(1, 6))), 0, 10) . '.' . $this->image->extension(); // or any name you want
                $this->image->storeAs('item/item', $file_name, 'asset');
                $validatedData['Model']['image'] = $file_name;
            }
            $emptyRemoved = array_filter($validatedData['Model']);

            $user = Unit::create($emptyRemoved);
            $this->emit('toast', 'success', 'Item has been addded successfully', 'Item');
            $this->emit('ResetSubCategoryForm');
            // $this->emit('RefreshUserManagmentTable');
        } catch (Exception $exception) {
            $this->emit('toast', 'info', $exception->getMessage(), 'Item');
        }
    }

    public function render()
    {
        return view('livewire.add-unit-component');
    }
}
