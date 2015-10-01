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
            <th>Options</th>
            
        </tr>
    </thead>
    <h1>Address Book</h1>
    <br />
    <?php foreach ($results as $row): ?>
        <tr>
            <td><?php echo $row['address_group_id']; ?></td>
            <td><a href='index.php?view=update&id=<?php echo $row['address_id']; ?>'><?php echo $row['fullname']; ?></a></td>
            <td><a href="mailto:<?php echo $row['email']; ?>"><?php echo $row['email']; ?></a></td>
            <td><a href="http://maps.google.com/?q=<?php echo $row['address']; ?>"><?php echo $row['address']; ?></a></td>
            <td><a href="tel:<?php echo $row['phone']; ?>"><?php echo $row['phone']; ?></a></td>      
            <td><a href="<?php echo $row['website']; ?>"><?php echo $row['website']; ?></a></td>
            <td><?php echo date('Y-m-d', strtotime($row['birthday'])); ?></td>
            <td><a href="delete.php?id=<?php echo $row['address_id']; ?>" class="btn btn-danger" onClick="return checkDelete()">Delete</a></td>
        </tr>
    <?php endforeach; ?>
</table>


