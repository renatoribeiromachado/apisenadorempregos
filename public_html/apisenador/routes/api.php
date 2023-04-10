<?php
use App\Http\Controllers\Auth\{
    AuthApiController
};
use App\Http\Controllers\Api\{
    ConfigController,
    BannerController,
    NoticieController,
    ServiceController,
    LegislationController,
    EmailController
};

//Route::group([
//    'namespace' => 'Api'
//], function () {

//    Route::get('/categories', [CategoryController::class, 'index']);
//    Route::post('/categories', [CategoryController::class, 'store']);
//    Route::put('/categories/{id}', [CategoryController::class, 'update']);
//    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
//    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    
    Route::post('/auth', [AuthApiController::class, 'authenticate']);
    Route::apiResource('/configs', ConfigController::class);
    Route::apiResource('/banners', BannerController::class);
    Route::apiResource('/noticies', NoticieController::class);
    Route::apiResource('/services', ServiceController::class);
    Route::apiResource('/legislations', LegislationController::class);
   
    Route::post('/sendEmail', [EmailController::class, 'index']);
//});
