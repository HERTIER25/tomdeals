
<?php
$output="";
$path='./mediaFiles';
include './database/connection.php';

if (!empty($_POST['search_data']))
{
    $search=mysqli_real_escape_string($conn,$_POST['search_data']);
    $search_sql= mysqli_query($conn,"SELECT * FROM item
WHERE item_type like '%$search%' OR province like '%$search%'
OR  district like '%$search%' OR sector like '%$search%'
OR amount like '%$search%' OR currency like '%$search%'
OR  short_description  like '%$search%'OR  
long_description  like '%$search%'");

    $rum_row=mysqli_num_rows($search_sql);
    if ($rum_row>0)
    {
        while ($row=mysqli_fetch_assoc($search_sql))
        {
            $output.='<div class="card col-md-4">
      
      <img src="./mediaFiles/'.$row['item_picture'].'">
     <div class="card-body">
      <span class="card-text">Item type:
        '.$row['item_type'].'
       </span>
       <br>
        <span class="card-text">Description:
        '.$row['short_description'].'
       </span>
       <br>
       <span class="card-text">Size:
       '.$row['long_description'].'
       </span>
        <br>
        <span class="card-text">Price: '.$row['amount'].'
        '.$row['currency'].'</span>
     </div>
    </div>';
        }
        echo $output;
    }
    else
    {
        echo "No data has found";
    }
}
?>