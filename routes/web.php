<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserRoleFormRequest;
use App\Http\Controllers\Admin\SuppliersController;
use App\Http\Controllers\Admin\UserRoleController;

use App\Http\Controllers\Admin\UserPermissionController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductionOrderController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\MaterialStockController;
use App\Http\Controllers\Admin\GroupPricingController;
use App\Http\Controllers\Admin\PriceListController;
use App\Http\Controllers\Admin\CustomerOrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Admin\LaminationNameController;
use App\Http\Controllers\Admin\StaffManagementController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\TransformController;
use App\Http\Controllers\Admin\RecipeMasterController;

Route::get('/', function () {
    return redirect('admin/login');
});

Route::get('/layout/dashboard', function () {
    return view('layouts.dashboard');
});
Route::get('/reports/dailyrewindingreport', function () {
    return view('layouts.reports.dailyrewindingreport');
});
Route::get('/reports/extruderreport', function () {
    return view('layouts.reports.extruderreport');
});
Route::get('/reports/packingreport', function () {
    return view('layouts.reports.packingreport');
});
Route::get('/reports/reportdesign', function () {
    return view('layouts.reports.reportdesign');
});
Route::get('/purchaseorder/list', function () {
    return view('layouts.purchaseorder.list');
});
Route::get('/purchaseorder/purchaseorderitems', function () {
    return view('layouts.purchaseorder.purchaseorderitems');
});
Route::get('/purchaseorder/purchaseorderlist', function () {
    return view('layouts.purchaseorder.purchaseorderlist');
});
Route::get('/rawmaterial/listmaterial', function () {
    return view('layouts.rawmaterial.listmaterial');
});
Route::get('/rawmaterial/editmaterial', function () {
    return view('layouts.rawmaterial.editmaterial');
});
Route::get('/rawmaterial/addmaterial', function () {
    return view('layouts.rawmaterial.addmaterial');
});
Route::get('/grouppricing/grouppricings', function () {
    return view('layouts.grouppricing.grouppricings');
});
Route::get('/grouppricing/assignpricelist', function () {
    return view('layouts.grouppricing.assignpricelist');
});
Route::get('/supplier/listsupplier', function () {
    return view('layouts.supplier.listsupplier');
});
Route::get('/supplier/addpricelist', function () {
    return view('layouts.supplier.addpricelist');
});
Route::get('/customerorder/summery', function () {
    return view('layouts.customerorder.summery');
});
Route::get('/customerorder/editmanufactureorder', function () {
    return view('layouts.customerorder.editmanufactureorder');
});
Route::get('/customerorder/addmanufactureorder', function () {
    return view('layouts.customerorder.addmanufactureorder');
});
Route::get('/customerorder/makeorder', function () {
    return view('layouts.customerorder.makeorder');
});
Route::get('/customerorder/ordersummery', function () {
    return view('layouts.customerorder.ordersummery');
});
Route::get('/customerorder/index', function () {
    return view('layouts.customerorder.index');
});
Route::get('/customerorder/edit', function () {
    return view('layouts.customerorder.edit');
});
Route::get('/customerorder', function () {
    return view('layouts.customerorder.create');
});
Route::get('/customers', function () {
    return view('layouts.customers.create');
});
// Route::get('/user-role', function () {
//     return view('admin.customers.create');
// });
Route::get('/customers/index', function () {
    return view('layouts.customers.index');
});
Route::get('/customers/edit', function () {
    return view('layouts.customers.edit');
});
Route::get('/customers/view', function () {
    return view('layouts.customers.view');
});
Route::get('/products/index', function () {
    return view('layouts.products.index');
});
Route::get('/products', function () {
    return view('layouts.products.create');
});
Route::get('/products/edit', function () {
    return view('layouts.products.edit');
});
Route::get('/supplier/index', function () {
    return view('layouts.supplier.index');
});
Route::get('/supplier', function () {
    return view('layouts.supplier.create');
});
Route::get('/supplier/edit', function () {
    return view('layouts.supplier.edit');
});
Route::get('/staffmanagement/index', function () {
    return view('layouts.staffmanagement.index');
});
Route::get('/staffmanagement', function () {
    return view('layouts.staffmanagement.create');
});
Route::get('/staffmanagement/edit', function () {
    return view('layouts.staffmanagement.edit');
});


// Route::get('users',[HomeController::class,'users']);
Route::get('/admin', function () {
    if(Auth::check()){
        return redirect('dashboard');   
    }else{
        return redirect('admin/login');
    }
});
Route::get('/login', function(){
    return redirect('admin/login');
});
Route::get('/admin/login', function(){
    return view('auth/login');
})->name('admin/login');


