-- password abc123
<<<<<<< HEAD
INSERT INTO users 
(user_id, first_name, last_name, email, date_of_birth, joined_date, password, user_role) 
VALUES 
-- students --
(1, 'Mahima', 'de Silva', 'mahima@mail.com', '2002-08-18', NOW(), '$2y$10$YnHCYd20zigSmfBJ2395UurP5X6Ep1vpDhOPM/B3OloMK53syjRDK', 'student') ,
(2, 'Ravindu', 'Manupasan', 'ravindu@mail.com', '2001-05-12', NOW(), '$2y$10$YnHCYd20zigSmfBJ2395UurP5X6Ep1vpDhOPM/B3OloMK53syjRDK', 'student'),
(3, 'Sachith', 'Abeyrathna', 'sachith@mail.com', '2000-11-23', NOW(), '$2y$10$YnHCYd20zigSmfBJ2395UurP5X6Ep1vpDhOPM/B3OloMK53syjRDK', 'student'),
(4, 'Dinuka', 'Sahan', 'dinuka@mail.com', '1999-07-30', NOW(), '$2y$10$YnHCYd20zigSmfBJ2395UurP5X6Ep1vpDhOPM/B3OloMK53syjRDK', 'student'),
-- teachers --
(5, 'Ajantha', 'Perera', 'ajantha@mail.com', '1980-03-15', NOW(), '$2y$10$YnHCYd20zigSmfBJ2395UurP5X6Ep1vpDhOPM/B3OloMK53syjRDK', 'teacher'),
(6, 'Chamath', 'Fernando', 'chamath@mail.com', '1975-06-22', NOW(), '$2y$10$YnHCYd20zigSmfBJ2395UurP5X6Ep1vpDhOPM/B3OloMK53syjRDK', 'teacher'),
(7, 'Malik', 'Silva', 'malik@mail.com', '1982-09-10', NOW(), '$2y$10$YnHCYd20zigSmfBJ2395UurP5X6Ep1vpDhOPM/B3OloMK53syjRDK', 'teacher'),
(8, 'Ranil', 'Jayawardhane', 'ranil@mail.com', '1978-12-05', NOW(), '$2y$10$YnHCYd20zigSmfBJ2395UurP5X6Ep1vpDhOPM/B3OloMK53syjRDK', 'teacher');
=======
INSERT INTO `users` 
( `first_name`, `last_name`, `email`,  `date_of_birth`, `joined_date`, `password`, `user_role`,`is_verified`) 
VALUES 
-- students --
('Mahima', 'de Silva', 'mahima@mail.com', '2002-08-18', NOW(), '$2y$10$YnHCYd20zigSmfBJ2395UurP5X6Ep1vpDhOPM/B3OloMK53syjRDK', 'student',1) ,
('Ravindu', 'Manupasan', 'ravindu@mail.com', '2001-05-12', NOW(), '$2y$10$YnHCYd20zigSmfBJ2395UurP5X6Ep1vpDhOPM/B3OloMK53syjRDK', 'student',1),
('Sachith', 'Abeyrathna', 'sachith@mail.com', '2000-11-23', NOW(), '$2y$10$YnHCYd20zigSmfBJ2395UurP5X6Ep1vpDhOPM/B3OloMK53syjRDK', 'student',1),
('Dinuka', 'Sahan', 'dinuka@mail.com', '1999-07-30', NOW(), '$2y$10$YnHCYd20zigSmfBJ2395UurP5X6Ep1vpDhOPM/B3OloMK53syjRDK', 'student',1);
-- teachers --
('Ajantha', 'Perera', 'ajantha@mail.com', '1980-03-15', NOW(), '$2y$10$YnHCYd20zigSmfBJ2395UurP5X6Ep1vpDhOPM/B3OloMK53syjRDK', 'teacher',1),
('Chamath', 'Fernando', 'chamath@mail.com', '1975-06-22', NOW(), '$2y$10$YnHCYd20zigSmfBJ2395UurP5X6Ep1vpDhOPM/B3OloMK53syjRDK', 'teacher',1),
('Malik', 'Silva', 'malik@mail.com', '1982-09-10', NOW(), '$2y$10$YnHCYd20zigSmfBJ2395UurP5X6Ep1vpDhOPM/B3OloMK53syjRDK', 'teacher',1),
('Ranil', 'Jayawardhane', 'ranil@mail.com', '1978-12-05', NOW(), '$2y$10$YnHCYd20zigSmfBJ2395UurP5X6Ep1vpDhOPM/B3OloMK53syjRDK', 'teacher',1);
>>>>>>> f9b315d6c5d749df39d267bda38527201c2cbcae
