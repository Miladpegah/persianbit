<?php

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

Route::get('/', function () {
    return view('index');
})->name('home');



require __DIR__.'/auth.php';


Route::get('/register/confirm/{id}/{verify_token}', 'App\Http\Controllers\Auth\RegisteredUserController@confirmEmail');
Route::post('/send-varify_email', 'App\Http\Controllers\UserController@sendConfirmEmail')->middleware(['auth'])->name('send-ConfirmEmail');






Route::group(['middleware' => ['auth']],function(){

	Route::get('/send-varify_email', 'App\Http\Controllers\UserController@confirmEmail');

	Route::group(['middleware' => ['verifiedUser']],function(){

		Route::get('/dashboard', 'App\Http\Controllers\UserController@index')->name('dashboard');

		Route::resource('/user', 'App\Http\Controllers\UserController');

		Route::get('/user/{selecteduser}/show', 'App\Http\Controllers\UserController@showUser')->name('user.show');

		Route::post('/user/{user}/follow', 'App\Http\Controllers\UserController@follow')->name('user.follow');

		Route::post('/user/{user}/unfollow/{followed}', 'App\Http\Controllers\UserController@unfollow')->name('user.unfollow');

		Route::get('/user/{user}/setting', 'App\Http\Controllers\UserController@setting')->name('setting');

		Route::get('/user/{user}/questions', 'App\Http\Controllers\UserController@userQuestions')->name('userQuestions');

		Route::get('/user/{user}/answeres', 'App\Http\Controllers\UserController@userAnsweres')->name('userAnsweres');

		Route::get('/user/{user}/marked', 'App\Http\Controllers\UserController@markedQuestions')->name('markedQuestions');


		Route::get('/user/{user}/followers', 'App\Http\Controllers\UserController@showFollowers')->name('showFollowers');

		Route::get('/user/{user}/following', 'App\Http\Controllers\UserController@showFollowing')->name('showFollowing');

		Route::post('/{user}/marked/{question}', 'App\Http\Controllers\UserController@unfollowQuestion')->name('unfollow.question');

		Route::resource('user/question', 'App\Http\Controllers\QuestionController');
		Route::post('/{user}/add/question', 'App\Http\Controllers\QuestionController@store')->name('question.store');

		Route::get('/user/{user}/articles', 'App\Http\Controllers\UserController@showArticles')->name('show.articles');

		Route::get('/user/{user}/lessons', 'App\Http\Controllers\UserController@showLessons')->name('show.lessons');

		Route::get('/user/{user}/jobs', 'App\Http\Controllers\UserController@showJobs')->name('show.jobs');

		Route::post('/user/{user}/photo', 'App\Http\Controllers\UserController@addPhoto')->name('userAdd.photo');

		Route::resource('articles', 'App\Http\Controllers\ArticleController');


		Route::resource('lessons', 'App\Http\Controllers\LessonController');


		Route::resource('jobs', 'App\Http\Controllers\JobController');

		Route::resource('questions', 'App\Http\Controllers\QuestionController');



		Route::get('/lesson/{lesson}/addepisode', 'App\Http\Controllers\EpisodeController@create')->name('add.episode');

		Route::post('/lesson/{lesson}/updatestatus', 'App\Http\Controllers\LessonController@updateStatus')->name('lesson.updateStatus');


		Route::post('/lesson/{lesson}/episode', 'App\Http\Controllers\EpisodeController@store')->name('store.episode');

		Route::post('/episode/{episode}/destroy', 'App\Http\Controllers\EpisodeController@destroy')->name('destroy.episode');

		Route::get('/episode/{episode}', 'App\Http\Controllers\EpisodeController@show')->name('episode.show');


		Route::post('question/{question}/addvote', 'App\Http\Controllers\QuestionController@positiveVote')->name('question.positive.vote');

		Route::post('question/{question}/lowoffvote', 'App\Http\Controllers\QuestionController@negativeVote')->name('question.negative.vote');

		Route::post('question/{question}/follow', 'App\Http\Controllers\QuestionController@followquestion')->name('follow.question');

		Route::post('question/{question}/block', 'App\Http\Controllers\QuestionController@blockQuestion')->name('block.question');

		Route::post('question/{question}/unblock', 'App\Http\Controllers\QuestionController@unblockQuestion')->name('unblock.question');


		Route::resource('answeres', 'App\Http\Controllers\AnswereController');

		Route::post('answere/{answere}/addvote', 'App\Http\Controllers\AnswereController@positiveVote')->name('answere.positive.vote');

		Route::post('answere/{answere}/lowoffvote', 'App\Http\Controllers\AnswereController@negativeVote')->name('answere.negative.vote');


		Route::post('/questionComment/{question}/add', 'App\Http\Controllers\QuestionController@addComment')->name('add.question.comment');

		Route::post('/answerComment/{answere}/add', 'App\Http\Controllers\AnswereController@addComment')->name('add.answere.comment');

		Route::post('/addAnswere/{question}/add', 'App\Http\Controllers\AnswereController@store')->name('add.answere');

		Route::post('/answere/{answere}/cancelBestAnswere', 'App\Http\Controllers\AnswereController@cancelBestAnswere')->name('cancelBest.answere');

		Route::post('/answere/{answere}/bestanswere', 'App\Http\Controllers\AnswereController@bestAnswere')->name('bestAnswere.select');

		Route::get('/questions/{user}/mine', 'App\Http\Controllers\QuestionController@myQuestion')->name('my.questions');

		Route::get('/solved-Questions', 'App\Http\Controllers\QuestionController@solvedQuestion')->name('solved.questions');

		Route::get('/not-Solved-Questions', 'App\Http\Controllers\QuestionController@notSolvedQuestion')->name('not.solved.questions');

		Route::get('/blocked-questions', 'App\Http\Controllers\QuestionController@blockedQuestion')->name('blocked.question');

		Route::get('question/{user}/marked-questions', 'App\Http\Controllers\QuestionController@markedQuestions')->name('marked.question');

		Route::get('question/answereless', 'App\Http\Controllers\QuestionController@answereless')->name('answereless.question');

		Route::get('question/terents', 'App\Http\Controllers\QuestionController@terents')->name('terent.questions');

		Route::post('syncspacialties/{user}', 'App\Http\Controllers\UserController@syncApacialties')->name('syncspacialties');







		
		Route::group(['middleware' => ['is.admin']],function(){
			Route::get('admin/login/index', 'App\Http\Controllers\AdminController@indexLogin')->name('admin.loginPage');

			Route::post('admin/login', 'App\Http\Controllers\AdminController@loginRequest')->name('admin.login');

			Route::group(['middleware' => ['auth.admin']],function(){
				Route::get('admin/dashboard', 'App\Http\Controllers\AdminController@index')->name('admin.index');

				Route::post('admin/logout', 'App\Http\Controllers\AdminController@logoutRequest')->name('admin.logout');

				Route::get('admin/manage-users', 'App\Http\Controllers\AdminController@showUsers')->name('manage.users');

				Route::get('admin/manage-articles', 'App\Http\Controllers\AdminController@showArticles')->name('manage.articles');

				Route::get('admin/manage-lessons', 'App\Http\Controllers\AdminController@showLessons')->name('manage.lessons');

				Route::get('admin/manage-padcasts', 'App\Http\Controllers\AdminController@showPadcasts')->name('manage.padcasts');

				Route::post('admin/store-padcast', 'App\Http\Controllers\PadcastController@store')->name('padcasts.store');

				Route::get('admin/manage-jobs', 'App\Http\Controllers\AdminController@showJobs')->name('manage.jobs');

				Route::post('admin/store-message', 'App\Http\Controllers\MessageController@store')->name('message.store');

				Route::post('admin/store-usermessage/{user}', 'App\Http\Controllers\MessageController@userStore')->name('usermessage.store');
			});
		});

		
	});
});

