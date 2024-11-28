<?php


declare(strict_types=1);


namespace App\Config;

use App\Controllers\{AlertController, AssignmentController, AuthController, ProfileController, CoursesController, TutorProfileController, SettingController, PageController, ResourceController, PostController, ReviewController};
use App\Middleware\AdminOnlyMiddleware;
use App\Middleware\AuthRequiredMiddleware;
use App\Middleware\GuestOnlyMiddleware;
use App\Middleware\StudentOnlyMiddleware;
use App\Middleware\TeacherOnlyMiddleware;
use Framework\App;

function registerRoutes(App $app)
{
    $app->get('/', [PageController::class, 'home']);
    $app->get('/contact', [PageController::class, 'contact']);
    $app->get('/about', [PageController::class, 'about']);
    $app->get('/profile', [ProfileController::class, 'profile'], [AuthRequiredMiddleware::class]);
    $app->get('/dashboard', [PageController::class, 'dashboard'], [AuthRequiredMiddleware::class]);
    $app->get('/admin-dashboard', [PageController::class, 'adminDashboard'], [AdminOnlyMiddleware::class]);
    $app->get('/admin-dashboard/user-managment', [PageController::class, 'userManagment'], [AdminOnlyMiddleware::class]);
    $app->get('/admin-dashboard/course-managment', [PageController::class, 'courseManagment'], [AdminOnlyMiddleware::class]);
    $app->get('/settings', [PageController::class, 'settings'], [AdminOnlyMiddleware::class]);
    $app->get('/tutor', [TutorProfileController::class, 'tutorProfile'], [AuthRequiredMiddleware::class]);
    $app->get('/alert', [AlertController::class, 'alert']);
    $app->get('/error', [PageController::class, 'error']);
    $app->get('/unauthorized-access', [PageController::class, 'unauthorizedAccess']);
    $app->get('/help-and-support', [PageController::class, 'helpAndSupport']);


    $app->get('/denied', [PageController::class, 'denied']);

    // User
    $app->post('/choose-role', [AuthController::class, 'chooseRole'], [GuestOnlyMiddleware::class]);
    $app->get('/register/create-account', [AuthController::class, 'registerView'], [GuestOnlyMiddleware::class]);
    $app->get('/register', [AuthController::class, 'registerRoleView'], [GuestOnlyMiddleware::class]);
    $app->post('/register', [AuthController::class, 'register'], [GuestOnlyMiddleware::class]);
    $app->get('/interest', [PageController::class, 'interest'], [AuthRequiredMiddleware::class]);
    $app->get('/interest/skip', [PageController::class, 'interestSkip'], [AuthRequiredMiddleware::class]);
    $app->get('/interest/continue', [PageController::class, 'interestContinue'], [AuthRequiredMiddleware::class]);

    $app->get('/login', [AuthController::class, 'loginView'], [GuestOnlyMiddleware::class]);
    $app->post('/login', [AuthController::class, 'login'],  [GuestOnlyMiddleware::class]);
    $app->get('/logout', [AuthController::class, 'logout'], [AuthRequiredMiddleware::class]);
    $app->get('/billing-and-payment', [PageController::class, 'billingAndPayment'], [AuthRequiredMiddleware::class]);
    $app->get('/mycourses', [PageController::class, 'myCourses'], [AuthRequiredMiddleware::class]);
    $app->get('/create-ad', [PageController::class, 'createAd'], [TeacherOnlyMiddleware::class]);

    // Courses
    $app->get('/courses', [CoursesController::class, 'course']);
    $app->get('/manage-course/edit/{course}', [CoursesController::class, 'courseEditView'], [TeacherOnlyMiddleware::class]);
    $app->post('/manage-course/edit/{course}', [CoursesController::class, 'editCourse'], [TeacherOnlyMiddleware::class]);
    $app->delete('/manage-course/delete/{course}', [CoursesController::class, 'deleteCourse'], [TeacherOnlyMiddleware::class]);
    $app->get('/courses/my-courses/{course_id}', [CoursesController::class, 'courseInfo'], [AuthRequiredMiddleware::class]);
    $app->get('/courses/my-courses/{course_id}/participant', [CoursesController::class, 'courseParticipant'], [TeacherOnlyMiddleware::class]);
    $app->get('/courses/my-courses/{course_id}/participant/stats/{participant_id}', [CoursesController::class, 'courseParticipantStat'], [TeacherOnlyMiddleware::class]);
    $app->get('/course/enroll', [CoursesController::class, 'enrollCourse'], [AuthRequiredMiddleware::class]);
    $app->get('/course/create', [CoursesController::class, 'createCourseView'], [TeacherOnlyMiddleware::class]);
    $app->post('/create-course', [CoursesController::class, 'createCourse'], [TeacherOnlyMiddleware::class]);
    $app->get('/courses/my-courses', [CoursesController::class, 'myCourses'], [AuthRequiredMiddleware::class]);
    $app->get('/courses/demo', [CoursesController::class, 'demoCourses']);
    $app->get('/courses/my/registered', [CoursesController::class, 'regCourses'], [AuthRequiredMiddleware::class]);
    $app->get('/courses/user', [CoursesController::class, 'userCourses'], [StudentOnlyMiddleware::class]);

    // Course Requests
    $app->get('/course/request', [PostController::class, 'courseRequest']);
    $app->get('/course/request/create', [PostController::class, 'createCourseRequestView'], [AuthRequiredMiddleware::class]);
    $app->get('/course/request/edit/{id}', [PostController::class, 'updateCourseRequestView'], [AuthRequiredMiddleware::class]);
    $app->get('/course/request/{id}', [PostController::class, 'requestDetails'], [AuthRequiredMiddleware::class]);
    $app->post('/course/request/create', [PostController::class, 'createCourseRequest'], [AuthRequiredMiddleware::class]);
    $app->post('/course/request/{id}/comments/create', [PostController::class, 'createComment'], [AuthRequiredMiddleware::class]);
    $app->put('/course/request/{requestId}/comments/{commentId}', [PostController::class, 'updateComment'], [AuthRequiredMiddleware::class]);
    $app->put('/course/request/{id}', [PostController::class, 'updateCourseRequest'], [AuthRequiredMiddleware::class]);
    $app->delete('/course/request/{id}', [PostController::class, 'deleteCourseRequest'], [AuthRequiredMiddleware::class]);
    $app->delete('/course/request/{requestId}/comments/{commentId}', [PostController::class, 'deleteComment'], [AuthRequiredMiddleware::class]);

    // Resources
    $app->get('/resource', [ResourceController::class, 'resource']);

    // Reviews
    $app->post('/add-review', [ReviewController::class, 'addReview'], [AuthRequiredMiddleware::class]);
    $app->get('/review/edit/{review}', [ReviewController::class, 'editView'], [AuthRequiredMiddleware::class]);
    $app->post('/review/edit/{review}', [ReviewController::class, 'edit'], [AuthRequiredMiddleware::class]);
    $app->delete('/review/delete/{review}', [ReviewController::class, 'deleteReview'], [AuthRequiredMiddleware::class]);

    // Assignments
    $app->get('/course/{courseId}/assignment/create', [AssignmentController::class, 'createAssignment']);

    // Catch-all route for 404 page
    $app->get('/{any:.*}', [PageController::class, 'notFound']);
}
