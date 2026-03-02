<?php 
include 'server.php';
if (!isset($_COOKIE['Username'])) {
    header("Location: login.php");
}

$update = false;
$row = null;

if(isset($_GET['edit'])){
    $update = true;
    $id = $_GET['edit'];
    $edit_result = mysqli_query($db, "SELECT * FROM deym WHERE ID=$id");
    $row = mysqli_fetch_array($edit_result);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HOME</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <br>
    <form action="server.php" method="POST">
        <div class="container">
            <label>Username:</label>
            <label class="text-primary"><?php echo $_COOKIE['Username']; ?></label>
            <input type="submit" name="Logout" class="btn btn-outline-danger" value="Logout">
        </div>
    </form>
    <br>

    <?php if($update && $row): ?>
    <form action="server.php" method="POST">
        <div class="form-group container">
            <input type="hidden" name="ID" value="<?php echo $row['ID']; ?>">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo $row['Username']; ?>">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $row['Name']; ?>">
            <div class="form-group d-flex justify-content-end mt-2">
                <button type="submit" name="cancel-edit" class="btn btn-primary">Cancel</button>
                <button type="submit" name="update" class="btn btn-success">Update</button>
            </div>
        </div>
    </form>
    <?php endif; ?>

    <table class="table table-striped container table-dark">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Name</th>
            <th>Password</th>
            <th colspan="2" class="text-center">ACTION</th>
        </tr>
        <?php while ($row = mysqli_fetch_array($result)) { ?>
        <tr>
            <td><?php echo $row['ID']; ?></td>
            <td><?php echo $row['Username']; ?></td>
            <td><?php echo $row['Name']; ?></td>
            <td><?php echo $row['Password']; ?></td>
            <td class="text-center"><a href="index.php?edit=<?php echo $row['ID'];?>" class="btn btn-primary">Edit</a></td>
            <td class="text-center"><a href="server.php?delete=<?php echo $row['ID'];?>" class="btn btn-danger">Delete</a></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>