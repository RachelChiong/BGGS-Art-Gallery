<?php
    $pagetitle = "BGGS Art Gallery";
    include "header.php";

?>
<style>

    #school-img {
        min-width: 70%;
    }
    .index_grid {
        display: grid; grid-template-columns: 50% 50%;
        background-color: #d4d6d9;
        padding-left: 5%;
        padding-right: 5%; 
    }
    
    .index_grid_item {
        min-height: 260px;
        padding: 10%;
    }

    .linkbtn {
  border: none;
  padding: 12px 12px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
  color: black; 
  border: 2px solid rgba(0,37,84,1);
}

.linkbtn:hover {
  background-color: rgba(0,37,84,1);
  color: white;
}

@media only screen and (max-width: 800px) {
        .index_grid {
            display: block;
        }
        .index_grid_item {
            display: block;
            height: auto;
        }
    }
</style>
    <main>
        <div class="wrapper-main">
        <div class="main-school" style="text-align: center;">
                <img src= "img/school.png" alt="School comission" id="school-img" style="display: hidden;">
                <div class="title_cont" style="position: relative; top: -600px;">
            <h3 class="bggs_text_b">BRISBANE GIRLS GRAMMAR SCHOOL</h3>
            <svg height="2" width="600">
             <line x1="0" y1="0" x2="600" y2="0" style="stroke:rgb(0,0,0);stroke-width:5" />
             </svg>
             <h1 style="font-size: 50px;">ART COLLECTION</h1>
            </div>
            </div>

        <div class="index_grid">
        <div class="index_grid_item" style="background-image: url('img/Walkthrough_Thumbnail.png'); background-size: cover;"></div>
            <div class="index_grid_item">
            <h2>360&deg; Virtual Art Gallery</h2>
            <p class="main-body">Explore the art gallery using the virtual art gallery system. Explore Brisbane Girls Grammar Schools art gallery using the 360&deg; art gallery function. Here, you can explore some of the fine arts Brisbane Girls Grammar has to offer and find out more about their origins and their creators.  </p>
            <br>
               <a href="walkthrough.php"><button class="linkbtn galbtn">View Gallery ></button></a> 
            </div>
            
    </div>
        
        <div class="index_grid">
            <div class="index_grid_item">
                <h2>About the School</h2>
                <p class="main-body">Since its founding, Brisbane Girls Grammar School has a long history of collecting works of art and the School currently has nearly 400 works in its collection. These works include paintings, prints, photographic works, ceramics, sculptures and antique furnishings.The collection contributes to the educational, social and cultural identity of the school.<br><br>Furthermore, the collection seeks to expose all students to the critical and ethical influence of works of art and to contribute to the cultivation of an environment of judicious, ethical and purposeful engagement by providing opportunities for discussion and deep learning.</p> 
                <br>
                <a href="loc_gal.php"><button class="linkbtn galbtn">View Locations ></button></a> 
             </div>
             <div class="index_grid_item" style="background-image: url('img/2000mosaic.jpg'); background-size: cover;"></div>
            
        </div>
    </div>
            <br>
             <h2 style="padding: 20px">Brisbane Girls Grammar Schools Artwork of the week and work from alumni of the school</h2>
             <div class="slideshow-container gradient" style="min-height: 500px; overflow: hidden;">
                    <div class="mySlides fade">
                        <div class="numbertext">1 / 3</div>
                            <img src="img/thesource.jpg" style="width:100%">
                            <div class="text" style="width: 100%;">
                            <h2 style="font-size: 80px; color: white;">Featured</h2>        
                            <b style="font-size: 30px;"><i>'The Source'</i> by Nan Dingle</b></div>
                    </div>
                    <div class="mySlides fade">
                        <div class="numbertext">2 / 3</div>
                            <img src="img/2000mosaic.jpg" width="100%" >
                            <div class="text" style="width: 100%;">
                            <h2 style="font-size: 80px; color: white;">Featured</h2>        
                            <b style="font-size: 30px;"><i>'Mosaic donated by the class of 2000'</i></b></div>
                           
                    </div>
                    <div class="mySlides fade">
                        <div class="numbertext" style= "color:#000000;">3 / 3</div>
                            <img src="img/wide.png" style="width:100%">
                            <div class="text" style="width: 100%;">
                        <h2 style="font-size: 80px; color: white;">Featured</h2>        
                        <b style="font-size: 30px;"><i>'Morning Walk Bundanon Trust 2015</i> by Kylie Elkington'</b></div>
                    </div>
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>

                </div>
                <br>
                <div style="text-align:center">
                    <span class="dot" onclick="currentSlide(1)"></span> 
                    <span class="dot" onclick="currentSlide(2)"></span> 
                    <span class="dot" onclick="currentSlide(3)"></span> 
                </div>
                
         <script src="scripts/ind_script.js"></script>
        </div>       
    </main>

<?php
    include "footer.php";
?>