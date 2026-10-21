<!-- Flight Inquiry Modal - Bootstrap 5 -->
<!-- Theme: Navy Blue #1c1450, Yellow #fae013 -->

<style>
.flight-modal .modal-content {
    border: none;
    border-radius: 12px;
    box-shadow: 0 15px 50px rgba(0,0,0,0.3);
}

.flight-modal .modal-header {
    background: linear-gradient(135deg, #1c1450 0%, #2e2352 100%);
    color: white;
    border-radius: 12px 12px 0 0;
    padding: 20px 25px;
    border: none;
}

.flight-modal .modal-header .btn-close {
    filter: brightness(0) invert(1);
}

.flight-modal .modal-title {
    font-weight: 700;
    font-size: 1.25rem;
}

.flight-modal .modal-body {
    padding: 25px;
}

.flight-modal .form-label {
    font-weight: 600;
    color: #1c1450;
    margin-bottom: 6px;
    font-size: 0.9rem;
}

.flight-modal .form-control,
.flight-modal .form-select {
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    padding: 12px 15px;
    transition: all 0.3s ease;
}

.flight-modal .form-control:focus,
.flight-modal .form-select:focus {
    border-color: #1c1450;
    box-shadow: 0 0 0 3px rgba(28, 20, 80, 0.1);
}

.flight-modal .btn-submit {
    background: linear-gradient(135deg, #fae013 0%, #e6d010 100%);
    color: #1c1450;
    border: none;
    padding: 14px 30px;
    font-weight: 700;
    font-size: 1rem;
    border-radius: 8px;
    width: 100%;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.flight-modal .btn-submit:hover {
    background: linear-gradient(135deg, #e6d010 0%, #d4be0d 100%);
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(250, 224, 19, 0.4);
}

.flight-modal .btn-submit:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.flight-modal .required-mark {
    color: #dc3545;
}

.flight-icon {
    color: #1c1450;
    margin-right: 8px;
}
</style>

<!-- Flight Inquiry Modal -->
<div class="modal fade flight-modal" id="flightInquiryModal" tabindex="-1" aria-labelledby="flightInquiryModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="flightInquiryModalTitle">
                    <i class="fas fa-plane flight-icon"></i>Flight Booking Inquiry
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="flightInquiryForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="flight_name" class="form-label">Name <span class="required-mark">*</span></label>
                            <input type="text" class="form-control" id="flight_name" name="name" required placeholder="Your full name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="flight_phone" class="form-label">Phone <span class="required-mark">*</span></label>
                            <input type="tel" class="form-control" id="flight_phone" name="phone" required placeholder="+91 98765 43210">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="flight_from" class="form-label">
                                <i class="fas fa-plane-departure flight-icon"></i>From (Source) <span class="required-mark">*</span>
                            </label>
                            <input type="text" class="form-control" id="flight_from" name="from_city" required placeholder="e.g., Mumbai">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="flight_to" class="form-label">
                                <i class="fas fa-plane-arrival flight-icon"></i>To (Destination) <span class="required-mark">*</span>
                            </label>
                            <input type="text" class="form-control" id="flight_to" name="to_city" required placeholder="e.g., Delhi">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="flight_date" class="form-label">
                            <i class="fas fa-calendar flight-icon"></i>Travel Date <span class="required-mark">*</span>
                        </label>
                        <input type="date" class="form-control" id="flight_date" name="travel_date" required>
                    </div>
                    
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-paper-plane me-2"></i> Submit Inquiry
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const flightForm = document.getElementById('flightInquiryForm');
    
    if (flightForm) {
        flightForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = flightForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Submitting...';
            
            const formData = new FormData(flightForm);
            
            fetch('flight_inquiry_process.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Flight inquiry submitted successfully! We will contact you soon.');
                    // Reset form
                    flightForm.reset();
                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('flightInquiryModal'));
                    if (modal) {
                        modal.hide();
                    } else {
                        // Fallback for older Bootstrap
                        $('#flightInquiryModal').modal('hide');
                    }
                    // Redirect back to the page
                    window.location.href = window.location.href;
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error submitting inquiry. Please try again.');
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });
    }
});
</script>
