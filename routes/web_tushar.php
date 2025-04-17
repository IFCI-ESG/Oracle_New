<?php
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\RoutingController;
use Illuminate\Support\Facades\Route;
 //use App\Http\Controllers\Admin\LoginController;
// use App\Http\Controllers\Admin\HomeController;
// use App\Http\Controllers\Admin\UserController;


require __DIR__ . '/auth.php';

// // Route::get('', [RoutingController::class, 'index'])->name('landing');

// Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {
//     Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
//     Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
//     Route::get('{any}', [RoutingController::class, 'root'])->name('any');
//  });



Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/', [\App\Http\Controllers\Admin\LoginController::class, 'showLoginForm'])->name('/');

Route::get('/admin/login', [\App\Http\Controllers\Admin\LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [\App\Http\Controllers\Admin\LoginController::class, 'login'])
    ->name('admin.login');


    Route::post('/admin/logout', [\App\Http\Controllers\Admin\LoginController::class, 'logout'])
    ->name('admin.logout');
//Route::get('admin/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
//Route::post('admin/login', 'Admin\LoginController@login')->name('admin.login');
//Route::post('admin/logout', 'Admin\LoginController@logout')->name('admin.logout');



Route::name('admin.')->prefix('admin')->middleware(['auth:admin','role:SuperAdmin|Admin', 'IsApproved', 'preventBackHistory'])->group(function () {
    // Route::get('{any}', [\App\Http\Controllers\RoutingController::class, 'root'])->name('any');
    Route::get('/home', [\App\Http\Controllers\Admin\HomeController::class,'index'])->name('home');
     Route::get('dash',[\App\Http\Controllers\Admin\UserController::class, 'dash'])->name('dash');
    Route::get('env_mis', [\App\Http\Controllers\Admin\UserController::class, 'env_mis'])->name('env_mis');
    // Company List

    Route::get('user', [\App\Http\Controllers\Admin\UserController::class, 'user_index'])->name('user.index');
    Route::get('user/add', [\App\Http\Controllers\Admin\UserController::class, 'adduser'])->name('adduser');
    Route::get('user/apidata', [\App\Http\Controllers\Admin\UserController::class,'apidata'])->name('user.apidata');
    Route::post('user/store', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('user.store');
    Route::get('user/edit/{id}', [\App\Http\Controllers\Admin\UserController::class, 'edituser'])->name('user.edituser');
    Route::get('user/edit/{id}', [\App\Http\Controllers\Admin\UserController::class, 'edituser'])->name('user.edituser');
    Route::post('user/update',  [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('user.update');
    Route::post('user/submit', [\App\Http\Controllers\Admin\UserController::class, 'submit'])->name('user.submit');
    Route::get('user/exist/{id}', [\App\Http\Controllers\Admin\UserController::class, 'existuser'])->name('user.existuser');
    Route::post('user/existsubmit', [\App\Http\Controllers\Admin\UserController::class, 'existsubmit'])->name('user.existsubmit');
    Route::get('user/exist_edit/{id}', [\App\Http\Controllers\Admin\UserController::class, 'existuser_edit'])->name('user.existuser_edit');
    Route::get('user/delete/{id}', [\App\Http\Controllers\Admin\UserController::class, 'delete'])->name('user.deleteuser');
    Route::get('user/view/{id}', [\App\Http\Controllers\Admin\UserController::class, 'viewuser'])->name('user.viewuser');
    Route::post('user/existupdate', [\App\Http\Controllers\Admin\UserController::class, 'existupdate'])->name('user.existupdate');
    Route::get('user/prowess/api',[\App\Http\Controllers\Admin\UserController::class, 'prowessapi'])->name('user.prowessapi');

    // Create Bulk Company

     Route::get('user/bulk/company/create', [\App\Http\Controllers\Admin\CompanyBulkUploadController::class, 'createBulkCompany'])->name('user.bulk.company.create');
    Route::post('user/bulk/company/store',[\App\Http\Controllers\Admin\CompanyBulkUploadController::class, 'storeCorp'])->name('user.bulk.company.store');
    Route::delete('user/bulk/company/{file}', [\App\Http\Controllers\Admin\CompanyBulkUploadController::class, 'deleteCorp'])->name('user.bulk.company.delete');
    Route::get('bank_branch_bulk/index', [\App\Http\Controllers\Admin\BankBranchController::class, 'index'])->name('bank_branch_bulk.index');
    Route::get('bank_branch_bulk/create', [\App\Http\Controllers\Admin\BankBranchController::class, 'create'])->name('bank_branch_bulk.create');
    Route::post('bank_branch_bulk/store', [\App\Http\Controllers\Admin\BankBranchController::class, 'store'])->name('bank_branch_bulk.store');
    Route::get('new_admin', [\App\Http\Controllers\Admin\BankController::class,'index'])->name('new_admin.index');
    Route::get('new_admin/create', [\App\Http\Controllers\Admin\BankController::class,'create'])->name('new_admin.create');
    Route::post('new_admin/store', [\App\Http\Controllers\Admin\BankController::class,'store'])->name('new_admin.store');
    Route::get('new_admin/edit/{id}', [\App\Http\Controllers\Admin\BankController::class,'edit'])->name('new_admin.edit');
    Route::post('new_admin/update', [\App\Http\Controllers\Admin\BankController::class,'update'])->name('new_admin.update');
    Route::post('new_admin/submit', [\App\Http\Controllers\Admin\BankController::class,'submit'])->name('new_admin.submit');
    Route::get('new_admin/com_list/{bank_id}', [\App\Http\Controllers\Admin\BankController::class,'com_list'])->name('new_admin.com_list');

     //Route::get('companies', 'Admin\UserController@companies')->name('companies');
     //Route::get('dash_v1', 'Admin\UserController@dash_v1')->name('dash_v1');
     //Route::get('dash_v2', 'Admin\UserController@dash_v2')->name('dash_v2');


   Route::post('company_bulk/corp/store', 'Admin\CompanyBulkUploadController@storeCorp')->name('company_bulk.corp.store');
   Route::post('company_bulk/retail/store', 'Admin\CompanyBulkUploadController@storeRetail')->name('company_bulk.retail.store');
    Route::get('locuz', 'Admin\UserController@locuz')->name('locuz');
      Route::get('retail/add', 'Admin\UserController@retail_adduser')->name('retail.adduser');
    Route::get('user/retail_apidata', 'Admin\UserController@retail_apidata')->name('retail.apidata');
    Route::post('retail/store', 'Admin\UserController@retail_store')->name('retail.store');
    Route::get('retail_edit/{id}', 'Admin\UserController@retail_edituser')->name('retail.edituser');
    Route::post('retail/update', 'Admin\UserController@retail_update')->name('retail.update');
    Route::get('retail/exist/{id}', 'Admin\UserController@retail_existuser')->name('retail.existuser');
    Route::post('retail/submit', 'Admin\UserController@retail_submit')->name('retail.submit');
    Route::post('retail/existsubmit', 'Admin\UserController@retail_existsubmit')->name('retail.existsubmit');
    Route::get('retail/exist_edit/{id}', 'Admin\UserController@retail_existuser_edit')->name('retail.existuser_edit');
    Route::post('retail/existupdate', 'Admin\UserController@retail_existupdate')->name('retail.existupdate');

    Route::get('company_list', 'Admin\ListController@index')->name('user.company_list');
    Route::get('company/view/{com_id}/{fy_id}', 'Admin\ListController@view')->name('user.company_view');
    Route::get('/company_data_view/{head_id}/{fy_id}/{com_id}', 'Admin\ListController@getSubQuesData_view')->name('companyData_view');
    Route::get('bank', 'Admin\BankController@index')->name('bank');


});


// Company
//Auth::routes(['register' => false]);


    Route::group(['middleware' => ['role:ActiveUser', 'verified', 'IsApproved', 'preventBackHistory']], function () {
        Route::get('/home', [\App\Http\Controllers\HomeController::class,'index'])->name('home');
        Route::get('/verifyuser',[\App\Http\Controllers\HomeController::class,'verifyUser'])->name('verifyUser');
    });



    Route::name('user.')->prefix('user')->middleware(['role:ActiveUser', 'verified', 'IsApproved', 'preventBackHistory'])->group(function () {

    //Route::post('plant', \App\Http\Controllers\User\PlantLocationController::class);



    Route::resource('plant',\App\Http\Controllers\User\PlantLocationController::class);

    Route::get('/plant/edit/{user_id}', [\App\Http\Controllers\User\PlantLocationController::class,'edit'])->name('plant.edit');

    Route::get('plant/row_delete/{row_id}/{section}', [\App\Http\Controllers\User\PlantLocationController::class,'destroy'])->name('plant.delete');

    Route::get('environment', [\App\Http\Controllers\User\UserController::class,'index'])->name('environment');




    Route::get('segment/{seg_id}/{id}', 'User\UserController@segment')->name('segment');
    Route::get('segment_edit/{seg_id}/{id}', 'User\UserController@segment')->name('segmentedit');

    Route::resource('social', 'User\SocialController', ['except' => 'create','update']);
    Route::get('/social/create/{fy_id}', 'User\SocialController@create')->name('social.create');
    Route::post('social/store', 'User\SocialController@store')->name('social');
    Route::get('/social/edit/{social_mast_id}', 'User\SocialController@edit')->name('social.edit');
    Route::post('/social/update', 'User\SocialController@update')->name('social.update');
    Route::get('/social/download/file/{id}', 'User\SocialController@downloadFile')->name('social.download.file');

    Route::resource('governance', 'User\GovernanceController', ['except' => 'create','update']);
    Route::get('/governance/create/{fy_id}', 'User\GovernanceController@create')->name('governance.create');
    Route::post('governance/store', 'User\GovernanceController@store')->name('governance');
    Route::get('/governance/edit/{gov_mast_id}', 'User\GovernanceController@edit')->name('governance.edit');
    Route::post('/governance/update', 'User\GovernanceController@update')->name('governance.update');

    Route::resource('physical', 'User\PhysicalController', ['except' => 'create','update']);
    Route::get('/physical/create/{fy_id}', 'User\PhysicalController@create')->name('physical.create');
    Route::post('physical/store', 'User\PhysicalController@store')->name('physical');
    Route::get('/physical/edit/{module_mast_id}', 'User\PhysicalController@edit')->name('physical.edit');
    Route::post('/physical/update', 'User\PhysicalController@update')->name('physical.update');

    Route::resource('transition', 'User\TransitionController', ['except' => 'create','update']);
    Route::get('/transition/create/{fy_id}', 'User\TransitionController@create')->name('transition.create');
    Route::post('transition/store', 'User\TransitionController@store')->name('transition');
    Route::get('/transition/edit/{module_mast_id}', 'User\TransitionController@edit')->name('transition.edit');
    Route::post('/transition/update', 'User\TransitionController@update')->name('transition.update');
    Route::get('fy/{bank_id}/{class_type}', [\App\Http\Controllers\User\UserController::class,'fy'])->name('fy');

    //Route::get('fy/{bank_id}/{class_type}', 'User\UserController@fy')->name('fy');

    //::get('bank', 'User\UserController@bank')->name('bank');

    Route::get('bank', [\App\Http\Controllers\User\UserController::class,'bank'])->name('bank');


    Route::get('thematic', 'User\ThematicController@index')->name('thematic');
    Route::get('thematic/pillar/{pillar_id}', 'User\ThematicController@pillar')->name('thematic.pillar');
    Route::post('thematic/store/', 'User\ThematicController@store')->name('thematic.store');
    Route::get('thematic/edit/{com_id}/{pillar_id}', 'User\ThematicController@edit')->name('thematic.edit');
    Route::post('thematic/update', 'User\ThematicController@update')->name('thematic.update');
    Route::get('climate', 'User\UserController@climate')->name('climate');

    Route::get('climate', [\App\Http\Controllers\User\UserController::class,'climate'])->name('climate');



    Route::get('risk', 'User\UserController@risk')->name('risk');
    Route::get('xml', 'User\UserController@xml')->name('xml');
    Route::post('xml_store', 'User\UserController@xml_store')->name('xml_store');
    Route::get('questionnaire/{bank_id}/{class_type}/{fy_id}', 'User\UserController@addquestionnaire')->name('addquestionnaire');


    Route::get('motor/{bank_id}/{class_type}/{fy_id}', 'User\MotorVehicleController@create')->name('motor');
    Route::post('motor/store/', 'User\MotorVehicleController@store')->name('motor.store');

    Route::get('/get_ques_data/{sect_id}/{seg_id}', 'User\UserController@getQuesData')->name('getQuesData');
    Route::get('/get_ques_data_view/{seg_id}/{fy_id}', 'User\UserController@getQuesData_view')->name('getQuesData_view');

    Route::post('questionnaire/store', 'User\UserController@store')->name('questionnaire.store');
    Route::post('questionnaire/update', 'User\UserController@update')->name('questionnaire.update');
    Route::get('edit/questionnaire/{ques_id}/{fy_id}', 'User\UserController@editquestionnaire')->name('editquestionnaire');
    Route::get('ques_delete/{id}', 'User\UserController@destroy')->name('ques_delete');
    Route::get('questionnaire/update', 'User\UserController@update')->name('questionnaire.update');
    Route::post('questionnaire/submit', 'User\UserController@submit')->name('questionnaire.submit');
    Route::post('questionnaire/quality_store', 'User\UserController@quality_store')->name('questionnaire.quality_store');

    Route::get('print_preview/{com_id}/{fy_id}/{bank_id}/{class_type}', 'User\UserController@print_preview')->name('print_preview');
    Route::post('store_undertaking_doc', 'User\UserController@store_undertaking_doc')->name('store_undertaking_doc');
    Route::post('update_undertaking_doc', 'User\UserController@update_undertaking_doc')->name('update_undertaking_doc');
    Route::get('/download/file/{id}', 'User\UserController@downloadFile')->name('download.file');

    Route::get('questionnaire_view/{bank_id}/{class_type}/{com_id}/{fy_id}', 'User\UserController@view')->name('questionnaire_view');
    Route::get('/questionnaire_data_view/{seg_id}/{fy_id}/{com_id}', 'User\UserController@getQuesData_onlyview')->name('questionnaireData_view');

    Route::post('activity/store', 'User\UserController@activity_store')->name('activity.store');
    Route::post('quality/store', 'User\UserController@quality_store')->name('quality.store');

    Route::post('unsdg', 'User\UserController@unsdg_store')->name('unsdg.store');
    Route::post('unsdg_edit', 'User\UserController@unsdg_update')->name('unsdg.edit');

    Route::patch('questionnaire/update', 'User\UserController@update')->name('questionnaire.update');

    Route::post('questionnaire/docstore', 'User\UserController@docstore')->name('questionnaire.docstore');

    Route::get('/doc_view/{part_id}/{row_id}', 'User\UserController@doc_view')->name('doc_view.rowId');
    Route::post('/doc_update', 'User\UserController@doc_update')->name('doc_update.uploadId');
    Route::get('doc_delete/{upload_id}/{part_id}/{id}', 'User\UserController@doc_destroy')->name('doc_delete.deleteId');

    Route::get('/download/file/{id}', 'User\UserController@downloadFile')->name('download.file');

     Route::resource('scoring', 'User\ScoringController', ['except' => 'create','update']);
    Route::get('/scoring/create/{fy_id}', 'User\ScoringController@create')->name('scoring.create');
    Route::post('scoring/store', 'User\ScoringController@store')->name('scoring');
    Route::get('/scoring/edit/{gov_mast_id}', 'User\ScoringController@edit')->name('scoring.edit');
    Route::post('/scoring/update', 'User\ScoringController@update')->name('scoring.update');
   Route::get('/scoring/view/{gov_mast_id}', 'User\ScoringController@show')->name('scoring.view');


  Route::resource('seq', 'User\SEQController', ['except' => 'create','update']);
    Route::get('/seq/create/{fy_id}', 'User\SEQController@create')->name('seq.create');
    Route::post('seq/store', 'User\SEQController@store')->name('seq');
    Route::get('/seq/edit/{gov_mast_id}', 'User\SEQController@edit')->name('seq.edit');
    Route::post('/seq/update', 'User\SEQController@update')->name('seq.update');
    Route::get('seq/row_delete/{row_id}', 'User\SEQController@destroy')->name('seq.delete');

 Route::resource('brsr', 'User\BrsrController', ['except' => 'create','update']);
    Route::get('/brsr/create/{fy_id}', 'User\BrsrController@create')->name('brsr.create');
    Route::post('brsr/store', 'User\BrsrController@store')->name('brsr');
    Route::get('/brsr/edit/{gov_mast_id}', 'User\BrsrController@edit')->name('brsr.edit');
    Route::post('/brsr/update', 'User\BrsrController@update')->name('brsr.update');
    Route::get('brsr/row_delete/{row_id}', 'User\BrsrController@destroy')->name('brsr.delete');


});
