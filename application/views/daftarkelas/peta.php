<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <br>
    <br>
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <a onclick="history.back(-1)" style="color: white" class="btn btn-primary mb-3 ml-5">Kembali</a>
    <div class="card">
        <!--The div element for the map -->
        <div style="height: 400px; width: 100%;" id="map"></div>
        <script>
            // Initialize and add the map
            function initMap() {
                // The location of Uluru
                var uluru = {
                    lat: <?php echo $latitude ?>,
                    lng: <?php echo $longitude ?>
                };
                // The map, centered at Uluru
                var map = new google.maps.Map(
                    document.getElementById('map'), {
                        zoom: 10,
                        center: uluru
                    });
                // The marker, positioned at Uluru
                var marker = new google.maps.Marker({
                    position: uluru,
                    map: map
                });
            }
        </script>
        <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
        </script>

    </div>
</div><br><br><br><br><br><br><br><br><br><br><br>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!--  -->