<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::get('/user/logout', 'UserController@logout')->name('User > Logout');

Route::get('/', [\App\Http\Controllers\HomeController::class, 'Index'])->name('Home');

Route::get('/home', function () {
    if (Auth::check()) {
        return redirect()->route('Admin');
    }
    return redirect()->route('Home');
});

Route::get('old_search', [\App\Http\Controllers\HomeController::class, 'OldSearch'])->name('Old Search');


Route::get('index.html', function () {
    return redirect()->route('Home');
});
Route::get('index.php', function () {
    return redirect()->route('Home');
});

Route::get('/blog', function() {
    return redirect(route('Home'));
})->name('Blog');


Route::get('/fake/response/200', function() {
    return response('<a href="https://rtc.tiny.cloud" targe="blank">https://rtc.tiny.cloud</a>', 200);
});

Route::get('/news/archive', [\App\Http\Controllers\HomeController::class, 'Archive'])->name('Home > Archive');

Route::get('/article/{slug}', [\App\Http\Controllers\ArticleController::class, 'Show'])->middleware('CheckPageState')->name('Article > Single');

Route::get('/direct/{id}', [\App\Http\Controllers\ArticleController::class, 'Direct'])->name('Article > Direct');

Route::get('page/{slug}', [\App\Http\Controllers\PageController::class, 'Show'])->name('Page > Single');

Route::get('/tag/{slug}', [\App\Http\Controllers\TagController::class, 'Archive'])->name('Tag > Archive');

Route::get('/category/{slug}', [\App\Http\Controllers\CategoryController::class, 'Archive'])->name('Category > Archive');

Route::get('/author/{username}', [\App\Http\Controllers\UserController::class, 'Archive'])->name('User > Archive');

Route::post('/comment/{id}/submit' ,[\App\Http\Controllers\CommentController::class, 'Submit'])->name('Comment > Submit');

