<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\{
    AuthenticatedSessionController,
    ConfirmablePasswordController,
    EmailVerificationNotificationController,
    EmailVerificationPromptController,
    NewPasswordController,
    PasswordController,
    PasswordResetLinkController,
    RegisteredUserController,
    VerifyEmailController,
};
use App\Http\Controllers\Admin\{
    BrandController,
    CategoryController,
    ChildCategoryController,
    CouponController,
    DashboardController,
    PageSettingController,
    PasswrodChangeController,
    PickupPointController,
    ProductController,
    SettingController,
    SeoSettingController,
    SmtpSettingController,
    SubCategoryController,
    WareHouseController
};

// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(['auth:admin', 'custom_verified'])->name('admin.dashboard');

Route::middleware(['auth:admin', 'custom_verified'])->prefix('admin')->name('admin.')->group(function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('password-change', [PasswrodChangeController::class, 'index'])->name('password.index');
    Route::post('password-change', [PasswrodChangeController::class, 'store'])->name('password.change.store');
    
});

// Category
Route::middleware(['auth:admin', 'custom_verified'])->prefix('category')->group(function(){  
    Route::resource('categories', CategoryController::class)->except(['show', 'create']);  
    Route::resource('subcategory', SubCategoryController::class)->except(['show', 'create']);  
    Route::resource('childcategory', ChildCategoryController::class)->except(['show', 'create']);
    Route::resource('brands', BrandController::class)->except(['show', 'create']);
    Route::resource('warehouse', WareHouseController::class)->except(['show', 'create']);
});

Route::middleware(['auth:admin', 'custom_verified'])->group(function(){
    Route::resource('products', ProductController::class);
    Route::get('get-child-category/{id}', [ProductController::class, 'childcategory']);

    Route::get('featured_deactive/{id}', [ProductController::class, 'featured_deactive']);
    Route::get('featured_active/{id}', [ProductController::class, 'featured_active']);

    Route::get('deal_deactive/{id}', [ProductController::class, 'deal_deactive']);
    Route::get('deal_active/{id}', [ProductController::class, 'deal_active']);

    Route::get('status_deactive/{id}', [ProductController::class, 'status_deactive']);
    Route::get('status_active/{id}', [ProductController::class, 'status_active']);

    Route::get('slider_deactive/{id}', [ProductController::class, 'slider_deactive']);
    Route::get('slider_active/{id}', [ProductController::class, 'slider_active']);

    Route::get('trendy_deactive/{id}', [ProductController::class, 'trendy_deactive']);
    Route::get('trendy_active/{id}', [ProductController::class, 'trendy_active']);
});



// Setting
Route::middleware(['auth:admin', 'custom_verified'])->prefix('setting')->group(function(){
    Route::get('/', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/store/{id}', [SettingController::class, 'store'])->name('setting.store');

    Route::prefix('seo')->group(function(){
        Route::get('/', [SeoSettingController::class, 'index'])->name('seo.index');
        Route::post('/store/{id}', [SeoSettingController::class, 'store'])->name('seo.store');
    });

    Route::prefix('smtp')->group(function(){
        Route::get('/', [SmtpSettingController::class, 'index'])->name('smtp.index');
        Route::post('/store/{id}', [SmtpSettingController::class, 'store'])->name('smtp.store');
    });

    Route::resource('pages', PageSettingController::class); 
});

// Offer
Route::middleware(['auth:admin', 'custom_verified'])->prefix('offer')->group(function(){  
    Route::resource('coupon', CouponController::class)->except(['show', 'create']);
});

// Pickup Point
Route::middleware(['auth:admin', 'custom_verified'])->prefix('pickup-point')->group(function(){  
    Route::resource('pickuppoint', PickupPointController::class)->except(['show', 'create']);   
});



Route::middleware('guest:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
