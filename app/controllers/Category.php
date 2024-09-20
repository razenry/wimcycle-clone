<?php

/**
 * Class Category
 * 
 * Handles operations related to categories, including adding, updating, and deleting.
 */
class Category
{
    /**
     * Starts the session and checks if the user has the correct access level.
     * Redirects the user to the appropriate page if access is denied.
     */
    public static function checkSession()
    {
        session_start();

        // Check if the user is logged in
        if (!isset($_SESSION['login']) || !$_SESSION['login']) {
            $_SESSION['gagal'] = "You do not have an active session.";
            header("Location: " . Routes::base('auth'));
            exit();
        }

        // Check if the user has sufficient access level (Admin or Officer)
        if ($_SESSION['user']['level'] === "Customer") {
            $_SESSION['gagal'] = "You do not have access to this page.";
            header("Location: " . Routes::base());
            exit();
        }

        // Set a welcome message for Admins or Officers
        $_SESSION['pesan'] = "Welcome";
    }

    /**
     * Displays the category management page.
     * Redirects with an error message if access is denied.
     */
    public function index()
    {
        self::checkSession();
        $_SESSION['gagal'] = "Access denied.";
        header("Location: " . Routes::base('admin/category'));
        exit();
    }

    /**
     * Displays the form to add or update a category.
     * 
     * @param array|null $params Parameters to determine if the form is for adding or updating.
     */
    public function form($params = null)
    {
        self::checkSession();

        $data['input'] = [];

        // Retrieve form data from session if available
        if (isset($_SESSION['form_data'])) {
            $data['input'] = $_SESSION['form_data'];
            unset($_SESSION['form_data']); // Clear session data
        }

        $data['pageTitle'] = "Category Form";
        $data['nav-link'] = true;
        // $data['categories'] = App::model("Category_model")->getAll();

        if ($params != null && in_array($params[0], ['add', 'update'])) {
            $action = $params[0];

            if ($action == 'update') {
                $slug = $params[1];
                $data['category'] = App::model("Category_model")->getBySlug($slug);
                $data['pageTitle'] = "Update Category";
            }

            if ($action == 'add') {
                $data['pageTitle'] = "Add Category";
            }

            // die(var_dump($data));
            // Render views
            App::view("admin/layouts/header", $data);
            App::view("admin/layouts/navbar", $data);
            App::view("admin/layouts/page-header", $data);
            App::view("admin/category/actions/{$action}", $data);
            App::view("admin/layouts/page-footer");
            App::view("admin/layouts/modal");
            App::view("admin/layouts/footer");
        } else {
            $_SESSION['gagal'] = "Invalid action.";
            header("Location: " . Routes::base('admin/category'));
            exit();
        }
    }

    public function detail($params)
    {
        self::checkSession();

        // Sanitize the slug input
        $slug = htmlspecialchars($params[0]);

        // Validate the slug
        if (!$slug || !is_string($slug)) {
            $_SESSION['gagal'] = "Invalid category slug.";
            header("Location: " . Routes::base('admin/category'));
            exit();
        }

        // Retrieve the category data by slug
        $category = App::model("Category_model")->getBySlug($slug);
        $user = App::model("User_model")->getById($category['id_user']);

        // Check if the category exists
        if (!$category) {
            $_SESSION['gagal'] = "Category not found.";
            header("Location: " . Routes::base('admin/category'));
            exit();
        }

        $data['pageTitle'] = "Category Detail";
        $data['nav-link'] = true;
        $data['category'] = $category;
        $data['user'] = $user;

        // die(var_dump($data));

        // Render views
        App::view("admin/layouts/header", $data);
        App::view("admin/layouts/navbar", $data);
        App::view("admin/layouts/page-header", $data);
        App::view("admin/category/detail", $data);
        App::view("admin/layouts/page-footer");
        App::view("admin/layouts/modal");
        App::view("admin/layouts/footer");
    }

