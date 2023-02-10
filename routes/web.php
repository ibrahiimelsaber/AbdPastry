<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UtilityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Account\My\AccountController as MyAccounts;
use App\Http\Controllers\Account\My\Contact\ContactController as MyAccountContacts;
use App\Http\Controllers\Account\My\Contact\Request\RequestController as MyAccountContactsRequests;
use App\Http\Controllers\Account\My\Contact\Request\Activity\ActivityController as MyAccountContactsRequestsActivity;

use App\Http\Controllers\Contact\My\ContactController as MyContacts;
use App\Http\Controllers\Contact\My\Request\RequestController as MyContactsRequests;
use App\Http\Controllers\Contact\My\Request\Activity\ActivityController as MyContactsRequestsActivity;

use App\Http\Controllers\Request\My\Activity\ActivityController as MyRequestsActivity;



use App\Http\Controllers\Request\My\RequestController as MyRequests;
use App\Http\Controllers\Activity\My\ActivityController as MyActivities;
use App\Http\Controllers\Account\All\AccountController as AllAccounts;
use App\Http\Controllers\Contact\All\ContactController as AllContacts;
use App\Http\Controllers\Request\All\RequestController as AllRequests;
use App\Http\Controllers\Activity\All\ActivityController as AllActivities;



Route::get('/', [LoginController::class, 'show'])->name('login');
Route::post('/home', [LoginController::class, 'login'])->name('login.perform');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


Route::get('test',function(){
//    return view('slogin');
    EmailAfterInsert(582665);
    echo 'done';
});



//user managements routes

Route::get('users',[UserController::class,'index'])->name('users.index');
Route::get('users/create',[UserController::class,'create'])->name('users.create');
Route::post('users/store',[UserController::class,'store'])->name('users.store');
Route::get('users/{id}/edit',[UserController::class,'edit'])->name('users.edit');
Route::put('users/{id}/update',[UserController::class,'update'])->name('users.update');
Route::get('users/{id}/deactivate',[UserController::class,'deactivate'])->name('users.deactivate');
Route::get('users/{id}/activate',[UserController::class,'activate'])->name('users.activate');




                                            /*  /*
                                            *    *
                                            * My Routes  *
                                            *  *
                                            */

// Go To Resources => views => accounts => my => blades
Route::group(['prefix' => 'my', 'as' => 'my.'], function () {
    Route::get('accounts', [MyAccounts::class, 'index'])->name('accounts.index');
    Route::get('accounts/create', [MyAccounts::class, 'create'])->name('accounts.create');
    Route::post('accounts/store', [MyAccounts::class, 'store'])->name('accounts.store');
    Route::get('accounts/{id}/edit', [MyAccounts::class, 'edit'])->name('accounts.edit');
    Route::put('accounts/{id}/update', [MyAccounts::class, 'update'])->name('accounts.update');
    Route::delete('accounts/{id}/delete', [MyAccounts::class, 'delete'])->name('accounts.delete');

    // Go To Resources => views => contacts => my => blades
    Route::group(['prefix' => 'account', 'as' => 'account.'], function () {
        Route::get('{id}/contacts', [MyAccountContacts::class, 'index'])->name('contacts.index');
        Route::get('{id}/contacts/create', [MyAccountContacts::class, 'create'])->name('contacts.create');
        Route::post('contacts/store', [MyAccountContacts::class, 'store'])->name('contacts.store');
        Route::get('contacts/{id}/edit', [MyAccountContacts::class, 'edit'])->name('contacts.edit');
        Route::put('contacts/{id}/update', [MyAccountContacts::class, 'update'])->name('contacts.update');
        Route::delete('contacts/{id}/delete', [MyAccountContacts::class, 'delete'])->name('contacts.delete');


        // Go To Resources => views => contacts => my => blades
        Route::group(['prefix' => 'contact', 'as' => 'contact.'], function () {
            Route::get('{id}/requests', [MyAccountContactsRequests::class, 'index'])->name('requests.index');
            Route::get('{id}/requests/create', [MyAccountContactsRequests::class, 'create'])->name('requests.create');
            Route::post('requests/store', [MyAccountContactsRequests::class, 'store'])->name('requests.store');
            Route::get('requests/{id}/edit', [MyAccountContactsRequests::class, 'edit'])->name('requests.edit');
            Route::put('requests/update', [MyAccountContactsRequests::class, 'update'])->name('requests.update');
            Route::delete('requests/{id}/delete', [MyAccountContactsRequests::class, 'delete'])->name('requests.delete');
            Route::get('requests/{id}/history', [MyAccountContactsRequests::class, 'history'])->name('request.history.index');

            // Go To Resources => views => contacts => my => blades
            Route::group(['prefix' => 'request', 'as' => 'request.'], function () {
                Route::get('{id}/activities', [MyAccountContactsRequestsActivity::class, 'index'])->name('activities.index');
                Route::get('{id}/activities/create', [MyAccountContactsRequestsActivity::class, 'create'])->name('activities.create');
                Route::post('activities/store', [MyAccountContactsRequestsActivity::class, 'store'])->name('activities.store');
                Route::get('activities/{id}/edit', [MyAccountContactsRequestsActivity::class, 'edit'])->name('activities.edit');
                Route::put('activities/{id}/update', [MyAccountContactsRequestsActivity::class, 'update'])->name('activities.update');
                Route::delete('activities/{id}/delete', [MyAccountContactsRequestsActivity::class, 'delete'])->name('activities.delete');

            });


        });

    });

});



