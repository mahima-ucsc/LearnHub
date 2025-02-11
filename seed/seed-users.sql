-- password abc123
INSERT INTO `users` 
( `first_name`, `last_name`, `email`,  `date_of_birth`, `joined_date`, `password`, `user_role`) 
VALUES 
-- students --
('Mahima', 'de Silva', 'mahima@mail.com', '2002-08-18', NOW(), '$2y$10$YnHCYd20zigSmfBJ2395UurP5X6Ep1vpDhOPM/B3OloMK53syjRDK', 'student') ,
('Ravindu', 'Manupasan', 'ravindu@mail.com', '2001-05-12', NOW(), '$2y$10$YnHCYd20zigSmfBJ2395UurP5X6Ep1vpDhOPM/B3OloMK53syjRDK', 'student'),
('Sachith', 'Abeyrathna', 'sachith@mail.com', '2000-11-23', NOW(), '$2y$10$YnHCYd20zigSmfBJ2395UurP5X6Ep1vpDhOPM/B3OloMK53syjRDK', 'student'),
('Dinuka', 'Sahan', 'dinuka@mail.com', '1999-07-30', NOW(), '$2y$10$YnHCYd20zigSmfBJ2395UurP5X6Ep1vpDhOPM/B3OloMK53syjRDK', 'student'),
-- teachers --
('Ajantha', 'Perera', 'ajantha@mail.com', '1980-03-15', NOW(), '$2y$10$YnHCYd20zigSmfBJ2395UurP5X6Ep1vpDhOPM/B3OloMK53syjRDK', 'teacher'),
('Chamath', 'Fernando', 'chamath@mail.com', '1975-06-22', NOW(), '$2y$10$YnHCYd20zigSmfBJ2395UurP5X6Ep1vpDhOPM/B3OloMK53syjRDK', 'teacher'),
('Malik', 'Silva', 'malik@mail.com', '1982-09-10', NOW(), '$2y$10$YnHCYd20zigSmfBJ2395UurP5X6Ep1vpDhOPM/B3OloMK53syjRDK', 'teacher'),
('Ranil', 'Jayawardhane', 'ranil@mail.com', '1978-12-05', NOW(), '$2y$10$YnHCYd20zigSmfBJ2395UurP5X6Ep1vpDhOPM/B3OloMK53syjRDK', 'teacher');