    /**
     * Processes the form input to add a new category.
     * 
     * Validates the session and input fields before inserting data into the database.
     */
    public function add()
    {
        self::checkSession();

        if (isset($_POST['add'])) {

            // Sanitize and validate the input
            $data = [
                'id_user' => htmlspecialchars($_SESSION['user']['id']),
                'name' => htmlspecialchars($_POST['name']),
                'description' => htmlspecialchars($_POST['description']),
            ];

            // die(var_dump($data));
            $data['slug'] = App::model("Category_model")->generateSlug($data['name']);

            $data['photo'] = $this->upload($_FILES['photo'], htmlspecialchars($data['slug']));

            // Validate required fields
            $errors = [];
            if (empty($data['name'])) $errors[] = "The name field is required.";
            if (empty($data['description'])) $errors[] = "The description field is required.";
            if (empty($data['photo'])) $errors[] = "A photo is required.";

            if (App::model("Category_model")->exists($data['name'])) {
                $errors[] = "The category name already exists.";
            }


            if (!empty($errors)) {
                // Store errors and input data in session, then redirect back to form
                $_SESSION['warning'] = implode('<br>', $errors);
                $_SESSION['form_data'] = $data;
                header("Location: " . Routes::base('category/form/add'));
                exit();
            }


            // Insert the new category into the database
            if (App::model("Category_model")->insert($data)) {
                $_SESSION['berhasil'] = "Category " . $data['name'] . " added successfully.";
                header("Location: " . Routes::base('admin/category'));
                exit();
            } else {
                $_SESSION['gagal'] = "Failed to add category.";
                header("Location: " . Routes::base('category/form/add'));
                exit();
            }
        } else {
            $_SESSION['info'] = "You are redirected to the add form.";
            header("Location: " . Routes::base('category/form/add'));
            exit();
        }
    }


    // Update a category
    // Update a category
    public function update($params)
    {
        self::checkSession();

        // die(var_dump([$_POST, $params, $_FILES]));

        // Ensure a valid category slug is passed in the URL
        if (!$params || !isset($params[0])) {
            $_SESSION['gagal'] = "Invalid category.";
            header("Location: " . Routes::base('admin/category'));
            exit();
        }

        $slug = htmlspecialchars($params[0]);

        // Retrieve the category data from the database
        $category = App::model("Category_model")->getBySlug($slug);

        if (!$category) {
            $_SESSION['gagal'] = "Category not found.";
            header("Location: " . Routes::base('admin/category'));
            exit();
        }

        // Process the form submission
        if (isset($_POST['update'])) {

            // Sanitize and validate the input
            $data = [
                'id_user' => htmlspecialchars($_SESSION['user']['id']),
                'name' => htmlspecialchars($_POST['name']),
                'description' => htmlspecialchars($_POST['description']),
            ];

            // If a new name is given, generate a new slug
            if ($data['name'] !== $category['name']) {
                $data['slug'] = App::model("Category_model")->generateSlug($data['name']);
            } else {
                $data['slug'] = $category['slug'];
            }

            // If a new image is uploaded, process the file
            if (!empty($_FILES['photo']['name'])) {
                $data['photo'] = $this->upload($_FILES['photo'], htmlspecialchars($data['slug']));

                // Delete the old image if it exists and a new one is uploaded
                if (!empty($category['photo']) && file_exists(Routes::upload('categories/' . $category['photo']))) {
                    unlink(Routes::upload('categories/' . $category['photo']));
                }
            } else {
                // Keep the old photo if no new one is uploaded
                $data['photo'] = $category['photo'];
            }

            // Validate required fields
            $errors = [];
            if (empty($data['name'])) $errors[] = "The name field is required.";
            if (empty($data['description'])) $errors[] = "The description field is required.";

            if (!empty($errors)) {
                // Store errors and input data in session, then redirect back to form
                $_SESSION['warning'] = implode('<br>', $errors);
                $_SESSION['form_data'] = $data;
                header("Location: " . Routes::base('category/form/update/' . $slug));
                exit();
            }

            // Update the category in the database
            if (App::model("Category_model")->update($category['slug'], $data)) {
                $_SESSION['berhasil'] = "Category " . $data['name'] . " updated successfully.";
                header("Location: " . Routes::base('admin/category'));
                exit();
            } else {
                $_SESSION['gagal'] = "Failed to update category.";
                header("Location: " . Routes::base('category/form/update/' . $slug));
                exit();
            }
        } else {
            $_SESSION['info'] = "You are redirected to the update form.";
            header("Location: " . Routes::base('category/form/update/' . $slug));
            exit();
        }
    }


