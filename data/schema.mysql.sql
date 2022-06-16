
set names 'utf8';

-- User Details Posts
DROP TABLE IF EXISTS `userdetails`;

CREATE TABLE `userdetails` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT, 
  `name` varchar(250) NOT NULL UNIQUE,     -- NAME UNIQUE
  `description` text(5000) NOT NULL,          -- Text
  `image` varchar(250)  NOT NULL,        -- Image
  `ip_dddress` varchar(50) NOT NULL,       -- User's ID of Author
  `date_created` DATETIME          -- Creation date
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='utf8_general_ci';

