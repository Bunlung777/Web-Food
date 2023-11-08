// เปิด Popup Image
function mainopenPopup() {
    var popup = document.getElementById("mainopenPopup");
    popup.style.display = "block";
  }
    // ปิด Popup Image
    function mainclosePopup() {
      var popup = document.getElementById("mainopenPopup");
      popup.style.display = "none";
  }
// เปิด Popup Image
function openPopup() {
    var popup = document.getElementById("image-popup");
    popup.style.display = "block";
  }

  // ปิด Popup Image
  function closePopup() {
    var popup = document.getElementById("image-popup");
    popup.style.display = "none";
}
function openPopup1() {
    var popup = document.getElementById("image-popup1");
    popup.style.display = "block";
  }

  // ปิด Popup Image
  function closePopup1() {
    var popup = document.getElementById("image-popup1");
    popup.style.display = "none";
}
function openPopup2() {
    var popup = document.getElementById("image-popup2");
    popup.style.display = "block";
  }

  // ปิด Popup Image
  function closePopup2() {
    var popup = document.getElementById("image-popup2");
    popup.style.display = "none";
}
function openPopup3() {
    var popup = document.getElementById("image-popup3");
    popup.style.display = "block";
  }

  // ปิด Popup Image
  function closePopup3() {
    var popup = document.getElementById("image-popup3");
    popup.style.display = "none";
}


// navbar
const navLinks = document.getElementById('navLinks');
const hamburgerMenu = document.getElementById('hamburgerMenu');

hamburgerMenu.addEventListener('click', () => {
  navLinks.classList.toggle('active');
  
});