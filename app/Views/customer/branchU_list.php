 <table id="role_datatable_B" name="role_datatable_B" class="table table-bordered table-striped">
 <thead>
      <tr>
          <th>S.No</th>
          <th>Branch User Name</th>
          <th>Contact Email</th>
          <th>Status</th>
          <th>Action</th>
      </tr>
  </thead>
  <tbody>
  <?php
  if (is_array($user_list) && count($user_list) != 0) {
  foreach ($user_list as $key=>$Buser) {
  ?>
     <tr>
        <td><?= ++$key;?></td>
        <td><?= $Buser['name'];?></td>
        <td><?= $Buser['email'];?></td>
        <td><?= ($Buser['status']==1)?"Active":"Inactive";?></td>
        <td style="position: relative;">    
        <div class="dropdown">
            <a href="javascript:void(0)" class="services dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <i class="fa fa-ellipsis-v" data-toggle="dropdown" aria-hidden="true"></i>
           </a>
            <ul class="dropdown-menu" role="menu">
              <li class="dropdown-item"><a onclick="get_Branchuser(<?= $Buser['id'];?>)" >Edit</a></li> 
  
              <li class="dropdown-item"><a href="#"onclick="delete_branch_User('<?= $Buser['id']; ?>');">Delete</a></li>

            </ul>
        </div>                                    
         </td>
    </tr>
<?php
    }
}
else
{ ?>

     <tr>
      <td colspan="5"><?php echo 'No data available in table'; ?></td>
     </tr>
  

<?php }
?>
</tbody>
</table>

<script type="text/javascript">
  $(document).ready(function() {
        $(".dropdown-toggle").dropdown();
    });

</script>