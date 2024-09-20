<?php

$category = $data['category'];
$slug = $category['slug'];
$name = $category['name'];
$description = $category['description'];
$photo = $category['photo'];
$status = $category['status'];
$created_at = $category['created_at'];

$user = $data['user'];
$username = $user['name'];
$email = $user['email'];
$level = $user['level'];


?>

<!-- Page Body -->
<div class="page-body">
    <div class="container-xl">
        <!-- Detail Card -->
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
            <!-- Header Section -->
            <div class="card-header fs-1 fw-bold text-center py-4">
                <h3 class="mb-0">Category Details</h3>
            </div>

            <!-- Body Section -->
            <div class="card-body p-5">
                <!-- User Info Section -->
                <h5 class="card-title text-muted mb-4">Added by:</h5>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Name:</strong></div>
                    <div class="col-md-8"><?= $username ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Level:</strong></div>
                    <div class="col-md-8"><?= $level ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Email:</strong></div>
                    <div class="col-md-8"><?= $email ?></div>
                </div>

                <!-- Category Info Section -->
                <h5 class="card-title text-muted mb-4">Category Information:</h5>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Slug:</strong></div>
                    <div class="col-md-8"><?= $slug ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Name:</strong></div>
                    <div class="col-md-8"><?= $name ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Description:</strong></div>
                    <div class="col-md-8"><?= $description ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Status:</strong></div>
                    <div class="col-md-8">
                        <?php if ($status == 1): ?>
                            <span class="btn btn-sm rounded-pill bg-success mt-2 px-3 py-2">Active</span>
                        <?php else : ?>
                            <span class="btn btn-sm rounded-pill bg-danger mt-2 px-3 py-2">Non Active</span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4"><strong>Created At:</strong></div>
                    <div class="col-md-8"><?= DateHelper::formatIndonesianDate($created_at) ?></div>
                </div>

                <!-- Category Photo -->
                <div class="row">
                    <div class="col-md-4"><strong>Photo:</strong></div>
                    <div class="col-md-8 mt-2">
                        <div class="image-container">
                            <img src="<?= Routes::storage('categories/' . $photo) ?>" alt="<?= $name ?>" class="img-fluid rounded shadow-sm">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Section -->
            <div class="card-footer text-end bg-iight text-white py-4 px-5">
                <div class="d-flex justify-content-between gap-3">
                    <a href="<?= Routes::base('admin/category') ?>" class="btn btn-primary text-white border shadow-sm" style="transition: background-color 0.3s;">Back</a>
                    <div class="d-flex gap-3">
                        <a href="<?= Routes::base('category/form/update/' . $slug) ?>" class="btn btn-warning text-white" style="transition: background-color 0.3s;">Update</a>
                        <a href="<?= Routes::base('category/delete/' . $category['slug']) ?>" class="btn btn-danger text-white delete-btn" style="transition: background-color 0.3s;">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS for Image Responsiveness -->
<style>
    .image-container {
        position: relative;
        width: 100%;
        padding-bottom: 56.25%;
        /* Aspect ratio 16:9 */
        /* Optional, to add a background before image load */
    }

    .image-container img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: contain;
        /* Ensure image keeps its aspect ratio */
    }

    @media (max-width: 768px) {
        .card-body {
            padding: 1.5rem;
        }

        .card-header {
            font-size: 1.5rem;
        }
    }
</style>