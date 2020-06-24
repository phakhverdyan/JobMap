<style type="text/css">
    .modal_custom_carousel {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1050; /* Sit on top */
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        /*overflow: auto;*/
        overflow-x: hidden;
        overflow-y: auto;
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }
    .image_carousel_modal{
        height: 100%; 
        max-height: 100%;  
        max-width: 100%; 
        width: auto;
        height: auto;
        position: absolute;  
        top: 0;  
        bottom: 0;  
        left: 0;  
        right: 0;  
        margin: auto;
    }
    .carousel_block{
        position: absolute; 
        top:5%; 
        bottom: 0; 
        left: 0; 
        right: 0; 
        height: 90%; 
        width: 90%; 
        margin: 0 auto; 
        text-align: center;
    }
</style>
<!--Plan cancel modal-->
<div class="modal_custom_carousel" id="modal_bg_business_carousel">

        <div class="carousel_block">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"  style="position: absolute; top:40px; right: 40px; color:#fff; font-size: 50px; z-index: 100;">
                <span aria-hidden="true">&times;</span>
            </button>
            <!-- <img class="" src="https://wallpaper-house.com/data/out/7/wallpaper2you_153907.jpg" alt="Second slide"> -->

            <div id="carouselExampleControls2" class="carousel" data-ride="carousel" style="height: 100%;">
              <div class="carousel-inner">

                  @foreach($data->images as $image)


                      <div class="carousel-item" style="height: 90vh!important;" data-number="{{ $image->number }}">
                          <img class="image_carousel_modal" src="{!! $image->bg_picture_o !!}" alt="{{ $data->name }}">
                      </div>

                  @endforeach

              </div>
              <a class="carousel-control-prev" href="#carouselExampleControls2" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleControls2" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
        </div>
</div>
<!--/Plan cancel modal-->

<script>
    var modal = document.getElementById('myModal');
    var btn = document.getElementById("myBtn");
    if (btn) {
        btn.onclick = function() {
            modal.style.display = "block";
        }
    }
    if (modal) {
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }
</script>