Route::prefix('_z4ds76')->group(function () {
    Route::prefix('admin')->middleware(['auth', 'HasAdminAccess', 'CheckPageState'])->group(function () {
        Route::get('/', [\App\Http\Controllers\AdminController::class, 'Index'])->name('Admin');

        Route::get('profile', [\App\Http\Controllers\UserController::class, 'Profile'])->name('Profile');
        Route::post('profile/update', [\App\Http\Controllers\UserController::class, 'Update'])->name('Profile > Update');

        Route::get('settings', [\App\Http\Controllers\SettingController::class, 'Manage'])->name('Setting');
        Route::post('settings/update', [\App\Http\Controllers\SettingController::class, 'Update'])->name('Setting > Update');


        Route::get('users', [\App\Http\Controllers\UserController::class, 'Manage'])->name('Users > Manage');
        Route::post('users/{id}/update', [\App\Http\Controllers\UserController::class, 'Update'])->name('User > Update');
        Route::post('users/{id}/lock', [\App\Http\Controllers\UserController::class, 'Lock'])->name('User > Lock');
        Route::post('users/{id}/unlock', [\App\Http\Controllers\UserController::class, 'Unlock'])->name('User > Unlock');

        Route::get('article/new', [\App\Http\Controllers\ArticleController::class, 'New'])->name('Article > New');
        Route::post('article/new/submit', [\App\Http\Controllers\ArticleController::class, 'Submit'])->name('Article > Submit');
        Route::get('article/manage/', [\App\Http\Controllers\ArticleController::class, 'Manage'])->name('Article > Manage');
        Route::get('article/edit/{id}', [\App\Http\Controllers\ArticleController::class, 'Edit'])->name('Article > Edit');
        Route::post('article/edit/{id}/update', [\App\Http\Controllers\ArticleController::class, 'Update'])->name('Article > Update');
        Route::post('article/delete/{id}', [\App\Http\Controllers\ArticleController::class, 'DeleteTemporary'])->name('Article > Delete');
        Route::post('article/permanenet-delete/{id}/', [\App\Http\Controllers\ArticleController::class, 'DeletePermanently'])->name('Article > Delete Permanently');
        Route::post('article/restore/{id}', [\App\Http\Controllers\ArticleController::class, 'Restore'])->name('Article > Restore');

        Route::get('page/new', [\App\Http\Controllers\PageController::class, 'New'])->name('Page > New');
        Route::post('page/new/submit', [\App\Http\Controllers\PageController::class, 'Submit'])->name('Page > Submit');
        Route::get('page/manage/', [\App\Http\Controllers\PageController::class, 'Manage'])->name('Page > Manage');
        Route::get('page/edit/{id}', [\App\Http\Controllers\PageController::class, 'Edit'])->name('Page > Edit');
        Route::post('page/edit/{id}/update', [\App\Http\Controllers\PageController::class, 'Update'])->name('Page > Update');
        Route::post('page/delete/{id}', [\App\Http\Controllers\PageController::class, 'DeleteTemporary'])->name('Page > Delete');
        Route::post('page/permanenet-delete/{id}/', [\App\Http\Controllers\PageController::class, 'DeletePermanently'])->name('Page > Delete Permanently');
        Route::post('page/restore/{id}', [\App\Http\Controllers\PageController::class, 'Restore'])->name('Page > Restore');

        Route::get('tag', [\App\Http\Controllers\TagController::class, 'Manage'])->name('Tag > Manage');
        Route::get('tag/ajax', [\App\Http\Controllers\TagController::class, 'Ajax'])->name('Tag > Ajax');
        Route::any('tag/ajax/v2', [\App\Http\Controllers\TagController::class, 'AjaxV2'])->name('Tag > AjaxV2');
        Route::post('tag/new/submit', [\App\Http\Controllers\TagController::class, 'Submit'])->name('Tag > Submit');
        Route::post('tag/delete/{id}', [\App\Http\Controllers\TagController::class, 'Delete'])->name('Tag > Delete');


        Route::get('category', [\App\Http\Controllers\CategoryController::class, 'Manage'])->name('Category > Manage');
        Route::post('category/new/submit', [\App\Http\Controllers\CategoryController::class, 'Submit'])->name('Category > Submit');
        Route::post('category/delete/{id}', [\App\Http\Controllers\CategoryController::class, 'Delete'])->name('Category > Delete');


        Route::get('comment/manage/', [\App\Http\Controllers\CommentController::class, 'Manage'])->name('Comment > Manage');
        Route::post('comment/approve/{id}/', [\App\Http\Controllers\CommentController::class, 'Approve'])->name('Comment > Approve');
        Route::post('comment/unapprove/{id}/', [\App\Http\Controllers\CommentController::class, 'Unapprove'])->name('Comment > Unapprove');
        Route::post('comment/delete/{id}', [\App\Http\Controllers\CommentController::class, 'Delete'])->name('Comment > Delete');


        Route::get('advertise/new', [\App\Http\Controllers\AdvertiseController::class, 'New'])->name('Advertise > New');
        Route::post('advertise/new/submit', [\App\Http\Controllers\AdvertiseController::class, 'Submit'])->name('Advertise > Submit');
        Route::get('advertise/manage/', [\App\Http\Controllers\AdvertiseController::class, 'Manage'])->name('Advertise > Manage');
        Route::get('advertise/edit/{id}', [\App\Http\Controllers\AdvertiseController::class, 'Edit'])->name('Advertise > Edit');
        Route::post('advertise/edit/{id}/update', [\App\Http\Controllers\AdvertiseController::class, 'Update'])->name('Advertise > Update');
        Route::post('advertise/delete/{id}', [\App\Http\Controllers\AdvertiseController::class, 'Delete'])->name('Advertise > Delete');

        Route::get('gallery/new', [\App\Http\Controllers\GalleryController::class, 'New'])->name('Gallery > New');
        Route::post('gallery/new/submit', [\App\Http\Controllers\GalleryController::class, 'Submit'])->name('Gallery > Submit');
        Route::get('gallery/manage/', [\App\Http\Controllers\GalleryController::class, 'Manage'])->name('Gallery > Manage');
        Route::get('gallery/edit/{id}', [\App\Http\Controllers\GalleryController::class, 'Edit'])->name('Gallery > Edit');
        Route::post('gallery/edit/{id}/update', [\App\Http\Controllers\GalleryController::class, 'Update'])->name('Gallery > Update');
        Route::post('gallery/delete/{id}', [\App\Http\Controllers\GalleryController::class, 'Delete'])->name('Gallery > Delete');

        Route::get('analytics', [\App\Http\Controllers\AdminController::class, 'Analytics'])->name('Anayltics > Manage');

    });
});

