// set up some constants for the different default images
const defaultImage1 = document.getElementById("defaultImage1");
const defaultImage2 = document.getElementById("defaultImage2");
const defaultImage3 = document.getElementById("defaultImage3");
const defaultImage4 = document.getElementById("defaultImage4");
const defaultImage5 = document.getElementById("defaultImage5");
const defaultImage6 = document.getElementById("defaultImage6");
const defaultImage7 = document.getElementById("defaultImage7");

// set up some other constants too
const mainImage = document.querySelector(".mainImage");
const changeImage = document.getElementById('changeImage')
const uploadImage = document.getElementById("uploadImage");

// displays the default images
changeImage.addEventListener("click", () => {
    // in this case the default image library is not open
    if (changeImage.classList.contains("inactive")) {
        defaultImage1.style.display = "block";
        defaultImage2.style.display = "block";
        defaultImage3.style.display = "block";
        defaultImage4.style.display = "block";
        defaultImage5.style.display = "block";
        defaultImage6.style.display = "block";
        defaultImage7.style.display = "block";
        uploadImage.style.display = "block";
        changeImage.classList.replace("inactive", "active");
        console.log(changeImage.classList); // test the state of the image librrary
    } 
    // in this case the default image library is open
    else {
        defaultImage1.style.display = "none";
        defaultImage2.style.display = "none";
        defaultImage3.style.display = "none";
        defaultImage4.style.display = "none";
        defaultImage5.style.display = "none";
        defaultImage6.style.display = "none";
        defaultImage7.style.display = "none";
        uploadImage.style.display = "none";
        changeImage.classList.replace("active", "inactive");
        console.log(changeImage.classList); // test the state of the image library
    };
});

