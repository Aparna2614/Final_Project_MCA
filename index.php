
<?php
session_start();
require 'loadenv.php';

$servername = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$dbname = getenv('BLOG_DB_NAME');

// Create connection to video database
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch latest announcement from blog
$sql = "SELECT id, title FROM blog ORDER BY created_at DESC LIMIT 1";
$result = $conn->query($sql);

// Close connection
$conn->close();
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



        /*email*/

:root{
    --box-shadow: 5px 3px 9px rgb(237, 243, 169), -5px -5px 7px rgb(5, 70, 30);
    --inset-box-shadow:inset 5px, 5px, 7px rgb(182,141,228);
    --min-bg:rgb(150,72,240);
    --font-color:rgb(245, 225, 121);
}

.container{
   margin-top: -12vh;
    margin-left: 34rem;
    position:relative;
    width:100vh;
    align-items: center;
    justify-content: center;
    border-radius:80px;
    box-sizing: content-box;
    padding:0px 0px;
    background: rgb(234,148,225);
    background: linear-gradient(35deg, rgba(234,148,225,1) 18%, rgba(214,154,63,1) 52%, rgba(234,148,225,1) 88%);
    z-index: 2;
    
}

h1{
    color: #23033d;
    font-size:1.8rem;
    text-align:center;
    margin-bottom: 7px;
    font-family: frankin 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif

}
h2{
    color: #23033d;
    font-size:1.9rem;
    text-align:center;
    margin-left:4rem;
    margin-bottom: 10px;
    margin-top: 2px;
}
.email input{
    width:350px;
    margin-bottom: 10px;
    margin-left: 300px;
}

.email-verify{
    margin-left: 300px;
    width:350px;
    margin-bottom: 10px;
    display: flex;
    
}

.email-verify input{
    flex: 8;
    display:flex;
}

.email-verify #btn-verify-otp{
    flex:8;
}

.btn-send-otp{
    margin-left: 40px;
    margin-bottom: 20px;
    display: flex;
    padding: 10px 10px;

}
input{
    font-size:1.2rem;
    font-weight:600;
    letter-spacing: .3px;
    color: #150118;
    border:none;
    outline: none;
    padding: 11px 20px;
    border-radius: 30px;
    background-color: var(--main-bg);
    box-shadow: var(--box-shadow);

    &:focus{
        box-shadow: var(--inset-box-shadow);

    }
}
button{
    font-weight: bold;
    color: var(--font-color);
    background-color: var(--main-bg);
    border:none;
    font-size: 1.2rem;
    transition: all .3s;
    border-radius: 30px;
    letter-spacing: 3px;
    cursor: pointer;
    box-shadow: var(--box-shadow);
    &:active{
        box-shadow: var(--inset-box-shadow);
    }
}

        </style>
</head>
 
<body>
    <header class="navbar">
        <div class="bar">
            <p id="heading">THE STORY TELLING MUSEUM</p>
            <ul>
            <li class="navcurrent" id="navitem1"><a href="index.php">HOME</a></li>
                <li class="navitem" id="navitem2" ><a href="imgdata.php">IMAGES</a></li>
                <li  class="navitem" id="navitem3"><a href="vdo.php">VIDEOS</a></li>
                <li class="navitem" id="navitem4"><a href="storyteller.php">STORY TELLER</a></li>
                <li class="navitem" id="navitem5"><a href="contact.php">CONTACT US</a></li>
                <li class="navitem navitem6"><a href="login.php"><img src="homeimages/admin.png"></a></li>
            </ul>
      
          </div>
    </header>
    

    <section class="top-parallex">
        <!-- Your museum content goes here -->
        
        <img src="homeimages/moon.png" alt="" id="moon"> 
        <img src="homeimages/mount.png" alt="" id="lmount">
        <img src="homeimages/mount.png" alt="" id="rmount">
        <img src="homeimages/mount.png" alt="" id="cmount">
        <img src="homeimages/lynch1.png" alt="" id="lynch1"> 
        <img src="homeimages/lynch2.png" alt="" id="lynch2"> 
        <img src="homeimages/kill1.png" alt="" id="kill1"> 
        <img src="homeimages/kill1.png" alt="" id="kill2"> 
        <img src="homeimages/kill3.png" alt="" id="kill3"> 

        <img src="homeimages/protect.png" alt="" id="protect"> 

        <h2 id="welcome"> WELCOME TO THE STORY TELLING MUSEUM</h2>
        <img src="homeimages/clouds.png" alt="" id="clouds1">
        <img src="homeimages/clouds.png" alt="" id="clouds2">
        <img src="homeimages/clouds.png" alt="" id="clouds3">
        <img src="homeimages/clouds.png" alt="" id="clouds4">
        

        <p id="intro"> Welcome to The Story Telling Museum, a solemn space dedicated to preserving and sharing the poignant narratives of those who endured the Indian-Pakistani Partition.Discover the untold stories of bravery and despair at the Museum. We dedicate this space to those who endured the horrors of communal violence, displacement, and death during the Partition of India and Pakistan.Approximately 200,000 to 2 million people were killed during the communal riots and violence that erupted during the Partition.Hundreds of thousands of homes were burned or destroyed during the violence. Here, we honor both the survivors and victims, ensuring that the profound tales of resilience and the harrowing events of that era are never forgotten. Join us in this journey of remembrance and reflection</p>

    </section>
    
    <section class="bottom-parallex">

