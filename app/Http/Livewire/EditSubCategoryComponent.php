<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\SubCategory;
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditSubCategoryComponent extends Component
{
    
    use WithFileUploads;
    protected $listeners = ['ResetEditModal' => 'resetForm', 'SubCategoryEditModal' => 'SubCategoryEditModal',];
    public $Model;
    public $image;
    public $category;
    public function mount()
    {

        $this->category = Category::pluck('id', 'name');
        $this->Model['name'] = '';
        $this->Model['description'] = '';
        $this->Model['category_id'] = '';
        $this->image = '';
    }

    protected function rules()
    {
        return [
            'Model.description' => 'required|string|max:255',
            'Model.name' => ['required', 'string', 'max:40', 'unique:sub_categories,name,' . $this->Model['id'] . ',id'],
            'Model.category_id' => ['required', 'numeric',  'exists:categories,id'],
            'image' => 'mimes:jpeg,jpg,png|nullable|max:10000'
        ];
    }

    public function SubCategoryEditModal(SubCategory $subcategory)
    {
        $this->Model['id']=$subcategory->id;
        $this->Model['name'] = $subcategory->name;
        $this->Model['description'] = $subcategory->description;
        $this->Model['category_id'] = $subcategory->category_id;

        // $User['password'] = $user->password;
        $this->emit('ModalOpen', 'SubCategoryEditModal');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetForm()
    {
        $this->reset(['Model','image']);
    }

    public function EditSubmit()
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
          
                
            $user = SubCategory::whereId( $this->Model['id'])->update($emptyRemoved);
            $this->emit('toast', 'success', 'Category Updated successfully', ' Sub Category');

            $this->emit('RefreshSubCategoryTable');
            $this->emit('ModalClose', 'SubCategoryEditModal');
        } catch (Exception $exception) {
            $this->emit('toast', 'info', $exception->getMessage(), 'Sub Category');
        }
    }

    public function render()
    {
        return view('livewire.edit-sub-category-component');
    }
}
