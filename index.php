<?
require_once("config.php");
$current_table = (isset($_GET['table'])?$_GET['table']:1);
$mysqli = new mysqli($_DB_HOST, $_DB_USER, $_DB_PASS, $_DB_DATABASE);
if ($mysqli->connect_errno) {die("Conection to the database failed!");}


if($_POST['order'])
{
  $query = $mysqli->query("update Orders set quantity=quantity+1 where id_dish=".$_POST['order']." and id_table=".$current_table);
  if(!mysqli_affected_rows($mysqli))
  {
    
    $query = $mysqli->query("insert into Orders(id_dish,id_table,quantity) values (".$_POST['order'].", ".$current_table.",1)");
  } 
}

if($_POST['finish'])
{
  $query = $mysqli->query("delete from Orders where id_table=".$current_table);
}


?>
<!doctype html><html itemscope="" itemtype="http://schema.org/WebPage" lang="en">
<head>
<meta charset="utf-8" />    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link href="http://getbootstrap.com/examples/justified-nav/justified-nav.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
</head>
<body>
<div class="container">


  <!-- Navigation -->
  <div class="masthead">
    <h3 class="text-muted">Hello Restaurant!</h3>
    <nav>
      <ul class="nav nav-justified">

<?
$tables = $mysqli->query("select * from Tables");
while($table = $tables->fetch_assoc())
{
  if($current_table==$table["id"])
    echo "<li class='active'><a href='#'>".$table["number"]."</a></li>";
  else 
    echo "<li><a href='index.php?table=".$table["id"]."'>".$table["number"]."</a></li>";  
}
?>




      </ul>
    </nav>
  </div>
<form method="POST">
  <!-- Orders -->
  <div class="jumbotron">
    <div class="list-group">
      <div class="list-group-item active">
        Orders
      </div>
      <? 
      $query = $mysqli->query("select quantity, name as dish_name from Orders,Dishes where Orders.id_dish=Dishes.id and Orders.id_table=".$current_table);
      if($query->num_rows===0)
      {?>
        <div class="list-group-item">No orders for this table yet</div>
      <?}
      else
      {
        while($order = $query->fetch_assoc())
        {
      ?>
        <div class="list-group-item"><? echo $order["dish_name"] ?> x<? echo $order["quantity"] ?></div>
      <? 
        }
      }
      ?>
    </div>
    <?
      if($query->num_rows)
      {
      ?>  
        <p> <button type="submit" class="btn btn-success" name="finish" value="1">Finish order</button></p>        
      <?  
      }
    ?>                
  </div>

  <!-- Dishes -->
<?
  $query = $mysqli->query("select * from Dishes");
  $processed = 0;
  while($processed < $query->num_rows)
  {
?>
  <div class="row">

   <? 
   $dish = $query->fetch_assoc();
   ?>
    <div class="col-md-4">
      <div class="thumbnail">
        <img src="img/<? echo $dish["image"] ?>" alt="<? echo $dish["name"] ?>">
        <div class="caption text-center">
          <h3><? echo $dish["name"] ?></h3>
          <p><? echo $dish["description"] ?></p>
          <p> <button type="submit" class="btn btn-primary" name="order" value="<? echo $dish["id"] ?>">Order</button></p>
        </div>
      </div>
    </div>
    <?
    $processed++;
    if($processed<$query->num_rows)
    {
      $dish = $query->fetch_assoc();
    ?>
    <div class="col-md-4">
      <div class="thumbnail">
        <img src="img/<? echo $dish["image"] ?>" alt="<? echo $dish["name"] ?>">
        <div class="caption text-center">
          <h3><? echo $dish["name"] ?></h3>
          <p><? echo $dish["description"] ?></p>
          <p> <button type="submit" class="btn btn-primary" name="order" value="<? echo $dish["id"] ?>">Order</button></p>
        </div>
      </div>
    </div>
  
    <?
    }
    $processed++;
    if($processed<$query->num_rows)
    {
      $dish = $query->fetch_assoc();
    ?>
    <div class="col-md-4">
      <div class="thumbnail">
        <img src="img/<? echo $dish["image"] ?>" alt="<? echo $dish["name"] ?>">
        <div class="caption text-center">
          <h3><? echo $dish["name"] ?></h3>
          <p><? echo $dish["description"] ?></p>
          <p> <button type="submit" class="btn btn-primary" name="order" value="<? echo $dish["id"] ?>">Order</button></p>
        </div>
      </div>
    </div>
    <?
    }
    $processed++;
    ?>

  </div>
<? } ?>
</form>
</div>
<script src="https://code.jquery.com/jquery-1.11.3.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="js/main.js"></script>
</body>




