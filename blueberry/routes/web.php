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


    // For Features
    Route::get('features', [FeatureController::class,'index'])->name('features.index')->middleware(['checkRolePermission:features,read-feature']);
    Route::post('feature', [FeatureController::class,'store'])->name('features.add')->middleware(['checkRolePermission:features,add-new-feature']);
    Route::post('feature-update', [FeatureController::class,'update'])->name('features.edit')->middleware(['checkRolePermission:features,edit-feature']);
    Route::post('feature-delete', [FeatureController::class,'destroy'])->name('features.delete')->middleware(['checkRolePermission:features,delete-feature']);

    // For categories
    Route::get('categories', [CategoryController::class,'index'])->name('categories.index')->middleware(['checkRolePermission:categories,read-category']);
    Route::post('category', [CategoryController::class,'store'])->name('categories.add')->middleware(['checkRolePermission:categories,add-new-category']);
    Route::post('category-update', [CategoryController::class,'update'])->name('categories.edit')->middleware(['checkRolePermission:categories,edit-category']);
    Route::post('category-delete', [CategoryController::class,'destroy'])->name('categories.delete')->middleware(['checkRolePermission:categories,delete-category']);
    Route::post('feature-categories', [CategoryController::class,'categories'])->name('feature.categories');
    Route::get('users', [UserController::class,'index'])->name('users.index')->middleware(['checkRolePermission:users,read-user']);
    Route::post('user', [UserController::class,'store'])->name('users.add')->middleware(['checkRolePermission:users,add-new-user']);
    Route::post('user-update', [UserController::class,'update'])->name('users.edit')->middleware(['checkRolePermission:users,edit-user']);
    Route::post('user-delete', [UserController::class,'destroy'])->name('users.delete')->middleware(['checkRolePermission:users,delete-user']);

    Route::get('customers', [CustomerController::class,'index'])->name('customers.index')->middleware(['checkRolePermission:customers,read-customer']);
    Route::post('customer', [CustomerController::class,'store'])->name('customers.add')->middleware(['checkRolePermission:customers,add-new-customer']);
    Route::post('customer-update', [CustomerController::class,'update'])->name('customers.edit')->middleware(['checkRolePermission:customers,edit-customer']);
    Route::post('customer-delete', [CustomerController::class,'destroy'])->name('customers.delete')->middleware(['checkRolePermission:customers,delete-customer']);
    Route::get('b2bs', [B2BController::class,'index'])->name('b2bs.index')->middleware(['checkRolePermission:b2b-user,read-b2b']);
    Route::post('b2b', [B2BController::class,'store'])->name('b2bs.add')->middleware(['checkRolePermission:b2b-user,add-new-b2b']);
    Route::post('b2b-update', [B2BController::class,'update'])->name('b2bs.edit')->middleware(['checkRolePermission:b2b-user,edit-b2b']);
    Route::post('b2b-delete', [B2BController::class,'destroy'])->name('b2bs.delete')->middleware(['checkRolePermission:b2b-user,delete-b2b']);
    Route::get('countries', [WorldWideController::class,'index'])->name('worldwild.countries')->middleware(['checkRolePermission:countries,read-country']);
    Route::post('country-update', [WorldWideController::class,'update'])->name('worldwild.edit')->middleware(['checkRolePermission:countries,edit-country']);
    Route::get('states/{countryId}', [WorldWideController::class,'indexState'])->name('worldwild.states')->middleware(['checkRolePermission:countries,read-state']);
    Route::post('state-update', [WorldWideController::class,'updateState'])->name('worldwild.edit.state')->middleware(['checkRolePermission:countries,edit-state']);
    Route::get('cities/{countryId}/{stateId}', [WorldWideController::class,'indexCity'])->name('worldwild.cities')->middleware(['checkRolePermission:countries,read-city']);
    Route::post('city-update', [WorldWideController::class,'updateCity'])->name('worldwild.edit.city')->middleware(['checkRolePermission:countries,edit-city']);
    Route::get('car-brands', [BrandController::class,'index'])->name('car.brands.index')->middleware(['checkRolePermission:car-brands,read-brand']);
    Route::post('car-brand', [BrandController::class,'store'])->name('car.brands.add')->middleware(['checkRolePermission:car-brands,add-new-brand']);
    Route::post('car-brand-update', [BrandController::class,'update'])->name('car.brands.edit')->middleware(['checkRolePermission:car-brands,edit-brand']);
    Route::post('car-brand-delete', [BrandController::class,'destroy'])->name('car.brands.delete')->middleware(['checkRolePermission:car-brands,delete-brand']);
    Route::get('car-models', [ModelController::class,'index'])->name('car.models.index')->middleware(['checkRolePermission:car-models,read-model']);
    Route::post('car-model', [ModelController::class,'store'])->name('car.models.add')->middleware(['checkRolePermission:car-models,add-new-model']);
    Route::post('car-model-update', [ModelController::class,'update'])->name('car.models.edit')->middleware(['checkRolePermission:car-models,edit-model']);
    Route::post('car-model-delete', [ModelController::class,'destroy'])->name('car.models.delete')->middleware(['checkRolePermission:car-models,delete-model']);
    Route::get('car-trims', [TrimController::class,'index'])->name('car.trims.index')->middleware(['checkRolePermission:car-trims,read-trim']);
    Route::post('car-trim', [TrimController::class,'store'])->name('car.trims.add')->middleware(['checkRolePermission:car-trims,add-new-trim']);
    Route::post('car-trim-update', [TrimController::class,'update'])->name('car.trims.edit')->middleware(['checkRolePermission:car-trims,edit-trim']);
    Route::post('car-trim-delete', [TrimController::class,'destroy'])->name('car.trims.delete')->middleware(['checkRolePermission:car-trims,delete-trim']);
    Route::get('car-body-types', [BodyTypeController::class,'index'])->name('car.body.types.index')->middleware(['checkRolePermission:car-body-types,read-body-types']);
    Route::post('car-body-type', [BodyTypeController::class,'store'])->name('car.body.types.add')->middleware(['checkRolePermission:car-body-types,add-new-body-types']);
    Route::post('car-body-type-update', [BodyTypeController::class,'update'])->name('car.body.types.edit')->middleware(['checkRolePermission:car-body-types,edit-body-types']);
    Route::post('car-body-type-delete', [BodyTypeController::class,'destroy'])->name('car.body.types.delete')->middleware(['checkRolePermission:car-body-types,delete-body-types']);
    Route::get('cars', [CarController::class,'index'])->name('cars.index')->middleware(['checkRolePermission:cars,read-car']);
    Route::get('cars-detail/{carId}', [CarController::class,'show'])->name('cars.show')->middleware(['checkRolePermission:cars,show-car']);
    Route::post('cars', [CarController::class,'store'])->name('cars.add')->middleware(['checkRolePermission:cars,add-new-car']);
    Route::post('cars-update', [CarController::class,'update'])->name('cars.edit')->middleware(['checkRolePermission:cars,edit-car']);
    Route::post('cars-delete', [CarController::class,'destroy'])->name('cars.delete')->middleware(['checkRolePermission:cars,delete-car']);
    Route::get('get-models', [ModelController::class,'getModels'])->name('get.models');
    Route::get('get-trims', [TrimController::class,'getTrims'])->name('get.trims');
    Route::get('get-states', [WorldWideController::class,'getStates'])->name('get.states');
    Route::get('get-cities', [WorldWideController::class,'getCities'])->name('get.cities');
    Route::get('get-sub-categories', [CategoryController::class,'getSubCategories'])->name('get.subcategories');
    Route::get('properties', [PropertyController::class,'index'])->name('properties.index')->middleware(['checkRolePermission:property,read-property']);
    Route::post('property', [PropertyController::class,'store'])->name('properties.add')->middleware(['checkRolePermission:property,add-new-property']);
    Route::post('property-update', [PropertyController::class,'update'])->name('properties.edit')->middleware(['checkRolePermission:property,edit-property']);
    Route::post('property-delete', [PropertyController::class,'destroy'])->name('properties.delete')->middleware(['checkRolePermission:property,delete-property']);
    Route::get('coupons', [CouponController::class,'index'])->name('coupons.index')->middleware(['checkRolePermission:coupons,read-coupon']);
    Route::post('coupon', [CouponController::class,'store'])->name('coupons.add')->middleware(['checkRolePermission:coupons,add-new-coupon']);
    Route::get('coupons-detail/{couponId}', [CouponController::class,'show'])->name('coupons.show')->middleware(['checkRolePermission:cars,show-coupon']);
    Route::get('coupons/{couponId}/assign', [CouponController::class,'assign'])->name('coupons.assign')->middleware(['checkRolePermission:cars,assign-coupon']);
    Route::post('coupons/{couponId}/assign-coupons', [CouponController::class,'assignCoupon'])->name('coupons.assign.users')->middleware(['checkRolePermission:cars,assign-coupon']);
    Route::post('coupon-update', [CouponController::class,'update'])->name('coupons.edit')->middleware(['checkRolePermission:coupons,edit-coupon']);
    Route::post('coupon-delete', [CouponController::class,'destroy'])->name('coupons.delete')->middleware(['checkRolePermission:coupons,delete-coupon']);
    Route::get('car-images/{carId}', [CarImageController::class,'index'])->name('car.images.index')->middleware(['checkRolePermission:car-images,read-image']);
    Route::post('car-image', [CarImageController::class,'store'])->name('car.images.add')->middleware(['checkRolePermission:car-images,add-new-image']);
    Route::get('car-image-detail/{carImageId}', [CarImageController::class,'show'])->name('car.images.show')->middleware(['checkRolePermission:car-images,show-image']);
    Route::post('car-image-update', [CarImageController::class,'update'])->name('car.images.edit')->middleware(['checkRolePermission:car-images,edit-image']);
    Route::post('car-image-delete', [CarImageController::class,'destroy'])->name('car.images.delete')->middleware(['checkRolePermission:car-images,delete-image']);
    Route::get('property-images/{propertyId}', [PropertyImageController::class,'index'])->name('property.images.index')->middleware(['checkRolePermission:property-images,read-property']);
    Route::post('property-image', [PropertyImageController::class,'store'])->name('property.images.add')->middleware(['checkRolePermission:property-images,add-new-image']);
    Route::get('property-image-detail/{propertyImageId}', [PropertyImageController::class,'show'])->name('property.images.show')->middleware(['checkRolePermission:property-images,show-property']);
    Route::post('property-image-update', [PropertyImageController::class,'update'])->name('property.images.edit')->middleware(['checkRolePermission:property-images,edit-property']);
    Route::post('property-image-delete', [PropertyImageController::class,'destroy'])->name('property.images.delete')->middleware(['checkRolePermission:property-images,delete-property']);
    Route::get('companies', [CompanyController::class,'index'])->name('company.index')->middleware(['checkRolePermission:companies,read-company']);
    Route::post('companies-update', [CompanyController::class,'update'])->name('companies.edit')->middleware(['checkRolePermission:companies,edit-company']);


});

require __DIR__.'/auth.php';



