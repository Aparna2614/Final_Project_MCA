<?php
ob_start(); // Start output buffering

// Database connection for comments section
$conn_comments = mysqli_connect("localhost", "root", "", "contactdb");
if (!$conn_comments) {
    die("Connection failed: " . mysqli_connect_error());
}
date_default_timezone_set('Asia/Kolkata');

// Handle comment submission
if(isset($_POST["submit_comment"])){
    $name = $_POST["Name"];
    $comment = $_POST["comment"];
    $date = date('F d Y, h:i:s A');
    $reply_id = $_POST["reply_id"];

    $query = "INSERT INTO commenttb (Name, comment, date, reply_id, approved) VALUES ('$name', '$comment', '$date', '$reply_id', 0)";
    if(mysqli_query($conn_comments, $query)) {
        echo "<script>alert('Your comment is pending for approval.');</script>";
        // Redirect to avoid form resubmission
        header("Location: {$_SERVER['PHP_SELF']}");
        exit(); // Ensure no further code execution after redirection
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn_comments);
    }
}



// Fetch approved comments
$approved_comments = mysqli_query($conn_comments, "SELECT * FROM commenttb WHERE reply_id = 0 AND approved = 1 ORDER BY date DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSTM</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rubik+Wet+Paint&display=swap');

        .container {
            background: beige;
            width: 700px;
            margin: 0 auto;
            padding-top: 1px;
            padding-bottom: 5px;
        }

        .comment, .reply {
            margin-top: 5px;
            padding: 10px;
            border-bottom: 1px solid black;
        }

        .reply {
            border: 1px solid #ccc;
            background-color: lightblue;
        }

        p {
            margin-top: 5px;
            margin-bottom: 5px;
        }

        form {
            margin: 10px;
        }

        form h3 {
            margin-bottom: 5px;
        }

        form input, form textarea {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }

        button.reply {
            background: lightblue;
        }

        .popup {
            display: none;
            background-color: #f8f9fa;
            color: #000;
            padding: 15px;
            position: fixed;
            top: 10%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 1px solid #000;
            z-index: 1000;
        }

        .comment h4, .reply h4 {
           margin: 0;
             font-size: 18px; /* Increase font size for better visibility */
            font-weight: bold; /* Make the text bold */
                color:darkblue; /* Change to a more visible color */
             border-bottom: 2px solid #007BFF; /* Add a bottom border for emphasis */
            padding-bottom: 5px; /* Add some space below the text */
        }

        #replying-to {
            margin: 10px 0;
            padding: 5px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            display: none;
        }

        #cancel-reply {
    margin: 10px 0;
    padding: 5px 10px;
    border: 1px solid #ccc;
    background-color: lightblue;
    display: none;
    cursor: pointer; /* Added cursor style for better UX */
}

.comment-header {
            background-color: #f8f9fa;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            text-align: center;
            font-weight: bold;
            font-size: .8rem;
        }
    </style>
</head>

<body>
<header class="navbar">
    <div class="bar">
        <p id="heading">THE STORY TELLING MUSEUM</p>
        <ul>
            <li class="navitem" id="navitem1"><a href="index.php">HOME</a></li>
            <li class="navitem" id="navitem2"><a href="imgdata.php">IMAGES</a></li>
            <li class="navitem" id="navitem3"><a href="vdo.php">VIDEOS</a></li>
            <li class="navitem" id="navitem4"><a href="storyteller.php">STORY TELLER</a></li>
            <li class="navcurrent" id="navitem5"><a href="contact.php">CONTACT US</a></li>
        </ul>
    </div>
</header>

