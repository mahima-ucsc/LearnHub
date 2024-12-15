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
    thumbnail VARCHAR(255) NOT NULL,
    subject_id BIGINT(20) UNSIGNED NOT NULL,
    grade_id BIGINT(20) UNSIGNED NOT NULL,
    tutor_id BIGINT(20) UNSIGNED NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    day VARCHAR(20) NOT NULL,
    price decimal(10,2) NOT NULL,
    pricing_period VARCHAR(50) NOT NULL,
    location VARCHAR(50) NOT NULL,
    PRIMARY KEY(course_id),
    FOREIGN KEY (subject_id) REFERENCES subjects(subject_id) ON DELETE CASCADE,
    FOREIGN KEY (grade_id) REFERENCES grades(grade_id) ON DELETE CASCADE,
    FOREIGN KEY (tutor_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- Course modules for each course
CREATE TABLE IF NOT EXISTS course_modules (
    module_id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    description TEXT,
    course_id BIGINT(20) UNSIGNED NOT NULL,
    PRIMARY KEY(module_id),
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE
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
