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
//Admin routes
Route::get('/folder/{folder}','Backend\FinderController@Folder');
Route::get('/link-folder/{folder}','Backend\FinderController@Folder');
Route::post('/uploadfile/{folder}','Backend\FinderController@UploadFile');
Route::get('/deletefile/{folder}/{filename}','Backend\FinderController@RemoveFile');
Route::get("login",'Backend\LoginController@getLogin');
Route::post("login",'Backend\LoginController@postLogin');
Route::get("logout",'Backend\LoginController@getLogout');

Route::post("forget-password",'Backend\LoginController@postForgetPassword');
Route::get("change-password",'Backend\LoginController@getChangePassword');
Route::post("change-password",'Backend\LoginController@postChangePassword');
Route::group(['namespace' => 'Backend','middleware'=>'backend','prefix'=>'/'],function(){
//    Auth::routes();
    Route::group(['middleware'=>'supper-admin','prefix'=>'/'],function (){
        Route::resource('user','UserController');
    });
    Route::get('/profile','UserController@getProfile');
    Route::get('/', 'HomeController@index');
    Route::get('/error', 'HomeController@Error');
//tin tức
    Route::get('/news','News\NewsController@getAll');
    Route::get('/news/create','News\CreateNewsController@Create');
    Route::post('/news/storage','News\CreateNewsController@Storage');
    Route::get('/news/edit/{id}','News\UpdateNewsController@Edit');
    Route::post('/news/update/{id}','News\UpdateNewsController@Update');
    Route::get('/news/delete/{id}', 'News\NewsController@deleteNews');
    Route::delete('/news/destroy/{id}', 'News\NewsController@destroyNews');
//dự án
    Route::group(['namespace'=>'Project','prefix'=>'/'],function (){
        Route::get('/project','ProjectController@getAll');
        Route::get('/project/create','CreateProjectController@Create');
        Route::post('/project/storage','CreateProjectController@Storage');
        Route::get('/project/edit/{id}','UpdateProjectController@Edit');
        Route::post('/project/update/{id}','UpdateProjectController@Update');
        Route::get('/project/delete/{id}', 'ProjectController@deleteProject');
        Route::delete('/project/destroy/{id}', 'ProjectController@destroyProject');
    });
    //ban lanh đạo
    Route::group(['namespace'=>'People','prefix'=>'/people'],function (){
        Route::get('/','PeopleController@getAll');
        Route::get('/create','CreatePeopleController@Create');
        Route::post('/storage','CreatePeopleController@Storage');
        Route::get('/edit/{id}','UpdatePeopleController@Edit');
        Route::post('/update/{id}','UpdatePeopleController@Update');
        Route::get('/delete/{id}', 'PeopleController@deleteProject');
        Route::delete('/destroy/{id}', 'PeopleController@destroyProject');
    });
    //tuyển dụng
    Route::group(['namespace'=>'Recruitment','prefix'=>'/'],function (){
        Route::get('/recruitment','RecruitmentController@getAll');
        Route::get('/recruitment/create','CreateRecruitmentController@Create');
        Route::post('/recruitment/storage','CreateRecruitmentController@Storage');
        Route::get('/recruitment/edit/{id}','UpdateRecruitmentController@Edit');
        Route::post('/recruitment/update/{id}','UpdateRecruitmentController@Update');
        Route::get('/recruitment/delete/{id}', 'RecruitmentController@deleteRecruitment');
        Route::delete('/recruitment/destroy/{id}', 'RecruitmentController@destroyRecruitment');
    });
    //tuyển dụng central real
    Route::group(['namespace'=>'RecruitmentCentralReal','prefix'=>'/'],function (){
        Route::get('/recruitment-central-real','RecruitmentCentralRealController@getAll');
        Route::get('/recruitment-central-real/create','CreateRecruitmentCentralRealController@Create');
        Route::post('/recruitment-central-real/storage','CreateRecruitmentCentralRealController@Storage');
        Route::get('/recruitment-central-real/edit/{id}','UpdateRecruitmentCentralRealController@Edit');
        Route::post('/recruitment-central-real/update/{id}','UpdateRecruitmentCentralRealController@Update');
        Route::get('/recruitment-central-real/delete/{id}', 'RecruitmentCentralRealController@deleteRecruitmentCentralReal');
        Route::delete('/recruitment-central-real/destroy/{id}', 'RecruitmentCentralRealController@destroyRecruitmentCentralReal');
    });
    //vị trí tuyển dụng
    Route::group(['namespace'=>'RecruitmentRole','prefix'=>'/'],function (){
        Route::get('/recruitment-role','RecruitmentRoleController@getAll');
        Route::get('/recruitment-role/create','CreateRecruitmentRoleController@Create');
        Route::post('/recruitment-role/storage','CreateRecruitmentRoleController@Storage');
        Route::get('/recruitment-role/edit/{id}','UpdateRecruitmentRoleController@Edit');
        Route::post('/recruitment-role/update/{id}','UpdateRecruitmentRoleController@Update');
        Route::get('/recruitment-role/delete/{id}', 'RecruitmentRoleController@deleteRecruitmentRole');
        Route::delete('/recruitment-role/destroy/{id}', 'RecruitmentRoleController@destroyRecruitmentRole');
    });
    //đào tạo
    Route::group(['namespace'=>'Education','prefix'=>'education'],function (){
        Route::get('/','EducationController@getAll');
        Route::get('/create','CreateEducationController@Create');
        Route::post('/storage','CreateEducationController@Storage');
        Route::get('/edit/{id}','UpdateEducationController@Edit');
        Route::post('/update/{id}','UpdateEducationController@Update');
        Route::get('/delete/{id}', 'EducationController@deleteEducation');
        Route::delete('/destroy/{id}', 'EducationController@destroyEducation');
    });
    //Văn hóa
    Route::group(['namespace'=>'Culture','prefix'=>'culture'],function (){
        Route::get('/','CultureController@getAll');
        Route::get('/create','CreateCultureController@Create');
        Route::post('/storage','CreateCultureController@Storage');
        Route::get('/edit/{id}','UpdateCultureController@Edit');
        Route::post('/update/{id}','UpdateCultureController@Update');
        Route::get('/delete/{id}', 'CultureController@deleteCulture');
        Route::delete('/destroy/{id}', 'CultureController@destroyCulture');
    });
    //slider
    Route::group(['namespace'=>'Slider','prefix'=>'/'],function (){
        Route::get('/slider','SliderController@getAll');
        Route::get('/slider/create','CreateSliderController@Create');
        Route::post('/slider/storage','CreateSliderController@Storage');
        Route::get('/slider/edit/{id}','UpdateSliderController@Edit');
        Route::post('/slider/update/{id}','UpdateSliderController@Update');
        Route::get('/slider/delete/{id}', 'SliderController@deleteSlider');
        Route::delete('/slider/destroy/{id}', 'SliderController@destroySlider');
    });
    //slider
    Route::group(['namespace'=>'Gallery','prefix'=>'/'],function (){
        Route::get('/gallery','GalleryController@getAll');
        Route::get('/gallery/create','CreateGalleryController@Create');
        Route::post('/gallery/storage','CreateGalleryController@Storage');
        Route::get('/gallery/edit/{id}','UpdateGalleryController@Edit');
        Route::post('/gallery/update/{id}','UpdateGalleryController@Update');
        Route::get('/gallery/delete/{id}', 'GalleryController@deleteGallery');
        Route::delete('/gallery/destroy/{id}', 'GalleryController@destroyGallery');
    });
    //slider
    Route::group(['namespace'=>'Partner','prefix'=>'/'],function (){
        Route::get('/partner','PartnerController@getAll');
        Route::get('/partner/create','CreatePartnerController@Create');
        Route::post('/partner/storage','CreatePartnerController@Storage');
        Route::get('/partner/edit/{id}','UpdatePartnerController@Edit');
        Route::post('/partner/update/{id}','UpdatePartnerController@Update');
        Route::get('/partner/delete/{id}', 'PartnerController@deletePartner');
        Route::delete('/partner/destroy/{id}', 'PartnerController@destroyPartner');
    });
    //category
    Route::group(['namespace'=>'Category','prefix'=>'/'],function (){
        Route::get('/category','CategoryController@getAll');
        Route::get('/category/create','CreateCategoryController@Create');
        Route::post('/category/storage','CreateCategoryController@Storage');
        Route::get('/category/edit/{id}','UpdateCategoryController@Edit');
        Route::post('/category/update/{id}','UpdateCategoryController@Update');
        Route::get('/category/delete/{id}', 'CategoryController@deleteCategory');
        Route::delete('/category/destroy/{id}', 'CategoryController@destroyCategory');
    });
    //feedback
    Route::group(['namespace'=>'ClientFeedback','prefix'=>'/'],function (){
        Route::get('/feedback','ClientFeedbackController@getAll');
        Route::get('/feedback/create','CreateClientFeedbackController@Create');
        Route::post('/feedback/storage','CreateClientFeedbackController@Storage');
        Route::get('/feedback/edit/{id}','UpdateClientFeedbackController@Edit');
        Route::post('/feedback/update/{id}','UpdateClientFeedbackController@Update');
        Route::get('/feedback/delete/{id}', 'ClientFeedbackController@deleteFeedback');
        Route::delete('/feedback/destroy/{id}', 'ClientFeedbackController@destroyFeedback');
    });
    //system
    Route::group(['namespace'=>'Config','prefix'=>'/'],function (){
        Route::get('/system','ConfigController@getAll');
        Route::post('/system/update','ConfigController@updateConfig');
    });
    //config popup
    Route::group(['namespace'=>'ConfigPopup','prefix'=>'/'],function (){
        Route::get('/config-popup','ConfigPopupController@getAll');
        Route::post('/config-popup/update','ConfigPopupController@updateConfig');
    });
    //about
    Route::group(['namespace'=>'AboutUs','prefix'=>'/'],function (){
        Route::get('/about-us','AboutUsController@getAll');
        Route::post('/about-us/update','AboutUsController@updateAboutUs');
    });
    //contact
    Route::group(['namespace'=>'Contact','prefix'=>'/'],function (){
        Route::get('/contact','ContactController@getAll');
        Route::get('/contact/edit/{id}','UpdateContactController@Edit');
        Route::post('/contact/update/{id}','UpdateContactController@Update');
        Route::get('/contact/delete/{id}', 'ContactController@deleteContact');
        Route::delete('/contact/destroy/{id}', 'ContactController@destroyContact');
    });
    //register
    Route::group(['namespace'=>'EventRegister','prefix'=>'/'],function (){
        Route::get('/event-register','EventRegisterController@getAll');
        Route::get('/event-register/{id_event}','EventRegisterController@getClient');
    });
    Route::group(['namespace'=>'ProjectRegister','prefix'=>'/'],function (){
        Route::get('/project-register','ProjectRegisterController@getAll');
        Route::get('/project-register/{id}','ProjectRegisterController@getClient');
    });

});
/*
 * Backend
 */


//Partner routes
//Route::get('/', 'HomeController@index')->name('home');
//Route::get('/project.html', 'HomeController@index');
//Route::get('/project/{id}-{slug}.html', 'HomeController@index');
//Route::get('/office.html', 'HomeController@index');
//Route::get('/expertise/{id}-{slug}.html', 'HomeController@index');
//Route::get('/expertise.html', 'HomeController@index');
//Route::get('/news.html', 'HomeController@index');
//Route::get('/news/{id}-{slug}.html', 'HomeController@index');
//Route::get('/contact.html', 'HomeController@index');
//Route::post('/contact', 'HomeController@index');
Route::get('/laravel-filemanager','\UniSharp\LaravelFilemanager\Controllers\LfmController@show');

Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload')->name('unisharp.lfm.upload');