Route::get('/sitemap_index.xml', [\App\Http\Controllers\SitemapController::class, 'Index'])->name('Sitemap');
Route::get('/article-sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'Article'])->name('Sitemap > Articles');
Route::get('/page-sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'Page'])->name('Sitemap > Pages');
Route::get('/category-sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'Category'])->name('Sitemap > Categories');
Route::get('/tag-sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'Tag'])->name('Sitemap > Tags');


Route::prefix('rss')->group(function () {
    Route::get('/', [\App\Http\Controllers\FeedController::class, 'Index'])->name('Rss');
    Route::get('/v2', [\App\Http\Controllers\FeedController::class, 'V2'])->name('RssV2');
    Route::get('/last-24', [\App\Http\Controllers\FeedController::class, 'Latest'])->name('Rss > Latest');
    Route::get('/last-24/top', [\App\Http\Controllers\FeedController::class, 'LatestTop'])->name('Rss > Latest');
    
    Route::get('/category/{slug}', [\App\Http\Controllers\FeedController::class, 'Category'])->name('Rss > Latest');
});

/*
* old cms newspaper router
*/
//Route::get('/newspaper-archive/{param}.html', 'NewspaperController@OldEngine')->name('Old cms > Newspaper');

/*
* old cms news router
*/
//Route::get('/{param_1}/{id}-{slug}.html', 'ArticleController@OldEngineSimple')->where(['id' => '[0-9]+'])->name('Old cms > News > Simple');
Route::get('/{slug}', [\App\Http\Controllers\ArticleController::class, 'OldEngineSimple'])->name('Old cms > News > Simple');

//Route::get('/{param_1}/{param_2}/{id}-{slug}.html', 'ArticleController@OldEngineComplex')->where(['id' => '[0-9]+'])->name('Old cms > News > Complex');
//Route::get('/{param_1}/{param_2}/{id}', 'ArticleController@OldEngineComplex')->where(['id' => '[0-9]+'])->name('Old cms > News > Complex > Short');

/*
* old cms tags router
*/
//Route::get('/component/tags/tag/{slug}.html', 'TagController@oldEngine')->name('Old cms > Tags');
//Route::get('/tags/{id}', 'ArticleController@GetPostTagsFromID');


/*
* old cms categories router
*/
//Route::get('/{param_1}/{param_2}.html', 'CategoryController@OldEngineComplex')->name('Old cms > Categories > Complex');
//Route::get('/{param_1}.html', 'CategoryController@OldEngineSimple')->name('Old cms > Categories > Short');

//Route::get('menu', 'HomeController@MenuStructureWithParents');
//Route::get('wmenu', 'HomeController@MenuStructureWithoutParents');

//Route::get('rule', 'HomeController@Test');

//Route::get('/newspaper/listdir', 'NewspaperController@ListDir');
//Route::get('/newspaper/download', 'NewspaperController@Download')->name('Newspaper > Download');

//Route::get('/asset/image', 'ArticleController@MakeThumb');
//Route::get('/compress/images', 'HomeController@CompressImage');

Route::get('/cache/clear', function() {
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    return back();
})->name('Cache > Clear');

//Route::get('/vid', 'HomeController@Vid');

//Route::get('/dd/test', [\App\Http\Controllers\HelperController::class, 'Test']);

//Route::get('/tele', 'ArticleController@sendToTelegram');

//Route::get('/archive/newspaper', 'HomeController@ArchiveEngine')->name('Archive > Newspaper');

Route::get('/archive/corrector', [\App\Http\Controllers\HomeController::class, 'Test']);
