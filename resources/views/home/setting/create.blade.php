@extends('layout.master')
@section('title', $title)
@section('main-section')

<div class="page-wrapper">
    <div class="content">
        <div class="row">

            <!-- Left: Form with WYSIWYG -->
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header"><h4>Fill Email Details</h4></div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label>Template Key</label>
                            <input type="text" id="template_key" class="form-control" placeholder="e.g. leave_apply">
                        </div>

                        <div class="mb-3">
                            <label>Subject</label>
                            <input type="text" id="template_subject" class="form-control" placeholder="Email Subject">
                        </div>

                        <div class="mb-3">
                            <label>Body</label>
                            <div class="mb-2">
                                <button type="button" class="btn btn-sm btn-light" onclick="format('bold')"><b>B</b></button>
                                <button type="button" class="btn btn-sm btn-light" onclick="format('italic')"><i>I</i></button>
                                <button type="button" class="btn btn-sm btn-light" onclick="format('underline')"><u>U</u></button>
                                <button type="button" class="btn btn-sm btn-light" onclick="format('insertOrderedList')">OL</button>
                                <button type="button" class="btn btn-sm btn-light" onclick="format('insertUnorderedList')">UL</button>
                                <button type="button" class="btn btn-sm btn-light" onclick="format('createLink', prompt('Enter URL','https://'))">Link</button>
                                <button type="button" class="btn btn-sm btn-light" onclick="format('insertImage', prompt('Enter Image URL','https://'))">Image</button>
                            </div>
                            <div id="template_body" contenteditable="true" class="form-control" style="height:200px; overflow:auto; border:1px solid #ccc; padding:5px;"></div>
                        </div>

                        <div class="mb-3">
                            <label>Placeholders</label>
                            <div id="placeholders">
                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="{employee_name}">{employee_name}</button>
                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="{start_date}">{start_date}</button>
                                <button type="button" class="btn btn-outline-primary btn-sm" data-value="{end_date}">{end_date}</button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button id="btnInsertSample" class="btn btn-outline-primary btn-sm">Sample</button>
                            <button id="btnClear" class="btn btn-outline-danger btn-sm">Clear</button>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Right: Live Preview -->
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header"><h4>Live Email Preview</h4></div>
                    <div class="card-body" style="background:#f8f9fa;">
                        <div id="emailPreview" style="border:1px solid #ddd; max-width:600px; margin:auto; background:#fff; font-family:Arial,sans-serif;">
                            <div style="background:#f26522; color:#fff; padding:15px; text-align:center;">
                                {{-- <img src="https://via.placeholder.com/120x40?text=LOGO" alt="Logo"> --}}
                                <h3 id="previewSubjectHeader" style="margin:0; font-size:18px;" class="text-white"></h3>
                            </div>
                            <div id="previewBodyContent" style="padding:20px; color:#333; line-height:1.5; font-size:14px;"></div>
                            <div style="background:#f1f1f1; padding:15px; font-size:12px; text-align:center; color:#555;">
                                &copy; {{ date('Y') }} Chitragupta – The HR Guardian.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <x-footer />
</div>

@endsection

{{-- @section('scripts') --}}
<script>
document.addEventListener("DOMContentLoaded", function(){

    const subjectInput = document.getElementById('template_subject');
    const bodyDiv = document.getElementById('template_body');
    const previewSubject = document.getElementById('previewSubjectHeader');
    const previewBody = document.getElementById('previewBodyContent');

    // Toolbar formatting
    window.format = function(cmd, value=null){
        document.execCommand(cmd, false, value);
        updatePreview();
    }

    // Update preview
    function updatePreview(){
        previewSubject.textContent = subjectInput.value;

        let body = bodyDiv.innerHTML;

        // Replace placeholders with sample values
        body = body.replace(/{employee_name}/g,'John Doe')
                   .replace(/{start_date}/g,'01-Nov-2025')
                   .replace(/{end_date}/g,'05-Nov-2025');

        previewBody.innerHTML = body;
    }

    // Live preview for subject
    subjectInput.addEventListener('input', updatePreview);

    // Live preview for body (contenteditable)
    bodyDiv.addEventListener('input', updatePreview);
    bodyDiv.addEventListener('keyup', updatePreview);
    bodyDiv.addEventListener('paste', function(){
        setTimeout(updatePreview, 10); // paste के बाद delay
    });

    // Placeholders click
    document.querySelectorAll('#placeholders button').forEach(btn=>{
        btn.addEventListener('click', function(){
            const value = this.getAttribute('data-value');
            insertAtCursor(bodyDiv, value);
            updatePreview();
        });
    });

    function insertAtCursor(el, text){
        el.focus();
        const sel = window.getSelection();
        if(!sel.rangeCount) return;
        const range = sel.getRangeAt(0);
        range.deleteContents();
        const node = document.createTextNode(text);
        range.insertNode(node);
        range.setStartAfter(node);
        range.setEndAfter(node);
        sel.removeAllRanges();
        sel.addRange(range);
    }

    // Sample button
    document.getElementById('btnInsertSample').addEventListener('click', function(){
        subjectInput.value = 'Leave Approved';
        bodyDiv.innerHTML = 'Hello {employee_name},<br>Your leave from {start_date} to {end_date} has been approved.';
        updatePreview();
    });

    // Clear button
    document.getElementById('btnClear').addEventListener('click', function(){
        subjectInput.value = '';
        bodyDiv.innerHTML = '';
        updatePreview();
    });

    // Initialize preview
    updatePreview();
});
</script>
{{-- @endsection --}}
