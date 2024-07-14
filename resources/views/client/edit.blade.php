@extends('layouts.master')
@section('title')
Edit Client
@endsection
@section('css')
<link href="{{ asset('build/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('build/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row">
  <div class="col-xxl-12">
    <div class="card">
    <div class="card-header">
        <h4 class="card-title mb-0">Edit Client</h4>
      </div>
      <div class="card-body p-4">
        <form action="{{ route('client.update',$client->id)}}" method="post" id="client-create-form" name="client-create-form"
          enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                  placeholder="First name" value="{{ $client->first_name }}" name="first_name">
                @if ($errors->has('first_name'))
                  <div class="invalid-feedback">
                    {{ $errors->first('first_name') }}
                  </div>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control  @error('last_name') is-invalid @enderror" id="last_name"
                  placeholder="Last name"value="{{ $client->last_name }}" name="last_name">
                @if ($errors->has('last_name'))
                  <div class="invalid-feedback">
                    {{ $errors->first('last_name') }}
                  </div>
                @endif
              </div>
            </div>
           
            <div class="col-md-6">
              <div class="mb-3">
                <label for="business" class="form-label">Business<span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('business') is-invalid @enderror" id="business"
                  placeholder="Business Name" value="{{ $client->business }}" name="business">
                        @if ($errors->has('business'))
                  <div class="invalid-feedback">
                    {{ $errors->first('business') }}
                  </div>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="contact" class="form-label">Contact <span class="text-danger">*</span></label>
                <input type="tel" class="form-control @error('contact') is-invalid @enderror" id="contact"
                  placeholder="contact" value="{{ $client->contact }}" name="contact">
                        @if ($errors->has('contact'))
                  <div class="invalid-feedback">
                    {{ $errors->first('contact') }}
                  </div>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="alter_contact" class="form-label">Alternate Phone no.</label>
                <input type="text" class="form-control @error('alter_contact') is-invalid @enderror" id="alter_contact"
                  placeholder="Phone no." value="{{ $client->alter_contact }}" name="alter_contact">
                @if ($errors->has('alter_contact'))
                  <div class="invalid-feedback">
                    {{ $errors->first('alter_contact') }}
                  </div>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                  placeholder="email Name" value="{{ $client->email }}"  name="email">
                        @if ($errors->has('email'))
                  <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                  </div>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="website" class="form-label">website</label>
                <input type="text" class="form-control @error('website') is-invalid @enderror" id="website"
                  placeholder="Website" value="{{ $client->website }}" name="website">
                @if ($errors->has('website'))
                  <div class="invalid-feedback">
                    {{ $errors->first('website') }}
                  </div>
                @endif
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <div class="mb-3">
                  <select class="form-control" name="country" id="country-name">
                    @foreach ($countries as $country)
                      <option {{ ($client->country_id == $country->id) ? 'selected':''}} value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label for="state-code" class="form-label">State</label>
                <div class="mb-3">
                  <select class="form-control" name="state" id="state-code">
                  </select>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <div class="mb-3">
                  <select class="form-control" name="city" id="city">
                  </select>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label for="postal_code" class="form-label">Postal Code</label>
                <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code"
                  placeholder="Zip Code" value="{{ $client->postal_code }}" name="postal_code">
                @if ($errors->has('postal_code'))
                  <div class="invalid-feedback">
                    {{ $errors->first('postal_code') }}
                  </div>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="GST" class="form-label">GST NO</label>
                <input type="text" class="form-control @error('GST') is-invalid @enderror" id="GST"
                  placeholder="GSTIN" value="{{ $client->GST }}" name="GST">
                @if ($errors->has('GST'))
                  <div class="invalid-feedback">
                    {{ $errors->first('GST') }}
                  </div>
                @endif
              </div>
            </div>

            <div class="col-md-6">
              <div class="mb-3">
                <label for="Address" class="form-label">Address</label>
                <textarea class="form-control @error('Address') is-invalid @enderror" cols="5" rows="5" id="Address"
                  placeholder="Address" value="{{ $client->Address }}" name="Address"></textarea>
                @if ($errors->has('Address'))
                <div class="invalid-feedback">
                  {{ $errors->first('Address') }}
                </div>
              @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                  <label for="notes" class="form-label">Notes</label>
                  <textarea class="form-control @error('notes') is-invalid @enderror" cols="5" rows="5" id="notes"
                      placeholder="Add Notes Here" value="{{ $client->Notes }}" name="notes"></textarea>
                  @error('notes')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                  @enderror
              </div>
            </div>
          
            <div class="col-lg-12">
              <div class="hstack gap-2 justify-content-end">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-soft-success">Cancel</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<!-- apexcharts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('build/js/pages/profile-setting.init.js') }}"></script>