Route::get('/padcasts', 'App\Http\Controllers\PadcastController@index')->name('padcasts.index');

Route::get('/community', 'App\Http\Controllers\QuestionController@index')->name('questions.index');

Route::get('/lessons', 'App\Http\Controllers\LessonController@index')->name('lessons.index');

Route::get('/articles', 'App\Http\Controllers\ArticleController@index')->name('alticles.index');

Route::get('/jobs', 'App\Http\Controllers\JobController@index')->name('jobs.index');

Route::get('/user/{selecteduser}/show', 'App\Http\Controllers\UserController@showUser')->name('user.show');

Route::get('/questions', 'App\Http\Controllers\QuestionController@index')->name('questions.index');

Route::get('/lessons', 'App\Http\Controllers\LessonController@index')->name('lessons.index');

Route::get('/lessons/{lesson}', 'App\Http\Controllers\LessonController@show')->name('lessons.show');

Route::get('/articles', 'App\Http\Controllers\ArticleController@index')->name('articles.index');

Route::get('/articles/{article}', 'App\Http\Controllers\ArticleController@show')->name('articles.show');

Route::get('/jobs', 'App\Http\Controllers\JobController@index')->name('jobs.index');

Route::get('/questions/{question}', 'App\Http\Controllers\QuestionController@show')->name('questions.show');
Route::get('testpass', function (){
	return bcrypt('milad');
});





