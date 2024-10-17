<?php

class Category
{

    // Index method for listing categories
    public function index()
    {
        Session::checkSession("Admin");

        $_SESSION['gagal'] = "Access denied.";
        header("Location: " . Routes::base('admin/category'));
        exit();
    }

    // Form for add/update category
    public function form($params = null)
    {
        Session::checkSession("Admin");

        if ($params != null && in_array($params[0], ['add', 'update'])) {
            $action = $params[0];
            $category = '';

            if ($action == 'update') {
                $slug = $params[1];
                $category = CategoryModel::getBySlug($slug);
            }

            $data = [
                'title'      => "Form $action Category",
                'link'       => 'Form',
                'category'   => $category,
                'input'      => $_SESSION['form_data'] ?? ''
            ];

            App::view("admin/category/actions/$action", $data, 'admin/layouts/app');
        } else {
            $_SESSION['gagal'] = "Invalid action.";
            header("Location: " . Routes::base('admin/category'));
            exit();
        }
    }

    // Detail method for a category
    public function detail($params)
    {
        Session::checkSession("Admin");

        $slug = htmlspecialchars($params[0]) ?? '';
        $category = CategoryModel::getBySlug($slug);

        if (!$category) {
            $_SESSION['gagal'] = "Category not found.";
            header("Location: " . Routes::base('admin/category'));
            exit();
        }

        $user = UserModel::getById($category['id_user']);
        $data = [
            'title'      => "Detail " . $category['name'],
            'link'       => 'Master Data',
            'category'   => $category,
            'user'       => $user
        ];

        App::view("admin/category/detail", $data, 'admin/layouts/app');
    }

    public function status($params = null)
    {

        Session::checkSession("Admin");

        $slug = $params[0] ?? null;
        $status = $params[1] ?? null;

        if ($slug && $status) {
            $category = CategoryModel::getBySlug($slug);
            $status = $status == 'active' ? '1' : '0';

            if ($category) {
                if (CategoryModel::updateStatus($slug, $status)) {
                    $_SESSION['berhasil'] = "Category status updated successfully.";
                } else {
                    $_SESSION['gagal'] = "Failed to update category status.";
                }
            } else {
                $_SESSION['gagal'] = "Category not found.";
            }
        } else {
            $_SESSION['gagal'] = "Invalid request.";
        }
        header("Location: " . Routes::base('admin/category'));
        exit();
    }

    // Store new category
    public function add()
    {
        Session::checkSession("Admin");

        if (isset($_POST['add'])) {

            // Sanitize and process input
            $input = [
                'id_user' => htmlspecialchars($_SESSION['user']['id']),
                'name' => htmlspecialchars($_POST['name']),
                'description' => htmlspecialchars($_POST['description']),
                'slug' => CategoryModel::generateSlug(htmlspecialchars($_POST['name'])),
                'photo' => self::upload($_FILES['photo'], htmlspecialchars($_POST['name']))
            ];

            // Validation
            $errors = self::validateInput($input);
            if (!empty($errors)) {
                $_SESSION['warning'] = implode('<br>', $errors);
                $_SESSION['form_data'] = $input;
                header("Location: " . Routes::base('category/form/add'));
                exit();
            }

            if (CategoryModel::insert($input)) {
                $_SESSION['berhasil'] = "Category " . $input['name'] . " added successfully.";
                header("Location: " . Routes::base('admin/category'));
            } else {
                $_SESSION['gagal'] = "Failed to add category.";
                header("Location: " . Routes::base('category/form/add'));
            }
            exit();
        }
        $_SESSION['info'] = "You are redirected to the add form.";
        header("Location: " . Routes::base('category/form/add'));
    }

    // Update existing category
    public function update($params)
    {
        Session::checkSession("Admin");

        $slug = $params[0];

        if (isset($_POST['update'])) {
            $input = [
                'id_user'     => htmlspecialchars($_SESSION['user']['id']),
                'name'        => htmlspecialchars($_POST['name']),
                'description' => htmlspecialchars($_POST['description']),
                'slug'        => CategoryModel::generateSlug($_POST['name'])
            ];

            $record = CategoryModel::getBySlug($slug);
            $photo = $record['photo'];

            if (!empty($_FILES['photo']['name'])) {
                unlink(Routes::upload("product/$photo"));
                $input['photo'] = self::upload($_FILES['photo'], $input['slug']);
            } else {
                $input['photo'] = $record['photo'];
            }

            $errors = self::validateInput($input, $isUpdate = true, $slug);
            if (!empty($errors)) {
                $_SESSION['warning'] = implode('<br>', $errors);
                $_SESSION['form_data'] = $input;
                header("Location: " . Routes::base('category/form/update/' . $input['slug']));
                exit();
            }


            if (CategoryModel::update($input, $slug)) {
                $_SESSION['berhasil'] = "Category " . $input['name'] . " updated successfully.";
                header("Location: " . Routes::base('admin/category'));
            } else {
                $_SESSION['gagal'] = "Failed to update category.";
                header("Location: " . Routes::base('category/form/update/' . $input['slug']));
            }
            exit();
        }
        $_SESSION['info'] = "You are redirected to the update form.";
        header("Location: " . Routes::base('category/form/update/' . $params[1]));
    }

    // Delete a category
    public function delete($params)
    {
        Session::checkSession("Admin");

        $slug = $params[0];
        if (CategoryModel::delete($slug)) {
            $record = CategoryModel::getBySlug($slug);
            $photo = $record['photo'];
            unlink(Routes::upload("product/$photo"));
            $_SESSION['berhasil'] = "Category deleted successfully.";
        } else {
            $_SESSION['gagal'] = "Failed to delete category.";
        }
        header("Location: " . Routes::base('admin/category'));
        exit();
    }

    // Helper method for file uploads
    private static function upload($file, $category)
    {
        $baseDir = Routes::upload('categories/');

        if (!is_dir($baseDir)) {
            mkdir($baseDir, 0777, true);
        }

        $allowedExtensions = ['jpeg', 'jpg', 'png'];
        $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($fileExt, $allowedExtensions)) {
            $fileExt = 'png';
        }

        $randomName = bin2hex(random_bytes(8));
        $date = date('Ymd_His');
        $newFileName = 'Category-' . $category . '_' . $randomName . '_' . $date . '.' . $fileExt;
        $targetFile = $baseDir . $newFileName;

        return move_uploaded_file($file['tmp_name'], $targetFile) ? $newFileName : null;
    }

    // Helper method for input validation
    // Helper method for input validation
    private static function validateInput($input, $isUpdate = false, $slug = null)
    {
        $errors = [];

        // Jika mode update, ambil data kategori lama berdasarkan slug
        if ($isUpdate) {
            $record = CategoryModel::getBySlug($slug);

            // Jika nama diubah, maka cek apakah ada kategori lain dengan nama yang sama
            if ($input['name'] !== $record['name']) {
                if (CategoryModel::exists($input['name'])) {
                    $errors[] = "The category name already exists.";
                }
            }
        } else {
            // Jika mode tambah, cek apakah nama kategori sudah ada
            if (CategoryModel::exists($input['name'])) {
                $errors[] = "The category name already exists.";
            }
        }

        // Validasi nama kategori harus diisi
        if (empty($input['name'])) {
            $errors[] = "The name field is required.";
        }

        // Validasi deskripsi harus diisi
        if (empty($input['description'])) {
            $errors[] = "The description field is required.";
        }

        // Validasi foto hanya pada penambahan kategori baru atau jika ada upload foto baru
        if (!$isUpdate && empty($input['photo'])) {
            $errors[] = "A photo is required.";
        }

        return $errors;
    }
}
