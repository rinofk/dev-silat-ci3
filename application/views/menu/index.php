<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php if ($this->session->flashdata('flash')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data Menu <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>

    <?php endif; ?>
    <div class="div row">
        <div class="col-lg-6">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?>
            <?= $this->session->flashdata('message'); ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Add New Menu</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($menu as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $m['menu'] ?></td>
                             <td>
                                 <a href="" class="badge badge-success btn-edit-menu" data-toggle="modal" data-target="#editMenuModal" data-id="<?= $m['id']; ?>" data-menu="<?= htmlspecialchars($m['menu']); ?>">Edit</a>
                                 <a href="<?= base_url('menu/hapusmenu/') . $m['id']; ?>" class="badge badge-danger" onclick="return confirm('yakin?');">Delete</a>
                             </td>
                         </tr>
                         <?php $i++; ?>
                     <?php endforeach ?>
                 </tbody>
             </table>
         </div>
     </div>
 </div>
 <!-- /.container-fluid -->
 
 </div>
 <!-- End of Main Content -->
 
 <!-- Modal -->
 <div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="newMenuModalLabel">Add New Menu</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form action="<?= base_url('menu'); ?>" method="post">
                 <div class="modal-body">
                     <div class="form-group">
                         <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name">
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

 <!-- Edit Menu Modal -->
 <div class="modal fade" id="editMenuModal" tabindex="-1" role="dialog" aria-labelledby="editMenuModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="editMenuModalLabel">Edit Menu</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form action="" method="post">
                 <div class="modal-body">
                     <div class="form-group">
                         <label for="edit_menu">Menu Name</label>
                         <input type="text" class="form-control" id="edit_menu" name="menu" required>
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
          var editButtons = document.querySelectorAll('.btn-edit-menu');
          editButtons.forEach(function(btn) {
              btn.addEventListener('click', function(e) {
                  e.preventDefault();
                  var id = this.getAttribute('data-id');
                  var menu = this.getAttribute('data-menu');
                  
                  var form = document.querySelector('#editMenuModal form');
                  form.setAttribute('action', '<?= base_url("menu/editmenu/"); ?>' + id);
                  document.getElementById('edit_menu').value = menu;
              });
          });
      });
  </script>