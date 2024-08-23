<?php $__env->startSection('title'); ?>
Task Notes
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title mb-0">Task Notes</h4>
      </div>

      <div class="card-body">
        <div class="listjs-table" id="taxesList">
          <div class="row g-4 mb-3">
            <div class="col-sm-auto">
              <div>
                <button type="button" class="btn btn-primary add-btn" data-bs-toggle="modal" id="create-btn"
                  data-bs-target="#addTaskNotesModal"><i class="fas fa-plus-circle me-2"></i> Add Notes</button>
              </div>
            </div>
          </div>

          <div class="table-responsive table-card mt-3 mb-1">
            <table class="table align-middle table-nowrap" id="taskNotesTable">
              <thead class="table-light">
                <tr>
                  <th>Title</th>
                  <th>comment</th>
                  <?php if(Auth::user()->can('Edit Task Notes') || Auth::user()->can('Delete Task Notes')): ?>
            <th>Action</th>
          <?php endif; ?>
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
<div class="modal fade" id="addTaskNotesModal" tabindex="-1" aria-labelledby="addTaskNotesModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light p-3">
        <h5 class="modal-title" id="addTaskNotesModalLabel">Add Notes</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
          id="close-add-modal"></button>
      </div>
      <form id="addTaskNoteForm" name="addTaskNoteForm" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" name="user" value="<?php echo e(Auth::id()); ?>">
          <div class="mb-3">
            <label for="addTaxname" class="form-label">Task</label>
            <select name="task" id="task" class="form-control">
              <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($task->id); ?>"><?php echo e($task->title); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <div class="invalid-feedback"></div>
          </div>
          <div class="mb-3">
            <label for="attachment" class="form-label">Attachment</label>
            <input type="file" name="attachment" id="attachment" class="form-control">
            <div class="invalid-feedback"></div>
          </div>
          <div class="mb-3">
            <label for="comment" class="form-label">Comment</label>
            <textarea name="comment" id="comment" class="form-control"></textarea>
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