<img src="homeimages/station.png" alt="" id="stl">  
<img src="homeimages/station.png" alt="" id="stc">  
<img src="homeimages/station.png" alt="" id="str">  
<img src="homeimages/train.png" alt="" id="lt">  
<img src="homeimages/train.png" alt="" id="rt">  
<p id="trtext"> The partition led to the displacement of over 15 million people. Approximately half were Muslims, who migrated to Pakistan, while the other half consisted of Hindus and Sikhs, who moved to India.Trains played a crucial role during this migration. An estimated 700,000 refugees traveled by train between 15 August 1947 and 8 September 1947 alone.The journey was marked by immense suffering. Migrants walked for days, faced hunger, and endured hardships. Children starved, and the elderly suffered during this desperate migration.</p>


</section>

<div class="announcement-bar" onclick="window.open('storyteller.php?id=<?php echo $row['id']; ?>', '_blank')">
    <?php if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    ?>
        <h2>Announcement</h2>
        <a href="storyteller.php?id=<?php echo $row['id']; ?>" target="_blank"><?php echo htmlspecialchars($row['title']); ?></a>
    <?php } ?>
</div>

<div class="mail">
        <div class="container">
            <h1>Want to share your stories too ? <br>Connect with Us <hr></h1>
            <h2>𝕰𝖓𝖙𝖊𝖗 𝖞𝖔𝖚𝖗 𝖊𝖒𝖆𝖎𝖑 𝖍𝖊𝖗𝖊✍</h2>
           
            <form id="subscribe-form" action="subscribe.php" method="POST">
            <div class="email animated">
                <input id="email" type="text" name="email" placeholder="Enter Your Email" autocomplete="off">
            </div>
            
            <div class="email-verify">
               
                <button type="button" id="btn-verify-otp">Click to Subscribe</button>
            </div>
           
        </div>
    </div> 
    <footer>
        <div class="new_footer_top">
             <div class="footer_bg">
                    <div class="footer_bg_one"></div>
                    <div class="footer_bg_two"></div>
                    <div class="row">
                            <h3 class="f-title f_600 t_color f_size_18">Contact Us</h3>
                            <div class="f_social_icon">
                            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=malaydey@jammuuniversity.ac.in" target="_blank">𝓔-𝓶𝓪𝓲𝓵</a>

                                <a href="https://www.jammuuniversity.ac.in/">𝓊𝓃𝒾𝓋𝑒𝓇𝓈𝒾𝓉𝓎</a>
                                <a href="https://www.facebook.com/jammuuniversityupdates/">𝐹𝒶𝒸𝑒𝒷𝑜𝑜𝓀</a>
                                <div class="col-md-2 agileinfo_footer_grid agileinfo_footer_grid1">
                                    <h4>Call Us : +9149665175
                                    <p>DEPARTMENT OF MUSEOLOGY <br> UNIVERSITY OF JAMMU</p></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <div class="footer-word">
        <p>Designed and created by:<br> <a href="https://www.linkedin.com/in/suvanshi?lipi=urn%3Ali%3Apage%3Ad_flagship3_profile_view_base_contact_details%3Bt%2F9RcGm7SRiVpv%2FO7y8Mbw%3D%3D">Suvanshi Gupta</a> & <a href="https://www.linkedin.com/in/aparnasharma2614?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app">Aparna Sharma</a></p>
    </div>
   
    <script>
        function closeAnnouncement() {
            var announcementBar = document.querySelector('.announcement-bar');
            announcementBar.style.display = 'none';
        }
        
    </script>
    
    <script>
        document.getElementById('btn-verify-otp').addEventListener('click', function() {
        
            // Here you can submit the form to subscribe.php or perform other actions
            document.getElementById('subscribe-form').submit();
        
    });
</script>
<script src="script.js"></script>
</body>
</html>


    
