<?php
include("conn.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- เพิ่มส่วน ใช้งาน Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- ส่วนของ DataTable -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- เพิ่มส่วน ใช้งาน Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Itim&family=Kanit:ital,wght@0,200;0,300;1,100;1,200&family=Prompt:ital,wght@0,200;0,300;1,300&display=swap" rel="stylesheet">

    <!-- เพิ่ม CSS ให้ใช้ Font  -->
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            margin-left: 100px;
            margin-right: 100px;
            margin-top: 100px;
            margin-bottom: 100px;
        }
    </style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลหนังสือนิยาย</title>
</head>

<body>
    <?php
    if (isset($_GET['action_even']) == 'delete') {
        //echo "Test";

        $id = $_GET['id'];
        $sql = "SELECT * FROM นิยาย WHERE id=$id";
        // echo $sql;
        $result = $conn->query($sql);
        // $lvsql =mysqli_query($conn,$sql);
        if ($result->num_rows > 0) {
            // sql to delete a record
            $sql = "DELETE FROM นิยาย WHERE id=$id";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>ลบข้อมูลสำเร็จ</div>";
            } else {
                echo "<div class='alert alert-danger'>ลบข้อมูลมีข้อผิดพลาด กรุราตรวจสอบ !!! </div>" . $conn->error;
            }
            // $conn->close();
        } else {
            echo 'ไม่พบข้อมูล กรุณาตรวจสอบ';
        }
    }
    ?>

    <h1>ตารางข้อมูลหนังสือนิยาย</h1>
    <h2>พัฒนาโดย 664485014 นายศุภณัฐ ตามใจเพียร</h2>

    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>id</th>
                <th>ชื่อหนังสือ</th>
                <th>สำนักพิมพ์</th>
                <th>ผู้เเต่ง</th>
                <th>หมวดหมู่</th>
                <th>ปีที่พิมพ์</th>
                <th>จำนวนหน้า</th>
                <th>ราคา</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql = "SELECT * FROM นิยาย";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["ชื่อ_หนังสือ"] . "</td>";
                    echo "<td>" . $row["สำนักพิมพ์"] . "</td>";
                    echo "<td>" . $row["ผู้เเต่ง"] . "</td>";
                    echo "<td>" . $row["หมวดหมู่"] . "</td>";
                    echo "<td>" . $row["ปีที่พิมพ์"] . "</td>";
                    echo "<td>" . $row["จำนวนหน้า"] . "</td>";
                    echo "<td>" . $row["ราคา"] . "</td>";
                    echo '<td>"
                    <a type="button" href="show.php?action_even=del&id=' . $row['id'] . '" title="ลบข้อมูล" onclick="return confirm(\'ต้องการจะลบข้อมูลรายชื่อ ' . $row['id'] . ' ' . $row['ชื่อ_หนังสือ'] . '?\')" class="btn btn-danger btn-sm"> ลบข้อมูล </a>  
                    
                    <a type="button" href="edit.php?action_even=edit&id=' . $row['id'] . '" 
                title="แก้ไขข้อมูล" onclick="return confirm(\'ต้องการจะแก้ไขข้อมูลรายชื่อ ' . $row['id'] . ' ' . $row['ชื่อ_หนังสือ'] . '?\')" class="btn btn-primary btn-sm"> แก้ไขข้อมูล </a> </td>';

                    echo "</tr>";
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>

            </tfoot>
    </table>
</body>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<script>
    new DataTable('#example');
</script>

</html>