// Go To Resources => views => contacts => my => blades
Route::group(['prefix' => 'my', 'as' => 'my.'], function () {
    Route::get('contacts', [MyContacts::class, 'index'])->name('contacts.index');
    Route::get('contacts/create', [MyContacts::class, 'create'])->name('contacts.create');
    Route::post('contacts/store', [MyContacts::class, 'store'])->name('contacts.store');
    Route::get('contacts/{id}/edit', [MyContacts::class, 'edit'])->name('contacts.edit');
    Route::put('contacts/{id}/update', [MyContacts::class, 'update'])->name('contacts.update');
    Route::delete('contacts/{id}/delete', [MyContacts::class, 'delete'])->name('contacts.delete');

    // Go To Resources => views => contacts => my => blades
    Route::group(['prefix' => 'contact', 'as' => 'contact.'], function () {
        Route::get('{id}/requests', [MyContactsRequests::class, 'index'])->name('requests.index');
        Route::get('{id}/requests/create', [MyContactsRequests::class, 'create'])->name('requests.create');
        Route::post('requests/store', [MyContactsRequests::class, 'store'])->name('requests.store');
        Route::get('requests/{id}/edit', [MyContactsRequests::class, 'edit'])->name('requests.edit');
        Route::put('requests/update', [MyContactsRequests::class, 'update'])->name('requests.update');
        Route::delete('requests/{id}/delete', [MyContactsRequests::class, 'delete'])->name('requests.delete');
        Route::get('requests/{id}/history', [MyContactsRequests::class, 'history'])->name('request.history.index');

        // Go To Resources => views => contacts => my => blades
        Route::group(['prefix' => 'request', 'as' => 'request.'], function () {
            Route::get('{id}/activities', [MyContactsRequestsActivity::class, 'index'])->name('activities.index');
            Route::get('{id}/activities/create', [MyContactsRequestsActivity::class, 'create'])->name('activities.create');
            Route::post('activities/store', [MyContactsRequestsActivity::class, 'store'])->name('activities.store');
            Route::get('activities/{id}/edit', [MyContactsRequestsActivity::class, 'edit'])->name('activities.edit');
            Route::put('activities/{id}/update', [MyContactsRequestsActivity::class, 'update'])->name('activities.update');
            Route::delete('activities/{id}/delete', [MyContactsRequestsActivity::class, 'delete'])->name('activities.delete');

        });


    });

});

// Go To Resources => views => requests => my => blades
Route::group(['prefix' => 'my', 'as' => 'my.'], function () {
    Route::get('requests', [MyRequests::class, 'index'])->name('requests.index');
    Route::get('requests/create', [MyRequests::class, 'create'])->name('requests.create');
    Route::post('requests/store', [MyRequests::class, 'store'])->name('requests.store');
    Route::get('requests/{id}/edit', [MyRequests::class, 'edit'])->name('requests.edit');
    Route::put('requests/{id}/update', [MyRequests::class, 'update'])->name('requests.update');
    Route::delete('requests/{id}/delete', [MyRequests::class, 'delete'])->name('requests.delete');
    Route::get('requests/{id}/history', [MyRequests::class, 'history'])->name('request.history.index');

    // Go To Resources => views => contacts => my => blades
    Route::group(['prefix' => 'request', 'as' => 'request.'], function () {
        Route::get('{id}/activities', [MyRequestsActivity::class, 'index'])->name('activities.index');
        Route::get('{id}/activities/create', [MyRequestsActivity::class, 'create'])->name('activities.create');
        Route::post('activities/store', [MyRequestsActivity::class, 'store'])->name('activities.store');
        Route::get('activities/{id}/edit', [MyRequestsActivity::class, 'edit'])->name('activities.edit');
        Route::put('activities/{id}/update', [MyRequestsActivity::class, 'update'])->name('activities.update');
        Route::delete('activities/{id}/delete', [MyRequestsActivity::class, 'delete'])->name('activities.delete');

    });


});



