<?php
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\StaffManagementController;
use App\Http\Controllers\Admin\GroupPricingController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\MakeOrderController;
use App\Http\Controllers\Admin\CustomerOrderController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\TransformController;
use App\Http\Controllers\Admin\LaminationNameController;

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('staff-management', StaffManagementController::class);
    Route::resource('group-pricing', GroupPricingController::class);
    // Route::resource('reports', ReportsController::class);
    Route::resource('settings', SettingsController::class);
    Route::resource('make_order', MakeOrderController::class);
    Route::resource('customerOrder', CustomerOrderController::class);
    Route::get('/customerOrder/print/{printId}', [CustomerOrderController::class, 'print'])->name('customerOrder.print');
    Route::get('/customerOrder/view/{id}', [CustomerOrderController::class, 'show'])->name('customerOrder.view');
    Route::resource('transport', TransformController::class);
    Route::resource('laminations', LaminationNameController::class);
    Route::post('transform/add', [TransformController::class,'add'])->name('transform.add');
    Route::post('productform/add', [CustomerOrderController::class,'add'])->name('productform.add');
    // Route::post('transform/add', [TransformController::class,'add'])->name('transform.add');
    // Route::resource('transform/', TransformController::class)->name('add');
    Route::get('/customerOrder/products/{priceListId}', [CustomerOrderController::class, 'storeGroup'])->name('customerOrder.storeGroup');
    Route::get('role/pdf/{id}', [RoleController::class, 'generatePDF'])->name('role.pdf');
    Route::get('role/print/{id}', [RoleController::class, 'print'])->name('role.print');
    Route::get('role/view/{id}', [RoleController::class, 'show'])->name('role.view');
    // Route::get('/customerOrder/products/{priceListId}', [CustomerOrderController::class, 'getProductsByPriceList'])->name('product.getProductsByPriceList');

    // Route::get('/customerOrder/products/{priceListId}', [CustomerOrderController::class, 'getProductsByPriceList']);

    

});

