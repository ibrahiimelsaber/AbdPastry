<?php

use App\Http\Controllers\Account\My\Surveys\SurveyController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BranchUsersController;
use App\Http\Controllers\ClientBranchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UtilityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Account\My\AccountController as MyAccounts;
use App\Http\Controllers\Account\All\AccountController as AllAccounts;
use App\Http\Controllers\Account\My\Contact\ContactController as MyAccountContacts;
use App\Http\Controllers\Account\My\Surveys\EedSurveyController as MyEedSurveyController;
use App\Http\Controllers\Account\All\Surveys\EedSurveyController as AllEedSurveyController;
use App\Http\Controllers\Account\My\Surveys\SurveyController as MySurveyController;
use App\Http\Controllers\Account\All\Surveys\SurveyController as AllSurveyController;
use App\Http\Controllers\Account\All\Contact\ContactController as AllAccountContacts;
use App\Http\Controllers\Account\My\Contact\Request\RequestController as MyAccountContactsRequests;
use App\Http\Controllers\Account\All\Contact\Request\RequestController as AllAccountContactsRequests;
use App\Http\Controllers\Account\My\Contact\Request\Activity\ActivityController as MyAccountContactsRequestsActivity;
use App\Http\Controllers\Account\All\Contact\Request\Activity\ActivityController as AllAccountContactsRequestsActivity;

use App\Http\Controllers\Contact\My\ContactController as MyContacts;
use App\Http\Controllers\Contact\All\ContactController as AllContacts;
use App\Http\Controllers\Contact\My\Request\RequestController as MyContactsRequests;
use App\Http\Controllers\Contact\All\Request\RequestController as AllContactsRequests;
use App\Http\Controllers\Contact\My\Request\Activity\ActivityController as MyContactsRequestsActivity;
use App\Http\Controllers\Contact\All\Request\Activity\ActivityController as AllContactsRequestsActivity;

use App\Http\Controllers\Request\My\Activity\ActivityController as MyRequestsActivity;
use App\Http\Controllers\Request\All\Activity\ActivityController as AllRequestsActivity;


use App\Http\Controllers\Request\My\RequestController as MyRequests;
use App\Http\Controllers\Activity\My\ActivityController as MyActivities;
use App\Http\Controllers\Request\All\RequestController as AllRequests;
use App\Http\Controllers\Activity\All\ActivityController as AllActivities;





/*Drop Down Lists*/
/*get sub drop down lists*/
Route::get('getSubTypes/{id}', [UtilityController::class, 'getSRSubTypes'])->name('getSRSubTypes');
Route::get('getSubProducts/{id}', [UtilityController::class, 'getSRProductsSubTypes'])->name('getSubProducts');
Route::get('getSubSubType/{id}', [UtilityController::class, 'getSRSubSubTypes'])->name('getSRSubSubTypes');
Route::get('getSubQuestion/{id}', [UtilityController::class, 'getSubQuestion'])->name('getSubQuestion');
Route::get('getAreas/{id}', [UtilityController::class, 'getAreas'])->name('getAreas');


Route::get('test',function (){
    return view('slogin');
})->name('account.search');
Route::get('search',[AllAccounts::class, 'search'])->name('account.search');

/* auth routes */
Route::get('/', [LoginController::class, 'show'])->name('login');
Route::post('/home', [LoginController::class, 'login'])->name('login.perform');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');



