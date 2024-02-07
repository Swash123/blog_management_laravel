-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2024 at 07:09 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `content` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blog_id`, `user_id`, `title`, `photo`, `content`, `created_at`, `updated_at`) VALUES
(1, 2, 'Hello world', 'world.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur eum impedit, iste dicta ullam repellendus sed ipsa voluptatibus repudiandae animi? Fugiat, deleniti consequatur quis fuga quae voluptates eveniet odit?', '2024-01-02 07:57:45', '2024-01-02 07:57:45'),
(2, 2, 'Hello universe', 'universe.jpg', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. A hic quas temporibus perspiciatis repudiandae perferendis nihil, voluptatibus sequi dolores qui facilis ipsum possimus culpa ratione animi accusantium maxime sed! Velit, facere corporis incidunt, explicabo porro nisi animi veniam, amet nemo minus facilis quo ducimus reiciendis nostrum distinctio quam voluptates eaque?\r\nLorem ipsum dolor sit amet consectetur, adipisicing elit. Sapiente optio obcaecati dolor.', '2023-12-28 07:26:11', '2024-01-03 10:50:45'),
(3, 3, 'Hello multiverse', 'multi.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem eos dolores voluptates hic suscipit? Corrupti omnis aliquid suscipit eius est! Accusamus, autem culpa voluptates veritatis fugiat qui dolorem assumenda consequatur, facere nemo omnis placeat error iste odio dignissimos facilis est fuga modi. Odit id veritatis ipsum reiciendis voluptatum quod? Earum rerum officia asperiores voluptatum dolorum, natus aperiam ea mollitia suscipit autem hic.', '2023-12-27 11:53:59', '2023-12-27 11:53:59'),
(4, 2, 'One Direction', 'boys.jpg', 'One Direction, often shortened to 1D, are an English-Irish pop boy band formed in London in 2010. The group is composed of Niall Horan, Liam Payne, Harry Styles, Louis Tomlinson, and previously Zayn Malik until his departure from the group in March 2015. They became one of the best-selling boy groups of all time before going on an indefinite hiatus in 2016.\r\n\r\nThe group signed with Simon Cowell\'s record label Syco Records after forming and placing third in the seventh series of the British televised singing competition The X Factor in 2010. Propelled to global success by social media,[1][2][3] One Direction\'s five albums, Up All Night (2011), Take Me Home (2012), Midnight Memories (2013), Four (2014), and Made in the A.M. (2015), topped charts in several countries, and generated hit singles including \"What Makes You Beautiful\", \"Live While We\'re Young\", \"Best Song Ever\", \"Story of My Life\" and \"Drag Me Down\". After the release of Four, One Direction became the first band in the US Billboard 200 history to have their first four albums debut at number one.[4] Their third album, Midnight Memories, was the best-selling album worldwide of 2013.[5]', '2023-12-27 06:25:37', '2024-01-04 05:41:12'),
(5, 2, 'Pathao', 'pathao.jpg', 'Pathao is the biggest and most popular ride-hailing service provider in Kathmandu, it is among the fastest-growing tech startups in Asia, dedicated to develop optimal solutions for daily transportation problems of the public. It was founded in 2015 in the USA and officially started on September 24, 2018, in Kathmandu.\r\nOn 12 September 2018, Pathao announced the launch of its bike-sharing operation in Kathmandu. Several recruitment advertisements for hiring Operations managers, Marketing Managers, and Executives were also seen on Nepalese Job-Seeking Websites from August 2018. In May 2018 Pathao appointed Mr. Asheem Man Singh Basnet as the Managing Director for Nepal. Pathao Nepal launched its bike services on 24 September 2018, car services on 9 August 2019, and food services on 2 October 2020.', '2023-12-28 07:31:04', '2024-01-03 10:50:48'),
(6, 2, 'Apple', 'apple.jpg', 'Apple Inc. is a multinational technology company that has become synonymous with innovation, design excellence, and consumer electronics. Founded by Steve Jobs, Steve Wozniak, and Ronald Wayne in 1976, Apple has since evolved into one of the world\'s leading technology giants. The company is renowned for its iconic products, including the iPhone, iPad, Macintosh computers, and Apple Watch. Apple\'s commitment to seamless integration of hardware and software has created a unique ecosystem, fostering customer loyalty. In addition to hardware, Apple excels in software development, with its iOS and macOS operating systems setting industry standards. The App Store, iTunes, and Apple Music are integral parts of Apple\'s ecosystem, providing users with a comprehensive digital experience. With a focus on sustainability and corporate responsibility, Apple continues to shape the future of technology and maintain its status as a global trendsetter.', '2024-01-01 11:21:04', '2024-01-08 10:13:32'),
(7, 2, 'Drone', 'drone.jpg', 'A drone, short for unmanned aerial vehicle (UAV), is an aircraft operated without a human pilot on board. Drones can be remotely controlled by a human operator or autonomously guided using pre-programmed flight plans or built-in sensors and GPS technology. They come in various sizes and configurations, from small consumer drones used for recreational purposes and aerial photography to larger, sophisticated models employed for military reconnaissance, surveillance, and even package delivery. Drones have found applications across numerous industries, including agriculture, environmental monitoring, search and rescue, and filmmaking, offering versatile solutions that enhance efficiency and capabilities in diverse fields. Their ability to access hard-to-reach areas, gather real-time data, and perform tasks with precision has made drones increasingly integral in modern technology and innovation.', '2024-01-02 10:14:33', '2024-01-03 10:40:55'),
(8, 2, 'Tesla', 'tesla.jpg', 'Tesla, Inc. is a leading American electric vehicle (EV) and clean energy company founded by entrepreneur Elon Musk in 2003. Renowned for revolutionizing the automotive industry, Tesla is at the forefront of electric vehicle technology, producing popular models such as the Tesla Model S, Model 3, Model X, and Model Y. Known for their sleek design, high performance, and cutting-edge autonomous driving features, Tesla\'s electric cars have garnered widespread acclaim. Beyond automobiles, Tesla is actively involved in renewable energy solutions, developing solar products and energy storage solutions like the Powerwall and Powerpack. With a commitment to sustainability and innovation, Tesla continues to shape the future of transportation and energy by pushing the boundaries of technology and challenging conventional norms in the automotive and clean energy sectors.', '2024-01-03 08:23:19', '2024-01-04 05:40:51');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment` longtext NOT NULL,
  `replied_to` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `blog_id`, `user_id`, `comment`, `replied_to`, `created_at`, `updated_at`) VALUES
