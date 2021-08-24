
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
        <div class="project_container bd-grid" style="padding: 1.5rem 1rem; background: url(https://images.unsplash.com/photo-1606824722920-4c652a70f348?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80);background-position: center;background-size: cover;color: #fbf9f9;border-radius: .5rem;text-align: center;">
            <div class="project_data">
                <img style="width: 100px;" src="https://blackwebsite.s3.us-east-2.amazonaws.com/bdc4eead-76ca-4557-882c-71d9db460277.png" alt="logo">
                <div>
                    <h2 class="project_title" style="">Hello, {{ $user->username }}</h2>
                    <p class="project_description">
                        Welcome to LegaShop - Balikbayan Groceries | Please click the Activation button to activate your Account.
                    </p>
                </div>
                <a href="{{ url('activate/'.$user->email.'/'.$code) }}" class="button button-white" style="display: inline-block;background-color: #f7ab07;color: rgb(255, 255, 255);padding: .75rem 1rem;border-radius: .25rem;transition: .3s; text-decoration: none;">Activate Account</a>
            </div>
        </div>
    </section>
</main>
</body>
</html>