<div class="row">
    <div class="col-xs-12">
        <div id="left">

            <h1>Contact Us </h1>

            <div class="formbox">
                <form id="contact-form" method="POST" action="contactform.php">
                    <div class="form-row form-error" style="display:none;"></div>
                    <div class="form-row">
                        <label for="contact-form-name">Name:</label>
                        <input id="contact-form-name" class="form-input" type="text" name="name" required>
                    </div>
                    <div class="form-row">
                        <label for="contact-form-email">Email:</label>
                        <input id="contact-form-email" class="form-input" type="email" name="email" required>
                    </div>
                    <div class="form-row">
                        <label for="contact-form-contact">Mobile:</label>
                        <input id="contact-form-contact" class="form-input" type="text" name="contact">
                    </div>
                    <div class="form-row">
                        <label for="contact-form-message">Message:</label>
                        <textarea id="contact-form-message" class="form-input" name="message" required></textarea>
                    </div>
                    <button type="submit">SEND</button>
                </form>
            </div>
        </div>


        <div id="right">
            <div id="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6075.452251132249!2d74.86357150722374!3d32.71803112426448!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391e849955a0d7cf%3A0x1a5dc7b412505c64!2sUniversity%20of%20Jammu!5e1!3m2!1sen!2sin!4v1718797496806!5m2!1sen!2sin" width="1100" height="750" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div id="map-overlap">
                Dr.Malay Dey, <br>
                Department of Museology, <br>
                University of Jammu, Gujarbasti, Jammu,
                Jammu and Kashmir
                <br>
                <br>
                Contact No- 9149665175

                <span>
                    <br> <span id="at">@</span>
                    : drmalay11de@gmail.com
                </span>
            </div>
        </div>
        <div id="cleared"></div>

    </div>


    <div class="review">

        <h1>

            KINDLY SHARE YOUR REVIEWS
        </h1>


        <section class="container">
        <div class="comment-header">
        Comments will appear after review and approval by our team. Thank you for your patience.
            </div>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div id="replying-to"></div>
                <input type="hidden" name="reply_id" id="reply_id">
                <input type="text" name="Name" placeholder="Your name">
                <textarea name="comment" id="comment-textarea" placeholder="Your comment"></textarea>
                <button class="submit" type="submit" name="submit_comment">Submit</button>
                <button type="button" id="cancel-reply" style="display:none;" onclick="cancelReply();">Cancel Reply</button>
            </form>


            <?php while ($comment = mysqli_fetch_assoc($approved_comments)) : ?>
                <div class="comment">
                    <h4><?= $comment['Name']; ?></h4>
                    <p><?= $comment['date']; ?></p>
                    <p><?= $comment['comment']; ?></p>
                    <button class="reply" onclick="reply(<?php echo $comment['id']; ?>, '<?php echo $comment['Name']; ?>');">Reply</button>
                    <?php
                    // Fetch replies for this comment
                    $comment_id = $comment['id'];
                    $replies = mysqli_query($conn_comments, "SELECT * FROM commenttb WHERE reply_id = $comment_id AND approved = 1");
                    if(mysqli_num_rows($replies) > 0) {
                        while ($reply = mysqli_fetch_assoc($replies)) {
                            echo '<div class="reply">';
                            echo '<h4>' . $reply['Name'] . '</h4>';
                            echo '<p>' . $reply['date'] . '</p>';
                            echo '<p>' . $reply['comment'] . '</p>';
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            <?php endwhile; ?>

            <hr>

            <!-- Form for submitting new comment -->
            
        </section>

        <script>
            function reply(id, Name){
                document.getElementById('reply_id').value = id;
                const replyMessage = document.getElementById('replying-to');
                replyMessage.innerHTML = 'Replying to <b>' + Name + '</b>';
                replyMessage.style.display = 'block';
                const commentTextarea = document.getElementById('comment-textarea');
                commentTextarea.focus();
                document.getElementById('cancel-reply').style.display = 'inline';
            }

            function cancelReply() {
                document.getElementById('reply_id').value = '';
                document.getElementById('replying-to').style.display = 'none';
                document.getElementById('comment-textarea').value = '';
                document.getElementById('cancel-reply').style.display = 'none';
            }
        </script>

        <?php
        // Close connection
        mysqli_close($conn_comments);
        ?>
    </div>

    <script>
        const form = document.getElementById('contact-form');
        const errorDiv = document.querySelector('.form-error');

        form.addEventListener('submit', (event) => {
            event.preventDefault();
            const nameInput = document.getElementById('contact-form-name');
            const emailInput = document.getElementById('contact-form-email');
            const messageInput = document.getElementById('contact-form-message');
            const contactInput = document.getElementById('contact-form-contact');

            // Validate inputs
            if (!nameInput.value || !emailInput.value || !messageInput.value) {
                errorDiv.textContent = 'Please fill in all required fields.';
                errorDiv.style.display = 'block';
            } else if (!isValidEmail(emailInput.value)) {
                errorDiv.textContent = 'Please enter a valid email address.';
                errorDiv.style.display = 'block';
            } else if (!isValidPhoneNumber(contactInput.value)) {
                errorDiv.textContent = 'Please enter a valid 10 digit contact number.';
                errorDiv.style.display = 'block';
            } else {
                // Submit the form (you can add AJAX or other logic here)
                form.submit();
            }
        });

        // Helper function to validate email format
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Helper function to validate phone number (only digits)
        function isValidPhoneNumber(contact) {
           // Remove any non-digit characters (e.g., spaces, dashes)
           const cleanedNumber = contact.replace(/\D/g, '');

           // Check if the cleaned number has exactly 10 digits
           return /^\d{10}$/.test(cleanedNumber);
        }
    </script>

    <footer class="footer">
        <div class="container">
            <p>© 2024 The Story Telling Museum. All rights reserved.</p>
        </div>
    </footer>

</div>

</body>
</html>