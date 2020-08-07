<?php

use App\Http\Middleware\ImageExists;
use App\Http\Middleware\IsAjax;
use App\Http\Middleware\PreferredLanguage;
use App\Http\Middleware\RecaptchaMiddleware;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['throttle:60,1'],
], function () {
    Route::get('/', 'User\MainController@index')->name('main');
});

Route::get('secfggdfgret-login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('secfggdfgret-login', 'Auth\LoginController@login');
Route::post('secfggdfgret-logout', 'Auth\LoginController@logout')->name('logout');

Route::post('contact-form', 'ContactController@index')->name('user.contact-form')->middleware([IsAjax::class, RecaptchaMiddleware::class, 'throttle:5,1']);

Route::group([
    'namespace' => 'User',
    'as' => 'user.',
    'middleware' => ['throttle:60,1'],
], function () {
    Route::group([
        'namespace' => 'Catalog',
        'prefix' => 'catalog',
    ], function () {
        Route::get('/equipment/{machine}', 'MachineController@show')->name('catalog.show');
        Route::get('/{type?}', 'MachineController@index')->name('catalog.index');
        Route::get('category/{tag}/{type?}', 'TagController@show')->name('tags.show');
    });

    Route::get('order-success/{slug}', 'OrderController@thanks')->name('order.thanks');
    Route::post('order/{slug}', 'OrderController@order')->middleware([RecaptchaMiddleware::class])->name('order');

//    Route::group([
//        'namespace' => 'Blog',
//        'prefix' => 'blog',
//        'as' => 'blog.',
//    ], function () {
//        Route::get('tags/{slug}', 'TagController@show')->name('tags.show');
//        Route::get('/', 'PostController@index')->name('news.index');
//        Route::get('/{slug}', 'PostController@show')->name('news.show');
//    });

    Route::group([
        'namespace' => 'Exhibitions',
        'prefix' => 'exhibitions',
        'as' => 'exhibitions.',
    ], function () {
        Route::get('tags/{slug}', 'TagController@show')->name('tags.show');
        Route::get('/', 'PostController@index')->name('news.index');
        Route::get('/{slug}', 'PostController@show')->name('news.show');
    });
});

Route::group([
    'prefix' => 'admsfsdfsin',
    'as' => 'admin.',
    'namespace' => 'Admin',
    'middleware' => ['auth', 'throttle:60,1']
], function () {
    Route::get('home', 'HomeController@index')->name('home');

    Route::group([
        'middleware' => ['can:manage'],
    ], function () {
        Route::get('manage-orders/{active?}', 'ManageOrdersController@index')->name('manage.orders.index');
        Route::delete('manage-orders/{order}', 'ManageOrdersController@destroy')->name('manage.orders.destroy');
        Route::put('manage-orders/{order}', 'ManageOrdersController@viewed')->name('manage.orders.viewed')->middleware(IsAjax::class);
        Route::get('corrections/{active?}', 'CorrectionsController@index')->name('corrections.index');
        Route::post('corrections-create', 'CorrectionsController@create')->name('corrections.create')->middleware(IsAjax::class);
        Route::get('corrections/{correction}/edit', 'CorrectionsController@edit')->name('corrections.edit');
        Route::delete('corrections/{correction}', 'CorrectionsController@destroy')->name('corrections.destroy');
    });

    Route::group([
        'middleware' => ['can:admin'],
    ], function () {
        Route::group([
            'namespace' => 'Catalog',
            'prefix' => 'catalog',
        ], function () {
            Route::resource('tag', 'TagController')->except('show');
            Route::resource('properties', 'PropertyController')->except('show');
            Route::resource('machines', 'MachineController')->except('show');
            Route::get('machines/pdf/{machine}', 'MachineController@pdf')->name('machines.pdf');

            Route::post('blog-images', 'ImagesController@upload')->name('images.upload')->middleware(IsAjax::class);
            Route::post('blog-images-delete', 'ImagesController@destroy')->name('images.delete')->middleware(IsAjax::class);
        });

        Route::group([
            'namespace' => 'Blog',
            'as' => 'blog.',
            'prefix' => 'blog',
        ], function () {
            Route::get('posts/index/{type?}', 'PostsController@index')->name('posts.index');
            Route::resource('posts', 'PostsController')->except('index');
            Route::resource('categories', 'CategoriesController')->except('show');
            Route::resource('tags', 'TagsController')->except('show');

            Route::post('post-images', 'ImagesController@upload')->name('images.upload')->middleware(IsAjax::class);
            Route::post('post-images-delete', 'ImagesController@destroy')->name('images.delete')->middleware(IsAjax::class);
        });

        Route::group([
            'namespace' => 'Common',
            'as' => 'common.',
            'prefix' => 'common',
        ], function () {
            Route::resource('galleries', 'GalleriesController');
            Route::patch('gallery-photos-up', 'GalleryPhotosController@photoUp')->name('photo.up')->middleware([IsAjax::class, ImageExists::class]);
            Route::patch('gallery-photos-down', 'GalleryPhotosController@photoDown')->name('photo.down')->middleware([IsAjax::class, ImageExists::class]);
            Route::delete('gallery-photos-remove', 'GalleryPhotosController@removePhoto')->name('photo.remove')->middleware([IsAjax::class, ImageExists::class]);
        });
    });
});


