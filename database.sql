-- =========================================================
-- HXH-C8 Hunter Association Examination Database Schema
-- =========================================================

CREATE DATABASE IF NOT EXISTS `hxh_ctf` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `hxh_ctf`;

-- 1. System Flags & Classified Hunter Records
DROP TABLE IF EXISTS `system_flags`;
CREATE TABLE `system_flags` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `flag_code` VARCHAR(64) NOT NULL UNIQUE,
    `flag_name` VARCHAR(128) NOT NULL,
    `secret_value` TEXT NOT NULL,
    `security_level` VARCHAR(32) DEFAULT 'TRIPLE_STAR_HUNTER',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `system_flags` (`flag_code`, `flag_name`, `secret_value`, `security_level`) VALUES
('FLAG_PROCTOR_AUTH', '288th Hunter Exam Master Key (REAL)', 'SSP{PRANKED_YOU_CA82F71E}', 'TRIPLE_STAR_HUNTER'),
('FLAG_DECOY_OFFICIAL', 'Hunter Association Terminal Key', 'SSP{WEB_CHATBOT_A91B3E4F}', 'SECURITY_DECOY'),
('FLAG_TONPA_TRAP', 'Tonpa Rookie Trap Flag', 'SSP{PRANKED_YOU_TONPA_JUICE_405}', 'ROOKIE_TRASH'),
('FLAG_HISOKA_DECOY', 'Hisoka Bungee Decoy', 'SSP{PRANKED_YOU_BY_HISOKA_BUNGEE_GUM}', 'DEATH_MAGICIAN'),
('FLAG_CHAIRMAN_DECOY', 'Netero Gratitude Punch Decoy', 'SSP{NETERO_SECRET_CLEARANCE_7741C90A}', 'CHAIRMAN_LEVEL');

-- 2. Hunter Exam Candidates Table
DROP TABLE IF EXISTS `hunter_candidates`;
CREATE TABLE `hunter_candidates` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `applicant_id` VARCHAR(32) NOT NULL UNIQUE,
    `codename` VARCHAR(64) NOT NULL,
    `nen_category` VARCHAR(32) NOT NULL,
    `license_verified` TINYINT(1) DEFAULT 0,
    `auth_token` VARCHAR(128) DEFAULT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `hunter_candidates` (`applicant_id`, `codename`, `nen_category`, `license_verified`, `auth_token`) VALUES
('APPL-405', 'Gon Freecss', 'Enhancer', 1, 'TOK_ENH_88319F02'),
('APPL-099', 'Killua Zoldyck', 'Transmuter', 1, 'TOK_TRN_7741C90A'),
('APPL-404', 'Kurapika', 'Conjurer/Specialist', 1, 'TOK_CNJ_5592B114'),
('APPL-403', 'Leorio Paradinight', 'Emitter', 1, 'TOK_EMT_1102A884'),
('APPL-044', 'Hisoka Morow', 'Transmuter', 1, 'TOK_DTH_0044X999'),
('APPL-016', 'Tonpa', 'Rookie Crusher', 0, 'TOK_TRP_LAXATIVE'),
('APPL-GUEST', 'Anonymous Hacker Candidate', 'Unknown Nen', 0, NULL);

-- 3. Terminal Chat Interaction Logs
DROP TABLE IF EXISTS `hunter_chat_logs`;
CREATE TABLE `hunter_chat_logs` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `ip_address` VARCHAR(45) NOT NULL,
    `user_message` TEXT NOT NULL,
    `proctor_reply` TEXT NOT NULL,
    `tampered_payload` TINYINT(1) DEFAULT 0,
    `flag_granted` TINYINT(1) DEFAULT 0,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