<script src="{{ asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('build/select2/js/select2.min.js') }}"></script>
<!-- Include jQuery -->
<!-- dashboard init -->
<script src="{{ asset('build/js/app.js') }}"></script>
<script>
  $(document).ready(function () {

    @if(Session::has('success'))
    Swal.fire({
      title: 'Success!',
      text: '{{ Session::get('success') }}',
      icon: 'success',
      showCancelButton: false,
      customClass: {
      confirmButton: 'btn btn-primary w-xs me-2 mt-2',
      },
      buttonsStyling: false,
      showCloseButton: true
    });
  @endif

    @if(Session::has('error'))
    Swal.fire({
      title: 'Error!',
      text: "{{ Session::get('error') }}",
      icon: 'error',
      showCancelButton: false,
      customClass: {
      confirmButton: 'btn btn-danger w-xs mt-2',
      },
      buttonsStyling: false,
      showCloseButton: true
    });
  @endif

  $('#state-code').select2();
    $('#city').select2();
    $('#country-name').select2();

    $('#country-name').change(function () {
      fetchStates($(this).val());
    });

    $('#state-code').change(function () {
      fetchCities($(this).val());
    });

    function fetchStates(countryId) {
      const fetchRoute = "{{ route('fetch.states', ':countryId') }}".replace(":countryId", countryId);
      $.ajax({
        url: fetchRoute,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
          $('#state-code').empty();
          response.states.forEach(state => {
            $('#state-code').append(new Option(state.name, state.id, state.id == "{{ $client->state_id }}", state.id == "{{ $client->state_id }}"));

          });
          $('#state-code').trigger('change');
        },
        error: function (xhr, status, error) {
          console.error('AJAX Error: ' + status + ' - ' + error);
        }
      });
    }

    function fetchCities(stateId) {
      const fetchCitiesRoute = "{{ route('fetch.cities', ':stateId') }}".replace(':stateId', stateId);
      $.ajax({
        url: fetchCitiesRoute,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
          console.log('Cities fetched:', response.cities);
          $('#city').empty();
          response.cities.forEach(city => {
            $('#city').append(new Option(city.name, city.id , city.id == "{{ $client->city_id }}", city.id == "{{ $client->city_id }}"));
          });
          $('#city').trigger('change');
        },
        error: function (xhr, status, error) {
          console.error('AJAX Error: ' + status + ' - ' + error);
        }
      });
    }

    function initializeSelect2() {
      var initialCountryId = $('#country-name').val();
      var initialStateId = $('#state-code').val();
      var initialCityId = $('#city').val();

      if (initialCountryId) {
        fetchStates(initialCountryId);
      }

      // Ensure cities are fetched only after states are loaded
      $('#state-code').one('change', function() {
        if (initialStateId) {
          fetchCities(initialStateId);
        }
        if (initialCityId) {
          $('#city').val(initialCityId).trigger('change');
        }
      });

      if (initialStateId) {
        $('#state-code').val(initialStateId).trigger('change');
      }
    }

    initializeSelect2();
  });
</script>
@endsection