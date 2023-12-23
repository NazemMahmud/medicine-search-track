--
-- Database: `medicine_tracker`
--

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `rxcui`, `name`, `drug_name`, `base_names`, `dose_form_group_names`, `created_at`, `updated_at`) VALUES
(1, '261266', 'pioglitazone 15 MG Oral Tablet [Actos]', 'actos', '[\"pioglitazone\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-09 08:58:36', '2023-12-09 08:58:36'),
(2, '261267', 'pioglitazone 30 MG Oral Tablet [Actos]', 'actos', '[\"pioglitazone\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-09 08:58:36', '2023-12-09 08:58:36'),
(3, '261268', 'pioglitazone 45 MG Oral Tablet [Actos]', 'actos', '[\"pioglitazone\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-09 08:58:36', '2023-12-09 08:58:36'),
(4, '596928', 'duloxetine 20 MG Delayed Release Oral Capsule [Cymbalta]', 'cymbalta', '[\"duloxetine\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-09 08:59:54', '2023-12-09 08:59:54'),
(5, '596932', 'duloxetine 30 MG Delayed Release Oral Capsule [Cymbalta]', 'cymbalta', '[\"duloxetine\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-09 08:59:54', '2023-12-09 08:59:54'),
(7, '991063', 'dicyclomine hydrochloride 10 MG Oral Capsule [Bentyl]', 'bentyl', '[\"dicyclomine\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-09 14:50:41', '2023-12-09 14:50:41'),
(8, '991069', '2 ML dicyclomine hydrochloride 10 MG/ML Injection [Bentyl]', 'bentyl', '[\"dicyclomine\"]', '[\"Injectable Product\"]', '2023-12-09 14:50:41', '2023-12-09 14:50:41'),
(9, '991088', 'dicyclomine hydrochloride 20 MG Oral Tablet [Bentyl]', 'bentyl', '[\"dicyclomine\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-09 14:50:41', '2023-12-09 14:50:41'),
(10, '1368960', 'mesalamine 400 MG Delayed Release Oral Capsule [Delzicol]', 'Delzicol', '[\"mesalamine\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-09 14:52:50', '2023-12-09 14:52:50'),
(14, '1038787', 'glucose 0.4 MG/MG Oral Gel [Glutose]', 'dextrose', '[\"glucose\"]', '[\"Oral Product\", \"Oral Gel Product\"]', '2023-12-09 14:57:58', '2023-12-09 14:57:58'),
(15, '1086386', 'glucose 50 MG/ML Oral Solution [Enfamil Glucose]', 'dextrose', '[\"glucose\"]', '[\"Oral Product\", \"Oral Liquid Product\"]', '2023-12-09 14:57:58', '2023-12-09 14:57:58'),
(16, '1090639', 'alanine 8.8 MG/ML / arginine 4.89 MG/ML / calcium chloride 0.004 MEQ/ML / dibasic potassium phosphate 2.61 MG/ML / glucose 100 MG/ML / glycine 4.38 MG/ML / histidine 2.04 MG/ML / isoleucine 2.55 MG/ML / leucine 3.11 MG/ML / lysine 2.47 MG/ML / magnesium chloride 0.01 MEQ/ML / methionine 1.7 MG/ML / phenylalanine 2.38 MG/ML / proline 2.89 MG/ML / serine 2.13 MG/ML / sodium acetate trihydrate 2.97 MG/ML / sodium chloride 0.013 MEQ/ML / threonine 1.79 MG/ML / tryptophan 0.77 MG/ML / tyrosine 0.17 MG/ML / valine 2.47 MG/ML Injectable Solution [Clinimix E 4.25/10]', 'dextrose', '[\"threonine\", \"tryptophan\", \"arginine\", \"tyrosine\", \"valine\", \"calcium chloride\", \"alanine\", \"glucose\", \"glycine\", \"histidine\", \"dibasic potassium phosphate\", \"sodium acetate\", \"isoleucine\", \"leucine\", \"lysine\", \"magnesium chloride\", \"methionine\", \"phenylalanine\", \"proline\", \"serine\", \"sodium chloride\"]', '[\"Injectable Product\"]', '2023-12-09 14:57:58', '2023-12-09 14:57:58'),
(17, '1147993', 'glucose 4000 MG Chewable Tablet [Dex4]', 'dextrose', '[\"glucose\"]', '[\"Oral Product\", \"Pill\", \"Chewable Product\"]', '2023-12-09 14:57:59', '2023-12-09 14:57:59'),
(18, '1189629', 'glucose 50 MG/ML / magnesium chloride 0.00148 MEQ/ML / potassium chloride 0.00497 MEQ/ML / sodium acetate 0.027 MEQ/ML / sodium chloride 0.0899 MEQ/ML / sodium gluconate 5.02 MG/ML Injectable Solution [Normosol-R in 5 % Dextrose]', 'dextrose', '[\"glucose\", \"sodium acetate\", \"sodium gluconate\", \"magnesium chloride\", \"potassium chloride\", \"sodium chloride\"]', '[\"Injectable Product\"]', '2023-12-09 14:57:59', '2023-12-09 14:57:59'),
(19, '205828', 'glipizide 5 MG Oral Tablet [Glucotrol]', 'glucotrol', '[\"glipizide\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-09 14:59:41', '2023-12-09 14:59:41'),
(20, '205830', 'glipizide 10 MG Oral Tablet [Glucotrol]', 'glucotrol', '[\"glipizide\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-09 14:59:41', '2023-12-09 14:59:41'),
(21, '865568', '24 HR glipizide 10 MG Extended Release Oral Tablet [Glucotrol]', 'glucotrol', '[\"glipizide\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-09 14:59:41', '2023-12-09 14:59:41'),
(22, '865571', '24 HR glipizide 2.5 MG Extended Release Oral Tablet [Glucotrol]', 'glucotrol', '[\"glipizide\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-09 14:59:41', '2023-12-09 14:59:41'),
(23, '865573', '24 HR glipizide 5 MG Extended Release Oral Tablet [Glucotrol]', 'glucotrol', '[\"glipizide\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-09 14:59:41', '2023-12-09 14:59:41'),
(24, '1043567', '24 HR metformin hydrochloride 1000 MG / saxagliptin 2.5 MG Extended Release Oral Tablet [Kombiglyze]', 'metformin', '[\"metformin\", \"saxagliptin\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-09 17:13:03', '2023-12-09 17:13:03'),
(25, '1043574', '24 HR metformin hydrochloride 1000 MG / saxagliptin 5 MG Extended Release Oral Tablet [Kombiglyze]', 'metformin', '[\"metformin\", \"saxagliptin\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-09 17:13:03', '2023-12-09 17:13:03'),
(26, '1043582', '24 HR metformin hydrochloride 500 MG / saxagliptin 5 MG Extended Release Oral Tablet [Kombiglyze]', 'metformin', '[\"metformin\", \"saxagliptin\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-09 17:13:03', '2023-12-09 17:13:03'),
(27, '1243026', 'linagliptin 2.5 MG / metformin hydrochloride 1000 MG Oral Tablet [Jentadueto]', 'metformin', '[\"linagliptin\", \"metformin\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-09 17:13:03', '2023-12-09 17:13:03'),
(28, '1243033', 'linagliptin 2.5 MG / metformin hydrochloride 500 MG Oral Tablet [Jentadueto]', 'metformin', '[\"linagliptin\", \"metformin\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-09 17:13:03', '2023-12-09 17:13:03'),
(29, '1148482', '24 HR tramadol hydrochloride 100 MG Extended Release Oral Capsule [ConZip]', 'tramadol', '[\"tramadol\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-09 17:17:12', '2023-12-09 17:17:12'),
(30, '1148487', '24 HR tramadol hydrochloride 200 MG Extended Release Oral Capsule [ConZip]', 'tramadol', '[\"tramadol\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-09 17:17:13', '2023-12-09 17:17:13'),
(31, '1148491', '24 HR tramadol hydrochloride 300 MG Extended Release Oral Capsule [ConZip]', 'tramadol', '[\"tramadol\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-09 17:17:13', '2023-12-09 17:17:13'),
(32, '2395814', 'tramadol hydrochloride 5 MG/ML Oral Solution [Qdolo]', 'tramadol', '[\"tramadol\"]', '[\"Oral Product\", \"Oral Liquid Product\"]', '2023-12-09 17:17:13', '2023-12-09 17:17:13'),
(33, '2588484', 'celecoxib 56 MG / tramadol hydrochloride 44 MG Oral Tablet [Seglentis]', 'tramadol', '[\"tramadol\", \"celecoxib\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-09 17:17:13', '2023-12-09 17:17:13'),
(34, '1001476', 'aspirin 325 MG Delayed Release Oral Tablet [Ecpirin]', 'aspirin', '[\"aspirin\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-11 03:54:36', '2023-12-11 03:54:36'),
(35, '1052416', 'acetaminophen 250 MG / aspirin 250 MG / caffeine 65 MG Oral Tablet [Pamprin Max Formula]', 'aspirin', '[\"aspirin\", \"acetaminophen\", \"caffeine\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-11 03:54:36', '2023-12-11 03:54:36'),
(36, '1052678', 'aspirin 81 MG Delayed Release Oral Tablet [Miniprin]', 'aspirin', '[\"aspirin\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-11 03:54:36', '2023-12-11 03:54:36'),
(37, '1053327', 'aspirin 845 MG / caffeine 65 MG Oral Powder [Stanback Headache Powder Reformulated Jan 2011]', 'aspirin', '[\"aspirin\", \"caffeine\"]', '[\"Oral Product\", \"Oral Powder Product\"]', '2023-12-11 03:54:36', '2023-12-11 03:54:36'),
(38, '1101754', 'acetaminophen 194 MG / aspirin 227 MG / caffeine 33 MG Oral Tablet [Vanquish]', 'aspirin', '[\"aspirin\", \"acetaminophen\", \"caffeine\"]', '[\"Oral Product\", \"Pill\"]', '2023-12-11 03:54:36', '2023-12-11 03:54:36');


