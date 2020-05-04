-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DELIMITER ;;

DROP FUNCTION IF EXISTS `DifHours`;;
CREATE FUNCTION `DifHours`(find DATETIME, std DATETIME, ratetime INT) RETURNS int
BEGIN
    DECLARE h INT;
    DECLARE i INT;
    DECLARE rth INT;

    IF find IS NULL THEN
        RETURN NULL;
    end if;

    SET h = 0;
    SET i = 0;

    wloop:
    WHILE DATEDIFF(find, std) >= 0
        DO
            IF DAYOFWEEK(std) >= 6 THEN
                SET std = DATE_ADD(std, INTERVAL 1 DAY);
                ITERATE wloop;
            end if;
            SET h = h + 8;
            SET std = DATE_ADD(std, INTERVAL 1 DAY);
        end while wloop;

    SET rth = ratetime;
    SET i = h - rth;

    RETURN i;

END;;

DROP FUNCTION IF EXISTS `DifHoursBehindDates`;;
CREATE FUNCTION `DifHoursBehindDates`(find DATETIME, std DATETIME) RETURNS int
BEGIN
    DECLARE h INT;

    IF find IS NULL THEN
        RETURN NULL;
    end if;

    SET h = 0;

    wloop:
    WHILE DATEDIFF(find, std) >= 0
        DO
            IF DAYOFWEEK(std) >= 6 THEN
                SET std = DATE_ADD(std, INTERVAL 1 DAY);
                ITERATE wloop;
            end if;
            SET h = h + 8;
            SET std = DATE_ADD(std, INTERVAL 1 DAY);
        end while wloop;

    RETURN h;

END;;

