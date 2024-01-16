<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PaymentController;

Route::get('x', function () {
    return courseLenght(2);
});

//Route::group(['middleware' => ['check.frontend']], function () {
    // homepage
    Route::get('/', [FrontendController::class, 'homepage'])
        ->name('homepage');

    if (env('BLOG_ACTIVE') == 'YES') {
        /*for frontend blog*/
        Route::get('blog/posts', [FrontendController::class, 'blogPosts'])->name('blog.all');
        Route::get('blog/details/{id}', [FrontendController::class, 'singleBlog'])->name('blog.details');
        Route::get('blog/category/{id}', [FrontendController::class, 'categoryBlog'])->name('blog.category');
        Route::get('blog/tag/{tag}', [FrontendController::class, 'tagBlog'])->name('blog.tag');
    }

    /*search courses*/
    Route::get('search', [FrontendController::class, 'searchCourses'])->name('search.courses');
    //password_reset
    Route::get('password/reset', [FrontendController::class, 'password_reset'])
        ->name('student.password.reset');

    /*Course Category*/
    Route::get('courses/{slug}', [FrontendController::class, 'courseCat'])
        ->name('course.category');

    /*single course details*/
    Route::get('course/{slug}', [FrontendController::class, 'singleCourse'])
        ->name('course.single');

    /*currencies.change*/
    Route::post('currencies/change', [FrontendController::class, 'currenciesChange'])
        ->name('frontend.currencies.change')->middleware('demo');

    /*language change*/
    Route::post('languages/change', [FrontendController::class, 'languagesChange'])
        ->name('frontend.languages.change')->middleware('demo');

    /*teacher profile*/
    Route::get('instructor/details/{slug}', [FrontendController::class, 'instructorDetails'])
        ->name('single.instructor');

    Route::get('/courses', [FrontendController::class, 'courseFilter'])
        ->name('course.filter');

    /*Content preview*/
    Route::get('content/preview/{id}', [FrontendController::class, 'contentPreview'])
        ->name('content.video.preview');

    /*instructor register*/
    Route::get('instructor/register', [FrontendController::class, 'registerView'])
        ->name('instructor.register');

    /*instructor create*/
    Route::post('instructor/create', [FrontendController::class, 'registerCreate'])
        ->name('instructor.create')->middleware('demo');

    /*instructor payment*/
    Route::get('instructor/payment/{slug}', [FrontendController::class, 'insPayment'])
        ->name('instructor.payment');

    /*pages*/
    Route::get('page/{slug}', [FrontendController::class, 'page'])
        ->name('pages');

    /*instructor strip payment*/
    Route::post('instructor/stripe/payment', [PaymentController::class, 'instructorStripe'])
        ->name('instructor.stripe.payment')->middleware('demo')->middleware('demo');

    /*instructor strip payment*/
    Route::post('instructor/paypal/payment', [PaymentController::class, 'instructorPaypal'])
        ->name('instructor.paypal.payment')->middleware('demo');

    //login
    Route::get('student/login', [FrontendController::class, 'login'])
        ->name('student.login');

    //student_create
    Route::post('student/create', [FrontendController::class, 'create'])
        ->name('student.create')->middleware('demo');

    //signup
    Route::get('signup', [FrontendController::class, 'signup'])
        ->name('student.register');

    // this group for authorize user
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/mark-as-all-read', [FrontendController::class, 'mark_as_all_read'])->name('mark_as_all_read');

        /*paypal payment*/
        Route::post('paypal/payment', [PaymentController::class, 'paypalPayment'])
            ->name('paypal.paymnet')->middleware('demo');

        // stripe
        Route::post('stripe', [PaymentController::class, 'stripePost'])
            ->name('stripe.post')->middleware('demo');

        /*if free amount is zero*/
        Route::get('free/payment', [PaymentController::class, 'freePayment'])
            ->name('free.payment');

        /*get content details*/
        Route::get('class/content/{id}', [FrontendController::class, 'singleContent'])
            ->name('class.content');

        /*create message*/
        Route::get('message/create/{id}', [FrontendController::class, 'messageCreate'])
            ->name('message.create');
        Route::post('message/send', [FrontendController::class, 'sendMessage'])
            ->name('message.sent')->middleware('demo');

        /*all enroll courses and wishlist*/
        Route::get('my/courses', [FrontendController::class, 'my_courses'])
            ->name('my.courses');

        Route::get('my/wishlist', [FrontendController::class, 'my_wishlist'])
            ->name('my.wishlist');

        /*all enroll course ajax*/
        Route::get('enroll/courses', [FrontendController::class, 'enrollCourses'])
            ->name('enroll.courses');
        /*cart list*/
        Route::get('cart/list', [FrontendController::class, 'cartList'])
            ->name('cart.list');
        /*add to cart*/

        Route::get('add/to/cart', [FrontendController::class, 'addToCart'])
            ->name('add.to.cart');

        /*remove the cart*/
        Route::get('remove/cart/{id}', [FrontendController::class, 'removeCart'])
            ->name('cart.remove');

        /*wishlist*/
        Route::get('wish/list', [FrontendController::class, 'wishList'])
            ->name('wish.list');

        /*add to wishlist*/
        Route::get('add/to/wishlist', [FrontendController::class, 'addToWishlist'])
            ->name('add.to.wishlist');

        /*remove wishlist*/
        Route::get('remove/wishlist/{id}', [FrontendController::class, 'removeWishlist'])
            ->name('remove.wishlist');

        /*Shopping cart list with pages*/
        Route::get('shopping/cart', [FrontendController::class, 'shoppingCart'])
            ->name('shopping.cart');

        /*checkout*/
        Route::get('cart/checkout', [FrontendController::class, 'checkout'])
            ->name('checkout');

        // ============================== student route ===========================

        //dashboard
        Route::get('student/dashboard', [FrontendController::class, 'dashboard'])
            ->name('student.dashboard');

        //my_profile
        Route::get('student/profile', [FrontendController::class, 'my_profile'])
            ->name('student.profile');
        //student_edit
        Route::get('student/profile/edit', [FrontendController::class, 'student_edit'])
            ->name('student.edit');

        //student_update
        Route::post('student/profile/update/{std_id}', [FrontendController::class, 'update'])
            ->name('student.update')->middleware('demo');

        //enrolled_course
        Route::get('student/enrolled/course', [FrontendController::class, 'enrolled_course'])
            ->name('student.enrolled.course');

        //message
        Route::get('student/message', [FrontendController::class, 'inboxMessage'])
            ->name('student.message');

        //purchase_history
        Route::get('student/purchase/history', [FrontendController::class, 'purchase_history'])
            ->name('student.purchase.history');

        //lesson_details
        Route::get('lesson/{slug}', [FrontendController::class, 'lesson_details'])
            ->name('lesson_details');

        //commenting
        Route::post('comment', [FrontendController::class, 'comments'])
            ->name('comments')->middleware('demo');

        /*seen content delete*/
        Route::get('seen/content/remove/{id}', [FrontendController::class, 'seenRemove'])->name('seen.remove');

        /*all seen content list*/
        Route::get('seen/list/{id}', [FrontendController::class, 'seenList'])->name('seen.list');
        /*affiliate area*/
        if (affiliateStatus()) {
            Route::get('student/affiliate/area', [FrontendController::class, 'affiliateCreate'])->name('affiliate.area');
            Route::get('student/affiliate/request', [FrontendController::class, 'affiliateRequest'])->name('student.affiliate.request');
            Route::post('student/affiliate/update', [FrontendController::class, 'affiliateStore'])->name('student.account.update');
            Route::get('student/payment/request', [FrontendController::class, 'affiliatePaymentRequest'])->name('student.payment.request');
            Route::post('student/payment/store', [FrontendController::class, 'affiliatePaymentStore'])->name('student.payments.store');
        }
    });
//});
