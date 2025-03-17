<?php

session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $restname = htmlspecialchars($_POST['restname']);
    $city = htmlspecialchars($_POST['city']);
    $rate = intval($_POST['rate']);
    $subject = htmlspecialchars($_POST['subject']);

    $stmt = $conn->prepare("INSERT INTO reviews (name, restname, city, rate, subject) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssds", $name, $restname, $city, $rate, $subject);

        if ($stmt->execute()) {
      $message = "Review submitted successfully!";
        } else {
         $message = "Error: " . $stmt->error;
        }
$stmt->close();

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Review</title>
    <link rel="stylesheet" href="reviewcss.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <h2>Restaurant Review</h2>
    <div class="forms">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="text" id="name" name="name" placeholder="Your Name..." required>
            <br>
            <input type="text" id="restname" name="restname" placeholder="The Name of the Restaurant..." required>
            <br>
            <input type="text" id="city" name="city" placeholder="Write here the City..." required>
            <br>
            <select id="rate" name="rate"> 
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <textarea id="subject" name="subject" placeholder="Write your review here..." style="height: 150px;" required></textarea>
            <br>
            <input type="submit" value="Submit">
        </form>
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
    </div>
    <footer>
        <div class="social-icons">
            <i class="fa fa-instagram"></i>
            <i class="fa fa-facebook"></i>
            <i class="fa fa-twitter"></i>
        </div>
        <div class="home-icon">
            <a class="nav" href="interfata.php"><i class="fa fa-home"></i></a>
        </div>
        <div id="map"></div>
    </footer>

    <script>
        let map;

        function initMap() {
            const center = { lat: 45.7489, lng: 21.2087 };
            map = new google.maps.Map(document.getElementById('map'), {
                center: center,
                zoom: 15
            });
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const userLocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        map.setCenter(userLocation);
                        searchNearbyRestaurants(userLocation);
                    },
                    () => {
                        console.log('Geolocation failed. Using default center.');
                        searchNearbyRestaurants(center);
                    }
                );
            } else {
                console.log('Geolocation is not supported. Using default center.');
                searchNearbyRestaurants(center);
            }
        }

        function searchNearbyRestaurants(location) {
            const service = new google.maps.places.PlacesService(map);

            const request = {
                location: location,
                radius: '1500',
                type: ['restaurant']
            };

            service.nearbySearch(request, (results, status) => {
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    results.forEach(place => {
                        createMarker(place);
                    });
                }
            });
        }

        function createMarker(place) {
            const marker = new google.maps.Marker({
                position: place.geometry.location,
                title: place.name,
                map: map
            });

            const infowindow = new google.maps.InfoWindow({
                content: `<strong>${place.name}</strong><br>${place.vicinity}`
            });

            marker.addListener('click', () => {
                infowindow.open(map, marker);
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCji80q3BHjR10wgIE6YSeTtNuS5RhgHiM&libraries=places&callback=initMap"></script>
</body>
</html>