<!-- Edit Task Note Modal -->
<div class="modal fade" id="editTaskNotesModal" tabindex="-1" aria-labelledby="editTaskNotesModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light p-3">
        <h5 class="modal-title" id="editTaskNotesModalLabel">Edit Note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
          id="close-edit-modal"></button>
      </div>
      <form id="editTaskNoteForm" name="editTaskNoteForm" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" name="user" value="<?php echo e(Auth::id()); ?>">
          <input type="hidden" name="note" id="note" value="">
          <div class="mb-3">
            <label for="addTaxname" class="form-label">Task</label>
            <select name="task" id="editTask" class="form-control">
              <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($task->id); ?>"><?php echo e($task->title); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
            </select>
            <div class="invalid-feedback"></div>
          </div>
          <div class="mb-3">
            <label for="attachment" class="form-label">Attachment</label>
            <input type="file" name="attachment" id="editAttachment" class="form-control">
            <div class="invalid-feedback"></div>
            <div class="" id="attFile"></div>
          </div>
          <div class="mb-3">
            <label for="comment" class="form-label">Comment</label>
            <textarea name="comment" id="editComment" class="form-control"></textarea>
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
<div class="modal fade zoomIn" id="confirmationModal" tabindex="-1" aria-hidden="true">
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
            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Task Note?</p>
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
    <?php if(Session::has('success')): ?>
    Swal.fire({
    title: 'Success!',
    text: '<?php echo e(Session::get('success')); ?>',
    icon: 'success',
    showCancelButton: false,
    customClass: {
      confirmButton: 'btn btn-primary w-xs me-2 mt-2',
    },
    buttonsStyling: false,
    showCloseButton: true
    });
  <?php endif; ?>

  <?php if(Session::has('error')): ?>
    Swal.fire({
    title: 'Error!',
    text: "<?php echo e(Session::get('error')); ?>",
    icon: 'error',
    showCancelButton: false,
    customClass: {
      confirmButton: 'btn btn-danger w-xs mt-2',
    },
    buttonsStyling: false,
    showCloseButton: true
    });
  <?php endif; ?>
    $('#taskNotesTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: '<?php echo e(route('taskNotes.data')); ?>',
        type: 'GET',
        dataSrc: function (json) {
          console.log('Data received:', json);
          return json.data;
        },
        error: function (xhr, textStatus, errorThrown) {
          console.error('AJAX error:', textStatus, errorThrown);
        }
      },
      columns: [
        { data: 'title', name: 'title' },
        { data: 'comment', name: 'comment' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
      ],
      order: [[0, 'asc'], [1, 'desc']], // Example of default multi-column ordering
      pageLength: 10
    });
    $('#addTaskNoteForm').on('submit', function (e) {
      e.preventDefault();
      var formData = new FormData(this);
      formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
      $.ajax({
        type: 'POST',
        url: "<?php echo e(route('taskNote.add')); ?>",
        data: formData,
        contentType: false, // Prevent jQuery from setting content type
        processData: false, // Prevent jQuery from processing the data
        success: function (response) {
          if (response.status) {
            $('#addTaskNotesModal').hide();
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

    $('#addTaskNotesModal').on('hidden.bs.modal', function () {
      $('#addTaskNoteForm')[0].reset();
      $('.form-control').removeClass('is-invalid');
      $('.invalid-feedback').text('');
    });

    // Handle modal close button click to reset the form
    $('#close-add-modal, .btn-light').on('click', function () {
      $('#addTaskNoteForm')[0].reset();
      $('.form-control').removeClass('is-invalid');
      $('.invalid-feedback').text('');
    });

    $('#taskNotesTable').on('click', '.edit-item-btn', function () {
      var noteId = $(this).data('id');
      var task = $(this).data('task');
      var comment = $(this).data('comment');
      var attachment = $(this).data('attachment');

      // Populate the edit modal with the category data
      $('#note').val(noteId);
      $('#editTask').val(task);
      $('#attFile').text(attachment);
      $('#editComment').text(comment);
      $('#editTaskNotesModal').modal('show');
    });

    $('#editTaskNoteForm').on('submit', function (e) {
      e.preventDefault();
      var formData = new FormData(this);
      formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
      var noteId = $('#note').val();
      const TaskRoute = "<?php echo e(route('taskNote.update', 'ID')); ?>";
      const newTaskRoute = TaskRoute.replace("ID", noteId)
      $.ajax({
        type: 'POST',
        url: newTaskRoute,  // Adjust this URL to match your route
        data: formData,
        contentType: false, // Prevent jQuery from setting content type
    processData: false, // Prevent jQuery from processing the data
        success: function (response) {
          if (response.status) {
            $('#editTaskNotesModal').hide();
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
              if (key == 'comment') {
                $('#editComment').addClass('is-invalid');
                $('#editComment').siblings('.invalid-feedback').text(value[0]);
              }
              if (key == 'attachment') {
                $('#editAttachment').addClass('is-invalid');
                $('#editAttachment').siblings('.invalid-feedback').text(value[0]);
              }
              if (key == 'task') {
                $('#editTask').addClass('is-invalid');
                $('#editTask').siblings('.invalid-feedback').text(value[0]);
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
    $('#editTaxModal').on('hidden.bs.modal', function () {
      $('#editTaxForm')[0].reset();
      $('.form-control').removeClass('is-invalid');
      $('.invalid-feedback').text('');
    });

    // Handle modal close button click to reset the edit form
    $('#close-edit-modal, .btn-light').on('click', function () {
      $('#editTaxForm')[0].reset();
      $('.form-control').removeClass('is-invalid');
      $('.invalid-feedback').text('');
    });


    $('#taskNotesTable').on('click', '.remove-item-btn',function () {
      var noteId = $(this).data('id');
      $('#delete-record').data('id', noteId);
    });
    $('#delete-record').on('click', function () {
      var noteId = $(this).data('id');
      console.log(noteId);
      const delRoute = "<?php echo e(route('taskNote.delete', 'ID')); ?>";
      const newdelRoute = delRoute.replace('ID', noteId);

      $.ajax({
        type: 'DELETE',
        url: newdelRoute,
        data: {
          _token: '<?php echo e(csrf_token()); ?>'
        },
        success: function (response) {
          if (response.status) {
            $('#confirmationModal').hide();
            console.log(response.status);
            location.reload();
          }
        },
        error: function (response) {
          $('#confirmationModal').hide();
          location.reload();
        }
      });
    });
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\master\resources\views/task_notes/index.blade.php ENDPATH**/ ?>