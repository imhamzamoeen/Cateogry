<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\SubCategory;
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddSubCategoryComponent extends Component
{
    use WithFileUploads;

    public $Model;
    public $image;
    public $category;

    protected $listeners = ['ResetSubCategoryForm' => 'resetForm',];
    public function mount()
    {
        $this->Model['added_by'] = auth()->user()->id;
        $this->category = Category::pluck('id', 'name');
        // dd($this->Model['category_id']);

    }
    protected function rules()
    {
        return [
            'Model.name' => 'required|string|max:40|unique:categories,name',
            'Model.description' => 'required|string|max:225',
            'Model.category_id'=>'required|numeric|exists:categories,id',
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
                $this->image->storeAs('item/subcategory', $file_name, 'asset');
                $validatedData['Model']['image'] = $file_name;
            }
            $emptyRemoved = array_filter($validatedData['Model']);

            $user = SubCategory::create($emptyRemoved);
            $this->emit('toast', 'success', 'Sub Category has been addded successfully', 'Sub Category');
            $this->emit('ResetSubCategoryForm');
            // $this->emit('RefreshUserManagmentTable');
        } catch (Exception $exception) {
            $this->emit('toast', 'info', $exception->getMessage(), 'Sub Category');
        }
    }

    public function render()
    {
        return view('livewire.add-sub-category-component');
    }
}
