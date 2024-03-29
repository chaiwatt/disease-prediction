<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeminiController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProcessingController;
use App\Http\Controllers\DashboardEngageController;
use App\Http\Controllers\DashboardSymptomController;


Auth::routes();

Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('store-disease', [DashboardController::class, 'storeDisease'])->name('store-disease');
        Route::post('get-disease', [DashboardController::class, 'getDisease'])->name('get-disease');
        Route::post('update-disease', [DashboardController::class, 'updateDisease'])->name('update-disease');
        Route::get('delete-disease/{id}', [DashboardController::class, 'deleteDisease'])->name('delete-disease');
        Route::get('api-link', [DashboardController::class, 'apiLink'])->name('api-link');
        Route::group(['prefix' => 'symptom'], function () {
            Route::get('', [DashboardSymptomController::class, 'index'])->name('dashboard.symptom');
            Route::get('create', [DashboardSymptomController::class, 'create'])->name('dashboard.symptom.create');
            Route::post('view', [DashboardSymptomController::class, 'view'])->name('dashboard.symptom.view');
            Route::post('store', [DashboardSymptomController::class, 'store'])->name('dashboard.symptom.store');
            Route::get('delete/{id}', [DashboardSymptomController::class, 'delete'])->name('dashboard.symptom.delete');
            Route::post('gen-phrase', [DashboardSymptomController::class, 'genPhrase'])->name('dashboard.symptom.gen-phrase');
        });
        Route::group(['prefix' => 'engage'], function () {
            Route::get('/{id}', [DashboardEngageController::class, 'index'])->name('dashboard.engage');
            Route::post('assign', [DashboardEngageController::class, 'assign'])->name('dashboard.assign');
        });
    });
});

Route::get('', [LandingController::class, 'index'])->name('index');
Route::get('about', [LandingController::class, 'about'])->name('about');
Route::get('gen-text', [GeminiController::class, 'genText'])->name('gen-text');






Route::group(['prefix' => 'processing'], function () {
    Route::get('create-intent', [ProcessingController::class, 'createIntent'])->name('processing.create-intent');
    Route::post('text-detection', [ProcessingController::class, 'textDetection'])->name('processing.text-detection');
    Route::post('disease-matching', [ProcessingController::class, 'diseaseMatching'])->name('processing.disease-matching');
    Route::get('delete-intent', [ProcessingController::class, 'deleteIntent'])->name('delete-intent');
    Route::get('delete-all-intent', [ProcessingController::class, 'deleteAllIntent'])->name('delete-all-intent');
});

