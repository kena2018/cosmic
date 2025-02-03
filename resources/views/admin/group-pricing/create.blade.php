@extends('layouts.app')
@section('navbarTitel', 'Group Pricing Create')
@section('content')

<div class="main-outer">
    <div class="outer card">

        <form class="needs-validation" action="{{ route('group_pricing.store') }}" method="post" novalidate id="form1" id="groupPricingForm">

            <div class="heading-btn">
                <span class="addsupplier-section-heading">Group Pricing Information</span>
                <div class="btn-sec btn_group">
                    <a href="{{ route('group_pricing.index') }}">
                        <span class="back-icons back-tab-icon"></span>
                    </a>
                </div>
            </div>
            <hr class="addsupplier-section-border">
            <div class="upload-file-sec">
                <div class="row customer-files-sec">
                    @csrf
                    <div class="row form-inp-group">
                        <div class="col-md-6 mb-3">
                            <label class="heading-content" for="name">Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control input-form-content @error('name') is-invalid @enderror @if(!empty(old('name'))) is-valid @endif" name="name" id="name" placeholder="Enter pricing name" value="{{ old('name') }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="heading-content" for="group">Group</label>
                            <select class="custom-select d-block w-100 form-select-grp select2" id="group" name="group_id">
                                <option value="">Select Group</option>
                                @foreach($groups as $group)
                                    <option value="{{ $group->id }}" {{ old('group_id') == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                                @endforeach
                            </select>
                            @error('group_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="heading-content" for="start_date">Start Date<span style="color: red;">*</span></label>
                            <input type="date" class="form-control input-form-content @error('start_date') is-invalid @enderror @if(!empty(old('start_date'))) is-valid @endif" name="start_date" id="start_date" value="{{ old('start_date') }}" required>
                            @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="heading-content" for="effective_upto">Effective Upto<span style="color: red;">*</span></label>
                            <input type="date" class="form-control input-form-content @error('effective_upto') is-invalid @enderror @if(!empty(old('effective_upto'))) is-valid @endif" name="effective_upto" id="effective_upto" value="{{ old('effective_upto') }}" required>
                            @error('effective_upto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="row form-inp-group">
                    </div>
                </div>
            </div>
            <div class="upload--file-section">
                <div class="btn-sec btn_group">
                    <div class="button-1 cta_btn">
                        <button type="submit" class="">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection
