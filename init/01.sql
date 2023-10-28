-- MySQL dump 10.13  Distrib 8.1.0, for Linux (aarch64)
--
-- Host: localhost    Database: wbd_database
-- ------------------------------------------------------
-- Server version	8.1.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `actor`
--

DROP TABLE IF EXISTS `actor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `actor` (
  `actor_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `description` text,
  `img_path` varchar(255) NOT NULL,
  PRIMARY KEY (`actor_id`),
  UNIQUE KEY `actor_id` (`actor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actor`
--

LOCK TABLES `actor` WRITE;
/*!40000 ALTER TABLE `actor` DISABLE KEYS */;
INSERT INTO `actor` VALUES (1,'Daniel Radcliffe','1989-07-23','Daniel Radcliffe is an English actor best known for his role as Harry Potter in the Harry Potter film series.','daniel_radcliffe.jpeg'),(2,'Emma Watson','1990-04-15','Emma Watson is an English actress known for her role as Hermione Granger in the Harry Potter film series.','emma_watson.jpg'),(3,'Rupert Grint','1988-08-24','Rupert Grint is an English actor known for his role as Ron Weasley in the Harry Potter film series.','rupert_grint.jpeg'),(4,'Robert Downey Jr.','1965-04-04','Robert Downey Jr. is an American actor known for portraying Tony Stark / Iron Man in the Marvel Cinematic Universe.','robert_downey_jr.jpeg'),(5,'Chris Evans','1981-06-13','Chris Evans is an American actor known for his role as Steve Rogers / Captain America in the Marvel Cinematic Universe.','chris_evans.jpeg'),(6,'Mark Ruffalo','1967-11-22','Mark Ruffalo is an American actor known for playing Bruce Banner / Hulk in the Marvel Cinematic Universe.','mark_ruffalo.jpeg'),(7,'Guy Pearce','1967-10-05','Guy Pearce is an English-Australian actor known for his roles in films like Memento.','guy_pearce.jpeg'),(8,'Leonardo DiCaprio','1974-11-11','Leonardo DiCaprio is an American actor known for his roles in films like Inception.','leonardo_dicaprio.jpeg'),(9,'Christian Bale','1974-01-30','Christian Bale is an English actor known for his portrayal of Batman in Christopher Nolan\'s The Dark Knight Trilogy.','christian_bale.jpeg'),(10,'Carrie-Anne Moss','1967-08-21','Carrie-Anne Moss is a Canadian actress known for her role in Memento.','carrie-anne_moss.jpg'),(11,'Joe Pantoliano','1951-09-12','Joe Pantoliano is an American actor known for his role in Memento.','joe_pantoliano.jpg'),(12,'Joseph Gordon-Levitt','1981-02-17','Joseph Gordon-Levitt is an American actor known for his role in Inception.','joseph_gordon-levitt.jpeg'),(13,'Ellen Page','1987-02-21','Ellen Page is a Canadian actress known for her role in Inception.','ellen_page.jpeg'),(14,'Heath Ledger','1979-04-04','Heath Ledger was an Australian actor known for his iconic portrayal of The Joker in The Dark Knight.','heath_ledger.jpeg'),(15,'Anne Hathaway','1982-11-12','Anne Hathaway is an American actress known for her role as Selina Kyle / Catwoman in The Dark Knight Rises.','anne_hathaway.jpeg'),(16,'Greta Lee','2009-02-03','Greta Jiehan Lee (born March 7, 1983) is an American actress who is best known for starring as Maxine in the Netflix comedy-drama series.','images.jpeg'),(17,'Yoo Teo','1995-08-07','Yoo Teo is a Korean actor and director. He began acting when studying at the Lee Strasberg Theater and Film Institute.','licensed-image.jpeg');
/*!40000 ALTER TABLE `actor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Action'),(2,'Adventure'),(3,'Animation'),(4,'Biography'),(5,'Comedy'),(6,'Documentary'),(7,'Drama'),(8,'Family'),(9,'Fantasy'),(10,'Horror'),(11,'Mystery'),(12,'Romance'),(13,'Sci-Fi'),(14,'Thriller'),(15,'War');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `director`
--

DROP TABLE IF EXISTS `director`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `director` (
  `director_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `description` text,
  `img_path` varchar(255) NOT NULL,
  PRIMARY KEY (`director_id`),
  UNIQUE KEY `director_id` (`director_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `director`
--

LOCK TABLES `director` WRITE;
/*!40000 ALTER TABLE `director` DISABLE KEYS */;
INSERT INTO `director` VALUES (1,'Chris Columbus','1958-09-10','Chris Columbus is an American film director and producer known for directing the first two Harry Potter films.','chris_columbus.jpg'),(2,'Alfonso Cuarón','1961-11-28','Alfonso Cuarón is a Mexican film director and screenwriter known for directing Harry Potter and the Prisoner of Azkaban.','alfonso_cuarn.jpeg'),(3,'Mike Newell','1942-03-28','Mike Newell is an English director and producer known for directing Harry Potter and the Goblet of Fire.','mike_newell.jpg'),(4,'David Yates','1963-11-30','David Yates is an English film director known for directing the final four Harry Potter films.','david_yates.jpeg'),(5,'Joss Whedon','1964-06-23','Joss Whedon is an American filmmaker known for directing The Avengers and Avengers: Age of Ultron.','joss_whedon.jpeg'),(6,'Anthony Russo','1970-02-03','Anthony Russo is an American director known for helming Avengers: Infinity War and other films.','anthony_russo.jpeg'),(7,'Joe Russo','1971-07-08','Joe Russo is an American director known for helming Avengers: Infinity War and other films.','joe_russo.jpg'),(8,'Christopher Nolan','1970-07-30','Christopher Nolan is a British-American filmmaker known for directing films like Inception and The Dark Knight Trilogy.','christopher_nolan.jpeg'),(10,'Celine Song','1978-03-03','Celine Song is a South Korean-Canadian director, playwright, and screenwriter based in the United States. Among her plays are Endlings and The Seagull on The Sims 4.','licensed-image-2.jpeg');
/*!40000 ALTER TABLE `director` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movie`
--

DROP TABLE IF EXISTS `movie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movie` (
  `movie_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `year` int NOT NULL,
  `duration` time NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `trailer_path` varchar(255) NOT NULL,
  PRIMARY KEY (`movie_id`),
  UNIQUE KEY `movie_id` (`movie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movie`
--

LOCK TABLES `movie` WRITE;
/*!40000 ALTER TABLE `movie` DISABLE KEYS */;
INSERT INTO `movie` VALUES (1,'Harry Potter and the Sorcerer\'s Stone','An orphaned boy enrolls in a school of wizardry, where he learns the truth about himself, his family and the terrible evil that haunts the magical world.',2001,'02:32:00','hp_img_1.jpg','hp_trailer_1.mp4'),(2,'Harry Potter and the Chamber of Secrets','Harry Potter returns to Hogwarts for his second year and faces the mystery behind attacks by mysterious creatures threatening students.',2002,'02:41:00','hp_img_2.jpg','hp_trailer_2.mp4'),(3,'Harry Potter and the Prisoner of Azkaban','Harry Potter must escape the threat of an escaped prisoner while attending his third year at Hogwarts.',2004,'02:21:00','hp_img_3.jpg','hp_trailer_3.mp4'),(4,'Harry Potter and the Goblet of Fire','Harry Potter participates in the dangerous Triwizard Tournament as Voldemort begins to rise again.',2005,'02:37:00','hp_img_4.jpg','hp_trailer_4.mp4'),(5,'Harry Potter and the Order of the Phoenix','Harry Potter leads the effort against Voldemort when the government neglects him, and Hogwarts is taken over by Dolores Umbridge.',2007,'00:00:00','hp_img_5.jpg','hp_trailer_5.mp4'),(6,'Harry Potter and the Half-Blood Prince','Harry Potter uncovers the mystery behind Voldemort\'s Horcruxes while preparing for the final battle.',2009,'02:33:00','hp_img_6.jpg','hp_trailer_6.mp4'),(7,'Harry Potter and the Deathly Hallows - Part 1','Harry, Ron, and Hermione embark on a quest to destroy Voldemort\'s remaining Horcruxes while evading pursuit by Death Eaters.',2010,'02:26:00','hp_img_7.jpg','hp_trailer_7.mp4'),(8,'Harry Potter and the Deathly Hallows - Part 2','The epic final battle between Harry Potter and his allies against Voldemort and his forces concludes a long-standing conflict.',2011,'02:10:00','hp_img_8.jpg','hp_trailer_8.mp4'),(9,'The Avengers','Different Marvel heroes come together to combat the threat of Loki and the Chitauri invasion.',2012,'02:23:00','avg_img_1.jpg','avg_trailer_1.mp4'),(10,'Avengers: Age of Ultron','The Avengers confront Ultron, an artificial intelligence determined to destroy humanity.',2015,'02:21:00','avg_img_2.jpg','avg_trailer_2.mp4'),(11,'Avengers: Infinity War','The Avengers strive to stop Thanos as he seeks to collect the Infinity Stones for his nefarious purposes.',2018,'02:29:00','avg_img_3.jpg','avg_trailer_3.mp4'),(12,'Avengers: StartGame','The Avengers attempt to reverse Thanos\' actions and restore balance to the universe.',2019,'03:02:00','avg_img_4.jpeg','avg_trailer_4.mp4'),(13,'Memento','A man suffering from short-term memory loss tries to solve a murder mystery with the help of notes he leaves for himself.',2000,'01:53:00','cn_img_1.jpg','cn_trailer_1.mp4'),(14,'Inception','A skilled thief who specializes in stealing information from people\'s minds is involved in a dangerous mission to implant an idea into someone else\'s mind.',2010,'02:28:00','cn_img_2.jpg','cn_trailer_2.mp4'),(15,'Batman Begins','The origin story of Batman as he begins his crusade against crime in Gotham City.',2005,'02:20:00','cn_img_3.jpg','cn_trailer_3.mp4'),(16,'The Dark Knight','Batman faces the chaotic Joker as he tries to bring down Gotham City\'s criminal underworld.',2008,'02:32:00','cn_img_4.jpg','cn_trailer_4.mp4'),(17,'The Dark Knight Rises','Batman returns to face the formidable Bane, who seeks to destroy Gotham City.',2012,'02:44:00','cn_img_5.jpg','cn_trailer_5.mp4'),(19,'Oppenheimer','The story of J. Robert Oppenheimer’s role in the development of the atomic bomb during World War II.',2023,'03:50:00','Oppenheimer-poster.jpg','Oppenheimer | Trinity Test.mp4'),(20,'Past Lives','Nora and Hae Sung, two deeply connected childhood friends, are wrest apart after Nora’s family emigrates from South Korea. 20 years later, they are reunited for one fateful week as they confront notions of love and destiny.',2023,'05:00:00','MV5BNDk5MDA2YTUtYWMwZi00MDk0LWIwOWYtMTc2ZTVjNDk4MmMxXkEyXkFqcGdeQXVyMTQzNTA5MzYz._V1_.jpg','Past Lives | What If? | Official Clip HD | A24.mp4'),(21,'Materialists','The next feature film from Celine Song. Plot TBA.',2023,'04:50:00','1024562-materialists-0-230-0-345-crop.jpg','Past Lives | What If? | Official Clip HD | A24.mp4'),(22,'Aftersun','Sophie reflects on the shared joy and private melancholy of a holiday she took with her father twenty years earlier. Memories real and imagined fill the gaps between miniDV footage as she tries to reconcile the father she knew with the man she didn’t.',2022,'05:09:00','Aftersun.jpg','Aftersun | I\'m Her Dad Though, Actually | Official Clip HD | A24.mp4'),(23,'The French Dispatch','The staff of a European publication decides to publish a memorial edition highlighting the three best stories from the last decade: an artist sentenced to life imprisonment, student riots, and a kidnapping resolved by a chef.',2021,'06:40:00','MV5BNmQxZTNiODYtNzBhYy00MzVlLWJlN2UtNTc4YWZjMDIwMmEzXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_.jpg','frenchdispatch.mp4'),(24,'Hotarubi no Mori e','One hot summer day a little girl gets lost in an enchanted forest of the mountain god where spirits reside. A young boy appears before her, but she cannot touch him for fear of making him disappear. And so a wondrous adventure awaits…',2011,'06:38:00','images-2.jpeg','Trailer Hotarubi no Mori e-2.mp4');
/*!40000 ALTER TABLE `movie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movie_actor`
--

DROP TABLE IF EXISTS `movie_actor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movie_actor` (
  `actor_id` int NOT NULL,
  `movie_id` int NOT NULL,
  KEY `movie_id` (`movie_id`),
  KEY `actor_id` (`actor_id`),
  CONSTRAINT `movie_actor_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`movie_id`) ON DELETE CASCADE,
  CONSTRAINT `movie_actor_ibfk_2` FOREIGN KEY (`actor_id`) REFERENCES `actor` (`actor_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movie_actor`
--

LOCK TABLES `movie_actor` WRITE;
/*!40000 ALTER TABLE `movie_actor` DISABLE KEYS */;
INSERT INTO `movie_actor` VALUES (1,1),(2,1),(3,1),(1,2),(2,2),(3,2),(1,3),(2,3),(3,3),(1,4),(2,4),(3,4),(1,5),(2,5),(3,5),(1,6),(2,6),(3,6),(1,7),(2,7),(3,7),(1,8),(2,8),(3,8),(4,9),(5,9),(6,9),(4,10),(5,10),(6,10),(4,11),(5,11),(6,11),(7,13),(8,14),(12,14),(13,14),(9,15),(9,16),(14,16),(9,17),(15,17),(4,12),(5,12),(6,12),(5,19),(17,20),(16,20),(10,21),(13,22),(5,23),(14,23),(5,24),(1,24);
/*!40000 ALTER TABLE `movie_actor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movie_category`
--

DROP TABLE IF EXISTS `movie_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movie_category` (
  `category_id` int NOT NULL,
  `movie_id` int NOT NULL,
  KEY `category_id` (`category_id`),
  KEY `movie_id` (`movie_id`),
  CONSTRAINT `movie_category_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE,
  CONSTRAINT `movie_category_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`movie_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movie_category`
--

LOCK TABLES `movie_category` WRITE;
/*!40000 ALTER TABLE `movie_category` DISABLE KEYS */;
INSERT INTO `movie_category` VALUES (1,1),(9,1),(1,2),(9,2),(1,3),(9,3),(1,4),(9,4),(1,5),(9,5),(1,6),(9,6),(1,7),(9,7),(1,8),(9,8),(1,9),(2,9),(1,10),(2,10),(1,11),(2,11),(1,12),(2,12),(14,13),(13,14),(7,14),(1,15),(2,15),(1,16),(14,16),(1,17),(14,17);
/*!40000 ALTER TABLE `movie_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movie_director`
--

DROP TABLE IF EXISTS `movie_director`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movie_director` (
  `director_id` int NOT NULL,
  `movie_id` int NOT NULL,
  KEY `director_id` (`director_id`),
  KEY `movie_id` (`movie_id`),
  CONSTRAINT `movie_director_ibfk_1` FOREIGN KEY (`director_id`) REFERENCES `director` (`director_id`) ON DELETE CASCADE,
  CONSTRAINT `movie_director_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`movie_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movie_director`
--

LOCK TABLES `movie_director` WRITE;
/*!40000 ALTER TABLE `movie_director` DISABLE KEYS */;
INSERT INTO `movie_director` VALUES (1,1),(1,2),(2,3),(3,4),(4,5),(4,6),(4,7),(4,8),(5,9),(5,10),(6,11),(7,11),(8,13),(8,14),(8,15),(8,16),(8,17),(6,12),(7,12),(8,19),(10,20),(10,21),(7,21),(4,22),(6,23),(8,24),(5,24),(4,24);
/*!40000 ALTER TABLE `movie_director` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movie_review`
--

DROP TABLE IF EXISTS `movie_review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movie_review` (
  `movie_id` int NOT NULL,
  `review_id` int NOT NULL,
  KEY `movie_id` (`movie_id`),
  KEY `review_id` (`review_id`),
  CONSTRAINT `movie_review_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`movie_id`) ON DELETE CASCADE,
  CONSTRAINT `movie_review_ibfk_2` FOREIGN KEY (`review_id`) REFERENCES `review` (`review_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movie_review`
--

LOCK TABLES `movie_review` WRITE;
/*!40000 ALTER TABLE `movie_review` DISABLE KEYS */;
INSERT INTO `movie_review` VALUES (1,1),(3,3),(13,12),(6,13),(4,19),(13,20);
/*!40000 ALTER TABLE `movie_review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `review` (
  `review_id` int NOT NULL AUTO_INCREMENT,
  `rate` int NOT NULL,
  `comment` text,
  `created_at` date NOT NULL,
  `is_blur_name` tinyint(1) NOT NULL,
  `update_at` date DEFAULT NULL,
  PRIMARY KEY (`review_id`),
  UNIQUE KEY `review_id` (`review_id`),
  CONSTRAINT `review_chk_1` CHECK (((`rate` >= 1) and (`rate` <= 10)))
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review`
--

LOCK TABLES `review` WRITE;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
INSERT INTO `review` VALUES (1,10,'I really enjoyed this movie. The storyline was captivating, and the acting was superb.','2023-10-03',0,'2023-10-07'),(3,9,'Fantastic film! The visual effects were amazing, and the plot was intriguing from start to finish.','2023-10-02',1,'2023-10-02'),(12,10,'Bagaimaa cara membuat film ini ','2023-10-07',1,'2023-10-07'),(13,8,'matep dumbledores polemnya, momomomomom','2023-10-07',0,'2023-10-07'),(19,9,'Filmnya bagus, sih. Cuman kurang lama aja. Adik saya nggak suka.','2023-10-09',0,'2023-10-09'),(20,2,'Posternya bagus. Tapi filmnya kelamaan deh.','2023-10-09',1,'2023-10-09');
/*!40000 ALTER TABLE `review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `User` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_h` varchar(255) NOT NULL,
  `role` varchar(30) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (10,'admin','admin@example.com','$2y$12$eRFj40ZdDA7MpUpKXom1i.pyzfvFv5KTRfArjDVmI.CzF0aU4MSUi','admin'),(11,'yobel','yobel@example.com','$2y$12$YPBnwrZWD3V4vIpixnaDHOr9DrN0xOGLTrzTuvAi55uuh12GrhC.y','user'),(12,'alisha','alisha@example.com','$2y$12$wedV.9SdA/MQryEuc04qPusJ6CWmeFgYHHQ1.M1/f9Nd93QP/E3s2','user'),(13,'rizky','rizky@example.com','$2y$12$BdegO3IgTLqKUFW.FTh0.e8fznqOY6lbh9XtJKoPAM0oH6nCDljLm','user');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_review`
--

DROP TABLE IF EXISTS `user_review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_review` (
  `review_id` int NOT NULL,
  `user_id` int NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `review_id` (`review_id`),
  CONSTRAINT `user_review_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `user_review_ibfk_2` FOREIGN KEY (`review_id`) REFERENCES `review` (`review_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_review`
--

LOCK TABLES `user_review` WRITE;
/*!40000 ALTER TABLE `user_review` DISABLE KEYS */;
INSERT INTO `user_review` VALUES (19,12),(20,12);
/*!40000 ALTER TABLE `user_review` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-09  7:03:35
