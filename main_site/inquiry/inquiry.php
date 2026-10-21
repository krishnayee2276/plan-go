<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>plan & go || Inquiry</title>
    <link rel="icon" href="../wp-content/themes/De%20La%20Vista%20Travel/assets/images/plan&go.ico" type="image/png">
    <link rel="manifest" href="assets/images/favicons/site.html">
    <!-- plugin scripts -->
    <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed:200,300,400,400i,500,600,700,800,900%7CSatisfy&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../wp-content/themes/De%20La%20Vista%20Travel/assets/css/animate.min.css">
    <link rel="stylesheet" href="../wp-content/themes/De%20La%20Vista%20Travel/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../wp-content/themes/De%20La%20Vista%20Travel/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../wp-content/themes/De%20La%20Vista%20Travel/assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../wp-content/themes/De%20La%20Vista%20Travel/assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../wp-content/themes/De%20La%20Vista%20Travel/assets/css/swiper.min.css">
    <link rel="stylesheet" href="../wp-content/themes/De%20La%20Vista%20Travel/assets/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../wp-content/themes/De%20La%20Vista%20Travel/assets/css/tripo-icons.css">
    <link rel="stylesheet" href="../wp-content/themes/De%20La%20Vista%20Travel/assets/css/jquery.mCustomScrollbar.min.css">
    <!-- template styles -->
    <link rel="stylesheet" href="../wp-content/themes/De%20La%20Vista%20Travel/style.css">
    <link rel="stylesheet" href="../wp-content/themes/De%20La%20Vista%20Travel/assets/css/responsive.css">
</head>

<body>
    <div class="page-wrapper">
        <section class="page-header feed">
            <div class="container">
                <h2>Inquiry Now</h2>
                <ul class="thm-breadcrumb list-unstyled">
                    <li><a href="../index.php">Home</a></li>
                    <li><span>Inquiry Now</span></li>
                </ul>
            </div>
        </section>

        <section id="feedback" class="contact-one">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="inquirymTitle">
                            <h2 class="feedback">Drop us a line</h2>
                        </div>
                        <div class="pic">
                            <img src="../wp-content/themes/De%20La%20Vista%20Travel/assets/images/inquiry1.webp" alt="plan & go" title="plan & go" width="570" height="570" loading="lazy">
                        </div>
                    </div>
                    <div class="col-lg-6 left col-md-6">
                        <h2 id="iwTitle" class="feedback">Drop us a line</h2>

                        <div id="inquiryFormContainer">
                            <form id="inquiryForm" class="contact-one__form">
                                <div class="row low-gutters">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" name="name" placeholder="Your Name*" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="email" name="email" placeholder="Email Address*" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" name="phone" placeholder="Phone Number*" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" name="destination" placeholder="Destination*" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <textarea name="message" placeholder="Write Message*" required rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group text-center">
                                            <button type="submit" class="thm-btn contact-one__btn">Send Message</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div id="formMessage" style="display: none; margin-top: 20px; padding: 10px; border-radius: 5px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        document.getElementById('inquiryForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;

            submitBtn.disabled = true;
            submitBtn.textContent = 'Sending...';

            const messageDiv = document.getElementById('formMessage');
            messageDiv.style.display = 'none';

            fetch('inquiry_submit.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                messageDiv.style.display = 'block';
                messageDiv.style.backgroundColor = data.success ? '#d4edda' : '#f8d7da';
                messageDiv.style.color = data.success ? '#155724' : '#721c24';
                messageDiv.style.border = `1px solid ${data.success ? '#c3e6cb' : '#f5c6cb'}`;
                messageDiv.style.padding = '10px';
                messageDiv.style.marginTop = '20px';
                messageDiv.style.borderRadius = '5px';
                messageDiv.innerHTML = data.message;

                if (data.success) {
                    this.reset();
                    setTimeout(() => {
                        messageDiv.style.display = 'none';
                    }, 3000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                messageDiv.style.display = 'block';
                messageDiv.style.backgroundColor = '#f8d7da';
                messageDiv.style.color = '#721c24';
                messageDiv.style.border = '1px solid #f5c6cb';
                messageDiv.style.padding = '10px';
                messageDiv.style.marginTop = '20px';
                messageDiv.style.borderRadius = '5px';
                messageDiv.innerHTML = 'An error occurred. Please try again.';
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            });
        });
    </script>
</body>
</html>
