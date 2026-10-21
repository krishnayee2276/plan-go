/**
 * PLAN & GO - Authentication & Social Logic (FIXED)
 */

// CHANGE THIS: Ensure 'main_site' matches your actual folder name exactly
const BASE_URL = 'http://localhost/plan-go/';

// 1. Password Visibility Toggle
function togglePassword(id, icon) {
    const input = document.getElementById(id);
    if (input.type === "password") {
        input.type = "text";
        icon.classList.replace("fa-eye", "fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.replace("fa-eye-slash", "fa-eye");
    }
}

// 2. Magic Link Function
async function sendMagicLink() {
    const { value: email } = await Swal.fire({
        title: 'Login with Email',
        input: 'email',
        inputLabel: 'Enter your registered email.',
        showCancelButton: true,
        confirmButtonColor: '#eeff02'
    });

    if (email) {
        Swal.fire({
            title: 'Sending...',
            didOpen: () => { Swal.showLoading(); }
        });

        try {
            // FIXED: Using BASE_URL instead of ../
            console.log('Attempting to connect to:', BASE_URL + 'api/send_magic_link.php');
            const response = await fetch(BASE_URL + 'api/send_magic_link.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email: email })
            });
            const result = await response.json();

            if (result.status === 'success') {
                Swal.fire({ icon: 'success', title: '📩 Link sent!' });
            } else {
                Swal.fire({ icon: 'error', title: 'Error', text: result.message });
            }
        } catch (err) {
            Swal.fire({ icon: 'error', title: 'Failed', text: 'Check your internet or folder path.' });
        }
    }
}

// 3. Register Function
async function register() {
    const name = document.getElementById('regName').value;
    const identifier = document.getElementById('regIdentifier').value;
    const pass = document.getElementById('regPassword').value;
    const confirm = document.getElementById('regConfirm').value;

    if (!name || !identifier || !pass || !confirm) {
        Swal.fire({ icon: 'warning', text: 'All fields are required.' });
        return;
    }

    try {
        // FIXED: Using BASE_URL
        console.log('Attempting to connect to:', BASE_URL + 'api/register.php');
        const response = await fetch(BASE_URL + 'api/register.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ fullname: name, identifier: identifier, password: pass })
        });
        const result = await response.json();

        if (result.status === 'success') {
            Swal.fire({ icon: 'success', title: 'Success!' })
.then(() => { window.location.href = BASE_URL + 'login.php'; });
        } else {
            Swal.fire({ icon: 'error', title: 'Error', text: result.message });
        }
    } catch (err) {
        Swal.fire({ icon: 'error', title: 'Connection Error', text: 'API path not found.' });
    }
}

// 4. Login Function
async function login() {
    const identifier = document.getElementById('loginIdentifier').value;
    const pass = document.getElementById('loginPassword').value;

    if (!identifier || !pass) {
        Swal.fire({ icon: 'warning', text: 'Enter credentials.' });
        return;
    }

    const isAdmin = identifier === 'infoplandgo@gmail.com';
    const endpoint = isAdmin ? 'api/admin_login.php' : 'api/login.php';

    try {
        console.log('Attempting to connect to:', BASE_URL + endpoint);
        const response = await fetch(BASE_URL + endpoint, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ identifier: identifier, password: pass })
        });
        const responseText = await response.text();
        console.log('Raw response from server:', responseText);
        const result = JSON.parse(responseText);

        if (result.status === 'success') {
            Swal.fire({ icon: 'success', title: 'Logged In!', timer: 1500, showConfirmButton: false })
                .then(() => {
                    // FIXED: Redirecting to correct paths with BASE_URL
                    window.location.href = isAdmin ? BASE_URL + 'admin/dashboard.php' : BASE_URL + 'main_site/index.php';
                });
        } else {
            Swal.fire({ icon: 'error', title: 'Login Failed', text: result.message });
        }
    } catch (err) {
        Swal.fire({ icon: 'error', title: 'Error', text: 'Server connection failed.' });
    }
}

// 5. Social Icons Logic
document.addEventListener('DOMContentLoaded', () => {
    const icons = document.querySelectorAll('.social-icons i');
    icons.forEach(icon => {
        icon.style.cursor = "pointer";
        icon.onclick = (e) => {
            e.preventDefault();
            if (icon.classList.contains('fa-google')) {
                window.open('https://accounts.google.com/signin', '_blank');
            } else if (icon.classList.contains('fa-facebook-f')) {
                window.open('https://www.facebook.com/login', '_blank');
            } else if (icon.classList.contains('fa-envelope')) {
                sendMagicLink();
            }
        };
    });
});