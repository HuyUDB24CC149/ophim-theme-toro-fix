<?php

use Illuminate\Support\Facades\Route;
use Ophim\ThemeToroFix\Controllers\ThemeToroFixController;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
    ),
], function () {
    Route::get('/', [ThemeToroFixController::class, 'index']);

    Route::get(setting('site_routes_category', '/the-loai/{category}'), [ThemeToroFixController::class, 'getMovieOfCategory'])
        ->where(['category' => '.+', 'id' => '[0-9]+'])
        ->name('categories.movies.index');

    Route::get(setting('site_routes_region', '/quoc-gia/{region}'), [ThemeToroFixController::class, 'getMovieOfRegion'])
        ->where(['region' => '.+', 'id' => '[0-9]+'])
        ->name('regions.movies.index');

    Route::get(setting('site_routes_tag', '/tu-khoa/{tag}'), [ThemeToroFixController::class, 'getMovieOfTag'])
        ->where(['tag' => '.+', 'id' => '[0-9]+'])
        ->name('tags.movies.index');

    Route::get(setting('site_routes_tag_search', '/?search={tag}'), [ThemeToroFixController::class, 'getMovieOfTag'])
        ->where(['tag' => '.+', 'id' => '[0-9]+'])
        ->name('tags.movies.search');

    Route::get(setting('site_routes_types', '/danh-sach/{type}'), [ThemeToroFixController::class, 'getMovieOfType'])
        ->where(['type' => '.+', 'id' => '[0-9]+'])
        ->name('types.movies.index');

    Route::get(setting('site_routes_actors', '/dien-vien/{actor}'), [ThemeToroFixController::class, 'getMovieOfActor'])
        ->where(['actor' => '.+', 'id' => '[0-9]+'])
        ->name('actors.movies.index');

    Route::get(setting('site_routes_directors', '/dao-dien/{director}'), [ThemeToroFixController::class, 'getMovieOfDirector'])
        ->where(['director' => '.+', 'id' => '[0-9]+'])
        ->name('directors.movies.index');

    Route::get(setting('site_routes_episode', '/phim/{movie}/{episode}-{id}'), [ThemeToroFixController::class, 'getEpisode'])
        ->where(['movie' => '.+', 'movie_id' => '[0-9]+', 'episode' => '.+', 'id' => '[0-9]+'])
        ->name('episodes.show');

    // Old route
    Route::get('/xem-video/{movie}/video-{id}', [ThemeToroFixController::class, 'watchVideo'])
        ->where(['movie' => '.+', 'movie_id' => '[0-9]+', 'id' => '[0-9]+']);
    // New route for watch video
    Route::get(setting('site_routes_video', '/xem-video/{movie}'), [ThemeToroFixController::class, 'watchVideo'])
        ->where(['movie' => '.+', 'movie_id' => '[0-9]+'])
        ->name('videos.show');

    Route::post(sprintf('/%s/{movie}/{episode}/report', config('ophim.routes.movie', 'phim')), [ThemeToroFixController::class, 'reportEpisode'])->name('episodes.report');
    Route::post(sprintf('/%s/{movie}/rate', config('ophim.routes.movie', 'phim')), [ThemeToroFixController::class, 'rateMovie'])->name('movie.rating');
    Route::post(sprintf('/%s/{movie}/view', config('ophim.routes.movie', 'phim')), [ThemeToroFixController::class, 'viewCounter'])->name('movie.view-counter');

    Route::get(setting('site_routes_movie', '/phim/{movie}'), [ThemeToroFixController::class, 'getMovieOverview'])
        ->where(['movie' => '.+', 'id' => '[0-9]+'])
        ->name('front-end.movies.show');

});