/* user managements routes */
Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::get('users/create', [UserController::class, 'create'])->name('users.create');
Route::post('users/store', [UserController::class, 'store'])->name('users.store');
Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('users/{id}/update', [UserController::class, 'update'])->name('users.update');
Route::get('users/{id}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
Route::get('users/{id}/activate', [UserController::class, 'activate'])->name('users.activate');



/* branches managements routes */
Route::get('branches', [BranchController::class, 'index'])->name('branches.index');
Route::get('branches/create', [BranchController::class, 'create'])->name('branches.create');
Route::post('branches/store', [BranchController::class, 'store'])->name('branches.store');
Route::get('branches/{id}/edit', [BranchController::class, 'edit'])->name('branches.edit');
Route::put('branches/{id}/update', [BranchController::class, 'update'])->name('branches.update');
Route::get('branches/{id}/deactivate', [BranchController::class, 'deactivate'])->name('branches.deactivate');
Route::get('branches/{id}/activate', [BranchController::class, 'activate'])->name('branches.activate');

/* branches managements routes */
Route::group(['prefix' => 'branch', 'as' => 'branch.'], function () {
    Route::get('/{id}/users', [BranchUsersController::class, 'branch'])->name('users.list');
    Route::delete('/{user_id}/users/{id}', [BranchUsersController::class, 'destroy'])->name('users.delete');
    Route::get('users', [BranchUsersController::class, 'index'])->name('users.index');
    Route::get('/{id}/users/create', [BranchUsersController::class, 'create'])->name('users.create');
    Route::post('users/store', [BranchUsersController::class, 'store'])->name('users.store');
    Route::get('users/{id}/edit', [BranchUsersController::class, 'edit'])->name('users.edit');
    Route::put('users/{id}/update', [BranchUsersController::class, 'update'])->name('users.update');
    Route::get('users/{id}/deactivate', [BranchUsersController::class, 'deactivate'])->name('users.deactivate');
    Route::get('users/{id}/activate', [BranchUsersController::class, 'activate'])->name('users.activate');


});

/*  My Routes   */

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

        //Eed Survey
        Route::get('{id}/eed-surveys', [MyEedSurveyController::class, 'index'])->name('eed-surveys.index');
        Route::get('{id}/eed-surveys/create', [MyEedSurveyController::class, 'create'])->name('eed-surveys.create');
        Route::post('eed-surveys/store', [MyEedSurveyController::class, 'store'])->name('eed-surveys.store');
        Route::get('eed-surveys/{id}/edit', [MyEedSurveyController::class, 'edit'])->name('eed-surveys.edit');
        Route::put('eed-surveys/{id}/update', [MyEedSurveyController::class, 'update'])->name('eed-surveys.update');
        Route::delete('eed-surveys/{id}/delete', [MyEedSurveyController::class, 'delete'])->name('eed-surveys.delete');
        //End OF Eed Survey

        //Normal Survey
        Route::get('{id}/surveys', [MySurveyController::class, 'index'])->name('surveys.index');
        Route::get('{id}/surveys/create', [MySurveyController::class, 'create'])->name('surveys.create');
        Route::post('surveys/store', [MySurveyController::class, 'store'])->name('surveys.store');
        Route::get('surveys/{id}/edit', [MySurveyController::class, 'edit'])->name('surveys.edit');
        Route::put('surveys/{id}/update', [MySurveyController::class, 'update'])->name('surveys.update');
        Route::delete('surveys/{id}/delete', [MySurveyController::class, 'delete'])->name('surveys.delete');
        //End OF Normal Survey

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

    //Eed Survey
    Route::get('/norm-surveys', [MySurveyController::class, 'mySurveys'])->name('surveys.mine');
    Route::get('/eed-surveys', [MyEedSurveyController::class, 'my'])->name('eed-surveys.index');

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


/*All Routes    */


// Go To Resources => views => survyes => my => blades
Route::group(['prefix' => 'my', 'as' => 'my.'], function () {
//Normal Survey
    Route::get('{surveys', [SurveyController::class, 'index'])->name('surveys.index');
    Route::get('{surveys/create', [SurveyController::class, 'create'])->name('surveys.create');
    Route::post('surveys/store', [SurveyController::class, 'store'])->name('surveys.store');
    Route::get('surveys/{id}/edit', [SurveyController::class, 'edit'])->name('surveys.edit');
    Route::put('surveys/{id}/update', [SurveyController::class, 'update'])->name('surveys.update');
    Route::delete('surveys/{id}/delete', [SurveyController::class, 'delete'])->name('surveys.delete');

});


/*All Routes    */






// Go To Resources => views => accounts => all => blades
Route::group(['prefix' => 'all', 'as' => 'all.'], function () {
    Route::get('accounts', [AllAccounts::class, 'index'])->name('accounts.index');
    Route::get('accounts/create', [AllAccounts::class, 'create'])->name('accounts.create');
    Route::post('accounts/store', [AllAccounts::class, 'store'])->name('accounts.store');
    Route::get('accounts/{id}/edit', [AllAccounts::class, 'edit'])->name('accounts.edit');
    Route::put('accounts/{id}/update', [AllAccounts::class, 'update'])->name('accounts.update');
    Route::delete('accounts/{id}/delete', [AllAccounts::class, 'delete'])->name('accounts.delete');

    // Go To Resources => views => contacts => my => blades
    Route::group(['prefix' => 'account', 'as' => 'account.'], function () {
        Route::get('{id}/contacts', [AllAccountContacts::class, 'index'])->name('contacts.index');
        Route::get('{id}/contacts/create', [AllAccountContacts::class, 'create'])->name('contacts.create');
        Route::post('contacts/store', [AllAccountContacts::class, 'store'])->name('contacts.store');
        Route::get('contacts/{id}/edit', [AllAccountContacts::class, 'edit'])->name('contacts.edit');
        Route::put('contacts/{id}/update', [AllAccountContacts::class, 'update'])->name('contacts.update');
        Route::delete('contacts/{id}/delete', [AllAccountContacts::class, 'delete'])->name('contacts.delete');

        //Eed Survey
        Route::get('{id}/eed-surveys', [AllEedSurveyController::class, 'index'])->name('eed-surveys.index');
        Route::get('{id}/eed-surveys/create', [AllEedSurveyController::class, 'create'])->name('eed-surveys.create');
        Route::post('eed-surveys/store', [AllEedSurveyController::class, 'store'])->name('eed-surveys.store');
        Route::get('eed-surveys/{id}/edit', [AllEedSurveyController::class, 'edit'])->name('eed-surveys.edit');
        Route::put('eed-surveys/{id}/update', [AllEedSurveyController::class, 'update'])->name('eed-surveys.update');
        Route::delete('eed-surveys/{id}/delete', [AllEedSurveyController::class, 'delete'])->name('eed-surveys.delete');

        //Normal Survey
        Route::get('{id}/surveys', [AllSurveyController::class, 'index'])->name('surveys.index');
        Route::get('{id}/surveys/create', [AllSurveyController::class, 'create'])->name('surveys.create');
        Route::post('surveys/store', [AllSurveyController::class, 'store'])->name('surveys.store');
        Route::get('surveys/{id}/edit', [AllSurveyController::class, 'edit'])->name('surveys.edit');
        Route::put('surveys/{id}/update', [AllSurveyController::class, 'update'])->name('surveys.update');
        Route::delete('surveys/{id}/delete', [AllSurveyController::class, 'delete'])->name('surveys.delete');


        // Go To Resources => views => contacts => my => blades
        Route::group(['prefix' => 'contact', 'as' => 'contact.'], function () {
            Route::get('{id}/requests', [AllAccountContactsRequests::class, 'index'])->name('requests.index');
            Route::get('{id}/requests/create', [AllAccountContactsRequests::class, 'create'])->name('requests.create');
            Route::post('requests/store', [AllAccountContactsRequests::class, 'store'])->name('requests.store');
            Route::get('requests/{id}/edit', [AllAccountContactsRequests::class, 'edit'])->name('requests.edit');
            Route::put('requests/update', [AllAccountContactsRequests::class, 'update'])->name('requests.update');
            Route::delete('requests/{id}/delete', [AllAccountContactsRequests::class, 'delete'])->name('requests.delete');
            Route::get('requests/{id}/history', [AllAccountContactsRequests::class, 'history'])->name('request.history.index');

            // Go To Resources => views => contacts => my => blades
            Route::group(['prefix' => 'request', 'as' => 'request.'], function () {
                Route::get('{id}/activities', [AllAccountContactsRequestsActivity::class, 'index'])->name('activities.index');
                Route::get('{id}/activities/create', [AllAccountContactsRequestsActivity::class, 'create'])->name('activities.create');
                Route::post('activities/store', [AllAccountContactsRequestsActivity::class, 'store'])->name('activities.store');
                Route::get('activities/{id}/edit', [AllAccountContactsRequestsActivity::class, 'edit'])->name('activities.edit');
                Route::put('activities/{id}/update', [AllAccountContactsRequestsActivity::class, 'update'])->name('activities.update');
                Route::delete('activities/{id}/delete', [AllAccountContactsRequestsActivity::class, 'delete'])->name('activities.delete');

            });


        });

    });
    //Eed Survey
    Route::get('/eed-surveys', [AllEedSurveyController::class, 'all'])->name('eed-surveys.index');
    Route::get('/surveys', [AllSurveyController::class, 'all'])->name('surveys.index');
});

// Go To Resources => views => contacts => all => blades
Route::group(['prefix' => 'all', 'as' => 'all.'], function () {
    Route::get('contacts', [AllContacts::class, 'index'])->name('contacts.index');
    Route::get('contacts/create', [AllContacts::class, 'create'])->name('contacts.create');
    Route::post('contacts/store', [AllContacts::class, 'store'])->name('contacts.store');
    Route::get('contacts/{id}/edit', [AllContacts::class, 'edit'])->name('contacts.edit');
    Route::put('contacts/{id}/update', [AllContacts::class, 'update'])->name('contacts.update');
    Route::delete('contacts/{id}/delete', [AllContacts::class, 'delete'])->name('contacts.delete');

    // Go To Resources => views => contacts => all => blades
    Route::group(['prefix' => 'contact', 'as' => 'contact.'], function () {
        Route::get('{id}/requests', [AllContactsRequests::class, 'index'])->name('requests.index');
        Route::get('{id}/requests/create', [AllContactsRequests::class, 'create'])->name('requests.create');
        Route::post('requests/store', [AllContactsRequests::class, 'store'])->name('requests.store');
        Route::get('requests/{id}/edit', [AllContactsRequests::class, 'edit'])->name('requests.edit');
        Route::put('requests/update', [AllContactsRequests::class, 'update'])->name('requests.update');
        Route::delete('requests/{id}/delete', [AllContactsRequests::class, 'delete'])->name('requests.delete');
        Route::get('requests/{id}/history', [AllContactsRequests::class, 'history'])->name('request.history.index');

        // Go To Resources => views => contacts => my => blades
        Route::group(['prefix' => 'request', 'as' => 'request.'], function () {
            Route::get('{id}/activities', [AllContactsRequestsActivity::class, 'index'])->name('activities.index');
            Route::get('{id}/activities/create', [AllContactsRequestsActivity::class, 'create'])->name('activities.create');
            Route::post('activities/store', [AllContactsRequestsActivity::class, 'store'])->name('activities.store');
            Route::get('activities/{id}/edit', [AllContactsRequestsActivity::class, 'edit'])->name('activities.edit');
            Route::put('activities/{id}/update', [AllContactsRequestsActivity::class, 'update'])->name('activities.update');
            Route::delete('activities/{id}/delete', [AllContactsRequestsActivity::class, 'delete'])->name('activities.delete');

        });


    });

});




// Go To Resources => views => requests => all => blades
Route::group(['prefix' => 'all', 'as' => 'all.'], function () {
    Route::get('requests', [AllRequests::class, 'index'])->name('requests.index');
    Route::get('requests/create', [AllRequests::class, 'create'])->name('requests.create');
    Route::post('requests/store', [AllRequests::class, 'store'])->name('requests.store');
    Route::get('requests/{id}/edit', [AllRequests::class, 'edit'])->name('requests.edit');
    Route::put('requests/{id}/update', [AllRequests::class, 'update'])->name('requests.update');
    Route::delete('requests/{id}/delete', [AllRequests::class, 'delete'])->name('requests.delete');
    Route::get('requests/{id}/history', [AllRequests::class, 'history'])->name('request.history.index');

    // Go To Resources => views => contacts => all => blades
    Route::group(['prefix' => 'request', 'as' => 'request.'], function () {
        Route::get('{id}/activities', [AllRequestsActivity::class, 'index'])->name('activities.index');
        Route::get('{id}/activities/create', [AllRequestsActivity::class, 'create'])->name('activities.create');
        Route::post('activities/store', [AllRequestsActivity::class, 'store'])->name('activities.store');
        Route::get('activities/{id}/edit', [AllRequestsActivity::class, 'edit'])->name('activities.edit');
        Route::put('activities/{id}/update', [AllRequestsActivity::class, 'update'])->name('activities.update');
        Route::delete('activities/{id}/delete', [AllRequestsActivity::class, 'delete'])->name('activities.delete');

    });


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


Route::get('branch-search', [ClientBranchController::class, 'search'])->name('branch.search');
Route::get('branch/requests/search', [ClientBranchController::class, 'search'])->name('branch.requests.list');
Route::get('branch/{id}/statistics',[ClientBranchController::class, 'statistics'])->name('branch.requests.statistics');
Route::get('branch/{id}/requests', [ClientBranchController::class, 'index'])->name('branch.requests.index');
Route::get('branch/requests/{id}/edit', [ClientBranchController::class, 'edit'])->name('branch.requests.edit');
Route::put('branch/requests/{id}/update', [ClientBranchController::class, 'update'])->name('branch.requests.update');


Route::get('statistics',[UtilityController::class, 'statistics'])->name('statistics');

































