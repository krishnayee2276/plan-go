/**
 * Universal Inquiry Modal System
 * Used for Flight, Train, Car, Packages services
 * Brand Colors: Navy Blue #1c1450, Yellow #fae013
 */

// Service types mapping
const inquiryTypes = {
    'flight': 'FLIGHT',
    'train': 'TRAIN',
    'car': 'CAR RENTAL',
    'packages': 'TOUR PACKAGE',
    'domestic': 'DOMESTIC',
    'international': 'INTERNATIONAL',
    'unexplored': 'UNEXPLORED',
    'weekend': 'WEEKEND GETAWAY',
    'general': 'GENERAL'
};

/**
 * Open inquiry modal with specific service type
 * @param {string} serviceType - The service type (flight, train, car, packages, etc.)
 */
function openInquiryModal(serviceType) {
    const modal = document.getElementById('inquiryModal');
    const hiddenInput = document.getElementById('inquiry_type');
    const modalTitle = document.getElementById('inquiryModalTitle');
    const flightFields = document.getElementById('flightFields');
    
    // Set the inquiry type
    const typeValue = inquiryTypes[serviceType.toLowerCase()] || 'GENERAL';
    hiddenInput.value = typeValue;
    
    // Update modal title based on service
    const titles = {
        'flight': 'Flight Booking Inquiry',
        'train': 'Train Booking Inquiry',
        'car': 'Car Rental Inquiry',
        'packages': 'Tour Package Inquiry',
        'domestic': 'Domestic Package Inquiry',
        'international': 'International Package Inquiry',
        'unexplored': 'Unexplored Destination Inquiry',
        'weekend': 'Weekend Getaway Inquiry'
    };
    
    if (modalTitle) {
        modalTitle.textContent = titles[serviceType.toLowerCase()] || 'General Inquiry';
    }
    
    // Show/hide flight-specific fields
    if (flightFields) {
        if (serviceType.toLowerCase() === 'flight') {
            flightFields.classList.add('show');
        } else {
            flightFields.classList.remove('show');
        }
    }
    
    // Show modal
    if (modal) {
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    }
}

/**
 * Close inquiry modal
 */
function closeInquiryModal() {
    const modal = document.getElementById('inquiryModal');
    const form = document.getElementById('inquiryForm');
    const flightFields = document.getElementById('flightFields');
    
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
    
    // Reset form
    if (form) {
        form.reset();
    }
    
    // Hide flight fields
    if (flightFields) {
        flightFields.classList.remove('show');
    }
}

/**
 * Submit inquiry form
 */
function submitInquiry(formData) {
    const submitBtn = document.querySelector('#inquiryForm button[type="submit"]');
    const originalText = submitBtn ? submitBtn.textContent : 'Submit';
    
    // Show loading state
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.textContent = 'Submitting...';
    }
    
    fetch('api/add_inquiry.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Inquiry submitted successfully! We will contact you soon.');
            closeInquiryModal();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error submitting inquiry. Please try again.');
    })
    .finally(() => {
        if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
        }
    });
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Close modal on X click
    const closeBtn = document.querySelector('.modal .close');
    if (closeBtn) {
        closeBtn.addEventListener('click', closeInquiryModal);
    }
    
    // Close modal on outside click
    const modal = document.getElementById('inquiryModal');
    if (modal) {
        window.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeInquiryModal();
            }
        });
    }
    
    // Form submission
    const inquiryForm = document.getElementById('inquiryForm');
    if (inquiryForm) {
        inquiryForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Check if flight fields are required but empty
            const inquiryType = document.getElementById('inquiry_type').value;
            if (inquiryType === 'FLIGHT') {
                const flightFrom = document.getElementById('flight_from');
                const flightTo = document.getElementById('flight_to');
                const flightDate = document.getElementById('flight_date');
                const flightClass = document.getElementById('flight_class');
                
                if (!flightFrom.value || !flightTo.value || !flightDate.value || !flightClass.value) {
                    alert('Please fill in all flight details (From, To, Date, Class)');
                    return;
                }
            }
            
            submitInquiry(new FormData(this));
        });
    }
});
