<?php
    use App\Http\Controllers\Auth\AuthenticatedSessionController;
    use App\Http\Controllers\RoutingController;
    use Illuminate\Support\Facades\Route;

    require __DIR__ . '/auth.php';

    Route::get('/', function () {
    return view('landing.home');
    })->middleware('preventBackHistory');
    Route::get('/application', function () {
    return view('landing.application');
    });
    Route::get('/about_esg', function () {
    return view('landing.about_esg');
    })->name('about_esg');
    Route::get('/about_ifci', function () {
    return view('landing.about_ifci');
    })->name('about_ifci');
    Route::get('/about_teri', function () {
    return view('landing.about_teri');
    })->name('about_teri');
    Route::get('/lop', function () {
    return view('landing.lop');
    });
    Route::get('/guidelines', function () {
    return view('landing.guidelines');
    });
    Route::get('/contact-us', function () {
    return view('landing.contact-us');
    });
    Route::get('/reg-received', function () {
    return view('landing.reg-received');
    });
    Route::get('/copyright-policy', function () {
    return view('landing.copyright-policy');
    })->name('copyright-policy');
    Route::get('/privacy-policy', function () {
    return view('landing.privacy-policy');
    })->name('privacy-policy');
    Route::get('/hyperlink-policy', function () {
    return view('landing.hyperlink-policy');
    })->name('hyperlink-policy');

    Route::get('/flash-card', function () {
    return view('landing.flash_card');
    })->name('flash-card');

    Route::get('/landing', [\App\Http\Controllers\HomeController::class, 'home'])
    ->name('landing');
    Route::get('/about', [\App\Http\Controllers\HomeController::class, 'about'])
    ->name('about');
    Route::get('/key_policy', [\App\Http\Controllers\HomeController::class, 'key_policy'])->name('key_policy');
    Route::get('/panchamrit', [\App\Http\Controllers\HomeController::class, 'panchamrit'])->name('panchamrit');
    Route::get('/contact', [\App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
    Route::get('/calculator', [\App\Http\Controllers\HomeController::class, 'calculator'])->name('calculator');
    Route::get('/send-otp', [\App\Http\Controllers\HomeController::class, 'sendOtp'])->name('sendOtp');
    Route::get('/verify-otp', [\App\Http\Controllers\HomeController::class, 'verifyOtp'])->name('verifyOtp');
    Route::get('/faq', [\App\Http\Controllers\HomeController::class, 'faq'])
    ->name('faq');
    Route::get('/tool', [\App\Http\Controllers\HomeController::class, 'tool'])
    ->name('tool');

    Route::post('inquiryMail',  [\App\Http\Controllers\HomeController::class, 'inquiryMail'])->name('inquiry');
    Route::get('/explore', [\App\Http\Controllers\HomeController::class, 'explore'])
    ->name('explore');


    Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'create'])
    ->middleware('guest')
    ->name('login');

    Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'store'])
    ->middleware('guest');

    Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');  

    //Route::get('/', [\App\Http\Controllers\Admin\LoginController::class, 'showLoginForm'])->name('/');

    Route::get('/admin/login', [\App\Http\Controllers\Admin\LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::get('/signup', [\App\Http\Controllers\Admin\SignupController::class, 'showSignupForm'])->name('signup');
    Route::post('/signup', [\App\Http\Controllers\Admin\SignupController::class, 'submitSignupForm'])->name('submit_signup');
    Route::post('/admin/login', [\App\Http\Controllers\Admin\LoginController::class, 'login'])
    ->name('admin.login');
    Route::post('/admin/validate-credentials', [\App\Http\Controllers\Admin\LoginController::class, 'validateCredentials'])->name('admin.validate.credentials');
    Route::post('/admin/verify-otp', [\App\Http\Controllers\Admin\LoginController::class, 'verifyOtpAndLogin'])->name('admin.verify.otp');

    Route::post('/admin/resend-otp', [\App\Http\Controllers\Admin\LoginController::class, 'resendOtp'])->name('admin.resend.otp');

    Route::post('/admin/logout', [\App\Http\Controllers\Admin\LoginController::class, 'logout'])
    ->name('admin.logout');
    //Route::get('admin/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    //Route::post('admin/login', 'Admin\LoginController@login')->name('admin.login');
    //Route::post('admin/logout', 'Admin\LoginController@logout')->name('admin.logout');



    Route::name('admin.')->prefix('admin')->middleware(['auth:admin','role:SuperAdmin|Admin|SubAdmin', 'IsApproved', 'preventBackHistory'])->group(function () {
    // Route::get('{any}', [\App\Http\Controllers\RoutingController::class, 'root'])->name('any');
    Route::get('/home', [\App\Http\Controllers\Admin\HomeController::class,'index'])->name('home');
    Route::get('dash',[\App\Http\Controllers\Admin\UserController::class, 'dash'])->name('dash');
    Route::get('env_mis', [\App\Http\Controllers\Admin\UserController::class, 'env_mis'])->name('env_mis');

    Route::get('bank_env_mis', [\App\Http\Controllers\Admin\UserController::class, 'bank_env_mis'])->name('bank_env_mis');

    Route::get('bank_dash_environment',[\App\Http\Controllers\Admin\UserController::class, 'bank_dash_environment'])->name('bank_dash_environment');
    Route::get('bank_dash_social',[\App\Http\Controllers\Admin\UserController::class, 'bank_dash_social'])->name('bank_dash_social');
    Route::get('bank_dash_governance',[\App\Http\Controllers\Admin\UserController::class, 'bank_dash_governance'])->name('bank_dash_governance');
    Route::get('bank_dash_scoring',[\App\Http\Controllers\Admin\UserController::class, 'bank_dash_scoring'])->name('bank_dash_scoring');
    Route::get('bank_dash_climate_risk',[\App\Http\Controllers\Admin\UserController::class, 'bank_dash_climate_risk'])->name('bank_dash_climate_risk');

    Route::get('bank_dash_climate_risk_view',[\App\Http\Controllers\Admin\UserController::class, 'bank_dash_climate_risk_view'])->name('bank_dash_climate_risk_view');


    Route::get('dash_environment',[\App\Http\Controllers\Admin\UserController::class, 'dash_environment'])->name('dash_environment');
    Route::get('dash_social',[\App\Http\Controllers\Admin\UserController::class, 'dash_social'])->name('dash_social');
    Route::get('dash_governance',[\App\Http\Controllers\Admin\UserController::class, 'dash_governance'])->name('dash_governance');
    Route::get('dash_scoring',[\App\Http\Controllers\Admin\UserController::class, 'dash_scoring'])->name('dash_scoring');
    Route::get('dash_climate_risk',[\App\Http\Controllers\Admin\UserController::class, 'dash_climate_risk'])->name('dash_climate_risk');

    // Company List

    Route::get('user', [\App\Http\Controllers\Admin\UserController::class, 'user_index'])->name('user.index');
    Route::get('user/add', [\App\Http\Controllers\Admin\UserController::class, 'adduser'])->name('adduser');
    Route::get('user/getBranchDetails', [\App\Http\Controllers\Admin\UserController::class, 'getBranchDetails'])->name('user.getBranchDetails');
    Route::get('user/home/{id}', [\App\Http\Controllers\Admin\UserController::class, 'inspect_company'])->name('user.home');
    Route::get('user/apidata', [\App\Http\Controllers\Admin\UserController::class,'apidata'])->name('user.apidata');
    Route::post('user/store', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('user.store');
    Route::get('user/check-ifsc-code/{ifscCode}', [\App\Http\Controllers\Admin\UserController::class, 'checkIFSCCode'])->name('check-ifsc-code');


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
    Route::delete('user/bulk/company_temp_row_delete/{row_id}', [\App\Http\Controllers\Admin\CompanyBulkUploadController::class, 'deleteCompanyTempRow'])->name('user.row.company_temp_row_delete');
    Route::post('user/bulk/company/update', [\App\Http\Controllers\Admin\CompanyBulkUploadController::class, 'updateCompany'])->name('user.bulk.company.update');
    Route::post('user/bulk/company/delete', [\App\Http\Controllers\Admin\CompanyBulkUploadController::class, 'deleteAllCompanyRecords'])->name('user.bulk.company.delete');
    Route::post('user/bulk/company/finalsubmit', [\App\Http\Controllers\Admin\CompanyBulkUploadController::class, 'FinalSubmitCompanyRecords'])->name('user.bulk.company.finalsubmit');
    Route::get('user/bulk/company/finalinsertcorp', [\App\Http\Controllers\Admin\CompanyBulkUploadController::class, 'FinalInsertCorp'])->name('user.bulk.company.finalinsertcorp');

    // In web.php or api.php (depending on your structure)

    Route::get('new_admin', [\App\Http\Controllers\Admin\BankController::class,'index'])->name('new_admin.index');
    Route::get('new_admin/create', [\App\Http\Controllers\Admin\BankController::class,'create'])->name('new_admin.create');
    Route::post('new_admin/store', [\App\Http\Controllers\Admin\BankController::class,'store'])->name('new_admin.store');
    Route::get('new_admin/edit/{id}', [\App\Http\Controllers\Admin\BankController::class,'edit'])->name('new_admin.edit');
    Route::post('new_admin/update', [\App\Http\Controllers\Admin\BankController::class,'update'])->name('new_admin.update');
    Route::post('new_admin/submit', [\App\Http\Controllers\Admin\BankController::class,'submit'])->name('new_admin.submit');
    Route::get('new_admin/com_list/{bank_id}', [\App\Http\Controllers\Admin\BankController::class,'com_list'])->name('new_admin.com_list');

    // Ashutosh Routes (Apmosys) modified by tushar on 080225

    Route::get('bank_branch_bulk/create', [\App\Http\Controllers\Admin\BankBranchController::class, 'create'])->name('bank_branch_bulk.create');
    Route::post('bank_branch_bulk/bulk_store', [\App\Http\Controllers\Admin\BankBranchController::class, 'bulk_store'])->name('bank_branch_bulk.bulk_store');
    Route::get('bank_branch/index', [\App\Http\Controllers\Admin\BankBranchController::class, 'index'])->name('bank_branch.index');
    Route::get('bank_branch/addbranch', [\App\Http\Controllers\Admin\BankBranchController::class, 'add'])->name('bank_branch.addbranch');
    Route::post('bank_branch/store', [\App\Http\Controllers\Admin\BankBranchController::class, 'store'])->name('bank_branch.store');
    Route::get('bank_branch/edit/{id}', [\App\Http\Controllers\Admin\BankBranchController::class, 'edit'])->name('bank_branch.edit');
    Route::post('bank_branch/update', [\App\Http\Controllers\Admin\BankBranchController::class, 'update'])->name('bank_branch.update');
    Route::post('bank_branch/submit', [\App\Http\Controllers\Admin\BankBranchController::class, 'submit'])->name('bank_branch.submit');
    Route::get('bank_branch/view/{id}', [\App\Http\Controllers\Admin\BankBranchController::class, 'view'])->name('bank_branch.view');
    // Added by Owais
    Route::post('bank_branch/delete', [\App\Http\Controllers\Admin\BankBranchController::class, 'deleteAllBranchRecords'])->name('bank_branch.delete');
    Route::delete('bank_branch/branch_temp_row_delete/{row_id}', [\App\Http\Controllers\Admin\BankBranchController::class, 'deleteBranchTempRow'])->name('bank_branch.branch_temp_row_delete');
    Route::post('bank_branch/updatebranch', [\App\Http\Controllers\Admin\BankBranchController::class, 'updateBranch'])->name('bank_branch.updatebranch');
    Route::post('bank_branch/finalsubmit', [\App\Http\Controllers\Admin\BankBranchController::class, 'FinalSubmitBranchRecords'])->name('bank_branch.finalsubmit');
    Route::get('bank_branch/finalinsert', [\App\Http\Controllers\Admin\BankBranchController::class, 'FinalInsert'])->name('bank_branch.finalinsert');
    Route::get('user/getPincodeDetails', [\App\Http\Controllers\Admin\BankBranchController::class, 'getPincodeDetails'])->name('bank_branch.getPincodeDetails');

    // Route::get('bank_branch_bulk/editbranch/{id}', [\App\Http\Controllers\Admin\BankBranchController::class, 'edit'])->name('bank_branch_bulk.editbranch');
    // Route::get('/admin/bank-branch/{id}/view', [\App\Http\Controllers\Admin\BankBranchController::class, 'view'])->name('admin.bank_branch_bulk.viewbranch');

    Route::get('/new_admin/bank/activate/{id}', [\App\Http\Controllers\Admin\BankController::class, 'activate'])->name('new_admin.bank.activate');
    Route::get('/new_admin/bank/deactivate/{id}', [\App\Http\Controllers\Admin\BankController::class, 'deactivate'])->name('new_admin.bank.deactivate');
    //Route::post('/new_admin/update-account', [\App\Http\Controllers\Admin\BankController::class, 'updateAccount'])->name('new_admin.updateAccount');
    Route::post('/new_admin/bank/update-account', [\App\Http\Controllers\Admin\BankController::class, 'updateAccount'])
    ->name('new_admin.bank.updateAccount');
    Route::get('new_admin/edit/{id}', [\App\Http\Controllers\Admin\BankController::class, 'edit'])->name('new_admin.edit');
    Route::get('new_admin/view/{id}', [\App\Http\Controllers\Admin\BankController::class, 'view'])->name('new_admin.view');
    Route::post('/new_admin/bank/generate-otp', [\App\Http\Controllers\Admin\BankController::class, 'generateOtp'])
    ->name('new_admin.bank.generateOtp');

    // end here

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
    Route::get('user/adminhome', [\App\Http\Controllers\Admin\BankController::class,'adminhome'])->name('user.adminhome');
    Route::post('user/dataupdate', [\App\Http\Controllers\Admin\BankController::class,'dataupdate'])->name('user.dataupdate');

    // Dashboard Export and Refresh routes
    Route::post('/export-dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'exportDashboard'])->name('dashboard.export');
    Route::post('/refresh-dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'refreshDashboard'])->name('dashboard.refresh');


    Route::get('rbi_disclosure', [\App\Http\Controllers\Admin\RbiDisclosureController::class,'index'])->name('rbi_disclosure');
    // Route::get('rbi_disclosure/fy/{fy_id}', [\App\Http\Controllers\Admin\RbiDisclosureController::class,'fy'])->name('rbi_disclosure.fy');
    Route::get('rbi_disclosure/pillar/{fy_id}', [\App\Http\Controllers\Admin\RbiDisclosureController::class,'pillar'])->name('rbi_disclosure.pillar');
    Route::get('rbi_disclosure/crete/{pillar_id}/{fy_id}', [\App\Http\Controllers\Admin\RbiDisclosureController::class,'create'])->name('rbi_disclosure.create');
    Route::post('rbi_disclosure/store', [\App\Http\Controllers\Admin\RbiDisclosureController::class,'store'])->name('rbi_disclosure.store');
    Route::get('rbi_disclosure/edit/{bank_id}/{pillar_id}/{fy_id}', [\App\Http\Controllers\Admin\RbiDisclosureController::class,'edit'])->name('rbi_disclosure.edit');
    Route::post('rbi_disclosure/update', [\App\Http\Controllers\Admin\RbiDisclosureController::class,'update'])->name('rbi_disclosure.update');
    Route::get('rbi_disclosure/view/{bank_id}/{pillar_id}/{fy_id}', [\App\Http\Controllers\Admin\RbiDisclosureController::class,'view'])->name('rbi_disclosure.view');

    Route::get('rbi_disclosure/final_submit/{fy_id}', [\App\Http\Controllers\Admin\RbiDisclosureController::class,'final_submit'])->name('rbi_disclosure.final_submit');

        Route::get('rbi_disclosure/generate-pdf/{fy_id}', [\App\Http\Controllers\Admin\RbiDisclosureController::class,'generatePdf'])->name('rbi_disclosure.generatepdf');

    });

    // Company
    //Auth::routes(['register' => false]);

    Route::group(['middleware' => ['role:ActiveUser', 'verified', 'IsApproved', 'preventBackHistory']], function () {
    Route::get('home', [\App\Http\Controllers\HomeController::class,'index'])->name('home');
    Route::get('/users/edit/{id}', [\App\Http\Controllers\HomeController::class,'edit'])->name('users.edit');
    Route::post('/users/update', [\App\Http\Controllers\HomeController::class,'update'])->name('users.update2');
    Route::get('admin/adminhome', [\App\Http\Controllers\HomeController::class,'adminhome'])->name('admin.adminhome');
    Route::get('/verifyuser',[\App\Http\Controllers\HomeController::class,'verifyUser'])->name('verifyUser');
    });

    Route::group(['middleware' => ['role:ActiveUser|Admin', 'verified', 'IsApproved']], function () {
    /*** AJAX Routes ***/
    Route::get('/cities/{state}', [\App\Http\Controllers\User\AjaxController::class,'getCity']);
    Route::get('/pincodes/{pincode}',  [\App\Http\Controllers\User\AjaxController::class,'getPin']);
    });

    Route::name('user.')->prefix('user')->middleware(['role:ActiveUser', 'verified', 'IsApproved', 'preventBackHistory'])->group(function () {

    Route::resource('plant',\App\Http\Controllers\User\PlantLocationController::class);
    Route::post('/update-account', [\App\Http\Controllers\User\UserController::class, 'updateAccount'])->name('updateAccount');

    Route::get('/plant/edit/{user_id}', [\App\Http\Controllers\User\PlantLocationController::class,'edit'])->name('plant.edit');

    Route::get('plant/row_delete/{row_id}/{section}', [\App\Http\Controllers\User\PlantLocationController::class,'destroy'])->name('plant.delete');

    Route::get('environment', [\App\Http\Controllers\User\UserController::class,'index'])->name('environment');


    Route::get('segment/{seg_id}/{id}', [\App\Http\Controllers\User\UserController::class,'segment'])->name('segment');
    Route::get('segment_edit/{seg_id}/{id}', [\App\Http\Controllers\User\UserController::class,'segment'])->name('segmentedit');

    Route::resource('social', \App\Http\Controllers\User\SocialController::class)->except(['create','update']);

    Route::get('/social/create/{fy_id}', [\App\Http\Controllers\User\SocialController::class,'create'])->name('social.create');
    Route::get('/social/edit/{social_mast_id}', [\App\Http\Controllers\User\SocialController::class,'edit'])->name('social.edit');
    Route::post('/social/update', [\App\Http\Controllers\User\SocialController::class,'update'])->name('social.update');
    Route::post('/social/store', [\App\Http\Controllers\User\SocialController::class,'store'])->name('social');
    Route::get('/social/download/file/{id}', [\App\Http\Controllers\User\SocialController::class,'create'])->name('social.download.file');

    Route::get('/governance/create/{fy_id}', [\App\Http\Controllers\User\GovernanceController::class,'create'])->name('governance.create');
    Route::get('/governance/edit/{gov_mast_id}', [\App\Http\Controllers\User\GovernanceController::class,'edit'])->name('governance.edit');
    Route::post('/governance/update', [\App\Http\Controllers\User\GovernanceController::class,'update'])->name('governance.update');
    Route::post('/governance/store', [\App\Http\Controllers\User\GovernanceController::class,'store'])->name('governance');
    Route::resource('governance', \App\Http\Controllers\User\GovernanceController::class)->except(['create','update']);


    Route::get('/physical/create/{fy_id}', [\App\Http\Controllers\User\PhysicalController::class,'create'])->name('physical.create');
    Route::get('/physical/edit/{module_mast_id}', [\App\Http\Controllers\User\PhysicalController::class,'edit'])->name('physical.edit');
    Route::post('/physical/update', [\App\Http\Controllers\User\PhysicalController::class,'update'])->name('physical.update');
    Route::get('/physical/store', [\App\Http\Controllers\User\PhysicalController::class,'store'])->name('physical');
    Route::resource('physical', \App\Http\Controllers\User\PhysicalController::class)->except(['create','update']);




    Route::get('/transition/create/{fy_id}', [\App\Http\Controllers\User\TransitionController::class,'create'])->name('transition.create');
    Route::get('/transition/edit/{module_mast_id}', [\App\Http\Controllers\User\TransitionController::class,'edit'])->name('transition.edit');
    Route::post('/transition/update', [\App\Http\Controllers\User\TransitionController::class,'update'])->name('transition.update');
    Route::get('/transition/store', [\App\Http\Controllers\User\TransitionController::class,'store'])->name('transition');
    Route::resource('transition', \App\Http\Controllers\User\TransitionController::class)->except(['create','update']);


    Route::get('fy/{branch_id}/{class_type}', [\App\Http\Controllers\User\UserController::class,'fy'])->name('fy');
    Route::get('bank', [\App\Http\Controllers\User\UserController::class,'bank'])->name('bank');

    Route::get('thematic', [\App\Http\Controllers\User\ThematicController::class,'index'])->name('thematic');
    Route::get('thematic/pillar/{pillar_id}', [\App\Http\Controllers\User\ThematicController::class,'pillar'])->name('thematic.pillar');
    Route::post('thematic/store', [\App\Http\Controllers\User\ThematicController::class,'store'])->name('thematic.store');
    Route::get('thematic/edit/{com_id}/{pillar_id}', [\App\Http\Controllers\User\ThematicController::class,'edit'])->name('thematic.edit');
    Route::post('thematic/update', [\App\Http\Controllers\User\ThematicController::class,'update'])->name('thematic.update');

    //Route::get('climate', 'User\UserController@climate')->name('climate');

    Route::get('climate', [\App\Http\Controllers\User\UserController::class,'climate'])->name('climate');

    Route::get('risk', [\App\Http\Controllers\User\UserController::class,'risk'])->name('risk');


    Route::get('questionnaire/{branch_id}/{class_type}/{fy_id}', [\App\Http\Controllers\User\UserController::class,'addquestionnaire'])->name('addquestionnaire');

    Route::post('questionnaire/store', [\App\Http\Controllers\User\UserController::class,'store'])->name('questionnaire.store');
    Route::get('questionnaire/update', [\App\Http\Controllers\User\UserController::class,'update'])->name('update');
    Route::post('questionnaire/submit', [\App\Http\Controllers\User\UserController::class,'submit'])->name('questionnaire.submit');
    Route::get('edit/questionnaire/{ques_id}/{fy_id}', [\App\Http\Controllers\User\UserController::class,'editquestionnaire'])->name('editquestionnaire');

    Route::get('ques_delete/{id}', [\App\Http\Controllers\User\UserController::class,'destroy'])->name('ques_delete');

    Route::post('questionnaire/quality_store', [\App\Http\Controllers\User\UserController::class,'quality_store'])->name('questionnaire.quality_store');

    Route::get('questionnaire_view/{branch_id}/{class_type}/{com_id}/{fy_id}', [\App\Http\Controllers\User\UserController::class,'view'])->name('questionnaire_view');

    // Route::get('questionnaire_view/{bank_id}/{class_type}/{com_id}/{fy_id}', 'User\UserController@view')->name('questionnaire_view');


    Route::get('/questionnaire_data_view/{seg_id}/{fy_id}/{com_id}', [\App\Http\Controllers\User\UserController::class,'getQuesData_onlyview'])->name('questionnaireData_view');

    //Route::get('/questionnaire_data_view/{seg_id}/{fy_id}/{com_id}', 'User\UserController@getQuesData_onlyview')->name('questionnaireData_view');

    Route::post('activity/store', [\App\Http\Controllers\User\UserController::class,'activity_store'])->name('activity.store');

    // Route::post('activity/store', 'User\UserController@activity_store')->name('activity.store');

    Route::post('quality/store', [\App\Http\Controllers\User\UserController::class,'quality_store'])->name('quality.store');

    // Route::post('quality/store', 'User\UserController@quality_store')->name('quality.store');

    //Route::get('questionnaire/{bank_id}/{class_type}/{fy_id}', 'User\UserController@addquestionnaire')->name('addquestionnaire');
    // Route::post('questionnaire/store', 'User\UserController@store')->name('questionnaire.store');
    //  Route::post('questionnaire/update', 'User\UserController@update')->name('questionnaire.update');
    //  Route::get('edit/questionnaire/{ques_id}/{fy_id}', 'User\UserController@editquestionnaire')->name('editquestionnaire');
    //Route::get('ques_delete/{id}', 'User\UserController@destroy')->name('ques_delete');
    // Route::get('questionnaire/update', 'User\UserController@update')->name('questionnaire.update');
    // Route::post('questionnaire/submit', 'User\UserController@submit')->name('questionnaire.submit');
    //Route::post('questionnaire/quality_store', 'User\UserController@quality_store')->name('questionnaire.quality_store');


    //Route::get('risk', 'User\UserController@risk')->name('risk');
    Route::get('xml', 'User\UserController@xml')->name('xml');
    Route::post('xml_store', 'User\UserController@xml_store')->name('xml_store');



    Route::get('motor/{bank_id}/{class_type}/{fy_id}', 'User\MotorVehicleController@create')->name('motor');
    Route::post('motor/store/', 'User\MotorVehicleController@store')->name('motor.store');

    Route::get('/get_ques_data/{sect_id}/{seg_id}', [\App\Http\Controllers\User\UserController::class,'getQuesData'])->name('getQuesData');
    Route::get('/get_ques_data_view/{seg_id}/{fy_id}', [\App\Http\Controllers\User\UserController::class,'getQuesData_view'])->name('getQuesData_view');


    Route::get('print_preview/{com_id}/{fy_id}/{bank_id}/{class_type}', [\App\Http\Controllers\User\UserController::class,'print_preview'])->name('print_preview');
    Route::post('store_undertaking_doc', [\App\Http\Controllers\User\UserController::class,'store_undertaking_doc'])->name('store_undertaking_doc');
    Route::post('update_undertaking_doc', [\App\Http\Controllers\User\UserController::class,'update_undertaking_doc'])->name('update_undertaking_doc');
    Route::get('/download/file/{id}', [\App\Http\Controllers\User\UserController::class,'downloadFile'])->name('download.file');

    // Route::get('print_preview/{com_id}/{fy_id}/{bank_id}/{class_type}', 'User\UserController@print_preview')->name('print_preview');
    // Route::post('store_undertaking_doc', 'User\UserController@store_undertaking_doc')->name('store_undertaking_doc');
    // Route::post('update_undertaking_doc', 'User\UserController@update_undertaking_doc')->name('update_undertaking_doc');
    // Route::get('/download/file/{id}', 'User\UserController@downloadFile')->name('download.file');



    Route::post('unsdg', 'User\UserController@unsdg_store')->name('unsdg.store');
    Route::post('unsdg_edit', 'User\UserController@unsdg_update')->name('unsdg.edit');

    // Route::patch('questionnaire/update', 'User\UserController@update')->name('questionnaire.update');
    Route::patch('questionnaire/update', [\App\Http\Controllers\User\UserController::class,'update'])->name('questionnaire.update');

    Route::post('questionnaire/docstore', 'User\UserController@docstore')->name('questionnaire.docstore');

    Route::get('/doc_view/{part_id}/{row_id}', 'User\UserController@doc_view')->name('doc_view.rowId');
    Route::post('/doc_update', 'User\UserController@doc_update')->name('doc_update.uploadId');
    Route::get('doc_delete/{upload_id}/{part_id}/{id}', 'User\UserController@doc_destroy')->name('doc_delete.deleteId');

    Route::get('/download/file/{id}', 'User\UserController@downloadFile')->name('download.file');


    Route::resource('scoring', \App\Http\Controllers\User\ScoringController::class)->except(['create','update']);
    Route::post('scoring/store', [\App\Http\Controllers\User\ScoringController::class,'store'])->name('scoring.store');

    Route::get('/scoring/create/{fy_id}', [\App\Http\Controllers\User\ScoringController::class,'create'])->name('scoring.create');

    Route::get('/scoring/edit/{gov_mast_id}', [\App\Http\Controllers\User\ScoringController::class,'edit'])->name('scoring.edit');

    Route::post('scoring/update', [\App\Http\Controllers\User\ScoringController::class,'update'])->name('scoring.update');
    Route::get('/scoring/view/{gov_mast_id}', [\App\Http\Controllers\User\ScoringController::class,'show'])->name('scoring.view');

    Route::post('/scoring/finalsubmit/{module_mast_id}', [\App\Http\Controllers\User\ScoringController::class, 'finalsubmit'])->name('scoring.finalsubmit');


    Route::resource('seq', \App\Http\Controllers\User\SEQController::class)->except(['create','update']);
    Route::get('/seq/create/{fy_id}', [\App\Http\Controllers\User\SEQController::class,'create'])->name('seq.create');
    Route::post('seq/store', [\App\Http\Controllers\User\SEQController::class,'store'])->name('seq');
    Route::get('/seq/edit/{gov_mast_id}', [\App\Http\Controllers\User\SEQController::class,'edit'])->name('seq.edit');
    Route::post('/seq/update', [\App\Http\Controllers\User\SEQController::class,'update'])->name('seq.update');
    Route::get('seq/row_delete/{row_id}', [\App\Http\Controllers\User\SEQController::class,'destroy'])->name('seq.delete');


    Route::get('/brsr', [\App\Http\Controllers\User\BrsrController::class,'index'])->name('brsr.index');
    Route::get('/brsr/sectionAcreate/{fy_id}', [\App\Http\Controllers\User\BrsrController::class,'create'])->name('brsr.sectionAcreate');
    Route::post('/brsr/store', [\App\Http\Controllers\User\BrsrController::class,'store'])->name('brsr.store');
    Route::get('/brsr/sectionAedit/{brsr_mast_id}', [\App\Http\Controllers\User\BrsrController::class,'edit'])->name('brsr.sectionAedit');
    Route::post('/brsr/update', [\App\Http\Controllers\User\BrsrController::class,'update'])->name('brsr.update');
    Route::get('/brsr/sectionBcreate/{fy_id}', [\App\Http\Controllers\User\BrsrController::class,'sectionBcreate'])->name('brsr.sectionBcreate');
    Route::get('/brsr/sectionBedit/{brsr_mast_id}', [\App\Http\Controllers\User\BrsrController::class,'sectionBedit'])->name('brsr.sectionBedit');
    Route::post('/brsr/sectionbstore', [\App\Http\Controllers\User\BrsrController::class,'sectionbstore'])->name('brsr.sectionbstore');
    Route::post('/brsr/sectionbupdate', [\App\Http\Controllers\User\BrsrController::class,'sectionbupdate'])->name('brsr.sectionbupdate');
    
    Route::get('/brsr/sectionP1create/{fy_id}', [\App\Http\Controllers\User\BrsrController::class,'sectionP1create'])->name('brsr.sectionP1create');
    Route::post('/brsr/sectionp1store', [\App\Http\Controllers\User\BrsrController::class,'sectionp1store'])->name('brsr.sectionp1store');
    Route::get('/brsr/sectionP1edit/{brsr_mast_id}', [\App\Http\Controllers\User\BrsrController::class,'sectionP1edit'])->name('brsr.sectionP1edit');
    Route::post('/brsr/sectionp1update', [\App\Http\Controllers\User\BrsrController::class,'sectionp1update'])->name('brsr.sectionp1update');


    Route::get('/brsr/sectionP1create/{fy_id}', [\App\Http\Controllers\User\BrsrController::class,'sectionP1create'])->name('brsr.sectionP1create');
    Route::post('/brsr/sectionp1store', [\App\Http\Controllers\User\BrsrController::class,'sectionp1store'])->name('brsr.sectionp1store');
    Route::get('/brsr/sectionP1edit/{brsr_mast_id}', [\App\Http\Controllers\User\BrsrController::class,'sectionP1edit'])->name('brsr.sectionP1edit');
    Route::post('/brsr/sectionp1update', [\App\Http\Controllers\User\BrsrController::class,'sectionp1update'])->name('brsr.sectionp1update');


    Route::get('/brsr/sectionP2create/{fy_id}', [\App\Http\Controllers\User\BrsrController::class,'sectionP2create'])->name('brsr.sectionP2create');
    Route::post('/brsr/sectionp2store', [\App\Http\Controllers\User\BrsrController::class,'sectionp2store'])->name('brsr.sectionp2store');
    Route::get('/brsr/sectionP2edit/{brsr_mast_id}', [\App\Http\Controllers\User\BrsrController::class,'sectionP2edit'])->name('brsr.sectionP2edit');
    Route::post('/brsr/sectionp2update', [\App\Http\Controllers\User\BrsrController::class,'sectionp2update'])->name('brsr.sectionp2update');


    Route::get('/brsr/sectionP4create/{fy_id}', [\App\Http\Controllers\User\BrsrController::class,'sectionP4create'])->name('brsr.sectionP4create');
    Route::post('/brsr/sectionp4store', [\App\Http\Controllers\User\BrsrController::class,'sectionp4store'])->name('brsr.sectionp4store');
    Route::get('/brsr/sectionP4edit/{brsr_mast_id}', [\App\Http\Controllers\User\BrsrController::class,'sectionP4edit'])->name('brsr.sectionP4edit');
    Route::post('/brsr/sectionp4update', [\App\Http\Controllers\User\BrsrController::class,'sectionp4update'])->name('brsr.sectionp4update');

    Route::get('/brsr/sectionP5create/{fy_id}', [\App\Http\Controllers\User\BrsrController::class,'sectionP5create'])->name('brsr.sectionP5create');
    Route::post('/brsr/sectionp5store', [\App\Http\Controllers\User\BrsrController::class,'sectionp5store'])->name('brsr.sectionp5store');
    Route::get('/brsr/sectionP5edit/{fy_id}', [\App\Http\Controllers\User\BrsrController::class,'sectionP5edit'])->name('brsr.sectionP5edit');
    Route::post('/brsr/sectionp5update', [\App\Http\Controllers\User\BrsrController::class,'sectionp5update'])->name('brsr.sectionp5update');

    Route::get('/brsr/sectionP7create/{fy_id}', [\App\Http\Controllers\User\BrsrController::class,'sectionP7create'])->name('brsr.sectionP7create');
    Route::post('/brsr/sectionp7store', [\App\Http\Controllers\User\BrsrController::class,'sectionp7store'])->name('brsr.sectionp7store');
    Route::get('/brsr/sectionP7edit/{brsr_mast_id}', [\App\Http\Controllers\User\BrsrController::class,'sectionP7edit'])->name('brsr.sectionP7edit');
    Route::post('/brsr/sectionp7update', [\App\Http\Controllers\User\BrsrController::class,'sectionp7update'])->name('brsr.sectionp7update');

    Route::get('/brsr/sectionP8create/{fy_id}', [\App\Http\Controllers\User\BrsrController::class,'sectionP8create'])->name('brsr.sectionP8create');
    Route::post('/brsr/sectionp8store', [\App\Http\Controllers\User\BrsrController::class,'sectionp8store'])->name('brsr.sectionp8store');
    Route::get('/brsr/sectionP8edit/{brsr_mast_id}', [\App\Http\Controllers\User\BrsrController::class,'sectionP8edit'])->name('brsr.sectionP8edit');
    Route::post('/brsr/sectionp8update', [\App\Http\Controllers\User\BrsrController::class,'sectionp8update'])->name('brsr.sectionp8update');

    Route::get('/brsr/sectionP9create/{fy_id}', [\App\Http\Controllers\User\BrsrController::class,'sectionP9create'])->name('brsr.sectionP9create');
    Route::post('/brsr/sectionp9store', [\App\Http\Controllers\User\BrsrController::class,'sectionp9store'])->name('brsr.sectionp9store');
    Route::get('/brsr/sectionP9edit/{brsr_mast_id}', [\App\Http\Controllers\User\BrsrController::class,'sectionP9edit'])->name('brsr.sectionP9edit');
    Route::post('/brsr/sectionp9update', [\App\Http\Controllers\User\BrsrController::class,'sectionp9update'])->name('brsr.sectionp9update');
    

    //  Route::resource('brsr', 'User\BrsrController', ['except' => 'create','update']);
//     Route::get('/brsr/create/{fy_id}', 'User\BrsrController@create')->name('brsr.create');
//     Route::post('brsr/store', 'User\BrsrController@store')->name('brsr');
//     Route::get('/brsr/edit/{gov_mast_id}', 'User\BrsrController@edit')->name('brsr.edit');
//     Route::post('/brsr/update', 'User\BrsrController@update')->name('brsr.update');
//     Route::get('brsr/row_delete/{row_id}', 'User\BrsrController@destroy')->name('brsr.delete');




    });

    // Dashboard routes
    Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::post('/export-dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'exportDashboard'])->name('admin.dashboard.export');
    Route::post('/refresh-dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'refreshDashboard'])->name('admin.dashboard.refresh');
    });

Route::post('/check-credentials', [\App\Http\Controllers\Auth\OtpController::class, 'checkCredentials'])->name('check.credentials');
Route::post('/verify-otp', [\App\Http\Controllers\Auth\OtpController::class, 'verifyOtp'])->name('verify.otp');
Route::post('/send-otp', [App\Http\Controllers\PassChangeController::class, 'sendOTP'])->name('send.otp');
// Route for sending OTP
// Route::post('/send-otp', [App\Http\Controllers\Auth\OTPController::class, 'sendOTP'])->name('send.otp');

Route::post('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

Route::post('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

Route::get('/admin/user/update-password-flag/{id}', [App\Http\Controllers\Admin\UserController::class, 'updatePasswordFlagAndRedirect'])->name('admin.user.update.password.flag');

