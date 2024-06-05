<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Unit;
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditUnitComponent extends Component
{
    use WithFileUploads;
    protected $listeners = ['ResetEditModal' => 'resetForm', 'UnitEditModal' => 'UnitEditModal',];
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
    public function mount()
    {

        $this->category = Category::pluck('id', 'name');
        $this->subcategory = SubCategory::pluck('id', 'name');
        $this->Model['name'] = '';
        $this->Model['description'] = '';
        $this->Model['SubCategory_id'] = '';
        $this->Model['price'] = '';
        $this->Model['quantity'] = '';
        $this->image = '';
    }

    protected function rules()
    {
        return [
            'Model.name' => 'required|string|max:40|unique:sub_categories,name',
            'Model.description' => 'required|string|max:225',
            'Model.SubCategory_id'=>'required|numeric|exists:sub_categories,id',
            'Model.price'=>'required|numeric|min:0|digits_between:1,8',
            'Model.quantity'=>'required|numeric|min:0|digits_between:1,8',
            'image' => 'mimes:jpeg,jpg,png|nullable|max:10000',
        ];
    }

    public function UnitEditModal(Unit $unit)
    {
        $this->Model['id'] = $unit->id;
        $this->Model['name'] = $unit->name;
        $this->Model['description'] = $unit->description;
        $this->Model['SubCategory_id'] = $unit->SubCategory_id;
        $this->Model['price'] = $unit->price;
        $this->Model['quantity'] = $unit->quantity;
        $this->emit('ModalOpen', 'UnitEditModal');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetForm()
    {
        $this->reset(['Model', 'image']);
    }

    public function EditSubmit()
    {
        $this->validate();
        try {

            $validatedData = $this->validate();
            if (!empty($validatedData['image'])) {

                $file_name = substr(md5(uniqid(rand(1, 6))), 0, 10) . '.' . $this->image->extension(); // or any name you want
                $this->image->storeAs('item/item/', $file_name, 'asset');
                $validatedData['Model']['image'] = $file_name;
            }
            $emptyRemoved = array_filter($validatedData['Model']);


            $user = Unit::whereId($this->Model['id'])->update($emptyRemoved);
            $this->emit('toast', 'success', 'Unit Updated successfully', ' Unit');

            $this->emit('RefreshUnitTable');
            $this->emit('ModalClose', 'UnitEditModal');
        } catch (Exception $exception) {
            $this->emit('toast', 'info', $exception->getMessage(), 'Unit');
        }
    }

    public function render()
    {
        return view('livewire.edit-unit-component');
    }
}
