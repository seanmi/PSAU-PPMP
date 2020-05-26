<?php

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
    if (Auth::user()) {
        if(Auth::user()->user_lvl == 4){
            return redirect()->route('items');
        }
        if(Auth::user()->user_lvl == 3){
            return redirect()->route('users'); 
        }
        if(Auth::user()->user_lvl == 2){

            return redirect()->route('vp.approvals');   
        }
        if(Auth::user()->user_lvl == 5){
            return redirect()->route('submissions');   
        }
        if(Auth::user()->user_lvl == 6){
            return redirect()->route('user.plan.submission'); 
        }
        if(Auth::user()->user_lvl == 1){
            return redirect()->route('op.approvals');      
        }
    }else{
        return redirect()->route('login');
    }
});


Auth::routes();

Route::group(['middleware' => ['auth','bac'], 'prefix' => 'bac'], function(){
    Route::group(['prefix' => 'items'], function(){
        Route::get('/', 'BacItemsController@index')->name('bac.items');
        Route::post('/edit/{id}', 'BacItemsController@update')->name('bac.item.update');
    });
    Route::group(['prefix' => 'modes'], function(){
        Route::get('/', 'BacModesController@index')->name('bac.modes');
        Route::post('/', 'BacModesController@store')->name('bac.modes.store');
        Route::post('/edit/{id}', 'BacModesController@update')->name('bac.modes.update');
        Route::get('/delete/{id}', 'BacModesController@des')->name('bac.modes.delete');
    });

    Route::group(['prefix' => 'submissions'], function(){
        Route::get('/', 'BacSubmissionsController@index')->name('bac.submissions');
        Route::get('/consolidation/{submission_id}', 'BacSubmissionsController@consolidation')->name('bac.consolidation');
        Route::get('/consolidation/summary/{submission_id}', 'BacSubmissionsController@consolidationSummary')->name('bac.consolidation.summary');
        Route::get('/consolidation/item/{id}/{submission_id}', 'BacSubmissionsController@consolidationItem')->name('bac.consolidation.item');
        Route::post('/consolidation/{category_id}/{submission_id}', 'BacSubmissionsController@consolidationMode')->name('bac.consolidation.mode');
        Route::post('/consolidation/{category_id}/{submission_id}/update', 'BacSubmissionsController@consolidationModeUpdate')->name('bac.consolidation.mode.update');
    });

    Route::group(['prefix' => 'departments'], function(){
        Route::get('/', 'DepartmentsController@index')->name('departments');
        Route::post('/', 'DepartmentsController@store')->name('department.store.db');
        Route::post('/edit/{id}', 'DepartmentsController@update')->name('bac.department.update');
        Route::get('/delete/{id}', 'DepartmentsController@destroy')->name('department.delete');
    });

    Route::group(['prefix' => 'positions'], function(){
        Route::get('/', 'PositionsController@index')->name('positions');
        Route::post('/', 'PositionsController@store')->name('position.store');
        Route::post('/edit/{id}', 'PositionsController@update')->name('position.update');
        Route::get('/delete/{id}', 'PositionsController@destroy')->name('position.delete');
    });

    Route::group(['prefix' => 'users'], function(){
        Route::get('/', 'UsersController@index')->name('users');
        Route::post('/', 'UsersController@store')->name('user.store');
        Route::post('/edit/{id}/admin', 'UsersController@updateAdmin')->name('user.update.admin');
        Route::post('/edit/{id}/user', 'UsersController@updateUser')->name('user.update.user');
        Route::get('/delete/{id}', 'UsersController@destroy')->name('user.delete');
    });

    Route::post('/update/profile/{id}', 'AccountsController@updateProfileAdmin')->name('bac.update.profile');
    Route::get('/edit/profile/{id}', 'AccountsController@editProfileAdmin')->name('bac.edit.profile');

});

Route::group(['middleware' => ['auth','procurement'],'prefix' => 'procurement'], function(){

    // Route::group(['prefix' => 'submissions'], function(){
    //     Route::get('/', 'ProcurementSubmissionsController@index')->name('procurement.submissions');
    //     // Route::get('/consolidation/{year}', 'SubmissionsController@consolidation')->name('consolidation');
    //     // Route::get('/consolidation/item/{id}/plan_year/{year}', 'SubmissionsController@consolidationItem')->name('consolidation.item');
    //     // Route::post('/', 'SubmissionsController@store')->name('submission.store');
    //     // Route::post('/edit/{id}', 'SubmissionsController@update')->name('submission.update');
    // });

    Route::post('/update/profile/{id}', 'AccountsController@updateProfileAdmin')->name('procurement.update.profile');
    Route::get('/edit/profile/{id}', 'AccountsController@editProfileAdmin')->name('procurement.edit.profile');


    Route::group(['prefix' => 'items'], function(){
        Route::get('/', 'ItemsController@index')->name('items');
        Route::post('/', 'ItemsController@store')->name('item.store');
        Route::post('/edit/{id}', 'ItemsController@update')->name('item.update');
        Route::get('/delete/{id}', 'ItemsController@destroy')->name('item.delete');
    });

    Route::get('/ready', 'ItemsController@ready')->name('ready');
    Route::get('/unready', 'ItemsController@unready')->name('unready');

    Route::group(['prefix' => 'categories'], function(){
        Route::get('/', 'CategoriesController@index')->name('categories');
        Route::post('/', 'CategoriesController@store')->name('category.store');
        Route::post('/edit/{id}', 'CategoriesController@update')->name('category.update');
        Route::get('/delete/{id}', 'CategoriesController@destroy')->name('category.delete');
    });
});


