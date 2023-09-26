<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostPicturesController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Front\LikeController;
use App\Http\Controllers\Front\PublicController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Models\Tag;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
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
Route::group(['middleware'=> ['Language']], function(){
    // Route::get('hash', function () {
    //    return Crypt::decrypt('$2y$10$kPKlSLV/btwaWXwE8fWFEuDM3PMkjVLQzAtp6zOML4K8p0swz6ZOu');
    // });
    Route::get('lang/{locale}', [LanguageController::class,'lang']);
    Route::get('/', [PublicController::class,'index']);
    Route::get('/artikel/{id}',  [PublicController::class,'show']);
    Route::get('/ajax_load_project', [PublicController::class,'artikelLoad'])->name('artikelLoad');
    Route::get('/reload-captcha', [RegisterController::class, 'reloadCaptcha']);
    Route::get('/reload-captcha-public', [PublicController::class, 'reloadCaptcha'])->name('reloadCaptcha');
    Route::post('/save-comment', [PublicController::class, 'storeComment'])->name('storeComment');
    Route::post('/save-replay', [PublicController::class, 'storeReplay'])->name('storeReplay');
    Route::post('/like/go-like', [LikeController::class, 'saveLike'])->name('saveLike');
    Route::get('/get-comment/{id}', [PublicController::class, 'getComment'])->name('getComment');
    Route::get('/artikel-tentang', [PublicController::class, 'tentang']);
    Route::get('/artikel-contac', [PublicController::class, 'contact']);
    Route::get('/artikel-privacy', [PublicController::class, 'privacyPolicy']);
    Route::get('/artikel-faq', [PublicController::class, 'faqArticle']);
    // Route::resource('users', UserController::class);
    Route::middleware(['auth', 'CheckRole:Admin'])->group(function() {
        Route::prefix('Admin')->group(function() {
            Route::resource('/dashboard', DashboardController::class);
            Route::resource('/profile', ProfileController::class);
            Route::resource('/about', AboutController::class);
            Route::resource('/users', UserController::class);
            Route::resource('/categories', CategoryController::class);
            Route::resource('/comment', CommentController::class);
            Route::resource('/post_pictures', PostPicturesController::class);
            Route::resource('/artikels', ArtikelController::class);
            Route::post('/users/showUser', [UserController::class,'getDataUser'])->name('showUser');
            Route::delete('/users/delete', [UserController::class,'delete'])->name('deleteUser');
            Route::post('/artikels/showArtikel', [ArtikelController::class,'getDataArtikel'])->name('showArtikel');
            Route::delete('/artikels/delete', [ArtikelController::class,'delete'])->name('deleteArtikel');
            Route::get('/gambar-artikel', [ArtikelController::class,'indexGambar'])->name('indexGambar');
            Route::resource('/tag', TagController::class);
            Route::get('/recanttags', [ArtikelController::class,'RecantTags']);
            Route::post('/tag/showTag ', [TagController::class,'getDataTag'])->name('showTag');
            Route::post('/categories/showCategories', [CategoryController::class,'getDataCategory'])->name('showCategories');
            Route::post('/comment/showComment', [CommentController::class,'getDataComment'])->name('showComment');
            Route::delete('/categories/delete', [CategoryController::class,'delete'])->name('deleteCategories');
            Route::delete('/comment/delete', [CommentController::class,'delete'])->name('deleteComment');
            Route::get('/artikel-about', [ArtikelController::class, 'about']);
        });
    });
    Route::middleware(['auth', 'CheckRole:Member'])->group(function() {
        Route::prefix('Member')->name('member.')->group(function() {
            Route::resource('/profile', ProfileController::class);
            Route::resource('/post_pictures', PostPicturesController::class);
            Route::get('/gambar-artikel', [ArtikelController::class,'indexGambar'])->name('indexGambar');
            Route::resource('/artikels', ArtikelController::class);
            Route::post('/artikels/showArtikel', [ArtikelController::class,'getDataArtikel'])->name('showArtikel');
            Route::delete('/artikels/delete', [ArtikelController::class,'delete'])->name('deleteArtikel');
            Route::resource('/tag', TagController::class);
            Route::get('/recanttags', [ArtikelController::class,'RecantTags']);
            Route::get('/artikel-about', [ArtikelController::class, 'about']);
        });
    });


    // Route::get('/alert', [UserController::class, 'store']);
    // Route::get('/login', function () {
    //     return view('pages.login.login');
    // });
    // Route::get('/register', function () {
    //     return view('pages.login.register');
    // });

    // Route::get('/dashboard', function () {
    //     return view('pages.users.index');
    // });
    // Route::get('/events', function () {
    //     return view('pages.users.index');
    // });
    // Route::get('/guests', function () {
    //     return view('pages.users.index');
    // });
    // Route::get('/comment', function () {
    //     return view('pages.users.index');
    // });
    // Route::get('/gallery', function () {
    //     return view('pages.users.index');
    // });
    // Route::get('/story', function () {
    //     return view('pages.users.index');
    // });
    // Route::get('/gift', function () {
    //     return view('pages.users.index');
    // });



    Auth::routes();

    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
// Route::get('/test' ,function(Request $request){
//     dd(App::getLocale());

// })->middleware('Language');
