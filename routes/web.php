<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the- RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Index
Route::group(['prefix' => '/', 'as' => 'index.'], function() {
    Route::get('/', [\App\Http\Controllers\Index\IndexController::class, 'index'])->name('index');
    Route::get('/FAQ', [\App\Http\Controllers\Index\IndexController::class, 'faq'])->name('faq');
    Route::get('/about', [\App\Http\Controllers\Index\IndexController::class, 'about'])->name('about');
    Route::get('/contactus', [\App\Http\Controllers\Index\IndexController::class, 'contactus'])->name('contactus');
    Route::get('/terms-and-services', [\App\Http\Controllers\Index\IndexController::class, 'termsAndServices'])->name('termsAndServices');
});

//Auth
Auth::routes();

//User
Route::group(['as' => 'user.', 'middleware' => ['auth', 'user']], function() {
    //Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\User\UserController::class, 'index'])->name('dashboard');
});

//User
Route::group(['as' => 'manager.', 'middleware' => ['auth', 'manager']], function() {
    //Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\Manager\ManagerController::class, 'index'])->name('dashboard');
});

//Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function() {
    //Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('dashboard');
    //Categories
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::post('/categories/save-nested-categories', [\App\Http\Controllers\Admin\CategoryController::class, 'saveNestedCategories'])->name('categories.saveNestedCategories');
    //Tags
    Route::resource('tags', \App\Http\Controllers\Admin\TagController::class);
    Route::delete('/tags/destroy/all', [\App\Http\Controllers\Admin\TagController::class, 'destroyAll'])->name('tags.destroyAll');
    //Pages
    Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
    Route::post('/pages/confirm/{id}', [\App\Http\Controllers\Admin\PageController::class, 'confirm'])->name('pages.confirm');
    Route::delete('/pages/destroy/all', [\App\Http\Controllers\Admin\PageController::class, 'destroyAll'])->name('pages.destroyAll');
    //Mags
    Route::resource('mags', \App\Http\Controllers\Admin\MagController::class);
    Route::post('/mags/confirm/{id}', [\App\Http\Controllers\Admin\MagController::class, 'confirm'])->name('mags.confirm');
    Route::delete('/mags/destroy/all', [\App\Http\Controllers\Admin\MagController::class, 'destroyAll'])->name('mags.destroyAll');
    //FAQ
    Route::resource('faqs', \App\Http\Controllers\Admin\FAQController::class);
    Route::delete('/faqs/destroy/all', [\App\Http\Controllers\Admin\FAQController::class, 'destroyAll'])->name('faqs.destroyAll');
    //Users
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::post('/users/promote/{id}', [\App\Http\Controllers\Admin\UserController::class, 'promote'])->name('users.promote');
    Route::delete('/users/destroy/all', [\App\Http\Controllers\Admin\UserController::class, 'destroyAll'])->name('users.destroyAll');
    //Roles & Permissions
    Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
    //Widgets
    Route::group(['as' => 'widgets.', 'prefix' => 'widgets'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\WidgetController::class , 'index'])->name('index');
        Route::get('/mobile', [\App\Http\Controllers\Admin\WidgetController::class , 'mobileIndex'])->name('mobile.index');
        Route::post('/change', [\App\Http\Controllers\Admin\WidgetController::class , 'change'])->name('change');
        Route::get('/create', [\App\Http\Controllers\Admin\WidgetController::class , 'create'])->name('create');
        Route::post('/store', [\App\Http\Controllers\Admin\WidgetController::class , 'store'])->name('store');
        Route::get('/{widget}/edit', [\App\Http\Controllers\Admin\WidgetController::class , 'edit'])->name('edit');
        Route::put('/{widget}/edit', [\App\Http\Controllers\Admin\WidgetController::class , 'update'])->name('update');
        Route::delete('/{widget}/delete', [\App\Http\Controllers\Admin\WidgetController::class , 'destroy'])->name('destroy');
    });
    //Gallery
    Route::group(['as' => 'galleries.', 'prefix' => 'galleries'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\GalleryController::class, 'index'])->name('index');
        Route::get('/getImages', [\App\Http\Controllers\Admin\GalleryController::class, 'getImages'])->name('getImages');
        Route::get('/getLastImage', [\App\Http\Controllers\Admin\GalleryController::class, 'getLastImage'])->name('getLastImage');
        //Upload Image
        Route::post('/upload', [\App\Http\Controllers\Admin\GalleryController::class, 'upload'])->name('upload');
        //Destroy Image
        Route::delete('/{id}/delete', [\App\Http\Controllers\Admin\GalleryController::class, 'destroy'])->name('destroy');
        Route::delete('/destroy/all', [\App\Http\Controllers\Admin\GalleryController::class, 'destroyAll'])->name('destroyAll');
        //UploadFile
        Route::post('/upload/file', [\App\Http\Controllers\Admin\GalleryController::class, 'uploadFile'])->name('uploadFile');
        //Destroy File
        Route::delete('/{id}/delete-file', [\App\Http\Controllers\Admin\GalleryController::class, 'destroyFile'])->name('destroyFile');
        Route::delete('/destroy/all/file', [\App\Http\Controllers\Admin\GalleryController::class, 'destroyAllFile'])->name('destroyAllFile');
        //CKEditor Upload Method
        Route::post('/ckeditor/upload', [\App\Http\Controllers\Admin\GalleryController::class, 'ckeditorUpload'])->name('ckeditorUpload');
    });
    //Settings
    Route::group(['as' => 'settings.', 'prefix' => 'settings'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('index');
        Route::post('/site', [\App\Http\Controllers\Admin\SettingsController::class, 'siteUpdate'])->name('siteUpdate');
        Route::post('/seo', [\App\Http\Controllers\Admin\SettingsController::class, 'seoUpdate'])->name('seoUpdate');
        Route::post('/links', [\App\Http\Controllers\Admin\LinkController::class, 'store'])->name('links.store');
        Route::delete('/links/{id}', [\App\Http\Controllers\Admin\LinkController::class, 'destroy'])->name('links.destroy');
        Route::post('/payment', [\App\Http\Controllers\Admin\SettingsController::class, 'paymentUpdate'])->name('paymentUpdate');
        Route::post('/sms', [\App\Http\Controllers\Admin\SettingsController::class, 'smsUpdate'])->name('smsUpdate');
        Route::post('/socialMedia', [\App\Http\Controllers\Admin\SettingsController::class, 'socialMediaStore'])->name('socialMediaStore');
        Route::patch('/socialMedia/{id}', [\App\Http\Controllers\Admin\SettingsController::class, 'socialMediaUpdate'])->name('socialMediaUpdate');
        Route::delete('/socialMedia/{id}', [\App\Http\Controllers\Admin\SettingsController::class, 'socialMediaDestroy'])->name('socialMediaDestroy');
    });
});
