<?php



use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\MemberController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\BooksController;
use App\Http\Controllers\Backend\RentsController;

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Auth::routes(['register' => false, 'reset' => false]);


Route::group(['middleware' => ['auth'], 'prefix'=> 'admin'], function() {
    // Route::get('/admin', 'AdminController@index')->name('admin');

    Route::get('/home', [AdminController::class, 'index'])->name('home');

    Route::resource('/users', UserController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/permission', RoleController::class);

    Route::resource('/members', MemberController::class);
    Route::get('/members', [MemberController::class, 'index'])->name('members.index');
    Route::get('/members/edit/{id}', [MemberController::class, 'edit'])->name('members_edit');
    Route::get('/members/view/{id}', [MemberController::class, 'show'])->name('members_view');
    Route::post('/members/change_status', [MemberController::class, 'members_change_status'])->name('members_change_status');
    Route::post('/members/searchMemberByBarcode', [MemberController::class, 'searchMemberByBarcode'])->name('searchMemberByBarcode');


    // Route::resource('/category', CategoryController::class);
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category_edit');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/delete', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/category/view/{id}', [CategoryController::class, 'show'])->name('category_view');
    Route::post('/category/chagne_status', [CategoryController::class, 'category_change_status'])->name('category_change_status');

    Route::get('/issues', [MemberController::class, 'index'])->name('issues.index');
    Route::get('/issues/edit/{id}', [CategoryController::class, 'edit'])->name('issues_edit');
    Route::get('/issues/view/{id}', [CategoryController::class, 'show'])->name('issues_view');

    Route::resource('/books', BooksController::class);
    Route::get('/books', [BooksController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BooksController::class, 'create'])->name('books.create');
    Route::post('/books/store', [BooksController::class, 'store'])->name('books.store');
    Route::get('/books/edit/{id}', [BooksController::class, 'edit'])->name('books.edit');
    Route::post('/books/update/{id}', [BooksController::class, 'update'])->name('books.update');
    // Route::delete('/books/delete/{id}', [BooksController::class, 'destroy'])->name('books.destroy');
    Route::get('/books/view/{id}', [BooksController::class, 'show'])->name('books.view');
    Route::post('/books/chagne_status', [BooksController::class, 'book_change_status'])->name('book_change_status');
    Route::post('/books/searchBookByBarcode', [BooksController::class, 'searchBookByBarcode'])->name('searchBookByBarcode');
    
    Route::resource('/rents', RentsController::class);
    Route::post('/rents/saveRentBook', [RentsController::class, 'store'])->name('saveRentBook');

});
