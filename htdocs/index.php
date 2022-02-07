<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSS -->
  <link rel="stylesheet" href="style.css">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">

  <title>Calendar</title>
</head>

<body>
  <?php
  // Login
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "test";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully";

  // Constructor class
  class Event
  {
    public function __construct(string $date, string $time, string $city, string $country, string $sport, string $homeTeam, string $awayTeam)
    {
      $this->date = $date;
      $this->time = $time;
      $this->city = $city;
      $this->country = $country;
      $this->sport = $sport;
      $this->homeTeam = $homeTeam;
      $this->awayTeam = $awayTeam;
    }
  }

  // SQL query retrieving one of each date with an event
  $sql = "SELECT DISTINCT date FROM times";
  $result = $conn->query($sql);

  // Saves retrieved dates in an array
  $dateList = array();
  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $dateList[] = $row["date"];
    }
  } else {
    echo "0 results";
  }

  // SQL query retrieving one of each sport name
  $sql = "SELECT DISTINCT sport FROM events";
  $result = $conn->query($sql);

  // Saves retrieved sports in an array 
  $sportList = array();
  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $sportList[] = $row["sport"];
    }
  } else {
    echo "0 results";
  }

  // SQL query retrieving all of the presentable data 
  $sql = "SELECT times.date, times.time, events.city, events.country, events.sport, events.teamHome, events.teamAway FROM events, times WHERE events._idTime = times.idTime";
  $result = $conn->query($sql);

  // Saves retrieved data as an array of objects of class Event
  $events = array();
  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $events[] = new Event($row["date"], $row["time"], $row["city"], $row["country"], $row["sport"], $row["teamHome"], $row["teamAway"]);
    }
  } else {
    echo "0 results";
  }

  // Checks for selected events
  if (isset($_POST['event'])) {
    displayEvents($events, $_POST['event'], date('Y-m'));
  }
  // Checks for empty dates
  if (isset($_POST['empty'])) {
    echo '<h1>' . 'No events on this day.' . '</h1>';
  }
  // Is called by the dropdown meny button 
  if (isset($_POST['Sports'])) {
    echo '<h1>Sorry about this, I am not sure why but the echoed text seems to be stuck here and can not even be affected by the CSS.</h1>';

    // Loops through and prints out events based on selected dropdown option
    $n = 0;
    while ($n < count($events)) {
      if ($events[$n]->sport == $_POST['Sports']) {
        echo '<br><br><h1>' . $events[$n]->sport . '</h1>';
        echo '<h2>' . $events[$n]->time . ' ' . $events[$n]->date . '</h2>';
        echo '<h2>' . $events[$n]->city . '</h2>';
        echo '<h3>' . $events[$n]->country . '</h3>';
        echo '<h1>' . $events[$n]->homeTeam . ' Versus ' . $events[$n]->awayTeam . '</h1><br><br>';
      }
      $n++;
    }
  }
  $conn->close();
  ?>

  <!-- HTML layout -->
  <div class="container">
    <div class="calendar">
      <div class="month">
        <i class="bi bi-chevron-left prev"></i>
        <div class="date">
          <h1 class="date"></h1>
          <p></p>
        </div>
        <i class="bi bi-chevron-right next"></i>
      </div>
      <div class="weekdays">
        <div>Mon</div>
        <div>Tue</div>
        <div>Wed</div>
        <div>Thu</div>
        <div>Fri</div>
        <div>Sat</div>
        <div>Sun</div>
      </div>
      <form class="days" method="post">
      </form>
    </div>
    <div class="data">
      <?php

      // Function called by the buttons to display the events
      function displayEvents($events, $day, $date)
      {
        echo '<h1>Sorry about this, I am not sure why but the echoed text seems to be stuck here and can not even be affected by the CSS.</h1>';

        // Loops through and prints out events based on selected date
        $z = 0;
        while ($z < count($events)) {
          if ($events[$z]->date == $date . '-' . str_pad($day, 2, "0", STR_PAD_LEFT)) {
            echo '<br><br><h1>' . $events[$z]->sport . '</h1>';
            echo '<h2>' . $events[$z]->time . ' ' . $events[$z]->date . '</h2>';
            echo '<h2>' . $events[$z]->city . '</h2>';
            echo '<h3>' . $events[$z]->country . '</h3>';
            echo '<h1>' . $events[$z]->homeTeam . ' Versus ' . $events[$z]->awayTeam . '</h1><br><br>';
          }
          $z++;
        }
      } ?>
    </div>

    <!-- Dropdown form -->
    <form class="select" method="POST">
      <select name="Sports" id="sports">
        <?php

        // Creates the dropdown list
        $w = 0;
        while ($w < count($sportList)) {
          echo '<option value="' . $sportList[$w] . '">' . $sportList[$w] . '</option>';
          $w++;
          }
          ?>
          <input type="submit" value="Filter Sport"/>
        </form>
      </div>
    </div>
  </div>

  <!-- JavaScript -->

  <!-- Sending retrieved dates to javascript -->
  <script>
    const dates = <?php echo json_encode($dateList); ?>;
  </script>

  <script src="script.js"></script>

</body>

</html>