@extends('layouts.master')
@section('title') Edit Invoice @endsection
@section('css')
<!-- Sweet Alert css-->
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('build/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
<div class="row justify-content-center">
  <div class="col-xxl-9">
    <div class="card">
      <form action="{{ route('invoice.update',$invoice->id)}}" method="post" id="invoice_edit_form" name="invoice_edit_form">
        @csrf
        <div class="card-body border-bottom border-bottom-dashed p-4">
          <div class="row">
            <div class="col-lg-4">
              <div class="profile-user mx-auto  mb-3">
                <span
                  class="overflow-hidden border border-dashed d-flex align-items-center justify-content-center rounded"
                  style="height: 60px; width: 256px;">
                  <img src="{{ URL::asset('images/uploads/' . $settings['app-logo']) }}"
                    class="card-logo card-logo-dark user-profile-image img-fluid" alt="logo dark">
                  <img src="{{ URL::asset('images/uploads/' . $settings['app-logo']) }}"
                    class="card-logo card-logo-light user-profile-image img-fluid" alt="logo light">
                </span>
              </div>
              <div>
                <div>
                  <label for="companyAddress">Address</label>
                </div>
                <div class="mb-2">
                  <textarea class="form-control bg-light border-0 @error('companyAddress') is-invalid @enderror"
                    id="companyAddress" rows="3" placeholder="Company Address"
                    name="companyAddress">{{ $settings['Address'] }}</textarea>
                  @error('companyAddress')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
          @enderror
                </div>
                <div>
                  <input type="text"
                    class="form-control bg-light border-0 mb-3 @error('company_postal_code') is-invalid @enderror"
                    value="{{ $settings['zip-code'] }}" name="company_postal_code" id="companyaddpostalcode"
                    minlength="5" maxlength="6" placeholder="Enter Postal Code" />
                  @error('company_postal_code')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
          @enderror
                </div>
              </div>
            </div><!--end col-->
            <div class="col-lg-4 ms-auto">
              <div class="mb-2">
                <input type="text" class="form-control bg-light border-0 @error('gst_number') is-invalid @enderror"
                  value="{{ $settings['GST-NO'] }}" name="gst_number" id="GSTNumber" placeholder="GST No." />
                @error('gst_number')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
              </div>
              <div class="mb-2">
                <input type="email" class="form-control bg-light border-0 @error('company_email') is-invalid @enderror"
                  name="company_email" value="{{ $settings['company-email'] }}" id="companyEmail"
                  placeholder="Email Address" />
                @error('company_email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
              </div>

              <div class="mb-2">
                <input type="text" class="form-control bg-light border-0 @error('companyPhone') is-invalid @enderror"
                  name="companyPhone" value="{{ $settings['company-phone']}}" id="compnayContactno"
                  placeholder="Contact No" />
                @error('companyPhone')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
              </div>
              <div>
                <input type="text" class="form-control bg-light border-0 @error('invoicenoInput') is-invalid @enderror "
                  id="invoicenoInput" name="invoicenoInput" placeholder="Invoice Number"
                  value="{{ $invoice->invoice_number }}" readonly="readonly" />
                @error('invoicenoInput')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
              </div>
            </div>
          </div><!--end row-->
        </div>
        <div class="card-body p-4">
          <div class="row g-3">
            <div class="col-lg-3 col-sm-6">
              <label for="client">Client</label>
              <div class="input-light">
                <select class="form-control bg-light border-0 @error('client') is-invalid @enderror" id="clientName"
                  name="client">
                  @if($clients)
            @foreach ($clients as $client)
        <option {{ ($invoice->client_id == $client->id) ? 'selected' : '' }} value="{{ $client->id }}">
        {{ $client->first_name}}
        </option>
      @endforeach
          @endif
                </select>
                @error('client')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
              </div>
            </div><!--end col-->
            <div class="col-lg-3 col-sm-6">
              <div>
                <label for="date-field">Date</label>
                <input type="date" value="{{ $invoice->invoice_date }}" name="invoice_date"
                  class="form-control bg-light border-0 @error('invoice_date') is-invalid @enderror" id="date-field"
                  data-time="true" placeholder="Select Date-time">
                @error('invoice_date')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
              </div>
            </div><!--end col-->
            <div class="col-lg-3 col-sm-6">
              <div>
                <label for="totalamountInput">Due Date</label>
                <input type="date" class="form-control bg-light border-0 @error('due_date') is-invalid @enderror"
                  id="due_date" value="{{ $invoice->due_date }}" name="due_date" />
                @error('due_date')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
              </div>
            </div><!--end col-->
            <div class="col-lg-3 col-sm-6">
              <label for="select-payment-status">Status <span class="text-danger">*</span></label>
              <div class="input-light">
                <select class="form-control bg-light border-0 @error('invoice_status') is-invalid @enderror"
                  name="invoice_status" id="select-payment-status">
                  <option value="Unpaid" {{ $invoice->invoice_status == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                  <option value="Paid" {{ $invoice->invoice_status == 'Paid' ? 'selected' : '' }}>Paid</option>
                  <option value="Partially_Paid" {{ $invoice->invoice_status == 'Partially_Paid' ? 'selected' : '' }}>
                    Partially Paid</option>
                  <option value="Overdue" {{ $invoice->invoice_status == 'Overdue' ? 'selected' : '' }}>Overdue</option>
                  <option value="Processing" {{ $invoice->invoice_status == 'Processing' ? 'selected' : '' }}>Processing
                  </option>
                  <option value="Draft" {{ $invoice->invoice_status == 'Draft' ? 'selected' : '' }}>Draft</option>
                </select>
                @error('invoice_status')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
              </div>
            </div><!--end col-->
            <div class="col-lg-3 col-sm-6">
              <label for="select-project">Project </label>
              <div class="input-light">
                <select class="form-control bg-light border-0 @error('project') is-invalid @enderror"
                  name="project" id="select-project">
                </select>
                @error('project')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
              </div>
            </div><!--end col-->
          </div><!--end row-->
        </div>
        <div class="card-body p-4 border-top border-top-dashed">
          <div class="row">
            <div class="col-lg-12 col-sm-12">
              <div>
                <label for="billingName" class="text-muted text-uppercase fw-semibold">Address</label>
              </div>
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <div class="mb-2">
                    <input type="text" class="form-control bg-light border-0 @error('fullname') is-invalid @enderror "
                      name="fullname" id="billingName" placeholder="Full Name" />
                    @error('fullname')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
                  </div>
                </div>
                <div class="col-lg-6 col-sm-12">

                  <div class="mb-2">
                    <input type="text"
                      class="form-control bg-light border-0 @error('clientContact') is-invalid @enderror"
                      name="clientContact" id="billingPhoneno" placeholder="(123)456-7890" />
                    @error('clientContact')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <div class="mb-3">
                    <input type="text" class="form-control bg-light border-0 @error('clientGST') is-invalid @enderror"
                      name="clientGST" id="billingTaxno" placeholder="Tax Number" />
                    @error('clientGST')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
                  </div>
                </div>
                <div class="col-lg-6 col-sm-12">

                  <div class="mb-2">
                    <input type="email"
                      class="form-control bg-light border-0 @error('clientEmail') is-invalid @enderror"
                      name="clientEmail" id="billingEmail" placeholder="abc@example.com" />
                    @error('clientEmail')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <div class="mb-2">
                    <textarea class="form-control bg-light border-0 @error('clientAddress') is-invalid @enderror"
                      id="billingAddress"  name="clientAddress" rows="3" placeholder="Address"></textarea>
                    @error('clientAddress')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
                  </div>
                </div>
              </div>
            </div><!--end col-->
          </div><!--end row-->
        </div>
        <div class="card-body p-4">
          <div class="table-responsive">
            <table class="invoice-table table table-borderless table-nowrap mb-0">
              <thead class="align-middle">
                <tr class="table-active">
                  <th scope="col" style="width: 50px;">#</th>
                  <th scope="col">
                    Product Details
                  </th>
                  <th scope="col" style="width: 120px;">
                    <div class="d-flex currency-select input-light align-items-center">
                      Rate(₹)
                    </div>
                  </th>
                  <th scope="col" style="width: 120px;">Quantity</th>
                  <th scope="col" class="text-end" style="width: 150px;">Amount</th>
                  <th scope="col" class="text-end" style="width: 105px;"></th>
                </tr>
              </thead>
              <tbody id="newlink">
                @if($invoice->items)
          @foreach($invoice->items as $item)
        <tr class="product-row">
        <th scope="row" class="product-item-id">{{ $item->product_id }}</th>
        <td class="text-start">
        <div class="mb-2">
          <div class="input-light">
          <select
          class="form-control bg-light border-0 select-product-item @error('product_id') is-invalid @enderror"
          name="product_id[]">
          @if ($products)
        @foreach ($products as $product)
      <option value="{{$product->id}}" {{ ($item->product_id == $product->id) ? 'selected' : ''}}
      data-product-id="{{$product->id}}" data-product-price="{{ $product->unit_price }}"
      data-product-name="{{ $product->name}}">
      {{$product->name}}
      </option>
    @endforeach
      @endif
          </select>
          @error('product_id')
        <div class="invalid-feedback">
        {{ $message }}
        </div>
      @enderror
          </div>
        </div>
        </td>
        <td>
        <input type="number" readonly
          class="form-control product-price bg-light border-0 productRate @error('product_rate') is-invalid @enderror"
          id="productRate" name="product_rate[]" value="{{ $item->unit_price}}" step="0.01"
          placeholder="₹0.00" />
        @error('product_rate')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
        </td>
        <td>
        <div class="input-step">
          <button type="button" class='minus'>–</button>
          <input type="number"
          class="product-quantity product-qty @error('product_qty') is-invalid @enderror"
          name="product_qty[]" id="product-qty" value="{{ $item->quantity }}" min="1" max="10" value="1"
          readonly>
          <button type="button" class='plus'>+</button>
        </div>
        </td>
        <td class="text-end">
        <div>
          <input type="text"
          class="form-control bg-light border-0 product-line-price productPrice @error('product_item_total') is-invalid @enderror"
          id="productPrice" placeholder="₹0.00" value="{{ $item->total }}" name="product_item_total[]"
          readonly />
          @error('product_item_total')
        <div class="invalid-feedback">
        {{ $message }}
        </div>
      @enderror
        </div>
        </td>
        <td class="product-removal">
        <a href="javascript:void(0)" class="btn btn-success delete-row">Delete</a>
        </td>
        </tr>
      @endforeach
        @else
      <tr class="product-row">
        <th scope="row" class="product-item-id">1</th>
        <td class="text-start">
        <div class="mb-2">
          <div class="input-light">
          <select
            class="form-control bg-light border-0 select-product-item @error('product_id') is-invalid @enderror"
            name="product_id[]">
            @if ($products)
        @foreach ($products as $product)
      <option value="{{$product->id}}" data-product-id="{{$product->id}}"
      data-product-price="{{ $product->unit_price }}" data-product-name="{{ $product->name}}">
      {{$product->name}}
      </option>
    @endforeach
      @endif
          </select>
          @error('product_id')
        <div class="invalid-feedback">
        {{ $message }}
        </div>
      @enderror
          </div>
        </div>
        </td>
        <td>
        <input type="number" readonly
          class="form-control product-price bg-light border-0 productRate @error('product_rate') is-invalid @enderror"
          id="productRate" name="product_rate[]" step="0.01" placeholder="₹0.00" />
        @error('product_rate')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
    @enderror
        </td>
        <td>
        <div class="input-step">
          <button type="button" class='minus'>–</button>
          <input type="number"
          class="product-quantity product-qty @error('product_qty') is-invalid @enderror"
          name="product_qty[]" id="product-qty" min="1" max="10" value="1" readonly>
          <button type="button" class='plus'>+</button>
        </div>
        </td>
        <td class="text-end">
        <div>
          <input type="text"
          class="form-control bg-light border-0 product-line-price productPrice @error('product_item_total') is-invalid @enderror"
          id="productPrice" placeholder="₹0.00" name="product_item_total[]" readonly />
          @error('product_item_total')
        <div class="invalid-feedback">
        {{ $message }}
        </div>
      @enderror
        </div>
        </td>
        <td class="product-removal">
        <a href="javascript:void(0)" class="btn btn-success delete-row">Delete</a>
        </td>
      </tr>
    @endif
              </tbody>
              <tbody>
                <tr>
                  <td colspan="5">
                    <a href="javascript:void(0)" id="add-item" class="btn btn-soft-secondary fw-medium"><i
                        class="ri-add-fill me-1 align-bottom"></i> Add Item</a>
                  </td>
                </tr>
                <tr class="border-top border-top-dashed mt-2">
                  <td colspan="3">
                    <table class="table table-borderless table-sm table-nowrap align-middle mb-0">
                      <tbody>
                        <tr class="mb-3">
                          <th scope="row">Discount Type</th>
                          <td>
                            <div class="mb-3">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <select class="js-example-basic-single @error('discount_type') is-invalid @enderror"
                                    id="discount_type" name="discount_type">
                                    <option {{ ($invoice->discount_type == 'Fixed') ? 'selected' : '' }} value="Fixed">
                                      ₹</option>
                                    <option {{ ($invoice->discount_type == 'Percentage') ? 'selected' : '' }}
                                      value="Percentage">%</option>
                                  </select>
                                </div>
                                <input type="number" class="form-control @error('discount') is-invalid @enderror"
                                  id="discount" value="{{ $invoice->discount }}" name="discount" placeholder="0">
                                @error('discount')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
                              </div>
                            </div>

                          </td>
                        </tr>
                        <tr>
                          <th scope="row">Tax</th>
                          <td>
                            <div class="mb-3">
                              <select class="form-control" name="taxes" id="taxes">
                                @if($taxes)
                                  @php
                  $defaultTax = $taxes->firstWhere('is_default', 1);
                  @endphp
                                  <option value="0" data-tax-value="0" {{ !$defaultTax ? 'selected' : '' }}>No Tax
                                  </option>
                                  @foreach ($taxes as $tax)
                    <option {{ ($invoice->tax_id == $tax->id) ? 'selected' : '' }} value="{{ $tax->id }}"
                    data-tax-value="{{ $tax->value }}">{{ $tax->name }}</option>
                  @endforeach
                @endif
                              </select>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                  <td colspan="2" class="p-0">
                    <table class="table table-borderless table-sm table-nowrap align-end mb-0">
                      <tbody>
                        <tr>
                          <th scope="row">Sub Total</th>
                          <td style="width:150px;">
                            <input type="text"
                              class="form-control bg-light border-0 @error('invoice_subtotal') is-invalid @enderror"
                              name="invoice_subtotal" value="{{ $invoice->subtotal }}" id="invoice_subtotal"
                              placeholder="₹0.00" readonly />
                            @error('invoice_subtotal')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                          </td>
                        </tr>
                      
                        <tr>
                          <th scope="row">Discount</th>
                          <td>
                            <input type="text"
                              class="form-control bg-light border-0 @error('cart_discount') is-invalid @enderror"
                              name="cart_discount" value="{{$invoice->discount_total}}" id="cart_discount"
                              placeholder="₹0.00" readonly />
                            @error('cart_discount')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
                          </td>
                        </tr>
                        <tr>
                          <th scope="row" id="tax-table-head">Tax ({{ $tax->tax }})</th>
                          <td>
                            <input type="text"
                              class="form-control bg-light border-0  @error('cart_tax') is-invalid @enderror"
                              name="cart_tax" value="{{ $invoice->tax_total}}" id="cart_tax" placeholder="₹0.00"
                              readonly />
                            @error('cart_tax')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                            @enderror
                          </td>
                        </tr>
                        <tr class="border-top border-top-dashed">
                          <th scope="row">Total Amount</th>
                          <td>
                            <input type="text"
                              class="form-control bg-light border-0 @error('final_amount') is-invalid @enderror"
                              name="final_amount" value="{{ $invoice->total }}" id="cart-total" placeholder="₹0.00"
                              readonly />
                            @error('final_amount')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <!--end table-->
                  </td>
                </tr>
              </tbody>
            </table><!--end table-->
          </div>
          <div class="row mt-3">
            <div class="col-lg-4">
              <div class="mb-2">
                <label for="select-payment-type" class="form-label text-muted text-uppercase fw-semibold">Payment
                  Method</label>
                <div class="input-light">
                  <select class="form-control bg-light border-0 @error('payment_type') is-invalid @enderror"
                    id="select-payment-type" name="payment_type">
                    <option {{ ($invoice->payment_method == 'phone_pe') ? 'selected' : '' }} value="phone_pe">PhonePe
                    </option>
                    <option {{ ($invoice->payment_method == 'google_pay') ? 'selected' : '' }} value="google_pay">Google
                      Pay</option>
                    <option {{ ($invoice->payment_method == 'bank_transfer') ? 'selected' : '' }} value="bank_transfer">
                      Bank Transfer</option>

                  </select>
                  @error('payment_type')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
          @enderror
                </div>
              </div>
            </div><!--end col-->
          </div><!--end row-->
          <div class="mt-4">
            <div class="form-group">
              <label for="exampleFormControlTextarea1">Notes</label>
              <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" id="notes"
                rows="3">{{ $invoice->note}}</textarea>
              @error('notes')
          <div class="invalid-feedback">
          {{ $message }}
          </div>
        @enderror
            </div>

          </div>
          <input type="hidden" name="itemArray[]" id="invoiceItemsInput">
          <input type="hidden" name="tax_id" id="default_tax_id">
          <input type="hidden" name="tax_name" id="default_tax_name">
          <div class="hstack gap-2 justify-content-end d-print-none mt-4">
            <button type="submit" class="btn btn-success"><i class="ri-printer-line align-bottom me-1"></i>
              Save</button>
          </div>
        </div>
      </form>
    </div>
  </div><!--end col-->
</div><!--end row-->
@endsection
@section('script')
<script src="{{ URL::asset('build/libs/cleave.js/cleave.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/profile-setting.init.js') }}"></script>
<!-- <script src="{{ URL::asset('build/js/pages/invoicecreate.init.js') }}"></script> -->
<script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('build/select2/js/select2.min.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
<!-- <script>
  $(document).ready(function () {
    var count = 1;


    function new_link() {
      count++; // Increment count or initialize it as needed

      // Create a new table row element
      var tr1 = document.createElement("tr");
      tr1.id = "product-" + count; // Set a unique ID for the new row
      tr1.className = "product-row";

      // Construct the HTML for the new row
      var delLink =
        '<th scope="row" class="product-item-id"></th>' +
        '<td class="text-start">' +
        '<div class="mb-2">' +
        '<div class="input-light">' +
        '<select class="form-control bg-light border-0 select-product-item" name="product_id[]">' +
        '@if ($products)' +
      '@foreach ($products as $product)' +
      '<option value="{{$product->id}}" data-product-id="{{$product->id}}" data-product-price="{{$product->unit_price }}" data-product-name="{{ $product->name }}" >{{$product->name}}</option>' +
    '@endforeach' +
    '@endif' +
        '</select>' +
        '</div>' +
        '</div>' +
        '</td>' +
        '<td>' +
        '<input class="form-control bg-light border-0 product-price productRate" name="product_rate[]" readonly type="number" id="productRate-' + count + '" step="0.01" placeholder="₹0.00">' +
        '</td>' +
        '<td>' +
        '<div class="input-step">' +
        '<button type="button" class="minus">–</button>' +
        '<input type="number" name="product_qty[]" class="product-quantity product-qty" id="product-qty-' + count + '" value="1" readonly>' +
        '<button type="button" class="plus">+</button>' +
        '</div>' +
        '</td>' +
        '<td class="text-end">' +
        '<div>' +
        '<input type="text" name="product_item_total[]" readonly class="form-control bg-light border-0 product-line-price" id="productPrice-' + count + '"  placeholder="₹0.00" />' +
        '</div>' +
        '</td>' +
        '<td class="product-removal">' +
        '<a class="btn btn-success delete-row">Delete</a>' +
        '</td>';

      // Set the inner HTML of the new row
      tr1.innerHTML = delLink;

      // Append the new row to the target container with id 'newlink'
      document.getElementById("newlink").appendChild(tr1);

      // Initialize Select2 on the newly added select element
      $('.select-product-item').select2(); // Ensure Select2 is properly included and initialized
      updateRate();
      // Optional: Attach event handlers or perform other actions as needed
    }
    function updateRate() {
      $('.product-row').each(function () {
        var $row = $(this); // Current product row

        // Find the select element within the current row
        var selectedProductPrice = $row.find('.select-product-item').find(':selected').data('product-price');
        var selectedProductID = $row.find('.select-product-item').find(':selected').data('product-id');

        // Update elements within the current row
        $row.find('.productRate').val(selectedProductPrice);
        $row.find('.product-item-id').text(selectedProductID);

        var quantity = parseInt($row.find('.product-qty').val());
        var linePrice = selectedProductPrice * quantity;
        $row.find('.product-line-price').val(linePrice.toFixed(2));
      });
    }
    function updateSubtotal()
     {
      var subtotal = 0;
      var invoiceItems = [];

      $('.product-row').each(function () {
        var $row = $(this);
        var productName = $row.find('.select-product-item').find(':selected').data('product-name');
        var quantity = parseInt($row.find('.product-qty').val());
        var linePrice = parseFloat($row.find('.product-line-price').val());
        var productID = $row.find('.product-item-id').text();
        var productPrice = $row.find('.productRate').val();
        invoiceItems.push({
          product_id: productID,
          product_name: productName,
          quantity: quantity,
          price: productPrice,
          total: linePrice
        });
      });
      var invoiceItemsJSON = JSON.stringify(invoiceItems);
      $('#invoiceItemsInput').val(invoiceItemsJSON);
      console.log($('#invoiceItemsInput').val());
      // Calculate subtotal
      $('.product-line-price').each(function () {
        var linePrice = parseFloat($(this).val());
        if (!isNaN(linePrice)) {
          subtotal += linePrice;
        }
      });

      $('#invoice_subtotal').val(subtotal.toFixed(2));

      // Calculate discount
  var discountValue = parseFloat($('#discount').val());
  var discountType = $('#discount_type').val();
  var discountAmount = 0;
  if (discountType === 'Fixed' && discountValue) {
    discountAmount = discountValue;
  } else if (discountType === 'Percentage' && discountValue) {
    if (discountValue < 0 || discountValue > 100) {
      $('#discount').addClass('is-invalid');
      $('#discount').next('.invalid-feedback').text('Discount percentage must be between 0 and 100.');
    } else {
      $('#discount').removeClass('is-invalid');
      $('#discount').next('.invalid-feedback').text('');
      discountAmount = subtotal * (discountValue / 100);
    }
  }

  $('#cart_discount').val(discountAmount.toFixed(2));

       // Calculate tax based on subtotal after discount
  var discountedSubtotal = subtotal - discountAmount;
  var selectedTaxRate = $('#taxes').find(':selected').data('tax-value');
  var selectedTaxId = $('#taxes').val();
  $('#default_tax_name').val(selectedTaxRate);
  $('#default_tax_id').val(selectedTaxId);
  $('#tax-table-head').text('Tax (' + selectedTaxRate + '%)');
  var taxAmount = discountedSubtotal * (selectedTaxRate / 100);
  $('#cart_tax').val(taxAmount.toFixed(2));

  // Calculate total after tax and discount
  var totalAmount = discountedSubtotal + taxAmount;
  $('#cart-total').val(totalAmount.toFixed(2));
    }
    updateRate();
    updateSubtotal();
    $('select').select2();
    $('#add-item').click(function () {
      new_link(); // Call the function to add a new row
      updateRate();
      updateSubtotal();
    });

    $('#newlink').on('click', '.plus', function () {
      var qtyInput = $(this).siblings('.product-qty');
      var currentVal = parseInt(qtyInput.val());
      if (currentVal < 10) {
        qtyInput.val(currentVal + 1);
      }
      updateRate();
      updateSubtotal();

    });

    // Handle the minus button click
    $('#newlink').on('click', '.minus', function () {
      var qtyInput = $(this).siblings('.product-qty');
      var currentVal = parseInt(qtyInput.val());
      if (currentVal > 1) {
        qtyInput.val(currentVal - 1);
      }
      updateRate();
      updateSubtotal();

    });

    $('#newlink').on('click', '.delete-row', function () {
      $(this).closest('tr').remove(); // Remove the closest <tr> element
      updateSubtotal();
    });
    $(document).on('change', '.select-product-item', function () {
      updateRate();
      updateSubtotal();

    });
    $(document).on('change', '#taxes', function () {
      updateRate();
      updateSubtotal();

    });
    $('#discount, #discount_type').change(function () {
      updateSubtotal();
    });
    $('#clientName').change(function () {
      console.log($(this).val());
      fetchClient($(this).val());
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

    function initializeSelect2() {
      var initialClientId = $('#clientName').val();

      if (initialClientId) {
        fetchClient(initialClientId);
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
  });
</script> -->

<script>
   $(document).ready(function () {
    $('select').select2();
    var count = 0;
    function new_link() {
      count++; 
      var tr1 = document.createElement("tr");
      tr1.id = "product-" + count; 
      tr1.className = "product-row";
      var productId = '<span class="product-id">' + count + '</span>';
      var delLink =
        '<th scope="row" class="product-item-id">' + count + '</th>' +
        '<td class="text-start">' +
        '<div class="mb-2">' +
        '<div class="input-light">' +
        '<select class="form-control bg-light border-0 select-product-item" name="product_id[]">' +
        '@if ($products)' +
      '@foreach ($products as $product)' +
      '<option value="{{$product->id}}" data-product-id="{{$product->id}}" data-product-price="{{$product->unit_price }}" data-product-name="{{ $product->name }}" >{{$product->name}}</option>' +
    '@endforeach' +
    '@endif' +
        '</select>' +
        '</div>' +
        '</div>' +
        '</td>' +
        '<td>' +
        '<input class="form-control bg-light border-0 product-price productRate" name="product_rate[]"  type="number" id="productRate-' + count + '" step="0.01" placeholder="₹0.00">' +
        '</td>' +
        '<td>' +
        '<div class="input-step">' +
        '<button type="button" class="minus">–</button>' +
        '<input type="number" name="product_qty[]" class="product-quantity product-qty" id="product-qty-' + count + '" value="1" readonly>' +
        '<button type="button" class="plus">+</button>' +
        '</div>' +
        '</td>' +
        '<td class="text-end">' +
        '<div>' +
        '<input type="text" name="product_item_total[]" readonly class="form-control bg-light border-0 product-line-price" id="productPrice-' + count + '"  placeholder="₹0.00" />' +
        '</div>' +
        '</td>' +
        '<td class="product-removal">' +
        '<a class="btn btn-success delete-row">Delete</a>' +
        '</td>';

      // Set the inner HTML of the new row
      tr1.innerHTML = delLink;

      // Append the new row to the target container with id 'newlink'
      document.getElementById("newlink").appendChild(tr1);

      // Initialize Select2 on the newly added select element
      $('.select-product-item').select2(); // Ensure Select2 is properly included and initialized
      var selectedPrice = $('#newlink').find('.select-product-item:last option:selected').data('product-price');
      $('#productRate-' + count).val(selectedPrice.toFixed(2));
      updateRate();
      // Optional: Attach event handlers or perform other actions as needed
    }

    function updateRate() {
      $('.product-row').each(function () {
        var $row = $(this); // Current product row
        // Find the select element within the current row
        var selectedProductPrice = $row.find('.productRate').val();
        // var selectedProductPrice = $row.find('.select-product-item').find(':selected').data('product-price');
        var selectedProductID = $row.find('.select-product-item').find(':selected').data('product-id');

        // Update elements within the current row
        $row.find('.productRate').val(selectedProductPrice);
        $row.find('.product-item-id').text(selectedProductID);

        var quantity = parseInt($row.find('.product-qty').val());
        var linePrice = selectedProductPrice * quantity;
        $row.find('.product-line-price').val(linePrice.toFixed(2));
      });
    }

    function updateSubtotal() {
      var subtotal = 0;
      var invoiceItems = [];

      $('.product-row').each(function () {
        var $row = $(this);
        var productName = $row.find('.select-product-item').find(':selected').data('product-name');
        var quantity = parseInt($row.find('.product-qty').val());
        var linePrice = parseFloat($row.find('.product-line-price').val());
        var productID = $row.find('.product-item-id').text();
        var productPrice = $row.find('.productRate').val();
        invoiceItems.push({
          product_id: productID,
          product_name: productName,
          quantity: quantity,
          price: productPrice,
          total: linePrice
        });
      });
      var invoiceItemsJSON = JSON.stringify(invoiceItems);
      $('#invoiceItemsInput').val(invoiceItemsJSON);
      console.log($('#invoiceItemsInput').val());
      // Calculate subtotal
      $('.product-line-price').each(function () {
        var linePrice = parseFloat($(this).val());
        if (!isNaN(linePrice)) {
          subtotal += linePrice;
        }
      });

      $('#invoice_subtotal').val(subtotal.toFixed(2));

      // Calculate discount
      var discountValue = parseFloat($('#discount').val());
      var discountType = $('#discount_type').val();
      var discountAmount = 0;
      if (discountType === 'Fixed' && discountValue) {
        discountAmount = discountValue;
      } else if (discountType === 'Percentage' && discountValue) {
        if (discountValue < 0 || discountValue > 100) {
          $('#discount').addClass('is-invalid');
          $('#discount').next('.invalid-feedback').text('Discount percentage must be between 0 and 100.');
        } else {
          $('#discount').removeClass('is-invalid');
          $('#discount').next('.invalid-feedback').text('');
          discountAmount = subtotal * (discountValue / 100);
        }
      }

      $('#cart_discount').val(discountAmount.toFixed(2));

      // Calculate tax based on subtotal after discount
      var discountedSubtotal = subtotal - discountAmount;
      var selectedTaxRate = $('#taxes').find(':selected').data('tax-value');
      var selectedTaxId = $('#taxes').val();
      $('#default_tax_name').val(selectedTaxRate);
      $('#default_tax_id').val(selectedTaxId);
      $('#tax-table-head').text('Tax (' + selectedTaxRate + '%)');
      var taxAmount = discountedSubtotal * (selectedTaxRate / 100);
      $('#cart_tax').val(taxAmount.toFixed(2));

      // Calculate total after tax and discount
      var totalAmount = discountedSubtotal + taxAmount;
      $('#cart-total').val(totalAmount.toFixed(2));
    }

    updateRate();
    updateSubtotal();
    $('select').select2();
    $('#add-item').click(function () {
      new_link(); // Call the function to add a new row
      updateRate();
      updateSubtotal();
    });

    $('#newlink').on('click', '.plus', function () {
      var qtyInput = $(this).siblings('.product-qty');
      var currentVal = parseInt(qtyInput.val());
      if (currentVal < 10) {
        qtyInput.val(currentVal + 1);
      }
      updateRate();
      updateSubtotal();

    });

    // Handle the minus button click
    $('#newlink').on('click', '.minus', function () {
      var qtyInput = $(this).siblings('.product-qty');
      var currentVal = parseInt(qtyInput.val());
      if (currentVal > 1) {
        qtyInput.val(currentVal - 1);
      }
      updateRate();
      updateSubtotal();

    });

    $('#newlink').on('click', '.delete-row', function () {
      $(this).closest('tr').remove(); // Remove the closest <tr> element
      updateSubtotal();
    });
    $(document).on('change', '.select-product-item', function () {
      var $row = $(this).closest('.product-row'); // Get the current row
      var selectedProductPrice = $(this).find(':selected').data('product-price'); // Get the selected product price
      $row.find('.productRate').val(selectedProductPrice); // Update the product rate input field
      updateRate();
      updateSubtotal();
    });
    $(document).on('change', '#taxes', function () {
      updateRate();
      updateSubtotal();

    });
    $(document).on('change', '.productRate', function () {
      updateRate();
      updateSubtotal();

    });
    $('#discount, #discount_type').change(function () {
      updateSubtotal();
    });
    @include('invoices.updateClientInfo')
   });
</script>
@endsection