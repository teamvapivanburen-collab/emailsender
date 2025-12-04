<?php include "db.php"; ?>

<!DOCTYPE html>
<html>
<head>
<style>
body{ font-family: Arial; background:#f4f4f4; padding:30px; }
.table-container{ max-width:900px; margin:auto; background:#fff; padding:20px; border-radius:10px; box-shadow:0 0 15px rgba(0,0,0,0.1); }
table{ width:100%; border-collapse:collapse; margin-top:15px; }
th,td{ padding:12px; border-bottom:1px solid #ddd; text-align:left; }
th{ background:#007bff; color:#fff; }
td a{ padding:8px 12px; background:#28a745; color:#fff; border-radius:6px; text-decoration:none; }
td a:hover{ opacity:0.85; }
</style>
</head>
<body>

<div class="table-container">
<h2>📦 Products List</h2>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Category</th>
    <th>Details</th>
</tr>

<?php
$sql = "SELECT * FROM products ORDER BY product_id DESC LIMIT 5";
$result = $conn->query($sql);

if(!$result){
    die("SQL Error: " . $conn->error);
}

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "<tr>
                <td>".$row['product_id']."</td>
                <td>".$row['name']."</td>
                <td>".$row['category']."</td>
                <td><a href='zoho.php?id=".$row['product_id']."'>View Details ➜</a></td>
              </tr>";
    }
}else{
    echo "<tr><td colspan='4'>No products found</td></tr>";
}
?>

</table>
</div>

</body>
</html>
