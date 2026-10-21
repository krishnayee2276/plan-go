<?php
include "includes/auth.php";
include "includes/db_config.php";

if(isset($_GET['reply'])){
  $pdo->query("UPDATE enquiries SET status='Replied' WHERE id=".$_GET['reply']);
}

include "includes/header.php";
include "includes/sidebar.php";
$q = $pdo->query("SELECT * FROM inquiries");
?>
<div class="main">
  <!-- Top Bar -->
  <div class="topbar">
    <div>
      <h1>Inquiries</h1>
      <p class="welcome">Customer inquiries and messages</p>
    </div>
  </div>

  <!-- Inquiries List -->
  <div class="inquiries-list">
    <table class="table table-striped">
      <thead>
        <tr style="background:#1c1450;color:white;">
          <th style="background:#1c1450;color:white;">Type</th>
          <th style="background:#1c1450;color:white;">Name</th>
          <th style="background:#1c1450;color:white;">Email</th>
          <th style="background:#1c1450;color:white;">Phone</th>
          <th style="background:#1c1450;color:white;">Source</th>
          <th style="background:#1c1450;color:white;">Travel Date</th>
          <th style="background:#1c1450;color:white;">Message</th>
          <th style="background:#1c1450;color:white;">Status</th>
          <th style="background:#1c1450;color:white;">Date</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $inquiries = $q->fetchAll();
        
        function getTypeBadge($type) {
            $type = strtolower($type);
            if (strpos($type, 'flight') !== false) return 'background:#3498db';
            if (strpos($type, 'train') !== false) return 'background:#9b59b6';
            if (strpos($type, 'car') !== false) return 'background:#e67e22';
            if (strpos($type, 'package') !== false) return 'background:#1c1450';
            if (strpos($type, 'domestic') !== false) return 'background:#27ae60';
            if (strpos($type, 'international') !== false) return 'background:#e74c3c';
            return 'background:#95a5a6';
        }
        
        function parseInquiry($msg, &$type, &$src, &$date, &$text) {
            if (preg_match('/\[([^\]]+)\]/', $msg, $m)) {
                $type = $m[1];
                $msg = str_replace($m[0], '', $msg);
            } else { $type = 'General'; }
            if (preg_match('/^(.+?)\s*\|\s*Phone:\s*([^|]+)\s*\|\s*Date:\s*([^-|]+)\s*-\s*(.+)$/', $msg, $m)) {
                $src = trim($m[1]); $date = trim($m[2]); $text = trim($m[3]);
            } else { $src = '-'; $date = '-'; $text = $msg; }
        }
        
        foreach($inquiries as $inquiry):
            $type = ''; $src = ''; $date = ''; $text = '';
            parseInquiry($inquiry['message'], $type, $src, $date, $text);
            $badge = getTypeBadge($type);
        ?>
        <tr>
          <td><span style="<?= $badge ?>;color:white;padding:4px 10px;border-radius:12px;font-size:11px;font-weight:700;text-transform:uppercase;display:inline-block;"><?= htmlspecialchars($type) ?></span></td>
          <td><?= htmlspecialchars($inquiry['name']) ?></td>
          <td><?= htmlspecialchars($inquiry['email']) ?></td>
          <td><?= htmlspecialchars($inquiry['phone']) ?></td>
          <td><?= htmlspecialchars($src) ?></td>
          <td><?= htmlspecialchars($date) ?></td>
          <td style="max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="<?= htmlspecialchars($text) ?>"><?= htmlspecialchars($text) ?></td>
          <td><span style="background:<?= $inquiry['status']=='New'?'#1c1450':'#6c757d' ?>;color:white;padding:5px 10px;border-radius:4px;"><?= htmlspecialchars($inquiry['status']) ?></span></td>
          <td><?= date('M d, Y', strtotime($inquiry['created_at'])) ?></td>
        </tr>
        <?php endforeach; ?>

        <?php if(count($inquiries) == 0): ?>
        <tr>
          <td colspan="9" class="text-center">No inquiries yet</td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Enquiry Modal -->
<div id="enquiryModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Enquiry Details</h3>
      <span class="modal-close">&times;</span>
    </div>
    <div class="modal-body" id="enquiryDetails">
      <!-- Enquiry details will be loaded here -->
    </div>
  </div>
</div>

