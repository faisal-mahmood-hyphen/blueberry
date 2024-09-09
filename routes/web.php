<?php


use App\Http\Controllers\B2BController;
use App\Http\Controllers\BodyTypeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CarImageController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyImageController;
use App\Http\Controllers\TrimController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorldWideController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/admin/dashboard');
});

Route::prefix('admin')->get('/dashboard', function () {
    $active = 'dashboard';
    $breadCrumbs[] = ['name'=>'Dashboard','active'=>true];
    return view('dashboard',compact('active','breadCrumbs'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('roles', RoleController::class);

    // For Roles
    Route::get('roles', [RoleController::class,'index'])->name('roles.index')->middleware(['checkRolePermission:roles,read-role']);
    Route::post('role', [RoleController::class,'store'])->name('roles.add')->middleware(['checkRolePermission:roles,add-new-role']);
    Route::post('role-update', [RoleController::class,'update'])->name('roles.edit')->middleware(['checkRolePermission:roles,edit-role']);
    Route::post('role-delete', [RoleController::class,'destroy'])->name('roles.delete')->middleware(['checkRolePermission:roles,delete-role']);
    Route::get('roles/{roleId}/permissions', [RoleController::class,'permissions'])->name('roles.permissions')->middleware(['checkRolePermission:roles,assign-permission']);
    Route::post('roles/{roleId}/assign-permissions', [RoleController::class,'assignPermissions'])->name('roles.permissions.assign')->middleware(['checkRolePermission:roles,assign-permission']);


    // For categories
    Route::get('categories', [CategoryController::class,'index'])->name('categories.index')->middleware(['checkRolePermission:categories,read-category']);
    Route::post('category', [CategoryController::class,'store'])->name('categories.add')->middleware(['checkRolePermission:categories,add-new-category']);
    Route::post('category-update', [CategoryController::class,'update'])->name('categories.edit')->middleware(['checkRolePermission:categories,edit-category']);
    Route::post('category-delete', [CategoryController::class,'destroy'])->name('categories.delete')->middleware(['checkRolePermission:categories,delete-category']);
    Route::get('users', [UserController::class,'index'])->name('users.index')->middleware(['checkRolePermission:users,read-user']);
    Route::post('user', [UserController::class,'store'])->name('users.add')->middleware(['checkRolePermission:users,add-new-user']);
    Route::post('user-update', [UserController::class,'update'])->name('users.edit')->middleware(['checkRolePermission:users,edit-user']);
    Route::post('user-delete', [UserController::class,'destroy'])->name('users.delete')->middleware(['checkRolePermission:users,delete-user']);


});

require __DIR__.'/auth.php';



