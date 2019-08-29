<!DOCTYPE html>
<html>

<!-- Google Analytics -->
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-75466786-1', 'auto');
ga('send', 'pageview');
</script>
<!-- End Google Analytics -->

<head>
  <title> Welcome to Clearmaze Technologies </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="contactStyle.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>

</head>

<body>

    <!-- ID's in div statements, container, and content were put in place for the sole
        purpose of implementing a sticky footer, check CSS to see implementation
    -->
  <div class="main-container">
    <div class="container-fluid">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid" id="navContainer">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="../index.html"><img src="../assets/logoColorFull.svg" style="height:100%;"></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                      <li><a href="contact.php">contact</a></li>
                      <li><a href="../about/about.html">about</a></li>
                      <li><a href="https://medium.com/@clearmaze" target="blank">blog</a></li>
                      <li><a id = "loginbtn" href="../login/login.php">
                        <div id = "logintext">login</div>
                      </a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div id="ContactTitle">
        Contact Us
    </div>

    <div class="row" id="contact">
      <div class="col-lg-8">
        <p>Hey you! Yes you! If you have questions about what we do, where we're headed or what we had for breakfast, then ask away! This form will send us your message and we will get back to you as soon as possible.</p>
        <br>
        <p> For business inquiries, email us at info@clearmaze.net </p>
        <br>
        <p>
          If you are an institution, please <a style="color:orange;" href="https://clearmaze-eq.on.spiceworks.com/portal">click here</a> if you wish to resolve an equivalency issue.
        </p>
      </div>
      <div class="col-lg-4">
        <form id="ajax-contact" method="post" action="contact.php">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea class="form-control" name="message" id="message" required></textarea>
            </div>
            <br>
            <div class="form-group">
                <button type="submit" class='btn btn-success' id="submit">Send!</button>
            </div>
        </form>
      </div>

        <?php

            // Only process POST reqeusts.

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Get the form fields and remove whitespace.
                $name = strip_tags(trim($_POST["name"]));
        				$name = str_replace(array("\r","\n"),array(" "," "),$name);
                $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
                $message = trim($_POST["message"]);

                // Check that data was sent to the mailer.
                if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    // Set a 400 (bad request) response code and exit.
                    http_response_code(400);
                    echo "Oops! There was a problem with your submission. Please complete the form and try again.";
                    exit;
                }

                // Set the recipient email address.
                $recipient = "info@clearmaze.net";

                // Set the email subject.
                $subject = "New contact from $name";

                // Build the email content.
                $email_content = "Name: $name\n";
                $email_content .= "Email: $email\n\n";
                $email_content .= "Message:\n$message\n";

                // Build the email headers.
                $email_headers = "From: $name <$email>";
                // Send the email.
                        if (mail($recipient, $subject, $email_content, $email_headers)) {
                            // Set a 200 (okay) response code.
                            http_response_code(200);
                            echo "Thank You! Your message has been sent.";
                        } else {
                            // Set a 500 (internal server error) response code.
                            http_response_code(500);
                            echo "Oops! Something went wrong and we couldn't send your message.";
                        }

                    }
          ?>

    </div>
</body>

<footer>
    <div class="row" id="social">
        <div class="col-md-3 col-sm-3 col-xs-3" id="facebook">
            <a href="http://www.facebook.com/clearmazetech" target="_blank">
              <img src="../assets/facebook.png" alt="Facebook Link" style="width:35px">
            </a>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3" id="twitter">
            <a href="http://www.twitter.com/clearmazetech" target="_blank">
              <img src="../assets/twitter.png" alt="Twitter Link" style="width:35px">
            </a>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3" id="instagram">
            <a href="http://www.instagram.com/clearmaze"  target="_blank">
                <img src="../assets/instagram.png" alt="Instagram Link" style="width:35px">
            </a>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3" id="tumblr">
            <a href="https://medium.com/@clearmaze" target="_blank">
                <img src="../assets/medium.png" alt="Medium Link" style="width:35px">
            </a>
        </div>
    </div>
    <p> built with &ltsweat, grit, &amp hustle&gt from Chicago, IL </p>
    <p> Copyright 2018 &copy Clearmaze Technologies Inc. |
      <a href="../terms/terms.html" style="color:#cccccc;text-decoration:none;">Terms and Conditions</a>
    </p>
    <br>
</footer>
</div>
</html>
