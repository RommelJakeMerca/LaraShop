
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<!-- main -->
<main class="l-main">
    <!-- Projects in mind -->
    <section class="project section bd-container" id="about">
        <div class="project_container bd-grid" style="padding: 1.5rem 1rem; background-position: center;background-size: cover;color: #272626;border-radius: .5rem;text-align: center;">
            <div class="project_data">
                <img style="width: 100px;" src="https://blackwebsite.s3.us-east-2.amazonaws.com/bdc4eead-76ca-4557-882c-71d9db460277.png" alt="logo">
                <div>
                    <h2 class="project_title" style="">{{ $details['title'] }}</h2>
                    <p class="project_description">
                        Here is your personal QR Code of your Order Details, Remember to only share this QR Code to those you trust, otherwise your purchase will be compromised, may you have a wonderful day thank you!.
                    </p>
                    <a href="{{ url('getqr_code/'.$order->id) }}" class="button button-white" style="display: inline-block;background-color: #f7ab07;color: rgb(255, 255, 255);padding: .75rem 1rem;border-radius: .25rem;transition: .3s; text-decoration: none;">Get QR Code</a>
                </div>
            </div>
        </div>
    </section>
</main>
</body>
</html>