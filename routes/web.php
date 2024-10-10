<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\InformationController;
use App\Http\Controllers\Admin\SubadminController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\DataListController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\CrudController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){
     
   Route::get('/', function () {
        \Log::info('Redirecting to /admin/login');
        return redirect('/admin/login');
    });


    Route::match(['get','post'],'/login',[AdminController::class,'login']);
    Route::match(['get','post'],'/register',[AdminController::class,'register']);

    Route::group(['middleware'=>['admin']],function(){
        Route::get('dashboard',[AdminController::class,'dashboard']);
        Route::get('logout',[AdminController::class,'logout']);

        Route::match(['get','post'],'update-password',[ProfileController::class,'updatePassword']);
        Route::match(['get','post'],'update-profile',[ProfileController::class,'updateProfile']);
        Route::post('check-current-password',[ProfileController::class,'checkCurrentPassword']);

        // Information Route
        Route::get('information',[InformationController::class,'index']);
        Route::post('update-cms-page-status',[InformationController::class,'updateCmsPageStatus']);
        Route::get('create',[InformationController::class,'create']); 
        Route::match(['get','post'],'store',[InformationController::class,'store']);  
        Route::get('view/{id}',[InformationController::class,'show']);
        Route::get('edit/{id}',[InformationController::class,'edit']);
        Route::match(['get','post'],'update/{id}',[InformationController::class,'update']);
        Route::get('delete-info/{id}',[InformationController::class,'destroy']);  

        // SubAdmin Routes
        Route::get('subadmins',[SubadminController::class,'index']); 
        Route::post('update-subadmins-status',[SubadminController::class,'updateSubadminStatus']);
        Route::get('delete-subadmins/{id}',[SubadminController::class,'destroy']);
        Route::get('create-subadmins',[SubadminController::class,'create']); 
        Route::match(['get','post'],'store-subadmins',[SubadminController::class,'store']);  
        Route::get('edit-subadmins/{id}',[SubadminController::class,'edit']);
        Route::match(['get','post'],'update-subadmin/{id}',[SubadminController::class,'update']);
        Route::match(['get','post'],'update-role/{id}',[SubadminController::class,'updateRole']);

        
        // Category 
        Route::get('category',[CategoryController::class,'index']);
        Route::post('update-category-status',[CategoryController::class,'updateCategoryStatus']);
        Route::get('delete-category/{id}',[CategoryController::class,'destroy']);
        Route::get('create-category',[CategoryController::class,'create']); 
        Route::match(['get','post'],'store-category',[CategoryController::class,'store']);
        Route::get('category-view/{id}',[CategoryController::class,'show']); 
        Route::get('category-edit/{id}',[CategoryController::class,'edit']);
        Route::match(['get','post'],'update-category/{id}',[CategoryController::class,'update']);         

       // Product 
        Route::get('products',[ProductController::class,'index']);
        Route::post('update-product-status',[ProductController::class,'updateProductStatus']);
        Route::post('update-productattribute-status',[ProductController::class,'updateProductAttrStatus']);
        Route::post('update-productimage-status',[ProductController::class,'updateProductImgStatus']);
        Route::get('delete-product/{id}',[ProductController::class,'destroy']);
        Route::get('create-product',[ProductController::class,'create']); 
        Route::match(['get','post'],'store-product',[ProductController::class,'store']);
        Route::get('product-view/{id}',[ProductController::class,'show']); 
        Route::get('product-edit/{id}',[ProductController::class,'edit']);
        Route::match(['get','post'],'update-product/{id}',[ProductController::class,'update']);   

        // Brands
        Route::get('brands',[BrandController::class,'index']);
        Route::post('update-brand-status',[BrandController::class,'updateBrandStatus']);
        Route::get('delete-brand/{id}',[BrandController::class,'destroy']);
        Route::get('create-brand',[BrandController::class,'create']); 
        Route::match(['get','post'],'store-brand',[BrandController::class,'store']);
        Route::get('brand-view/{id}',[BrandController::class,'show']); 
        Route::get('brand-edit/{id}',[BrandController::class,'edit']);
        Route::match(['get','post'],'update-brand/{id}',[BrandController::class,'update']);

        // Banner For Home 
        Route::get('banners',[BannerController::class,'index']);
        Route::post('update-banner-status',[BannerController::class,'updateBannerStatus']);
        Route::get('delete-banner/{id}',[BannerController::class,'destroy']);
        Route::get('banner-view/{id}',[BannerController::class,'show']);
        Route::get('create-banner',[BannerController::class,'create']); 
        Route::match(['get','post'],'store-banner',[BannerController::class,'store']);
        Route::get('banner-edit/{id}',[BannerController::class,'edit']);
        Route::match(['get','post'],'update-banner/{id}',[BannerController::class,'update']);

        // DataList  
        Route::get('data-list',[DataListController::class,'index']);
        Route::post('update-data-list-status',[DataListController::class,'updateDataListStatus']);
        Route::get('delete-data-list/{id}',[DataListController::class,'destroy']);
        Route::get('data-list-view/{id}',[DataListController::class,'show']);
        Route::get('create-data-list',[DataListController::class,'create']); 
        Route::match(['get','post'],'store-data-list',[DataListController::class,'store']);
        Route::get('data-list-edit/{id}',[DataListController::class,'edit']);
        Route::match(['get','post'],'update-data-list/{id}',[DataListController::class,'update']);


        // General Settings
        Route::get('general',[GeneralSettingController::class,'index']);
        Route::post('update-general-setting-status',[GeneralSettingController::class,'updateGeneralStatus']);
        Route::get('delete-general/{id}',[GeneralSettingController::class,'destroy']);
        Route::get('create-general',[GeneralSettingController::class,'create']); 
        Route::match(['get','post'],'store-general',[GeneralSettingController::class,'store']);
        Route::match(['get','post'],'store-local',[GeneralSettingController::class,'storeLocal']);
        Route::get('general-view/{id}',[GeneralSettingController::class,'show']); 
        Route::get('general-edit/{id}',[GeneralSettingController::class,'edit']);
        Route::match(['get','post'],'update-general/{id}',[GeneralSettingController::class,'update']);
        Route::match(['get','post'],'update-local/{id}',[GeneralSettingController::class,'updateLocal']);

        // Backup and Export Data
        Route::get('export',[BackupController::class,'index']);
        Route::get('export-db',[BackupController::class,'dbExport']);

        // Dynamic Crud Module
        Route::get('crud',[CrudController::class,'index']);



    });        

});
