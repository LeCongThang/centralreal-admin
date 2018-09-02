<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//Public API. no need use middleware
Route::group(['namespace' => 'Frontend','prefix'=>'v1'],function(){
//Route::prefix('v1')->group(function () {
    //home
    Route::get('home', 'HomeController@getHome');
    Route::get('config', 'HomeController@getConfig');
    //about us
    Route::get('about', 'AboutController@getAbout');
    //contact
    Route::post('contact', 'ContactsController@postContact');
    Route::post('event-register', 'ContactsController@registerEvent');
    //Gallery
    Route::get('gallery', 'GalleryController@getAllGallery');
    Route::get('gallery/{gallery_id}', 'GalleryController@getGalleryById');
    //News
    Route::get('news', 'NewsController@getAllNews');
    Route::get('news/{news_id}', 'NewsController@getNewsById');
    //Event
    Route::get('event', 'NewsController@getAllEvent');
    Route::get('event/{event_id}', 'NewsController@getEventById');

    //video
    Route::get('video', 'NewsController@getAllVideo');
    //Partner
    Route::get('partner', 'PartnerController@getAllPartner');
    Route::get('partner/{id}', 'PartnerController@getPartnerById');
    //Project
    Route::get('project', 'PeopleController@getAllProject');
    Route::get('project/filter/{category_id}/{partner_id}', 'PeopleController@getFilter');
    Route::get('project/{project_id}', 'PeopleController@getProjectById');
    //Recruitment
    Route::get('recruitment', 'RecruitmentController@getAllRecruitment');
    Route::get('recruitment/{recruitment_id}', 'RecruitmentController@getRecruitmentById');
});