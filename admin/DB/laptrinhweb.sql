-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2024 at 04:16 PM
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
-- Database: `laptrinhweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `actors`
--

CREATE TABLE `actors` (
  `actors_id` int(11) NOT NULL,
  `actor_name` varchar(100) NOT NULL,
  `actors_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `actors`
--

INSERT INTO `actors` (`actors_id`, `actor_name`, `actors_image`) VALUES
(1, 'Dylan Minnettee', './uploads/actors/DylanMinnettee.jpg'),
(2, 'Katherine Langford', './uploads/actors/KatherineLangford.jpg'),
(3, 'Christian Navarro', './uploads/actors/ChristianNavarro.jpg'),
(4, 'Connie Nielsen', './uploads/actors/ConnieNielsen.jpg'),
(5, 'Paul Mescal', './uploads/actors/PaulMescal.jpg'),
(6, 'Pedro Pascal', './uploads/actors/PedroPascal.jpg'),
(7, 'Kit Connor', './uploads/actors/KitConnor.jpg'),
(8, 'Tom Hardy', './uploads/actors/TomHardy.jpg'),
(9, 'Chiwetel Ejiofor', './uploads/actors/ChiwetelEjiofor.jpg'),
(10, 'Juno Temple', './uploads/actors/JunoTemple.jpg'),
(11, 'Aaron Pierre', ''),
(12, 'Kelvin Harrison', ''),
(13, 'Jr.Seth Rogen', ''),
(14, 'Ben Schwartz', ''),
(15, 'Colleen O\'Shaughnessey', ''),
(16, 'Idris Elba', ''),
(17, 'Lupita Nyong\'o', ''),
(18, 'Jack Black', ''),
(19, 'Emma Myers', ''),
(20, 'Jemaine Clement', ''),
(21, 'Colleen O\'Shaughnessey', ''),
(22, 'Harrison Ford', ''),
(23, 'Rosa Salazar', ''),
(24, 'Liv Tyler', ''),
(25, 'Kevin Alejandro', ''),
(26, 'Hailee Steinfeld', ''),
(27, 'Terri Douglas', ''),
(28, 'Tim Robbins', ''),
(29, 'Morgan Freeman', ''),
(30, 'Bob Gunton', ''),
(31, 'Brad Pitt', ''),
(32, 'Edward Norton', ''),
(33, 'Meat Loaf', ''),
(34, 'Song Kang-ho', ''),
(35, 'Lee Sun-kyun', ''),
(36, 'Cho jeo-yeong', ''),
(37, 'Karl Urban', ''),
(38, 'JackQuaid', ''),
(39, 'Antony Starr', ''),
(40, 'Bryan Cranston', ''),
(41, 'Aaron Paul', ''),
(42, 'Anna Gunn', ''),
(43, 'Colin Farell', ''),
(44, 'Cristin Milioti', ''),
(45, 'Rhenzy Feliz', ''),
(46, 'Emilia Clarke', ''),
(47, 'Peter Dinklage', ''),
(48, 'Kit Harington', ''),
(49, 'Steven Yeun', ''),
(50, 'J.K Simmons', ''),
(51, 'Sandra Oh', ''),
(52, 'Michael C. Hall', ''),
(53, 'Jennifer Carpenter', ''),
(54, 'David Zayas', ''),
(55, 'Issei Futamata', ''),
(56, 'Megumi Han', ''),
(57, 'Cristina Valenzuela', ''),
(58, 'Rowan Atkinson', ''),
(59, 'Matilda Ziegler', ''),
(60, 'Robin Driscoll', '');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genres_id` int(11) NOT NULL,
  `genres_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`genres_id`, `genres_name`) VALUES
(1, 'Action'),
(20, 'Adult Animation'),
(14, 'Animation'),
(2, 'Comedy'),
(18, 'Crime'),
(19, 'Dark Fantasy'),
(3, 'Drama'),
(13, 'Fantasy'),
(4, 'Horror'),
(5, 'Romance'),
(6, 'Sci-Fi'),
(21, 'Serial Killer'),
(22, 'Sitcom'),
(17, 'Superhero'),
(7, 'Thriller');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `movie_name` varchar(255) NOT NULL,
  `release_date` int(10) DEFAULT NULL,
  `movie_desc` text DEFAULT NULL,
  `director` varchar(100) DEFAULT NULL,
  `movie_image` varchar(255) DEFAULT NULL,
  `trailer_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `genres_id` int(11) NOT NULL,
  `actors_id` varchar(255) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `movie_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `movie_name`, `release_date`, `movie_desc`, `director`, `movie_image`, `trailer_url`, `created_at`, `updated_at`, `genres_id`, `actors_id`, `duration`, `movie_type`) VALUES
