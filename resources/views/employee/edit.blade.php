@extends('layouts.master')
@section('title')
Edit Employee
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row">
  <div class="col-xxl-12">
    <div class="row mb-3">
      <h4 class="text-muted mb-0"><b>Edit Employee</b></h4>
    </div>
    <form action="{{ route('employee.update' ,$employee->id) }}" method="post" id="employee-edit-form" name="employee-edit-form"
      enctype="multipart/form-data">
      @csrf
      <div class="card p-3 mb-4">
        <div class="card-title mb-3"><b>Employee Details</b></div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="full_name">Full Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                  value="{{ $employee->user->name }}" name="full_name" id="full_name" placeholder="Shadab Shaikh">
                @error('full_name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ $employee->user->email }}"
                  name="email" id="email" placeholder="example@123.com">
                @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="contact">Contact <span class="text-danger">*</span></label>
                <div class="d-flex">
                  <div class="col-lg-3 pe-2">
                    <input type="text" class="form-control @error('region_code') is-invalid @enderror"
                      name="region_code" value="{{ $employee->user->region_code }}" id="region_code" placeholder="91">
                    @error('region_code')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
                  </div>
                  <div class="col-lg-9 ps-2">
                    <input type="text" class="form-control @error('contact') is-invalid @enderror" name="contact"
                      value="{{ $employee->user->contact }}" id="contact">
                    @error('contact')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="alt_contact">Alternate Phone No.</label>
                <input type="text" class="form-control @error('alt_contact') is-invalid @enderror" value="{{ $employee->alt_contact }}" name="alt_contact" id="alt_contact">
                @error('alt_contact')
          <div class="invalid-feedback">
          {{ $message }}
          </div>
        @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="password">Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                  id="password" aria-describedby="passwordInfo">
                @error('password')
          <div class="invalid-feedback">
          {{ $message }}
          </div>
          <div id="passwordInfo" class="form-text">If You want to set new password then fill the field.</div>
        @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="dept">Department</label>
                <select class="form-select @error('dept') is-invalid @enderror"  name="dept" id="dept">
                @foreach ($departments as $department)
                  <option {{ $employee->dept_id == $department->id ? 'selected' : '' }} value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
                </select>
                  @error('dept')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                  @enderror
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card p-3 mb-4">
        <div class="card-title mb-3"><b>Residential Details</b></div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-8">
              <div class="mb-3">
                <label for="address">Address</label>
                <textarea class="form-control @error('address') is-invalid @enderror" value="{{ $employee->address }}" name="address" id="address"
                  placeholder="Employee Address">{{ old('address') }}</textarea>
                @error('address')
          <div class="invalid-feedback">
          {{ $message }}
          </div>
        @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <div class="mb-3">
                  <select class="form-control @error('country') is-invalid @enderror" name="country" id="country">
                    @foreach ($countries as $country)
            <option {{ ($employee->country_id == $country->id ) ? 'selected' : ''}} value="{{ $country->id }}">{{ $country->name }}</option>
          @endforeach
                  </select>
                  @error('country')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="state" class="form-label">State</label>
                <div class="mb-3">
                  <select class="form-control @error('state') is-invalid @enderror" name="state" id="state">
                  </select>
                  @error('state')
            <div class="invalid-feedback"></div>
          @enderror
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <div class="mb-3">
                  <select class="form-control @error('city') is-invalid @enderror" name="city" id="city">
                  </select>
                  @error('city')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="pincode" class="form-label">Pincode</label>
                <input type="text" value="{{ $employee->pincode }}"
                  class="form-control @error('pincode') is-invalid @enderror" name="pincode" id="pincode"
                  placeholder="Pincode">
                @error('pincode')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card p-3 mb-4">
        <div class="card-title mb-3"><b>Document Details</b></div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="pan">PAN Number</label>
                <input type="text" class="form-control @error('pan') is-invalid @enderror" value="{{ $employee->pan }}"
                  name="pan" id="pan" placeholder="PAN Number">
                @error('pan')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="pan">PAN Documnent</label>
                <input type="file" value="{{ $employee->pan_file }}" class="form-control @error('pan_file') is-invalid @enderror" name="pan_file"
                  id="pan_file">
                @error('pan_file')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="adhar">Aadhar Number</label>
                <input type="text" class="form-control @error('adhar') is-invalid @enderror"  value="{{ $employee->adhar }}"
                  name="adhar" id="adhar" placeholder="Aadhar Number">
                @error('adhar')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="adhar">Aadhar Documnent</label>
                <input type="file" class="form-control @error('adhar_file') is-invalid @enderror"  value="{{ $employee->adhar_file }}" name="adhar_file"
                  id="adhar_file">
                @error('adhar_file')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card p-3 mb-4">
        <div class="card-title mb-3"><b>Bank Details</b></div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="acc_holder_name">Account Holder Name</label>
                <input type="text" class="form-control @error('acc_holder_name') is-invalid @enderror"
                  name="acc_holder_name" value="{{ $employee->acc_holder_name }}" id="acc_holder_name"
                  placeholder="Account Holder Name">
                @error('acc_holder_name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="acc_number">Account Number</label>
                <input type="text" class="form-control @error('acc_number') is-invalid @enderror"
                  value="{{ $employee->acc_number }}" name="acc_number" id="acc_number" placeholder="Account Number">
                @error('acc_number')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="ifsc">IFSC Code</label>
                <input type="text" class="form-control @error('ifsc') is-invalid @enderror" name="ifsc" id="ifsc"
                  value="{{ $employee->ifsc }}" placeholder="IFSC Code">
                @error('ifsc')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="bank_name">Bank Name</label>
                <input type="text" class="form-control @error('bank_name') is-invalid @enderror" name="bank_name"
                  id="bank_name"  value="{{ $employee->bank_name }}" placeholder="Bank Name">
                @error('bank_name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
              </div>
            </div>
            <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="salary">Salary</label>
                <input type="number" class="form-control @error('salary') is-invalid @enderror"  value="{{ $employee->salary }}" name="salary" step="0.01" min="0"
                  id="salary" placeholder="10,000">
                @error('salary')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="passbook">Passbook</label>
                <input type="file"  value="{{ $employee->passbook }}" class="form-control @error('passbook') is-invalid @enderror" name="passbook"
                  id="passbook">
                @error('passbook')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12 mb-3">
        <div class="hstack gap-2 justify-content-end">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-soft-success">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
@section('script')
<!-- apexcharts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ URL::asset('build/js/pages/profile-setting.init.js') }}"></script>
<script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('build/select2/js/select2.min.js') }}"></script>
<!-- Include jQuery -->
<!-- dashboard init -->
<script src="{{ URL::asset('build/js/app.js') }}"></script>
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

    $('#state').select2();
    $('#city').select2();
    $('#country').select2();
    $('#dept').select2();

    $('#country').change(function () {
      fetchStates($(this).val());
    });

    $('#state').change(function () {
      fetchCities($(this).val());
    });

    function fetchStates(countryId) {
      const fetchRoute = "{{ route('fetch.states', ':countryId') }}".replace(":countryId", countryId);
      $.ajax({
        url: fetchRoute,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
          $('#state').empty();
          response.states.forEach(state => {
            $('#state').append(new Option(state.name, state.id, state.id == "{{ $employee->state_id }}", state.id == "{{ $employee->state_id }}"));

          });
          $('#state').trigger('change');
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
            $('#city').append(new Option(city.name, city.id, city.id == "{{ $employee->city_id }}", city.id == "{{ $employee->city_id }}"));
          });
          $('#city').trigger('change');
        },
        error: function (xhr, status, error) {
          console.error('AJAX Error: ' + status + ' - ' + error);
        }
      });
    }

    function initializeSelect2() {
      var initialCountryId = $('#country').val();
      var initialStateId = $('#state').val();
      var initialCityId = $('#city').val();

      if (initialCountryId) {
        fetchStates(initialCountryId);
      }

      // Ensure cities are fetched only after states are loaded
      $('#state').one('change', function () {
        if (initialStateId) {
          fetchCities(initialStateId);
        }
        if (initialCityId) {
          $('#city').val(initialCityId).trigger('change');
        }
      });

      if (initialStateId) {
        $('#state').val(initialStateId).trigger('change');
      }
    }

    initializeSelect2();
  });
</script>
@endsection