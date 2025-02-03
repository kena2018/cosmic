<!DOCTYPE html>
<html>
<head>
    <title>Lamination Details PDF</title>
    <style>
    .pdf-container h2 { font-size: 22px;  font-weight: 600;  color: #6B4023;  padding: 0px 20px;}
    .main-outer {  padding: 10px 20px;}
    .addsupplier-section-heading { font-size: 17px; font-weight: 600; line-height: 38px; color: #6B4023;}
    .addsupplier-section-border { margin: 5px 0; border: 1px solid #00000026 !important;}
    .outer.card { padding: 20px 20px; border: 1px solid #00000026; box-shadow: 0 1px 2px rgba(56, 65, 74, 0.15); border-radius: 5px;}
    .upload-file-sec {  padding: 0 4px 0 4px; width: 100%;}
    .form-inp-group { display: flex; flex-wrap: wrap;}
    .form-inp-group p { flex: 0 0 50%;font-size:15px;}
    </style>
</head>
<body>
<div class="pdf-container">
    <h2>Lamination  Information</h2>
    <div class="main-outer">
        <div class="outer card">
            <div class="heading-btn">
                <span class="addsupplier-section-heading">Lamination  Details</span>
                <hr class="addsupplier-section-border">
                <div class="upload-file-sec">
                    <div class="row customer-files-sec">
                        <div class="row form-inp-group">
                            <p><strong>Paper Name:</strong> {{ $laminnations->paper_name }}</p>
                            <p><strong>Lamination Name:</strong> {{ $laminnations->lamination_name }}</p>
                            <p><strong>Gum Name:</strong> {{ $laminnations->gum_name }}</p>
                            <p><strong>Lamination Type:</strong> {{ $laminnations->lamination_type }}</p>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
</body>
</html>
