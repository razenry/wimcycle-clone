<div class="col-12">
    <div class="row row-cards">
        <div id="table-default" class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($categories as $category) : ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $category['name'] ?></td>
                            <td><?= $category['description'] ?></td>
                            <td><?= $category['status'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>