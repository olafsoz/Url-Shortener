CREATE TABLE `url` (
    `id` int NOT NULL AUTO_INCREMENT,
    `longUrl` varchar(255) NOT NULL,
    `shortUrl` varchar(255) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `shortUrl` (`shortUrl`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
