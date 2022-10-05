<?php
    include_once("db/db.php");
    $db = new Db;

    $sql = "SELECT * FROM tbl_menu ORDER BY id DESC";
    $res = $db->cn->query($sql);
    $num = $res->num_rows;
    if($num > 0){
        while($row=$res->fetch_array()){
            ?>
                <tbody>
                    <tr>
                        <td><?php echo $row[0] ?></td>
                        <td><?php echo $row[1] ?></td>
                        <td><?php echo $row[3] ?></td>
                        <td><?php echo $row[2] ?></td>
                        <td><?php echo $row[4] ?></td>
                    </tr>
                </tbody>
            <?php
        }
    }
?>