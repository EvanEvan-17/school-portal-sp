/*
SQLyog Community v13.2.1 (64 bit)
MySQL - 8.0.34 : Database - school-portal
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
-- CREATE DATABASE /*!32312 IF NOT EXISTS*/`school-portal` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

-- USE `school-portal`;

/*Data for the table `agent_conversation_messages` */

/*Data for the table `agent_conversations` */

/*Data for the table `assignments` */

insert  into `assignments`(`id`,`title`,`description`,`due_at`,`teacher_id`,`created_at`,`updated_at`) values 
(1,'Math: Quadratic functions','Express how it\'ll be naturally used in daily life','2026-06-29 10:10:39',1,'2026-06-07 10:10:45','2026-06-07 10:10:45'),
(2,'Global perspective: Knowing myself','Explain how you\'re in the society','2026-06-15 10:10:45',1,'2026-06-07 10:10:45','2026-06-07 10:10:45');

/*Data for the table `cache` */

/*Data for the table `cache_locks` */

/*Data for the table `event_included_classes` */

/*Data for the table `events` */

insert  into `events`(`id`,`title`,`description`,`start_time`,`end_time`,`visibility`,`google_calendar_event_id`,`created_at`,`updated_at`) values 
(1,'Final exam','','2026-06-10 10:30:00','2026-06-18 11:30:00','private','','2026-06-26 12:22:29','2026-06-26 12:22:29');

/*Data for the table `failed_jobs` */

/*Data for the table `job_batches` */

/*Data for the table `jobs` */

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(4,'0001_01_01_000000_create_users_table',1),
(5,'0001_01_01_000001_create_cache_table',1),
(6,'0001_01_01_000002_create_jobs_table',1),
(7,'2026_06_01_111759_add_is_super_admin_column_to_users_table',2),
(8,'2026_06_02_042226_add_google_user_id_to_users_table',3),
(9,'2026_06_05_101937_create_agent_conversations_table',4),
(12,'2026_06_07_025658_create_assignments_table',5),
(13,'2026_06_07_030324_create_student_assignments_table',5),
(14,'2026_06_24_070418_create_events_table',6),
(15,'2026_06_24_072934_create_student_classes_table',6),
(16,'2026_06_24_073229_create_student_class_members_table',7),
(18,'2026_06_24_073438_create_event_included_classes_table',8),
(19,'2026_06_24_074815_add_google_calendar_id_column_to_student_classes_table',9),
(20,'2026_06_24_112436_add_teacher_id_column_to_student_classes_table',10),
(21,'2026_06_24_114056_add_visibility_column_to_events_table',11);

/*Data for the table `password_reset_tokens` */

/*Data for the table `sessions` */

/*Data for the table `student_assignments` */

insert  into `student_assignments`(`student_id`,`assignment_id`,`status`,`created_at`,`updated_at`) values 
(1,1,'not_submitted','2026-06-07 10:11:16','2026-06-07 10:11:18'),
(1,2,'not_submitted','2026-06-07 10:10:45','2026-06-07 10:10:45');

/*Data for the table `student_class_members` */

/*Data for the table `student_classes` */

insert  into `student_classes`(`id`,`grade`,`name`,`start`,`end`,`teacher_id`,`google_calendar_id`,`created_at`,`updated_at`) values 
(1,7,'A','2026-06-24','2027-06-17',NULL,'8c247eb1b65dbc8ef9a822f29f1fbff688b1111740dacca600245b48123ce899@group.calendar.google.com','2026-06-24 14:46:16','2026-06-24 14:46:18');

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`username`,`email`,`email_verified_at`,`password`,`google_user_id`,`google_tokens`,`is_super_admin`,`remember_token`,`created_at`,`updated_at`) values 
(1,'Admin','admin','admin@example.com',NULL,'$2y$12$mjNosAVcZSZPxFKG75sCyO1i4KTbxHuReuCjcqold/vDRKFTb5hke','123456789',NULL,1,NULL,'2026-06-02 12:08:23','2026-06-29 22:00:21'),
(2,'Student','student','student@example.com',NULL,'$2y$12$8QSNyg9RGFeAqs60kHvmPesvObRiaxOWCb0RJpi4jnAL6uh6vUp3u','987654321',NULL,0,NULL,'2026-06-28 14:17:05','2026-06-29 22:00:34');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
