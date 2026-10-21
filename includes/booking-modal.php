<!-- ============================================
     UNIVERSAL BOOKING MODAL - Flight & Train
     Theme: Navy Blue #1c1450, Yellow #fae013
     ============================================ -->

<style>
.booking-modal .modal-content {
    border: none;
    border-radius: 12px;
    box-shadow: 0 15px 50px rgba(0,0,0,0.3);
}

.booking-modal .modal-header {
    background: linear-gradient(135deg, #1c1450 0%, #2e2352 100%);
    color: white;
    border-radius: 12px 12px 0 0;
    padding: 20px 25px;
    border: none;
}

.booking-modal .modal-header .btn-close {
    filter: brightness(0) invert(1);
}

.booking-modal .modal-title {
    font-weight: 700;
    font-size: 1.25rem;
}

.booking-modal .modal-body {
    padding: 25px;
}

.booking-modal .form-label {
    font-weight: 600;
    color: #1c1450;
    margin-bottom: 6px;
    font-size: 0.9rem;
}

.booking-modal .form-control {
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    padding: 12px 15px;
    transition: all 0.3s ease;
}

.booking-modal .form-control:focus {
    border-color: #1c1450;
    box-shadow: 0 0 0 3px rgba(28, 20, 80, 0.1);
}

.booking-modal .btn-submit {
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

.booking-modal .btn-submit:hover {
    background: linear-gradient(135deg, #e6d010 0%, #d4be0d 100%);
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(250, 224, 19, 0.4);
}

.booking-icon {
    color: #1c1450;
    margin-right: 8px;
}

.required-mark {
    color: #dc3545;
}
</style>

<!-- Universal Booking Modal -->
<div class="modal fade booking-modal" id="bookingInquiryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalTitle">
                    <i class="fas fa-plane booking-icon"></i> Flight Booking
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="bookingForm">
                    <!-- Hidden input for service type -->
                    <input type="hidden" id="serviceType" name="service_type" value="FLIGHT">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="inquiryName" class="form-label">Full Name <span class="required-mark">*</span></label>
                            <input type="text" class="form-control" id="inquiryName" name="name" required placeholder="Your full name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="inquiryPhone" class="form-label">Phone <span class="required-mark">*</span></label>
                            <input type="tel" class="form-control" id="inquiryPhone" name="phone" required placeholder="+91 98765 43210">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="inquiryFrom" class="form-label">
                                <i class="fas fa-plane-departure booking-icon"></i>From (Source) <span class="required-mark">*</span>
                            </label>
                            <input type="text" class="form-control" id="inquiryFrom" name="from_city" required placeholder="e.g., Mumbai">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="inquiryTo" class="form-label">
                                <i class="fas fa-plane-arrival booking-icon"></i>To (Destination) <span class="required-mark">*</span>
                            </label>
                            <input type="text" class="form-control" id="inquiryTo" name="to_city" required placeholder="e.g., Delhi">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="inquiryDate" class="form-label">
                            <i class="fas fa-calendar booking-icon"></i>Travel Date <span class="required-mark">*</span>
                        </label>
                        <input type="date" class="form-control" id="inquiryDate" name="travel_date" required>
                    </div>
                    
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-paper-plane me-2"></i> Submit Inquiry
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ============================================
     JavaScript - Universal Modal Trigger
     ============================================ -->
<script>
/**
 * Open booking modal with specific type
 * @param {string} type - 'FLIGHT' or 'TRAIN'
 */
function openBookingModal(type) {
    // Set hidden input value
    document.getElementById('serviceType').value = type;
    
    // Update modal title based on type
    var title = document.getElementById('bookingModalTitle');
    if (type === 'TRAIN') {
        title.innerHTML = '<i class="fas fa-train booking-icon"></i> Train Booking';
    } else {
        title.innerHTML = '<i class="fas fa-plane booking-icon"></i> Flight Booking';
    }
    
    // Reset form
    document.getElementById('bookingForm').reset();
    
    // Show modal manually
    var modalEl = document.getElementById('bookingInquiryModal');
    var modal = new bootstrap.Modal(modalEl);
    modal.show();
}

// Form submission handler
document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('bookingForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            var submitBtn = form.querySelector('button[type="submit"]');
            var originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Submitting...';
            
            var formData = new FormData(form);
            
            fetch('booking_process.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Your booking inquiry has been sent! Our team will contact you soon.');
                    form.reset();
                    var modalEl = document.getElementById('bookingInquiryModal');
                    var modal = bootstrap.Modal.getInstance(modalEl);
                    if (modal) modal.hide();
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
