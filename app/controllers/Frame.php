<?php

class Frame
{

    public function index()
    {
        Session::checkSession("Admin");

        $_SESSION['gagal'] = "Access denied.";

        header("Location: " . Routes::base('admin/frame'));
        exit();
    }

    public function form($params = null)
    {
        Session::checkSession("Admin");

        if ($params != null && in_array($params[0], ['add', 'update'])) {
            $action = $params[0];
            $frame = '';

            if ($action == 'update') {
                $slug = $params[1];
                $frame = FrameModel::getBySlug($slug);
            }

            $data = [
                'title'      => "Form $action frame",
                'link'       => 'Form',
                'frame'   => $frame,
                'input'      => $_SESSION['form_data'] ?? ''
            ];

            App::view("admin/frame/actions/$action", $data, 'admin/layouts/app');
        } else {
            $_SESSION['gagal'] = "Invalid action.";
            header("Location: " . Routes::base('admin/frame'));
            exit();
        }
    }

    public function detail($params)
    {
        Session::checkSession("Admin");

        $slug = htmlspecialchars($params[0]) ?? '';
        $frame = FrameModel::getBySlug($slug);

        if (!$frame) {
            $_SESSION['gagal'] = "Frame not found.";
            header("Location: " . Routes::base('admin/frame'));
            exit();
        }

        $user = UserModel::getById($frame['id_user']);

        $data = [
            'title'      => "Detail " . $frame['name'],
            'link'       => 'Master Data',
            'frame'   => $frame,
            'user'       => $user
        ];

        App::view("admin/frame/detail", $data, 'admin/layouts/app');
    }

    public function test()
    {

        $data = FrameApi::get(API_KEY);

        var_dump($data);
    }

    // Store

    public function status($params = null)
    {
        Session::checkSession("Admin");

        $slug = $params[0] ?? null;
        $status = $params[1] ?? null;

        if ($slug && $status) {
            $frame = FrameModel::getBySlug($slug);
            $status = $status == 'active' ? '1' : '0';

            if ($frame) {
                if (FrameModel::updateStatus($slug, $status)) {
                    $_SESSION['berhasil'] = "Frame status updated successfully.";
                } else {
                    $_SESSION['gagal'] = "Failed to update Frame status.";
                }
            } else {
                $_SESSION['gagal'] = "Frame not found.";
            }
        } else {
            $_SESSION['gagal'] = "Invalid request.";
        }
        header("Location: " . Routes::base('admin/frame'));
        exit();
    }

    public function add()
    {
        Session::checkSession("Admin");

        if (isset($_POST['add'])) {

            // Sanitize and process input
            $input = [
                'id_user' => htmlspecialchars($_SESSION['user']['id']),
                'name' => htmlspecialchars($_POST['name']),
                'description' => htmlspecialchars($_POST['description']),
                'slug' => FrameModel::generateSlug(htmlspecialchars($_POST['name']))
            ];

            // Validation
            $errors = self::validateInput($input);
            if (!empty($errors)) {
                $_SESSION['warning'] = implode('<br>', $errors);
                $_SESSION['form_data'] = $input;
                header("Location: " . Routes::base('frame/form/add'));
                exit();
            }

            if (FrameModel::insert($input)) {
                $_SESSION['berhasil'] = "frame " . $input['name'] . " added successfully.";
                header("Location: " . Routes::base('admin/frame'));
            } else {
                $_SESSION['gagal'] = "Failed to add frame.";
                header("Location: " . Routes::base('frame/form/add'));
            }
            exit();
        }
        $_SESSION['info'] = "You are redirected to the add form.";
        header("Location: " . Routes::base('frame/form/add'));
    }

    public function update($params)
    {
        Session::checkSession("Admin");

        $slug = $params[0] ?? null;

        if (isset($_POST['update'])) {
            $input = [
                'id_user'     => htmlspecialchars($_SESSION['user']['id']),
                'name'        => htmlspecialchars($_POST['name']),
                'description' => htmlspecialchars($_POST['description']),
                'slug'        => FrameModel::generateSlug($_POST['name'])
            ];

            $errors = self::validateInput($input, $isUpdate = true, $slug);
            if (!empty($errors)) {
                $_SESSION['warning'] = implode('<br>', $errors);
                $_SESSION['form_data'] = $input;
                header("Location: " . Routes::base('frame/form/update/' . $input['slug']));
                exit();
            }


            if (FrameModel::update($input, $slug)) {
                $_SESSION['berhasil'] = "Frame " . $input['name'] . " updated successfully.";
                header("Location: " . Routes::base('admin/frame'));
            } else {
                $_SESSION['gagal'] = "Failed to update frame.";
                header("Location: " . Routes::base('frame/form/update/' . $input['slug']));
            }
            exit();
        }
        $_SESSION['info'] = "You are redirected to the update form.";
        header("Location: " . Routes::base('frame/form/update/' . $params[1]));
    }

    public function delete($params)
    {
        Session::checkSession("Admin");

        $slug = $params[0];
        if (FrameModel::delete($slug)) {
            $_SESSION['berhasil'] = "Category deleted successfully.";
        } else {
            $_SESSION['gagal'] = "Failed to delete category.";
        }
        header("Location: " . Routes::base('admin/frame'));
        exit();
    }

    private static function validateInput($input, $isUpdate = false, $slug = null)
    {
        $errors = [];

        // Jika mode update, ambil data kategori lama berdasarkan slug
        if ($isUpdate) {
            $record = FrameModel::getBySlug($slug);

            // Jika nama diubah, maka cek apakah ada kategori lain dengan nama yang sama
            if ($input['name'] !== $record['name']) {
                if (FrameModel::exists($input['name'])) {
                    $errors[] = "The Frame name already exists.";
                }
            }
        } else {
            // Jika mode tambah, cek apakah nama kategori sudah ada
            if (FrameModel::exists($input['name'])) {
                $errors[] = "The Frame name already exists.";
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

        return $errors;
    }
}
