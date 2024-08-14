<?php $__env->startSection('title'); ?>
Notes
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title mb-0">Notes</h4>
      </div>

      <div class="card-body">
        <div class="listjs-table" id="taxesList">
          <div class="row g-4 mb-3">
            <div class="col-sm-auto">
              <div>
                <button type="button" class="btn btn-primary add-btn" data-bs-toggle="modal" id="create-btn"
                  data-bs-target="#addNoteModel"><i class="fas fa-plus-circle me-2"></i> Add Notes</button>
              </div>
            </div>
          </div>

          <div class="table-responsive table-card mt-3 mb-1">
            <table class="table align-middle table-nowrap" id="notesTable">
              <thead class="table-light">
                <tr>
                  <th>Title</th>
                  <th>Starred</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="list form-check-all">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Add Tax Modal -->
<div class="modal fade" id="addNoteModel" tabindex="-1" aria-labelledby="addNoteModelLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light p-3">
        <h5 class="modal-title" id="addNoteModelLabel">Add Note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
          id="close-add-modal"></button>
      </div>
      <form id="addNoteForm" name="addNoteForm" method="post">
        <?php echo csrf_field(); ?>
        <div class="modal-body">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title" />
            <div class="invalid-feedback"></div>
        </div>
        <div class="mb-3">
            <label class="form-label">Is Starred</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_starred" id="is_starred_yes" value="1" />
                    <label class="form-check-label" for="is_starred_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_starred" id="is_starred_no" value="0" checked />
                    <label class="form-check-label" for="is_starred_no">No</label>
                </div>
            </div>
            <div class="invalid-feedback"></div>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea id="content" name="content" class="form-control" rows="4" placeholder="Enter your content"></textarea>
            <div class="invalid-feedback"></div>
        </div>
        </div>
        <div class="modal-footer">
          <div class="hstack gap-2 justify-content-end">
            <button type="button" class="btn btn-light" id="close-add-modal" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="add-btn">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Tax Modal -->