// Go To Resources => views => activities => my => blades
Route::group(['prefix' => 'my', 'as' => 'my.'], function () {
    Route::get('activities', [MyActivities::class, 'index'])->name('activities.index');
    Route::get('activities/create', [MyActivities::class, 'create'])->name('activities.create');
    Route::post('activities/store', [MyActivities::class, 'store'])->name('activities.store');
    Route::get('activities/{id}/edit', [MyActivities::class, 'edit'])->name('activities.edit');
    Route::put('activities/{id}/update', [MyActivities::class, 'update'])->name('activities.update');
    Route::delete('activities/{id}/delete', [MyActivities::class, 'delete'])->name('activities.delete');

});



/*
                                        *    *
                                        * All Routes  *
                                        *  *
                                        */



// Go To Resources => views => accounts => all => blades
Route::group(['prefix' => 'all', 'as' => 'all.'], function () {
    Route::get('accounts', [AllAccounts::class, 'index'])->name('accounts.index');
    Route::get('accounts/create', [AllAccounts::class, 'create'])->name('accounts.create');
    Route::post('accounts/store', [AllAccounts::class, 'store'])->name('accounts.store');
    Route::get('accounts/{id}/edit', [AllAccounts::class, 'edit'])->name('accounts.edit');
    Route::put('accounts/{id}/update', [AllAccounts::class, 'update'])->name('accounts.update');
    Route::delete('accounts/{id}/delete', [AllAccounts::class, 'delete'])->name('accounts.delete');

});

// Go To Resources => views => contacts => all => blades
Route::group(['prefix' => 'all', 'as' => 'all.'], function () {
    Route::get('contacts', [AllContacts::class, 'index'])->name('contacts.index');
    Route::get('contacts/create', [AllContacts::class, 'create'])->name('contacts.create');
    Route::post('contacts/store', [AllContacts::class, 'store'])->name('contacts.store');
    Route::get('contacts/{id}/edit', [AllContacts::class, 'edit'])->name('contacts.edit');
    Route::put('contacts/{id}/update', [AllContacts::class, 'update'])->name('contacts.update');
    Route::delete('contacts/{id}/delete', [AllContacts::class, 'delete'])->name('contacts.delete');

});

// Go To Resources => views => requests => all => blades
Route::group(['prefix' => 'all', 'as' => 'all.'], function () {
    Route::get('requests', [AllRequests::class, 'index'])->name('requests.index');
    Route::get('requests/create', [AllRequests::class, 'create'])->name('requests.create');
    Route::post('requests/store', [AllRequests::class, 'store'])->name('requests.store');
    Route::get('requests/{id}/edit', [AllRequests::class, 'edit'])->name('requests.edit');
    Route::put('requests/{id}/update', [AllRequests::class, 'update'])->name('requests.update');
    Route::delete('requests/{id}/delete', [AllRequests::class, 'delete'])->name('requests.delete');

});



// Go To Resources => views => activities => all => blades
Route::group(['prefix' => 'all', 'as' => 'all.'], function () {
    Route::get('activities', [AllActivities::class, 'index'])->name('activities.index');
    Route::get('activities/create', [AllActivities::class, 'create'])->name('activities.create');
    Route::post('activities/store', [AllActivities::class, 'store'])->name('activities.store');
    Route::get('activities/{id}/edit', [AllActivities::class, 'edit'])->name('activities.edit');
    Route::put('activities/{id}/update', [AllActivities::class, 'update'])->name('activities.update');
    Route::delete('activities/{id}/delete', [AllActivities::class, 'delete'])->name('activities.delete');

});












/// ///////////////////////////////////// ///////////////////////////////////////////////////////////////////////////////////////////////


