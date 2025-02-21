CREATE TABLE IF NOT EXISTS users (
    user_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone_no VARCHAR(15),
    date_of_birth DATE NOT NULL,
    description VARCHAR(255),
    joined_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    last_login DATETIME,
    profile_picture_url TEXT,
    location VARCHAR(255),
    password VARCHAR(255) NOT NULL,
    user_role ENUM('student', 'teacher', 'admin', 'guest') NOT NULL,
    PRIMARY KEY(user_id),
    UNIQUE KEY(email)
);

-- Table for grades
CREATE TABLE IF NOT EXISTS grades (
    grade_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    grade_name VARCHAR(255) NOT NULL,
    PRIMARY KEY(grade_id)
);

-- Insert grades
INSERT INTO `grades` (`grade_id`, `grade_name`) VALUES
(1, 'Grade 1'),
(2, 'Grade 2'),
(3, 'Grade 3'),
(4, 'Grade 4'),
(5, 'Grade 5'),
(6, 'Grade 6'),
(7, 'Grade 7'),
(8, 'Grade 8'),
(9, 'Grade 9'),
(10, 'Grade 10'),
(11, 'Grade 11'),
(12, 'Grade 12'),
(13, 'Grade 13');


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
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE
);

-- Table for payments related to subscription periods
CREATE TABLE IF NOT EXISTS sub_period_payments (
    payment_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    sub_period_id BIGINT(20) UNSIGNED NOT NULL,
    user_id BIGINT(20) UNSIGNED NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    payment_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    FOREIGN KEY (sub_period_id) REFERENCES recurring_course_sub_periods(sub_period_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Table for one-time course payments
CREATE TABLE IF NOT EXISTS onetime_course_payments (
    payment_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    course_id BIGINT(20) UNSIGNED NOT NULL,
    user_id BIGINT(20) UNSIGNED NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    payment_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Course modules for each course
CREATE TABLE IF NOT EXISTS course_modules (
    module_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    description TEXT,
    course_id BIGINT(20) UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    
    PRIMARY KEY(module_id),
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE
);

-- Resources for each Course module
CREATE TABLE IF NOT EXISTS course_module_resource (
    resource_id INT AUTO_INCREMENT,
    module_id BIGINT(20) UNSIGNED NOT NULL,
    course_id BIGINT(20) UNSIGNED NOT NULL,
    resource_path VARCHAR(255),
    
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
    created_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
    user_id BIGINT(20) UNSIGNED NOT NULL,
    PRIMARY KEY(request_id),
    FOREIGN KEY (subject_id) REFERENCES subjects(subject_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

ALTER TABLE course_requests
ADD COLUMN status ENUM('pending', 'approved') NOT NULL DEFAULT 'pending';

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


CREATE TABLE IF NOT EXISTS assignments_submissions(
    submission_id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    assignment_id BIGINT(20) UNSIGNED NOT NULL,
    course_id BIGINT(20) UNSIGNED NOT NULL,
    submission_path VARCHAR(255),
    upload_date DATE DEFAULT CURRENT_DATE,
    student_id BIGINT(20) UNSIGNED NoT NULL,

    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE,
    FOREIGN KEY (student_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (assignment_id) REFERENCES assignments(assignment_id) ON DELETE CASCADE
);

CREATE TABLE contact_tickets (
    `id` INT(11) NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(50) NOT NULL , 
    `email` VARCHAR(50) NOT NULL , 
    `message` TEXT NOT NULL , 
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    PRIMARY KEY (`id`)
);
