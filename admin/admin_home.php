<?php 
  include('../admin/admin_header.php'); 

  if (!isAdmin()) {
    header('location: ../sign_in.php');
  };
  
  $sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'date';

    //Determine the sorting order
    switch($sort) {
        case 'name':
            $order_by = 'name ASC';
            break;
        case 'email':
            $order_by = 'email ASC';
            break;
        case 'date':
            $order_by = 'created_date ASC';
            break;
        default:
            $order_by = 'created_date ASC';
            $sort = 'date';
            break;
    }
?>

<head>
  <link rel="stylesheet" href="../style.css?v=<?php echo time(); ?>" type="text/css">
</head>

<body>
  <div class="top_content">
    <div class="admin_title">
      <img src="../images/admin_header.jpg"><h2>Welcome, Admin</h2>
    </div>
  </div>
    <br><br><br>
  <div class="user_enquiries">
    <div class="title">
      <h2>Enquiries</h2>
    </div>

    <table class="enquiries_table" cellpadding="5" cellspacing="0">
      <!-- Enquiries list table header -->
      <tr>
        <th style="text-align:left;" width="10%"><a href="admin_home.php?sort=name">Name</a></th>
        <th style="text-align:left;" width="15%"><a href="admin_home.php?sort=email">Email</a></th>
        <th style="text-align:left;" width="13%">Contact Number</th>
        <th style="text-align:left;" width="10%">Subject</th>
        <th style="text-align:left;" width="20%">Message</th>
        <th style="text-align:center;" width="15%"><a href="admin_home.php?sort=date">Created date</a></th>
      </tr>
      <?php
        $query  = "SELECT * FROM contacts ORDER BY $order_by";
        $result = mysqli_query($db,$query);
        $num    = mysqli_num_rows($result);

        if ($num > 0) {
          while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      ?>
      <tr>
        <td style="text-align:left"><?php echo $row['name']; ?></td>
        <td style="text-align:left"><?php echo $row['email']; ?></td>
        <td style="text-align:left"><?php echo $row['contact_number']; ?></td>
        <td style="text-align:left"><?php echo $row['subject']; ?></td>
        <td style="text-align:left"><?php echo $row['message']; ?></td>
        <td style="text-align:center"><?php echo $row['created_date']; ?></td>
      </tr>
      <?php 
          } 
          mysqli_free_result($result);
        } else {
          echo '<p class="error">There are no enquiries.</p>';
        }
      ?>
    </table>
  </div>
</body>