-- Seed payment data for one-time courses

-- User 1 payments for one-time courses
INSERT INTO payments (course_id, user_id, amount, payment_date)
VALUES (1, 1, 1500.00, '2023-01-15 10:30:00');

INSERT INTO payments (course_id, user_id, amount, payment_date)
VALUES (2, 1, 1300.00, '2023-01-25 11:20:00');

INSERT INTO payments (course_id, user_id, amount, payment_date)
VALUES (3, 1, 1400.00, '2023-02-05 10:15:00');

-- User 2 payments for one-time courses
INSERT INTO payments (course_id, user_id, amount, payment_date)
VALUES (1, 2, 1500.00, '2023-02-10 13:30:00');

INSERT INTO payments (course_id, user_id, amount, payment_date)
VALUES (2, 2, 1300.00, '2023-02-20 14:45:00');

INSERT INTO payments (course_id, user_id, amount, payment_date)
VALUES (3, 2, 1400.00, '2023-02-28 16:10:00');

-- User 3 payments for one-time courses
INSERT INTO payments (course_id, user_id, amount, payment_date)
VALUES (1, 3, 1500.00, '2023-03-01 09:00:00');

INSERT INTO payments (course_id, user_id, amount, payment_date)
VALUES (2, 3, 1300.00, '2023-03-03 11:20:00');

INSERT INTO payments (course_id, user_id, amount, payment_date)
VALUES (3, 3, 1400.00, '2023-03-05 09:15:00');


-- Seed payment data for recurring courses

-- User 1 recurring course payments
-- Course 6 (Monthly subscription)
INSERT INTO payments (course_id, sub_period_id, user_id, amount, payment_date)
VALUES (6, 1, 1, 2000.00, '2024-12-28 10:30:00'); -- January 2025 period
INSERT INTO payments (course_id, sub_period_id, user_id, amount, payment_date)
VALUES (6, 2, 1, 2000.00, '2025-01-28 10:30:00'); -- February 2025 period

-- Course 7 (Monthly subscription)  
INSERT INTO payments (course_id, sub_period_id, user_id, amount, payment_date)
VALUES (7, 13, 1, 2500.00, '2024-12-27 09:30:00'); -- January 2025 period
INSERT INTO payments (course_id, sub_period_id, user_id, amount, payment_date)
VALUES (7, 14, 1, 2500.00, '2025-01-29 15:45:00'); -- February 2025 period

-- Course 9 (Weekly subscription)
INSERT INTO payments (course_id, sub_period_id, user_id, amount, payment_date)
VALUES (9, 31, 1, 1000.00, '2024-12-29 14:30:00'); -- First week of January 2025
INSERT INTO payments (course_id, sub_period_id, user_id, amount, payment_date)
VALUES (9, 32, 1, 1000.00, '2025-01-05 13:40:00'); -- Second week of January 2025

-- User 2 recurring course payments
-- Course 6 (Monthly subscription)
INSERT INTO payments (course_id, sub_period_id, user_id, amount, payment_date)
VALUES (6, 1, 2, 2000.00, '2024-12-27 11:45:00'); -- January 2025 period
INSERT INTO payments (course_id, sub_period_id, user_id, amount, payment_date)
VALUES (6, 2, 2, 2000.00, '2025-01-27 14:20:00'); -- February 2025 period

-- Course 7 (Monthly subscription)
INSERT INTO payments (course_id, sub_period_id, user_id, amount, payment_date)
VALUES (7, 13, 2, 2500.00, '2024-12-29 14:45:00'); -- January 2025 period
INSERT INTO payments (course_id, sub_period_id, user_id, amount, payment_date)
VALUES (7, 14, 2, 2500.00, '2025-01-30 16:10:00'); -- February 2025 period

-- Course 9 (Weekly subscription)
INSERT INTO payments (course_id, sub_period_id, user_id, amount, payment_date)
VALUES (9, 31, 2, 1000.00, '2024-12-28 10:45:00'); -- First week of January 2025
INSERT INTO payments (course_id, sub_period_id, user_id, amount, payment_date)
VALUES (9, 32, 2, 1000.00, '2025-01-05 09:30:00'); -- Second week of January 2025

-- User 3 recurring course payments
-- Course 6 (Monthly subscription)
INSERT INTO payments (course_id, sub_period_id, user_id, amount, payment_date)
VALUES (6, 1, 3, 2000.00, '2024-12-26 09:15:00'); -- January 2025 period
INSERT INTO payments (course_id, sub_period_id, user_id, amount, payment_date)
VALUES (6, 2, 3, 2000.00, '2025-01-26 16:45:00'); -- February 2025 period

-- Course 7 (Monthly subscription)
INSERT INTO payments (course_id, sub_period_id, user_id, amount, payment_date)
VALUES (7, 13, 3, 2500.00, '2024-12-28 11:15:00'); -- January 2025 period
INSERT INTO payments (course_id, sub_period_id, user_id, amount, payment_date)
VALUES (7, 14, 3, 2500.00, '2025-01-28 10:20:00'); -- February 2025 period

-- Course 9 (Weekly subscription)
INSERT INTO payments (course_id, sub_period_id, user_id, amount, payment_date)
VALUES (9, 31, 3, 1000.00, '2024-12-30 09:15:00'); -- First week of January 2025
INSERT INTO payments (course_id, sub_period_id, user_id, amount, payment_date)
VALUES (9, 32, 3, 1000.00, '2025-01-06 11:20:00'); -- Second week of January 2025
