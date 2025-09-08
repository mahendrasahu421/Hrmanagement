<div>
    <!-- Simplicity is the consequence of refined emotions. - Jean D'Alembert -->
@if ($message)
    <div class="modal fade" id="alert_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center p-4">
                    <span class="avatar avatar-lg avatar-rounded mb-3 d-inline-flex align-items-center justify-content-center"
                          style="width:60px; height:60px; background-color: {{ $type === 'success' ? '#28a745' : '#dc3545' }};">
                        <i class="ti {{ $type === 'success' ? 'ti-check' : 'ti-x' }} fs-24 text-white"></i>
                    </span>
                    <h5 class="mb-2">{{ $message }}</h5>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var alertModal = new bootstrap.Modal(document.getElementById('alert_modal'));
            alertModal.show();
        });
    </script>
@endif

</div>