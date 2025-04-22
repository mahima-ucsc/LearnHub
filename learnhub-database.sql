CREATE TABLE IF NOT EXISTS users (
    user_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone_no VARCHAR(15),
    date_of_birth DATE NOT NULL,
    description TEXT,
    joined_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    last_login DATETIME,
    profile_picture_url TEXT,
    location VARCHAR(255),
    password VARCHAR(255) NOT NULL,
    user_role ENUM('student', 'teacher', 'admin', 'guest') NOT NULL,
    PRIMARY KEY(user_id),
    UNIQUE KEY(email),
    is_verified BOOLEAN NOT NULL DEFAULT FALSE
);

-- Table for grades
CREATE TABLE IF NOT EXISTS grades (
    grade_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    grade_name VARCHAR(255) NOT NULL,
    PRIMARY KEY(grade_id)
);

-- Each student has one grade
CREATE TABLE IF NOT EXISTS student_grades (
    student_id BIGINT(20) UNSIGNED NOT NULL,
    grade_id BIGINT(20) UNSIGNED NOT NULL,
    PRIMARY KEY(student_id, grade_id),
    FOREIGN KEY (student_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (grade_id) REFERENCES grades(grade_id) ON DELETE CASCADE
);

-- Each teacher can have multiple grades
-- CREATE TABLE IF NOT EXISTS teacher_grades (
--     teacher_id BIGINT(20) UNSIGNED NOT NULL,
--     grade_id BIGINT(20) UNSIGNED NOT NULL,
--     PRIMARY KEY(teacher_id, grade_id),
--     FOREIGN KEY (teacher_id) REFERENCES users(user_id) ON DELETE CASCADE,
--     FOREIGN KEY (grade_id) REFERENCES grades(grade_id) ON DELETE CASCADE
-- );

CREATE TABLE IF NOT EXISTS subjects (
    subject_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    subject_title VARCHAR(255) NOT NULL,
    PRIMARY KEY(subject_id)
);

-- Each user (student or teacher) can have multiple subjects
CREATE TABLE IF NOT EXISTS user_subjects (
    user_id BIGINT(20) UNSIGNED NOT NULL,
    subject_id BIGINT(20) UNSIGNED NOT NULL,
    PRIMARY KEY(user_id, subject_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (subject_id) REFERENCES subjects(subject_id) ON DELETE CASCADE
);

-- Table for courses, each course is linked to a subject, grade, and a single tutor (teacher)
CREATE TABLE IF NOT EXISTS courses (
    course_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    subject_id BIGINT(20) UNSIGNED NOT NULL,
    grade_id BIGINT(20) UNSIGNED NOT NULL,
    tutor_id BIGINT(20) UNSIGNED NOT NULL,
    start_time TIME NULL,
    end_time TIME NULL,
    thumbnail_url TEXT,
    day VARCHAR(20) NULL,
    -- The 'price' column is NULL for courses with a recurring billing type
    -- and is NOT NULL for courses with a one-time billing type.
    price decimal(10,2) NULL,
    billing_type ENUM('onetime', 'recurring') NOT NULL,   
    location VARCHAR(50) NOT NULL,
    published_date DATE NOT NULL DEFAULT CURRENT_DATE,
    PRIMARY KEY(course_id),
    FOREIGN KEY (subject_id) REFERENCES subjects(subject_id) ON DELETE CASCADE,
    FOREIGN KEY (grade_id) REFERENCES grades(grade_id) ON DELETE CASCADE,
    FOREIGN KEY (tutor_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Table for recurring course subscription periods
CREATE TABLE IF NOT EXISTS recurring_course_sub_periods (
    sub_period_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    course_id BIGINT(20) UNSIGNED NOT NULL,
    start_datetime DATETIME NOT NULL,
    end_datetime DATETIME NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    free_access_start_datetime DATETIME NULL,
    free_access_end_datetime DATETIME NULL,
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE
);

-- Base table for all payment types
CREATE TABLE IF NOT EXISTS payments (
    payment_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    amount DECIMAL(10,2) NOT NULL,
    order_id VARCHAR(50) NOT NULL UNIQUE,
    payment_status TINYINT NOT NULL DEFAULT 0, -- 2=success, 0=pending, -1=canceled, -2=failed, -3=chargedback
    created_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Specialized table for course payment details
CREATE TABLE IF NOT EXISTS course_payments (
    course_payment_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT(20) UNSIGNED NOT NULL,
    payment_id BIGINT(20) UNSIGNED NOT NULL,
    course_id BIGINT(20) UNSIGNED NOT NULL,
    -- Payment for a course can be either:
    -- 1. For a one-time course: sub_period_id should be NULL
    -- 2. For a recurring course: sub_period_id must NOT be NULL
    sub_period_id BIGINT(20) UNSIGNED,
    
    FOREIGN KEY (payment_id) REFERENCES payments(payment_id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE,
    FOREIGN KEY (sub_period_id) REFERENCES recurring_course_sub_periods(sub_period_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Course modules for each course
CREATE TABLE IF NOT EXISTS course_modules (
    module_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    description TEXT,
    -- If this module belongs to a one time course:
    --    The course_id must be entered and subperiodid should be NULL
    -- If this module belongs to a recurring course:
    --    Both course_id and subperiodid must be entered
    course_id BIGINT(20) UNSIGNED NOT NULL,
    sub_period_id BIGINT(20) UNSIGNED,
    title VARCHAR(255) NOT NULL,
    
    FOREIGN KEY (sub_period_id) REFERENCES recurring_course_sub_periods(sub_period_id) ON DELETE CASCADE,
    PRIMARY KEY(module_id),
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE
);

-- Resources for each Course module
CREATE TABLE IF NOT EXISTS course_module_resource (
    resource_id INT AUTO_INCREMENT,
    module_id BIGINT(20) UNSIGNED NOT NULL,
    course_id BIGINT(20) UNSIGNED NOT NULL,
    resource_path VARCHAR(255),
    
    PRIMARY KEY(resource_id),
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE,
    FOREIGN KEY (module_id) REFERENCES course_modules(module_id) ON DELETE CASCADE
);

-- Table for module dates (a module can have several dates)
CREATE TABLE IF NOT EXISTS course_module_dates (
    course_module_date_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    module_id BIGINT(20) UNSIGNED NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    PRIMARY KEY(course_module_date_id),
    FOREIGN KEY (module_id) REFERENCES course_modules(module_id) ON DELETE CASCADE
);

-- Content associated with course module dates
CREATE TABLE IF NOT EXISTS course_module_date_content (
    content_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    content TEXT NOT NULL,
    course_module_date_id BIGINT(20) UNSIGNED NOT NULL,
    PRIMARY KEY(content_id),
    FOREIGN KEY (course_module_date_id) REFERENCES course_module_dates(course_module_date_id) ON DELETE CASCADE
);

-- Resources associated with course module dates
CREATE TABLE IF NOT EXISTS resources (
    resource_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    resource TEXT NOT NULL,
    PRIMARY KEY(resource_id)
);

-- Assign resources to course module dates
CREATE TABLE IF NOT EXISTS course_module_date_resources (
    course_module_date_id BIGINT(20) UNSIGNED NOT NULL,
    resource_id BIGINT(20) UNSIGNED NOT NULL,
    PRIMARY KEY(course_module_date_id, resource_id),
    FOREIGN KEY (course_module_date_id) REFERENCES course_module_dates(course_module_date_id) ON DELETE CASCADE,
    FOREIGN KEY (resource_id) REFERENCES resources(resource_id) ON DELETE CASCADE
);


-- Students enrolled in courses
CREATE TABLE IF NOT EXISTS students_courses (
    student_id BIGINT(20) UNSIGNED NOT NULL,
    course_id BIGINT(20) UNSIGNED NOT NULL,
    registered_date DATE DEFAULT CURRENT_DATE(),
    pinned BOOL DEFAULT FALSE,
    PRIMARY KEY(student_id, course_id),
    FOREIGN KEY (student_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE
);

-- Attendance for students in course module dates
CREATE TABLE IF NOT EXISTS attendance (
    course_module_date_id BIGINT(20) UNSIGNED NOT NULL,
    user_id BIGINT(20) UNSIGNED NOT NULL,
    PRIMARY KEY(course_module_date_id, user_id),
    FOREIGN KEY (course_module_date_id) REFERENCES course_module_dates(course_module_date_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Posts (discussions, help requests, etc.)
CREATE TABLE IF NOT EXISTS posts (
    post_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    description TEXT NOT NULL,
    title VARCHAR(255) NOT NULL,
    created_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    user_id BIGINT(20) UNSIGNED NOT NULL,
    PRIMARY KEY(post_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Comments on post requests
CREATE TABLE IF NOT EXISTS post_comments (
    comment_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    comment TEXT NOT NULL,
    created_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    user_id BIGINT(20) UNSIGNED NOT NULL,
    post_id BIGINT(20) UNSIGNED NOT NULL,
    PRIMARY KEY(comment_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES posts(post_id) ON DELETE CASCADE
);

-- Reviews for tutor
CREATE TABLE IF NOT EXISTS tutor_review(
    review_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    review TEXT NOT NULL,
    rating TINYINT UNSIGNED CHECK (rating BETWEEN 0 AND 5),
    tutor_id BIGINT(20) UNSIGNED NOT NULL,
    user_id BIGINT(20) UNSIGNED NOT NULL,
    PRIMARY KEY(review_id),
    FOREIGN KEY(tutor_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY(user_id) REFERENCES users(user_id) ON DELETE CASCADE
);
-- Reviews for courses
CREATE TABLE IF NOT EXISTS course_review(
    review_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    review TEXT NOT NULL,
    rating TINYINT UNSIGNED CHECK (rating BETWEEN 0 AND 5),
    course_id BIGINT(20) UNSIGNED NOT NULL,
    user_id BIGINT(20) UNSIGNED NOT NULL,
    PRIMARY KEY(review_id),
    FOREIGN KEY(course_id) REFERENCES courses(course_id) ON DELETE CASCADE,
    FOREIGN KEY(user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Course Transaction
CREATE TABLE IF NOT EXISTS course_transactions(
    transaction_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    course_id BIGINT(20) UNSIGNED NOT NULL,
    user_id BIGINT(20) UNSIGNED NOT NULL,
    amount decimal(10,2) NOT NULL,
    transaction_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY(transaction_id) 
);
-- Course requests
CREATE TABLE IF NOT EXISTS course_requests (
    request_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    subject_id BIGINT(20) UNSIGNED,
    grade_id BIGINT(20) UNSIGNED NOT NULL,
    status ENUM('pending', 'approved') NOT NULL DEFAULT 'pending',
    location VARCHAR(100) NOT NULL,

    created_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
    user_id BIGINT(20) UNSIGNED NOT NULL,
    PRIMARY KEY(request_id),
    FOREIGN KEY (subject_id) REFERENCES subjects(subject_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (grade_id) REFERENCES grades(grade_id) ON DELETE CASCADE
);

-- Comments on course requests
CREATE TABLE IF NOT EXISTS course_request_comments (
    comment_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    comment TEXT NOT NULL,
    created_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
    user_id BIGINT(20) UNSIGNED NOT NULL,
    request_id BIGINT(20) UNSIGNED NOT NULL,
    PRIMARY KEY(comment_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (request_id) REFERENCES course_requests(request_id) ON DELETE CASCADE
);

-- Assignments for courses
CREATE TABLE IF NOT EXISTS assignments (
    assignment_id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    course_id BIGINT(20) UNSIGNED NOT NULL,
    resource_path varchar(255) DEFAULT NULL,
    upload_date DATE DEFAULT CURRENT_DATE,
    deadline datetime,
    instruction text ,
    tutor_id bigint(20) UNSIGNED NOT NULL,
    
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE,
    FOREIGN KEY (tutor_id) REFERENCES users(user_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS assignment_resource (
    resource_id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    assignment_id BIGINT(20) UNSIGNED NOT NULL,
    course_id BIGINT(20) UNSIGNED NOT NULL,
    resource_path VARCHAR(255),
    
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE,
    FOREIGN KEY (assignment_id) REFERENCES assignments(assignment_id) ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS assignment_submission(
    submission_id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    assignment_id BIGINT(20) UNSIGNED NOT NULL,
    course_id BIGINT(20) UNSIGNED NOT NULL,
    upload_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    student_id BIGINT(20) UNSIGNED NoT NULL,
    status ENUM('pending', 'graded') DEFAULT 'pending',
    grade INT DEFAULT 0 CHECK (grade >= 0 AND grade <= 100),
    feedback TEXT,

    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE,
    FOREIGN KEY (student_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (assignment_id) REFERENCES assignments(assignment_id) ON DELETE CASCADE
);
CREATE TABLE IF NOT EXISTS assignment_submission_attachment(
    attachment_id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    submission_id BIGINT(20) UNSIGNED NOT NULL,
    attachment_path VARCHAR(255),
    FOREIGN KEY (submission_id) REFERENCES assignment_submission(submission_id) ON DELETE CASCADE
);

CREATE TABLE contact_tickets (
    `id` INT(11) NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(50) NOT NULL , 
    `email` VARCHAR(50) NOT NULL , 
    `message` TEXT NOT NULL , 
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    PRIMARY KEY (`id`)
);

-- Table for OTP verification
CREATE TABLE otp_verification (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT(20) UNSIGNED NOT NULL,
    otp VARCHAR(255) NOT NULL,
    expires_at DATETIME NOT NULL,
    is_verified TINYINT(1) DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Table for resources shared by users
CREATE TABLE IF NOT EXISTS shared_resources (
    resource_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    category VARCHAR(50) NOT NULL,
    resource_type VARCHAR(50) NOT NULL,
    is_free TINYINT(1) NOT NULL DEFAULT 1,
    price DECIMAL(10,2) DEFAULT 0,
    resource_url TEXT,
    user_id BIGINT(20) UNSIGNED NOT NULL,
    
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    PRIMARY KEY(resource_id)
);

-- Table for advertisements
CREATE TABLE IF NOT EXISTS advertisement (
    advertisement_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    description TEXT NOT NULL,
    package ENUM('basic', 'standard', 'gold') NOT NULL,
    discount INT CHECK(discount >= 0 AND discount <= 100),
    remark TEXT,
    thumbnail_url TEXT NOT NULL,
    end_date TIMESTAMP,
    course_id BIGINT(20) UNSIGNED NOT NULL,
    user_id BIGINT(20) UNSIGNED NOT NULL,
    status ENUM('pending', 'approved', 'rejected', 'expired') DEFAULT 'pending',
    
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE,
    PRIMARY KEY(advertisement_id)
);

-- Enable Event Scheduler
SET GLOBAL event_scheduler = ON;

-- Scheduled Event which will run once a day and update rows which the end_date is 
-- in the past and status is 'approved' to status 'expire'
-- Use to track advertisements which the validity period is expired
CREATE EVENT IF NOT EXISTS update_status_event
ON SCHEDULE EVERY 1 DAY
DO
  UPDATE advertisement
  SET status = 'expired'
  WHERE end_date < CURDATE() AND status = 'approved';


-- Table to store features of ad
CREATE TABLE IF NOT EXISTS advertisement_feature(
    feature_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    advertisement_id BIGINT(20) UNSIGNED NOT NULL,
    feature TEXT,

    FOREIGN KEY (advertisement_id) REFERENCES advertisement(advertisement_id) ON DELETE CASCADE,
    PRIMARY KEY (feature_id)
);

-- Table for notifications
CREATE TABLE IF NOT EXISTS notifications (
    notification_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    message TEXT NOT NULL,
    url VARCHAR(255),
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(notification_id)
);

-- Table to associate notifications with users and track read status
CREATE TABLE IF NOT EXISTS notification_users (
    notification_user_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    notification_id BIGINT(20) UNSIGNED NOT NULL,
    user_id BIGINT(20) UNSIGNED NOT NULL,
    is_read TINYINT NOT NULL DEFAULT 0,
    PRIMARY KEY(notification_user_id),
    UNIQUE KEY(notification_id, user_id),
    FOREIGN KEY (notification_id) REFERENCES notifications(notification_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Table to track student attendance
CREATE TABLE IF NOT EXISTS student_module_attendance(
    attendance_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    student_id BIGINT(20) UNSIGNED NOT NULL,
    course_id BIGINT(20) UNSIGNED NOT NULL,
    module_id BIGINT(20) UNSIGNED NOT NULL,
    attended_date DATETIME NOT NULL,
    is_attended TINYINT NOT NULL DEFAULT 0,

    PRIMARY KEY(attendance_id),
    FOREIGN KEY(student_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY(course_id) REFERENCES courses(course_id) ON DELETE CASCADE,
    FOREIGN KEY (module_id) REFERENCES course_modules(module_id) ON DELETE CASCADE
);

-- table for announcements
CREATE TABLE IF NOT EXISTS announcements (
    announcement_id BIGINT(20) AUTO_INCREMENT PRIMARY KEY,
    course_id BIGINT(20) UNSIGNED NOT NULL, 
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    category ENUM('assignment', 'event', 'general', 'news', 'reminder') NOT NULL DEFAULT 'general',
    visibility ENUM('all', 'specific') NOT NULL DEFAULT 'all',
    specific_emails JSON DEFAULT NULL, -- Stores specific emails as JSON
    attachments TEXT DEFAULT NULL, -- Stores file paths of uploaded attachments
    send_email BOOLEAN NOT NULL DEFAULT FALSE, -- Indicates if email notifications are sent
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS announcements_read (
    announcements_read_id BIGINT(20) AUTO_INCREMENT PRIMARY KEY,
    announcement_id BIGINT(20) NOT NULL,
    user_id BIGINT(20) UNSIGNED NOT NULL,
    is_read BOOLEAN NOT NULL DEFAULT FALSE,
    FOREIGN KEY (announcement_id) REFERENCES announcements(announcement_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- tutor profile details
CREATE TABLE IF NOT EXISTS TutorProfiles(
    tutor_profile_id BIGINT(20) UNSIGNED NOT NULL PRIMARY KEY,
    tutor_id BIGINT(20) UNSIGNED NOT NULL,
    title VARCHAR(255),
    bio TEXT,
    FOREIGN KEY (tutor_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Table to store subjects taught by tutors
CREATE TABLE IF NOT EXISTS TutorSubjects (
    tutor_id BIGINT(20) UNSIGNED NOT NULL,
    subject_id BIGINT(20) UNSIGNED NOT NULL,
    years_experience INTEGER,
    PRIMARY KEY (tutor_id, subject_id),
    FOREIGN KEY (tutor_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (subject_id) REFERENCES subjects(subject_id) ON DELETE CASCADE
);

-- Table to store education details of tutors
CREATE TABLE IF NOT EXISTS TutorEducation (
    education_id  BIGINT(20) UNSIGNED NOT NULL PRIMARY KEY,
    tutor_id BIGINT(20) UNSIGNED NOT NULL,
    degree VARCHAR(255) NOT NULL,
    institution VARCHAR(255) NOT NULL,
    field_of_study VARCHAR(255),
    start_date DATE,
    end_date DATE,
    FOREIGN KEY (tutor_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Availability schedule
CREATE TABLE TutorAvailability (
    availability_id SERIAL PRIMARY KEY,
    tutor_id BIGINT(20) UNSIGNED NOT NULL,
    day_of_week INTEGER NOT NULL, -- 0=Sunday, 1=Monday, etc.
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    is_recurring BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (tutor_id) REFERENCES users(user_id) ON DELETE CASCADE
);