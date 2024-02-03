<?php

use App\Http\Controllers\Question\AnswerController;
use App\Http\Controllers\StudentExam\StudentExamController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\InstallerController;
use App\Http\Controllers\KnowAboutController;
use App\Http\Controllers\Module\PageController;
use App\Http\Controllers\Course\ClassController;
use App\Http\Controllers\MediaManagerController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\Module\SliderController;
use App\Http\Controllers\Module\ThemesController;
use App\Http\Controllers\Course\ContentController;
use App\Http\Controllers\Module\EarningController;
use App\Http\Controllers\Module\MessageController;
use App\Http\Controllers\Module\PackageController;
use App\Http\Controllers\Module\PaymentController;
use App\Http\Controllers\Module\StudentController;
use App\Http\Controllers\Module\CategoryController;
use App\Http\Controllers\Setting\SettingController;
use App\Http\Controllers\Module\AffiliateController;
use App\Http\Controllers\Setting\CurrencyController;
use App\Http\Controllers\Setting\LanguageController;
use App\Http\Controllers\UserManager\UserController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Module\SupportTicketController;
use App\Http\Controllers\Instructor\InstructorController;
use App\Http\Controllers\Module\UserNotificationController;

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

Route::group(['middleware' => 'install.check', 'prefix' => 'install'], function () {
    Route::get('/', [InstallerController::class, 'welcome'])->name('install');
    Route::get('server/permission', [InstallerController::class, 'permission'])->name('permission');
    Route::get('database/create', [InstallerController::class, 'create'])->name('create');
    Route::get('database/check', [InstallerController::class, 'checkDbConnection'])->name('check.db');
    Route::post('setup/database', [InstallerController::class, 'dbStore'])->name('db.setup');
    Route::get('setup/import/sql', [InstallerController::class, 'importSql'])->name('sql.setup');
    Route::get('setup/instructor/create', [InstallerController::class, 'importDemoSql'])->name('sql.demo.setup'); // upload demo data
    Route::post('setup/instructor/setup', [InstallerController::class, 'instructorStore'])->name('setup.instructor'); // insert the instructor
    Route::get('setup/org/create', [InstallerController::class, 'orgCreate'])->name('org.create');
    Route::post('setup/org/store', [InstallerController::class, 'orgSetup'])->name('org.setup');
    Route::get('setup/admin', [InstallerController::class, 'adminCreate'])->name('admin.create');
    Route::post('setup/admin/store', [InstallerController::class, 'adminStore'])->name('admin.store');
});

Route::group(['middleware' => 'installed'], function () {
    //all user login
    Auth::routes(['register' => false]);
    //app routes
    Route::get('/auth/redirect/{provider}', [SocialController::class, 'redirect']);
    Route::get('/callback/{provider}', [SocialController::class, 'callback']);

    Route::get('user/verify/{token}', [RegisterController::class, 'verifyUser'])->name('user.verify');
    Route::post('send/verify/code', [RegisterController::class, 'sendToken'])->name('send.verify.token');
    Route::get('verify/user', [RegisterController::class, 'verifyForm']);
});

