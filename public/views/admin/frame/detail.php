

<!-- Page Body -->
<div class="page-body">
    <div class="container-xl">
        <!-- Detail Card -->
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
            <!-- Header Section -->
            <div class="card-header fs-1 fw-bold text-center py-4">
                <h3 class="mb-0">frame Details</h3>
            </div>

            <!-- Body Section -->
            <?= App::extends('admin/frame/ui/table.detail', [
                'username' => $user['name'],
                'level' => $user['level'],
                'email' => $user['email'],
                'slug' => $frame['slug'],
                'name' => $frame['name'],
                'description' => $frame['description'],
                'status' => $frame['status'],
                'created_at' => $frame['created_at'],
                'updated_at' => $frame['updated_at'] ?? '',
            ]) ?>

            <!-- Footer Section -->
            <div class="card-footer text-end py-4 px-5">
                <div class="d-flex justify-content-between gap-3">
                    <a href="<?= Routes::base('admin/frame') ?>" class="btn btn-primary text-white border shadow-sm" style="transition: background-color 0.3s;">Back</a>
                    <div class="d-flex gap-3">
                        <a href="<?= Routes::base('frame/form/update/' . $frame['slug']) ?>" class="btn btn-warning text-white" style="transition: background-color 0.3s;">Update</a>
                        <a href="<?= Routes::base('frame/delete/' . $frame['slug']) ?>" class="btn btn-danger text-white delete-btn" style="transition: background-color 0.3s;">Delete</a>
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
        padding-bottom: 56.25%; /* Aspect ratio 16:9 */
    }

    .image-container img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: contain;
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
