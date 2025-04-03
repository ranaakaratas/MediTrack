-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2025 at 09:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `k2109743`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `description` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `description`) VALUES
(1, 'Morning Walk'),
(2, 'Yoga Session'),
(3, 'Gym Workout');

-- --------------------------------------------------------

--
-- Table structure for table `activitylog`
--

CREATE TABLE `activitylog` (
  `id` int(11) NOT NULL,
  `activityId` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `patientId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activitylog`
--

INSERT INTO `activitylog` (`id`, `activityId`, `timestamp`, `patientId`) VALUES
(1, 1, '2025-02-04 12:20:38', 2),
(2, 2, '2025-02-04 12:20:38', 2),
(3, 3, '2025-02-04 12:20:38', 2),
(4, 2, '2025-03-23 00:00:00', 3),
(5, 3, '2025-03-25 00:00:00', 3),
(6, 1, '2025-03-30 00:00:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `specialty` varchar(40) NOT NULL,
  `contactInfo` varchar(80) NOT NULL,
  `hospital` varchar(80) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `name`, `specialty`, `contactInfo`, `hospital`, `password`) VALUES
(1, 'Dr Oliver Foster', 'Neurology', 'dr@info.com', 'Nuffield Hospital', 'oliver123'),
(2, 'Dr. Olivia Smith', 'Cardiology', 'olivia@hospital.com', 'General Hospital', 'olivia123'),
(3, 'Dr. John Doe', 'Neurology', 'johndoe@clinic.com', 'City Clinic', 'john123'),
(4, 'Dr. Sarah Johnson', 'Cardiology', 'sarah@medcenter.com', 'Medical Center', 'sarah123');

-- --------------------------------------------------------

--
-- Table structure for table `medication`
--

CREATE TABLE `medication` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medication`
--

INSERT INTO `medication` (`id`, `name`) VALUES
(1, 'Aspirin'),
(2, 'Ibuprofen'),
(3, 'Metformin');

-- --------------------------------------------------------

--
-- Table structure for table `medicationlog`
--

CREATE TABLE `medicationlog` (
  `id` int(11) NOT NULL,
  `medicationId` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `dosage` double NOT NULL,
  `patientId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicationlog`
--

INSERT INTO `medicationlog` (`id`, `medicationId`, `timestamp`, `dosage`, `patientId`) VALUES
(1, 1, '2025-02-04 12:21:33', 100, 2),
(2, 2, '2025-02-04 12:21:33', 200, 2),
(3, 3, '2025-02-04 12:21:33', 500, 2),
(4, 1, '2025-03-23 00:00:00', 25, 3),
(5, 1, '2025-03-30 23:00:00', 12, 3);

-- --------------------------------------------------------

--
-- Table structure for table `mood`
--

CREATE TABLE `mood` (
  `id` int(11) NOT NULL,
  `description` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mood`
--

INSERT INTO `mood` (`id`, `description`) VALUES
(1, 'Happy'),
(2, 'Anxious'),
(3, 'Relaxed');

-- --------------------------------------------------------

--
-- Table structure for table `moodlog`
--

CREATE TABLE `moodlog` (
  `id` int(11) NOT NULL,
  `moodId` int(11) NOT NULL,
  `energyLevel` int(2) NOT NULL,
  `moodLevel` int(2) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `patientId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `moodlog`
--

INSERT INTO `moodlog` (`id`, `moodId`, `energyLevel`, `moodLevel`, `timestamp`, `patientId`) VALUES
(1, 1, 8, 9, '2025-02-04 12:22:16', 2),
(2, 2, 5, 4, '2025-02-04 12:22:16', 2),
(3, 3, 7, 8, '2025-02-04 12:22:16', 2),
(12, 1, 1, 1, '2025-03-26 00:00:00', 3),
(13, 1, 1, 1, '2025-03-22 00:00:00', 3),
(14, 3, 3, 3, '2025-03-29 00:00:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `name` varchar(40) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `phoneNo` varchar(20) NOT NULL,
  `medicalNotes` varchar(256) NOT NULL,
  `doctorId` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `dob`, `name`, `gender`, `phoneNo`, `medicalNotes`, `doctorId`, `email`, `password`) VALUES
(2, '20/08/2002', 'Rana Karatas', 'female', '07512345678', 'Mild concussion three years ago.', 1, 'rana@gmail.com', '1234'),
(3, '1985-06-15', 'Alice Johnson', 'Female', '1234567890', 'Diabetic patient', 1, 'alice@example.com', 'pass123'),
(4, '1990-09-22', 'Bob Williams', 'Male', '0987654321', 'Hypertension issues', 2, 'bob@example.com', 'securepass'),
(5, '1975-03-10', 'Charlie Brown', 'Male', '1122334455', 'Asthma history', 3, 'charlie@example.com', 'mypassword');

-- --------------------------------------------------------

--
-- Table structure for table `prescribedmedication`
--

CREATE TABLE `prescribedmedication` (
  `id` int(11) NOT NULL,
  `patientId` int(11) NOT NULL,
  `doctorId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `symptom`
--

CREATE TABLE `symptom` (
  `id` int(11) NOT NULL,
  `description` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `symptomlog`
--

CREATE TABLE `symptomlog` (
  `id` int(11) NOT NULL,
  `symptomId` int(11) NOT NULL,
  `severity` int(2) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `patientId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activitylog`
--
ALTER TABLE `activitylog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activityId` (`activityId`),
  ADD KEY `fk_activitylog_patient` (`patientId`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medication`
--
ALTER TABLE `medication`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicationlog`
--
ALTER TABLE `medicationlog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medicationId` (`medicationId`),
  ADD KEY `fk_medicationlog_patient` (`patientId`);

--
-- Indexes for table `mood`
--
ALTER TABLE `mood`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moodlog`
--
ALTER TABLE `moodlog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `moodId` (`moodId`),
  ADD KEY `fk_moodlog_patient` (`patientId`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctorId` (`doctorId`);

--
-- Indexes for table `prescribedmedication`
--
ALTER TABLE `prescribedmedication`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patientId` (`patientId`),
  ADD KEY `doctor` (`doctorId`);

--
-- Indexes for table `symptom`
--
ALTER TABLE `symptom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `symptomlog`
--
ALTER TABLE `symptomlog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `symptomId` (`symptomId`),
  ADD KEY `fk_symptomlog_patient` (`patientId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `activitylog`
--
ALTER TABLE `activitylog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `medication`
--
ALTER TABLE `medication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medicationlog`
--
ALTER TABLE `medicationlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mood`
--
ALTER TABLE `mood`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `moodlog`
--
ALTER TABLE `moodlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `prescribedmedication`
--
ALTER TABLE `prescribedmedication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `symptom`
--
ALTER TABLE `symptom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `symptomlog`
--
ALTER TABLE `symptomlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activitylog`
--
ALTER TABLE `activitylog`
  ADD CONSTRAINT `activityId` FOREIGN KEY (`activityId`) REFERENCES `activity` (`id`),
  ADD CONSTRAINT `fk_activitylog_patient` FOREIGN KEY (`patientId`) REFERENCES `patient` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `medicationlog`
--
ALTER TABLE `medicationlog`
  ADD CONSTRAINT `fk_medicationlog_patient` FOREIGN KEY (`patientId`) REFERENCES `patient` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `medicationId` FOREIGN KEY (`medicationId`) REFERENCES `medication` (`id`);

--
-- Constraints for table `moodlog`
--
ALTER TABLE `moodlog`
  ADD CONSTRAINT `fk_moodlog_patient` FOREIGN KEY (`patientId`) REFERENCES `patient` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `moodId` FOREIGN KEY (`moodId`) REFERENCES `mood` (`id`);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `doctorId` FOREIGN KEY (`doctorId`) REFERENCES `doctor` (`id`);

--
-- Constraints for table `prescribedmedication`
--
ALTER TABLE `prescribedmedication`
  ADD CONSTRAINT `doctor` FOREIGN KEY (`doctorId`) REFERENCES `doctor` (`id`),
  ADD CONSTRAINT `patientId` FOREIGN KEY (`patientId`) REFERENCES `patient` (`id`);

--
-- Constraints for table `symptomlog`
--
ALTER TABLE `symptomlog`
  ADD CONSTRAINT `fk_symptomlog_patient` FOREIGN KEY (`patientId`) REFERENCES `patient` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `symptomId` FOREIGN KEY (`symptomId`) REFERENCES `symptom` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
