<?php

/**
 * Kelas User
 *
 * Kelas ini menangani berbagai operasi terkait pengguna, termasuk menampilkan daftar pengguna,
 * menambahkan, memperbarui, menghapus pengguna, serta mengelola profil pengguna.
 */
class User extends Controller
{
    private $layouts = "backend/layouts/";
    private $admin = "backend/admin/";
    private $table = "pengguna";
    private $model;

    /**
     * Konstruktor untuk inisialisasi model.
     */
    public function __construct()
    {
        $this->model = $this->model("User_model");
    }

    /**
     * Memeriksa sesi pengguna untuk memastikan akses yang benar.
     */
    private function checkSession()
    {
        session_start();

        if (!isset($_SESSION['login']) || $_SESSION['login'] !== "berhasil") {
            header("Location: " . Routes::base('admin/auth'));
            exit();
        }

        if ($_SESSION['user']['level'] !== "Admin") {
            $_SESSION['pesan'] = [
                'judul' => "Akses ditolak",
                'isi' => "Kamu tidak memiliki akses"
            ];
            header("Location: " . Routes::base('admin/error'));
            exit();
        }
    }

    /**
     * Menampilkan daftar pengguna.
     */
    public function index()
    {
        $this->checkSession();

        $data['title'] = 'Pengguna';
        $data['target'] = 'user';
        $data['user'] = $_SESSION['user'];
        $data['pengguna'] = $this->model->getAllData($this->table);
        $data['breadcrumb'] = [
            'Dashboard' => "admin",
            'Master Data' => "",
            'Pengguna' => [
                'link' => "pengguna",
                'status' => "active"
            ]
        ];

        $this->view($this->layouts . 'header', $data);
        $this->view($this->layouts . 'loader');
        $this->view($this->layouts . 'navbar', $data);
        $this->view($this->admin . 'user/index', $data);
        $this->view($this->admin . 'user/components/modal', $data);
        $this->view($this->layouts . 'footer');
    }

    /**
     * Menambahkan pengguna baru.
     */
    public function add()
    {
        $this->checkSession();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = htmlspecialchars($_POST['email']) ?? '';

            // Cek apakah email sudah ada
            if ($this->model->isEmailExist($email)) {
                $_SESSION['gagal'] = "Email " . $email . " sudah terdaftar.";
                header("Location: " . Routes::base('user'));
                exit();
            }

            // Cek kecocokan password
            if (htmlspecialchars($_POST['konfirmasi_password']) !== htmlspecialchars($_POST['password'])) {
                $_SESSION['gagal'] = "Password tidak cocok.";
                header("Location: " . Routes::base('user'));
                exit();
            }

            // Validasi dan siapkan data
            $data = [
                'nama' => htmlspecialchars($_POST['nama']) ?? '',
                'email' => $email,
                'password' => password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT) ?? '',
                'telp' => htmlspecialchars($_POST['telp']) ?? '',
                'status' => htmlspecialchars($_POST['status']) ?? '',
                'foto' => $this->uploadImage('foto') // upload image
            ];

