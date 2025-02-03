
@extends('layouts.app')
@section('content')
<link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
<div class="main-outer">
    <div class="outer card">
        <form class="form_mn">
            <div class="heading-btn">
                <span class="addsupplier-section-heading">Person Details</span>
                <div class="btn-sec btn_group">
                    <a href="javascript:void(0)">
                    <span class="back-icons back-tab-icon"></span>
                    </a>
                </div>
            </div>
            <hr class="addsupplier-section-border">
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    <div class="row form-inp-group">
                        <div class="col-md-6 mb-3">
                            <label class="heading-content"  for="name">Name</label>
                            <input type="text" class="form-control input-form-content" id="name"
                                placeholder="Enter your name"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="heading-content"  for="email">Email</label>
                            <input type="email" class="form-control input-form-content" id="name"
                                placeholder="Enter your Email">
                        </div>
                    </div>
                    <div class="row form-inp-group">
                        <div class="col-md-6 mb-3 phone-content">
                            <label class="heading-content"  for="number">Phone</label>
                            <input type="tel" class="contact-content form-control input-form-content" id="phone"
                                placeholder="Enter your Phone number"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="heading-content"  for="name">Role</label>
                            <input type="name" class="form-control input-form-content" id="name"
                                placeholder="Enter your Role">
                        </div>
                    </div>
                    <div class="row form-inp-group">
                        <div class="col-md-6 mb-3">
                            <label class="heading-content"  for="name">GST</label>
                            <input type="text" class="form-control input-form-content" id="name"
                                placeholder="Enter your GST Number"
                                required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    <div class="upload--file-section">
                        <div class="btn-sec btn_group">
                        
                        </div>
                        <div class="order-btn-grp">
                            <div class="btn-sec btn_group">
                                <div class="button-1 cta_btn">
                                    <button type="submit" class="primary-button stock-btn">Save Information</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>            
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script>
   const phoneInputField = document.querySelector("#contect");
   const phoneInput = window.intlTelInput(phoneInputField, {
     utilsScript:
       "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
   });
 </script>
@endsection