<script>
// Search and filter functionality
document.getElementById('enquirySearch').addEventListener('input', filterEnquiries);
document.getElementById('statusFilter').addEventListener('change', filterEnquiries);

function filterEnquiries() {
  const searchTerm = document.getElementById('enquirySearch').value.toLowerCase();
  const statusFilter = document.getElementById('statusFilter').value;
  const enquiries = document.querySelectorAll('.enquiry-item');

  enquiries.forEach(enquiry => {
    const name = enquiry.querySelector('strong').textContent.toLowerCase();
    const email = enquiry.querySelector('small').textContent.toLowerCase();
    const status = enquiry.querySelector('.status-badge').textContent;

    const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm);
    const matchesStatus = !statusFilter || status === statusFilter;

    enquiry.style.display = matchesSearch && matchesStatus ? 'block' : 'none';
  });
}

function viewEnquiry(id) {
  const modal = document.getElementById('enquiryModal');
  const details = document.getElementById('enquiryDetails');

  // Fetch enquiry details via AJAX
  fetch(`../api/get_inquiry_details.php?id=${id}`)
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        const inquiry = data.inquiry;
        const replies = data.replies;

        let html = `
          <div class="enquiry-full">
            <div class="sender-info">
              <strong>From:</strong> ${inquiry.name} (${inquiry.email})<br>
              <strong>Phone:</strong> ${inquiry.phone}<br>
              <strong>Destination:</strong> ${inquiry.destination}<br>
              <strong>Date:</strong> ${new Date(inquiry.created_at).toLocaleString()}
            </div>
            <div class="message-content">
              <strong>Message:</strong><br>
              ${inquiry.message.replace(/\n/g, '<br>')}
            </div>`;

        if (replies.length > 0) {
          html += '<div class="replies-section"><h4>Previous Replies:</h4>';
          replies.forEach(reply => {
            html += `
              <div class="reply-item">
                <strong>Reply on ${new Date(reply.created_at).toLocaleString()}:</strong><br>
                ${reply.admin_message.replace(/\n/g, '<br>')}
                ${reply.suggested_packages ? '<br><strong>Suggested Packages:</strong><br>' + reply.suggested_packages.replace(/\n/g, '<br>') : ''}
              </div>`;
          });
          html += '</div>';
        }

        if (inquiry.status === 'New') {
          html += `
            <div class="reply-form">
              <h4>Send Reply</h4>
              <form id="replyForm">
                <input type="hidden" name="inquiry_id" value="${id}">
                <div class="form-group">
                  <label>Admin Message:</label>
                  <textarea name="admin_message" required rows="4" placeholder="Enter your reply message..."></textarea>
                </div>
                <div class="form-group">
                  <label>Suggested Packages (Optional):</label>
                  <textarea name="suggested_packages" rows="3" placeholder="Suggest travel packages..."></textarea>
                </div>
                <button type="submit" class="btn-submit">Send Reply</button>
              </form>
            </div>`;
        }

        html += '</div>';
        details.innerHTML = html;

        // Add form submit handler
        const replyForm = document.getElementById('replyForm');
        if (replyForm) {
          replyForm.addEventListener('submit', function(e) {
            e.preventDefault();
            sendReply(new FormData(this));
          });
        }

        modal.style.display = 'block';
      } else {
        details.innerHTML = '<p>Error loading enquiry details.</p>';
        modal.style.display = 'block';
      }
    })
    .catch(error => {
      console.error('Error:', error);
      details.innerHTML = '<p>Error loading enquiry details.</p>';
      modal.style.display = 'block';
    });
}

function sendReply(formData) {
  fetch('../api/reply_inquiry.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert('Reply sent successfully!');
      location.reload(); // Refresh to update status
    } else {
      alert('Error: ' + data.message);
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('Error sending reply.');
  });
}

function markReplied(id) {
  if (confirm('Mark this enquiry as replied?')) {
    window.location.href = `?reply=${id}`;
  }
}

// Modal close functionality
document.querySelector('.modal-close').addEventListener('click', () => {
  document.getElementById('enquiryModal').style.display = 'none';
});

window.addEventListener('click', (e) => {
  const modal = document.getElementById('enquiryModal');
  if (e.target === modal) {
    modal.style.display = 'none';
  }
});
</script>
<?php include "includes/footer.php"; ?>
