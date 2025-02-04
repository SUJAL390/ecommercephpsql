# FitFuel - Supplement Store Web Application

FitFuel is a dynamic web application designed for selling supplements online. Built with PHP, MySQL, JavaScript, HTML, and CSS, FitFuel offers a complete solution for managing products, user profiles, and orders—all through a robust admin panel.

## Features

- **Product Management (CRUD):** Easily add, update, view, and delete supplement products.
- **User Authentication:** Secure registration, login, and profile update functionality.
- **Admin Panel:** Comprehensive dashboard for managing products, orders, and user data.
- **Responsive Design:** Optimized for all devices (desktop, tablet, and mobile).

## Technologies Used

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL

## Installation

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/SUJAL390/ecommercephpsql.git
   cd fitfuel

    Setup Database:
        Create a MySQL database (`shop_db`).
        Import the provided SQL file into your MySQL server.

    Configure the Application:
        Open the config.php file and update the database connection details:

        <?php
        define('DB_HOST', 'localhost');
        define('DB_USER', 'your_db_user');
        define('DB_PASS', 'your_db_password');
        define('DB_NAME', 'shop_db');
        ?>

    Run the Application:
        Deploy the project on your local server (e.g., XAMPP, WAMP, or LAMP) or you can use laragon.
        Navigate to http://localhost/ecommercesql/projects/home.php in your browser.

Usage

    For Users: Register an account, browse supplements, add items to your cart, and update your profile.
    For Admins: Access the admin panel to manage products, view orders, and update user details.