<div class="modal fade" id="editNoteModel" tabindex="-1" aria-labelledby="editNoteModelLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light p-3">
        <h5 class="modal-title" id="editNoteModelLabel">Edit Note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
          id="close-edit-modal"></button>
      </div>
      <form id="editNoteForm" name="editNoteForm">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <input type="hidden" id="editNoteId" name="id">
        <div class="modal-body">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" id="editNoteName" name="title" class="form-control" placeholder="Enter Title" />
            <div class="invalid-feedback"></div>
        </div>
        <div class="mb-3">
            <label class="form-label">Is Starred</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_starred" id="edit_is_starred_yes" value="1" />
                    <label class="form-check-label" for="is_starred_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_starred" id="edit_is_starred_no" value="0" checked />
                    <label class="form-check-label" for="is_starred_no">No</label>
                </div>
            </div>
            <div class="invalid-feedback"></div>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea id="editNoteContent" name="content" class="form-control" rows="4" placeholder="Enter your content"></textarea>
            <div class="invalid-feedback"></div>
        </div>
        </div>
        <div class="modal-footer">
          <div class="hstack gap-2 justify-content-end">
            <button type="button" class="btn btn-light" id="close-edit-modal" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="edit-btn">Save Changes</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade zoomIn" id="deleteNotesModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
      </div>
      <div class="modal-body">
        <div class="mt-2 text-center">
          <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
            colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
          <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
            <h4>Are you sure?</h4>
            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Note?</p>
          </div>
        </div>
        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
          <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn w-sm btn-danger" id="delete-record">Yes, Delete It!</button>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('build/libs/prismjs/prism.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<script>
  $(document).ready(function () {
   
    $('#notesTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '<?php echo e(route('notes.data')); ?>',
        type: 'GET',
    },
    columns: [
        { data: 'title', name: 'title' },
        { data: 'starred', name: 'starred' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ],
    order: [[0, 'asc'], [1, 'desc']], // Example of default multi-column ordering
    pageLength: 10
});
$('#notesTable').on('click', '.favourite-btn', function () {
    var button = $(this);
    var noteId = button.data('id'); // Assuming the button has a data-id attribute
    var isStarred = button.hasClass('active') ? 0 : 1; // Determine the new is_starred value

    // Toggle the "active" class
    button.toggleClass('active');
    const updateStar = "<?php echo e(route('update.noteStatus', 'ID')); ?>";
    const newupdateStar = updateStar.replace("ID", noteId)
    // Send AJAX request to update the is_starred value
    $.ajax({
      url: newupdateStar, // Your route to handle the update
      type: 'POST',
      data: {
        id: noteId,
        is_starred: isStarred,
        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token for Laravel
      },
      success: function(response) {
        console.log('Note updated successfully');
      },
      error: function(xhr) {
        console.log('Error updating note');
      }
    });
  });

$('#addNoteForm').on('submit', function (e) {
      e.preventDefault();

      $.ajax({
        type: 'POST',
        url: '<?php echo e(route("note.add")); ?>',
        data: $(this).serialize(),
        success: function (response) {
          if (response.status) {
            $('#addNoteModel').hide();
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: response.message,
            }).then(function () {
              location.reload();
            });
          }
        },
        error: function (response) {
          var errors = response.responseJSON.errors;
          if (errors) {
            $.each(errors, function (key, value) {
              $('#' + key).addClass('is-invalid');
              $('#' + key).siblings('.invalid-feedback').text(value[0]);
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: response.responseJSON.message,
            });
          }
        }
      });
    });

    $('#addNoteModel').on('hidden.bs.modal', function () {
      $('#addNoteForm')[0].reset();
      $('.form-control').removeClass('is-invalid');
      $('.invalid-feedback').text('');
    });

    // Handle modal close button click to reset the form
    $('#close-add-modal, .btn-light').on('click', function () {
      $('#addNoteForm')[0].reset();
      $('.form-control').removeClass('is-invalid');
      $('.invalid-feedback').text('');
    });

    $('#notesTable').on('click','.edit-item-btn', function () {
      var noteId = $(this).data('id');
      var noteTitle = $(this).data('title');
      var noteContent = $(this).data('content');
      var isStar = $(this).data('star');

      // Populate the edit modal with the category data
      $('#editNoteId').val(noteId);
      $('#editNoteName').val(noteTitle);
      $('#editNoteContent').val(noteContent);
      if(isStar == 1) {
            $('#edit_is_starred_yes').prop('checked', true);
        } else {
            $('#edit_is_starred_no').prop('checked', true);
        }
      // Show the edit modal
      $('#editNoteModel').modal('show');
    });
    $('#editNoteForm').on('submit', function (e) {
      e.preventDefault();

      var noteId = $('#editNoteId').val();
      const NoteRoute = "<?php echo e(route('note.update', 'ID')); ?>";
      const newNoteRoute = NoteRoute.replace("ID", noteId)
      $.ajax({
        type: 'PUT',
        url: newNoteRoute,  // Adjust this URL to match your route
        data: $(this).serialize(),
        success: function (response) {
          if (response.status) {
            $('#editNoteModel').hide();
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: response.message,
            }).then(function () {
              location.reload();
            });
          }
        },
        error: function (response) {
          var errors = response.responseJSON.errors;
          if (errors) {
            $.each(errors, function (key, value) {
              if (key == 'title') {
                $('#editNoteName').addClass('is-invalid');
                $('#editNoteName').siblings('.invalid-feedback').text(value[0]);
              }
              if (key == 'content') {
                $('#editNoteContent').addClass('is-invalid');
                $('#editNoteContent').siblings('.invalid-feedback').text(value[0]);
              }
            });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: response.responseJSON.message,
            });
          }

        }
      });
    });

    // Reset edit form when the modal is hidden
    $('#editNoteModel').on('hidden.bs.modal', function () {
      $('#editNoteForm')[0].reset();
      $('.form-control').removeClass('is-invalid');
      $('.invalid-feedback').text('');
    });

    // Handle modal close button click to reset the edit form
    $('#close-edit-modal, .btn-light').on('click', function () {
      $('#editNoteForm')[0].reset();
      $('.form-control').removeClass('is-invalid');
      $('.invalid-feedback').text('');
    });
    $('#notesTable').on('click', '.remove-item-btn',function () {
      var noteId = $(this).data('id');
      $('#delete-record').data('id', noteId);
      $('#deleteNotesModal').modal('show');
    });

    $('#delete-record').on('click', function () {
      var noteId = $(this).data('id');
      console.log(noteId);
      const delRoute = "<?php echo e(route('note.delete', 'ID')); ?>";
      const newdelRoute = delRoute.replace('ID', noteId);

      $.ajax({
        type: 'DELETE',
        url: newdelRoute,
        data: {
          _token: '<?php echo e(csrf_token()); ?>'
        },
        success: function (response) {
          if (response.status) {
            $('#deleteNotesModal').hide();
            Swal.fire({
              icon: 'success',
              title: 'Deleted!',
              text: response.message,
            }).then(function () {
              location.reload();
            });
          }
        },
        error: function (response) {
          $('#deleteNotesModal').hide();
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: response.responseJSON.error,
          });
        }
      });
    });
  
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\master\resources\views/notes/index.blade.php ENDPATH**/ ?>