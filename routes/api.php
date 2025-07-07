<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', [\App\Http\Controllers\Auth\AuthController::class, 'login']);


Route::group(['middleware' => ['jwt']], function () {
    Route::post('logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout']);
    Route::post('refresh', [\App\Http\Controllers\Auth\AuthController::class, 'refresh']);
    Route::post('me', [\App\Http\Controllers\Auth\AuthController::class, 'me']);
    Route::get('app-supporting-data', [\App\Http\Controllers\Common\HelperController::class, 'appSupportingData']);
});


Route::group(['middleware' => ['jwt:api']], function () {


    //Home Dashboard
    Route::get('dashboard-data',[\App\Http\Controllers\IndexPageController::class,'index']);
    Route::get('event-schedule-data',[\App\Http\Controllers\EventScheduleController::class,'index']);
    Route::post('store-event-feedback',[\App\Http\Controllers\EventScheduleController::class,'storeEventFeedback']);
    Route::get('room-hotel-data',[\App\Http\Controllers\HotelRoomController::class,'index']);
    Route::get('helplines',[\App\Http\Controllers\CommonHelperController::class,'index']);
    Route::get('get-award-gallery-index',[\App\Http\Controllers\PhotoController::class,'awardGalleryIndex']);
    Route::get('get-award-gallery-details/{id}',[\App\Http\Controllers\PhotoController::class,'awardGalleryDetails']);
    Route::get('get-photo-gallery-index',[\App\Http\Controllers\PhotoController::class,'galleryIndex']);
    Route::get('get-photo-gallery-details/{id}',[\App\Http\Controllers\PhotoController::class,'photoGalleryDetails']);


    // ADMIN USERS
    Route::group(['prefix' => 'user'],function () {
        Route::post('list', [\App\Http\Controllers\Admin\Users\AdminUserController::class, 'index']);
        //User Modal Data
        Route::get('modal',[\App\Http\Controllers\Admin\Users\AdminUserController::class,'userModalData']);
        Route::post('add', [\App\Http\Controllers\Admin\Users\AdminUserController::class, 'store']);
        Route::get('get-user-info/{UserID}',[\App\Http\Controllers\Admin\Users\AdminUserController::class,'getUserInfo']);
        Route::post('update', [\App\Http\Controllers\Admin\Users\AdminUserController::class, 'update']);
        Route::post('password-change',[\App\Http\Controllers\Common\HelperController::class,'passwordChange']);
        Route::post('check-in',[\App\Http\Controllers\Common\HelperController::class,'checkIn']);
    });

    Route::group(['prefix' => 'approval'],function () {
        Route::post('shop-list', [\App\Http\Controllers\Admin\Approval\ShopRequisitionApprovalController::class, 'index']);
        Route::post('add-reject-shop-requisition', [\App\Http\Controllers\Admin\Approval\ShopRequisitionApprovalController::class, 'approveRejectRequisition']);

    });
    //Mobile User
    Route::group(['prefix' => 'vro'],function () {

        Route::get('get-supporting-data',[\App\Http\Controllers\VRO\VROController::class,'getSupportingData']);
        Route::post('get-business-customerCode-wise-information',[\App\Http\Controllers\VRO\VROController::class,'getBusinessWiseCustomerInformation']);
        Route::post('store-shop-information',[\App\Http\Controllers\VRO\VROController::class,'storeShopInformation']);
        Route::get('show-shop-information',[\App\Http\Controllers\VRO\VROController::class,'getExistingShop']);
        Route::post('shop-edit-information',[\App\Http\Controllers\VRO\VROController::class,'updateExistingShop']);
        Route::post('assigned-vro-list',[\App\Http\Controllers\Admin\AdminVRO\AdminVroController::class,'index']);
        Route::get('sample-file-assigned-vro-list',[\App\Http\Controllers\Admin\AdminVRO\AdminVroController::class,'getDemoExcelFile']);
        Route::post('store-assigned-vro',[\App\Http\Controllers\Admin\AdminVRO\AdminVroController::class,'storeVro']);
        Route::get('get-vro-assign-list',[\App\Http\Controllers\VRO\VROController::class,'getVroAssignList']);
    });


    Route::group(['prefix' => 'reports'],function () {
        Route::post('all-shop-information',[\App\Http\Controllers\Admin\Reports\ReportController::class,'getAllShopInformation']);
        Route::get('get-shop-information/{shopId}',[\App\Http\Controllers\Admin\Reports\ReportController::class,'getSingleShopInformation']);

    });


});

