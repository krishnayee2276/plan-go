<!-- Universal Inquiry Modal - Bootstrap 5 -->
<!-- Brand Colors: Navy Blue #1c1450, Yellow #fae013 -->

<style>
.inquiry-modal .modal-content {
    border: none;
    border-radius: 12px;
    box-shadow: 0 15px 50px rgba(0,0,0,0.3);
}

.inquiry-modal .modal-header {
    background: linear-gradient(135deg, #1c1450 0%, #2e2352 100%);
    color: white;
    border-radius: 12px 12px 0 0;
    padding: 20px 25px;
    border: none;
}

.inquiry-modal .modal-header .btn-close {
    filter: brightness(0) invert(1);
}

.inquiry-modal .modal-title {
    font-weight: 700;
    font-size: 1.25rem;
}

.inquiry-modal .modal-body {
    padding: 25px;
}

.inquiry-modal .form-label {
    font-weight: 600;
    color: #1c1450;
    margin-bottom: 6px;
    font-size: 0.9rem;
}

.inquiry-modal .form-control,
.inquiry-modal .form-select {
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    padding: 12px 15px;
    transition: all 0.3s ease;
}

.inquiry-modal .form-control:focus,
.inquiry-modal .form-select:focus {
    border-color: #1c1450;
    box-shadow: 0 0 0 3px rgba(28, 20, 80, 0.1);
}

.inquiry-modal .btn-submit {
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

.inquiry-modal .btn-submit:hover {
    background: linear-gradient(135deg, #e6d010 0%, #d4be0d 100%);
    transform: translateY(-2px);
    box-shadow: 0 5px 20px rgba(250, 224, 19, 0.4);
}

.inquiry-modal .btn-submit:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.inquiry-modal .required-mark {
    color: #dc3545;
}

.flight-fields {
    display: none;
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 15px;
}

.flight-fields.show {
    display: block;
}

.flight-fields .form-label {
    color: #1c1450;
}

.flight-icon {
    color: #1c1450;
    margin-right: 5px;
}
</style>

<div class="modal fade inquiry-modal" id="inquiryModal" tabindex="-1" aria-labelledby="inquiryModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inquiryModalTitle">General Inquiry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="inquiryForm">
                    <!-- Hidden input for inquiry type -->
                    <input type="hidden" id="inquiry_type" name="inquiry_type" value="GENERAL">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name <span class="required-mark">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required placeholder="Your full name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email <span class="required-mark">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" required placeholder="your@email.com">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone <span class="required-mark">*</span></label>
                            <input type="tel" class="form-control" id="phone" name="phone" required placeholder="+91 98765 43210">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="destination" class="form-label">Travel Date</label>
                            <input type="text" class="form-control" id="destination" name="destination" placeholder="e.g., Dec 25, 2024">
                        </div>
                    </div>
                    
                    <!-- Flight-specific fields (shown when flight is selected) -->
                    <div class="flight-fields" id="flightFields">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="flight_from" class="form-label">
                                    <i class="fas fa-plane-departure flight-icon"></i>From (City) <span class="required-mark">*</span>
                                </label>
                                <input type="text" class="form-control" id="flight_from" name="flight_from" placeholder="e.g., Mumbai">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="flight_to" class="form-label">
                                    <i class="fas fa-plane-arrival flight-icon"></i>To (City) <span class="required-mark">*</span>
                                </label>
                                <input type="text" class="form-control" id="flight_to" name="flight_to" placeholder="e.g., Delhi">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="flight_date" class="form-label">
                                    <i class="fas fa-calendar flight-icon"></i>Travel Date <span class="required-mark">*</span>
                                </label>
                                <input type="date" class="form-control" id="flight_date" name="flight_date">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="flight_class" class="form-label">
                                    <i class="fas fa-chair flight-icon"></i>Class <span class="required-mark">*</span>
                                </label>
                                <select class="form-select" id="flight_class" name="flight_class">
                                    <option value="">Select Class</option>
                                    <option value="Economy">Economy</option>
                                    <option value="Premium Economy">Premium Economy</option>
                                    <option value="Business">Business</option>
                                    <option value="First Class">First Class</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="message" class="form-label">Message <span class="required-mark">*</span></label>
                        <textarea class="form-control" id="message" name="message" rows="4" required placeholder="Tell us about your travel requirements..."></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-paper-plane me-2"></i> Submit Inquiry
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include the JavaScript -->
<script src="js/inquiry-modal.js"></script>
