-- phpMyAdmin SQL Dump
-- version 5.1.1deb3+bionic1
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2022-10-07 05:07:47
-- 服务器版本： 8.0.28
-- PHP 版本： 7.2.24-0ubuntu0.18.04.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `forum`
--

-- --------------------------------------------------------

--
-- 表的结构 `bookmark`
--

CREATE TABLE `bookmark` (
  `post_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `date_published` date NOT NULL,
  `id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 转存表中的数据 `bookmark`
--

INSERT INTO `bookmark` (`post_id`, `title`, `date_published`, `id`, `user_id`) VALUES
(16, 'What is Hafiz known for?', '2022-05-27', 2, 57),
(24, 'A Casualty', '2022-05-27', 4, 57);

-- --------------------------------------------------------

--
-- 表的结构 `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `post_id` int DEFAULT NULL,
  `time` date DEFAULT NULL,
  `is_user` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- 表的结构 `files`
--

CREATE TABLE `files` (
  `id` int NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `uploaded_on` datetime NOT NULL,
  `status` enum('1','0') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=Active, 0=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `profile`
--

CREATE TABLE `profile` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `aboutme` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `userfile` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 转存表中的数据 `profile`
--

INSERT INTO `profile` (`id`, `user_id`, `first_name`, `last_name`, `aboutme`, `userfile`) VALUES
(19, 58, 'Tingting', 'W', 'About me', 'https://infs3202-25ead56f.uqcloud.net/forum/uploads/58.png'),
(20, 58, 'Tingting', 'W', 'About me', 'https://infs3202-25ead56f.uqcloud.net/forum/uploads/58.png'),
(21, 57, 'Tingting', 'Wu', 'ww', 'https://infs3202-25ead56f.uqcloud.net/forum/uploads/57.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `tb_posts`
--

CREATE TABLE `tb_posts` (
  `user_id` int NOT NULL,
  `id` int NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `published_date` date NOT NULL,
  `images` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 转存表中的数据 `tb_posts`
--

INSERT INTO `tb_posts` (`user_id`, `id`, `title`, `description`, `published_date`, `images`) VALUES
(0, 16, 'What is Hafiz known for?', '\r\nHafiz became a poet at the court of Abu Ishak and also taught at a religious college. He is one of the most celebrated of the Persian poets, and his influence can be felt to this day.', '2022-05-26', NULL),
(0, 17, '[Poem] eating the Cookies by Jane Kenyon', 'The cousin from Maine, knowing\r\nabout her diverticulitis, let out the nuts,\r\nso the cookies weren’t entirely to my taste,\r\nbut they were good enough; yes, good enough.\r\n\r\nEach time I emptied a drawer or shelf\r\nI permitted myself to eat one.\r\nI cleared the closet of silk caftans\r\nthat slipped easily from clattering hangers,\r\nand from the bureau I took her nightgowns\r\nand sweaters, financial documents\r\nneatly cinctured in long gray envelopes,\r\nand the hairnets and peppermints she’d tucked among\r\nLucite frames abounding with great-grandchildren,\r\nsolemn in their Christmas finery.\r\n\r\nFinally the drawers were empty,\r\nthe bags full, and the largest cookie,\r\nwhich I had saved for last, lay\r\nsolitary in the tin with a nimbus\r\nof crumbs around it. There would be no more\r\nparcels from Portland. I took it up\r\nand sniffed it, and before eating it,\r\npressed it against my forehead, because\r\nit seemed like the next thing to do.', '2022-05-26', NULL),
(0, 24, 'A Casualty', 'That boy I took in the car last night,\r\nWith the body that awfully sagged away,\r\nAnd the lips blood-crisped, and the eyes flame-bright,\r\nAnd the poor hands folded and cold as clay --\r\nOh, I\'ve thought and I\'ve thought of him all the day.', '2022-05-27', 'a:1:{i:0;s:37:\"linus-nylund-JP23z_-dA74-unsplash.jpg\";}'),
(0, 25, '123', 'bg', '2022-05-31', 'a:2:{i:0;s:34:\"Cityscapes_-_Medium_Building_3.png\";i:1;s:27:\"Cityscapes_-_Small_City.png\";}'),
(0, 26, 'a', 's', '2022-05-31', 'a:2:{i:0;s:35:\"Cityscapes_-_Medium_Building_31.png\";i:1;s:28:\"Cityscapes_-_Small_City1.png\";}'),
(0, 27, 'd', 'd', '2022-05-31', 'a:2:{i:0;s:35:\"Cityscapes_-_Medium_Building_32.png\";i:1;s:28:\"Cityscapes_-_Small_City2.png\";}');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `verification_key` varchar(125) NOT NULL,
  `is_email_vertified` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `created_at`, `verification_key`, `is_email_vertified`) VALUES
(57, 'tingting', 'wtt923620981@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2022-05-26 04:25:47', 'b10a59f077ebcf548605b9ed8b32cf9f', ''),
(58, 'tingting1', 'wtt9r23620981@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2022-05-26 04:26:51', '52a4e4e89a8607e7f1088329e0f30f3a', ''),
(59, 'tingting1234', 'wtt9236209831@gmail.com', 'a267e047602c33a7eed0d204357e4d6962f86a5a', '2022-08-17 04:39:36', 'dd192508e47913b4b7aef6f60d30e2ef', '');

--
-- 转储表的索引
--

--
-- 表的索引 `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_FK_1` (`username`);

--
-- 表的索引 `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- 表的索引 `tb_posts`
--
ALTER TABLE `tb_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_FK_1` (`user_id`);

--
-- 表的索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`username`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `bookmark`
--
ALTER TABLE `bookmark`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- 使用表AUTO_INCREMENT `files`
--
ALTER TABLE `files`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- 使用表AUTO_INCREMENT `tb_posts`
--
ALTER TABLE `tb_posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- 限制导出的表
--

--
-- 限制表 `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment_FK_1` FOREIGN KEY (`id`) REFERENCES `tb_posts` (`id`);

--
-- 限制表 `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
