
# Wimcycle Clone - PHP MVC

This is a clone of the Wimcycle website built using a custom PHP MVC framework and styled with Bootstrap 5. The project demonstrates a modular MVC architecture for organizing PHP code efficiently while implementing a responsive design using modern front-end technologies.

## Features

- **Custom PHP MVC framework**: A clean and structured approach to organizing code with Models, Views, and Controllers.
- **Bootstrap 5**: Responsive, mobile-first design framework for building a sleek and modern UI.
- **Product Management**: Manage products easily with CRUD functionality (Create, Read, Update, Delete).
- **Page Management**: Manage static pages like home, about, and contact within the CMS.
- **Responsive Navbar**: A mobile-friendly navbar for easy navigation across devices.
- **Responsive Design**: Ensures the website looks great on different screen sizes and devices.

## Installation

Follow these steps to set up the project on your local machine:

1. Clone the repository:

   ```bash
   git clone https://github.com/your-username/wimcycle-clone-phpmvc.git
   ```

2. Navigate to the project directory:

   ```bash
   cd wimcycle-clone-phpmvc
   ```

3. Set up the database:
   
   - Import the provided SQL file (`db.sql`) into your MySQL database.
   - Configure the database connection in `app/config/config.php`:

   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   define('DB_NAME', 'db');
   ```

4. Set up the Apache virtual host or use `localhost` to serve the application. The base URL is expected to be `http://localhost/wimcycle-clone`.

5. Make sure the necessary directories (`public/assets`, `public/storage`) have appropriate permissions for uploads.

## Usage

To navigate through the site:

- **Home Page**: The main landing page with product showcases.
- **Products Page**: A list of products available for viewing and management.
- **CMS**: Admin features for managing products and pages.

## Folder Structure

```bash
├── app
│   ├── controllers    # Controller files
│   ├── models         # Model files
│   ├── views          # View files (templates)
│   └── config         # Configuration files
├── public
│   ├── assets         # CSS, JS, and images
│   ├── storage        # Uploaded files (images)
│   └── index.php      # Entry point of the application
└── system             # Core system files for MVC functionality
```

## Technologies Used

- **PHP**: Custom MVC structure to handle routing and application logic.
- **MySQL**: Database management for product and page data.
- **Bootstrap 5**: Responsive design framework for front-end styling.
- **Apache/Nginx**: Web server for serving the application.

## Contributing

Contributions are welcome! If you find a bug or want to improve the project, feel free to submit a pull request or open an issue.

## License

This project is licensed under the MIT License.

---

**Author**: Razenry.code
