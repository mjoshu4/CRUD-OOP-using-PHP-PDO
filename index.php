<?php include 'nav.php'; ?>

<?php

function __autoload($class){
  require_once "classes/$class.php";
}


?>




<br>



<div class="container">


<?php 

if(isset($_POST['add'])){

  $data = htmlspecialchars($_POST['data']);
  $data1 = htmlspecialchars($_POST['data1']);

  $user = new user();
  $user->insert($data,$data1);
  header('Location: index.php');

}

if(isset($_GET['delete'])){

  $id = $_GET['delete'];

  $user = new user();
  $user->delete($id);
  header('Location: index.php');

}


if(isset($_POST['edit'])){

$id = htmlspecialchars($_POST['id']);
$data = htmlspecialchars($_POST['data']);
$data1 = htmlspecialchars($_POST['data1']);

$user = new user();
$user->edit($id,$data,$data1);
header('Location: index.php');


}


?>




<div class="row">
  <div class="col-sm-6">
   
      <form method="post">
      <label>Data</label>
      <input type="text" name="data" class="form-control" placeholder="Data"><br>
      <label>Data1</label>
      <input type="text" name="data1" class="form-control" placeholder="Data 1"><br>
      <input type="submit" value="ADD" name="add" class="btn btn-primary"/>
    </form>
   
  </div>
</div>





<br>
  <table class="table table-bordered">
  <thead>
    <tr>
      <th>Data</th>
      <th>Data1</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>


<?php

$user = new user();
$rows = $user->select();

if($rows){
foreach ($rows as $row) {
?>


    <tr>
      <td><?php echo $row["data"]; ?></td>
      <td><?php echo $row["data1"]; ?></td>
      <td>
        <button class="btn btn-success" data-toggle="modal" data-target="#view<?php echo $row['id']; ?>">View</button>
        <button class="btn btn-primary" data-toggle="modal" data-target="#edit<?php echo $row['id']; ?>">Edit</button>
        <a style="text-decoration: none;color:white;" href="index.php?delete=<?php echo $row['id']; ?>"><button class="btn btn-danger">Delete</button></a>
      </td>
    </tr>

<!-- The Modal -->
<div class="modal fade" id="view<?php echo $row['id']; ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">View bars!</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        

        <?php

    
          $view = $user->viewone($row['id']);
          echo "<b>Data:</b> ".$view['data'];
          echo "<br>";
          echo "<b>Data1:</b> ".$view['data1'];

        ?>




      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>








<!-- The Modal -->
<div class="modal fade" id="edit<?php echo $row['id']; ?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>


    <form method="POST"> 
      <!-- Modal body -->
      <div class="modal-body">
       <input type="hidden"  name="id" value="<?php echo $row['id']; ?>" />
        <label>Data</label>
        <input type="text" class="form-control" name="data" value="<?php echo $row['data']; ?>" />
        <label>Data1</label>
        <input type="text" class="form-control" name="data1" value="<?php echo $row['data1']; ?>" />

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="edit">Submit</button>
      </div>
    </form>


    </div>
  </div>
</div>












<?php }} else { echo "No data available!"; }  ?>




  </tbody>
</table>
 </div>






<?php include 'footer.php'; ?>