DELIMITER ;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees`
(
    `id`            bigint unsigned                                         NOT NULL AUTO_INCREMENT,
    `reg_num`       varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `last_name`     varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `first_name`    varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `second_name`   varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `position`      bigint unsigned                                         NOT NULL,
    `birthday_date` date                                                    NOT NULL,
    `email`         varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `phone`         varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `employees_reg_num_unique` (`reg_num`),
    UNIQUE KEY `employees_email_unique` (`email`),
    KEY `employees_position_foreign` (`position`),
    CONSTRAINT `employees_position_foreign` FOREIGN KEY (`position`) REFERENCES `positions` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

INSERT INTO `employees` (`id`, `reg_num`, `last_name`, `first_name`, `second_name`, `position`, `birthday_date`,
                         `email`, `phone`)
VALUES (1, 'EM1', 'Гаевский', 'Михаил', 'Васильевич', 2, '1987-03-05', 'gay@company.com', '35-87-22'),
       (2, 'EM2', 'Каверин', 'Андрей', 'Дмитриевич', 3, '1991-03-05', 'kav@company.com', '35-87-23'),
       (3, 'EM3', 'Волошин', 'Геннадий', 'Ильич', 1, '1965-03-05', 'vol@company.com', '35-87-24'),
       (4, 'EM4', 'Бекешев', 'Виталий', 'Георгиевич', 6, '1982-03-05', 'bek@company.com', '35-87-25'),
       (5, 'EM5', 'Леонов', 'Кондрат', 'Мамедович', 5, '1995-03-05', 'leo@company.com', '35-87-26'),
       (6, 'EM6', 'Веселов', 'Илья', 'Михайлович', 4, '1994-06-06', 'ves@company.com', '35-87-27'),
       (7, 'EM7', 'Чирак', 'Василий', 'Петрович', 3, '1995-03-05', 'chi@company.com', '35-87-28'),
       (8, 'EM8', 'Колбасов', 'Роман', 'Семенович', 3, '1991-03-05', 'col@company.com', '35-87-29');

DROP TABLE IF EXISTS `employees_tasks`;
CREATE TABLE `employees_tasks`
(
    `id`          bigint unsigned NOT NULL AUTO_INCREMENT,
    `employee_id` bigint unsigned NOT NULL,
    `task_id`     bigint unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `employees_tasks_employee_id_foreign` (`employee_id`),
    KEY `employees_tasks_task_id_foreign` (`task_id`),
    CONSTRAINT `employees_tasks_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
    CONSTRAINT `employees_tasks_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

INSERT INTO `employees_tasks` (`id`, `employee_id`, `task_id`)
VALUES (1, 1, 1),
       (2, 1, 2),
       (3, 2, 3),
       (4, 3, 13),
       (5, 4, 13),
       (6, 5, 10),
       (7, 8, 9),
       (8, 8, 3),
       (9, 3, 3),
       (10, 6, 6),
       (11, 7, 7),
       (12, 8, 8),
       (13, 8, 11),
       (14, 6, 4),
       (15, 6, 3),
       (16, 1, 3),
       (17, 4, 12),
       (18, 8, 13);

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`
(
    `id`         bigint unsigned                     NOT NULL AUTO_INCREMENT,
    `connection` text COLLATE utf8mb4_unicode_ci     NOT NULL,
    `queue`      text COLLATE utf8mb4_unicode_ci     NOT NULL,
    `payload`    longtext COLLATE utf8mb4_unicode_ci NOT NULL,
    `exception`  longtext COLLATE utf8mb4_unicode_ci NOT NULL,
    `failed_at`  timestamp                           NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`
(
    `id`        int unsigned                            NOT NULL AUTO_INCREMENT,
    `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `batch`     int                                     NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (1, '2019_08_19_000000_create_failed_jobs_table', 1),
       (2, '2020_04_22_050948_create_projects_table', 1),
       (3, '2020_04_22_060848_create_task_statuses', 1),
       (4, '2020_04_22_061535_create_tasks', 1),
       (5, '2020_04_22_063724_create_positions_table', 1),
       (6, '2020_04_22_064241_create_employees_table', 1),
       (7, '2020_04_22_065211_create_employees_tasks_table', 1);

DROP TABLE IF EXISTS `positions`;
CREATE TABLE `positions`
(
    `id`    bigint unsigned                                         NOT NULL AUTO_INCREMENT,
    `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `positions_title_unique` (`title`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

INSERT INTO `positions` (`id`, `title`)
VALUES (6, 'Внешний пользователь'),
       (1, 'Ген. директор'),
       (4, 'Инженер-программист'),
       (3, 'Менеджер'),
       (5, 'Программист'),
       (2, 'Управляющий');

DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects`
(
    `id`            bigint unsigned                                         NOT NULL AUTO_INCREMENT,
    `reg_num`       varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `title`         varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `alias`         varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `description`   text CHARACTER SET utf8 COLLATE utf8_general_ci         NOT NULL,
    `manager_id`    bigint unsigned                                         NOT NULL,
    `register_date` date                                                    NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `projects_reg_num_unique` (`reg_num`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

INSERT INTO `projects` (`id`, `reg_num`, `title`, `alias`, `description`, `manager_id`, `register_date`)
VALUES (1, 'PR1', 'PR1 Title Project', 'Project 1', 'Project 1 description', 4, '2012-12-12'),
       (2, 'PR2', 'PR2 Title Project', 'Project 2', 'Project 2 description', 2, '2012-12-15'),
       (3, 'PR3', 'PR3 Title Project', 'Project3', 'Project 3 description', 1, '2012-12-18');

DROP TABLE IF EXISTS `task_statuses`;
CREATE TABLE `task_statuses`
(
    `id`    bigint unsigned                                         NOT NULL AUTO_INCREMENT,
    `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `task_statuses_title_unique` (`title`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

INSERT INTO `task_statuses` (`id`, `title`)
VALUES (2, 'В процессе'),
       (3, 'Завершена'),
       (1, 'Не начата'),
       (4, 'Отложена');

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks`
(
    `id`          bigint unsigned                                         NOT NULL AUTO_INCREMENT,
    `project_id`  bigint unsigned                                         NOT NULL,
    `reg_num`     varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `title`       varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `description` text CHARACTER SET utf8 COLLATE utf8_general_ci         NOT NULL,
    `start_date`  date DEFAULT NULL,
    `finish_date` date DEFAULT NULL,
    `rate_time`   int unsigned                                            NOT NULL,
    `status`      bigint unsigned                                         NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `tasks_reg_num_unique` (`reg_num`),
    KEY `tasks_project_id_foreign` (`project_id`),
    KEY `tasks_status_foreign` (`status`),
    CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
    CONSTRAINT `tasks_status_foreign` FOREIGN KEY (`status`) REFERENCES `task_statuses` (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

INSERT INTO `tasks` (`id`, `project_id`, `reg_num`, `title`, `description`, `start_date`, `finish_date`, `rate_time`,
                     `status`)
VALUES (1, 1, 'TSK1-1', 'TSK1-1 Title Task', 'TSK1-1 Task description', '2020-03-18', NULL, 15, 1),
       (2, 1, 'TSK2-1', 'TSK2-1 Title Task', 'TSK2-1 Task description', '2015-09-09', '2015-09-12', 30, 3),
       (3, 1, 'TSK3-1', 'TSK3-1 Title Task', 'TSK3-1 Task description', '2020-03-18', NULL, 6, 4),
       (4, 1, 'TSK4-1', 'TSK4-1 Title Task', 'TSK4-1 Task description', '2017-09-09', NULL, 6, 4),
       (5, 1, 'TSK5-1', 'TSK5-1 Title Task', 'TSK5-1 Task description', '2016-09-09', NULL, 2, 1),
       (6, 1, 'TSK6-1', 'TSK6-1 Title Task', 'TSK6-1 Task description', '2011-09-09', NULL, 15, 2),
       (7, 2, 'TSK1-2', 'TSK1-2 Title Task', 'TSK1-2 Task description', '2013-09-09', '2016-09-09', 17, 3),
       (8, 2, 'TSK2-2', 'TSK2-2 Title Task', 'TSK2-2 Task description', '2015-09-09', NULL, 8, 4),
       (9, 2, 'TSK3-2', 'TSK3-2 Title Task', 'TSK3-2 Task description', '2020-04-04', NULL, 5, 1),
       (10, 2, 'TSK4-2', 'TSK4-2 Title Task', 'TSK4-2 Task description', '2019-09-09', NULL, 14, 2),
       (11, 2, 'TSK5-2', 'TSK5-2 Title Task', 'TSK5-2 Task description', '2011-09-09', '2012-09-09', 12, 3),
       (12, 3, 'TSK1-3', 'TSK1-3 Title Task', 'TSK1-3 Task description', '2015-09-09', NULL, 10, 4),
       (13, 3, 'TSK2-3', 'TSK2-3 Title Task', 'TSK2-3 Task description', '2015-09-09', NULL, 20, 1);

-- 2020-04-25 11:54:48
