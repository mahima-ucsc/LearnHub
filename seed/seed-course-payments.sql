-- Seed payment data for one-time courses

-- User 1 payments for one-time courses
INSERT INTO payments (payment_id, amount, order_id, payment_status, created_date, updated_date)
VALUES (1, 1500.00, 'cid_1_20230115103000', 2, '2023-01-15 10:30:00', '2023-01-15 10:30:00');
INSERT INTO course_payments (user_id, payment_id, course_id, sub_period_id)
VALUES (1, 1, 1, NULL);

INSERT INTO payments (payment_id, amount, order_id, payment_status, created_date, updated_date)
VALUES (2, 1300.00, 'cid_2_20230125112000', 2, '2023-01-25 11:20:00', '2023-01-25 11:20:00');
INSERT INTO course_payments (user_id, payment_id, course_id, sub_period_id)
VALUES (1, 2, 2, NULL);

INSERT INTO payments (payment_id, amount, order_id, payment_status, created_date, updated_date)
VALUES (3, 1400.00, 'cid_3_20230205101500', 2, '2023-02-05 10:15:00', '2023-02-05 10:15:00');
INSERT INTO course_payments (user_id, payment_id, course_id, sub_period_id)
VALUES (1, 3, 3, NULL);

-- User 2 payments for one-time courses
INSERT INTO payments (payment_id, amount, order_id, payment_status, created_date, updated_date)
VALUES (4, 1500.00, 'cid_1_20230210133000', 2, '2023-02-10 13:30:00', '2023-02-10 13:30:00');
INSERT INTO course_payments (user_id, payment_id, course_id, sub_period_id)
VALUES (2, 4, 1, NULL);

INSERT INTO payments (payment_id, amount, order_id, payment_status, created_date, updated_date)
VALUES (5, 1300.00, 'cid_2_20230220144500', 2, '2023-02-20 14:45:00', '2023-02-20 14:45:00');
INSERT INTO course_payments (user_id, payment_id, course_id, sub_period_id)
VALUES (2, 5, 2, NULL);

INSERT INTO payments (payment_id, amount, order_id, payment_status, created_date, updated_date)
VALUES (6, 1400.00, 'cid_3_20230228161000', 2, '2023-02-28 16:10:00', '2023-02-28 16:10:00');
INSERT INTO course_payments (user_id, payment_id, course_id, sub_period_id)
VALUES (2, 6, 3, NULL);

-- User 3 payments for one-time courses
INSERT INTO payments (payment_id, amount, order_id, payment_status, created_date, updated_date)
VALUES (7, 1500.00, 'cid_1_20230301090000', 2, '2023-03-01 09:00:00', '2023-03-01 09:00:00');
INSERT INTO course_payments (user_id, payment_id, course_id, sub_period_id)
VALUES (3, 7, 1, NULL);

INSERT INTO payments (payment_id, amount, order_id, payment_status, created_date, updated_date)
VALUES (8, 1300.00, 'cid_2_20230303112000', 2, '2023-03-03 11:20:00', '2023-03-03 11:20:00');
INSERT INTO course_payments (user_id, payment_id, course_id, sub_period_id)
VALUES (3, 8, 2, NULL);

INSERT INTO payments (payment_id, amount, order_id, payment_status, created_date, updated_date)
VALUES (9, 1400.00, 'cid_3_20230305091500', 2, '2023-03-05 09:15:00', '2023-03-05 09:15:00');
INSERT INTO course_payments (user_id, payment_id, course_id, sub_period_id)
VALUES (3, 9, 3, NULL);

-- Seed payment data for recurring courses

-- User 1 recurring course payments
INSERT INTO payments (payment_id, amount, order_id, payment_status, created_date, updated_date)
VALUES (10, 2000.00, 'cid_6_spid_1_20241228103000', 2, '2024-12-28 10:30:00', '2024-12-28 10:30:00');
INSERT INTO course_payments (user_id, payment_id, course_id, sub_period_id)
VALUES (1, 10, 6, 1);

INSERT INTO payments (payment_id, amount, order_id, payment_status, created_date, updated_date)
VALUES (11, 2000.00, 'cid_6_spid_2_20250128103000', 2, '2025-01-28 10:30:00', '2025-01-28 10:30:00');
INSERT INTO course_payments (user_id, payment_id, course_id, sub_period_id)
VALUES (1, 11, 6, 2);

