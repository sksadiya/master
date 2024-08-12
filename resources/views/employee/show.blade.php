@extends('layouts.master')
@section('title')
{{ $employee->user->name }}
@endsection
@section('css')
<link href="{{ URL::asset('build/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<!-- <link rel="stylesheet" href="{{ URL::asset('build/libs/glightbox/css/glightbox.min.css') }}"> -->
@endsection
@section('content')
<div class="row">
    <div class="col-xxl-12">
        <div class="card ">
            <div class="card-header">
                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#employeeDetails" role="tab">
                            <i class="fas fa-home"></i> Employee Details
                        </a>
                    </li>
                    @if($employee->passbook || $employee->pan_file || $employee->adhar_file)
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#documents" role="tab">
                                <i class="far fa-user"></i> Documents
                            </a>
                        </li>
                    @endif
                    @if($expenses->isNotEmpty())
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#bills" role="tab">
                                <i class="far fa-user"></i> Bills
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="card-body p-4">
                <div class="tab-content">
                    <div class="tab-pane active" id="employeeDetails" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class=" ">Full Name</label>
                                <input type="text" name="name" id="name" readonly class="form-control"
                                    value="{{ $employee->user->name}}">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class="">Email</label>
                                <input type="text" name="email" id="email" readonly class="form-control"
                                    value="{{ $employee->user->email}}">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class="">Department</label>
                                <input type="text" name="department" id="department" readonly class="form-control"
                                    value="{{ $employee->department->name}}">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class=" ">Contact</label>
                                <input type="text" name="contact" id="contact" readonly class="form-control"
                                    value="{{ $employee->contact}}">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class=" ">Phone No.</label>
                                <input type="text" name="phone" id="phone" readonly class="form-control"
                                    value="{{ $employee->alt_contact}}">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class="">Country</label>
                                <input type="text" name="country" id="country" readonly class="form-control"
                                    value="{{ $country->name }}">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class="">State</label>
                                <input type="text" name="state" id="state" readonly class="form-control"
                                    value="{{ $state->name }}">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class="">City</label>
                                <input type="text" name="city" id="city" readonly class="form-control"
                                    value="{{ $city->name }}">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class="">Address</label>
                                <textarea readonly class="form-control" name="address"
                                    id="address">{{ $employee->address}}</textarea>
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class="">Note</label>
                                <input type="text" name="pincode" id="pincode" readonly class="form-control"
                                    value="{{ $employee->pincode }}">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class="">PAN</label>
                                <input type="text" name="pan" id="pan" readonly class="form-control"
                                    value="{{ $employee->pan }}">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class="">Adhar</label>
                                <input type="text" name="pan" id="pan" readonly class="form-control"
                                    value="{{ $employee->adhar }}">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class="">Account Holder Name</label>
                                <input type="text" name="pan" id="pan" readonly class="form-control"
                                    value="{{ $employee->acc_holder_name }}">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class="">Account Number</label>
                                <input type="text" name="pan" id="pan" readonly class="form-control"
                                    value="{{ $employee->acc_number }}">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class="">IFSC Code</label>
                                <input type="text" name="pan" id="pan" readonly class="form-control"
                                    value="{{ $employee->ifsc }}">
                            </div>
                            <div class="col-sm-6 d-flex flex-column mb-md-10 mb-3">
                                <label for="name" class="">Bank Name</label>
                                <input type="text" name="pan" id="pan" readonly class="form-control"
                                    value="{{ $employee->bank_name }}">
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                        </form>
                    </div>
                    <!--end tab-pane-->
                    <div class="tab-pane" id="documents" role="tabpanel">
                        <div class="row">
                            @if($employee->pan_file)
                                <div class="card me-3" style="width: 18rem;">
                                    <a class="image-popup" target="_blank"
                                        href="{{ URL::asset('images/uploads/documents/' . $employee->pan_file) }}" title="">
                                        @if(pathinfo($employee->pan_file, PATHINFO_EXTENSION) == 'pdf')
                                            <img class="gallery-img img-fluid mx-auto card-img-top"
                                                src="{{ URL::asset('build/images/pdf-icon.png') }}" alt="PDF Document" />
                                        @else
                                            <img class="gallery-img img-fluid mx-auto card-img-top"
                                                src="{{ URL::asset('images/uploads/documents/' . $employee->pan_file) }}"
                                                alt="PAN Document" />
                                        @endif
                                        <div class="gallery-overlay mt-3">
                                            <h5 class="overlay-caption">PAN Card</h5>
                                        </div>
                                    </a>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mt-1">
                                            @if(pathinfo($employee->pan_file, PATHINFO_EXTENSION) !== 'pdf')
                                                <div class="flex-grow-1 text-muted">
                                                    <a href="{{ URL::asset('images/uploads/documents/' . $employee->pan_file) }}"
                                                        target="_blank" download class="download-button">
                                                        <i class="bx bx-cloud-download"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($employee->adhar_file)
                                <div class="card me-3" style="width: 18rem;">
                                    <a class="image-popup" target="_blank"
                                        href="{{ URL::asset('images/uploads/documents/' . $employee->adhar_file) }}"
                                        title="">
                                        @if(pathinfo($employee->adhar_file, PATHINFO_EXTENSION) == 'pdf')
                                            <img class="gallery-img img-fluid mx-auto card-img-top"
                                                src="{{ URL::asset('build/images/pdf-icon.png') }}" alt="PDF Document" />
                                        @else
                                            <img class="gallery-img img-fluid mx-auto card-img-top"
                                                src="{{ URL::asset('images/uploads/documents/' . $employee->adhar_file) }}"
                                                alt="PAN Document" />
                                        @endif
                                        <div class="gallery-overlay mt-3">
                                            <h5 class="overlay-caption">Aadhar Card</h5>
                                        </div>
                                    </a>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mt-1">
                                            @if(pathinfo($employee->adhar_file, PATHINFO_EXTENSION) !== 'pdf')
                                                <div class="flex-grow-1 text-muted">
                                                    <a href="{{ URL::asset('images/uploads/documents/' . $employee->adhar_file) }}"
                                                        target="_blank" download class="download-button">
                                                        <i class="bx bx-cloud-download"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($employee->passbook)
                                <div class="card me-3" style="width: 18rem;">
                                    <a class="image-popup" target="_blank"
                                        href="{{ URL::asset('images/uploads/documents/' . $employee->passbook) }}" title="">
                                        @if(pathinfo($employee->passbook, PATHINFO_EXTENSION) == 'pdf')
                                            <img class="gallery-img img-fluid mx-auto card-img-top"
                                                src="{{ URL::asset('build/images/pdf-icon.png') }}" alt="PDF Document" />
                                        @else
                                            <img class="gallery-img img-fluid mx-auto card-img-top"
                                                src="{{ URL::asset('images/uploads/documents/' . $employee->passbook) }}"
                                                alt="PAN Document" />
                                        @endif
                                        <div class="gallery-overlay mt-3 ">
                                            <h5 class="overlay-caption">Passbook</h5>
                                        </div>
                                    </a>
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mt-1">
                                            @if(pathinfo($employee->passbook, PATHINFO_EXTENSION) !== 'pdf')
                                                <div class="flex-grow-1 text-muted">
                                                    <a href="{{ URL::asset('images/uploads/documents/' . $employee->passbook) }}"
                                                        target="_blank" download class="download-button">
                                                        <i class="bx bx-cloud-download"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!--end tab-pane-->

                    <div class="tab-pane" id="bills" role="tabpanel">
                        <div class="row">
                            @foreach ($expenses as $expense)
                                @if($expense->bill_file)
                                    <div class="card me-3" style="width: 18rem;">
                                        <a class="image-popup" target="_blank"
                                            href="{{ URL::asset('images/uploads/bills/' . $expense->bill_file) }}" title="">
                                            @if(pathinfo($expense->bill_file, PATHINFO_EXTENSION) == 'pdf')
                                                <img class="gallery-img img-fluid mx-auto card-img-top"
                                                    src="{{ URL::asset('build/images/pdf-icon.png') }}" alt="PDF Document" />
                                            @else
                                                <img class="gallery-img img-fluid mx-auto card-img-top"
                                                    src="{{ URL::asset('images/uploads/bills/' . $expense->bill_file) }}"
                                                    alt="PAN Document" />
                                            @endif
                                            <div class="gallery-overlay mt-3 ">
                                                <h5 class="overlay-caption">{{ \Carbon\Carbon::parse($expense->created_at)->format('d/m/Y') }}</h5>
                                            </div>
                                        </a>
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mt-1">
                                                @if(pathinfo($expense->bill_file, PATHINFO_EXTENSION) !== 'pdf')
                                                    <div class="flex-grow-1 text-muted">
                                                        <a href="{{ URL::asset('images/uploads/bills/' . $expense->bill_file) }}"
                                                            target="_blank" download class="download-button">
                                                            <i class="bx bx-cloud-download"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
<!--end row-->
@endsection
@section('script')
<script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
<script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>
<!-- <script src="{{ URL::asset('build/libs/glightbox/js/glightbox.min.js') }}"></script> -->
<!-- <script src="{{ URL::asset('build/libs/isotope-layout/isotope.pkgd.min.js') }}"></script> -->
<!-- <script src="{{ URL::asset('build/js/pages/gallery.init.js') }}"></script> -->
<script src="{{ URL::asset('build/libs/list.pagination.js/list.pagination.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection