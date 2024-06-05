<?php

namespace App\Http\Livewire;

use App\Jobs\UpdateStatusJob;
use App\Models\Expense;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class PendingExpenseTable extends PowerGridComponent
{
    use ActionButton;

    public $status;

    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [

                'RefreshPendingExpense' => '$refresh',
                'UpdateStatus' => 'update'

            ]
        );
    }

    public function updatedStatus($value, $id)
    {
        if(is_null($value) || $value=='')
       return ;
  
       $detail = [
        'id' => $id,
        'type' => 'expense',
    ];

    dispatch(new UpdateStatusJob($detail));

        $this->emit('RefreshPendingExpense');
    }
    

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\Expense>
     */
    public function datasource(): Builder
    {
        //eager loading thorough model with
        if (auth()->user()->user_type == "user") {
            return Expense::query()->where('added_by', auth()->user()->id)->where('status', '=', 'hold');
        }else{

        return Expense::query()->where('status', '=', 'hold');
        }
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('image', function (Expense $model) {
                $asset = "{{asset('')}}";
                $html = '<img src="' . asset('images/item/item') . '/' . $model->Unit->image . '" style="height:150px;width:150px;border-radius:50%";/>';
                return $html;
            })
            ->addColumn('Category', fn (Expense $model) =>   $model->Category->name)
            ->addColumn('Sub_Category', fn (Expense $model) =>   $model->SubCategory->name)
            ->addColumn('Unit', function (Expense $model) {
                return $model->Unit->name;
            })
            ->addColumn('total_amount', function (Expense $model) {
                return '<strong style="color:blue;">' . $model->total_amount . '</strong>';
            })
            ->addColumn('share_amount', function (Expense $model) {
                return '<strong style="color:blue;">' . $model->share_amount . '</strong>';
            })
            ->addColumn('share_by')
            ->addColumn('net_income', function (Expense $model) {
                return '<strong style="color:blue;">' . $model->net_income . '</strong>';
            })
            ->addColumn('last_balance', function (Expense $model) {
                return '<strong style="color:blue;">' . $model->last_balance . '</strong>';
            })

            ->addColumn('balance', function (Expense $model) {
                return '<strong style="color:blue;">' . $model->balance . '</strong>';
            })


            ->addColumn('added_by', function (Expense $model) {
                return $model->AddedBy->name;
            })
            ->addColumn('status', function (Expense  $model) {

                // //all pending orders by the logged in user
                // $order=1;
                // $my_order=1;
                // if($model->last_performer=="Super_Admin"){
                //     $order=4;
                // }
                // if($model->last_performer=="Admin"){
                //     $order=3;
                // }
                // if($model->last_performer=="Accountant"){
                //     $order=2;
                // }
                // if($model->last_performer=="User"){
                //     $order=1;
                // }

                // if(auth()->user()->user_type=="Super_Admin"){
                //     $my_order=4;
                // }
                // if(auth()->user()->user_type=="Admin"){
                //     $my_order=3;
                // }
                // if(auth()->user()->user_type=="Accountant"){
                //     $my_order=2;
                // }
                // if(auth()->user()->user_type=="User"){
                //     $my_order=1;
                // }

                // if ($model->status == "hold")
                //     $span = '<span class="mt-2 w-100 badge bg-success">' . ucwords($model->status) . '</span>';
                // elseif ($model->status == "pending")
                //     $span = '<span class="mt-2 w-100 badge bg-warning">' . ucwords($model->status) . '</span>';
                // else
                    $span = '<span class="mt-2 w-100 badge bg-danger">' . ucwords($model->status) . '</span>';

                
                return
                    '<select wire:model.lazy="status.' . $model->id . '" class="form-select">' .
                    '<option value="">Choose option</option>' .
                    '<option>Signed</option>' .
                    '</select>' . $span;
            })
            ->addColumn('created_at_formatted', fn (Expense $model) => Carbon::parse($model->created_at)->format('d/m/Y h:i A'))
            ->addColumn('updated_at_formatted', fn (Expense $model) => Carbon::parse($model->updated_at)->diffForHumans());
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->makeInputRange()
                ->sortable()
                ->searchable(),
            Column::make('IMAGE', 'image'),

            Column::make('Category', 'Category'),
            Column::make('Sub Category', 'Sub_Category'),
            Column::make('Unit', 'Unit'),
            Column::make('Total Amount', 'total_amount')->makeInputRange()
                ->sortable()
                ->searchable(),
            Column::make('Share Amount', 'share_amount')->makeInputRange()
                ->sortable()
                ->searchable(),
            Column::make('Shared By', 'share_by')->sortable()
                ->searchable()->makeInputText(),


            Column::make('Net Income', 'net_income')->makeInputRange()
                ->sortable()
                ->searchable(),
            Column::make('Last Balance', 'last_balance')->makeInputRange()
                ->sortable()
                ->searchable(),



            Column::make('Balance', 'balance')
                ->makeInputRange()
                ->sortable()
                ->searchable(),

            Column::make('Added By', 'added_by'),









            Column::make('STATUS', 'status')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('CREATED AT', 'created_at_formatted', 'created_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('UPDATED AT', 'updated_at_formatted', 'updated_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Expense Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('expense.edit', ['expense' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('expense.destroy', ['expense' => 'id'])
               ->method('delete')
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Expense Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($expense) => $expense->id === 1)
                ->hide(),
        ];
    }
    */
}
