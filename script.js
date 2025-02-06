// script.js

document.addEventListener('DOMContentLoaded', () => {
    // Get references to the elements
    
    const moon = document.getElementById("moon"); 
    const kill1 = document.getElementById("kill1");
    const kill2 = document.getElementById("kill2");
    const protect= document.getElementById("protect");
    const kill3= document.getElementById("kill3");
    const intro= document.getElementById("intro");
   const welcome= document.getElementById("welcome");
   const lt= document.getElementById("lt");
   const rt= document.getElementById("rt");
   const trtext= document.getElementById("trtext");


   // Retrieve the text from the welcome element
const text = welcome.textContent;
let index = 0; // Start at the first character
welcome.textContent = ''; // Clear the text content

function typeLetter() {
  if (index < text.length) {
    welcome.textContent += text[index]; // Add the next character
    index++; // Move to the next character
    setTimeout(typeLetter, 200); // Wait a bit before adding the next character
  }
}

// Set initial styles for opacity and transform
welcome.style.opacity = 0;
welcome.style.transform = 'translateX(-100px)';
welcome.style.transition = 'opacity 1s ease, transform 1s ease';

// Trigger the animations
setTimeout(() => {
  welcome.style.opacity = 1; // Fade in
  welcome.style.transform = 'translateX(0)'; // Slide in from the left
  typeLetter(); // Start typing effect
}, 800);
// Adjust the delay as needed





    // Add a scroll event listener
    window.addEventListener("scroll", () => {
        // Calculate the scroll value
        const value = window.scrollY;
        const stoppingPoint1 = 250;
        moon.style.top= value * 1.5+ "px";
        // Adjust the position of the left-top element (ltr)
        
        // Adjust the position of the left-middle element (lmig)
    //lmig.style.left = `calc(50% + ${value * 2.5}px)`; // Center horizontally

    // Adjust the position of the right-middle element (rmig)
   // rmig.style.right = `calc(50% + ${value * 2.5}px)`; // Center horizontally
       
        // You can also adjust the position of the right-top element (rtr) if needed
        // rtr.style.right = value * 0.9 + "px";
        kill1.style.right=value*2.2+"px"
        kill2.style.left=value*1.7+"px"
        kill3.style.left=`calc(6vw + ${value * 2.3}px)`; 
        protect.style.right=`calc(20vw + ${value * 2.5}px)`;
        lt.style.left=value*1+"px"
        rt.style.right=value*1+"px"
        // Apply the parallax effect until the stopping point
        if (value < stoppingPoint1) {
            intro.style.top = `calc(62vh + ${value * 1.5}px)`;
        
            intro.style.position = 'relative'; // Reset position to relative
        } else {
            // Once the stopping point is reached, make it stick
            intro.style.position = 'sticky';
            intro.style.top = '250vh'; // Adjust this value to match your desired position
        }
        // Adjust this value to match your desired position
        if (value < stoppingPoint2) {
          trtext.style.top = `calc(50vh + ${value * 1.5}px)`;
      
          trtext.style.position = 'relative'; // Reset position to relative
      } else {
          // Once the stopping point is reached, make it stick
          trtext.style.position = 'sticky';
          trtext.style.top = '400vh'; // Adjust this value to match your desired position
      } 
        
        
});
});
