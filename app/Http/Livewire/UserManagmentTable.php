<?php

namespace App\Http\Livewire;

use App\Models\User;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class UserManagmentTable extends PowerGridComponent
{
    use ActionButton;

    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [

                'RefreshUserManagmentTable' => '$refresh',
                'DeleteUser' => 'DeleteUser',
                
            ]
        );
    }

    public function DeleteUser(User $user)
    {
        try {
            DB::transaction(function () use ($user) {
                $user->delete();
                $this->emit('toast', 'success', 'User Deleted Successfully', 'User Managment ');
                $this->emit('RefreshUserManagmentTable');
            });
        } catch (Exception $exception) {
            $this->emit('toast', 'error', $exception->getMessage(), 'Permission ');
        }
    }

    // public function UserEditModal(User $user)
    // {
    //     try {
    //         DB::transaction(function () use ($user) {
    //             $user->delete();
    //             $this->emit('toast', 'success', 'User Deleted Successfully', 'User Managment ');
    //             $this->emit('RefreshUserManagmentTable');
    //         });
    //     } catch (Exception $exception) {
    //         $this->emit('toast', 'error', $exception->getMessage(), 'Permission ');
    //     }
    // }

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
     * @return Builder<\App\Models\User>
     */
    public function datasource(): Builder
    {
        return User::query();
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
            ->addColumn('image', function (User $model) {
                $asset = "{{asset('')}}";
                $html = '<img src="' . asset('images/users/') . '/' . $model->image . '" style="height:150px;width:150px;border-radius:50%";/>';
                return $html;
            })
            ->addColumn('name')
            ->addColumn('email')
            ->addColumn('user_type')
            ->addColumn('created_at_formatted', fn (User $model) => Carbon::parse($model->created_at)->format('d/m/Y '))
            ->addColumn('updated_at_formatted', fn (User $model) => Carbon::parse($model->updated_at)->diffForHumans())
            ->addColumn('Delete', function (User $model) {
                $html = "";
                $singleQuote = "'";
                $quote = '"';
                $html .= "<button type='button' class='btn btn-icon btn-icon rounded-circle btn-flat-danger'  wire:click=" . $quote . '$emit(' . $singleQuote . 'DeleteUser' . $singleQuote . ',' . $model->id  . ')' . $quote . "><i data-feather='trash'></i></button></li></div>";
                return $html;
            })
            ->addColumn('Edit', function (User $model) {
                $html = "";
                $singleQuote = "'";
                $quote = '"';
                $html .= "<button type='button' class='btn btn-icon btn-icon rounded-circle btn-flat-info'  wire:click=" . $quote . '$emit(' . $singleQuote . 'UserEditModal' . $singleQuote . ',' . $model->id  . ')' . $quote . "><i data-feather='edit-2'></i></button></li></div>";
                return $html;
            });
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
                ->makeInputRange(),

            Column::make('IMAGE', 'image'),

            Column::make('NAME', 'name')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('EMAIL', 'email')
                ->sortable()
                ->searchable()
                ->makeInputText(),



            Column::make('USER TYPE', 'user_type')
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
            Column::make('Delete', 'Delete'),
            Column::make('Edit', 'Edit'),

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
     * PowerGrid User Action Buttons.
     *
     * @return array<int, Button>
     */


    // public function actions(): array
    // {
    //    return [
    //        Button::make('edit', 'Edit')
    //            ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
    //            ->route('user.edit', ['user' => 'id']),

    //        Button::make('destroy', 'Delete')
    //            ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
    //            ->route('user.destroy', ['user' => 'id'])
    //            ->method('delete')
    //     ];
    // }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid User Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($user) => $user->id === 1)
                ->hide(),
        ];
    }
    */
}
