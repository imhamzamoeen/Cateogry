<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddCategoryComponent extends Component
{
    use WithFileUploads;

    public $Model;
    public $image;

    protected $listeners = ['ResetCategoryForm' => 'resetForm',];
    public function mount()
    {
        // $this->Model['added_by'] = auth()->user()->id;

    }
    protected function rules()
    {
        return [
            'Model.name' => 'required|string|max:40|unique:categories,name',
            'Model.description' => 'required|string|max:225',
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
                $this->image->storeAs('item/category', $file_name, 'asset');
                $validatedData['Model']['image'] = $file_name;
            }
            $emptyRemoved = array_filter($validatedData['Model']);

            $user = Category::create($emptyRemoved);
            $this->emit('toast', 'success', 'Category has been addded successfully', 'Category');
            $this->emit('ResetCategoryForm');
            $this->emit('RefreshCategoryTable');
        } catch (Exception $exception) {
            $this->emit('toast', 'info', $exception->getMessage(), 'Category');
        }
    }

    public function render()
    {
        return view('livewire.add-category-component');
    }
}
