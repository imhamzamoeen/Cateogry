<?php

namespace App\Http\Livewire;

use Exception;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class RolePermissionTable extends PowerGridComponent
{
    use ActionButton;



    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(),
            [
                'DeleteRolePermission'   => 'DeleteRolePermission',
                'RefreshRolePermissionTable' => '$refresh'
            ]
        );
    }
    public function DeleteRolePermission(Role $role, $PermissionName)
    {
        try {
            DB::transaction(function () use ($role, $PermissionName) {
                $role->revokePermissionTo($PermissionName);
                $this->emit('toast', 'success', 'Permission Revoked Successfully', 'Role ');
                $this->emit('RefreshRolePermissionTable');
                $this->emit('RefreshCards');
            });
        } catch (Exception $exception) {
            $this->emit('toast', 'error', $exception->getMessage(), 'Role ');
        }
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
     * @return Builder<\Spatie\Permission\Models\Role>
     */
    public function datasource(): Builder
    {
        return Role::query()->with(['permissions']);
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
            ->addColumn('name')
            ->addColumn('permissions', function (Role $model) {
                $html = "";
                $singleQuote = "'";
                $quote = '"';
                foreach ($model->permissions as $permission) {
                    $html .= "<div>";
                    $html .= "<li>" . $permission->name . "";
                    $html .= "<button type='button' class='btn btn-icon btn-icon rounded-circle btn-flat-danger'  wire:click=" . $quote . '$emit(' . $singleQuote . 'DeleteRolePermission' . $singleQuote . ',' . $model->id . ',' . $singleQuote . $permission->name . $singleQuote . ')' . $quote . "><i data-feather='trash'></i></button></li></div>";
                }
                return $html;
            })
            ->addColumn('guard_name')
            ->addColumn('created_at_formatted', fn (Role $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (Role $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
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
            Column::make('Name', 'name')
                ->searchable()
                ->sortable()
                ->makeInputText(),
            Column::make('Permission Name', 'permissions')
                ->searchable()
                ->sortable(),
            Column::make('Guard Name', 'guard_name')
                ->sortable()
                ->searchable()
                ->makeInputText(),
            Column::make('CREATED AT', 'created_at_formatted', 'created_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),
            // Column::add()
            //     ->title('Guard Name')
            //     ->field('guard_name')
            //     ->sortable()
            //     ->searchable()
            //     ->makeInputText(),
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
     * PowerGrid Role Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('role.edit', ['role' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('role.destroy', ['role' => 'id'])
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
     * PowerGrid Role Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($role) => $role->id === 1)
                ->hide(),
        ];
    }
    */
}