(17, 'Gladiator II', 2024, 'After his home is conquered by the tyrannical emperors who now lead Rome, Lucius is forced to enter the Colosseum and must look to his past to find strength to return the glory of Rome to its people.', 'Ridley Scott', './uploads/847215.jpg', 'https://www.youtube.com/embed/4rgYUipGJNo', '2024-11-10 04:32:54', '2024-11-17 11:44:33', 1, '21,22,23', '', 'isMovie'),
(18, 'Captain America: Brave New World', 2025, 'Sam Wilson, who\\\'s officially taken up the mantle of Captain America, finds himself in the middle of an international incident.', 'Julius Onah', './uploads/922007.jpg', 'https://www.youtube.com/embed/1pHDWnXmK7Y', '2024-11-10 04:32:54', '2024-11-15 13:50:05', 1, '41,42,43', '', 'isMovie'),
(19, 'A Minecraft Movie', 2025, 'The malevolent Ender Dragon sets out on a path of destruction, prompting a young girl and her group of unlikely adventurers to set out to save the Overworld.', 'Jared Hess', './uploads/494542.jpg', 'https://www.youtube.com/embed/PE2YZhcC4NY', '2024-11-10 04:32:54', '2024-11-17 14:26:38', 13, '37,38,39', '', 'isMovie'),
(20, 'Venom: The Last Dance', 2024, 'Eddie and Venom, on the run, face pursuit from both worlds. As circumstances tighten, they\\\'re compelled to make a heart-wrenching choice that could mark the end of their symbiotic partnership.', 'Kelly Marcel', './uploads/702790.jpg', 'https://www.youtube.com/embed/__2bjWbetsA', '2024-11-10 04:32:54', '2024-11-17 14:26:38', 1, '27,28,29', '1h 50m', 'isMovie'),
(21, 'The Wild Robot', 2024, 'To survive the harsh environment, Roz bonds with the island\\\'s animals and cares for an orphaned baby goose.', 'Chris Sanders', './uploads/743012.jpg', 'https://www.youtube.com/embed/67vbA5ZJdKQ', '2024-11-10 04:32:54', '2024-11-17 14:26:38', 14, '36,23,26', '1h 42m', 'isMovie'),
(31, 'Mufasa: The Lion King', 2024, 'Simba, having become king of the Pride Lands, is determined for his cub to follow in his paw prints while the origins of his late father Mufasa are explored.', 'Barry Jenkins', './uploads/477862.jpg', 'https://www.youtube.com/embed/o17MF9vnabg', '2024-11-11 13:43:47', '2024-11-17 14:27:48', 14, '30,31,32', '2h', 'isMovie'),
(32, 'Sonic 3', 2024, 'Sonic, Knuckles, and Tails reunite against a powerful new adversary, Shadow, a mysterious villain with powers unlike anything they have faced before. With their abilities outmatched, Team Sonic must seek out an unlikely alliance.', 'Jeff Fowler', './uploads/164845.jpg', 'https://www.youtube.com/embed/qSu6i2iFMO0', '2024-11-11 14:04:28', '2024-11-17 14:28:39', 13, '33,40,35', '', 'isMovie'),
(45, '13 Reasons why', 2017, 'Follows teenager Clay Jensen, in his quest to uncover the story behind his classmate and crush, Hannah, and her decision to end her life.', 'Brian Yorkey', './uploads/13reasonswhy.jpg', 'https://www.youtube.com/embed/QkT-HIMSrRk', '2024-11-16 07:56:41', '2024-11-17 14:30:02', 3, '1,2,3', '2017-2020 - 49 episodes', 'isTVShow'),
(49, 'The Shawshank Redemption', 1994, 'A banker convicted of uxoricide forms a friendship over a quarter century with a hardened convict, while maintaining his innocence and trying to remain hopeful through simple compassion.', 'Frank Darabont', './uploads/shawshank.jpg', 'https://www.youtube.com/embed/PLl99DlL6b4', '2024-11-17 13:22:28', '2024-11-17 14:30:41', 3, '54,55,56', '2h 22m', 'isMovie'),
(50, 'Fight Club', 1999, 'An insomniac office worker and a devil-may-care soap maker form an underground fight club that evolves into much more.', 'David Fincher', './uploads/fightclub.jpg', 'https://www.youtube.com/embed/O1nDozs-LxI', '2024-11-17 13:24:59', '2024-11-17 14:32:13', 3, '57,58,59', '2h 19m', 'isMovie'),
(52, 'Parasite', 2019, 'Greed and class discrimination threaten the newly formed symbiotic relationship between the wealthy Park family and the destitute Kim clan.', 'Bong Joon Ho', './uploads/parasite.jpg', 'https://www.youtube.com/embed/5xH0HfJHsaY', '2024-11-17 13:28:09', '2024-11-17 14:33:27', 7, '60,61,62', '2h 12m', 'isMovie'),
(54, 'Arcane 2', 2024, 'Set in Utopian Piltover and the oppressed underground of Zaun, the story follows the origins of two iconic League of Legends champions and the power that will tear them apart.', '', './uploads/arcane2.jpg', 'https://www.youtube.com/embed/hsffPST-x1k', '2024-11-17 13:33:28', '2024-11-17 14:34:25', 14, '51,52,53', '2021-2024 - 18 episodes', 'isTVShow'),
(55, 'The Boys', 2019, 'A group of vigilantes set out to take down corrupt superheroes who abuse their superpowers.', 'Eric Kripke', './uploads/theboys3.jpg', 'https://www.youtube.com/embed/EzFXDvC-EwM', '2024-11-17 13:38:37', '2024-11-17 14:34:56', 17, '63,64,65', '40 episodes', 'isTVShow'),
(56, 'Breaking Bad', 2008, 'A chemistry teacher diagnosed with inoperable lung cancer turns to manufacturing and selling methamphetamine with a former student to secure his family\'s future.', 'Vince Gilligan', './uploads/breakingbad.jpg', 'https://www.youtube.com/embed/HhesaQXLuRY', '2024-11-17 13:41:08', '2024-11-17 14:35:43', 18, '66,67,68', '2008-2013 62episodes', 'isTVShow'),
(57, 'The Penguin', 2024, 'Following the events of The Batman (2022), Oz Cobb, a.k.a. the Penguin, makes a play to seize the reins of the crime world in Gotham.', 'Lauren LeFranc', './uploads/penguin.jpg', 'https://www.youtube.com/embed/sfJG6IiA_s8', '2024-11-17 13:43:08', '2024-11-17 14:36:35', 18, '69,70,71', '8 episodes', 'isTVShow'),
(58, 'Game of Thrones', 2011, 'Nine noble families fight for control over the lands of Westeros, while an ancient enemy returns after being dormant for millennia.', 'David Benioff', './uploads/gameofthrones.jpg', 'https://www.youtube.com/embed/KPLWWIOCOOQ', '2024-11-17 13:46:30', '2024-11-17 14:37:15', 19, '72,73,74', '2011-2019 - 74 episodes', 'isTVShow'),
(59, 'Invincible', 2021, 'An adult animated series based on the Skybound/Image comic about a teenager whose father is the most powerful superhero on the planet.', '', './uploads/invincible.jpg', 'https://www.youtube.com/embed/tyqiQWxPz0c', '2024-11-17 13:50:14', '2024-11-17 14:38:00', 20, '75,76,77', '23 episodes', 'isTVShow'),
(60, 'Dexter', 2006, 'He\'s smart. He\'s lovable. He\'s Dexter Morgan, America\'s favorite serial killer, who spends his days solving crimes and his nights committing them.', 'James Manos Jr', './uploads/dexter.jpg', 'https://www.youtube.com/embed/mzUx1hyL-yk', '2024-11-17 13:57:17', '2024-11-17 14:39:14', 21, '78,79,80', '2006-2013 96 episodes', 'isTVShow'),
(61, 'Hunter x Hunter', 2011, 'Gon Freecss aspires to become a Hunter, an exceptional being capable of greatness. With his friends and his potential, he seeks out his father, who left him when he was younger.', 'Yoshihiro Togashi', './uploads/hunterxhunter.jpg', 'https://www.youtube.com/embed/d6kBeJjTGnY', '2024-11-17 14:00:39', '2024-11-17 14:41:04', 20, '81,82,83', '2011-2014 148 episodes', 'isTVShow'),
(62, 'Mr. Bean', 1990, 'Rowan Atkinson, Matilda Ziegler, Robin Driscoll', '', './uploads/mrbean.jpg', 'https://www.youtube.com/embed/hSxLUd8aly4', '2024-11-17 14:06:11', '2024-11-17 14:41:46', 22, '84,85,86', '1990-1995 15 episodes', 'isTVShow');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `source` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `image_url`, `source`, `created_at`) VALUES
(1, 'Disney Removes ‘Star Wars’ Movie From 2026 Slate, Replaced by ‘Ice Age 6’', 'Disney has removed an untitled “Star Wars” film previously scheduled for Dec. 18, 2026 from its release calendar. “Ice Age 6” will move into its spot.\r\n\r\nWhile it was never confirmed exactly what this project would be, Sharmeen Obaid-Chinoy was previously announced as the director of an upcoming “Star Wars” film following Daisy Ridley’s Rey after the events of 2019’s “Star Wars: The Rise of Skywalker.” The film lost screenwriter Steven Knight earlier this year (after Damon Lindelof and Justin Britt-Gibson previously departed the project). Lucasfilm president Kathleen Kennedy said at last year’s Star Wars Celebration that Ridley’s new film would follow Rey as she builds a new Jedi Order.\r\n\r\nIt wouldn’t be the first time a potential entry in the beloved space opera franchise ended before it began: new installments from director Patty Jenkins, Marvel producer Kevin Feige, “The Last Jedi” director Rian Johnson and “Game of Thrones...', './uploads/news/star_wars.webp', 'https://variety.com/2024/film/news/star-wars-removed-2026-ice-age-6-1236211852/', '2024-11-17 05:38:45'),
(2, 'Box Office: ‘Red One’ Makes $3.7 Million in Previews', 'Halloween is over, so that means it’s time for the Christmas season — and Dwayne Johnson is here to usher in the yuletide early with “Red One.”\r\n\r\nHis Christmas action movie with Chris Evans has made $3.7 million at the box office so far in Thursday previews. The Amazon MGM film is on track to make between $30 million and $35 million, with some projections lower at $25 million and others as high as $40 million. With a massive budget of $250 million, plus marketing costs, it’ll take a Christmas miracle for “Red One” to become a profitable hit at the box office. However, Amazon MGM is also focused on driving people to its Amazon Prime Video streaming service (where “Red One” will later land), so box office grosses aren’t as high on the deep-pocketed company’s wish list.\r\n\r\nJohnson, who also produced “Red One” through his Seven Bucks production company, is reteaming with...', './uploads/news/one_movie.jpg', 'https://variety.com/2024/film/box-office/box-office-red-one-previews-1236211220/', '2024-11-17 05:42:12'),
(3, 'Zack Snyder to Direct LAPD Action Thriller at Netflix', 'Zack Snyder is set to direct a new feature film for Netflix, centered around the Los Angeles Police Department. He is co-writing the script for the currently untitled action film with frequent collaborator Kurt Johnstad.\r\n\r\nThe project, which is in early development at the streamer, is produced by Deborah Snyder, Zack Snyder and Wesley Coller for Stone Quarry.\r\n\r\n“In the high-stakes world of life and death, an elite LAPD unit are relentlessly confronted with the unforgiving collision of law and morality,” the film’s official logline reads.\r\n\r\n“Years ago, Dan Lin and I had a conversation about our shared interest in telling a compelling and visceral character-driven story set within the intense, complex and captivating landscape of the LAPD,” Zack Snyder said in a statement. “It’s a conversation that has stuck with me. So, as you would expect, I’m very excited to now have the opportunity to partner with Dan,...', './uploads/news/zack_snyder.jpg', 'https://variety.com/2024/film/news/zack-snyder-netflix-lapd-movie-1236211622/', '2024-11-17 05:45:28'),
(4, 'Glen Powell’s Advice to Those Struggling in Hollywood: ‘You Sort of Have to Lie to Yourself’', '2024 has not been the best of years for Hollywood. In fact, by many metrics, it’s been one of the worst, but in Glen Powell’s opinion, that’s just par for the course. Speaking to Vanity Fair for this year’s Hollywood Issue, Powell reflected on his own experience facing the lean times the artist’s life is often exposed to and forcing himself to see the light at the end of the tunnel.\r\n\r\n“Even at the darkest moments in that town, when I really didn’t have anything happening, you sort of have to lie to yourself, at least a little bit, and act like this is that chapter of the story where things just aren’t going right,” said Powell. “You have to believe in the Hollywood legends of those people that you admire, the people that you’re chasing, that had those long stretches of famine as well.', './uploads/news/Glen_Powell.jpg', 'https://www.indiewire.com/news/general-news/glen-powell-advice-hollywood-lie-to-yourself-1235066525/', '2024-11-17 05:52:10'),
(5, 'The Original Gilligan\'s Island Castaways Included Two Very Different Characters', '60 years ago, \"Gilligan\'s Island\" blessed the world with an ensemble seemingly fashioned by the gods. Bob Denver as Gilligan, Alan Hale Jr. as the Skipper, Russell Johnson as the Professor, Jim Backus as Thurston Howell III, Natalie Schafer as Eunice Howell, Dawn Wells as Mary Ann, and Tina Louise as Ginger. They are immortalized in the theme song, and ironclad comedic types thanks to the reinforcement of syndication. \"Gilligan\'s Island\" was always meant to be, and we must consider ourselves fortunate that we lived to behold its goofball majesty.\r\n\r\nSo prepare to be shocked. When the \"Gilligan\'s Island\" pilot went before cameras, Sherwood Schwartz hadn\'t yet fully communed with the comedy gods. In terms of the castaways, he had five out of seven figured out. Where he\'d yet to strike gold was with the young female characters. Schwartz had a very different notion of how to give the show the...', './uploads/news/Gilligan_island.webp', 'https://www.slashfilm.com/1713023/gilligans-island-original-castaways-different-characters-secretaries/https://www.slashfilm.com/1713023/gilligans-island-original-castaways-different-characters-secretaries/', '2024-11-17 06:28:29');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL CHECK (`rating` >= 0 and `rating` <= 10),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `user_id`, `movie_id`, `rating`, `created_at`) VALUES
(1, 2, 17, 5.0, '2024-11-10 17:27:28'),
(2, 2, 19, 7.0, '2024-11-13 00:57:41'),
(3, 2, 18, 7.0, '2024-11-13 01:09:56'),
(4, 1, 32, 8.0, '2024-11-14 07:16:39'),
(5, 1, 19, 9.9, '2024-11-16 07:00:39'),
(6, 1, 20, 7.0, '2024-11-16 07:31:56');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `review_text` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tokenlogin`
--

CREATE TABLE `tokenlogin` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `forgotToken` varchar(100) DEFAULT NULL,
  `activeToken` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `isAdmin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `phone`, `password`, `forgotToken`, `activeToken`, `status`, `create_at`, `update_at`, `isAdmin`) VALUES
