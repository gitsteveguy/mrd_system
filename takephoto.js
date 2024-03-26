// Get references to the form and the photo-related elements
var form = document.getElementById('myForm');
var photoInput = document.getElementById('photo');
var previewImg = document.getElementById('preview');
var snapBtn = document.getElementById('snap');
var startcambtn = document.getElementById('startcam');
var imagurifd = document.getElementById('profileimageuri');
var tmagejs = document.getElementById('timage');

startcambtn.addEventListener('click', function() {
// Use getUserMedia to access the webcam stream
navigator.mediaDevices.getUserMedia({ video: true })
  .then(function(stream) {
    // Set the previewImg element's srcObject to the stream
    previewImg.srcObject = stream;
    previewImg.play();
  })
  .catch(function(error) {
    console.log(error);
  });
});

// Add an event listener to the snap button to capture a photo
snapBtn.addEventListener('click', function() {
  // Create a canvas element and draw the current previewImg frame to it
  var canvas = document.createElement('canvas');
  canvas.width = previewImg.videoWidth;
  canvas.height = previewImg.videoHeight;
  var ctx = canvas.getContext('2d');
  ctx.drawImage(previewImg, 0, 0, canvas.width, canvas.height);

  var du = canvas.toDataURL('image/jpeg', 0.8);
  tmagejs.src= du;
  var b64du = du.replace(/^data:image\/?[A-z]*;base64,/,"");
  console.log("UrI ="+ b64du);
  imagurifd.value=b64du;
});

// Add an event listener to the form to handle submission
form.addEventListener('submit', function(event) {
  // Prevent the default form submission behavior
  event.preventDefault();

  // Create a FormData object and append all the form fields
  var formData = new FormData(form);

  // Use XMLHttpRequest to send the form data to the server
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'upload.php', true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Handle the server's response here
      console.log(xhr.responseText);
    }
  };
  xhr.send(formData);
});

// Add an event listener to the photo input to update the previewImg element
photoInput.addEventListener('change', function() {
  // Create a URL for the selected photo
  var url = URL.createObjectURL(photoInput.files[0]);

  // Update the previewImg element's src attribute
  previewImg.src = url;

  // Show the previewImg element and hide the snap button
  previewImg.style.display = 'inline';
  snapBtn.style.display = 'none';
});
