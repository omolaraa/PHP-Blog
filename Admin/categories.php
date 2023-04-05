<?php 

include 'components/admin_header.php';

$sql = 'SELECT * FROM categories';
$select_categories = mysqli_query($conn, $sql);
$categories = mysqli_fetch_all($select_categories, MYSQLI_ASSOC);

if (isset($_POST['submit'])){
    $cat_title = filter_input(INPUT_POST, 'cat_title', FILTER_SANITIZE_SPECIAL_CHARS);

    if($cat_title =="" || empty($cat_title)){
        $titleErr = 'Title is required';
    }else{
        $query = "INSERT INTO categories (category_title) VALUES ('$cat_title')";
        $create_category_query = mysqli_query($conn, $query);

        if(!$create_category_query) {
            die('Query failed' .mysqli_error($conn));
        }
    }

}

if (isset($_GET['delete'])){
    $get_cat_id = $_GET['delete'];

    $query = "DELETE FROM categories WHERE category_id = {$get_cat_id} ";
    $delete_query = mysqli_query($conn, $query);


}
 ?>

<div class="container-fluid">
  <div class="row">
   
  <?php include 'components/admin_nav.php'; ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class=" align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
      </div>
    <div class="row">
    <div class="col">

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <label for="cat_title">Add Catergory</label>  
            <div class="form-group">
                <input type="text" name="cat_title" class="form-control <?php echo $titleErr? 'is-invalid' : null; ?>">
                <div class="invalid-feedback">
               <?php echo $titleErr; ?>
        </div>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary" value="Add Category">
            </div>
        </form>
     </div>
     <div class="col">
               
       <table class="table table-bordered table-hover">
        <thread>
            <tr>
                <th>Id</th>
                <th>Category Title</th>
            </tr>
        </thread>
        <tbody>
        <?php 
        
        foreach ($categories as $category) :?>
            <tr>
                <td><?php echo $category['category_id']; ?></td>
                <td><?php echo $category['category_title']; ?></td>
               <?php echo "<td><a href='categories.php?delete={$category['category_id']}'>Delete</a></td>"; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
       </table>
     </div>
    </div>
    
    </main>
  </div>
</div>


<?php include 'components/admin_footer.php'; ?>

 