(1, 'lyduong', 'lyhue4321@gmail.com', '0908969499', '$2y$10$mHKzIZJKLFQD/JvM21uU6.Q/Qsgm5ysw4IB/yiXaMoXE8xkB1/05i', NULL, '792d08709a09fad0806793e99c24d30494d70830', 0, '2024-11-09 19:05:03', NULL, 0),
(2, 'lyduong', 'lyduong4321@gmail.com', '0908929499', '$2y$10$U9gxYHpdy/Kf3asneTKMwOaEj4I8I2oDaelUeSd0tZ3oBMNUb0wfm', NULL, 'f24a74ba7e090f75e52cf4cb4878e604ef5f1daf', 0, '2024-11-10 18:24:33', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `watchlist`
--

CREATE TABLE `watchlist` (
  `watch_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `watchlist`
--

INSERT INTO `watchlist` (`watch_id`, `user_id`, `movie_id`) VALUES
(2, 1, 18),
(8, 1, 19);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`actors_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genres_id`),
  ADD UNIQUE KEY `name` (`genres_name`) USING BTREE;

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`),
  ADD KEY `genres_id` (`genres_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tokenlogin`
--
ALTER TABLE `tokenlogin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `watchlist`
--
ALTER TABLE `watchlist`
  ADD PRIMARY KEY (`watch_id`),
  ADD KEY `watchlist_ibfk_1` (`user_id`),
  ADD KEY `watchlist_ibfk_2` (`movie_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actors`
--
ALTER TABLE `actors`
  MODIFY `actors_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genres_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tokenlogin`
--
ALTER TABLE `tokenlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `watchlist`
--
ALTER TABLE `watchlist`
  MODIFY `watch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_genres` FOREIGN KEY (`genres_id`) REFERENCES `genres` (`genres_id`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE CASCADE;

--
-- Constraints for table `tokenlogin`
--
ALTER TABLE `tokenlogin`
  ADD CONSTRAINT `tokenlogin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `watchlist`
--
ALTER TABLE `watchlist`
  ADD CONSTRAINT `watchlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `watchlist_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
