<?php 

namespace App\Models;

use CodeIgniter\Model;

class SubscriptionModel extends Model
{
     protected $table = 'subscription';
 
    protected $allowedFields = ['id','package_month','package_year','start_date','end_date','description','customers','status'];



}



?>