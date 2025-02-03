@extends('layouts.app')
@section('content')

<div class="main-outer">
                <div class="row">
                    <div class="page-heading">
                        <h3>Add Customers</h3>
                    </div>
                </div>
                <div id="exTab2" class="container">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <ul class="nav nav-tabs">
                                    <li class="active nav-tabs-content">
                                        <a href="#1" class="nav-tabs-data" data-toggle="tab">Company And Billing Information</a>
                                    </li>
                                    <li class="nav-tabs-content">
                                        <a href="#2" class="nav-tabs-data" data-toggle="tab">Personal Information</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="outer card">
                            <div class="upload-file-sec">
                                <div class="panel-body">
                                    <div class="tab-content ">
                                        <div class="tab-pane active" id="1">
                                            <div class="row">
                                                <div class="order-md-1">
                                                    <form class="needs-validation" novalidate action="{{ route('customers.store') }}" method="POST" id="customersDetails">
                                                        @csrf
                                                        <div class=" mb-3">
                                                            <label class="heading-content" for="ComapanyName">Comapany Name</label>
                                                            <input type="text" class="form-control input-form-content" id="company_name"
                                                              placeholder="John & company" name="company_name" value="" required>
                                                              @error('company_name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            
                                                        </div>
                                                        <div class="row form-inp-group">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="heading-content"  for="GSTIN">GSTIN</label>
                                                                <input type="text" class="form-control input-form-content" id="gstin" name="gstin" 
                                                                    placeholder="16516 51611 51" value="" required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="heading-content"  for="paymentterms">Payment Terms</label>
                                                                <input type="text" class="form-control input-form-content" id="payment_terms" name="payment_terms" 
                                                                    placeholder="Advance" value="" required>
                                                                <div class="invalid-feedback">
                                                                    Valid last name is required.
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row form-inp-group">
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="heading-content"  for="address">Billing Address Line 1</label>
                                                                <input type="text" class="form-control input-form-content" id="address1" name="address1" placeholder="4140 Parker Rd. Allentown, New Mexico 31134"required>
                                                                </div>

                                                            <div class="col-lg-6 mb-3">
                                                                <label class="heading-content"  for="address">Billing Address Line 2</label>
                                                                <input type="email" class="form-control input-form-content" id="address2" name="address2" placeholder="6391 Elgin St. Celina, Delaware 10299">
                                                            </div>
                                                        </div>

                                                        <div class="row form-inp-group">
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="heading-content"  for="country">Country</label>
                                                                <input type="email" class="form-control input-form-content" id="country" name="country" placeholder="country">
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="heading-content"  for="state">State</label>
                                                                <input type="email" class="form-control input-form-content" id="state" name="state" placeholder="States">
                                                            </div>
                                                        </div>
                                                        <div class="row form-inp-group">
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="heading-content"  for="country">Pin</label>
                                                                <input type="text" class="form-control input-form-content" id="pin" name="pin" placeholder="352218">
                                                            </div>
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="heading-content"  for="state">City</label>
                                                                <input type="text" class="form-control input-form-content" id="city" name="city" placeholder="City">
                                                            </div>
                                                        </div>

                                                        <div class="button-1 cta_btn save-btn">
                                                            <button type="submit">Save Information</button>
                                                            <!-- <a href="javascript:void(0);" class="primary-button view-all-btn">Save Information</a> -->
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="2">
                                            <div class="row">
                                                <div class="order-md-1">
                                                    <form class="needs-validation" novalidate>
                                                        <div class=" mb-3">
                                                            <label class="heading-content" for="firstname">First Name</label>
                                                            <input type="text" class="form-control input-form-content" id="firstName"
                                                                placeholder="John" value="" required>
                                                            <div class="invalid-feedback">
                                                                Valid first name is required.
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                                <label class="heading-content"  for="lastname">Last Name </label>
                                                                <input type="text" class="form-control input-form-content" id="lastName"
                                                                    placeholder="William" value="" required>
                                                                <div class="invalid-feedback">
                                                                    Valid last name is required.
                                                                </div>
                                                        </div>
                                                        <div class="row form-inp-group">
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="heading-content"  for="email">Email</label>
                                                                <input type="email" class="form-control input-form-content" id="address"
                                                                    placeholder="john@gmail.com"
                                                                    required>
                                                                <div class="invalid-feedback" style="width: 100%;">
                                                                    Your username is required.
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6 mb-3">
                                                                <label class="heading-content"  for="address">Additional Contact</label>
                                                                <input type="number" class="form-control input-form-content" id="number"
                                                                    placeholder="+123456789 ">
                                                                <div class="invalid-feedback">
                                                                    Please enter a valid email address for shipping
                                                                    updates.
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row form-inp-group">
                                                            <div class="col-lg-6 mb-3">
                                                                <label class="heading-content"  for="country">Group</label>
                                                                <select class="custom-select d-block w-100 form-select-grp" id="group"
                                                                    required>
                                                                    <option value="">Customer Group</option>
                                                                    <option>United States</option>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Please select a valid country.
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="button-1 cta_btn save-btn">
                                                            <a href="javascript:void(0);" class="primary-button view-all-btn">Save Information</a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#customersDetails').validate({
                rules: {
                    company_name: {
                        required: true,
                        maxlength: 255
                    }
                },
                messages: {
                    company_name: {
                        required: "Please enter your Company name",
                        maxlength: "Your name must be less than 255 characters long"
                    }
                },
                errorElement: "em",
                errorPlacement: function (error, element) {
                    // Add the `invalid-feedback` class to the error element
                    error.addClass("invalid-feedback");

                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.next("label"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                }
            });
        });
    </script>

@endsection
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">