Route::group(['middleware' => ['installed', 'checkBackend', 'auth'], 'prefix' => 'dashboard'], function () {
    Route::get('/mark-as-read/{id}', [UserNotificationController::class, 'mark_as_read'])->name('mark_as_read');
    Route::get('/mark-as-all-read', [UserNotificationController::class, 'mark_as_all_read'])->name('mark_all_read');
    Route::get('/notifications/{user}', [UserNotificationController::class, 'see_all_notifications'])->name('see_all_notifications');
    Route::get('post-sortable', [ContentController::class, 'update'])->name('content.short');

    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');

    //course
    Route::get('course/create', [CourseController::class, 'create'])->name('course.create');
    Route::post('course/store', [CourseController::class, 'store'])->name('course.store');
    Route::get('course/index', [CourseController::class, 'index'])->name('course.index');
    Route::get('course/index/{course_id}/{slug}', [CourseController::class, 'show'])->name('course.show');
    Route::get('course/edit/{course_id}/{slug}', [CourseController::class, 'edit'])->name('course.edit');
    Route::post('course/update', [CourseController::class, 'update'])->name('course.update');
    Route::get('course/trash/{course_id}/{slug}', [CourseController::class, 'destroy'])->name('course.destroy');
    Route::get('course/published', [CourseController::class, 'published'])->name('course.publish');
    Route::get('course/rating', [CourseController::class, 'rating'])->name('course.rating');

    //CourseExam
    Route::get('exam/index', [\App\Http\Controllers\Exam\ExamController::class, 'index'])->name('exam.index');
    Route::get('exam/create/{course}', [\App\Http\Controllers\Exam\ExamController::class, 'create'])->name('exam.create');
    Route::post('exam/store', [\App\Http\Controllers\Exam\ExamController::class, 'store'])->name('exam.store');
    Route::get('exam/edit/{exam}', [\App\Http\Controllers\Exam\ExamController::class, 'edit'])->name('exam.edit');
    Route::put('exam/update/{exam}', [\App\Http\Controllers\Exam\ExamController::class, 'update'])->name('exam.update');

    //ExamQuestions
    Route::get('questions/index',[\App\Http\Controllers\Question\QuestionController::class, 'index'])->name('question.index');
    Route::get('questions/create/{exam}',[\App\Http\Controllers\Question\QuestionController::class, 'create'])->name('question.create');
    Route::get('questions/edit/{examQuestion}',[\App\Http\Controllers\Question\QuestionController::class, 'edit'])->name('question.edit');
    Route::post('questions/create', [\App\Http\Controllers\Question\QuestionController::class, 'store'])->name('question.store');
    Route::put('questions/update/{examQuestion}',[\App\Http\Controllers\Question\QuestionController::class, 'update'])->name('question.update');
    Route::get('questions/delete/{questionId}', [\App\Http\Controllers\Question\QuestionController::class, 'delete'])->name('question.delete');

    //QuestionAnswer
    Route::get('answer/create/{question}', [AnswerController::class, 'create'])->name('answer.create');
    Route::post('answer/store', [AnswerController::class, 'store'])->name('answer.store');
    Route::get('answer/makeCorrect/{questionAnswer?}',[AnswerController::class,'makeCorrect'])->name('answer.makeCorrect');
    Route::put('answer/updateAnswer',[AnswerController::class,'updateAnswer'])->name('answer.updateAnswer');
    Route::get('destroy/{questionAnswer}',[AnswerController::class,'destroy'])->name('answer.destroy');
    // class
    Route::get('class/create/{id}', [ClassController::class, 'create'])->name('classes.create');
    Route::post('class/store', [ClassController::class, 'store'])->name('classes.store')->middleware('demo');
    Route::get('class/edit/{id}', [ClassController::class, 'edit'])->name('classes.edit');
    Route::post('class/update', [ClassController::class, 'update'])->name('classes.update')->middleware('demo');
    Route::get('class/trash/{id}', [ClassController::class, 'destroy'])->name('classes.destroy');
    //class content
    Route::get('class/content/create/{id}', [ContentController::class, 'create'])->name('classes.contents.create');
    Route::post('class/content/store', [ContentController::class, 'store'])->name('classes.contents.store')->middleware('demo');
    Route::get('class/content/trash/{id}', [ContentController::class, 'destroy'])->name('classes.contents.destroy');
    Route::get('class/content/show/{id}', [ContentController::class, 'show'])->name('classes.contents.show');
    Route::get('class/content/source/code/{id}', [ContentController::class, 'code'])->name('classes.contents.code');
    Route::post('course/slug/check', [CourseController::class, 'check'])->name('slug.check')->middleware('demo');
    Route::get('content/published', [ContentController::class, 'published'])->name('class.content.published');
    Route::get('content/preview', [ContentController::class, 'preview'])->name('class.content.preview');

    //Instructor Earning
    Route::get('instructor/earning', [EarningController::class, 'instructorEarning'])->name('instructor.earning');

    //all payment
    Route::get('payment/request', [PaymentController::class, 'paymentRequest'])->name('payments.request');

    //instructor
    Route::get('instructor/index', [InstructorController::class, 'index'])->name('instructors.index');
    Route::get('instructor/show/{id}', [InstructorController::class, 'show'])->name('instructors.show');
    Route::get('/profile/{id}', [InstructorController::class, 'edit'])->name('instructors.edit');
    Route::post('/profile/update', [InstructorController::class, 'update'])->name('instructors.update')->middleware('demo');
    Route::get('/instructor/profile/{id}', [InstructorController::class, 'instructorEdit'])->name('instructors.adminEdit');
    Route::post('/instructor/profile/update/{id}', [InstructorController::class, 'instructorUpdate'])->name('instructors.adminUpdate')->middleware('demo');
    Route::post('/users/banned', [InstructorController::class, 'banned'])->name('users.banned')->middleware('demo');

    Route::get('instructor/create/modal', [InstructorController::class, 'create'])->name('instructor.create.modal');
    Route::post('instructor/create/modal/store', [InstructorController::class, 'instructor_store'])->name('instructor.store.modal');

    //messages with student
    Route::get('message/inbox', [MessageController::class, 'index'])->name('messages.index');
    Route::get('message/show/{id}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('message/send', [MessageController::class, 'send'])->name('messages.replay')->middleware('demo');
    Route::get('comments/index', [MessageController::class, 'allCommenting'])->name('comments.index');
    Route::get('comments/show/{id}', [MessageController::class, 'commentShow'])->name('comments.show');
    Route::get('comments/delete/{id}', [MessageController::class, 'commentDestroy'])->name('comments.delete');
    Route::post('comments/replay', [MessageController::class, 'commentReplay'])->name('comments.replay')->middleware('demo');

    //account setup
    Route::get('account/setup', [PaymentController::class, 'accountSetup'])->name('account.create');
    Route::post('account/update', [PaymentController::class, 'accountUpdate'])->name('account.update')->middleware('demo');
    Route::get('account/details/{id}/{userId}/{method}/{payId}', [PaymentController::class, 'accountDetails'])
        ->name('account.details');

    //Todo:there are the user Manager section
    Route::get('user/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('user/create', [UserController::class, 'create'])->name('users.create');
    Route::post('user/store', [UserController::class, 'store'])->name('users.store')->middleware('demo');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('user/update', [UserController::class, 'update'])->name('users.update')->middleware('demo');
    Route::get('user/show/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('user/index', [UserController::class, 'index'])->name('users.index');

    /**
     * MEDIA MANAGER
     */
    Route::get('media/manager', [MediaManagerController::class, 'index'])->name('media.index');
    Route::post('media/index', [MediaManagerController::class, 'main'])->name('media.main')->middleware('demo');
    Route::get('media/manager/create', [MediaManagerController::class, 'create'])->name('media.create');
    Route::post('media/manager/store', [MediaManagerController::class, 'store'])->name('media.store')->middleware('demo');
    Route::get('media/manager/show', [MediaManagerController::class, 'show'])->name('media.show');
    Route::get('media/manager/edit/{id}', [MediaManagerController::class, 'edit'])->name('media.edit');
    Route::post('media/manager/update/{id}', [MediaManagerController::class, 'update'])->name('media.update')->middleware('demo');
    Route::post('media/manager/slide', [MediaManagerController::class, 'slide'])->name('media.slide')->middleware('demo');
    Route::post('media/manager/filter/{type}', [MediaManagerController::class, 'filter'])->name('media.filter')->middleware('demo');
    Route::get('media/manager/trash/{item}', [MediaManagerController::class, 'destroy'])->name('media.delete');

    Route::get('email', [DashboardController::class, 'template']);

    //SMTP Setting
    Route::get('smtp/create', [SettingController::class, 'smtpCreate'])->name('smtp.create');
    Route::post('smtp/store', [SettingController::class, 'smtpStore'])->name('smtp.store')->middleware('demo');

    //site setting
    Route::get('site/setting', [SettingController::class, 'siteSetting'])->name('site.setting');
    Route::post('site/setting/update', [SettingController::class, 'siteSettingUpdate'])->name('site.update')->middleware('demo');

    //app site setting
    Route::get('app/setting', [SettingController::class, 'appSetting'])->name('app.setting');
    Route::post('app/setting/update', [SettingController::class, 'appSettingUpdate'])->name('app.update')->middleware('demo');

    /*other settings here*/
    Route::get('other/settings', [SettingController::class, 'otherSetting'])->name('other.setting');
    Route::post('other/setting', [SettingController::class, 'otherSettingUpdate'])->name('other.update');

    //Language Setting
    Route::get('language/index', [LanguageController::class, 'index'])
        ->name('language.index');
    Route::post('language/store', [LanguageController::class, 'store'])
        ->name('language.store')->middleware('demo');
    Route::get('language/destroy/{id}', [LanguageController::class, 'destroy'])
        ->name('language.destroy');
    Route::get('language/translate/{id}', [LanguageController::class, 'translate_create'])
        ->name('language.translate');
    Route::post('language/translate/store', [LanguageController::class, 'translate_store'])
        ->name('language.translate.store')->middleware('demo');
    Route::post('language/change', [LanguageController::class, 'changeLanguage'])
        ->name('language.change')->middleware('demo');
    Route::get('language/default/{id}', [LanguageController::class, 'defaultLanguage'])
        ->name('language.default');

    //Currency Setting
    Route::get('currency/index', [CurrencyController::class, 'index'])->name('currencies.index');
    Route::get('currency/create', [CurrencyController::class, 'create'])->name('currencies.create');
    Route::post('currency/store', [CurrencyController::class, 'store'])->name('currencies.store')->middleware('demo');
    Route::get('currency/delete/{id}', [CurrencyController::class, 'destroy'])->name('currencies.destroy');
    Route::get('currency/edit/{id}', [CurrencyController::class, 'edit'])->name('currencies.edit');
    Route::post('currency/update', [CurrencyController::class, 'update'])->name('currencies.update')->middleware('demo');
    Route::post('currency/default', [CurrencyController::class, 'default'])->name('currencies.default')->middleware('demo');
    Route::get('currency/published', [CurrencyController::class, 'published'])->name('currencies.published');
    Route::get('currency/align', [CurrencyController::class, 'alignment'])->name('currencies.align');
    Route::post('currency/change', [CurrencyController::class, 'change'])->name('currencies.change')->middleware('demo');

    //support
    Route::get('ticket/index', [SupportTicketController::class, 'index'])->name('tickets.index');
    Route::get('ticket/create', [SupportTicketController::class, 'create'])->name('tickets.create');
    Route::post('ticket/store', [SupportTicketController::class, 'store'])->name('tickets.store')->middleware('demo');
    Route::get('ticket/show/{id}', [SupportTicketController::class, 'show'])->name('tickets.show');
    Route::post('ticket/replay', [SupportTicketController::class, 'replay'])->name('tickets.replay')->middleware('demo');

    //payment
    Route::get('payments/index', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('payments/store', [PaymentController::class, 'store'])->name('payments.store')->middleware('demo');
    Route::get('payments/destroy/{id}', [PaymentController::class, 'destroy'])->name('payments.destroy');
    Route::get('payments/status/{id}', [PaymentController::class, 'status'])->name('payments.status');

    //Category
    Route::get('category/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('category/store', [CategoryController::class, 'store'])->name('categories.store')->middleware('demo');
    Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('category/update', [CategoryController::class, 'update'])->name('categories.update')->middleware('demo');
    Route::get('category/destroy/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('category/index', [CategoryController::class, 'index'])->name('categories.index');

    //this route for published or unpublished
    Route::get('category/published', [CategoryController::class, 'published'])->name('categories.published');
    Route::get('category/popular', [CategoryController::class, 'popular'])->name('categories.popular');
    Route::get('category/top', [CategoryController::class, 'top'])->name('categories.top');

    //package
    Route::get('packages/index', [PackageController::class, 'index'])->name('packages.index');
    Route::get('packages/create', [PackageController::class, 'create'])->name('packages.create');
    Route::get('packages/edit/{id}', [PackageController::class, 'edit'])->name('packages.edit');
    Route::get('packages/destroy/{id}', [PackageController::class, 'destroy'])->name('packages.destroy');
    Route::post('packages/store', [PackageController::class, 'store'])->name('packages.store')->middleware('demo');
    Route::post('packages/update', [PackageController::class, 'update'])->name('packages.update')->middleware('demo');

    //slider
    Route::get('slider/index', [SliderController::class, 'index'])->name('sliders.index');
    Route::get('slider/create', [SliderController::class, 'create'])->name('sliders.create');
    Route::post('slider/store', [SliderController::class, 'store'])->name('sliders.store')->middleware('demo');
    Route::get('slider/destroy/{id}', [SliderController::class, 'destroy'])->name('sliders.destroy');
    Route::get('slider/edit/{id}', [SliderController::class, 'edit'])->name('sliders.edit');
    Route::post('slider/update', [SliderController::class, 'update'])->name('sliders.update')->middleware('demo');
    Route::get('slider/published', [SliderController::class, 'published'])->name('sliders.published');

    //Earning
    Route::get('admin/earning', [EarningController::class, 'adminEarning'])->name('admin.earning.index');

    //student
    Route::get('student/index', [StudentController::class, 'index'])->name('students.index');
    Route::get('student/show/{id}', [StudentController::class, 'show'])->name('students.show');
    Route::get('student/edit/{id}', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('student/update', [StudentController::class, 'update'])->name('students.update');
    Route::get('student/create/modal', [StudentController::class, 'create'])->name('student.create.modal');
    Route::post('student/create/modal/store', [StudentController::class, 'student_store'])->name('student.store.modal');

    Route::get('student/enroll/courses/{id}', [StudentController::class, 'student_enroll_courses'])->name('student.enroll.courses.modal');
    Route::post('student/enroll/courses/{id}/store', [StudentController::class, 'student_enroll_courses_store'])->name('student.enroll.courses.modal.store');

    //all pages
    Route::get('pages/index', [PageController::class, 'index'])->name('pages.index');
    Route::get('pages/create', [PageController::class, 'create'])->name('pages.create');
    Route::get('pages/delete/{id}', [PageController::class, 'destroy'])->name('pages.destroy');
    Route::post('pages/store', [PageController::class, 'store'])->name('pages.store')->middleware('demo');
    Route::get('pages/edit/{id}', [PageController::class, 'edit'])->name('pages.edit');
    Route::post('pages/update', [PageController::class, 'update'])->name('pages.update')->middleware('demo');
    Route::get('pages/active', [PageController::class, 'pageActive'])->name('pages.active');
    Route::get('pages/content/index/{id}', [PageController::class, 'contentIndex'])->name('pages.content.index');
    Route::get('pages/content/create/{id}', [PageController::class, 'contentCreate'])->name('pages.content.create');
    Route::post('pages/content/store', [PageController::class, 'contentStore'])->name('pages.content.store')->middleware('demo');
    Route::get('pages/content/active', [PageController::class, 'contentActive'])->name('pages.content.active');
    Route::get('pages/content/edit/{id}', [PageController::class, 'contentEdit'])->name('pages.content.edit');
    Route::post('pages/content/update', [PageController::class, 'contentUpdate'])->name('pages.content.update')->middleware('demo');
    Route::get('pages/content/delete/{id}', [PageController::class, 'contentDestroy'])->name('pages.content.destroy');

    /*theme settings*/
    Route::get('theme/setting', [ThemesController::class, 'create'])->name('themes.setting');
    Route::post('theme/store', [ThemesController::class, 'store'])->name('themes.store')->middleware('demo');

    /*affiliate setup*/
    if (affiliateStatus()) {
        Route::get('affiliate/setting', [AffiliateController::class, 'settingCreate'])->name('affiliate.setting.create');
        Route::post('affiliate/setting/update', [AffiliateController::class, 'settingStore'])->name('affiliate.setting.update');
        Route::get('affiliate/index', [AffiliateController::class, 'requestList'])->name('affiliate.request.list');
        Route::get('affiliate/reject/{id}', [AffiliateController::class, 'reject'])->name('affiliate.reject');
        Route::get('affiliate/active/{id}', [AffiliateController::class, 'active'])->name('affiliate.active');
        Route::get('affiliate/payment/request', [AffiliateController::class, 'paymentRequest'])->name('affiliate.payment.request');
        Route::get('affiliate/student/account/{id}/{userId}/{method}/{payId}', [AffiliateController::class, 'accountDetails'])
            ->name('student.account.details');
        Route::get('affiliate/payments/status/{id}', [AffiliateController::class, 'affiliateStatus'])->name('affiliate.payments.status');
        Route::get('affiliate/payments/cancel/{id}', [AffiliateController::class, 'affiliatePaymentCancel'])->name('affiliate.payment.request.cancel');
    }

    if (themeManager() == 'rumbok') {

        /*know about module*/
        Route::get('know/index', [KnowAboutController::class, 'index'])->name('know.index');
        Route::get('know/create', [KnowAboutController::class, 'create'])->name('know.create');
        Route::post('know/store', [KnowAboutController::class, 'store'])->name('know.store');
        Route::get('know/edit/{id}', [KnowAboutController::class, 'edit'])->name('know.edit');
        Route::post('know/update', [KnowAboutController::class, 'update'])->name('know.update');
        Route::get('know/delete/{id}', [KnowAboutController::class, 'destroy'])->name('know.destroy');

        /*blog*/
        Route::get('blog/index', [BlogController::class, 'index'])->name('blog.index');
        Route::get('blog/create', [BlogController::class, 'create'])->name('blog.create');
        Route::post('blog/store', [BlogController::class, 'store'])->name('blog.store');
        Route::get('blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
        Route::post('blog/update', [BlogController::class, 'update'])->name('blog.update');
        Route::get('blog/delete/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
        Route::get('blog/publish', [BlogController::class, 'isActive'])->name('blog.active');
    }
});

Route::get('/toko', function () {
    return session()->put('currency', 'usd');
});
