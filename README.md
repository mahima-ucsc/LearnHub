### Site Map

---

#### 1. **Main Pages**

- `/` - Home (requires authentication)
- `/contact` - Contact
- `/about` - About
- `/profile` - Profile
- `/dashboard` - Dashboard
- `/admin-dashboard` - Admin Dashboard
  - `/admin-dashboard/user-managment` - User Management
  - `/admin-dashboard/course-managment` - Course Management
- `/settings` - Settings
- `/tutor` - Tutor Profile
- `/alert` - Alert
- `/error` - Error
- `/unauthorized-access` - Unauthorized Access
- `/help-and-support` - Help and Support
- `/denied` - Access Denied

---

#### 2. **User Authentication & Registration**

- `/choose-role` - Choose Role (Guest only)
- `/register/create-account` - Register Account (Guest only)
- `/register` - Register Role Selection (Guest only)
- `/interest` - Interest Selection (requires authentication)
  - `/interest/skip` - Skip Interest Selection (requires authentication)
  - `/interest/continue` - Continue Interest Selection (requires authentication)
- `/login` - Login Page (Guest only)
- `/logout` - Logout
- `/billing-and-payment` - Billing and Payment
- `/mycourses` - My Courses

---

#### 3. **Advertisements**

- `/create-ad` - Create Advertisement

---

#### 4. **Courses**

- `/courses` - List of Courses
- `/manage-course/edit/{course}` - Edit Course
- `/manage-course/delete/{course}` - Delete Course
- `/courses/my-courses/{course_id}` - My Course Details
  - `/courses/my-courses/{course_id}/participant` - Course Participants
  - `/courses/my-courses/{course_id}/participant/stats/{participant_id}` - Participant Stats
- `/course/enroll` - Enroll in a Course
- `/course/create` - Create Course View
- `/create-course` - Create Course (POST)
- `/courses/my-courses` - My Courses List
- `/courses/demo` - Demo Courses
- `/courses/my/registered` - Registered Courses
- `/courses/user` - User’s Courses

---

#### 5. **Course Requests**

- `/course/request` - Course Requests
- `/course/request/create` - Create Course Request View
- `/course/request/edit/{id}` - Edit Course Request
- `/course/request/{id}` - Course Request Details
- `/course/request/create` - Create Course Request (POST)
- `/course/request/{id}/comments/create` - Create Comment on Course Request (POST)
- `/course/request/{id}` - Update Course Request (PUT)
- `/course/request/{id}` - Delete Course Request (DELETE)

---

#### 6. **Resources**

- `/resource` - List of Resources

---

#### 7. **Reviews**

- `/add-review` - Add Review (POST)
- `/review/edit/{review}` - Edit Review View
- `/review/edit/{review}` - Edit Review (POST)
- `/review/delete/{review}` - Delete Review (DELETE)

---

#### 8. **Assignments**

- `/course/{courseId}/assignment/create` - Create Assignment

---

#### 9. **Error Handling**

- `/{any:.*}` - Catch-all route for 404 page
