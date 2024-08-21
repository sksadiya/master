@extends('layouts.master')
@section('title')
Add Task
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row">
  <div class="col-xxl-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title mb-0">Add task</h4>
      </div>
      <div class="card-body p-4">
        <form action="{{ route('task.store') }}" method="post" id="expense-create-form" name="expense-create-form" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="title">Title <span class="text-danger">*</span></label>
                <input type="text" placeholder="Title" class="form-control @error('title') is-invalid @enderror"
                  name="title" id="title">
                @error('title')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                  <option value="pending">Pending</option>
                  <option value="in_progress">Inprogress</option>
                  <option value="completed">Completed</option>
                </select>
                @error('status')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="priority">Priority</label>
                <select name="priority" id="priority" class="form-control @error('priority') is-invalid @enderror">
                  <option value="low">Low</option>
                  <option value="medium">Medium</option>
                  <option value="high">High</option>
                </select>
                @error('priority')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="assign_to">Assigned to</label>
                <select name="assign_to[]" id="assign_to" class="form-control @error('assign_to') is-invalid @enderror"
                  multiple="multiple">
                  @if($users)
            @foreach ($users as $user)
        <option value="{{ $user->id }}">{{ $user->name }}</option>
      @endforeach
          @endif
                </select>
                @error('assign_to')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="due_date">Due Date</label>
                <input type="date" name="due_date" id="due_date"
                  class="form-control @error('due_date') is-invalid @enderror">
                @error('due_date')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="description">Description</label>
                <textarea rows="3" class="form-control @error('description') is-invalid @enderror" name="description"
                  id="description" placeholder="Description"></textarea>
                @error('description')
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
<script src="{{ URL::asset('build/js/pages/profile-setting.init.js') }}"></script>
<script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ URL::asset('build/select2/js/select2.min.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
<script>
  $(document).ready(function () {
    $('#priority').select2();
    $('#status').select2();
    $('#assign_to').select2();
    flatpickr("#due_date", {
      dateFormat: "Y-m-d",
        });
  });
</script>
@endsection