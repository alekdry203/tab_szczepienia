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
CREATE DATABASE IF NOT EXISTS `tab_vaccinations` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `tab_vaccinations`;

-- Zrzut struktury tabela tab_vaccinations.logs
CREATE TABLE IF NOT EXISTS `logs` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) DEFAULT NULL,
  `patient_pesel` BIGINT(11) DEFAULT NULL,
  `ip` varchar(80) COLLATE utf8mb4_bin DEFAULT NULL,
  `url_path` text COLLATE utf8mb4_bin,
  `action_time` datetime DEFAULT NULL,
  `data` text COLLATE utf8mb4_bin,
  PRIMARY KEY (`id`),
  KEY `fk_logs_users` (`user_id`),
  KEY `fk_logs_patients` (`patient_pesel`),
  CONSTRAINT `fk_logs_patients` FOREIGN KEY (`patient_pesel`) REFERENCES `patients` (`pesel`),
  CONSTRAINT `fk_logs_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Zrzucanie danych dla tabeli tab_vaccinations.logs: ~0 rows (około)
DELETE FROM `logs`;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;

-- Zrzut struktury tabela tab_vaccinations.patients
CREATE TABLE IF NOT EXISTS `patients` (
  `pesel` BIGINT(11) NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `surname` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `city` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `street` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `local_no` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `email` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`pesel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Zrzucanie danych dla tabeli tab_vaccinations.patients: ~0 rows (około)
DELETE FROM `patients`;
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
/*!40000 ALTER TABLE `patients` ENABLE KEYS */;

-- Zrzut struktury tabela tab_vaccinations.timetable
CREATE TABLE IF NOT EXISTS `timetable` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `inset_time` datetime DEFAULT NULL,
  `users_id` INT(11) DEFAULT NULL,
  `patients_pesel` BIGINT(11) DEFAULT NULL,
  `vaccinations_warehouse_serial_no` int DEFAULT NULL,
  `payment` boolean DEFAULT NULL,
  `activation_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_timetable_users_idx` (`users_id`),
  KEY `fk_timetable_patients1_idx` (`patients_pesel`),
  KEY `fk_timetable_vaccinations_warehouse1_idx` (`vaccinations_warehouse_serial_no`),
  CONSTRAINT `fk_timetable_patients1` FOREIGN KEY (`patients_pesel`) REFERENCES `patients` (`pesel`),
  CONSTRAINT `fk_timetable_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  CONSTRAINT `fk_timetable_vaccinations_warehouse1` FOREIGN KEY (`vaccinations_warehouse_serial_no`) REFERENCES `vaccinations_warehouse` (`serial_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Zrzucanie danych dla tabeli tab_vaccinations.timetable: ~0 rows (około)
DELETE FROM `timetable`;
/*!40000 ALTER TABLE `timetable` DISABLE KEYS */;
/*!40000 ALTER TABLE `timetable` ENABLE KEYS */;

-- Zrzut struktury tabela tab_vaccinations.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `surname` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `login` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `admin` boolean DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Zrzucanie danych dla tabeli tab_vaccinations.users: ~0 rows (około)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `surname`, `login`, `password`, `admin`) VALUES
	(1, 'Konto', 'Adimnistratora', 'admin', '007e0f157505472ccf076c6f73befbd6', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Zrzut struktury tabela tab_vaccinations.vaccinations_warehouse
CREATE TABLE IF NOT EXISTS `vaccinations_warehouse` (
  `serial_no` int NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `producer` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  PRIMARY KEY (`serial_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Zrzucanie danych dla tabeli tab_vaccinations.vaccinations_warehouse: ~0 rows (około)
DELETE FROM `vaccinations_warehouse`;
/*!40000 ALTER TABLE `vaccinations_warehouse` DISABLE KEYS */;
/*!40000 ALTER TABLE `vaccinations_warehouse` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
