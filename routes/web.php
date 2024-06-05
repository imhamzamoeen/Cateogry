<?php

use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\Order;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('check', function () {
    return        Order::query()->with(['Unit','User','Unit.SubCategory.Category'])->get();
});

Route::get('/', function () {

    if (auth()->check()) {
        return redirect('dashboard');
    }
    return redirect('login');
})->name('default');

Route::group(
    [
        'middleware' => ['auth',],
        'as' => 'front.',

    ],
    function () {
        Route::view('/dashboard', 'dashboard')->name('dashboard');
        
        Route::view('/profile', 'front.profile.profile')->name('profile');
        Route::post('Profile_Pic_Update', [ProfileController::class, 'pic_update'])->name('profile.pic_update');
        // Route::get('register', [RegisterationController::class, 'index'])->name('register.index');
        // Route::post('register', [RegisterationController::class, 'Register'])->name('register.register');
        // Route::post('DelUser', [RegisterationController::class, 'DelUser'])->name('register.DelUser');
        // Route::post('EditUser', [RegisterationController::class, 'EditUser'])->name('register.EditUser');
        // Route::get('getUsers', [RegisterationController::class, 'getUsers'])->name('register.getUsers');
        // Route::resource('Company-User', UserCompanyManagementController::class);
    }
);


Route::group(
    [
        'middleware' => ['auth', 'permission:Super-Admin-View'],
        'as' => 'Roles.',
        'prefix' => 'Roles/',

    ],
    function () {
        Route::view('/Role', 'front.role.role')->name('role');
        Route::view('/Permission', 'front.permission.permission')->name('permission');
    
    }
);


Route::group(
    [
        'middleware' => ['auth', 'permission:Super-Admin-View|Admin-View'],
        'as' => 'Managment.',
        'prefix' => 'Managment/',

    ],
    function () {
        Route::view('/UserManagment', 'front.UserManagment.index')->name('UserManagment');
        Route::view('/Category', 'front.managment.category')->name('category');
        Route::view('/SubCategory', 'front.managment.sub_category')->name('sub_category');
        Route::view('/Unit', 'front.managment.unit')->name('unit');
    }
);

Route::group(
    [
        'middleware' => ['auth'],
        'as' => 'Store.',
        'prefix' => 'Store/',

    ],
    function () {
        Route::view('/index', 'front.store.index')->name('index');
        Route::view('/manage', 'front.store.manage')->name('manage');
        Route::view('/Income', 'front.store.income')->name('income');
        Route::view('/Expense', 'front.store.expense')->name('expense');
        Route::view('/Pending', 'front.store.pending')->name('pending');

        Route::view('/BalanceSheet', 'front.store.balancesheet')->name('balancesheet');


    }
);





require __DIR__ . '/auth.php';
