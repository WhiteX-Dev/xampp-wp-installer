// Functionality in external file

document.addEventListener("DOMContentLoaded", function (event) {
  // Your code to run since DOM is loaded and ready

  // Form validation
  document.getElementById("submitbtn").disabled = true;
  document.getElementById("name").addEventListener("input", function (e) {
    let pattern = /^[a-z-_0-9]{1,30}$/;
    let currentValue = e.target.value;
    let valid = pattern.test(currentValue);

    if (valid) {
      document.getElementById("invalidformat").style.display = "none";
      document.getElementById("submitbtn").disabled = false;
    } else {
      document.getElementById("invalidformat").style.display = "block";
      document.getElementById("submitbtn").disabled = true;
    }

    if (document.getElementById("name").value.length == 0) {
      document.getElementById("invalidformat").style.display = "none";
      document.getElementById("submitbtn").disabled = true;
    }
  });

  // AJAX request - Installing WP
  document
    .getElementById("ajaxPostForm")
    .addEventListener("submit", function (e) {
      e.preventDefault();

      const name = document.getElementById("name").value;
      const params = "name=" + name;

      const xhr = new XMLHttpRequest();
      xhr.open("POST", "process.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

      xhr.onload = function () {
        //if (this.status === 200) {
        //console.log(this.responseText);
        if (this.readyState === 4) {
          //Final feedback from process.php
          clearInterval(processing);
          document.getElementById("feedback").innerHTML = xhr.responseText;
        }
      };

      xhr.send(params);

      //give the user feedback
      document.getElementById("name").value = "";
      //document.getElementById("feedback").innerHTML = "Processing...";

      //Loading animation
      let dotsCount = 0;
      processing = setInterval(function () {
        dotsCount++;
        document.getElementById("feedback").innerHTML =
          "Processing." + new Array(dotsCount % 10).join(".");
      }, 1000);
    });
});
