--
-- Database: `medicine_tracker_testing`
--

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `rxcui`, `name`, `drug_name`, `base_names`, `dose_form_group_names`, `created_at`, `updated_at`) VALUES
(1, '997422', 'fexofenadine hydrochloride 180 MG Oral Tablet [Allegra]', 'allegra', '[\"fexofenadine\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-10 00:40:15', '2023-12-10 00:40:15'),
(2, '997484', 'fexofenadine hydrochloride 30 MG Disintegrating Oral Tablet [Allegra]', 'allegra', '[\"fexofenadine\"]', '[\"Oral Product\", \"Pill\", \"Disintegrating Oral Product\"]', '2023-12-10 00:40:15', '2023-12-10 00:40:15'),
(3, '997493', 'fexofenadine hydrochloride 6 MG/ML Oral Suspension [Allegra]', 'allegra', '[\"fexofenadine\"]', '[\"Oral Product\", \"Oral Liquid Product\"]', '2023-12-10 00:40:15', '2023-12-10 00:40:15'),
(4, '997502', 'fexofenadine hydrochloride 60 MG Oral Tablet [Allegra]', 'allegra', '[\"fexofenadine\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-10 00:40:15', '2023-12-10 00:40:15');

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_12_07_145310_create_medicines_table', 1),
(6, '2023_12_09_124654_create_users_medications_table', 1);

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Unit Test User 1', 'unittest1@gmail.com', NULL, '$2y$04$cBBxQdzJoL.Xc5KRJA0O0uHQnGzxpT/An3rdmSpGNsCM6FjhDGcC.', NULL, '2023-12-10 01:20:58', '2023-12-10 01:20:58');

--
-- Dumping data for table `users_medications`
--

INSERT INTO `users_medications` (`id`, `user_id`, `medication_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 2, '2023-12-10 08:42:51', '2023-12-10 09:56:00', '2023-12-10 09:56:00');
COMMIT;
