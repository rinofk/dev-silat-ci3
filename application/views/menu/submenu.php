<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="div row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?></div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Add New Submenu</a>
            <!-- Parent Menu Tabs -->
            <ul class="nav nav-tabs mb-4" id="submenuTab" role="tablist">
                <?php $j = 0; foreach ($menu as $m) : ?>
                    <?php 
                        $count = 0;
                        foreach ($subMenu as $sm) {
                            if ($sm['menu_id'] == $m['id']) {
                                $count++;
                            }
                        }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $j == 0 ? 'active' : ''; ?>" id="tab-<?= $m['id']; ?>" data-toggle="tab" href="#menu-<?= $m['id']; ?>" role="tab" aria-controls="menu-<?= $m['id']; ?>" aria-selected="<?= $j == 0 ? 'true' : 'false'; ?>">
                            <?= htmlspecialchars($m['menu']); ?><sup class="text-primary ml-1" style="font-size: 65%; font-weight: 700;"><?= $count; ?></sup>
                        </a>
                    </li>
                <?php $j++; endforeach; ?>
            </ul>

            <!-- Tabs Content -->
            <div class="tab-content shadow-sm p-3 bg-white rounded" id="submenuTabContent">
                <?php $j = 0; foreach ($menu as $m) : ?>
                    <div class="tab-pane fade <?= $j == 0 ? 'show active' : ''; ?>" id="menu-<?= $m['id']; ?>" role="tabpanel" aria-labelledby="tab-<?= $m['id']; ?>">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 5%;">#</th>
                                        <th>Title</th>
                                        <th>Url</th>
                                        <th>Icon</th>
                                        <th style="width: 10%;">Active</th>
                                        <th style="width: 20%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $idx = 1; foreach ($subMenu as $sm) : ?>
                                        <?php if ($sm['menu_id'] == $m['id']) : ?>
                                            <tr>
                                                <td><?= $idx++; ?></td>
                                                <td><strong><?= htmlspecialchars($sm['title']); ?></strong></td>
                                                <td><code><?= htmlspecialchars($sm['url']); ?></code></td>
                                                <td><i class="<?= htmlspecialchars($sm['icon']); ?> mr-2"></i><?= htmlspecialchars($sm['icon']); ?></td>
                                                <td>
                                                    <?php if ($sm['is_active'] == 1) : ?>
                                                        <span class="badge badge-success">Active</span>
                                                    <?php else : ?>
                                                        <span class="badge badge-danger">Inactive</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href="" class="badge badge-success btn-edit-submenu" data-toggle="modal" data-target="#editSubMenuModal" data-id="<?= $sm['id']; ?>" data-title="<?= htmlspecialchars($sm['title']); ?>" data-menu-id="<?= $sm['menu_id']; ?>" data-url="<?= htmlspecialchars($sm['url']); ?>" data-icon="<?= htmlspecialchars($sm['icon']); ?>" data-active="<?= $sm['is_active']; ?>">Edit</a>
                                                    <a href="<?= base_url('menu/deleteSubMenu/' . $sm['id']); ?>" class="badge badge-danger" onclick="return confirm('yakin?');">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php if ($idx == 1) : ?>
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">No submenus in this category.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php $j++; endforeach; ?>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Add New Submenu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/submenu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title">
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Select menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id'] ?>"><?= $m['menu'] ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Submenu Modal -->
<div class="modal fade" id="editSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="editSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSubMenuModalLabel">Edit Submenu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_title">Submenu Title</label>
                        <input type="text" class="form-control" id="edit_title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_menu_id">Parent Menu</label>
                        <select name="menu_id" id="edit_menu_id" class="form-control" required>
                            <option value="">Select menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id'] ?>"><?= $m['menu'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_url">Submenu URL</label>
                        <input type="text" class="form-control" id="edit_url" name="url" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_icon">Submenu Icon</label>
                        <input type="text" class="form-control" id="edit_icon" name="icon" required>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="edit_is_active">
                            <label class="form-check-label" for="edit_is_active">
                                Active?
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.btn-edit-submenu');
        editButtons.forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                var id = this.getAttribute('data-id');
                var title = this.getAttribute('data-title');
                var menu_id = this.getAttribute('data-menu-id');
                var url = this.getAttribute('data-url');
                var icon = this.getAttribute('data-icon');
                var is_active = this.getAttribute('data-active');

                var form = document.querySelector('#editSubMenuModal form');
                form.setAttribute('action', '<?= base_url("menu/editSubMenu/"); ?>' + id);
                document.getElementById('edit_title').value = title;
                document.getElementById('edit_menu_id').value = menu_id;
                document.getElementById('edit_url').value = url;
                document.getElementById('edit_icon').value = icon;
                
                document.getElementById('edit_is_active').checked = (is_active == 1);
            });
        });
    });
</script>