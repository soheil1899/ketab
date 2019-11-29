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

use Illuminate\View\View;


Auth::routes();

Route::namespace('Client')->group(function () {
    Route::get('/', 'HomeController@index')->name('index');
    Route::get('books/{id}/{cat}', 'HomeController@catbooks')->name('catbooks');
    Route::get('book/{id}/{title}', 'HomeController@bookinfo')->name('bookinfo');
    Route::get('person/{type}/{id}/{job}', 'HomeController@personinfo')->name('personinfo');
    Route::get('moredownload', 'HomeController@moredownload')->name('moredownload');
    Route::get('fawerit', 'HomeController@fawerit')->name('fawerit');
    Route::get('contact', 'HomeController@contact')->name('contact');
    Route::get('about', 'HomeController@about')->name('about');
    Route::get('search/{searchtext}', 'HomeController@search')->name('search');
    Route::post('likebook', 'HomeController@likebook')->name('likebook');
    Route::post('downloadbook', 'HomeController@downloadbook')->name('downloadbook');



    Route::post('getmenu', 'HomeController@getmenu')->name('getmenu');
    Route::post('getslider', 'HomeController@getslider')->name('getslider');
    Route::post('getlastbook', 'HomeController@getlastbook')->name('getlastbook');
    Route::post('getleftbook', 'HomeController@getleftbook')->name('getleftbook');
});

// dashboard
Route::prefix('dashboard')->namespace('Admin')->middleware(['auth', 'CheckAdmin'])->group(function () {

    Route::get('/', 'AdminController@index')->name('admin');


    Route::get('changemyinfo', 'AdminController@getmyinfo')->name('changemyinfo');
    Route::post('getmyinfo', 'AdminController@getmyinfos')->name('get.myinfo');
    Route::post('savemyinfo', 'AdminController@savemyinfo')->name('savemy.info');


    Route::get('user', 'UserController@index')->name('user.list');
    Route::post('users', 'UserController@getusers')->name('get.users');
    Route::post('saveuser', 'UserController@saveuser')->name('save.user');
    Route::post('deleteuser', 'UserController@deleteuser')->name('delete.user');



    // category
    Route::get('category', 'CategoryController@index')->name('category.list');
    Route::post('categories', 'CategoryController@getcategories')->name('get.categories');
    Route::post('savecategory', 'CategoryController@savecategory')->name('save.category');
    Route::post('getsubcategorys', 'CategoryController@getsubcategorys')->name('get.subcategories');
    Route::post('deletecategory', 'CategoryController@deletecategory')->name('delete.category');


    // writer
    Route::get('writer', 'WriterController@writerindex')->name('writer.list');
    Route::get('translate', 'WriterController@translateindex')->name('translate.list');
    Route::post('writers', 'WriterController@getwriters')->name('get.writers');
    Route::post('deletewriter', 'WriterController@deletewriter')->name('delete.writers');
    Route::post('savewriter', 'WriterController@savewriter')->name('save.writer');
    Route::post('savedescription', 'WriterController@savedescription')->name('save.description');


    Route::post('savepersonimage', 'WriterController@savepersonimage')->name('save.personimage');


    // filemanager
    Route::post('getfilemanager', 'FilemanagerController@getfilemanager')->name('get.filemanager');
    Route::post('savefile', 'FilemanagerController@savefile')->name('save.file');



    // slider
    Route::get('slider', 'SliderController@index')->name('slider');
    Route::post('getslider', 'SliderController@getslider')->name('getslider');
    Route::post('savesliderimage', 'SliderController@savesliderimage')->name('save.sliderimage');
    Route::post('deletesliderimage', 'SliderController@deletesliderimage')->name('delete.sliderimage');





    Route::get('setting', 'SettingController@index')->name('setting');
    Route::post('getsetting', 'SettingController@getsetting')->name('get.setting');
    Route::post('savesetting', 'SettingController@savesetting')->name('save.setting');



    Route::get('nasher', 'NasherController@index')->name('nasher');
    Route::post('nashers', 'NasherController@getnashers')->name('getnashers');
    Route::post('deletenasher', 'NasherController@deletenasher')->name('deletenasher');
    Route::post('savenasher', 'NasherController@savenasher')->name('savenasher');
    Route::post('savenasherdes', 'NasherController@savenasherdes')->name('savenasherdes');
    Route::post('savenasherimage', 'NasherController@savenasherimage')->name('savenasherimage');


    Route::get('book', 'BookController@index')->name('book.list');
    Route::post('books', 'BookController@getbooks')->name('get.book');
    Route::post('deletebook', 'BookController@deletebook')->name('delete.book');
    Route::post('savebookimage', 'BookController@savebookimage')->name('savebookimage');
    Route::post('savebookpdf', 'BookController@savebookpdf')->name('savebookpdf');
    Route::post('savebookdescription', 'BookController@savebookdescription')->name('savebookdescription');
    Route::post('savebook', 'BookController@savebook')->name('savebook');



});
