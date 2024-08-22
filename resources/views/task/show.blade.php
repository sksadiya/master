@extends('layouts.master')
@section('title')
Task Details
@endsection
@section('css')
<link href="{{ URL::asset('build/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row">
    <div class="col-xxl-3">
        <div class="card">
            <div class="card-body text-center">
                <h6 class="card-title mb-3 flex-grow-1 text-start">Time Tracking</h6>
                <div class="mb-2">
                    <lord-icon src="https://cdn.lordicon.com/kbtmbyzy.json" trigger="loop"
                        colors="primary:#405189,secondary:#02a8b5" style="width:90px;height:90px">
                    </lord-icon>
                </div>
                <h3 class="mb-1" id="time-remaining"></h3>
            </div>
        </div>
        <!--end card-->
        <div class="card mb-3">
            <div class="card-body">
                <div class="table-card">
                    <table class="table mb-0">
                        <tbody>
                            <tr>
                                <td class="fw-medium">Tasks Title</td>
                                <td>{{ $task->title }}</td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Priority</td>
                                <td>
                                    @if($task->priority == 'low')
                                        <span
                                            class="badge bg-danger-subtle text-danger text-uppercase">{{ $task->priority }}</span>
                                    @elseif($task->priority == 'medium')
                                        <span class="badge bg-info-subtle text-info">{{ $task->priority }}</span>
                                    @else
                                        <span class="badge bg-success-subtle text-success">{{ $task->priority }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Status</td>
                                <td>
                                    @if($task->status == 'pending')
                                        <span class="badge bg-warning-subtle text-warning">Pending</span>
                                    @elseif ($task->status == 'in_progress')
                                        <span class="badge bg-warning-subtle text-warning">Inprogress</span>
                                    @else
                                        <span class="badge bg-success-subtle text-success">Completed</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-medium">Due Date</td>
                                <td>{{ \Carbon\Carbon::parse($task->due_date)->format('d M, Y') }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <!--end table-->
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <form action="{{ route('task.updateStatus', $task->id)}}" method="post">
                @csrf
                <div class="card-body">
                    <div class="table-card">
                        <table class="table mb-0">

                            <tbody>
                                <tr>
                                    <td class="fw-medium">
                                        <label for="status">Update Status</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">
                                        <select name="status" id="status"
                                            class="form-control @error('status') is-invalid @enderror">
                                            <option {{ ($task->status == 'pending') ? 'selected' : '' }} value="pending">
                                                Pending</option>
                                            <option {{ ($task->status == 'in_progress') ? 'selected' : '' }}
                                                value="in_progress">Inprogress</option>
                                            <option {{ ($task->status == 'completed') ? 'selected' : '' }}
                                                value="completed">
                                                Completed</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>


        <!--end card-->
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex mb-3">
                    <h6 class="card-title mb-0 flex-grow-1">Assigned To</h6>
                    <div class="flex-shrink-0">
                        <button type="button" class="btn btn-soft-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#inviteMembersModal"><i class="ri-share-line me-1 align-bottom"></i>
                            Assigned Member</button>
                    </div>
                </div>
                <ul class="list-unstyled vstack gap-3 mb-0">
                    @foreach ($task->assignees as $user)
                        <li>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    @if($user->avatar)
                                        <img src="{{ URL::asset('public/images/' . $user->avatar) }}" alt=""
                                            class="avatar-xs rounded-circle">
                                    @else
                                        <img src="{{ URL::asset('public/images/user-dummy-img.jpg') }}" alt=""
                                            class="avatar-xs rounded-circle">
                                    @endif
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <h6 class="mb-1"><a href="pages-profile">{{ $user->name }}</a></h6>
                                    <p class="text-muted mb-0">{{ $user->email }}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!--end card-->
    </div>
    <!---end col-->
    <div class="col-xxl-9">
        <div class="card">
            <div class="card-body">
                <div class="text-muted">
                    <div class="border-bottom border-bottom-dashed">
                        <h6 class="mb-3 fw-bold text-uppercase">Title</h6>
                        <p><b>{{ $task->title}}</b></p>
                    </div>
                    <div class="border-bottom border-bottom-dashed mt-4">
                        <h6 class="mb-3 fw-bold text-uppercase">Description</h6>
                        <p>{{ $task->description}}</p>
                    </div>
                </div>
            </div>
        </div>
        <!--end card-->
        <div class="card">
            <div class="card-header">
                <div>
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#comments" role="tab">
                                Comments ({{ $task->comments->count() }})
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#messages-1" role="tab">
                                Attachments File
                            </a>
                        </li>
                    </ul>
                    <!--end nav-->
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="comments" role="tabpanel">
                        <h5 class="card-title mb-4">Comments</h5>
                        <div data-simplebar class="px-3 mx-n3 mb-2">
                            @foreach($task->comments as $comment)
                                <div class="d-flex mb-4">
                                    <div class="flex-shrink-0">
                                        @if($comment->user->avatar)
                                            <img src="{{ URL::asset('public/images/' . $comment->user->avatar) }}" alt=""
                                                class="avatar-xs rounded-circle" />
                                        @else
                                            <img src="{{ URL::asset('public/images/user-dummy-img.jpg') }}" alt=""
                                                class="avatar-xs rounded-circle" />
                                        @endif
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="fs-15"><a href="pages-profile">{{ $comment->user->name }}</a> <small
                                                class="text-muted">24 Dec 2021 - 05:20PM</small></h5>
                                        <p class="text-muted">{{ $comment->comment }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <form action="{{ route('comment.store') }}" class="mt-4" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="mb-3">
                                    @error('task')
                                        <div class="alert alert-danger material-shadow" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror
                                    @error('user')
                                        <div class="alert alert-danger material-shadow" role="alert">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-lg-12">
                                    <input type="hidden" name="task" value="{{ $task->id}}">
                                    <input type="hidden" name="user" value="{{ Auth::id()}}">
                                    <label for="exampleFormControlTextarea1" class="form-label">Leave a
                                        Comments</label>
                                    <textarea
                                        class="form-control bg-light border- @error('comment') is-invalid @enderror"
                                        name="comment" id="exampleFormControlTextarea1" rows="3"
                                        placeholder="Enter comments"></textarea>
                                    @error('comment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="attachment">Attachment</label>
                                        <input type="file"
                                            class="form-control @error('attachment') is-invalid @enderror"
                                            id="attachment" name="attachment">
                                        @error('attachment')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-success">Post Comments</button>
                                </div>
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                    <!--end tab-pane-->
                    <div class="tab-pane" id="messages-1" role="tabpanel">
                        <div class="table-responsive table-card">
                            <table class="table table-borderless align-middle mb-0">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th scope="col">File Name</th>
                                        <th scope="col">Task Title</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Size</th>
                                        <th scope="col">Upload Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($task->comments as $comment)
                                        @if($comment->attachment)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm">
                                                            <div
                                                                class="avatar-title bg-primary-subtle text-primary rounded fs-20">
                                                                <i class="far fa-folder"></i>
                                                            </div>
                                                        </div>
                                                        <div class="ms-3 flex-grow-1">
                                                            <h6 class="fs-15 mb-0"><a href="{{ asset('/public/images/'.$comment->attachment)}}"
                                                                target="_blank"    class="link-secondary">{{ $comment->attachment }}</a></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $comment->task->title }}</td>
                                                <td>{{ strtoupper(File::extension($comment->attachment)) }}</td>
                                                <td>
                                                    @php
                                                        $fileSize = File::size(public_path('/images/' . $comment->attachment));
                                                        if ($fileSize >= 1048576) {
                                                            echo number_format($fileSize / 1048576, 2) . ' MB';
                                                        } else {
                                                            echo number_format($fileSize / 1024, 2) . ' KB';
                                                        }
                                                    @endphp
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($comment->created_at)->format('d M, Y') }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            <!--end table-->
                        </div>
                    </div>
                    <!--end tab-pane-->
                </div>
                <!--end tab-content-->
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
</div>
<!--end row-->

<div class="modal fade" id="inviteMembersModal" tabindex="-1" aria-labelledby="inviteMembersModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-3 ps-4 bg-success-subtle">
                <h5 class="modal-title" id="inviteMembersModalLabel">Team Members</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="search-box mb-3">
                    <input type="text" class="form-control bg-light border-light" placeholder="Search here...">
                    <i class="ri-search-line search-icon"></i>
                </div>

                <div class="mb-4 d-flex align-items-center">
                    <div class="me-2">
                        <h5 class="mb-0 fs-13">Members :</h5>
                    </div>
                    <div class="avatar-group justify-content-center">
                        <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip"
                            data-bs-trigger="hover" data-bs-placement="top" title="Tonya Noble">
                            <div class="avatar-xs">
                                <img src="{{ URL::asset('build/images/users/avatar-10.jpg') }}" alt=""
                                    class="rounded-circle img-fluid">
                            </div>
                        </a>
                        <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip"
                            data-bs-trigger="hover" data-bs-placement="top" title="Thomas Taylor">
                            <div class="avatar-xs">
                                <img src="{{ URL::asset('build/images/users/avatar-8.jpg') }}" alt=""
                                    class="rounded-circle img-fluid">
                            </div>
                        </a>
                        <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip"
                            data-bs-trigger="hover" data-bs-placement="top" title="Nancy Martino">
                            <div class="avatar-xs">
                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt=""
                                    class="rounded-circle img-fluid">
                            </div>
                        </a>
                    </div>
                </div>
                <div class="mx-n4 px-4" data-simplebar style="max-height: 225px;">
                    <div class="vstack gap-3">
                        <div class="d-flex align-items-center">
                            <div class="avatar-xs flex-shrink-0 me-3">
                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt=""
                                    class="img-fluid rounded-circle">
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fs-13 mb-0"><a href="javascript:void(0);" class="text-body d-block">Nancy
                                        Martino</a></h5>
                            </div>
                            <div class="flex-shrink-0">
                                <button type="button" class="btn btn-light btn-sm">Add</button>
                            </div>
                        </div>
                        <!-- end member item -->
                        <div class="d-flex align-items-center">
                            <div class="avatar-xs flex-shrink-0 me-3">
                                <div class="avatar-title bg-danger-subtle text-danger rounded-circle">
                                    HB
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fs-13 mb-0"><a href="javascript:void(0);" class="text-body d-block">Henry
                                        Baird</a></h5>
                            </div>
                            <div class="flex-shrink-0">
                                <button type="button" class="btn btn-light btn-sm">Add</button>
                            </div>
                        </div>
                        <!-- end member item -->
                        <div class="d-flex align-items-center">
                            <div class="avatar-xs flex-shrink-0 me-3">
                                <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt=""
                                    class="img-fluid rounded-circle">
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fs-13 mb-0"><a href="javascript:void(0);" class="text-body d-block">Frank
                                        Hook</a></h5>
                            </div>
                            <div class="flex-shrink-0">
                                <button type="button" class="btn btn-light btn-sm">Add</button>
                            </div>
                        </div>
                        <!-- end member item -->
                        <div class="d-flex align-items-center">
                            <div class="avatar-xs flex-shrink-0 me-3">
                                <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" alt=""
                                    class="img-fluid rounded-circle">
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fs-13 mb-0"><a href="javascript:void(0);" class="text-body d-block">Jennifer
                                        Carter</a></h5>
                            </div>
                            <div class="flex-shrink-0">
                                <button type="button" class="btn btn-light btn-sm">Add</button>
                            </div>
                        </div>
                        <!-- end member item -->
                        <div class="d-flex align-items-center">
                            <div class="avatar-xs flex-shrink-0 me-3">
                                <div class="avatar-title bg-success-subtle text-success rounded-circle">
                                    AC
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fs-13 mb-0"><a href="javascript:void(0);" class="text-body d-block">Alexis
                                        Clarke</a></h5>
                            </div>
                            <div class="flex-shrink-0">
                                <button type="button" class="btn btn-light btn-sm">Add</button>
                            </div>
                        </div>
                        <!-- end member item -->
                        <div class="d-flex align-items-center">
                            <div class="avatar-xs flex-shrink-0 me-3">
                                <img src="{{ URL::asset('build/images/users/avatar-7.jpg') }}" alt=""
                                    class="img-fluid rounded-circle">
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fs-13 mb-0"><a href="javascript:void(0);" class="text-body d-block">Joseph
                                        Parker</a></h5>
                            </div>
                            <div class="flex-shrink-0">
                                <button type="button" class="btn btn-light btn-sm">Add</button>
                            </div>
                        </div>
                        <!-- end member item -->
                    </div>
                    <!-- end list -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light w-xs" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success w-xs">Assigned</button>
            </div>
        </div>
        <!-- end modal-content -->
    </div>
    <!-- modal-dialog -->
</div>
<!-- end modal -->
@endsection
@section('script')
<script src="{{ URL::asset('build/select2/js/select2.min.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
<script>
    $(document).ready(function () {
        let remainingSeconds = Math.floor({{ $remainingSeconds }});

        function updateTimeRemaining() {
            if (remainingSeconds <= 0) {
                document.getElementById('time-remaining').innerText = "Time's up!";
                clearInterval(timer);
                return;
            }

            const hours = Math.floor(remainingSeconds / 3600);
            const minutes = Math.floor((remainingSeconds % 3600) / 60);
            const seconds = remainingSeconds % 60;

            document.getElementById('time-remaining').innerText = `${hours} hrs ${minutes} min ${seconds} sec`;

            remainingSeconds--;
        }

        const timer = setInterval(updateTimeRemaining, 1000); // Update every second

        updateTimeRemaining();
        $('#status').select2();
    });
</script>
@endsection