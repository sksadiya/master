$('select').select2();
    $('#clientName').change(function () {
      console.log($(this).val());
      fetchClient($(this).val());
      fetchProject($(this).val());
    });
  function fetchClient(clientId) {
      const fetchClientWithId = "{{ route('fetch.client', ':clientId') }}".replace(':clientId', clientId);
      $.ajax({
        url: fetchClientWithId,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
          if (response && response.client && response.client.length > 0) {
            const client = response.client[0];  // Get the first (and only) client object from the array
            updateClientInfo(client);
          } else {
            console.error('Client data is not available in the response');
          }
        },
        error: function (xhr, status, error) {
          console.error('AJAX Error: ' + status + ' - ' + error);
        }
      });
    }
    function fetchProject(clientId) {
      const fetchProjectWithId = "{{ route('fetch.project', ':clientId') }}".replace(':clientId', clientId);
      $.ajax({
        url: fetchProjectWithId,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
          if (response && response.projects && response.projects.length > 0) {
            console.log('project found');
            $('#select-project').empty().append('<option value="">Select Project</option>');

        // Append new options from the fetched projects
        $.each(response.projects, function (key, project) {
          $('#select-project').append('<option value="' + project.id + '">' + project.name + '</option>');
        });

        // If editing, check if $invoice exists and pre-select the project
                @if(isset($invoice) && $invoice->project_id)
                    var selectedProjectId = "{{ $invoice->project_id }}";  // Get the project ID from the invoice
                    $('#select-project').val(selectedProjectId).trigger('change');
                @endif

                // Re-initialize Select2 to apply the updates
                $('#select-project').select2();

          } else {
            console.error('Client project data is not available in the response');
            $('#select-project').empty().append('<option value="">No Projects Found</option>').select2();
          }
        },
        error: function (xhr, status, error) {
          console.error('AJAX Error: ' + status + ' - ' + error);
        }
      });
    }

    function initializeSelect2() {
      var initialClientId = $('#clientName').val();

      if (initialClientId) {
        fetchClient(initialClientId);
        fetchProject(initialClientId);
      }
    }
    initializeSelect2();

    function updateClientInfo(client) {
      $('#billingName').val(client.first_name + ' ' + client.last_name);
      $('#billingAddress').val(client.Address);
      $('#billingPhoneno').val(client.contact);
      $('#billingTaxno').val(client.GST);
      $('#billingEmail').val(client.email);
    }