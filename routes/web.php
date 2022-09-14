<?php

use App\Http\Controllers\Backend\AdminLoginController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\DashBoardController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ManageOrderController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\OfferController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Website\FooterContentController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\UserController;
use Illuminate\Support\Facades\Route;

/////////////////////////// Website ///////////////////////////
Route::get('/', [HomeController::class, 'home'])->name('website.home');

Route::group(['prefix' => 'website'], function () {

    // search
    Route::post('/user/search/product', [HomeController::class, 'search'])->name('website.search');

    // all product
    Route::get('/view/all/product', [HomeController::class, 'allProduct'])->name('website.all.product');
    Route::get('/view/shorting/low/price', [HomeController::class, 'lowPrice'])->name('website.shorting.low.price');
    Route::get('/view/shorting/mid/price', [HomeController::class, 'midPrice'])->name('website.shorting.mid.price');
    Route::get('/view/shorting/high/price', [HomeController::class, 'highPrice'])->name('website.shorting.high.price');

    // sub-category product
    Route::get('/show/sub/category/product/{id}', [HomeController::class, 'subCategoryProduct'])->name('show.sub.category.product');

    // category product
    Route::get('/show/category/product/{id}', [HomeController::class, 'categoryProduct'])->name('show.category.product');

    // offers
    Route::get('/offers', [HomeController::class, 'offers'])->name('website.offers');
    Route::get('/offer/details/{id}', [HomeController::class, 'offerDetails'])->name('website.offer.details');

    // laptop deals
    Route::get('/laptop/deals', [HomeController::class, 'laptopDeals'])->name('website.laptop.deals');
    Route::get('/laptop/deals/details/{id}', [HomeController::class, 'laptopDealsDetails'])->name('website.deals.details');

    // login
    Route::get('/login/form', [UserController::class, 'loginForm'])->name('user.login.form');
    Route::post('/user/do/login', [UserController::class, 'doLogin'])->name('user.do.login');
    Route::get('/check/banned', [UserController::class, 'checkBanned'])->name('website.check.banned');

    Route::post('/user/do/registration', [UserController::class, 'doRegistration'])->name('user.do.registration');
    Route::get('/user/logout', [UserController::class, 'logout'])->name('user.logout');

    // user profile
    Route::get('/user/profile/{id}', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/user/edit/profile/{id}', [UserController::class, 'edit'])->name('user.edit.profile');
    Route::post('/user/update/profile/{id}', [UserController::class, 'updateProfile'])->name('user.update.profile');

    // product details
    Route::get('/product/details/{id}', [HomeController::class, 'productDetails'])->name('website.product.details');

    // review
    Route::get('/add/review/{id}', [HomeController::class, 'review'])->name('user.add.review');
    Route::post('/user/submit/review/{id}', [HomeController::class, 'submitReview'])->name('user.sumbit.review');

    // cancel order
    Route::get('/user/cancel/order/{id}', [HomeController::class, 'cancelOrder'])->name('user.cancel.order');

    // supplier delivered product
    Route::get('/supplier/delivered/product/{id}', [HomeController::class, 'supplierDelivered'])->name('supplier.delivered.product');

    Route::group(['middleware' => 'check_customer'], function () {
        // add to cart
        Route::post('/add/to/cart/{id}', [CartController::class, 'cart'])->name('add.to.cart');
        Route::get('/user/view/cart', [CartController::class, 'viewCart'])->name('user.view.cart');
        Route::get('/clear/cart', [CartController::class, 'clearCart'])->name('clear.cart');
        Route::get('/user/remove/cart/{id}', [CartController::class, 'remove'])->name('user.remove.cart');
        Route::get('/user/checkout', [CartController::class, 'checkout'])->name('user.checkout');
        Route::get('/user/view/order/list/{id}', [CartController::class, 'orderList'])->name('user.view.order.list');
    });

    // footer
    Route::get('/about-us', [FooterContentController::class, 'aboutUs'])->name('website.about.us');
    Route::get('/contact-us', [FooterContentController::class, 'contactUs'])->name('website.contact.us');
    Route::get('/user/refund/policy', [FooterContentController::class, 'refundPolicy'])->name('user.refund.policy');
    Route::get('/user/terms/and/conditions', [FooterContentController::class, 'termsConditions'])->name('user.terms.&.conditions');
});



/////////////////////////// Admin part ///////////////////////////
Route::group(['prefix' => 'admin'], function () {

    // admin login
    Route::get('/login', [AdminLoginController::class, 'form'])->name('admin.login.form');
    Route::post('/do/login', [AdminLoginController::class, 'doLogin'])->name('admin.do.login');
    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    Route::group(['middleware' => ['auth', 'check_admin']], function () {

        // dashboard
        Route::get('/dashboard', [DashBoardController::class, 'dashboard'])->name('admin.dashboard');

        /////////////////////////// Product Part ///////////////////////////
        // Category
        Route::get('/manage/category', [CategoryController::class, 'manageCategory'])->name('admin.manage.category');
        Route::get('/add/category', [CategoryController::class, 'addCategory'])->name('admin.add.category');
        Route::post('/store/category', [CategoryController::class, 'store'])->name('admin.store.category');
        Route::get('/edit/category/{id}', [CategoryController::class, 'editCategory'])->name('admin.edit.category');
        Route::post('/update/category/{id}', [CategoryController::class, 'update'])->name('admin.update.category');
        Route::get('/delete/category/{id}', [CategoryController::class, 'delete'])->name('admin.delete.category');
        Route::get('/view/category/image/{id}', [CategoryController::class, 'view'])->name('admin.view.category');
        Route::post('/change/category/image/{id}', [CategoryController::class, 'change'])->name('admin.change.category.image');

        // Sub-Category
        Route::get('/manage/subCategory', [SubCategoryController::class, 'manageSubCategory'])->name('admin.manage.subCategory');
        Route::get('/add/subCategory', [SubCategoryController::class, 'addSubCategory'])->name('admin.add.subCategory');
        Route::post('/store/subCategory', [SubCategoryController::class, 'store'])->name('admin.store.subCategory');
        Route::get('/edit/subCategory/{id}', [SubCategoryController::class, 'edit'])->name('admin.edit.subCategory');
        Route::post('/update/subCategory/{id}', [SubCategoryController::class, 'update'])->name('admin.update.subCategory');
        Route::get('/delete/subCategory/{id}', [SubCategoryController::class, 'delete'])->name('admin.delete.subCategory');

        // Product
        Route::get('/manage/product', [ProductController::class, 'manageProduct'])->name('admin.manage.product');
        Route::get('/add/product/', [ProductController::class, 'add'])->name('admin.add.product');
        Route::post('/store/product', [ProductController::class, 'store'])->name('admin.store.product');
        Route::get('/edit/product/{id}', [ProductController::class, 'edit'])->name('admin.edit.product');
        Route::post('/update/product/{id}', [ProductController::class, 'update'])->name('admin.update.product');
        Route::get('/delete/product/{id}', [ProductController::class, 'delete'])->name('admin.delete.product');
        Route::get('/view/product/image/{id}', [ProductController::class, 'view'])->name('admin.view.product');

        // Offer
        Route::get('/manage/offer', [OfferController::class, 'manageOffer'])->name('admin.manage.offer');
        Route::get('/add/offer', [OfferController::class, 'add'])->name('admin.add.offer');
        Route::post('/store/offer', [OfferController::class, 'store'])->name('admin.store.offer');
        Route::get('/view/offer/{id}', [OfferController::class, 'viewOffer'])->name('admin.view.offer');
        Route::post('/change/offer/image/{id}', [OfferController::class, 'change'])->name('admin.change.offer.image');
        Route::get('/edit/offer/{id}', [OfferController::class, 'edit'])->name('admin.edit.offer');
        Route::post('/update/offer/{id}', [OfferController::class, 'update'])->name('admin.update.offer');
        Route::get('/delete/offer/{id}', [OfferController::class, 'delete'])->name('admin.delete.offer');


        /////////////////////////// Table part ///////////////////////////
        // Order List
        Route::get('/manage/order', [ManageOrderController::class, 'manageOrder'])->name('admin.manage.order');
        Route::get('/accept/order/{id}', [ManageOrderController::class, 'acceptOrder'])->name('admin.accept.order');
        Route::get('/reject/order/{id}', [ManageOrderController::class, 'rejectOrder'])->name('admin.reject.order');

        // Customer List
        Route::get('/manage/customer', [CustomerController::class, 'manageCustomer'])->name('admin.manage.customer');
        Route::get('/ban/customer/{id}', [CustomerController::class, 'banCustomer'])->name('admin.ban.customer');
        Route::get('/un-ban/customer/{id}', [CustomerController::class, 'unBanCustomer'])->name('admin.un.ban.customer');

        // Company Report
        Route::get('/view/report', [ReportController::class, 'viewReport'])->name('admin.view.report');
        Route::post('/search/report', [ReportController::class, 'searchReport'])->name('admin.search.report');

        // supplier
        Route::get('/manage/supplier', [SupplierController::class, 'manageSupplier'])->name('admin.manage.supplier');
        Route::get('/add/supplier', [SupplierController::class, 'add'])->name('admin.add.supplier');
        Route::post('/store/supplier', [SupplierController::class, 'store'])->name('admin.store.supplier');
        Route::get('/edit/supplier/{id}', [SupplierController::class, 'edit'])->name('admin.edit.supplier');
        Route::post('/update/supplier/{id}', [SupplierController::class, 'update'])->name('admin.update.supplier');
        Route::get('/delete/supplier/{id}', [SupplierController::class, 'delete'])->name('admin.delete.supplier');
    });
});