            if (!empty($data['nama']) && !empty($data['email'])) {
                if ($this->model->addData($data, $this->table)) {
                    $_SESSION['berhasil'] = "Pengguna " . $data['nama'] . " Berhasil Ditambahkan";
                    header("Location: " . Routes::base('user'));
                    exit();
                } else {
                    $_SESSION['gagal'] = "Pengguna " . $data['nama'] . " Gagal Ditambahkan";
                    header("Location: " . Routes::base('user'));
                    exit();
                }
            } else {
                $_SESSION['gagal'] = "Data tidak valid. Nama dan Email wajib diisi.";
                header("Location: " . Routes::base('user'));
                exit();
            }
        } else {
            $_SESSION['gagal'] = "Permintaan tidak valid.";
            header("Location: " . Routes::base('user'));
            exit();
        }
    }

    /**
     * Memperbarui data pengguna.
     */
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $email = htmlspecialchars($_POST['email']) ?? '';
            $user = $this->model->getById($id, $this->table);

            if (!$user) {
                $_SESSION['gagal'] = "Pengguna tidak ditemukan.";
                header("Location: " . Routes::base('user'));
                exit();
            }

            // Cek email baru
            if ($email == $user['email']) {
                $emailToUpdate = $user['email'];
            } else {
                if ($this->model->isEmailExist($email)) {
                    $_SESSION['gagal'] = "Email " . $email . " sudah terdaftar.";
                    header("Location: " . Routes::base('user'));
                    exit();
                } else {
                    $emailToUpdate = $email;
                }
            }

            // Cek kecocokan password
            if (htmlspecialchars($_POST['konfirmasi_password']) !== htmlspecialchars($_POST['password'])) {
                $_SESSION['gagal'] = "Password tidak cocok.";
                header("Location: " . Routes::base('user'));
                exit();
            }

            // Handle file upload
            $image = $this->uploadImage('foto');
            if (!$image) {
                $image = $user['foto']; // Tetap gunakan gambar lama jika tidak ada gambar baru
            } else {
                // Hapus gambar lama jika ada gambar baru
                $oldImagePath = __DIR__ . "/../../public/storage/images/users/" . $user['foto'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Persiapkan data untuk update
            $data = [
                'nama' => htmlspecialchars($_POST['nama']) ?? '',
                'email' => $emailToUpdate,
                'password' => !empty($_POST['password']) ? password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT) : $user['password'],
                'telp' => htmlspecialchars($_POST['telp']) ?? '',
                'status' => htmlspecialchars($_POST['status']) ?? '0',
                'foto' => $image
            ];

            // Validasi data dan lakukan update
            if ($id && !empty($data['nama']) && !empty($data['email'])) {
                if ($this->model->updateData($id, $data, $this->table)) {
                    $_SESSION['berhasil'] = "Pengguna " . $data['nama'] . " berhasil diperbarui";
                    header("Location: " . Routes::base('user'));
                    exit();
                } else {
                    $_SESSION['gagal'] = "Pengguna " . $data['nama'] . " gagal diperbarui";
                    header("Location: " . Routes::base('user'));
                    exit();
                }
            } else {
                $_SESSION['gagal'] = "Data tidak valid";
                header("Location: " . Routes::base('user'));
                exit();
            }
        } else {
            $_SESSION['gagal'] = "Permintaan tidak valid";
            header("Location: " . Routes::base('user'));
            exit();
        }
    }

    /**
     * Menghapus pengguna.
     */
    public function delete()
    {
        $this->checkSession();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;

            $user = $this->model->getById($id, $this->table);
            $nama = $user['nama'];
            if (!$user) {
                $_SESSION['gagal'] = "Pengguna $nama tidak ditemukan.";
                header("Location: " . Routes::base('user'));
                exit();
            }

            if ($id) {
                if ($this->model->deleteData($id, $this->table)) {
                    $_SESSION['berhasil'] = "Pengguna $nama berhasil dihapus";
                    header("Location: " . Routes::base('user'));
                    exit();
                } else {
                    $_SESSION['gagal'] = "Pengguna $nama gagal dihapus";
                    header("Location: " . Routes::base('user'));
                    exit();
                }
            } else {
                $_SESSION['gagal'] = "ID tidak ditemukan";
                header("Location: " . Routes::base('user'));
                exit();
            }
        } else {
            $_SESSION['gagal'] = "Permintaan tidak valid.";
            header("Location: " . Routes::base('user'));
            exit();
        }
    }

    public function editProfil()
    {
        session_start();

        // die(var_dump($_POST));

        $userId = $_SESSION['user']['id']; // Mengambil user ID dari session
        $currentEmail = $_SESSION['user']['email']; // Mengambil email lama dari session

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = htmlspecialchars($_POST['email']) ?? '';

            // Jika email baru sama dengan email lama, gunakan email lama
            if ($email === $currentEmail) {
                $email = $currentEmail;
            } else {
                // Cek apakah email baru sudah digunakan oleh user lain
                if ($this->model->isEmailExist($email, $userId)) {
                    $_SESSION['gagal'] = "Email $email sudah terdaftar.";
                    header("Location: " . Routes::base('profil'));
                    exit();
                }
            }

            // Handle upload gambar
            $image = $this->uploadImage('foto');
            if (!$image) {
                $image = $_SESSION['user']['foto']; // Tetap gunakan foto lama jika tidak ada foto baru
            }

            // Siapkan data untuk update
            $data = [
                'nama' => htmlspecialchars($_POST['nama']) ?? '',
                'email' => $email,
                'telp' => htmlspecialchars($_POST['telp']) ?? '',
                'foto' => $image
            ];

            // Proses update profil
            if ($this->model->updateProfile($userId, $data)) {
                $_SESSION['berhasil'] = "Profil berhasil diperbarui.";
                $_SESSION['user'] = array_merge($_SESSION['user'], $data); // Update session dengan data baru
                header("Location: " . Routes::base('profil'));
                exit();
            } else {
                $_SESSION['gagal'] = "Profil gagal diperbarui.";
                header("Location: " . Routes::base('profil'));
                exit();
            }
        }
    }
    public function ubahPassword()
    {
        session_start();

        $userId = $_SESSION['user']['id']; // Mengambil user ID dari session

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $oldPassword = htmlspecialchars($_POST['oldPassword']) ?? '';
            $newPassword = htmlspecialchars($_POST['newPassword']) ?? '';
            $confirmPassword = htmlspecialchars($_POST['confirmPassword']) ?? '';

            // Validate old password, new password, and confirm password
            if (empty($oldPassword) || empty($newPassword) || empty($confirmPassword)) {
                $_SESSION['gagal'] = "Semua kolom harus diisi.";
                header("Location: " . Routes::base('profil'));
                exit();
            }

            if ($newPassword !== $confirmPassword) {
                $_SESSION['gagal'] = "Kata sandi baru dan konfirmasi kata sandi tidak cocok.";
                header("Location: " . Routes::base('profil'));
                exit();
            }

            // Fetch current password from database
            $currentPassword = $this->model->getPasswordByUserId($userId);
            if (!password_verify($oldPassword, $currentPassword)) {
                $_SESSION['gagal'] = "Kata sandi lama salah.";
                header("Location: " . Routes::base('profil'));
                exit();
            }

            // Hash new password and update it
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            if ($this->model->updatePassword($userId, $hashedPassword)) {
                $_SESSION['berhasil'] = "Kata sandi berhasil diperbarui.";
                header("Location: " . Routes::base('profil'));
                exit();
            } else {
                $_SESSION['gagal'] = "Kata sandi gagal diperbarui.";
                header("Location: " . Routes::base('profil'));
                exit();
            }
        }
    }


    /**
     * Memperbarui status pengguna.
     */
    public function status()
    {
        $this->checkSession();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $status = $_POST['status'] ?? null;

            $data = $this->model->getById($id, $this->table);
            $nama = $data['nama'];
            if (!$data) {
                $_SESSION['gagal'] = "Pengguna $nama tidak ditemukan.";
                header("Location: " . Routes::base('user'));
                exit();
            }

            if ($status && $id) {
                if ($this->model->updateStatus($id, $status, $this->table)) {
                    $_SESSION['berhasil'] = "Status pengguna $nama berhasil diperbarui";
                    header("Location: " . Routes::base('user'));
                    exit();
                } else {
                    $_SESSION['gagal'] = "Status pengguna $nama gagal diperbarui";
                    header("Location: " . Routes::base('user'));
                    exit();
                }
            } else {
                $_SESSION['gagal'] = "Status dan ID tidak ditemukan";
                header("Location: " . Routes::base('user'));
                exit();
            }
        } else {
            $_SESSION['gagal'] = "Permintaan tidak valid";
            header("Location: " . Routes::base('user'));
            exit();
        }
    }

    /**
     * Mengelola unggahan gambar.
     *
     * @param string $field Nama field file input.
     * @return string Nama file gambar yang diunggah.
     */
    private function uploadImage($field)
    {
        if (isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES[$field];
            $targetDir = __DIR__ . "/../../public/storage/images/users/";
            $targetFile = $targetDir . basename($file["name"]);
            $uploadOk = 1;

            // Periksa apakah file adalah gambar
            $check = getimagesize($file["tmp_name"]);
            if ($check === false) {
                $_SESSION['gagal'] = "File yang diunggah bukan gambar.";
                return false;
            }

            // Periksa ukuran file
            if ($file["size"] > 5000000) { // 5MB
                $_SESSION['gagal'] = "Ukuran file terlalu besar.";
                return false;
            }

            // Izinkan format gambar tertentu
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $allowedTypes = ['jpg', 'png', 'jpeg', 'gif'];
            if (!in_array($imageFileType, $allowedTypes)) {
                $_SESSION['gagal'] = "Format gambar tidak diizinkan.";
                return false;
            }

            // Coba unggah file
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                return basename($file["name"]);
            } else {
                $_SESSION['gagal'] = "Terjadi kesalahan saat mengunggah file.";
                return false;
            }
        } else {
            // $_SESSION['gagal'] = "Tidak ada file yang diunggah atau terjadi kesalahan saat mengunggah.";
            return false;
        }
    }
}
