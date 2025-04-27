<?php


declare(strict_types=1);


namespace App\Config;

use App\Controllers\{
    AnnouncementController,
    AdvertisementController,
    AlertController,
    AssignmentController,
    AuthController,
    ContactController,
    CoursesController,
    NotificationController,
    PageController,
    PaymentController,
    ResourceController,
    PostController,
    ReportController,
    ReviewController,
    UserController
};
use App\Middleware\{
    AdminOnlyMiddleware,
    AuthRequiredMiddleware,
    GuestOnlyMiddleware,
    NotificationMiddleware,
    StudentOnlyMiddleware,
    TeacherOnlyMiddleware
};
use Framework\App;

function registerRoutes(App $app)
{
    $app->get('/', [PageController::class, 'home']);
    $app->get('/about', [PageController::class, 'about']);
    $app->get('/dashboard', [PageController::class, 'dashboard'], [AuthRequiredMiddleware::class]);
    $app->get('/settings', [PageController::class, 'settings'], [AuthRequiredMiddleware::class]);
    $app->get('/help-and-support', [PageController::class, 'helpAndSupport']);
    $app->post('/help-and-support', [PageController::class, 'sendHelpAndSupport']);
    $app->get('/announcements/create', [PageController::class, 'createAnnouncements']);
    $app->get('/help-and-support', [PageController::class, 'helpAndSupport']);

    $app->get('/user-managment', [PageController::class, 'userManagment']);
    $app->get('/course-managment', [PageController::class, 'courseManagment']);
    $app->get('/post-managment', [PageController::class, 'postManagment']);
    $app->get('/advertisement-managment', [PageController::class, 'adManagment']);

    $app->get('/revenue-report', [PageController::class, 'revenueReportView']);



    // Admin Resource managment
    $app->get('/resource-managment', [PageController::class, 'resourceManagment']);
    $app->post('/resource-managment/approve/{resource_id}', [ResourceController::class, 'approveResource']);
    $app->post('/resource-managment/reject/{resource_id}', [ResourceController::class, 'rejectResource']);
    $app->delete('/resource-managment/delete/{resource_id}', [ResourceController::class, 'deleteResourceAdmin']);

    // Contact
    $app->get('/contact', [ContactController::class, 'contact']);
    $app->post('/contact', [ContactController::class, 'submitContactForm']);
    $app->get('/contact/successfull', [ContactController::class, 'successfull']);

    // User
    $app->get('/register', [AuthController::class, 'registerRoleView'], [GuestOnlyMiddleware::class]);
    $app->post('/choose-role', [AuthController::class, 'chooseRole'], [GuestOnlyMiddleware::class]);
    $app->get('/register/create-account', [AuthController::class, 'registerView'], [GuestOnlyMiddleware::class]);
    $app->post('/register', [AuthController::class, 'register'], [GuestOnlyMiddleware::class]);
    $app->get('/register/verification', [AuthController::class, 'verificationView'], [GuestOnlyMiddleware::class]);
    $app->post('/verify-otp', [AuthController::class, 'verifyuser'], [GuestOnlyMiddleware::class]);
    $app->post('/resend-otp', [AuthController::class, 'resendOtp'], [GuestOnlyMiddleware::class]);
    $app->get('/interest', [PageController::class, 'interestView'], [AuthRequiredMiddleware::class]);
    $app->post('/interest', [PageController::class, 'interest'], [AuthRequiredMiddleware::class]);

    $app->get('/login', [AuthController::class, 'loginView'], [GuestOnlyMiddleware::class]);
    $app->post('/login', [AuthController::class, 'login'],  [GuestOnlyMiddleware::class]);
    $app->get('/logout', [AuthController::class, 'logout'], [AuthRequiredMiddleware::class]);
    $app->get('/create-ad', [PageController::class, 'createAd'], [TeacherOnlyMiddleware::class]);
    $app->post('/update-profile', [UserController::class, 'updateProfile'], [AuthRequiredMiddleware::class]);
    $app->post('/update-password', [UserController::class, 'updatePassword'], [AuthRequiredMiddleware::class]);
    $app->post('/update-profile-picture', [UserController::class, 'updateProfilePicture'], [AuthRequiredMiddleware::class]);

    //Billing and payments
    $app->get('/billing-and-payment', [PageController::class, 'billingAndPayment'], [AuthRequiredMiddleware::class]);
    $app->get('/withdraw', [PageController::class, 'walletView'], [AuthRequiredMiddleware::class]);
    $app->post('/request-withdrawal', [PageController::class, 'requestWithdrawal'], [AuthRequiredMiddleware::class]);
    $app->get('/withdrawal-managment', [PageController::class, 'withdrawalManagment']);
    $app->post('/withdrawal/complete/{withdrawal_id}', [PageController::class, 'completeWithdrawal']);
    $app->post('/withdrawal/cancel/{withdrawal_id}', [PageController::class, 'cancelWithdrawal']);


    // Admin operations
    $app->post('/approve-post', [PostController::class, 'approveCourseRequest']);
    $app->post('/reject-post', [PostController::class, 'rejectCourseRequest']);
    $app->get('/admin-dashboard/user-managment', [PageController::class, 'userManagment'], [AdminOnlyMiddleware::class]);
    $app->post('/admin/adduser', [UserController::class, 'addUser'], [AdminOnlyMiddleware::class]); // Add new user
    $app->delete('/user/delete/{user_id}', [UserController::class, 'deleteUser'], [AuthRequiredMiddleware::class]); // Delete user

    // tutor
    $app->get('/tutor/{tutor-id}', [PageController::class, 'tutorProfile']);
    $app->get('/tutor/{tutor-id}/create_profile', [AuthController::class, 'createTutorProfileView'], [TeacherOnlyMiddleware::class]);
    $app->post('/api/tutor/profile_create', [AuthController::class, 'createTutorProfile'], [TeacherOnlyMiddleware::class]);
    $app->get('/tutor/{tutor-id}/update_profile', [AuthController::class, 'updateTutorProfileView'], [TeacherOnlyMiddleware::class]);
    $app->post('/api/tutor/profile_update', [AuthController::class, 'updateTutorProfile'], [TeacherOnlyMiddleware::class]);
    $app->delete('/tutor/delete_experience/{tutor_id}/{subject_id}', [AuthController::class, 'deleteTutorExperience'], [TeacherOnlyMiddleware::class]);
    $app->delete('/tutor/delete_education/{education_id}', [AuthController::class, 'deleteTutorEducation'], [TeacherOnlyMiddleware::class]);
    $app->delete('/tutor/delete_availability/{availability_id}', [AuthController::class, 'deleteTutorAvailability'], [TeacherOnlyMiddleware::class]);

    // Courses
    $app->get('/courses', [CoursesController::class, 'course']);
    $app->get('/course/edit/{course_id}', [CoursesController::class, 'courseEditView']);
    $app->put('/course/edit/{course_id}', [CoursesController::class, 'editCourse']);
    $app->delete('/manage-course/delete/{course}', [CoursesController::class, 'deleteCourse'], [TeacherOnlyMiddleware::class]);
    $app->get('/courses/mycourses', [CoursesController::class, 'userCourses'], [AuthRequiredMiddleware::class]);


    $app->delete('/course/{course_id}/module/{module_id}', [CoursesController::class, 'deleteCourseModule']);

    // courseInfo
    $app->get('/courses/{course_id}', [CoursesController::class, 'courseInfo']);
    $app->get('/courses/{course_id}/participants', [CoursesController::class, 'courseParticipant']);
    $app->get('/courses/{course_id}/participants/{participant_id}', [CoursesController::class, 'courseParticipantStat'], [TeacherOnlyMiddleware::class]);

    $app->get('/course/{course_id}/module/{module_id}/resource/{resource_id}', [CoursesController::class, 'readModuleResources'], [TeacherOnlyMiddleware::class]);

    // New course Routes
    $app->get('/course/create', [CoursesController::class, 'createView'], [TeacherOnlyMiddleware::class]);
    $app->post('/course/create', [CoursesController::class, 'create'], [TeacherOnlyMiddleware::class]);
    $app->get('/course/{course_id}/module/create', [CoursesController::class, 'createModuleView'], [TeacherOnlyMiddleware::class]);
    $app->post('/course/{course_id}/module/create', [CoursesController::class, 'createModule'], [TeacherOnlyMiddleware::class]);

    $app->post('/mark-attendance', [CoursesController::class, 'markAttendance'], [StudentOnlyMiddleware::class]);

    $app->get('/course/create/add-module', [CoursesController::class, 'addModuleView'], [TeacherOnlyMiddleware::class]);

    // TODO: Remove if not necessary
    $app->get('/course/create/success', [CoursesController::class, 'successMessage']);

    // Course Requests
    $app->get('/course/request', [PostController::class, 'CourseRequestView']);
    $app->get('/course/request/create', [PostController::class, 'createCourseRequestView'], [AuthRequiredMiddleware::class]);
    $app->post('/course/request/create', [PostController::class, 'createCourseRequest'], [AuthRequiredMiddleware::class]);
    $app->get('/course/request/edit/{request_id}', [PostController::class, 'editCourseRequestView'], [AuthRequiredMiddleware::class]);
    $app->get('/course/request/{id}', [PostController::class, 'requestDetails'], [AuthRequiredMiddleware::class]);
    $app->post('/course/request/{id}/comments/create', [PostController::class, 'createComment'], [AuthRequiredMiddleware::class]);
    $app->put('/course/request/{requestId}/comments/{commentId}', [PostController::class, 'updateComment'], [AuthRequiredMiddleware::class]);
    $app->put('/course/request/edit/{request_id}', [PostController::class, 'updateCourseRequest'], [AuthRequiredMiddleware::class]);
    $app->delete('/course/request/{id}', [PostController::class, 'deleteCourseRequest'], [AuthRequiredMiddleware::class]);
    $app->delete('/course/request/{requestId}/comments/{commentId}', [PostController::class, 'deleteComment'], [AuthRequiredMiddleware::class]);

    $app->get('/courserequest-managment', [PostController::class, 'managmentView']);

    // Resources
    $app->get('/resource', [ResourceController::class, 'resource']);
    $app->get('/resource/create', [ResourceController::class, 'createView']);
    $app->post('/resource/create', [ResourceController::class, 'createResource']);
    $app->get('/resource/my-resources', [ResourceController::class, 'myResources'], [AuthRequiredMiddleware::class]);
    $app->delete('/resource/delete/{resource_id}', [ResourceController::class, 'deleteResource'], [AuthRequiredMiddleware::class]);
    $app->get('/resource/edit/{resource_id}', [ResourceController::class, 'editView'], [AuthRequiredMiddleware::class]);
    $app->post('/resource/edit/{resource_id}', [ResourceController::class, 'updateResource'], [AuthRequiredMiddleware::class]);
    $app->get('/resource/download/{resource_id}', [ResourceController::class, 'downloadResource']);


    // announcement
    $app->get('/courses/{course_id}/announcements/create', [AnnouncementController::class, 'announcementsFormView'], [AuthRequiredMiddleware::class]);
    $app->post('/courses/{course_id}/announcements/create', [AnnouncementController::class, 'createAnnouncements'], [AuthRequiredMiddleware::class]);
    $app->get('/courses/{course_id}/announcements', [AnnouncementController::class, 'announcementsListView'], [AuthRequiredMiddleware::class]);
    $app->delete('/announcements/delete/{announcement_id}', [AnnouncementController::class, 'deleteAnnouncement'], [AuthRequiredMiddleware::class]);
    $app->post('/announcements/mark-as-read', [AnnouncementController::class, 'markAsRead'], [AuthRequiredMiddleware::class]);
    $app->post('/announcements/mark_as', [AnnouncementController::class, 'markAsButtonToggle'], [AuthRequiredMiddleware::class]);
    $app->post('/announcements/mark-as-unread', [AnnouncementController::class, 'markAsUnread'], [AuthRequiredMiddleware::class]);
    $app->post('/courses/{course_id}/announcements/attachments', [AnnouncementController::class, 'downloadAttachment'], [AuthRequiredMiddleware::class]);

    // course Reviews
    $app->get('/course/review/{course}/{page}', [ReviewController::class, 'getCourseReview']);
    $app->post('/add-course-review', [ReviewController::class, 'addCourseReview'], [AuthRequiredMiddleware::class]);
    $app->delete('/course/delete-review/{review}', [ReviewController::class, 'deleteCourseReview'], [AuthRequiredMiddleware::class]);
    $app->get('/courses/review/edit/{review}', [ReviewController::class, 'editCourseReviewView'], [AuthRequiredMiddleware::class]);
    $app->post('/course/review/edit/{review}', [ReviewController::class, 'editCourseReview'], [AuthRequiredMiddleware::class]);

    // tutor Reviews
    $app->get('/tutor/review/{tutor_id}/{page}', [ReviewController::class, 'getTutorReview']);
    $app->post('/add-tutor-review', [ReviewController::class, 'addTutorReview'], [AuthRequiredMiddleware::class]);
    $app->delete('/delete-tutor-review/{review}', [ReviewController::class, 'deleteTutorReview'], [AuthRequiredMiddleware::class]);
    $app->get('/tutor/reviews/edit/{review}', [ReviewController::class, 'editTutorReviewView'], [AuthRequiredMiddleware::class]);
    $app->post('/tutor/review/edit/{review}', [ReviewController::class, 'editTutorReview'], [AuthRequiredMiddleware::class]);

    // Reviews
    $app->post('/add-review', [ReviewController::class, 'addReview'], [AuthRequiredMiddleware::class]);
    $app->get('/review/edit/{review}', [ReviewController::class, 'editView'], [AuthRequiredMiddleware::class]);
    $app->post('/review/edit/{review}', [ReviewController::class, 'edit'], [AuthRequiredMiddleware::class]);
    $app->delete('/review/delete/{review}', [ReviewController::class, 'deleteReview'], [AuthRequiredMiddleware::class]);

    // Assignments
    $app->get('/courses/{courseId}/assignment/create', [AssignmentController::class, 'createAssignmentView']);
    $app->post('/courses/{courseId}/assignment/create', [AssignmentController::class, 'createAssignment']);
    $app->get('/courses/{courseId}/assignment/{assignment_id}/edit', [AssignmentController::class, 'editAssignment']);
    $app->post('/courses/{courseId}/assignment/{assignment_id}/update', [AssignmentController::class, 'updateAssignment']);
    $app->get('/courses/{courseId}/assignment/{assignment_id}', [AssignmentController::class, 'assignmentView']);
    $app->post('/courses/{courseId}/assignment/{assignment_id}/submit', [AssignmentController::class, 'submitAssignment']);

    $app->get('/assignment/{assignment_id}/resource/{resource_id}', [AssignmentController::class, 'getResource']);


    $app->get('/courses/{courseId}/assignment/{assignment_id}/review', [AssignmentController::class, 'review']);
    $app->get('/submission/{submission_id}/attachment/{attachment_id}', [AssignmentController::class, 'getSubmissionFile']);
    $app->post('/submission/{submission_id}/attachment/{attachment_id}/remove', [AssignmentController::class, 'removeSubmissionFile']);
    $app->post('/submit/review', [AssignmentController::class, 'submit']);

    // Advertisement
    $app->get('/advertisement/create', [AdvertisementController::class, 'createView'], [TeacherOnlyMiddleware::class]);
    $app->post('/advertisement/create', [AdvertisementController::class, 'create'], [TeacherOnlyMiddleware::class]);
    $app->post('/approve-advertisement', [AdvertisementController::class, 'approve']);
    $app->post('/reject-advertisement', [AdvertisementController::class, 'reject']);
    $app->delete('/delete-advertisement/{ad_id}', [AdvertisementController::class, 'delete']);


    // Notifications
    $app->get('/api/notifications', [NotificationController::class, 'getUserNotifications'], [NotificationMiddleware::class]);
    $app->post('/api/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'], [NotificationMiddleware::class]);
    $app->post('/api/notifications/mark-as-read/{notification_id}', [NotificationController::class, 'markAsRead'], [NotificationMiddleware::class]);
    $app->get('/notifications', [NotificationController::class, 'notificationView'], [AuthRequiredMiddleware::class]);
    $app->get('/notifications/{notification_id}/mark-as-read', [NotificationController::class, 'markAsReadFromView'], [AuthRequiredMiddleware::class]);
    $app->get('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsReadFromView'], [AuthRequiredMiddleware::class]);

    // Payments
    $app->get('/payment/courses/{course_id}', [PaymentController::class, 'onetimeCoursePaymentView'], [AuthRequiredMiddleware::class]);
    $app->get('/payment/courses/{course_id}/{subperiod_id}', [PaymentController::class, 'courserSubPeriodPaymentView'], [AuthRequiredMiddleware::class]);
    $app->get('/payment/advertisement/{advertisement_id}', [PaymentController::class, 'advertisementPaymentView'], [AuthRequiredMiddleware::class]);
    $app->post('/payment/courses/{course_id}', [PaymentController::class, 'onetimeCoursePayment'], [AuthRequiredMiddleware::class]);
    $app->post('/payment/courses/{course_id}/{subperiod_id}', [PaymentController::class, 'courseSubperiodPayment'], [AuthRequiredMiddleware::class]);
    $app->post('/payment/advertisement/{advertisement_id}', [PaymentController::class, 'advertisementPayment'], [AuthRequiredMiddleware::class]);
    $app->post(AppConstants::COURSE_PAYMENT_RELATIVE_NOTIFY_URL, [PaymentController::class, 'handlePaymentNotification']);

    $app->get('/unauthorized-access', [PageController::class, 'unauthorizedAccess']);
    $app->get('/server-error', [PageController::class, 'internalServerError']);


    $app->get('/test', [PageController::class, 'test']);
    $app->get('/test/help', [PageController::class, 'helpAndSupportReview']);

    // Reports
    $app->get('/reports/teacher', [ReportController::class, 'getTeacherReport']);

    // Catch-all route for 404 page
    $app->get('/{any:.*}', [PageController::class, 'notFound']);
}
