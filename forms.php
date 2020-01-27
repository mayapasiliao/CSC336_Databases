<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
  <body>
    <h1>CD Rental</h1>

    <?php
      if(!@mysql_connect("134.74.112.21", "pas19f", "mayadarasofia")) {
        echo "<h2>Connection Error.</h2>";
        die();
      }

      mysql_select_db("d120");
    ?>

    <!-- ADDING PRODUCER -->
    <h2>Add producer</h2>

    <form action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="get">
      <table border="0" cellpadding="0" cellspacing="0">
        <tr><td>Name:</td> <td><input type="text" size="30" name="name"></td></tr>
        <tr><td>Address:</td> <td><input type="text" size="30" name="address"></td></tr>
        <tr><td>&nbsp;</td> <td><input type="submit" name="addProducer" value="Add Producer"></td></tr>
      </table>

      <?php
        $name = mysql_real_escape_string($_REQUEST['name']);
        $address = mysql_real_escape_string($_REQUEST['address']);

        mysql_query("INSERT INTO producers(name, address) VALUES('$name', '$address')");
      ?>
    </form>

    <!-- ADDING CD -->
    <h2>Add CD</h2>

    <form action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="get">
      <table border="0" cellpadding="0" cellspacing="0">
        <tr><td>Title:</td> <td><input type="text" size="30" name="title"></td></tr>
        <tr><td>Year:</td> <td><input type="text" size="30" name="year"></td></tr>
        <tr><td>Type:</td> <td><input type="text" size="30" name="type"></td></tr>
        <tr><td>Producer:</td> <td><input type="text" size="30" name="producer"></td></tr>
        <tr><td>&nbsp;</td> <td><input type="submit" name="addCD" value="Add CD"></td></tr>
      </table>

      <?php
        $title = mysql_real_escape_string($_REQUEST['title']);
        $year = mysql_real_escape_string($_REQUEST['year']);
        $type = mysql_real_escape_string($_REQUEST['type']);
        $producer = mysql_real_escape_string($_REQUEST['producer']);
        $var = NULL;

        mysql_query("INSERT INTO cds(title, year_of_prod, type, cd_prod) VALUES ('$title', '$year', '$type', '$producer')");
        mysql_query("INSERT INTO producers(name) VALUES('$producer')");
      ?>
    </form>

    <!-- ADDING REGULAR CUSTOMER BORROWING PARTICULAR CD -->
    <h2>Add regular customer borrowing particular CD</h2>
    <p>Make sure CD already exists.</p>

    <form action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="get">
      <table border="0" cellpadding="0" cellspacing="0">
        <tr><td>Customer SSN:</td> <td><input type="text" size="30" name="customer_ssn"></td></tr>
        <tr><td>Name:</td> <td><input type="text" size="30" name="customer_name"></td></tr>
        <tr><td>Customer Telephone Number:</td> <td><input type="text" size="30" name="customer_tel_num"></td></tr>
        <tr><td>CD Title:</td> <td><input type="text" size="30" name="cd_title"></td></tr>
        <tr><td>Rent Start Date (yyyy-mm-dd):</td> <td><input type="text" size="30" name="rent_start_date"></td></tr>
        <tr><td>Return Date (yyyy-mm-dd):</td> <td><input type="text" size="30" name="return_date"></td></tr>
        <tr><td>&nbsp;</td> <td><input type="submit" name="addCustomerRenting" value="Add Customer"></td></tr>
      </table>

      <?php
        error_reporting(E_ALL ^ E_NOTICE);

        // Assuming and CD already exists.
        $customer_ssn = mysql_real_escape_string($_REQUEST['customer_ssn']);
        $name = mysql_real_escape_string($_REQUEST['customer_name']);
        $tel_num = mysql_real_escape_string($_REQUEST['customer_tel_num']);
        $cd_title = mysql_real_escape_string($_REQUEST['cd_title']);
        $return_date = mysql_real_escape_string($_REQUEST['return_date']);
        $rent_start_date = mysql_real_escape_string($_REQUEST['rent_start_date']);

        mysql_query("INSERT INTO customers(ssn, name, tel_num, is_vip) VALUES ('$customer_ssn', '$name', '$tel_num', FALSE)");
      ?>
    </form>

    <!-- ADDING VIP MEMBER BORROWING PARTICULAR CD -->
    <h2>Add VIP member borrowing particular CD</h2>
    <p>Make sure CD already exists.</p>

    <form action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="get">
      <table border="0" cellpadding="0" cellspacing="0">
        <tr><td>Customer SSN:</td> <td><input type="text" size="30" name="customer_ssn"></td></tr>
        <tr><td>Name:</td> <td><input type="text" size="30" name="customer_name"></td></tr>
        <tr><td>Customer Telephone Number:</td> <td><input type="text" size="30" name="customer_tel_num"></td></tr>
        <tr><td>VIP Start Date:</td> <td><input type="text" size="30" name="vip_start_date"></td></tr>
        <tr><td>Discount Percent:</td> <td><input type="text" size="30" name="disc_percent"></td></tr>
        <tr><td>CD Title:</td> <td><input type="text" size="30" name="cd_title"></td></tr>
        <tr><td>Rent Start Date (yyyy-mm-dd):</td> <td><input type="text" size="30" name="rent_start_date"></td></tr>
        <tr><td>&nbsp;</td> <td><input type="submit" name="addCustomerRenting" value="Add Customer"></td></tr>
      </table>

      <?php
        // Assuming CD already exists.
        $customer_ssn = mysql_real_escape_string($_REQUEST['customer_ssn']);
        $name = mysql_real_escape_string($_REQUEST['customer_name']);
        $tel_num = mysql_real_escape_string($_REQUEST['customer_tel_num']);
        $vip_start_date = mysql_real_escape_string($_REQUEST['vip_start_date']);
        $disc_percent = mysql_real_escape_string($_REQUEST['disc_percent']);
        $cd_title = mysql_real_escape_string($_REQUEST['cd_title']);
        $rent_period = mysql_real_escape_string($_REQUEST['rent_period']);
        $rent_start_date = mysql_real_escape_string($_REQUEST['rent_start_date']);

        mysql_query("INSERT INTO customers(ssn, name, tel_num, is_vip) VALUES ('$customer_ssn', '$name', '$tel_num', TRUE)");
        mysql_query("INSERT INTO customer_rents_cd VALUES($rent_period, '$rent_start_date', '$cd_title', '$customer_ssn')");
        mysql_query("INSERT INTO vip_members VALUES ('$vip_start_date', $disc_percent, '$customer_ssn')");
      ?>
    </form>

    <!-- FIND NAMES AND TEL #S OF CUSTOMERS WHO BORROWED PARTICULAR CD SUPPOSED TO BE RETURNED ON CERTAIN DATE -->
    <h2>Find names and tel #s of customers who borrowed particular CD supposed to be returned on certain date</h2>

    <form action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="get">
      <table border="0" cellpadding="0" cellspacing="0">
        <tr><td>CD Title:</td> <td><input type="text" size="30" name="title"></td></tr>
        <tr><td>Return Date:</td> <td><input type="text" size="30" name="return_date"></td></tr>
        <tr><td>&nbsp;</td> <td><input type="submit" name="find_customer" value="Find Customer"></td></tr>
      </table>

      <?php
        $return_date = mysql_real_escape_string($_REQUEST['return_date']);
        $cd_title = mysql_real_escape_string($_REQUEST['title']);

        $result = mysql_query("SELECT name, tel_num FROM customers WHERE ssn IN
                              (SELECT customer_ssn FROM customer_rents_cd WHERE return_date = '$return_date' AND cd_title = '$cd_title')");

        $i = 0;
        while ($row = mysql_fetch_array($result)) {
          echo "<tr valign='middle'>";
          echo "<td>".$row['name']."</td>";
          echo "<td>".$row['tel_num']."</td>";
          echo "</td>";
          echo "</tr>";
          $i++;
        }
      ?>
    </form>

    <!-- FIND PRODUCER'S INFORMATION -->
    <h2>Find producer's information</h2>

    <form action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="get">
      <table border="0" cellpadding="0" cellspacing="0">
        <tr><td>Artist:</td> <td><input type="text" size="30" name="artist"></td></tr>
        <tr><td>Year:</td> <td><input type="text" size="30" name="year"></td></tr>
        <tr><td>&nbsp;</td> <td><input type="submit" name="find_producer" value="Find"></td></tr>
      </table>

      <?php
        $artist = mysql_real_escape_string($_REQUEST['artist']);
        $year = mysql_real_escape_string($_REQUEST['year']);

        $result = mysql_query("SELECT name, address FROM producers WHERE
                               name IN (SELECT cd_prod FROM cds WHERE year_of_prod = $year
                                 AND title IN (SELECT cd_title FROM songs WHERE artist = $artist)))");

        $i = 0;
        while ($row = mysql_fetch_array($result)) {
          echo "<tr valign='middle'>";
          echo "<td>".$row['name']."</td>";
          echo "<td>".$row['address']."</td>";
          echo "</td>";
          echo "</tr>";
          $i++;
        }
      ?>
    </form>
  </body>
</html>