--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test 001', 'test01@gmail.com', NULL, '$2y$10$xpXDzTXZZjgfeVxEBdpvxOI55IGLGYizjKSkMAZ13tiskFqrB8fBW', NULL, '2023-12-07 13:10:30', '2023-12-07 13:10:30'),
(3, 'Unit Test User 1', 'unittest1@gmail.com', NULL, '$2y$04$o3kNAOPzSRoS9jo9EcOR0uLiSgBBG95ST0n9/ZXoQ2xrJRk/Svf3a', NULL, '2023-12-09 19:26:04', '2023-12-09 19:26:04');

--
-- Dumping data for table `users_medications`
--

INSERT INTO `users_medications` (`id`, `user_id`, `medication_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, '2023-12-09 13:26:55', '2023-12-09 13:26:55', NULL),
(3, 1, 19, '2023-12-09 15:18:00', '2023-12-09 15:18:00', NULL),
(4, 1, 14, '2023-12-09 15:42:23', '2023-12-09 15:42:23', NULL),
(5, 1, 8, '2023-12-09 15:42:46', '2023-12-09 15:42:46', NULL),
(6, 1, 5, '2023-12-09 16:03:56', '2023-12-09 16:03:56', NULL),
(7, 1, 4, '2023-12-09 16:06:46', '2023-12-09 16:18:09', '2023-12-09 16:18:09');
COMMIT;
