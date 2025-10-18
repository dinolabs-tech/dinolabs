<?php
// Database connection settings
include('db_connect.php');

// Function to check if a table exists
function tableExists($conn, $table)
{
    $result = $conn->query("SHOW TABLES LIKE '$table'");
    return $result->num_rows > 0;
}

// Array of table creation queries
$tables = [
    'roles' => "
        CREATE TABLE `roles` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(50) NOT NULL,
            `description` text DEFAULT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `name` (`name`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ",

    'courses' => "
        CREATE TABLE `courses` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `course_name` varchar(50) NOT NULL,
            `description` text DEFAULT NULL,
            `price` int(11) NOT NULL,
            `duration` VARCHAR(50) NOT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ",

    'users' => "
        CREATE TABLE `users` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `username` varchar(50) NOT NULL,
            `password` varchar(255) NOT NULL,
            `name` varchar(255) DEFAULT NULL,
            `email` varchar(100) NOT NULL,
            `role_id` int(11) DEFAULT NULL,
            `is_admin` tinyint(1) DEFAULT 0,
            `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
            PRIMARY KEY (`id`),
            UNIQUE KEY `username` (`username`),
            UNIQUE KEY `email` (`email`),
            KEY `role_id` (`role_id`),
            CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ",

    'categories' => "
        CREATE TABLE `categories` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(50) NOT NULL,
            `description` text DEFAULT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `name` (`name`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ",

    'clients' => "
        CREATE TABLE `clients` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `business_name` varchar(255) NOT NULL,
            `ceo_name` varchar(255) NOT NULL,
            `mobile` varchar(20) NOT NULL,
            `email` varchar(255) NOT NULL,
            `address` varchar(255) NOT NULL,
            `category` varchar(255) NOT NULL,
            `total_students` int(11) NOT NULL,
            `license_expiry_date` date NOT NULL,
            `web_ip_address` varchar(20) NOT NULL,
            `web_username` varchar(222) NOT NULL,
            `web_password` varchar(255) NOT NULL,
            `web_database` varchar(222) NOT NULL,
            `amount_per_student` decimal(10,2) NOT NULL,
            `total_amount` decimal(10,2) NOT NULL,
            `amount_paid` decimal(10,2) NOT NULL DEFAULT 0.00,
            `outstanding_balance` decimal(10,2) NOT NULL DEFAULT 0.00,
            `is_active` tinyint(1) NOT NULL DEFAULT 1,
            `user_id` int(11) DEFAULT NULL,
            PRIMARY KEY (`id`),
            KEY `user_id` (`user_id`),
            CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ",

    'license' => "
        CREATE TABLE `license` (
            `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` varchar(255) NOT NULL,
            `phone` varchar(20) DEFAULT NULL,
            `email` varchar(255) DEFAULT NULL,
            `sofware_name` varchar(255) DEFAULT NULL,
            `organization` varchar(255) DEFAULT NULL,
            `txtcapacity` int(10) DEFAULT NULL,
            `cmbpackage` varchar(50) DEFAULT NULL,
            `enddate` date DEFAULT NULL,
            `license_key` varchar(255) DEFAULT NULL,
            `transaction_date` timestamp NOT NULL DEFAULT current_timestamp(),
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ",

    'posts' => "
        CREATE TABLE `posts` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `title` varchar(255) NOT NULL,
            `content` text NOT NULL,
            `author_id` int(11) NOT NULL,
            `category_id` int(11) NOT NULL,
            `image_path` varchar(255) DEFAULT NULL,
            `views` INT DEFAULT 0,
            `likes` INT DEFAULT 0,
            `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
            PRIMARY KEY (`id`),
            KEY `author_id` (`author_id`),
            KEY `category_id` (`category_id`),
            CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
            CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ",

    'comments' => "
        CREATE TABLE `comments` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `post_id` int(11) NOT NULL,
            `name` varchar(255) NOT NULL,
            `email` varchar(255) NOT NULL,
            `content` text NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
            PRIMARY KEY (`id`),
            KEY `post_id` (`post_id`),
            CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ",

    'audit_log' => "
        CREATE TABLE `audit_log` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `user_id` int(11) NOT NULL,
            `activity` varchar(255) NOT NULL,
            `details` text DEFAULT NULL,
            `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ",

    'academy' => "
        CREATE TABLE `academy` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(225) NOT NULL,
            `gender` varchar(255) NOT NULL,
            `email` varchar(255) NOT NULL,
            `mobile` varchar(255) NOT NULL,
            `state` varchar(255) NOT NULL,
            `city` varchar(255) NOT NULL,
            `address` varchar(255) NOT NULL,
            `course_id` int(11) NOT NULL,
            `duration` varchar(255) NOT NULL,
            `year_enrolled` VARCHAR(10) NOT NULL,
            `qualification` varchar(255) NOT NULL,
            `computer_literacy` varchar(255) NOT NULL,
            `nkin_name` varchar(255) NOT NULL,
            `nkin_mobile` varchar(255) NOT NULL,
            `nkin_email` varchar(255) NOT NULL,
            `spn_name` varchar(255) NOT NULL,
            `spn_mobile` varchar(255) NOT NULL,
            `spn_email` varchar(255) NOT NULL,
            `image_path` varchar(255) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
            `password` varchar(100) NOT NULL,
            PRIMARY KEY (`id`),
            KEY `course_id` (`course_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ",

    'transactions' => "
        CREATE TABLE `transactions` (
            `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
            `client_id` int(11) NOT NULL,
            `payment_amount` decimal(10,2) NOT NULL,
            `transaction_date` timestamp NOT NULL DEFAULT current_timestamp(),
            `business_name` varchar(255) NOT NULL,
            `license_subscription` varchar(255) NOT NULL,
            PRIMARY KEY (`transaction_id`),
            KEY `client_id` (`client_id`),
            CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ",

    'classes' => "
        CREATE TABLE `classes` (
            `id` int(11) UNSIGNED AUTO_INCREMENT,
           `name` varchar(255) NOT NULL,
            PRIMARY KEY (`id`)
             ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ",

    'schedules' => "
        CREATE TABLE `schedules` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `class_id` int(11),
            `day` varchar(255) NOT NULL,
            `time` varchar(255) NOT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ",

    'likes' => "
        CREATE TABLE `likes` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            user_id INT NOT NULL,
            post_id INT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            UNIQUE KEY user_post_like (user_id, post_id),
            FOREIGN KEY (user_id) REFERENCES users(id),
            FOREIGN KEY (post_id) REFERENCES posts(id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ",

    'assignments' => "
        CREATE TABLE `assignments` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `student_id` int(11) NOT NULL,
            `class_id` int(11) NOT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ",

       'tasks' => "
        CREATE TABLE `tasks` (
            `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            `course_id` int(11) UNSIGNED NOT NULL,
            `description` text NOT NULL,
            `submission_date` DATETIME NOT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ",

      'threads' => "
        CREATE TABLE `threads` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `title` varchar(255) NOT NULL,
            `content` text NOT NULL,
            `author` varchar(255) NOT NULL,
            `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ",

      'community_posts' => "
        CREATE TABLE `community_posts` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `thread_id` int(11) NOT NULL,
            `content` text NOT NULL,
            `author` varchar(255) NOT NULL,
            `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            key `thread_id` (`thread_id`),
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ",

      // Table: question
  "question" => "
        CREATE TABLE IF NOT EXISTS `question` (
            `que_id` int(11) NOT NULL AUTO_INCREMENT,
            `subject` varchar(222) NOT NULL,
            `que_desc` varchar(2000) NOT NULL,
            `ans1` varchar(75) NOT NULL,
            `ans2` varchar(75) NOT NULL,
            `ans3` varchar(75) NOT NULL,
            `ans4` varchar(75) NOT NULL,
            `true_ans` varchar(1) NOT NULL,
            `course` varchar(111) NOT NULL,
            PRIMARY KEY (`que_id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
    ",

      // Table: mst_result
  "mst_result" => "
        CREATE TABLE IF NOT EXISTS `mst_result` (
            `login` varchar(20) DEFAULT NULL,
            `course` varchar(111) DEFAULT NULL,
            `test_date` varchar(111) DEFAULT NULL,
            `score` int(11) DEFAULT NULL
        ) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
    ",

    // Table: cbtadmin
  "cbtadmin" => "
        CREATE TABLE IF NOT EXISTS `cbtadmin` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `course` varchar(111) NOT NULL,
            `testdate` varchar(111) NOT NULL,
            `testtime` int(11) NOT NULL DEFAULT 0,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
    ",

     // Table: timer
  "timer" => "
        CREATE TABLE IF NOT EXISTS `timer` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `studentid` varchar(50) NOT NULL,
            `timer` varchar(100) NOT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
    ",

      // Table: mst_useranswer
  "mst_useranswer" => "
        CREATE TABLE IF NOT EXISTS `mst_useranswer` (
            `sess_id` varchar(80) DEFAULT NULL,
            `course` varchar(111) DEFAULT NULL,
            `que_des` varchar(200) DEFAULT NULL,
            `ans1` varchar(50) DEFAULT NULL,
            `ans2` varchar(50) DEFAULT NULL,
            `ans3` varchar(50) DEFAULT NULL,
            `ans4` varchar(50) DEFAULT NULL,
            `true_ans` int(11) DEFAULT NULL,
            `your_ans` int(11) DEFAULT NULL
        ) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
    "
];


// Create tables in the correct order to satisfy foreign key constraints
$creationOrder = [
    'roles',
    'courses',
    'users',
    'categories',
    'clients',
    'license',
    'posts',
    'comments',
    'audit_log',
    'academy',      // must come before 'assignments'
    'transactions',
    'classes',
    'schedules',
    'assignments',   // must come after 'academy' and 'courses'
    'tasks',
    'threads',
    'community_posts',
    'likes',
    'question',
    'mst_result',
    'cbtadmin',
    'timer',
    'mst_useranswer'
];


foreach ($creationOrder as $tableName) {
    if (!tableExists($conn, $tableName)) {
        if ($conn->query($tables[$tableName]) === TRUE) {
            // Table created successfully
        } else {
            // error_log("Error creating table $tableName: " . $conn->error);
            echo "Error creating table $tableName: " . $conn->error . "<br>";
        }
    }
}



// Insert initial data into roles table if it's empty
if (tableExists($conn, 'roles')) {
    $result = $conn->query("SELECT COUNT(*) as count FROM `roles`");
    $row = $result->fetch_assoc();
    if ($row['count'] == 0) {
        $conn->query("INSERT INTO `roles` (`id`, `name`, `description`) VALUES
            (1, 'admin', 'Administrator role'),
            (2, 'moderator', 'moderator role'),
            (3, 'staff', 'staff role'),
            (4, 'secretary', 'secretary role')");
    }
}

// Insert initial data into users table if it's empty
if (tableExists($conn, 'users')) {
    $result = $conn->query("SELECT COUNT(*) as count FROM `users`");
    $row = $result->fetch_assoc();
    if ($row['count'] == 0) {
        $conn->query("INSERT INTO `users` (`id`, `username`, `password`, `name`, `email`, `role_id`, `is_admin`, `created_at`) VALUES
            (1, 'dinolabs', 'dinolabs', 'Dinolabs Tech Services', 'dinolabs.tech@gmail.com', 1, 1, '2025-05-16 00:33:55')");
    }
}
