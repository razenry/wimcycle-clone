<div class="card-body p-5">
    <!-- User Info Section -->
    <h5 class="card-title text-muted mb-4">Added by:</h5>
    <table class="table table-striped table-hover mb-5">
        <tbody>
            <tr>
                <th scope="row">Name:</th>
                <td><?= $username ?></td>
            </tr>
            <tr>
                <th scope="row">Level:</th>
                <td><?= $level ?></td>
            </tr>
            <tr>
                <th scope="row">Email:</th>
                <td><?= $email ?></td>
            </tr>
        </tbody>
    </table>

    <!-- Category Info Section -->
    <h5 class="card-title text-muted mb-4">Product Information:</h5>
    <table class="table table-striped table-hover">
        <tbody>
            <tr>
                <th scope="row">Slug:</th>
                <td><?= $slug ?></td>
            </tr>
            <tr>
                <th scope="row">Name:</th>
                <td><?= $name ?></td>
            </tr>
            <tr>
                <th scope="row">Description:</th>
                <td><?= $description ?></td>
            </tr>
            <tr>
                <th scope="row">Price:</th>
                <td><?= CurrencyFormatter::formatCurrency($price) ?></td>
            </tr>
            <tr>
                <th scope="row">Category:</th>
                <td><?= $category ?></td>
            </tr>
            <tr>
                <th scope="row">Frame:</th>
                <td><?= $frame ?></td>
            </tr>
            <tr>
                <th scope="row">Status:</th>
                <td>
                    <?php if ($status == 1): ?>
                        <span class="badge bg-success text-light">Active</span>
                    <?php else : ?>
                        <span class="badge bg-danger text-light">Non Active</span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th scope="row">Created At:</th>
                <td><?= DateHelper::formatIndonesianDate($created_at) ?></td>
            </tr>
            <?php if ($updated_at != null): ?>
                <tr>
                    <th scope="row">Updated At:</th>
                    <td><?= DateHelper::formatIndonesianDate($updated_at) ?></td>
                </tr>
            <?php endif; ?>
            <tr>
                <th scope="row">Photo:</th>
                <td>
                    <div class="image-container">
                        <img src="<?= Routes::storage('product/' . $photo) ?>" alt="<?= $name ?>" class="img-fluid rounded shadow-sm">
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>