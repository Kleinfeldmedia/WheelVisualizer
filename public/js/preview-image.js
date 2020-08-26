
// Get the modal
var modal = document.getElementById("preview-modal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("preview-image");
var modalImg = document.getElementById("preview-modal-img");
var captionText = document.getElementById("preview-caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("preview-close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
} 
