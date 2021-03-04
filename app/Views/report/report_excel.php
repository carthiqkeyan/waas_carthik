<!DOCTYPE html>
<html>
<head>
	<title>Report</title>
</head>
<body>
	
 <table style="width:100%"  border="1">
  <tr>
    <th>S.no</th>
    <th>Customer id</th>
    <th>Customer name</th>
    <th>Total license</th>
    <th>Balance license</th>
    <th>Branch count</th>
    <th>Sms quota count</th>
    <th>Email quota count</th>
  </tr>
  <?php 
  foreach ($arr_customer as $key=>$customer) {
    ?>
  <tr>
    <td><?= ++$key;?></td>
    <td><?= $customer['customer_id'];?></td>
    <td><?= $customer['customer_name'];?></td>
    <td><?= $customer['brand_count'];?></td>
    <td><?= $customer['brand_balance'];?></td>
    <td><?= $customer['branch_count'];?></td>
    <td><?= $customer['sms_count'];?></td>
    <td><?= $customer['email_month'];?></td>
  </tr>

  <?php
  }?>

</table>

</body>
</html>