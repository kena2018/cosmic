<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Management Print</title>
    <style>
        .form-container {  width: 750px;  margin: 50px auto;  padding: 20px;  background-color: white; border: 1px solid #00000026; box-shadow: 0 1px 2px rgba(56, 65, 74, 0.15); border-radius: 5px;height: 800px;}
        .header {display: flex;  justify-content: space-between;  align-items: center;}
        .logo {  display: flex;  flex-direction: column;  align-items: center;}
        .logo img { width: 100px;}
        .form-title { color: #6B4023;  font-size: 20px;   font-weight: 600;   text-transform: uppercase;}
        .section-title { padding: 15px 0; font-size: 15px; color: #6B4023; font-weight: bold; border-bottom: 1px solid #ddd;}
        .row {  display: flex;  justify-content: space-between;}
        .row label {  width: 150px;  font-weight: bold;}
        .row input[type="text"],
        .row input[type="date"],
        .row select {  width: calc(100% - 160px);  padding: 5px;  border: 1px solid #ddd;  border-radius: 3px;}
        .radio-group {  display: flex;  align-items: center;}
        .radio-group input[type="radio"] {  margin-right: 5px;}
        .radio-group label {  margin-right: 15px;}
        .contact-details, .personal-info {  margin: 20px 0;}
        .footer {  display: flex;  justify-content: space-between;  align-items: center;  padding-top: 20px;  border-top: 2px solid #ddd;}
        .footer div {  width: 40%;  text-align: center;  padding: 10px;  border-top: 2px solid #ff7a00;}
        .footer div span {  font-weight: bold;}
        p.field-size { width: 50%; font-size: 15px;}
    </style>
</head>
<body>
    <div class="form-container">
        <div class="header">
            <div class="form-title">Staff Management Data Print</div>
            <div class="logo">
                <img src="/image/Cosmiclogo (1).png" alt="Logo">
            </div>
        </div>

        <div class="personal-info">
            <div class="section-title">Personal Details</div>
            <div class="row">
                <p class="field-size"><strong>Name:</strong> Test Name</p>
                <p class="field-size"><strong>Email:</strong> admin@gmail.com</p>
            </div>
            <div class="row">
                <p class="field-size"><strong>Phone no.:</strong> 9727768710</p>
                <p class="field-size"><strong>Role:</strong> Admin User</p>
            </div>
        </div>
        <div class="row form-inp-groupsss">
            <span class="addsupplier-section-heading">Permissions</span>
            <div class="permission-content">
                @forelse ($permissions as $permission)
                <div class="permission-sec">
                    <input type="checkbox" name="permissions[]" id="permission{{ $permission->id }}" value="{{ $permission->id }}" class="name permission-checkbox" {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} disabled>
                    <label for="permission{{ $permission->id }}">{{ $permission->name }}</label><br>
                </div>
                @empty
                    <p>No permissions available</p>
                @endforelse
            </div>
        </div>
    </div>
</body>
</html>
