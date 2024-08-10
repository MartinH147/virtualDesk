// set up some constants for the key colour elements
const lightSeaGreen = document.querySelector(".lightSeaGreen");
const pink = document.querySelector(".pink");
const middleBlue = document.querySelector(".middleBlue");
const lightGreen = document.querySelector(".lightGreen");
const mahogany = document.querySelector(".mahogany");
const lightOrange = document.querySelector(".lightOrange");
const fadedBlue = document.querySelector(".fadedBlue");
const red = document.querySelector(".red");
const gold = document.querySelector(".gold");
const orange = document.querySelector(".orange");
const purple = document.querySelector(".purple");
const lightBlue = document.querySelector(".lightBlue");

// get the root element
const root = document.querySelector(':root');

// set the key colour of the app
function setKeyColour(el) {
    // Note: there is a more effecient and dynamic way to do this, but I wanted to demonstrate multiway selection
    if (el = lightSeaGreen) {
        root.style.setProperty('--keyColour', '#037D7A');
    } else if (el = pink) {
        root.style.setProperty('--keyColour', '#F62BA2');
    } else if (el = middleBlue) {
        root.style.setProperty('--keyColour', '#00607A');
    } else if (el = lightGreen) {
        root.style.setProperty('--keyColour', '#52B788');
    } else if (el = mahogany) {
        root.style.setProperty('--keyColour', '#BC4749');
    } else if (el = lightOrange) {
        root.style.setProperty('--keyColour', '#F4A261');
    } else if (el = fadedBlue) {
        root.style.setProperty('--keyColour', '#577590');
    } else if (el = red) {
        root.style.setProperty('--keyColour', '#FF0054');
    } else if (el = gold) {
        root.style.setProperty('--keyColour', '#EEBA0B');
    } else if (el = orange) {
        root.style.setProperty('--keyColour', '#F62BA2');
    } else if (el = purple) {
        root.style.setProperty('--keyColour', '#FB5607');
    } else if (el = lightBlue) {
        root.style.setProperty('--keyColour', '#57D1C8');
    }
};

// Key Colours:
// .lightSeaGreen { background-color: #037D7A;}
// .pink { background-color: #F62BA2;}
// .middleBlue { background-color: #00607A;}
// .lightGreen { background-color: #52B788;}
// .mahogany { background-color: #BC4749;}
// .lightOrange { background-color: #F4A261;}
// .fadedBlue { background-color: #577590;}
// .red { background-color: #FF0054;}
// .gold { background-color: #EEBA0B;}
// .orange { background-color: #FB5607;}
// .purple { background-color: #7209B7;}
// .lightBlue { background-color: #57D1C8;}


// toggle visibility
function toggleVisibility(id) {
    id = id + "Visibility"
    let feature = document.querySelector(`.${id}`)
    feature.style.setProperty("opacity", "0")
}