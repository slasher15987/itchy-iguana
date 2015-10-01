<table class="table table-striped table-hover">
    <thead>
        <tr> <!-- Table Headers -->
            <th>Group</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Website</th>
            <th>Birthday</th>
            <th>Image</th>
        </tr>
    </thead>
    <h1>Address Book</h1>
    <br />
    <?php foreach ($results as $row): ?>
        <tr>
            <td><?php echo $row['address_group_id']; ?></td>
            <td><a href='index.php?view=update&id=<?php echo $row['address_id']; ?>'><?php echo $row['fullname']; ?></a></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['phone']; ?></td>      
            <td><?php echo $row['website']; ?></td>
            <td><?php echo $row['birthday']; ?></td>
            <td></td>
        </tr>
    <?php endforeach; ?>
</table>

