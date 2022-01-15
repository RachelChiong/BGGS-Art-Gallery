<?php
    $pagetitle = "360&deg; Gallery";
    include "header.php";
?>
<script>
function closeModal() {
    document.getElementbyID("wtModal").style.display = "hidden";
}
</script>
<style>
    .wt_background {
        background-color: rgba(0,0,0,0.7);
        position: fixed;
        width: 100%;
        height: 120%;
        text-align: center;
        overflow: auto;
        display: block;
    }

    .wt_container {
        margin-left: 30%;
        margin-right: 30%;
        margin-top: 15%;
        z-index: 3;
        background-color: white;
    }

    .wt_container span {
        font-size: 50px;
    }

    .modalInstructions li {
        list-style-type: square;
    }
    .modalInstructions {
        padding: 0 10%;
        text-align: left;
        font-size: 18px;
        z-index: 3;
    }

    #instructBtn {
        position: absolute;
        top: 13.5%;
        left: 0;
        background-color: black;
        color: white;
        font-size: 20px;
        padding: 10px;
    }

    .instruction_grid img {
        max-width: 100px;
        width: 40%;
    }

    .instruction_grid {
        display: grid;
        grid-template-columns: 50% 50%;
        width: 80%;
    }

    .instruction_text {
        margin-top: 5%;
    }

    header {
        position: relative;
    }
    @media only screen and (max-width: 800px) {
        .wt_container {
            margin-top: 30%;
        }
    }
</style>
<div class="wt_background" id="wtModal">
    <div class="wt_container">
        <div style="text-align: right; padding: 8px 15px; ">
            <span id='close' onclick='this.parentNode.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode.parentNode); return false'>&times;</span>
        </div>

        <h1>Viewing Intructions</h1>
        <div class="instruction_grid">
            <div><img src="img/click_pin.png" alt=""></div><div class="instruction_text">Click/press and hold to explore the 360&deg; gallery</div>
            <div><img src="img/plus_pin.png" alt="" style="max-width: 105px"></div><div class="instruction_text">Click to view more details about the artwork</div>
            <div><img src="img/arrow_pin.png" alt=""></div><div class="instruction_text">Click to explore more areas</div>
        </div>
    </div>
</div>
<div style="height: 100px"></div>
<div>
   <!-- <iframe src="https://artgallery360.h5p.com/content/1291228235347855069/embed" width="100%" height="100%" frameborder="0" allowfullscreen="allowfullscreen" allow="geolocation *; microphone *; camera *; midi *; encrypted-media *" style="margin-top: 100px;"></iframe>-->
    <iframe src="https://artgallery360.h5p.com/content/1291228235347855069/embed" width="1088" height="637" frameborder="0" allowfullscreen="allowfullscreen" allow="geolocation *; microphone *; camera *; midi *; encrypted-media *" title="360˚ Art Gallery"></iframe><script src="https://artgallery360.h5p.com/js/h5p-resizer.js" charset="UTF-8"></script>
</div>


<script>
    let wtModal = document.getElementbyID("wtModal");
    let span = document.getElementsByClassName("close")[0];

    span.onclick = function(){
        wtModal.style.display = "none";
    }
</script>



<?php
    include "footer.php";
?>