    /**
     * Deletes a specific category from the database.
     * 
     * @param array $slug The ID of the category to be deleted.
     */
    public function delete($slug)
    {
        self::checkSession();

        // Sanitize the slug input
        $slug = htmlspecialchars($slug[0]);

        // Validate the slug
        if (!$slug || !is_string($slug)) {
            $_SESSION['gagal'] = "Invalid category slug.";
            header("Location: " . Routes::base('admin/category'));
            exit();
        }

        // Retrieve the category data by slug
        $category = App::model("Category_model")->getBySlug($slug);
        $name = $category['name'];

        // Check if the category exists
        if (!$category) {
            $_SESSION['gagal'] = "Category not found.";
            header("Location: " . Routes::base('admin/category'));
            exit();
        }

        // Delete associated image if it exists
        if (!empty($category['photo'])) {
            $filePath = Routes::upload('categories/' . $category['photo']);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Delete the category from the database
        if (App::model("Category_model")->deleteBySlug($slug)) {
            $_SESSION['berhasil'] = "Category $name deleted successfully.";
            header("Location: " . Routes::base('admin/category'));
            exit();
        } else {
            $_SESSION['gagal'] = "Failed to delete category.";
            header("Location: " . Routes::base('admin/category'));
            exit();
        }
    }


    public function status($params)
    {
        self::checkSession();

        // Sanitize the slug input
        $slug = htmlspecialchars($params[0]);
        $getStatus = htmlspecialchars($params[1]);

        $status = ($getStatus == 'active') ? '1' : '0';

        // die(var_dump($status));

        // Validate the slug        
        if (!$slug || !is_string($slug)) {
            $_SESSION['gagal'] = "Invalid category slug.";
            header("Location: " . Routes::base('admin/category'));
            exit();
        }

        // Retrieve the category data by slug
        $category = App::model("Category_model")->getBySlug($slug);
        $name = $category['name'];

        // Check if the category exists
        if (!$category) {
            $_SESSION['gagal'] = "Category not found.";
            header("Location: " . Routes::base('admin/category'));
            exit();
        }

        // Update the category status
        if (App::model("Category_model")->updateStatus($slug, $status)) {
            $_SESSION['berhasil'] = "Category $name status updated to $getStatus successfully.";
            header("Location: " . Routes::base('admin/category'));
            exit();
        } else {
            $_SESSION['gagal'] = "Failed to update category status.";
            header("Location: " . Routes::base('admin/category'));
            exit();
        }
    }


    /**
     * Handles the file upload process for category images.
     * 
     * @param array $file The uploaded file information from $_FILES.
     * @param string $category The category name used to structure the file path.
     * @return string|null The new file name if upload is successful, or null if not.
     */
    public function upload($file, $category)
    {
        $baseDir = Routes::upload('categories/');

        // Create the upload directory if it doesn't exist
        $uploadDir = $baseDir . '/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Validate and sanitize the file extension
        $allowedExtensions = ['jpeg', 'jpg', 'png'];
        $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (empty($fileExt) || !in_array($fileExt, $allowedExtensions)) {
            $fileExt = 'png';
        }

        // Generate a unique filename
        $randomName = bin2hex(random_bytes(8));
        $date = date('Ymd_His');
        $newFileName = 'Category-' . $category . '_' . $randomName . '_' . $date . '.' . $fileExt;

        // Move the uploaded file to the target directory
        $targetFile = $uploadDir . $newFileName;
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            return $newFileName;
        } else {
            return null;
        }
    }
}
