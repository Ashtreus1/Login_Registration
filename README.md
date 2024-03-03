# Simple Login and Registration System

This project is a simple login and registration system implemented in PHP without using MySQL or Bootstrap. It stores user data in a file for educational purposes.

## Features

![Image 1](images/image1.png)

- User registration: Users can create a new account by providing their username, email, and password.
- User login: Registered users can log in with their username and password.
- Password hashing: Passwords are securely hashed before storing them in the user data file.
- Session management: The system uses PHP sessions to keep users logged in across pages.
- Logout: Users can log out of their account, terminating the session.
- Forgot Password: Users can reset their password if forgotten by verifying their identity through a verification their username if it is exist.

## Installation

### Using XAMPP:

1. Download and install XAMPP from the [official website](https://www.apachefriends.org/index.html).
2. Clone the repository: `git clone https://github.com/your-username/login-registration-php.git`.
3. Move the project folder to the `htdocs` directory in your XAMPP installation directory.
4. Start the Apache server and MySQL database from the XAMPP control panel.
5. Open your web browser and navigate to `http://localhost/login-registration-php` to access the project.

### Using PHP's Built-in Server:

1. Clone the repository: `git clone https://github.com/your-username/login-registration-php.git`.
2. Navigate to the project directory in your terminal.
3. Start the PHP built-in server: `php -S localhost:8000`.
4. Open your web browser and navigate to `http://localhost:8000` to access the project.

## Usage

1. Register: Navigate to the registration page (`http://localhost/login-registration-php/register.php`) and fill in the registration form with your details.
2. Login: Once registered, you can log in on the login page (`http://localhost/login-registration-php/login.php`) using your username and password.
3. Forgot Password: If you forget your password, click on the "Forgot Password" link on the login page, and verify your identity through a verification of your username, and update your password.
4. Logout: Click the "Logout" button on any page to log out of your account.

## License

This project is licensed under the Apache License - see the [LICENSE](LICENSE) file for details.

## Acknowledgements

- [PHP](https://www.php.net/) - Backend programming language.
- [HTML](https://html.spec.whatwg.org/) - Markup language for creating web pages.
- [CSS](https://www.w3.org/Style/CSS/Overview.en.html) - Styling language for web pages.
- [JavaScript](https://www.javascript.com/) - Programming language for adding interactivity to web pages.

## Credits

- Keiru Dev