Route::group(['middleware' => ['auth','user'],'prefix' => 'user'], function(){
    Route::group(['prefix' => 'submission'], function(){
        Route::get('/', 'DepartmentsController@index')->name('user.submission');
        Route::post('/', 'DepartmentsController@store')->name('department.store');
        Route::post('/edit/{id}', 'DepartmentsController@update')->name('department.update');
    });

    Route::group(['prefix' => 'plan'], function(){
        Route::get('/', 'UserPlansController@index')->name('user.plans');
        Route::post('/', 'UserPlansController@store')->name('user.plan.store');
        Route::post('/submit/{submission_id}', 'UserPlansController@submitPlan')->name('user.plan.submit');
        Route::post('/edit/{id}', 'UserPlansController@update')->name('user.plan.update');
        Route::get('/items/{id}', 'UserPlansController@items')->name('user.plan.items');
        Route::get('/{plan_id}/{item_id}', 'UserPlansController@removeItem')->name('remove');
        Route::get('/{id}/plan_items', 'UserPlansController@plan_itemsGet')->name('user.items.plan');
        Route::get('/summary/items/{id}', 'UserPlansController@planSummary')->name('user.plan.summary');
        Route::get('/items/show/{plan_id}', 'UserPlansController@plan_itemsGet')->name('show.items');
        Route::post('/{id}/item/add', 'UserPlansController@planItemsStore')->name('user.plan.items.store');
        Route::post('/{id}/item/{item_id}/edit', 'UserPlansController@planItemsEdit')->name('user.plan.items.edit');
    });

    Route::group(['prefix' => 'submission'], function(){
        Route::get('/', 'UserSubmissionsController@index')->name('user.plan.submission');
    });

    Route::post('/update/profile/{id}', 'AccountsController@updateProfileAdmin')->name('user.update.profile');
    Route::get('/edit/profile/{id}', 'AccountsController@editProfileAdmin')->name('user.edit.profile');



});

Route::group(['middleware' => ['auth','budget'],'prefix' => 'budget'], function(){
    Route::group(['prefix' => 'plan'], function(){
        Route::get('/', 'BudgetPlansController@index')->name('budget.plans');
        Route::get('/{id}', 'BudgetPlansController@show')->name('budget.plans.details');
        Route::get('/approved/{id}', 'BudgetPlansController@approved')->name('budget.approved');
        Route::post('/disapproved/{id}', 'BudgetPlansController@disapproved')->name('budget.disapproved');
    });

    Route::group(['prefix' => 'submissions'], function(){
        Route::get('/', 'SubmissionsController@index')->name('submissions');
        Route::get('/{id}', 'SubmissionsController@activate')->name('submission.activate');
        Route::get('/consolidation/{year}', 'SubmissionsController@consolidation')->name('consolidation');
        Route::get('/consolidation/item/{id}/plan_year/{year}', 'SubmissionsController@consolidationItem')->name('consolidation.item');
        Route::post('/', 'SubmissionsController@store')->name('submission.store');
        Route::post('/edit/{id}', 'SubmissionsController@update')->name('submission.update');
        Route::post('/budget/{id}/update', 'BudgetUsersController@budgetUpdate')->name('budget.update');
        Route::get('/budget/{id}', 'BudgetUsersController@budgetIndex')->name('submission.budget');
        Route::get('/budget/{id}/modify', 'BudgetUsersController@budgetModifyIndex')->name('submission.budget.modify');
        Route::post('/budget/store/{id}/modify', 'BudgetUsersController@budgetStoreModified')->name('budget.store.modify');
        Route::post('/budget/store/{id}', 'BudgetUsersController@budgetStore')->name('budget.store');
        Route::get('/budget/delete/{id}', 'BudgetUsersController@budgetDelete')->name('budget.delete');
    });

    Route::post('/update/profile/{id}', 'AccountsController@updateProfileAdmin')->name('budget.update.profile');
    Route::get('/edit/profile/{id}', 'AccountsController@editProfileAdmin')->name('budget.edit.profile');

});

Route::group(['middleware' => ['auth','vp'],'prefix' => 'vp'], function(){
    Route::group(['prefix' => 'approvals'], function(){
        Route::get('/', 'VPApprovalsController@index')->name('vp.approvals');
        Route::get('/approved/plan', 'VPApprovalsController@approvedVP')->name('vp.approved.plans');
        Route::get('/plan/{id}/items', 'VPApprovalsController@planSummary')->name('vp.plan.items');
        Route::get('/{id}', 'VPApprovalsController@approved')->name('vp.approved');
        Route::post('/{id}', 'VPApprovalsController@disapproved')->name('vp.disapproved');
    });

    Route::post('/update/profile/{id}', 'AccountsController@updateProfileAdmin')->name('vp.update.profile');
    Route::get('/edit/profile/{id}', 'AccountsController@editProfileAdmin')->name('vp.edit.profile');
});

Route::group(['middleware' => ['auth','op'],'prefix' => 'op'], function(){
    Route::group(['prefix' => 'approvals'], function(){
        Route::get('/', 'OPApprovalsController@index')->name('op.approvals');
        Route::get('/approved/plan', 'OPApprovalsController@approvedOP')->name('op.approved.plans');
        Route::get('/plan/{id}/items', 'OPApprovalsController@planSummary')->name('op.plan.items');
        Route::get('/{id}', 'OPApprovalsController@approved')->name('op.approved');
        Route::post('/{id}', 'OPApprovalsController@disapproved')->name('op.disapproved');
    });

    Route::post('/update/profile/{id}', 'AccountsController@updateProfileAdmin')->name('op.update.profile');
    Route::get('/edit/profile/{id}', 'AccountsController@editProfileAdmin')->name('op.edit.profile');
});

