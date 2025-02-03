@extends('layouts.print')
@section('navbarTitel', $customer->company_name . ' Print')
@section('content')
<div class="form-container">
    <div class="header">
        <div class="form-title">Customer Information</div>
        <div class="logo">
            @if(str_contains(url('/'), '127.0.0.1'))
            <img
            src="{{ asset('public/assets/img/Cosmiclogo.png')}}"
            alt="navbar brand"
            class="navbar-brand"
            />
            @else
            <img
            src="{{ asset('public/assets/img/Cosmiclogo.png')}}"
            alt="navbar brand"
            class="navbar-brand"
            />
            @endif
        </div>
    </div>
    <div class="personal-info">
        <div class="section-title">Company and Billing Information</div>
        <div class="row first-section">
            <p class="field-size"><strong>Company Name:</strong> {{ old('company_name', $customer->company_name ?? '') }}</p>
            <p class="field-size"><strong>GSTIN:</strong> {{ old('gstin', $customer->gstin ?? '') }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Payment Terms:</strong> {{ old('payment_terms', $customer->payment_terms) }}</p>
            <p class="field-size"><strong>Billing Address Line 1:</strong> {{ old('address1', $customer->address1 ?? '') }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Billing Address Line 2:</strong> {{ old('address2', $customer->address2 ?? '') }}</p>
            <p class="field-size"><strong>City:</strong> {{ optional($cities->find($customer->city))->name }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Pin:</strong> {{ old('pin', $customer->pin ?? '') }}</p>
            <p class="field-size"><strong>State:</strong> {{ optional($states->find($customer->state))->name }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Country:</strong> {{ optional($countries->find($customer->country))->name }} </p>
            <p class="field-size"><strong>Group:</strong> {{optional($groups->find($customer->group))->name}}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Perf. Matrix:</strong> {{old('matrix',$customer->matrix ?? '')}}</p>
        </div>
    </div>
    <div class="personal-info">
        <div class="section-title">Personal Information</div>
        <div class="row first-section">
            <p class="field-size"><strong>First Name:</strong> {{ old('first_name', $customer->first_name ?? '') }}</p>
            <p class="field-size"><strong>Last Name:</strong> {{ old('last_name', $customer->last_name ?? '') }}</p>
        </div>
        <div class="row">
            <p class="field-size"><strong>Email:</strong> {{old('email',$customer->email ?? '')}}</p>
            <p class="field-size"><strong>Phone no.:</strong> {{old('contect', $customer->contect ?? '')}}</p>
        </div>
    </div>
</div>

<!-- <div class="main-outer">
    <div class="outer card">
        <div class="heading-btn">
            <span class="addsupplier-section-heading">Company and Billing Information</span>
        </div>
        <hr class="addsupplier-section-border">
        <div class="upload-file-sec">
            <div class="row customer-files-sec">
                <div class="row form-inp-group">
                    <div class="col-lg-4 mb-3">
                        <label class="heading-content"  for="name">Company Name</label>
                        <input type="text" class=" input-form-content" name="company_name" id="company_name" placeholder="Enter company name" value="{{ old('company_name', $customer->company_name ?? '') }}" readonly>
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label class="heading-content"  for="GSTIN">GSTIN</label>
                        <input type="text" name="gstin" class="input-form-content" id="gstindata" placeholder="22AAAAA0000A1Z5" required value="{{ old('gstin', $customer->gstin ?? '') }}"readonly>
                    </div>
                    <div class="col-lg-4 mb-3 d-none">
                        <label class="heading-content" for="paymentterms">Payment Terms</label>
                        <select class="custom-select d-block w-100 form-select-grp select2 d-none" id="payment_terms" name="payment_terms" required>
                            <option value="">Select Payment</option>
                            <option value="Advance" {{ old('payment_terms', $customer->payment_terms) == 'Advance' ? 'selected' : '' }}>Advance</option>
                            <option value="7 days" {{ old('payment_terms', $customer->payment_terms) == '7 days' ? 'selected' : '' }}>7 days</option>
                            <option value="30 days" {{ old('payment_terms', $customer->payment_terms) == '30 days' ? 'selected' : '' }}>30 days</option>
                            <option value="45 days" {{ old('payment_terms', $customer->payment_terms) == '45 days' ? 'selected' : '' }}>45 days</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label for="selected_payment_term">Payment Terms</label>
                        <input type="text" class="" id="selected_payment_term" value="{{ old('payment_terms', $customer->payment_terms) }}" readonly>
                    </div>
                </div>
                <div class="row form-inp-group">
                    <div class="col-lg-4 mb-3">
                        <label class="heading-content"  for="address">Billing Address Line 1</label>
                        <input type="text" class=" input-form-content " id="address1" name="address1" placeholder="4140 Parker Rd. Allentown, New Mexico 31134"required value="{{ old('address1', $customer->address1 ?? '') }}"readonly>    
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label class="heading-content"  for="number">Billing Address Line 2</label>
                        <input type="text" class=" input-form-content " name="address2" id="address2"placeholder="6391 Elgin St. Celina, Delaware 10299" value="{{ old('address2', $customer->address2 ?? '') }}"readonly>
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label class="heading-content"  for="name">Pin</label>
                        <input type="pin" class="" id="pin" name="pin" value="{{ old('pin', $customer->pin ?? '') }}" placeholder="352218"readonly>
                    </div>
                </div>
                <div class="row form-inp-group">
                    <div class="col-lg-4 mb-3">
                        <label class="heading-content" for="name">Country</label>
                        <select class=" d-none custom-select d-block w-100 form-select-grp select2" id="country" name="country_id" required>
                            <option value="">Select Country</option>
                            @foreach($countries as $country)
                                <option value="{{$country->id}}" {{ old('country_id', $customer->country_id) == $country->id ? 'selected' : '' }}>
                                    {{$country->name}}
                                </option>
                            @endforeach
                        </select>
                        <input type="text" class=" mt-2" id="selected_country" value="" readonly>
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label class="heading-content" for="State">State<span style="color: red;">*</span></label>
                        <select class="d-none custom-select d-block w-100 form-select-grp select2" id="state" name="state_id" required>
                            <option value="">Select State</option>
                        </select>

                        <input type="text" class="mt-2" id="selected_state" value="{{ old('state_id') ? $customer->state->name : '' }}" readonly>
                    </div>

                    <div class="col-lg-4 mb-3">
                        <label class="heading-content" for="name">City<span style="color: red;">*</span></label>
                        <select class="d-none custom-select d-block w-100 form-select-grp select2" id="city" name="city_id" required>
                            <option value="">Select City</option>
                        </select>

                        <input type="text" class=" mt-2" id="selected_city" value="{{ old('city_id') ? $customer->city->name : '' }}" readonly>
                    </div>
                </div>
                <div class="row form-inp-group">
                    <div class="col-lg-6 mb-6">
                        <label class="heading-content" for="group">Group</label>
                        <input type="test" name="group" class="" value="{{old('group',$customer->group ?? '')}}"readonly>
                    </div>    
                    <div class="col-lg-6 mb-3">
                        <label class="heading-content"  for="name">Perf. Matrix<span style="color: red;">*</span></label>
                        <input type="test" name="matrix" class="" value="{{old('matrix',$customer->matrix ?? '')}}"readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="heading-btn">
            <span class="companydetails-section-heading">Personal Information</span>
        </div>
        <hr class="addsupplier-section-border">
        <div class="upload-file-sec">
            <div class="row customer-files-sec">
                <div class="row form-inp-group">
                    <div class="col-lg-6 mb-3">
                        <label class="heading-content"  for="name">First Name<span style="color: red;">*</span></label>
                        <input type="text" class="" name="first_name" id="first_name" placeholder="John" value="{{ old('first_name', $customer->first_name ?? '') }}" readonly>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label class="heading-content"  for="name">Last Name</label>
                        <input type="text" class="" id="last_name" placeholder="William" value="{{ old('last_name', $customer->last_name ?? '') }}" name="last_name" readonly>
                    </div>
                </div>
                <div class="row form-inp-group">
                    <div class="col-lg-6 mb-3">
                        <label class="heading-content"  for="email">Email<span style="color: red;">*</span></label>
                        <input type="email" class="" id="address"placeholder="john@gmail.com" readonly name="email" value="{{old('email',$customer->email ?? '')}}">
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label class="heading-content"  for="name">Phone no.<span style="color: red;">*</span></label>
                        <input type="number"  id="number"placeholder="+123456789 " name="contect" value="{{old('contect', $customer->contect ?? '')}}"readonly>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div> -->
       
 
@endsection
@section('js')
<script>
    $(document).ready(function() {
        setTimeout(function() {
            window.print();
        }, 1000);
        // var countryId = $('#country').val();
        // var selectedCountry = $('#country option:selected').text();
        // $('#selected_country').val(selectedCountry);
        // var default_state_id = {{ old('state_id', $customer->state_id) }};
        // var default_city_id = {{ old('city_id', $customer->city_id) }};

        // function loadStates(countryId, selected_state_id = null) {
        //     $.ajax({
        //         url: "{{ route('customers.getstate', ':countryId') }}".replace(':countryId', countryId),
        //         type: "GET",
        //         dataType: "json",
        //         success: function(data) {
        //             $('#state').empty();
        //             $('#state').append('<option value="">Select State</option>');
        //             $.each(data, function(key, value) {
        //                 $('#state').append('<option value="'+ value.id +'"'+ (selected_state_id == value.id ? ' selected' : '') +'>'+ value.name +'</option>');
        //                 if (selected_state_id == value.id) {
        //                     console.log(value.name); // Only log the selected state
        //                     $('#selected_state').val(value.name); // Set the readonly input with selected state's name
        //                 }
        //             });
        //             if (selected_state_id) {
        //                 loadCities(selected_state_id, default_city_id);
        //             }
        //         }
        //     });
        // }

        // function loadCities(stateId, selected_city_id = null) {
        //     $.ajax({
        //         url: "{{ route('customers.getcity', ':stateId') }}".replace(':stateId', stateId),
        //         type: "GET",
        //         dataType: "json",
        //         success: function(data) {
        //             $('#city').empty();
        //             $('#city').append('<option value="">Select City</option>');
        //             $.each(data, function(key, value) {
        //                 $('#city').append('<option value="'+ value.id +'"'+ (selected_city_id == value.id ? ' selected' : '') +'>'+ value.name +'</option>');
        //                 if (selected_city_id == value.id) {
        //                     // console.log(value.name); // Only log the selected state
        //                     $('#selected_city').val(value.name); // Set the readonly input with selected state's name
        //                 }
        //             });
        //         }
        //     });
        // }

        // $('#country').change(function() {
        //     var countryId = $(this).val();
        //     loadStates(countryId);
        //     $('#city').empty();
        //     $('#city').append('<option value="">Select City</option>');
        // });

        // $('#state').change(function() {
        //     var stateId = $(this).val();
        //     loadCities(stateId);
        // });

        // // Load states and cities for the default country
        // if (countryId) {
        //     loadStates(countryId, default_state_id);
        // }

        // On page load, show the selected option in the input field
        $('#selected_payment_term').val($('#payment_terms option:selected').text());
        // $('#selected_country').val($('#country option:selected').text());
        // $('#selected_state').val($('#state option:selected').text());
        // $('#selected_city').val($('#city option:selected').text());
        // var selectedCountry = $('#country option:selected').text();
        // var selectedState = $('#state option:selected').text();
        // console.log(selectedCountry);
        // console.log(selectedState);

        // When the country dropdown changes
        // $('#country').change(function() {
        //     var selectedCountry = $('#country option:selected').text();
            
        // });

        // When the state dropdown changes
        // $('#state').change(function() {
        //     var selectedState = $('#state option:selected').text();
        //     // $('#selected_state').val(selectedState);

        //     // Clear the city when state changes
        //     $('#selected_city').val('');
        // });

        // When the city dropdown changes
        // $('#city').change(function() {
        //     var selectedCity = $('#city option:selected').text();
        //     $('#selected_city').val(selectedCity);
        // });

    });

</script>
@endsection