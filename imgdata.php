<?php
require 'imgconnection.php';


$rows = mysqli_query($conn, "SELECT * FROM imagetb ORDER BY id DESC");
$imageFilenames = []; // Initialize an empty array
$descriptions = []; 
//$newImageNames=[];
if ($rows) {
    foreach ($rows as $row) {
        $imageFilenames[] = $row["image"]; 
        $descriptions[] = $row["description"];
      //  $newImageNames[]=$row["$newImageName"];
        // Add each filename to the array
    }
}


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Your Museum Website</title>
    <style>
 

 .partition-image:hover{

    transform: scale(1.5);

 }




    </style>
</head>
  <body>
  <header class="navbar">
        <div class="bar">
            <p id="heading">THE STORY TELLING MUSEUM</p>
            <ul>
            <li class="navitem" id="navitem1"><a href="index.php">HOME</a></li>
                <li class="navcurrent" id="navitem2"><a href="imgdata.php">IMAGES</a></li>
                <li class="navitem" id="navitem3"><a href="vdo.php">VIDEOS</a></li>
                <li class="navitem" id="navitem4"><a href="storyteller.php">STORY TELLER</a></li>
                <li class="navitem" id="navitem5"><a href="contact.php">CONTACT US</a></li>
            </ul>
            
          </div>
    </header>
    <header class=" imgheader">
        <!-- Your logo or website name goes here -->
        <h1>𝓛𝓔𝓣'𝓢 𝓔𝓧𝓟𝓛𝓞𝓡𝓔 𝓣𝓞𝓖𝓔𝓣𝓗𝓔𝓡</h1>
        <h2>Click on the book to see the events of Indian-Pakistan Partition</h2>
    </header>



    <main>

    <?php $i = 1;?>

<?php echo $i++; ?>
    
    
    <div class="bookmat">
        
        <div class="book">
        <div class="front cover bookpage">
            <p class="booktitle">EVENTS OF IND-PAK PARTITION <br>&nbsp;<br><br> BY THE STORY TELLING MUSEUM</p>
        </div>      
          <?php foreach ($imageFilenames as $key => $fileName): ?>

            

                    <div class="back bookpage"> <img class="partition-image" src="images/<?php echo $fileName; ?>" alt="Image Description"  >
                    </div>
                    <div class="front bookpage">
                        <p class="pagetext"><?php echo $descriptions[$key]; ?></p>
                    </div>
                <?php endforeach; ?>


                <div class="back bookpage">
                     <br>
                     <br>
                     <br>
                <h2>Thankyou for Visiting The Story Telling Museum </h2>
                </div>
                  
        
        <div class="front lastpage bookpage">
            <footer><a target="blank" >Thankyou for visiting</a></footer>

            
    </div>
    </div>
    </div>
    </main>

    <br>
  

    <script>
window.addEventListener("DOMContentLoaded", () => {
let books = document.querySelectorAll('.book');
for (let book of books) {
	let pages = book.getElementsByClassName('bookpage');
	let size = pages.length;
	for (let i = 0, page; page = pages[i]; ++i) {
		if (i % 2 === 0) page.style.zIndex = (size - i);
	}
	book.onclick = function(e) {
		if (e.target == e.currentTarget) { // unroll book in mobile mode
			e.target.classList.toggle('unrolled');
		} else {
			e.currentTarget.classList.remove('unrolled');
			let pagearray = [...e.target.parentElement.children];
			let pagenum = pagearray.indexOf(e.target);
			e.target.classList.remove('clickable');
			if (pagenum & 1) { // odd pages (flip back)
				e.target.classList.remove('flipped');
				e.target.previousElementSibling.classList.remove('flipped');
				e.target.nextElementSibling.classList.remove('clickable');
				if (pagenum > 1) {
					e.target.previousElementSibling.classList.add('clickable');				
					e.target.previousElementSibling.previousElementSibling.classList.add('clickable');
				} else {
					e.target.parentElement.classList.remove('opened');
				}
			} else if (pagenum === (pagearray.length-1)) { // last page (close book)
				for (let i = pagenum; i >= 0; --i) {
					pagearray[i].classList.remove('flipped');
				}
				e.target.parentElement.classList.remove('opened');					
			} else { // even pages (flip forward)
				if (pagenum === 0) { // first page (open book)
					e.target.parentElement.classList.add('opened');
				} else {
					e.target.previousElementSibling.classList.remove('clickable');
				}
				e.target.classList.add('flipped');
				e.target.nextElementSibling.classList.add('flipped');
				e.target.nextElementSibling.classList.add('clickable');				
				e.target.nextElementSibling.nextElementSibling.classList.add('clickable');
			}
		}
		e.stopPropagation();
	}
}
});
</script>

  
  
  
  
  </body>
</html>