////start of my accounts
//Route::group(['prefix' => 'mys', 'as' => 'my.'], function () {
//
//    Route::get('account/contacts/index', [MyContacts::class, 'index'])->name('accounts.contacts');
//    Route::get('account/{id}/contacts/create', [MyContacts::class, 'create'])->name('accounts.contacts.create');
//    Route::post('account/contacts/store', [MyContacts::class, 'store'])->name('accounts.contacts.store');
//    Route::get('account/{Id}/contacts/show', [MyContacts::class, 'show'])->name('accounts.contacts.show');
//    Route::get('account/contacts/{id}/edit', [MyContacts::class, 'edit'])->name('accounts.contacts.edit');
//    Route::put('account/contacts/{id}/update', [MyContacts::class, 'update'])->name('account.contacts.update');
//
////    //sr routes
////    Route::get('account/contacts/{id}/requests', [RequestController::class, 'index'])->name('accounts.contact.requests');
////    Route::get('account/contacts/{id}/requests/create', [RequestController::class, 'create'])->name('accounts.contact.requests.create');
////    Route::post('account/contacts/requests/store', [RequestController::class, 'store'])->name('accounts.contact.requests.store');
//});

//end of my accounts


Route::get('getSubTypes/{id}',[UtilityController::class,'getSRSubTypes']);
Route::get('getSubProducts/{id}',[UtilityController::class,'getSRProductsSubTypes']);
Route::get('getSubSubType/{id}',[UtilityController::class,'getSRSubSubTypes']);
Route::get('getAreas/{id}',[UtilityController::class,'getAreas']);


//start of all accounts
//Route::group(['prefix' => 'all', 'as' => 'all.'], function () {
//    Route::get('accounts', [AllAccounts::class, 'index'])->name('accounts');
//    Route::get('accounts/create', [AllAccounts::class, 'create'])->name('accounts.create');
//    Route::post('accounts/store', [AllAccounts::class, 'store'])->name('accounts.store');
//    Route::get('accounts/{Id}/edit', [AllAccounts::class, 'edit'])->name('accounts.edit');
//    Route::put('accounts/{Id}/update', [AllAccounts::class, 'update'])->name('accounts.update');
//    Route::get('contacts/index', [AllContacts::class, 'index'])->name('contacts');
//    Route::get('account/contacts/index', [AllContacts::class, 'index'])->name('accounts.contacts');
//    Route::get('account/{id}/contacts/create', [AllContacts::class, 'create'])->name('accounts.contacts.create');
//    Route::post('account/contacts/store', [AllContacts::class, 'store'])->name('accounts.contacts.store');
//    Route::get('account/{Id}/contacts/show', [AllContacts::class, 'show'])->name('accounts.contacts.show');
//    Route::get('account/contacts/{id}/edit', [AllContacts::class, 'edit'])->name('accounts.contacts.edit');
//    Route::put('account/contacts/{id}/update', [AllContacts::class, 'update'])->name('account.contacts.update');
//
//
//
//});
//end of all accounts
//
////sr routes
//Route::get('account/contacts/{id}/requests', [RequestController::class, 'index'])->name('accounts.contact.requests');
//Route::get('requests', [RequestController::class, 'all'])->name('all.requests');
//Route::get('request/{id}/history', [RequestController::class, 'history'])->name('request.history');
//Route::get('account/contacts/{id}/requests/create', [RequestController::class, 'create'])->name('accounts.contact.requests.create');
//Route::get('account/contacts/requests/{id}/edit', [RequestController::class, 'edit'])->name('accounts.contact.requests.edit');
//Route::post('account/contacts/requests/store', [RequestController::class, 'store'])->name('accounts.contact.requests.store');
//Route::put('account/contacts/requests/update', [RequestController::class, 'update'])->name('accounts.contact.requests.update');
//

//sr activity routes
//Route::get('account/contacts/requests/{id}/activities', [ActivityController::class, 'index'])->name('accounts.contact.requests.activities');
//Route::get('account/contacts/requests/activities/{id}/create', [ActivityController::class, 'create'])->name('accounts.contact.requests.activities.create');
//Route::get('account/contacts/requests/activities/{id}/edit', [ActivityController::class, 'edit'])->name('accounts.contact.requests.activities.edit');
//Route::post('account/contacts/requests/activities/store', [ActivityController::class, 'store'])->name('accounts.contact.requests.activities.store');
//Route::put('account/contacts/requests/activities/{id}/update', [ActivityController::class, 'update'])->name('accounts.contact.requests.activities.update');

//Route::get('st',function (){
//    return view('login1');
//});





