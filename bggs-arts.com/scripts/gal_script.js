/* Gallery Search Javascript */
   /* jQuery Script: */
    $(document).ready(function(){

        $("#myInput").on("keyup", function() {

          var value = $(this).val().toLowerCase();
          $("#gal_table tr").filter(function() {

            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });
      });

   

    /* Javascript for the dropdown list */
    $(document).click(function () {
        $(".dropdown-list").fadeOut();
        $(".material-input input").each(function () {
          if ($(this).val() === "") {
            $(this).removeClass("focus");
            $(this).siblings(".main-input").removeClass("focus");
            $(this).next(".placeholder").removeClass("focus");
          }
        });
      });

      /*MATERIAL INPUT*/
      $(".material-input").on("click", function (e) {
        $(this).find(".placeholder, input, .main-input").addClass("focus");
        e.stopPropagation();
      });

      /*MATERIAL SELECT*/
      $(".material-select").on("click", function (e) {
        $(".material-select").not(this).find(".dropdown-list").fadeOut();
        $(this).find(".dropdown-list").fadeToggle();
        e.stopPropagation();
      });

      $(".material-select .option").on("click", function (e) {
        var option = $(this).text();
        $(this).addClass("active").siblings().removeClass("active");
        $(this).parents(".material-select").find("input").val(option);

        $(".option").on("click", function() {
          var value = $(this).val().toLowerCase();
          $("#gal_table building").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });
        
        $(this).parents(".material-select").find(".main-input").text(option);
        $(".dropdown-list").fadeOut();
        e.stopPropagation();
      });