(1, 6, 2, 'ghjhg', NULL, '2024-01-08 10:19:00', '2024-01-08 10:19:00'),
(2, 6, 2, 'gjghjghjgh', 1, '2024-01-08 10:19:05', '2024-01-08 10:19:05'),
(3, 6, 2, 'hggfhjgf', NULL, '2024-01-08 10:19:18', '2024-01-08 10:19:18'),
(4, 6, 2, 'test', 1, '2024-01-09 07:14:13', '2024-01-09 07:14:13'),
(5, 6, 2, 'helo looooong loooong naaagai hello', NULL, '2024-01-09 07:16:29', '2024-01-09 07:16:29');

-- --------------------------------------------------------

--
-- Table structure for table `engagements`
--

CREATE TABLE `engagements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `likes` int(11) NOT NULL DEFAULT 0,
  `comments` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `engagements`
--

INSERT INTO `engagements` (`id`, `blog_id`, `views`, `likes`, `comments`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 0, 0, '2024-01-04 06:18:42', '2024-01-09 06:33:17'),
(2, 2, 5, 1, 0, '2024-01-04 06:18:47', '2024-01-08 06:25:27'),
(3, 3, 0, 0, 0, '2024-01-04 06:18:51', '2024-01-04 06:18:53'),
(4, 4, 0, 0, 0, '2024-01-04 06:18:55', '2024-01-04 06:18:57'),
(5, 5, 1, 0, 0, '2024-01-04 06:18:59', '2024-01-04 08:27:06'),
(6, 6, 206, 0, 0, '2024-01-04 06:19:03', '2024-01-14 05:53:23'),
(7, 7, 1, 1, 0, '2024-01-04 06:19:08', '2024-01-09 05:43:28'),
(8, 8, 9, 1, 0, '2024-01-04 06:19:14', '2024-01-04 07:21:04');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `blog_id`, `user_id`, `created_at`, `updated_at`) VALUES
(9, 1, 2, '2024-01-03 10:49:24', '2024-01-03 10:49:24'),
(10, 3, 2, '2024-01-03 10:49:38', '2024-01-03 10:49:38'),
(15, 2, 2, '2024-01-04 07:06:46', '2024-01-04 07:06:46'),
(16, 8, 2, '2024-01-04 07:11:14', '2024-01-04 07:11:14'),
(28, 7, 2, '2024-01-09 05:43:26', '2024-01-09 05:43:26');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(39, '2014_10_12_000000_create_users_table', 2),
(40, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(41, '2023_12_15_071618_create_blogs_table', 2),
(42, '2023_12_21_112027_create_likes_table', 2),
(43, '2023_12_22_115043_create_comments_table', 2),
(45, '2024_01_04_113136_create_engagements_table', 3),
(46, '2024_01_10_112755_alter_comments_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `role` varchar(191) NOT NULL,
  `user_token` varchar(191) DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `gender` varchar(191) NOT NULL,
  `photo` varchar(191) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `user_token`, `name`, `email`, `phone`, `gender`, `photo`, `status`, `email_verified_at`, `created_at`, `updated_at`) VALUES
(1, 'user1', '$2y$10$QLXi1RE6CsplPiJb4mWJyO4B3A/GGjcsspa8AIHuHJti.oM0bZUOO', 'admin', NULL, 'Admin', 'warriorsincognito@gmail.com', '876126', 'Male', 'default.jpg', 0, NULL, '2023-12-25 10:38:08', '2023-12-25 10:38:08'),
(2, 'user2', '$2y$10$IjjTjJpd0Ttp2nOcqmZkbuE9ZeG7rFwWWcd/xaF2fm9D1le42QcWq', 'user', NULL, 'Xyz', 'xyz@gmail.com', '986126', 'Male', 'default.jpg', 0, NULL, '2023-12-25 10:38:08', '2023-12-25 10:38:08'),
(3, 'user3', '$2y$10$a9x6xfQBFgTOv1ZY6v7rcOCh6OqjWovEJCJ9D5hER0s8u2rsfcbdK', 'user', NULL, 'ABC', 'abc@gmail.com', '984146', 'Male', 'default.jpg', 0, NULL, '2023-12-25 10:38:08', '2023-12-25 10:38:08'),
(4, 'erikhermann', '$2y$10$ysdqIXoX8BfpDAvgC6msi.femU92ibUNbYs5cWGDIthGkV6nJ7Aga', 'user', NULL, 'Tania Leuschke', 'dewitt65@yahoo.com', '(580) 635-4749', 'Male', 'default.jpg', 0, NULL, '2023-12-25 10:38:08', '2023-12-25 10:38:08'),
(5, 'babygerlach', '$2y$10$r/HIN5MZ.0lZnvBgSV/jquY5HzncIIkt90x/q4gkFW7EIPRjmLaLe', 'user', NULL, 'Prof. Mireille Roberts DVM', 'flossie45@prohaska.biz', '325-446-7325', 'Male', 'default.jpg', 0, NULL, '2023-12-25 10:38:08', '2023-12-25 10:38:08'),
(6, 'ezekiel37', '$2y$10$heSC22VLEP1EY61NWuDsdeB/7WSAHmnVMlVCb5KVtI1M73ajXUofi', 'user', NULL, 'Timmy Grant', 'pablo.wuckert@yahoo.com', '(952) 239-0215', 'Male', 'default.jpg', 0, NULL, '2023-12-25 10:38:08', '2023-12-25 10:38:08'),
(7, 'padbergmagali', '$2y$10$rkDH.HrErpqWfBE3wLXib.sVRk1oMzsag2Cajadzo6O9WFxVXptfy', 'user', NULL, 'Casper Jacobs', 'kira.schulist@yahoo.com', '+1-978-292-9304', 'Male', 'default.jpg', 0, NULL, '2023-12-25 10:38:08', '2023-12-25 10:38:08'),
(8, 'jarredcasper', '$2y$10$71jhiCJcCMaE4/iD7y5ZFeSNedO9.1tb3JyeE4zwamNxBp5E9vBya', 'user', NULL, 'Stefanie Kling', 'boyer.armando@denesik.com', '650.222.1338', 'Male', 'default.jpg', 0, NULL, '2023-12-25 10:38:08', '2023-12-25 10:38:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blog_id`),
  ADD KEY `blogs_user_id_foreign` (`user_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_blog_id_foreign` (`blog_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `engagements`
--
ALTER TABLE `engagements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `engagements_blog_id_foreign` (`blog_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_blog_id_foreign` (`blog_id`),
  ADD KEY `likes_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_user_token_unique` (`user_token`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blog_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `engagements`
--
ALTER TABLE `engagements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`blog_id`),
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `engagements`
--
ALTER TABLE `engagements`
  ADD CONSTRAINT `engagements_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`blog_id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`blog_id`),
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
