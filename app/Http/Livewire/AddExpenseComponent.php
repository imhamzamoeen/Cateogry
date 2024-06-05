<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Expense;
use App\Models\SubCategory;
use App\Models\Unit;
use Exception;
use Livewire\Component;

class AddExpenseComponent extends Component
{
    

    public $Model;
    public $category;
    public $subcategory;
    public $unit;
    public $Categoryval;
    public $SubCategoryval;


    public function updatedCategoryval($value)
    {
        if (!empty($value)) {
            $this->subcategory = SubCategory::where('category_id', $value)->pluck('id', 'name');
        }
        //
    }
    public function updatedSubCategoryval($value)
    {
        if (!empty($value)) {
            $this->unit = Unit::where('SubCategory_id', $value)->pluck('id', 'name');
        }
        //
    }

    protected $listeners = ['ResetExpenseForm' => 'resetForm',];
    public function mount()
    {
        $this->Model['added_by'] = auth()->user()->id;
        $this->category = Category::pluck('id', 'name');
        $this->subcategory =[];
        $this->unit =[];


        // dd($this->Model['category_id']);

    }
    protected function rules()
    {
        return [

            'Model.description' => 'nullable|string|max:225',
            'Model.total_amount' => 'required|numeric|min:0|digits_between:1,8',
            'Model.share_amount' => 'nullable|numeric|min:0|digits_between:1,8',
            'SubCategoryval' => 'required|numeric|exists:sub_categories,id',
            'Model.status' => 'required|string|in:hold,signed,approved,disapproved',
            'Categoryval' => 'required|numeric|exists:categories,id',
            'Model.unit_id' => 'required|numeric|exists:units,id',
            'Model.share_by' => 'nullable|string|max:40',
        ];
    }

    protected $messages = [
        'Model.total_amount.required' => 'Please Enter Total Amount.',
        'SubCategoryval.required' => 'Sub category cannot be empty',
        'Categoryval.required' => 'Please Choose a Category.',
        'Model.unit_id.required' => 'Please select an item.',
        'Model.status.required' => 'Please select a Status.',


    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetForm()
    {
        $this->reset(['Model', 'Categoryval','SubCategoryval']);
    }

    public function submit()
    {

        $this->validate();
        try {
            $validatedData = $this->validate();
            if (!empty($validatedData['Categoryval'])) {
                $validatedData['Model']['Category_id'] = $validatedData['Categoryval'];
            }
            if (!empty($validatedData['SubCategoryval'])) {
                $validatedData['Model']['SubCategory_id'] = $validatedData['SubCategoryval'];
            }
           

            $emptyRemoved = array_filter($validatedData['Model']);
            $user = Expense::create($emptyRemoved);
            $this->emit('toast', 'success', 'Expennse has been addded successfully', 'Expense');
            $this->emit('ResetExpenseForm');
            $this->emit('RefreshExpenseTable');
        } catch (Exception $exception) {
            $this->emit('toast', 'info', $exception->getMessage(), 'Expense');
        }
    }


    public function render()
    {
        return view('livewire.add-expense-component');
    }
}
