
<div class="crud-1  text-center" >
<table class="table ">
                <thead class="table">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Enroll Number</th>
                        <th scope="col">Date of Create</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `crud`";
                    $result = mysqli_query($dbs, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row["id"] ?></td>
                            <td><?php echo $row["Name"] ?></td>
                            <td><?php echo $row["Email"] ?></td>
                            <td><?php echo $row["Phone"] ?></td>
                            <td><?php echo $row["Enroll Number"] ?></td>
                            <td><?php echo $row["Date of create"] ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row["id"] ?>"><i class="bi bi-pencil-square text-primary"></i></a>
                                <a href="delete.php?id=<?php echo $row["id"] ?>"><i class="bi bi-trash3-fill text-danger"></i></a>
                            </td>

                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

</div>
