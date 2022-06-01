-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Wersja serwera:               8.0.27 - MySQL Community Server - GPL
-- Serwer OS:                    Win64
-- HeidiSQL Wersja:              11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Zrzut struktury bazy danych tab_vaccinations
DROP DATABASE IF EXISTS `tab_vaccinations`;
CREATE DATABASE IF NOT EXISTS `tab_vaccinations` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `tab_vaccinations`;

-- Zrzut struktury tabela tab_vaccinations.logs
DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `patient_pesel` bigint DEFAULT NULL,
  `ip` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `url_path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `action_time` datetime NOT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  PRIMARY KEY (`id`),
  KEY `fk_logs_users` (`user_id`),
  KEY `fk_logs_patients` (`patient_pesel`),
  CONSTRAINT `fk_logs_patients` FOREIGN KEY (`patient_pesel`) REFERENCES `patients` (`pesel`),
  CONSTRAINT `fk_logs_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Zrzucanie danych dla tabeli tab_vaccinations.logs: ~13 rows (około)
DELETE FROM `logs`;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` (`id`, `user_id`, `patient_pesel`, `ip`, `url_path`, `action_time`, `data`) VALUES
	(1, 1, NULL, '127.0.0.1', '/tab_szczepienia/public/index.php/admin/users', '2022-05-25 18:14:02', '[]'),
	(2, 1, NULL, '127.0.0.1', '/tab_szczepienia/public/index.php/admin/users', '2022-05-25 18:16:02', '[]'),
	(3, NULL, 12345678902, '::1', '/tab_szczepienia/public/index.php/patients/index', '2022-05-25 18:30:21', '[]'),
	(4, NULL, 12345678902, '::1', '/tab_szczepienia/public/index.php/patients/vaccinations', '2022-05-25 18:30:23', '[]'),
	(5, 1, 12345678902, '::1', '/tab_szczepienia/public/index.php/admin/users', '2022-05-25 18:31:06', '[]'),
	(6, 1, 12345678902, '::1', '/tab_szczepienia/public/index.php/admin/timetables/index', '2022-05-25 18:31:07', '[]'),
	(7, 1, 12345678902, '::1', '/tab_szczepienia/public/index.php/admin/timetables/add', '2022-05-25 18:31:16', '[]'),
	(8, 1, 12345678902, '::1', '/tab_szczepienia/public/index.php/admin/timetables/index', '2022-05-25 18:32:01', '[]'),
	(9, 1, 12345678902, '::1', '/tab_szczepienia/public/index.php/admin/users/index', '2022-05-25 18:34:43', '[]'),
	(10, 1, 12345678902, '::1', '/tab_szczepienia/public/index.php/admin/warehouse/index', '2022-05-25 18:34:50', '[]'),
	(11, 1, 12345678902, '::1', '/tab_szczepienia/public/index.php/admin/timetables/index', '2022-05-25 18:35:18', '[]'),
	(12, 1, 12345678902, '::1', '/tab_szczepienia/public/index.php/admin/patients/index', '2022-05-25 18:35:20', '[]'),
	(13, 1, 12345678902, '::1', '/tab_szczepienia/public/index.php/admin/timetables/index', '2022-05-25 18:36:40', '[]'),
	(14, 1, NULL, '127.0.0.1', '/tab_szczepienia/public/index.php/admin/users', '2022-06-01 18:51:16', '[]'),
	(15, 1, NULL, '127.0.0.1', '/tab_szczepienia/public/index.php/admin/warehouse/index', '2022-06-01 18:51:18', '[]'),
	(16, 1, NULL, '127.0.0.1', '/tab_szczepienia/public/index.php/admin/timetables/index', '2022-06-01 18:51:20', '[]'),
	(17, 1, NULL, '127.0.0.1', '/tab_szczepienia/public/index.php/admin/timetables/add', '2022-06-01 18:51:26', '[]'),
	(18, 1, NULL, '127.0.0.1', '/tab_szczepienia/public/index.php/admin/timetables/add', '2022-06-01 18:51:46', '{"post":{"user_id":"1","date":"2022-04-15","time":"12:11","period":"3","amount":"3"}}'),
	(19, 1, NULL, '127.0.0.1', '/tab_szczepienia/public/index.php/admin/timetables/add', '2022-06-01 18:52:10', '{"post":{"user_id":"1","date":"2022-04-15","time":"12:11","period":"3","amount":"3"}}'),
	(20, 1, NULL, '127.0.0.1', '/tab_szczepienia/public/index.php/admin/timetables/add', '2022-06-01 18:52:55', '[]'),
	(21, 1, NULL, '127.0.0.1', '/tab_szczepienia/public/index.php/admin/timetables/add', '2022-06-01 18:53:13', '{"post":{"user_id":"1","date":"2022-04-15","time":"12:12","period":"3","amount":"4"}}'),
	(22, 1, NULL, '127.0.0.1', '/tab_szczepienia/public/index.php/admin/timetables/add', '2022-06-01 18:53:41', '{"post":{"user_id":"1","date":"2022-04-15","time":"12:12","period":"3","amount":"4"}}'),
	(23, 1, NULL, '127.0.0.1', '/tab_szczepienia/public/index.php/admin/timetables/index', '2022-06-01 18:53:41', '[]'),
	(24, 1, NULL, '127.0.0.1', '/tab_szczepienia/public/index.php/admin/timetables/add', '2022-06-01 18:54:00', '[]'),
	(25, 1, NULL, '127.0.0.1', '/tab_szczepienia/public/index.php/admin/timetables/index', '2022-06-01 18:54:23', '[]'),
	(26, 1, NULL, '127.0.0.1', '/tab_szczepienia/public/index.php/admin/timetables/add', '2022-06-01 18:54:36', '{"post":{"user_id":"1","date":"2022-04-15","time":"12:12","period":"4","amount":"4"}}'),
	(27, 1, NULL, '127.0.0.1', '/tab_szczepienia/public/index.php/admin/timetables/add', '2022-06-01 18:54:38', '{"post":{"user_id":"1","date":"2022-04-15","time":"12:12","period":"4","amount":"4"}}'),
	(28, 1, NULL, '127.0.0.1', '/tab_szczepienia/public/index.php/admin/timetables/add', '2022-06-01 18:55:33', '{"post":{"user_id":"1","date":"2022-04-15","time":"12:12","period":"4","amount":"4"}}'),
	(29, 1, NULL, '127.0.0.1', '/tab_szczepienia/public/index.php/admin/timetables/add', '2022-06-01 18:55:37', '{"post":{"user_id":"1","date":"2022-04-15","time":"12:12","period":"4","amount":"4"}}'),
	(30, 1, NULL, '127.0.0.1', '/tab_szczepienia/public/index.php/admin/timetables/add', '2022-06-01 18:56:10', '{"post":{"user_id":"1","date":"2022-04-15","time":"12:12","period":"4","amount":"4"}}'),
	(31, 1, NULL, '127.0.0.1', '/tab_szczepienia/public/index.php/admin/timetables/index', '2022-06-01 18:56:10', '[]');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;

-- Zrzut struktury tabela tab_vaccinations.patients
DROP TABLE IF EXISTS `patients`;
CREATE TABLE IF NOT EXISTS `patients` (
  `pesel` bigint NOT NULL,
  `name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `surname` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `city` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `street` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `local_no` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `email` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `action_code` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`pesel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Zrzucanie danych dla tabeli tab_vaccinations.patients: ~2 rows (około)
DELETE FROM `patients`;
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
INSERT INTO `patients` (`pesel`, `name`, `surname`, `city`, `street`, `local_no`, `email`, `action_code`) VALUES
	(12345678901, 'Grzegorz', 'Brzęczyszczykliewicz', 'Łękołody', 'Polna', '1b', 'alekdry203@student.polsl.pl', '627d84448d54'),
	(12345678902, 'Test', 'Owanie', 'Gliwice', 'Polna', '627d84448d54', 'olekdrynda@gmail.com', '628e5981ba21');
/*!40000 ALTER TABLE `patients` ENABLE KEYS */;

-- Zrzut struktury tabela tab_vaccinations.timetable
DROP TABLE IF EXISTS `timetable`;
CREATE TABLE IF NOT EXISTS `timetable` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vaccination_date` datetime NOT NULL,
  `users_id` int NOT NULL,
  `patients_pesel` bigint DEFAULT NULL,
  `vaccinations_warehouse_serial_no` int DEFAULT NULL,
  `payment` tinyint(1) DEFAULT NULL,
  `activation_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_timetable_users_idx` (`users_id`),
  KEY `fk_timetable_patients1_idx` (`patients_pesel`),
  KEY `fk_timetable_vaccinations_warehouse1_idx` (`vaccinations_warehouse_serial_no`),
  CONSTRAINT `fk_timetable_patients1` FOREIGN KEY (`patients_pesel`) REFERENCES `patients` (`pesel`),
  CONSTRAINT `fk_timetable_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_timetable_vaccinations_warehouse1` FOREIGN KEY (`vaccinations_warehouse_serial_no`) REFERENCES `vaccinations_warehouse` (`serial_no`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Zrzucanie danych dla tabeli tab_vaccinations.timetable: ~11 rows (około)
DELETE FROM `timetable`;
/*!40000 ALTER TABLE `timetable` DISABLE KEYS */;
INSERT INTO `timetable` (`id`, `vaccination_date`, `users_id`, `patients_pesel`, `vaccinations_warehouse_serial_no`, `payment`, `activation_code`) VALUES
	(10, '2022-04-15 11:11:00', 1, NULL, NULL, NULL, NULL),
	(11, '2022-04-15 11:22:00', 1, NULL, NULL, NULL, NULL),
	(12, '2022-04-15 11:33:00', 1, NULL, NULL, NULL, NULL),
	(14, '2022-04-18 11:26:00', 1, NULL, NULL, NULL, NULL),
	(15, '2022-04-18 11:41:00', 1, NULL, NULL, NULL, NULL),
	(16, '2022-04-18 11:56:00', 1, NULL, NULL, NULL, NULL),
	(17, '2022-04-20 12:00:00', 1, 12345678901, 5679, NULL, '627d6ccc559e'),
	(18, '2022-04-20 12:15:00', 1, 12345678901, 5680, 1, '627d6cd535ec'),
	(19, '2022-04-20 12:30:00', 1, NULL, NULL, NULL, NULL),
	(20, '2022-04-20 12:45:00', 1, NULL, NULL, NULL, NULL),
	(21, '2022-04-20 13:00:00', 1, NULL, NULL, NULL, NULL),
	(22, '2022-04-15 12:12:00', 1, NULL, NULL, NULL, NULL),
	(23, '2022-04-15 12:15:00', 1, NULL, NULL, NULL, NULL),
	(24, '2022-04-15 12:18:00', 1, NULL, NULL, NULL, NULL),
	(25, '2022-04-15 12:21:00', 1, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `timetable` ENABLE KEYS */;

-- Zrzut struktury tabela tab_vaccinations.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `surname` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `login` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Zrzucanie danych dla tabeli tab_vaccinations.users: ~1 rows (około)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `surname`, `login`, `password`, `admin`) VALUES
	(1, 'Konto', 'Adimnistratora', 'admin', '007e0f157505472ccf076c6f73befbd6', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Zrzut struktury tabela tab_vaccinations.vaccinations_warehouse
DROP TABLE IF EXISTS `vaccinations_warehouse`;
CREATE TABLE IF NOT EXISTS `vaccinations_warehouse` (
  `serial_no` int NOT NULL,
  `name` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `producer` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `expiration_date` date NOT NULL,
  PRIMARY KEY (`serial_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Zrzucanie danych dla tabeli tab_vaccinations.vaccinations_warehouse: ~11 rows (około)
DELETE FROM `vaccinations_warehouse`;
/*!40000 ALTER TABLE `vaccinations_warehouse` DISABLE KEYS */;
INSERT INTO `vaccinations_warehouse` (`serial_no`, `name`, `producer`, `expiration_date`) VALUES
	(5679, 'Pfizer', 'Pfizer', '2023-04-01'),
	(5680, 'Pfizer', 'Pfizer', '2023-04-01'),
	(5681, 'Pfizer', 'Pfizer', '2023-04-01'),
	(5682, 'Pfizer', 'Pfizer', '2023-04-01'),
	(5683, 'Pfizer', 'Pfizer', '2023-04-01'),
	(5684, 'Pfizer', 'Pfizer', '2023-04-01'),
	(5685, 'Pfizer', 'Pfizer', '2023-04-01'),
	(5686, 'Pfizer', 'Pfizer', '2023-04-01'),
	(5687, 'Pfizer', 'Pfizer', '2023-04-01'),
	(5688, 'Pfizer', 'Pfizer', '2023-04-01'),
	(5689, 'Pfizer', 'Pfizer', '2023-04-01');
/*!40000 ALTER TABLE `vaccinations_warehouse` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
