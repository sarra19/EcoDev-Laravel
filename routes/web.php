<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeliveryAgenceController;

use App\Http\Controllers\SpecialServiceController;

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
    return view('BackOffice.page-login');
})->name('page-login');

// route FrontOffice

Route::get('/indexFront', function () {
    return view('FrontOffice.index');
})->name('index');

Route::get('/team', function () {
    return view('FrontOffice.team');
})->name('team');
Route::get('/services', function () {
    return view('FrontOffice.services');
})->name('services');

Route::get('/faq', function () {
    return view('FrontOffice.faq');
})->name('faq');

Route::get('/detail', function () {
    return view('FrontOffice.detail');
})->name('detail');

Route::get('/contact', function () {
    return view('FrontOffice.contact');
})->name('contact');

Route::get('/blog', function () {
    return view('FrontOffice.blog');
})->name('blog');

Route::get('/blog_detail', function () {
    return view('FrontOffice.blog_detail');
})->name('blog_detail');

Route::get('/about', function () {
    return view('FrontOffice.about');
})->name('about');

// route BackOffice

Route::get('/dashboard', function () {
    return view('BackOffice.dashboard');
})->name('dashboard');

Route::get('/widgets', function () {
    return view('BackOffice.widgets');
})->name('widgets');

Route::get('/ui-cards', function () {
    return view('BackOffice.ui-cards');
})->name('ui-cards');

Route::get('/table-data-table', function () {
    return view('BackOffice.table-data-table');
})->name('table-data-table');

Route::get('/table-basic', function () {
    return view('BackOffice.table-basic');
})->name('table-basic');

Route::get('/page-user', function () {
    return view('BackOffice.page-user');
})->name('page-user');

Route::get('/page-mailbox', function () {
    return view('BackOffice.page-mailbox');
})->name('page-mailbox');

Route::get('/page-login', function () {
    return view('BackOffice.page-login');
})->name('page-login');

Route::get('/page-lockscreen', function () {
    return view('BackOffice.page-lockscreen');
})->name('page-lockscreen');

Route::get('/page-invoice', function () {
    return view('BackOffice.page-invoice');
})->name('page-invoice');

Route::get('/page-error', function () {
    return view('BackOffice.page-error');
})->name('page-error');

Route::get('/indexBack', function () {
    return view('BackOffice.index');
})->name('indexBack');

Route::get('/form-samples', function () {
    return view('BackOffice.form-samples');
})->name('form-samples');

Route::get('/form-components', function () {
    return view('BackOffice.form-components');
})->name('form-components');

Route::get('/docs', function () {
    return view('BackOffice.docs');
})->name('docs');

Route::get('/bootstrap-components', function () {
    return view('BackOffice.bootstrap-components');
})->name('bootstrap-components');

Route::get('/blank-page', function () {
    return view('BackOffice.blank-page');
})->name('blank-page');



// Route Backoffice pour l'affichage des agences de livraison
Route::prefix('delivery-agences')->group(function () {
    Route::get('/', [DeliveryAgenceController::class, 'index'])->name('delivery-agences.index');
    Route::get('/create', [DeliveryAgenceController::class, 'create'])->name('delivery-agences.create');
    Route::post('/', [DeliveryAgenceController::class, 'store'])->name('delivery-agences.store');

    // Route::post('/special-services/{agencyId}/store', [SpecialServiceController::class, 'store'])->name('special-services.store');

    Route::get('/{id}/services', [DeliveryAgenceController::class, 'showServices'])->name('delivery-agences.services');
    Route::get('/{agencyId}/special-services', [SpecialServiceController::class, 'index'])->name('special-services.index'); // Route manquante ajoutée ici
    Route::get('/{agencyId}/special-services/create', [SpecialServiceController::class, 'create'])->name('special-services.create');
    Route::post('/{agencyId}/special-services', [SpecialServiceController::class, 'store'])->name('special-services.store');
    Route::get('/{agencyId}/special-services/{id}/edit', [SpecialServiceController::class, 'edit'])->name('special-services.edit');
    Route::put('/{agencyId}/special-services/{id}', [SpecialServiceController::class, 'update'])->name('special-services.update');
    Route::delete('/{agencyId}/special-services/{id}', [SpecialServiceController::class, 'destroy'])->name('special-services.destroy');

    Route::get('/{id}', [DeliveryAgenceController::class, 'show'])->name('delivery-agences.show');
    Route::get('/{id}/edit', [DeliveryAgenceController::class, 'edit'])->name('delivery-agences.edit');
    Route::put('/{id}', [DeliveryAgenceController::class, 'update'])->name('delivery-agences.update');
    Route::delete('/{id}', [DeliveryAgenceController::class, 'destroy'])->name('delivery-agences.destroy');
});

// Route FrontOffice pour l'affichage des agences de livraison
Route::prefix('front/delivery-agences')->group(function () {
    Route::get('/', [DeliveryAgenceController::class, 'indexFrontend'])->name('front.deliveryagence.index');
    Route::get('/{id}', [DeliveryAgenceController::class, 'showFrontend'])->name('front.deliveryagence.show');
// Route FrontOffice pour l'affichage des services spéciaux d'une agence de livraison
Route::get('/{agencyId}/special-services', [DeliveryAgenceController::class, 'showServicesFront'])->name('front.deliveryagence.special-services'); // Ajout de cette route






});



