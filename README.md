This is how it looks:

   ![blogphp](https://github.com/user-attachments/assets/a85ba0fb-1707-44b4-a97a-ae7009eca458)



Blog System - PHP
This is a simple blog system built using PHP, MySQL, and basic HTML/CSS. It allows users to register, log in, and post articles to the blog. Admin users can add new posts through a dedicated interface, and visitors can view the posts on the homepage.

Features
User Registration & Login: Users can register and log in to the system.
Post Creation: Logged-in users can create new posts.
Admin Panel: The admin can manage posts through a dedicated dashboard.
Post Display: All blog posts are displayed on the homepage with titles, excerpts, and "Read More" links.
Database Integration: The system uses MySQL to store user and post information.
Requirements
PHP >= 7.0
MySQL Database
XAMPP/WAMP/MAMP (or any local server setup)
Setup Instructions
Step 1: Download & Install
Clone or Download the repository:

Download the code or clone the repository to your local machine.
Set up the database:

Open your MySQL server (e.g., using XAMPP or MAMP).
Create a new database, for example blog_system.
Import the database schema:

In your MySQL interface (like phpMyAdmin), execute the following SQL script to create the necessary tables:
sql
Copy code
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    author_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(id)
);
Step 2: Configure Database Connection
Update Database Configuration:

Open the db.php file and edit the database connection settings to match your local environment (e.g., localhost, root, password, etc.).
php
Copy code
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
Step 3: Running the Application
Start your local server:

Open XAMPP or MAMP and start the Apache and MySQL services.
Access the Blog System:

Navigate to http://localhost/your_project_directory/index.php in your browser to view the homepage.
You can also access the admin interface by visiting http://localhost/your_project_directory/admin.php (only accessible to logged-in users).
Step 4: Logging In and Managing Posts
User Registration & Login:

Register a new user by visiting the register.php page.
Log in using the login.php page with the registered credentials.
Adding New Posts:

Once logged in, users can add new posts by visiting the index.php page and submitting the form.
Admin users can also manage posts from the admin.php panel.
Step 5: Customize Styling
You can modify the styles.css file to adjust the layout and design of the blog system to match your preferences.
