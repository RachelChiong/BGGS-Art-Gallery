/* Locations Page Javascript */
let c_cont = document.getElementById("c_cont");
let g_cont = document.getElementById("g_cont");
let m_cont = document.getElementById("m_cont");
let featured_loc = document.getElementById("featured_loc");


/* When the building is clicked, the corresponding functions will be runned. Each one will display its corresponding artworks and hide everything else in the same container. */
function cblock_f() {
    document.getElementById("loc_block_name").innerText = "Communications Centre"; 
    c_cont.style.display = "block"; 
    document.getElementById("loc_home").style.display = "none";
    featured_loc.style.display = "block";
    if (g_cont.style.display == "block") {
        g_cont.style.display = "none";
    };
    if (m_cont.style.display == "block"){
        m_cont.style.display = "none";
    };

    
};

function mblock_f() {
    /// Change the title of the section to alert users of which building they have clicked on. 
    document.getElementById("loc_block_name").innerText = 'Main Building';
    /// Display the artworks in m-block using css
  m_cont.style.display = "block"; 
  featured_loc.style.display = "block";
  /// Hide everything else (all the artworks in other buildings and the landing text)
  document.getElementById("loc_home").style.display = "none"; 
  /// DEVELOPER NOTE: Instead of testing each building individually, the containers can all be assigned a class. Then use a boolean to test whether the id of each element in that class is displayed or hidden and toggled accordingly.
    if (g_cont.style.display == "block") {
        g_cont.style.display = "none";
    };
    if (c_cont.style.display == "block"){
        c_cont.style.display = "none";
    };

};

function gblock_f() {
    document.getElementById("loc_block_name").innerText = "Gehrmann Block"; 
    g_cont.style.display = "block"; 
    document.getElementById("loc_home").style.display = "none";
    featured_loc.style.display = "block";
    if (m_cont.style.display == "block") {
        m_cont.style.display = "none";
    };
    if (c_cont.style.display == "block"){
        c_cont.style.display = "none";
    };

};