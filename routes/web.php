<?php

//use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ACL\PermissionController;
use App\Http\Controllers\Admin\ACL\PermissionProfileController;
use App\Http\Controllers\Admin\ACL\PlanProfileController;
use App\Http\Controllers\Admin\ACL\ProfileController;
use App\Http\Controllers\Admin\DetailPlanController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Site\SiteController;

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

/**
 * Site Routes
 */
Route::get('/plan/{url}',[SiteController::class,'plan'])->name('plan.subscription');
Route::get('/', [SiteController::class, 'index'])->name('site.home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {

        /**
         * Plan x Profile
         */
        Route::get('plans/{id}/profile/{idPermission}/detach', [PlanProfileController::class, 'detachPlanProfile'])->name('plans.profile.detach');
        Route::post('plans/{id}/profiles', [PlanProfileController::class, 'attachProfilesProfile'])->name('plans.profiles.attach');
        Route::any('plans/{id}/profiles/create', [PlanProfileController::class, 'profilesAvailable'])->name('plans.profiles.available');
        Route::get('plans/{id}/profiles', [PlanProfileController::class, 'profiles'])->name('plans.profiles');
        Route::get('plans/{id}/plans', [PlanProfileController::class, 'plans'])->name('profiles.plans');





        /**
         * Permission x Profile
         */
        Route::get('profiles/{id}/permissions/{idPermission}/detach', [PermissionProfileController::class, 'detachPermissionProfile'])->name('profiles.permissions.detach');
        Route::post('profiles/{id}/permissions', [PermissionProfileController::class, 'attachPermissionsProfile'])->name('profiles.permissions.attach');
        Route::any('profiles/{id}/permissions/create', [PermissionProfileController::class, 'permissionsAvailable'])->name('profiles.permissions.available');
        Route::get('profiles/{id}/permissions', [PermissionProfileController::class, 'permissions'])->name('profiles.permissions');
        Route::get('profiles/{id}/profile', [PermissionProfileController::class, 'profiles'])->name('permissions.profiles');



        /**
         * Routes Permission
         */

        Route::any('permissions/search', [PermissionController::class, 'search'])->name('permissions.search');
        Route::resource('permissions', PermissionController::class);



        /**
         * Routes Profiles
         */
        Route::any('profiles/search', [ProfileController::class, 'search'])->name('profiles.search');
        Route::resource('profiles', ProfileController::class);


        /**
         * Route Details Plan
         */
        Route::get('plans/{url}/details/create', [DetailPlanController::class, 'create'])->name('details.plan.create');
        Route::delete('plans/{url}/details/{idDetail}', [DetailPlanController::class, 'destroy'])->name('details.plan.destroy');
        Route::get('plans/{url}/details/{idDetail}', [DetailPlanController::class, 'show'])->name('details.plan.show');
        Route::put('plans/{url}/details/{idDetail}', [DetailPlanController::class, 'update'])->name('details.plan.update');
        Route::get('plans/{url}/details/{idDetail}/edit', [DetailPlanController::class, 'edit'])->name('details.plan.edit');
        Route::post('plans/{url}/details', [DetailPlanController::class, 'store'])->name('details.plan.store');
        Route::get('plans/{url}/details', [DetailPlanController::class, 'index'])->name('details.plan.index');





        /**
         * Route Plans
         */

        Route::get('plans/create', [PlanController::class, 'create'])->name('plans.create');
        Route::put('plans/{url}', [PlanController::class, 'update'])->name('plans.update');
        Route::get('plans/{url}/edit', [PlanController::class, 'edit'])->name('plans.edit');
        Route::any('plans/search', [PlanController::class, 'search'])->name('plans.search');
        Route::get('plans/{url}', [PlanController::class, 'show'])->name('plans.show');
        Route::post('plans', [PlanController::class, 'store'])->name('plans.store');
        Route::get('plans', [PlanController::class, 'index'])->name('plans.index');
        Route::delete('plans/{url}', [PlanController::class, 'destroy'])->name('plans.destroy');

        /**
         * Home Dashboard
         */
        Route::get('/', [PlanController::class, 'index'])->name('admin.index');
    });







require __DIR__ . '/auth.php';
