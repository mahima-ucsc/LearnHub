-- Since sinhala unicode is not properly set in the DB you might get invalid data or similar type of error. 
-- You can MANUALLY ADD course details which are in SINHALA through create course page to AVOID THAT ERROR

INSERT INTO courses (title, description, thumbnail, subject_id, grade_id, tutor_id, start_time, end_time, day, price, pricing_period, location) 
VALUES
-- Course 1
('සිංහල', 
 'Comprehensive mathematics class designed for Grade 10 students preparing for the G.C.E. O/L examination. Covers algebra, geometry, trigonometry, and statistics, with step-by-step guidance on solving past papers and model questions. Highly interactive sessions with detailed explanations for each topic.', 
 'math_thumbnail.jpg', 
 1, 10, 1, '08:00:00', '10:00:00', 'Saturday', 1500.00, 'Per Month', 'Colombo'),

-- Course 2
('English Grade 9', 
 'Improve your English language skills with a focus on grammar, vocabulary, reading comprehension, and creative writing. Special sessions are included for public speaking and group discussions to enhance fluency and confidence. Designed to help students excel in school exams and build a strong foundation for future studies.', 
 'english_thumbnail.jpg', 
 2, 9, 5, '10:00:00', '12:00:00', 'Sunday', 1200.00, 'Per Month', 'Kandy'),

-- Course 3
('විද්‍යාව - 11 ශ්‍රේණිය', 
 'O/L විභාග සදහා සම්පූර්ණ විද්‍යාව පාඩම්. සියලුම ඒකකයන් සවිස්තරාත්මකව කෙරෙන අතර, ජීව විද්‍යාව, රසායන විද්‍යාව සහ භෞතික විද්‍යාව යන මූලික කොටස් ආවරණය වේ. පසුගිය විභාග ප්‍රශ්න පත්‍ර විශ්ලේෂණය, මොඩල් ප්‍රශ්න සාකච්ඡා සහ ව්‍යාපෘති පෝර්ටුමා සෑදීම සඳහා ප්‍රායෝගික ක්‍රියාකාරකම් සපයනු ලැබේ.', 
 'science_thumbnail.jpg', 
 3, 11, 5, '14:00:00', '16:00:00', 'Saturday', 1300.00, 'Per Month', 'Galle'),

-- Course 4
('Sinhala Literature - Grade 12', 
 'Deep dive into Sinhala literature with a focus on prose, poetry, and drama. Special emphasis on analyzing key literary works and crafting essays that align with examination standards. Develop critical thinking and analytical skills through in-depth discussions on major themes, character development, and narrative techniques.', 
 'sinhala_thumbnail.jpg', 
 4, 12, 1, '16:30:00', '18:30:00', 'Friday', 1600.00, 'Per Month', 'Jaffna'),

-- Course 5
('භූගෝල විද්‍යාව - 10 ශ්‍රේණිය', 
 'මෙම පන්ති මාලාව O/L භූගෝල විද්‍යාව විෂයට විශේෂිත වේ. ජාත්‍යන්තර සහ කලාපීය භූගෝල විද්‍යාත්මක ක්‍රියාවලි, ආකාර සහ ගෝලීය කාලගුණික ව්‍යුහයන් පිළිබඳව පැහැදිළි කරයි. විෂය නිර්දේශය පදනම්ව ගණනය කිරීමේ කුසලතා සහ සිතියම් අරවුල් අභ්‍යාසයන් හොඳින් පිළියෙළ කර ඇත.', 
 'geo_thumbnail.jpg', 
 5, 10, 1, '08:30:00', '10:30:00', 'Sunday', 1400.00, 'Per Month', 'Kurunegala'),

-- Course 6
('Biology for Grade 12', 
 'Advanced Level biology class tailored for students preparing for A/L exams. This course covers cellular biology, genetics, plant physiology, human anatomy, and ecology. Includes live practical demonstrations, detailed notes, and weekly quizzes to ensure mastery of every topic.', 
 'bio_thumbnail.jpg', 
 6, 12, 5, '11:00:00', '13:00:00', 'Saturday', 1700.00, 'Per Month', 'Colombo'),

-- Course 7
('ඉතිහාසය - 9 ශ්‍රේණිය', 
 'ලංකාවේ ඉතිහාසය පිළිබඳ පරිපුර්ණව සකස් කරන ලද පන්ති. මහා රාජධානී යුගය, ඓතිහාසික සිදුවීම් සහ මෑත කාලීන ඉතිහාසය විග්‍රහය යන අංග සවිස්තරාත්මකව විස්තර කරයි. විශේෂ පාඩම් සැසිවලදී සිසුන්ගේ විභාග ලකුණු වැඩි කිරීමට මඟ පෙන්වයි.', 
 'history_thumbnail.jpg', 
 7, 9, 1, '15:00:00', '17:00:00', 'Sunday', 1250.00, 'Per Month', 'Matara'),

-- Course 8
('Physics Grade 11', 
 'Physics course specially designed for O/L students. Covers fundamental topics such as mechanics, thermodynamics, waves, and electricity. Includes theoretical explanations and practical problem-solving sessions to ensure students have a thorough understanding of concepts.', 
 'physics_thumbnail.jpg', 
 8, 11, 5, '09:00:00', '11:00:00', 'Saturday', 1800.00, 'Per Month', 'Anuradhapura'),

-- Course 9
('Chemistry - A/L', 
 'A/L Chemistry class with an intensive focus on organic, inorganic, and physical chemistry. Practical sessions are included to help students understand experimental techniques and analyze results. Covers complex problem-solving strategies for examination success.', 
 'chemistry_thumbnail.jpg', 
 9, 13, 1, '13:30:00', '15:30:00', 'Saturday', 2000.00, 'Per Month', 'Negombo'),

-- Course 10
('පාලනය සහ ගිණුම්කරණය', 
 'A/L ව්‍යාපාර අධ්‍යයනය විෂයට විශේෂිත පන්ති මාලාව. සිසුන්ට පාලන මූලධර්ම, ගිණුම් සංකල්ප, සහ ව්‍යාපාර ව්‍යුහයන් පිළිබඳ වගවීමක් ලබාදීමට නිර්මාණය කරන ලදී. විභාග ප්‍රශ්න සාකච්ඡා සහ ආදර්ශ ප්‍රශ්න පත්‍ර සාකච්ඡා සැම පැවැත් වේ.', 
 'acc_thumbnail.jpg', 
 10, 13, 5, '16:00:00', '18:00:00', 'Sunday', 1900.00, 'Per Month', 'Ratnapura');
