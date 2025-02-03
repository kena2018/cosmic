<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('v1')->group(function () {
Route::any('login', [AuthController::class,'login'])->name('login');
Route::any('login/mobile', [ApiController::class, 'loginWithMobile']);
Route::any('login/mobile/verify', [ApiController::class, 'verifyMobileLogin']);
Route::any('forgot-password', [ApiController::class, 'forgotPassword']);
Route::any('reset-password', [ApiController::class, 'resetPassword']);
Route::any('/resend-otp', [ApiController::class, 'resendOtp']);
Route::any('terms-and-conditions', [ApiController::class, 'termsAndConditions']);
Route::any('privacy-policy', [ApiController::class, 'privacyPolicy']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
// //     return $request->user();
// // });
Route::middleware('auth:sanctum')->post('/logout', [ApiController::class, 'logout']);
    Route::middleware('auth:sanctum')->group( function () {
        //changed apis according to new flow stat
        Route::any('/lamination/orders/getOrdersByStatus', [ApiController::class, 'getLaminationOrdersByStatus']);
        Route::any('/lamination/orders/getOrdersByUser', [ApiController::class, 'getLaminationOrdersByUser']);
        Route::any('/lamination/orders/setOrderCompleted', [ApiController::class, 'setLaminationOrderCompleted']);
        Route::any('/lamination/orders/getOrderByLaminationId', [ApiController::class, 'getOrderByLaminationOrderId']);
        Route::any('/lamination/orders/searchOrder', [ApiController::class, 'getLaminationOrdersSearch']);
        Route::any('/lamination/orders/makeItComplete', [ApiController::class, 'laminationOrderMakeItComplete']);
        Route::any('/lamination/orders/laminationOrderHistoryDelete', [ApiController::class, 'laminationOrderHistoryDelete']);

        Route::any('/extruder/orders/getOrdersByStatus', [ApiController::class, 'getExtruderOrdersByStatus']);
        Route::any('/extruder/orders/getOrdersByUser', [ApiController::class, 'getExtruderOrdersByUser']);
        Route::any('/extruder/orders/setOrderCompleted', [ApiController::class, 'setExtruderOrderCompleted']);
        Route::any('/extruder/orders/getOrderByExtruderOrderId', [ApiController::class, 'getOrderByExtruderOrderId']);
        Route::any('/extruder/orders/searchOrder', [ApiController::class, 'getExtruderOrdersSearch']);
        Route::any('/extruder/orders/makeItComplete', [ApiController::class, 'extruderOrderMakeItComplete']);
        Route::any('/extruder/orders/extruderOrderHistoryDelete', [ApiController::class, 'extruderOrderHistoryDelete']);


        Route::any('/rewinding/orders/getOrdersByStatus', [ApiController::class, 'getRewindingOrdersByStatus']);
        Route::any('rewinding/orders/getOrdersByUser', [ApiController::class, 'getRewindingOrdersByUser']);
        Route::any('/rewinding/orders/setOrderCompleted', [ApiController::class, 'setRewindingOrderCompleted']);
        Route::any('/rewinding/orders/getOrderByRewindingOrderId', [ApiController::class, 'getOrderByRewindingOrderId']);
        Route::any('/rewinding/orders/searchOrder', [ApiController::class, 'getRewindingOrdersSearch']);
        Route::any('/rewinding/orders/makeItComplete', [ApiController::class, 'rewindingOrderMakeItComplete']);
        Route::any('/rewinding/orders/rewindingOrderHistoryDelete', [ApiController::class, 'rewindingOrderHistoryDelete']);

        Route::any('/packing/orders/getOrdersByStatus', [ApiController::class, 'getPackingOrdersByStatus']);
        Route::any('/packing/orders/getOrdersByUser', [ApiController::class, 'getPackingOrdersByUser']);
        Route::any('/packing/orders/setOrderCompleted', [ApiController::class, 'setPackingOrderCompleted']);
        Route::any('/packing/orders/getOrderByPackingOrderId', [ApiController::class, 'getOrderByPackingOrderId']);
        Route::any('/packing/orders/searchOrder', [ApiController::class, 'getPackingOrdersSearch']);
        Route::any('/packing/orders/makeItComplete', [ApiController::class, 'packingOrderMakeItComplete']);
        Route::any('/packing/orders/packingOrderHistoryDelete', [ApiController::class, 'packingOrderHistoryDelete']);

        Route::any('/stitching/orders/getOrdersByStatus', [ApiController::class, 'getStitchingOrdersByStatus']);
        Route::any('/stitching/orders/getOrdersByUser', [ApiController::class, 'getStitchingOrdersByUser']);
        Route::any('/stitching/orders/setOrderCompleted', [ApiController::class, 'setStitchingOrderCompleted']);
        Route::any('/stitching/orders/getOrderByStitchingOrderId', [ApiController::class, 'getOrderByStitchingOrderId']);
        Route::any('/stitching/orders/searchOrder', [ApiController::class, 'getStitchingOrdersSearch']);
        Route::any('/stitching/orders/makeItComplete', [ApiController::class, 'stitchingOrderMakeItComplete']);
        Route::any('/stitching/orders/stitchingOrderHistoryDelete', [ApiController::class, 'stitchingOrderHistoryDelete']);



        Route::any('getMaterialCategories', [ApiController::class, 'getMaterialCategories']);
        Route::any('getMaterialSubCategoriesByCategoryId', [ApiController::class, 'getMaterialSubCategoriesByCategoryId']);
        Route::any('getMaterialByCategoryAndSubCategoryId', [ApiController::class, 'getMaterialByCategoryAndSubCategoryId']);
        Route::any('getUnitsByMaterialId', [ApiController::class, 'getUnitsByMaterialId']);
        Route::any('materialin/store', [ApiController::class, 'storeMaterialIn']);
        Route::any('materialout/store', [ApiController::class, 'storeMaterialOut']);
        Route::any('/categories-with-stock', [ApiController::class, 'categoriesWithStock']);
        Route::any('/sub-categories-with-stock', [ApiController::class, 'subCategoriesWithStock']);
        Route::any('/materials-with-stock', [ApiController::class, 'materialsWithStock']);
        Route::any('get-transport', [ApiController::class, 'getTransport']);
        Route::any('materialin/get', [ApiController::class, 'getMaterialIn']);
        Route::any('materialout/get', [ApiController::class, 'getMaterialOut']);

        //changed apis according to new flow end

    // Route::any('rewinding/orders/getOrdersByUser', [ApiController::class, 'getRewindingOrdersByUser']);
    //Route::any('/rewinding/orders/setOrderCompleted', [ApiController::class, 'setRewindingOrderCompleted']);
    // Route::any('/rewinding/orders/getOrdersByStatus', [ApiController::class, 'getRewindingOrdersByStatus']);
    Route::any('/rewinding/orders/setProductionDetails', [ApiController::class, 'setRewindingProductionDetails']);

    // Route::any('/extruder/orders/getOrdersByUser', [ApiController::class, 'getExtruderOrdersByUser']);
    // Route::any('/extruder/orders/getOrdersByStatus', [ApiController::class, 'getExtruderOrdersByStatus']);
    //Route::any('/extruder/orders/setOrderCompleted', [ApiController::class, 'setExtruderOrderCompleted']);
    Route::any('/extruder/orders/getOrderHistoryById', [ApiController::class, 'getExtruderOrderHistoryById']);


    // Route::any('/packing/orders/getOrdersByUser', [ApiController::class, 'getPackingOrdersByUser']);
    // Route::any('/packing/orders/getOrdersByStatus', [ApiController::class, 'getPackingOrdersByStatus']);
    // Route::any('/packing/orders/setOrderCompleted', [ApiController::class, 'setPackingOrderCompleted']);

    // Route::any('/stitching/orders/getOrdersByUser', [ApiController::class, 'getStitchingOrdersByUser']);
    // Route::any('/stitching/orders/setOrderCompleted', [ApiController::class, 'setStitchingOrderCompleted']);
    // Route::any('/stitching/orders/getOrdersByStatus', [ApiController::class, 'getStitchingOrdersByStatus']);

    // Route::any('/lamination/orders/getOrdersByUser', [ApiController::class, 'getLaminationOrdersByUser']);
    //Route::any('/lamination/orders/setOrderCompleted', [ApiController::class, 'setLaminationOrderCompleted']);
    //Route::any('/lamination/orders/getOrdersByStatus', [ApiController::class, 'getLaminationOrdersByStatus']);

    Route::any('get-order-history-by-id', [ApiController::class, 'getOrderHistoryById']);
    Route::any('get-user-details', [ApiController::class, 'getUserDetails']);



    Route::any('signUp', [ApiController::class, 'signUp']);
    Route::any('delete-account', [ApiController::class, 'deleteAccount']);
    Route::any('force-update', [ApiController::class, 'forceUpdate']);
    


});
});