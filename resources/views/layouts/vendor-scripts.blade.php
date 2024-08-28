<script src="{{ URL::asset('build/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<script src="{{ URL::asset('build/js/plugins.js') }}"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.notification-checkbox');
    const removeBtn = document.getElementById('remove-notifications-btn');

    // Enable/Disable Remove Button Based on Checkbox Selections
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            updateRemoveButtonState();
        });
    });

    // Update Remove Button State
    function updateRemoveButtonState() {
        const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
        removeBtn.disabled = !anyChecked; // Enable button if any checkbox is checked
    }

    // Handle Remove Notifications Button Click
    removeBtn.addEventListener('click', function() {
        const selectedNotifications = Array.from(checkboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.getAttribute('data-id'));

        if (selectedNotifications.length > 0) {
            // Make AJAX request to delete notifications
            fetch("{{ route('notifications.delete') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ notification_ids: selectedNotifications })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove deleted notifications from UI
                    selectedNotifications.forEach(function(id) {
                        const checkbox = document.querySelector(`.notification-checkbox[data-id='${id}']`);
                        if (checkbox) {
                            checkbox.closest('.dropdown-item-cart').remove();
                        }
                    });
                    updateRemoveButtonState(); // Update button state after deletion

                    if (document.querySelectorAll('.dropdown-item-cart').length === 0) {
                        document.getElementById('empty-cart').classList.remove('d-none');
                        document.getElementById('empty-cart').classList.add('d-block');
                    }
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });
});

</script>
@yield('script')
@yield('script-bottom')
