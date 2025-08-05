<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\SubscriptionController;
use App\Livewire\Admin\ChapterPage;
use App\Livewire\Admin\DashboardPage;
use App\Livewire\Admin\Form\CreateTrainingPage;
use App\Livewire\Admin\Form\EditChapterPage;
use App\Livewire\Admin\Form\EditTrainingPage;
use App\Livewire\Admin\Form\NewChapiterPage;
use App\Livewire\Admin\Form\NewChapterPage;
use App\Livewire\Admin\Post\Form\CreatePost;
use App\Livewire\Admin\Post\Form\EditPost;
use App\Livewire\Admin\Post\ListPostAdmin;
use App\Livewire\Admin\Tool\Form\CreateTool;
use App\Livewire\Admin\Tool\Form\EditTool;
use App\Livewire\Admin\Tool\ListToolsAdmin;
use App\Livewire\Admin\TrainingPage;
use App\Livewire\Pages\TrainingListPage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::get('/training-list', function () {
    return view('pages.training-list-page');
})->name('page.training.list');

Route::get('/post-list', function () {
    return view('pages.post-list-page');
})->name('page.post.list');


Route::get('/contact', function () {
    return view('pages.contact-page');
})->name('page.contact');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', DashboardPage::class)->name('admin.dashboard');
        Route::get('/trainings', TrainingPage::class)->name('admin.trainings');
        Route::prefix('training')->group(function () {
            Route::get('/create', CreateTrainingPage::class)->name('admin.training.create');
            Route::get('/edit/{training}', EditTrainingPage::class)->name('admin.training.edit');
            Route::get('/new-chapter/{training}', NewChapterPage::class)->name('admin.training.new.chapter');
            Route::get('/edit-chapter/{chapter}', EditChapterPage::class)->name('admin.training.edit.chapter');
            Route::get('/chapters/{training}', ChapterPage::class)->name('admin.training.chapters');
        });
        Route::get('/posts', ListPostAdmin::class)->name('admin.posts');
        Route::prefix('post')->group(function () {
            Route::get('/create', CreatePost::class)->name('admin.post.create');
            Route::get('/edit/{post}', EditPost::class)->name('admin.post.edit');
        });
        Route::get('/tools', ListToolsAdmin::class)->name('admin.tools');
        Route::prefix('tool')->group(function () {
            Route::get('/create', CreateTool::class)->name('admin.tool.create');
            Route::get('/edit/{tool}', EditTool::class)->name('admin.tool.edit');
        });
    });
    Route::controller(SubscriptionController::class)->group(function () {
        Route::get('/training-subscription/{training}/create', 'create')->name('page.training.create.subscription');
        Route::post('/training-subscription/{training}/apply', 'store')->name('page.training.subscription.apply');
        Route::get('/order/{orderId}/verify', 'verifyPayment')->name('page.order.verify');
    });
});
