<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditCategoryComponent extends Component
{
    

    use WithFileUploads;
    protected $listeners = ['ResetEditModal' => 'resetForm', 'CategoryEditModal' => 'CategoryEditModal',];
    public $Category;
    public $image;
    public function mount()
    {

        $this->Category['name'] = '';
        $this->Category['description'] = '';
        $this->image = '';
    }

    protected function rules()
    {
        return [
            'Category.description' => 'required|string|max:255',
            'Category.name' => ['required', 'string', 'max:40', 'unique:categories,name,' . $this->Category['id'] . ',id'],
            'image' => 'mimes:jpeg,jpg,png|nullable|max:10000'
        ];
    }

    public function CategoryEditModal(Category $category)
    {
        $this->Category['id']=$category->id;
        $this->Category['name'] = $category->name;
        $this->Category['description'] = $category->description;
        // $User['password'] = $user->password;
        $this->emit('ModalOpen', 'CategoryEditModal');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetForm()
    {
        $this->reset(['Category','image']);
    }

    public function EditSubmit()
    {

        try {
            
            $validatedData = $this->validate();
            if (!empty($validatedData['image'])) {
               
                $file_name = substr(md5(uniqid(rand(1, 6))), 0, 10) . '.' . $this->image->extension(); // or any name you want
                $this->image->storeAs('item/category', $file_name, 'asset');
                $validatedData['Category']['image'] = $file_name;
                // $validatedData['Model'] += ['image' => $file_name];
                // dd($validatedData['Model']);
            }
            $emptyRemoved = array_filter($validatedData['Category']);
          
                
            $user = Category::whereId( $this->Category['id'])->update($emptyRemoved);
            
            // User::find( $this->User['id'])->roles()->detach();   
            //rEmove previous role and then do 
            

            $this->emit('toast', 'success', 'Category Updated successfully', 'Category');

            $this->emit('RefreshCategoryTable');
            $this->emit('ModalClose', 'CategoryEditModal');
        } catch (Exception $exception) {
            $this->emit('toast', 'info', $exception->getMessage(), 'Category');
        }
    }

    public function render()
    {
        return view('livewire.edit-category-component');
    }
}
