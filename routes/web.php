<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\My\AccountController as MyAccounts;
use App\Http\Controllers\My\ContactController as MyContacts;
use App\Http\Controllers\All\AccountController as AllAccounts;
use App\Http\Controllers\All\ContactController as AllContacts;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UtilityController;
use Illuminate\Support\Facades\Route;


Route::get('/', [LoginController::class, 'show'])->name('login');
Route::post('/home', [LoginController::class, 'login'])->name('login.perform');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

//start of my accounts
Route::group(['prefix' => 'my', 'as' => 'my.'], function () {
    Route::get('accounts', [MyAccounts::class, 'index'])->name('accounts');
    Route::get('accounts/create', [MyAccounts::class, 'create'])->name('accounts.create');
    Route::post('accounts/store', [MyAccounts::class, 'store'])->name('accounts.store');
    Route::get('accounts/{Id}/edit', [MyAccounts::class, 'edit'])->name('accounts.edit');
    Route::put('accounts/{Id}/update', [MyAccounts::class, 'update'])->name('accounts.update');
    Route::get('contacts/index', [MyContacts::class, 'index'])->name('contacts');
    Route::get('account/contacts/index', [MyContacts::class, 'index'])->name('accounts.contacts');
    Route::get('account/{id}/contacts/create', [MyContacts::class, 'create'])->name('accounts.contacts.create');
    Route::post('account/contacts/store', [MyContacts::class, 'store'])->name('accounts.contacts.store');
    Route::get('account/{Id}/contacts/show', [MyContacts::class, 'show'])->name('accounts.contacts.show');
    Route::get('account/contacts/{id}/edit', [MyContacts::class, 'edit'])->name('accounts.contacts.edit');
    Route::put('account/contacts/{id}/update', [MyContacts::class, 'update'])->name('account.contacts.update');

//    //sr routes
//    Route::get('account/contacts/{id}/requests', [RequestController::class, 'index'])->name('accounts.contact.requests');
//    Route::get('account/contacts/{id}/requests/create', [RequestController::class, 'create'])->name('accounts.contact.requests.create');
//    Route::post('account/contacts/requests/store', [RequestController::class, 'store'])->name('accounts.contact.requests.store');
});

//end of my accounts


Route::get('getSubTypes/{id}',[UtilityController::class,'getSRSubTypes']);
Route::get('getSubProducts/{id}',[UtilityController::class,'getSRProductsSubTypes']);
Route::get('getSubSubType/{id}',[UtilityController::class,'getSRSubSubTypes']);
Route::get('getAreas/{id}',[UtilityController::class,'getAreas']);


//start of all accounts
Route::group(['prefix' => 'all', 'as' => 'all.'], function () {
    Route::get('accounts', [AllAccounts::class, 'index'])->name('accounts');
    Route::get('accounts/create', [AllAccounts::class, 'create'])->name('accounts.create');
    Route::post('accounts/store', [AllAccounts::class, 'store'])->name('accounts.store');
    Route::get('accounts/{Id}/edit', [AllAccounts::class, 'edit'])->name('accounts.edit');
    Route::put('accounts/{Id}/update', [AllAccounts::class, 'update'])->name('accounts.update');
    Route::get('contacts/index', [AllContacts::class, 'index'])->name('contacts');
    Route::get('account/contacts/index', [AllContacts::class, 'index'])->name('accounts.contacts');
    Route::get('account/{id}/contacts/create', [AllContacts::class, 'create'])->name('accounts.contacts.create');
    Route::post('account/contacts/store', [AllContacts::class, 'store'])->name('accounts.contacts.store');
    Route::get('account/{Id}/contacts/show', [AllContacts::class, 'show'])->name('accounts.contacts.show');
    Route::get('account/contacts/{id}/edit', [AllContacts::class, 'edit'])->name('accounts.contacts.edit');
    Route::put('account/contacts/{id}/update', [AllContacts::class, 'update'])->name('account.contacts.update');



});
//end of all accounts

//sr routes
Route::get('account/contacts/{id}/requests', [RequestController::class, 'index'])->name('accounts.contact.requests');
Route::get('requests', [RequestController::class, 'all'])->name('all.requests');
Route::get('request/{id}/history', [RequestController::class, 'history'])->name('request.history');
Route::get('account/contacts/{id}/requests/create', [RequestController::class, 'create'])->name('accounts.contact.requests.create');
Route::get('account/contacts/requests/{id}/edit', [RequestController::class, 'edit'])->name('accounts.contact.requests.edit');
Route::post('account/contacts/requests/store', [RequestController::class, 'store'])->name('accounts.contact.requests.store');
Route::put('account/contacts/requests/update', [RequestController::class, 'update'])->name('accounts.contact.requests.update');


//sr activity routes
Route::get('account/contacts/requests/{id}/activities', [ActivityController::class, 'index'])->name('accounts.contact.requests.activities');
Route::get('account/contacts/requests/activities/{id}/create', [ActivityController::class, 'create'])->name('accounts.contact.requests.activities.create');
Route::get('account/contacts/requests/activities/{id}edit', [ActivityController::class, 'edit'])->name('accounts.contact.requests.activities.edit');
Route::post('account/contacts/requests/activities/store', [ActivityController::class, 'store'])->name('accounts.contact.requests.activities.store');
Route::put('account/contacts/requests/activities/update', [ActivityController::class, 'update'])->name('accounts.contact.requests.activities.update');

Route::get('st',function (){
    return view('st');
});