-- User 2 recurring course payments
-- Course 6 (Monthly subscription)
INSERT INTO payments (payment_id, amount, order_id, payment_status, created_date, updated_date)
VALUES (12, 2000.00, 'cid_6_spid_1_20241227114500', 2, '2024-12-27 11:45:00', '2024-12-27 11:45:00');
INSERT INTO course_payments (user_id, payment_id, course_id, sub_period_id)
VALUES (2, 12, 6, 1);

INSERT INTO payments (payment_id, amount, order_id, payment_status, created_date, updated_date)
VALUES (13, 2000.00, 'cid_6_spid_2_20250127142000', 2, '2025-01-27 14:20:00', '2025-01-27 14:20:00');
INSERT INTO course_payments (user_id, payment_id, course_id, sub_period_id)
VALUES (2, 13, 6, 0);

-- Course 7 (Monthly subscription)
INSERT INTO payments (payment_id, amount, order_id, payment_status, created_date, updated_date)
VALUES (14, 2500.00, 'cid_7_spid_13_20241229144500', 2, '2024-12-29 14:45:00', '2024-12-29 14:45:00');
INSERT INTO course_payments (user_id, payment_id, course_id, sub_period_id)
VALUES (2, 14, 7, 13);

INSERT INTO payments (payment_id, amount, order_id, payment_status, created_date, updated_date)
VALUES (15, 2500.00, 'cid_7_spid_14_20250130161000', 2, '2025-01-30 16:10:00', '2025-01-30 16:10:00');
INSERT INTO course_payments (user_id, payment_id, course_id, sub_period_id)
VALUES (2, 15, 7, 14);

-- Course 9 (Weekly subscription)
INSERT INTO payments (payment_id, amount, order_id, payment_status, created_date, updated_date)
VALUES (16, 1000.00, 'cid_9_spid_31_20241228104500', 2, '2024-12-28 10:45:00', '2024-12-28 10:45:00');
INSERT INTO course_payments (user_id, payment_id, course_id, sub_period_id)
VALUES (2, 16, 9, 31);

INSERT INTO payments (payment_id, amount, order_id, payment_status, created_date, updated_date)
VALUES (17, 1000.00, 'cid_9_spid_32_20250105093000', 2, '2025-01-05 09:30:00', '2025-01-05 09:30:00');
INSERT INTO course_payments (user_id, payment_id, course_id, sub_period_id)
VALUES (2, 17, 9, 32);

-- User 3 recurring course payments
-- Course 6 (Monthly subscription)
INSERT INTO payments (payment_id, amount, order_id, payment_status, created_date, updated_date)
VALUES (18, 2000.00, 'cid_6_spid_1_20241226091500', 2, '2024-12-26 09:15:00', '2024-12-26 09:15:00');
INSERT INTO course_payments (user_id, payment_id, course_id, sub_period_id)
VALUES (3, 18, 6, 1);

INSERT INTO payments (payment_id, amount, order_id, payment_status, created_date, updated_date)
VALUES (19, 2000.00, 'cid_6_spid_2_20250126164500', 2, '2025-01-26 16:45:00', '2025-01-26 16:45:00');
INSERT INTO course_payments (user_id, payment_id, course_id, sub_period_id)
VALUES (3, 19, 6, 2);

-- Course 7 (Monthly subscription)
INSERT INTO payments (payment_id, amount, order_id, payment_status, created_date, updated_date)
VALUES (20, 2500.00, 'cid_7_spid_13_20241228111500', 2, '2024-12-28 11:15:00', '2024-12-28 11:15:00');
INSERT INTO course_payments (user_id, payment_id, course_id, sub_period_id)
VALUES (3, 20, 7, 13);

INSERT INTO payments (payment_id, amount, order_id, payment_status, created_date, updated_date)
VALUES (21, 2500.00, 'cid_7_spid_14_20250128102000', 2, '2025-01-28 10:20:00', '2025-01-28 10:20:00');
INSERT INTO course_payments (user_id, payment_id, course_id, sub_period_id)
VALUES (3, 21, 7, 14);
