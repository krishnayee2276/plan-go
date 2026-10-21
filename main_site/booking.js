// booking.js - MakeMyTrip Style Flight Modal + Booking Flow
// Handles booking_details.php totals AND flight_results.php modal selection/BOOK NOW

document.addEventListener('DOMContentLoaded', function() {
  // 1. BOOKING DETAILS PAGE: Totals & Payment (existing functionality)
  const basePrice = window.basePrice || 10000;
  const tax = window.tax || (basePrice * 0.08);
  const insurancePrice = window.insurancePrice || 500;
  const mealPrice = window.mealPrice || 300;
  let currentTotal = window.currentTotal || (basePrice + tax);
  let addonsTotal = 0;

  const insuranceCheckbox = document.querySelector('input[name="insurance"]');
  const mealCheckbox = document.querySelector('input[name="meal"]');
  const paymentOptions = document.querySelectorAll('.payment-option');
  const addonsSummary = document.getElementById('addonsSummary');
  const addonsAmount = document.getElementById('addonsAmount');
  const fareTotal = document.getElementById('fareTotal');
  const dynamicTotal = document.getElementById('dynamicTotal');
  const proceedBtn = document.getElementById('proceedBtn');
  const bookingForm = document.getElementById('bookingForm');
  const paymentLoader = document.getElementById('paymentLoader');

  function updateTotals() {
    addonsTotal = 0;
    let addonsText = 'Add-ons';

    if (insuranceCheckbox?.checked) addonsTotal += insurancePrice;
    if (mealCheckbox?.checked) addonsTotal += mealPrice;

    if (addonsTotal > 0) {
      addonsText += ` (${addonsTotal === insurancePrice ? 'Insurance' : addonsTotal === mealPrice ? 'Meal' : 'Insurance + Meal'})`;
      addonsAmount.textContent = '₹' + addonsTotal.toLocaleString();
    } else {
      addonsAmount.textContent = '₹0';
    }

    currentTotal = basePrice + tax + addonsTotal;
    fareTotal.textContent = currentTotal.toLocaleString();
    dynamicTotal.textContent = currentTotal.toLocaleString();

    document.querySelector('input[name="addons_insurance"]').value = insuranceCheckbox?.checked ? '1' : '0';
    document.querySelector('input[name="addons_meal"]').value = mealCheckbox?.checked ? '1' : '0';
  }

  if (insuranceCheckbox) insuranceCheckbox.addEventListener('change', updateTotals);
  if (mealCheckbox) mealCheckbox.addEventListener('change', updateTotals);

  paymentOptions.forEach(option => {
    option.addEventListener('click', function() {
      paymentOptions.forEach(opt => opt.classList.remove('active'));
      this.classList.add('active');
      document.querySelector('input[name="payment_mode"]').value = this.dataset.mode;
    });
  });

  if (bookingForm) {
    bookingForm.addEventListener('submit', function(e) {
      const requiredFields = bookingForm.querySelectorAll('[required]');
      let isValid = true;
      requiredFields.forEach(field => {
        if (!field.value.trim()) {
          field.classList.add('is-invalid');
          isValid = false;
        } else {
          field.classList.remove('is-invalid');
        }
      });
      if (!isValid) e.preventDefault();
      else {
        if (paymentLoader) paymentLoader.style.display = 'flex';
        if (proceedBtn) {
          proceedBtn.disabled = true;
          proceedBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
        }
      }
    });
  }

  updateTotals();

  // Input focus styles (booking page)
  document.querySelectorAll('.form-control, .form-select').forEach(input => {
    input.addEventListener('focus', function() { this.parentElement.style.boxShadow = '0 0 0 3px rgb(28 20 80 / 0.1)'; });
    input.addEventListener('blur', function() { this.parentElement.style.boxShadow = 'none'; });
  });

  document.querySelectorAll('.addon-checkbox').forEach(checkbox => {
    checkbox.addEventListener('click', function(e) {
      const cb = this.querySelector('input[type="checkbox"]');
      cb.checked = !cb.checked;
      cb.dispatchEvent(new Event('change'));
    });
  });

  // 2. FLIGHT RESULTS MODAL: Fare Selection + BOOK NOW (Fixed & Robust)
  let currentFlightData = {}; // {flightId, saverPrice, flexiPrice, premiumPrice, fromCity, toCity}

  // VIEW PRICES click: populate modal with dynamic data
  document.querySelectorAll('.view-prices').forEach(btn => {
    btn.addEventListener('click', function() {
      currentFlightData = {
        flightId: parseInt(this.dataset.flightId),
        saverPrice: parseInt(this.dataset.saverPrice),
        flexiPrice: parseInt(this.dataset.flexiPrice),
        premiumPrice: parseInt(this.dataset.premiumPrice),
        fromCity: this.dataset.fromCity,
        toCity: this.dataset.toCity
      };

      // Update price displays
      const saverDisplay = document.querySelector('#saverRadio ~ .fare-card-label .price-display');
      const flexiDisplay = document.querySelector('#flexiRadio ~ .fare-card-label .price-display');
      const premiumDisplay = document.querySelector('#premiumRadio ~ .fare-card-label .price-display');

      if (saverDisplay) saverDisplay.textContent = currentFlightData.saverPrice.toLocaleString();
      if (flexiDisplay) flexiDisplay.textContent = currentFlightData.flexiPrice.toLocaleString();
      if (premiumDisplay) premiumDisplay.textContent = currentFlightData.premiumPrice.toLocaleString();

      // Update data-price on cards
      const saverCard = document.querySelector('.saver');
      const flexiCard = document.querySelector('.flexi');
      const premiumCard = document.querySelector('.premium');
      if (saverCard) saverCard.dataset.price = currentFlightData.saverPrice;
      if (flexiCard) flexiCard.dataset.price = currentFlightData.flexiPrice;
      if (premiumCard) premiumCard.dataset.price = currentFlightData.premiumPrice;

      // Reset selection
      document.querySelectorAll('.fare-card-modal').forEach(card => card.classList.remove('selected'));
      document.getElementById('modalBookBtn').disabled = true;

      console.log('Modal populated for flight', currentFlightData.flightId);
    });
  });

  // Fare radio selection: visual feedback + enable BOOK NOW
  document.addEventListener('change', function(e) {
    if (e.target.matches('.fare-radio')) {
      document.querySelectorAll('.fare-card-modal').forEach(card => card.classList.remove('selected'));
      e.target.closest('.fare-card-modal').classList.add('selected');
      document.getElementById('modalBookBtn').disabled = false;
      console.log('Fare selected:', e.target.value);
    }
  });

  // BOOK NOW click: redirect with correct params
  document.getElementById('modalBookBtn')?.addEventListener('click', function() {
    const selectedRadio = document.querySelector('input[name="fareSelect"]:checked');
    if (selectedRadio && currentFlightData.flightId) {
      const fareType = selectedRadio.value.toUpperCase();
      const price = parseInt(selectedRadio.closest('.fare-card-modal').dataset.price);
      
      const url = `complete_booking.php?flight_id=${currentFlightData.flightId}&fare=${fareType}&price=${price}&from_city=${encodeURIComponent(currentFlightData.fromCity)}&to_city=${encodeURIComponent(currentFlightData.toCity)}`;
      
      console.log('Navigating to:', url);
      window.location.href = url;
    } else {
      alert('Please select a fare type first.');
    }
  });

  console.log('Booking JS loaded - Modal + Booking Flow Fixed!');
});