Route::post('/admin/login', [AuthenticatedSessionController::class, 'store'])->name('login');
Route::any('admin/forgot-password', [PasswordController::class, 'forgotpass'])->name('admin.forgot-password');
Route::any('forgotEmailsend', [PasswordController::class, 'sendEmail'])->name('forgot.email');
Route::any('resetpass/{token}', [PasswordController::class, 'resetpass'])->name('forgot.reset');
Route::any('passchange/{token}', [PasswordController::class, 'passchange'])->name('forgot.passchange');

// Define only one route for '/dashboard'
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified']) // Apply the necessary middleware
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('admin')->group(function() {
    Route::group(['middleware' => ['auth']], function() {
        Route::resource('recipes', RecipeMasterController::class);
            Route::resource('users', UserController::class);
            Route::resource('customers', CustomerController::class);
            Route::get('/customers/print/{printId}', [CustomerController::class, 'print'])->name('customers.print');
            Route::get('/customers/view/{id}', [CustomerController::class, 'show'])->name('customers.view');
            Route::resource('products', ProductController::class);
            Route::resource('production_order', ProductionOrderController::class);
            Route::delete('productions/{production}', [ProductionOrderController::class, 'destroy'])->name('productions.destroy');
            // Route::delete('productions/{production}', 'ProductionOrderController@destroy')->name('productions.destroy');

            // Route::delete('/production_order/{production_order}', 'ProductionOrderController@destroy')->name('production_order.destroy');

            Route::resource('material', MaterialController::class);
            Route::get('materialStock', [MaterialStockController::class, 'index'])->name('materialStock.index');
            Route::get('materialStock/view/{id}', [MaterialStockController::class, 'show'])->name('materialStock.view');
            Route::get('materialStock/pdf/{id}', [MaterialStockController::class, 'pdf'])->name('materialStock.pdf');
            Route::get('materialStock/print/{id}', [MaterialStockController::class, 'print'])->name('materialStock.print');
            Route::get('product_export',[ProductController::class, 'get_student_data'])->name('products.export');
            Route::get('/get-states/{countryId}', [CustomerController::class, 'getStates'])->name('customers.getstate');
            Route::get('/get-cities/{stateId}', [CustomerController::class, 'getcities'])->name('customers.getcity');
            Route::resource('suppliers', SuppliersController::class);
            Route::get('/suppliers/print/{printId}', [SuppliersController::class, 'print'])->name('suppliers.print');
            Route::get('/suppliers/view/{id}', [SuppliersController::class, 'show'])->name('suppliers.view');
            Route::post('customers/updateStatus', [CustomerController::class, 'updateStatus'])->name('customers.updateStatus');
            Route::get('/orders/{customerId}', [ProductionOrderController::class, 'getOrdersByCustomer'])->name('production-orders.byCustomer');
            Route::post('/groups', [ProductController::class, 'storeGroup'])->name('product.storeGroup');
            Route::get('/production-orders/sales-order/{salesOrderId}/products', [ProductionOrderController::class, 'getProductsBySalesOrder'])->name('production-orders.bySalesOrder');

            Route::get('/customer/{id}/last-price-list', [CustomerOrderController::class, 'getLastPriceListId'])->name('last-price-list');

            Route::post('customers/add', [CustomerController::class,'add'])->name('customers.add');
            Route::post('customers/groupadd', [CustomerController::class,'groupadd'])->name('customers.groupadd');
            Route::post('products/productgroupadd', [ProductController::class,'productgroupadd'])->name('products.productgroupadd');
            Route::post('customers/coloradd', [CustomerController::class,'coloradd'])->name('customers.coloradd');

            Route::resource('group_pricing', GroupPricingController::class);
            Route::resource('price-list', PriceListController::class);
            Route::get('group_pricing/{id}/assign-products', [GroupPricingController::class, 'assignProducts'])->name('group_pricing.assign_products');
            Route::post('group_pricing/{id}/assign-products', [GroupPricingController::class, 'storeAssignedProducts'])->name('group_pricing.store_assigned_products');
            Route::get('/group-pricing/export', [GroupPricingController::class, 'export'])->name('group-pricing.export');
            Route::post('/price-list-item/{id}/update-special-rate', [PriceListController::class, 'updateSpecialRate'])->name('price-list-item.update-special-rate');
            Route::get('price-list/{id}/export', [PriceListController::class, 'export'])->name('price-list.export');
            Route::get('/price-list-item/{id}', [PriceListController::class, 'deletePriceListItem'])->name('price-list-item.delete');
            Route::post('/delete-color', [CustomerOrderController::class, 'deleteColor'])->name('color.delete');
            Route::get('/production-orders/by-product/{productId}/{salesOrderValue?}', [ProductionOrderController::class, 'getCompaniesByProduct'])->name('production-orders.byProduct');
            Route::get('/production-orders/by-material/{materialId}', [ProductionOrderController::class, 'getProductByMaterial'])->name('production-orders.byMaterial');
            Route::get('/production-orders/by-materials/{outerId}', [ProductionOrderController::class, 'getProductByOuter'])->name('production-orders.byouters');
            Route::get('/production-orders/by-materials/{cartonId}', [ProductionOrderController::class, 'getProductByCarton'])->name('production-orders.bycartons');
            Route::get('/production-orders/by-materials/{sizeId}', [ProductionOrderController::class, 'getProductBySize'])->name('production-orders.bySize');
            Route::get('/production-orders/by-materials/{stickerId}', [ProductionOrderController::class, 'getProductBySticker'])->name('production-orders.bySticker');
            Route::get('/production-orders/by-materials/{MaterialNameId}', [ProductionOrderController::class, 'getProductBymaterialName'])->name('production-orders.byMaterialName');
            Route::get('/production-orders/masterPacking', [ProductionOrderController::class, 'getMasterPackingData'])
            ->name('production-orders.masterPacking');
        
            // Route::resource('reports', ReportsController::class);
            Route::get('reports', [ReportsController::class, 'index'])->name('reports.index');
            Route::get('reports/orders/export', [ReportsController::class, 'export'])->name('reports.orders.export');
            Route::get('reports/rewinding', [ReportsController::class, 'rewindingReports'])->name('reports.rewinding');
            Route::get('reports/packing', [ReportsController::class, 'packingReports'])->name('reports.packing');
            Route::get('reports/extruder', [ReportsController::class, 'extruderReports'])->name('reports.extruder');
            Route::get('reports/stitching', [ReportsController::class, 'stitchingReports'])->name('reports.stitching');
            Route::get('reports/lamination', [ReportsController::class, 'laminationReports'])->name('reports.lamination');
            Route::get('reports/stockInward', [ReportsController::class, 'stockInwardReports'])->name('reports.stockInward');
            Route::get('reports/stockOutward', [ReportsController::class, 'stockOutwardReports'])->name('reports.stockOutward');
            Route::get('reports/order', [ReportsController::class, 'orderReports'])->name('reports.order');
            Route::get('reports/lamination/pdf', [ReportsController::class, 'generateLaminationPDF'])->name('reports.lamination.pdf');
            Route::get('reports/laminationdata/pdf/{id}', [ReportsController::class, 'generateLaminationPDF'])->name('reports.laminationdata.pdf');
            Route::get('reports/extruder/pdf', [ReportsController::class, 'generateExtruderPDF'])->name('reports.extruder.pdf');
            Route::get('reports/extruderdata/pdf/{id}', [ReportsController::class, 'generateExtruderPDF'])->name('reports.extruderdata.pdf');
            Route::get('reports/rewinding/pdf', [ReportsController::class, 'generateRewindingPDF'])->name('reports.rewinding.pdf');
            Route::get('reports/rewindingdata/pdf/{id}', [ReportsController::class, 'generateRewindingPDF'])->name('reports.rewindingdata.pdf');
            Route::get('reports/stitching/pdf', [ReportsController::class, 'generateStitchingPDF'])->name('reports.stitching.pdf');
            Route::get('reports/stitchingdata/pdf/{id}', [ReportsController::class, 'generateStitchingPDF'])->name('reports.stitchingdata.pdf');
            Route::get('reports/packing/pdf', [ReportsController::class, 'generatePackingPDF'])->name('reports.packing.pdf');
            Route::get('reports/packingdata/pdf/{id}', [ReportsController::class, 'generatePackingPDF'])->name('reports.packingdata.pdf');
            Route::get('reports/inwardpdf/{id}', [ReportsController::class, 'generateInwardPDF'])->name('reports.inwardpdf');
            Route::get('reports/outwardpdf/{id}', [ReportsController::class, 'generateOutwardPDF'])->name('reports.outwardpdf');
            
            // Route::get('reports/packingdata/pdf/{id}', [ReportsController::class, 'generatePackingPDF'])->name('reports.packingdata.pdf');
            // Route::get('reports/packingdata/pdf/{id}', [ReportsController::class, 'generatePackingPDF'])->name('reports.packingdata.pdf');

            Route::get('/material-category/{id}/subcategories', [ProductController::class, 'getSubcategories'])->name('material.getSubcategories');
            Route::get('/material-category/{categoryId}/materials/{subcategoryId?}', [ProductController::class, 'getMaterials'])->name('material.getMaterials');
            Route::get('materials/subcategory/{id}', [ProductController::class, 'getMaterialsBySubCat'])->name('material.getMaterialsBySubCat');
            Route::get('customer-order/pdf/{id}', [CustomerOrderController::class, 'generatePDF'])->name('customerOrder.pdf');
            Route::get('customer/pdf/{id}', [CustomerController::class, 'generatePDF'])->name('customer.pdf');
            Route::get('supplier/pdf/{id}', [SuppliersController::class, 'generatePDF'])->name('supplier.pdf');
            Route::get('group_pricing/pdf/{id}', [PriceListController::class, 'generatePDF'])->name('price-list.pdf');
            Route::get('product/pdf/{id}', [ProductController::class, 'generatePDF'])->name('product.pdf');
            Route::get('production-orders/pdf/{id}', [ProductionOrderController::class, 'generatePDF'])->name('production_order.pdf');
            
            Route::get('material/pdf/{id}', [MaterialController::class, 'generatePDF'])->name('material.pdf');
            Route::get('lamination/pdf/{id}', [LaminationNameController::class, 'generatePDF'])->name('lamination.pdf');
            Route::get('staff-management/pdf/{id}', [StaffManagementController::class, 'generatePDF'])->name('staff-management.pdf');
            
            Route::get('permission/pdf/{id}', [PermissionController::class, 'generatePDF'])->name('permission.pdf');
            Route::get('permission/print/{id}', [PermissionController::class, 'print'])->name('permission.print');
            Route::get('permission/view/{id}', [PermissionController::class, 'show'])->name('permission.view');
            Route::get('transport/pdf/{id}', [TransformController::class, 'generatePDF'])->name('transport.pdf');
            Route::get('material/print/{id}', [MaterialController::class, 'print'])->name('material.print');
            Route::get('material/view/{id}', [MaterialController::class, 'show'])->name('material.view');
            Route::get('lamination/print/{id}', [LaminationNameController::class, 'print'])->name('lamination.print');
            Route::get('lamination/view/{id}', [LaminationNameController::class, 'show'])->name('lamination.view');
            Route::get('group_pricing/print/{id}', [PriceListController::class, 'print'])->name('price-list.print');
            Route::get('group_pricing/view/{id}', [PriceListController::class, 'show'])->name('price-list.view');
            Route::get('product/print/{id}', [ProductController::class, 'print'])->name('product.print');
            Route::get('product/view/{id}', [ProductController::class, 'show'])->name('product.view');
            Route::get('transport/print/{id}', [TransformController::class, 'print'])->name('transport.print');
            Route::get('transport/view/{id}', [TransformController::class, 'show'])->name('transport.view');
            Route::get('staff-management/print/{id}', [StaffManagementController::class, 'print'])->name('staff-management.print');
            Route::get('staff-management/view/{id}', [StaffManagementController::class, 'show'])->name('staff-management.view');
            Route::get('production-orders/print/{id}', [ProductionOrderController::class, 'print'])->name('production_order.print');
            Route::get('production-orders/view/{id}', [ProductionOrderController::class, 'show'])->name('production_order.view');


            
           // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


            // Route::any('/production_order', [ProductionOrderController::class, 'index'])->name('production_order.index');
            // Route::any('/production_order_create', [ProductionOrderController::class, 'create'])->name('production_order.create');
            // Route::any('/production_order_store', [ProductionOrderController::class, 'Store'])->name('production_order.store');

            // Route::get('products.export', ProductController::class)->name('products.export');
    });

    // Route::prefix('/suppliers')->group(function () {        
    //     Route::get('/', [SuppliersController::class,'index'])->name('suppliers.index');
    //     Route::get('/add', [SuppliersController::class, 'add'])->name('suppliers.add');
    //     Route::post('/submit', [SuppliersController::class, 'store'])->name('suppliers.submit');
    //     Route::get('/edit/{id}', [SuppliersController::class, 'edit'])->name('suppliers.edit');

    //     Route::post('/update/{id}', [SuppliersController::class, 'update'])->name('suppliers.update');
    //     Route::Post('/destroy', [SuppliersController::class,'softDelete'])->name('suppliers.destroy');
    //     Route::any('/get', [SuppliersController::class, 'getFaqData'])->name('suppliers.get');
    // });

    // Route::prefix('customers')->group(function () {        
    //     Route::get('/', [UserRoleController::class,'index'])->name('user-role.index');

    // });
    Route::get('/format-currency/{amount}', function ($amount) {
        return response()->json(formatIndianCurrency($amount));
    });
    
});


require __DIR__.'/auth.php';
require __DIR__.'/role.php';





