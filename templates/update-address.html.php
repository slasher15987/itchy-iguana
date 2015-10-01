<!-- 
Change code so it echoes the information in the database -->
<?php
        
        $name = $results['fullname'];
        $email = $results['email'];
        $address = $results['address'];
        $phone = $results['phone'];
        $website = $results['website'];
        $birthday = $results['birthday'];
?>

<div class="container">
    <!-- print confirmation that data was added or not -->
     

    <form method="post" action="#">
        <div class="form-group">
            <label for="address_group">Address Group</label>
            <select class="form-control" id="group" name="group">
                <?php foreach ($groups as $row): ?>
                        <option value="<?php echo $row['address_group_id']; ?>"><?php echo $row['address_group']; ?></option>
                    <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="name">Full Name</label>        
            <input type="text" value="<?php echo $name; ?>" class="form-control" id="name" name="fullname" />
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" value="<?php echo $email; ?>" class="form-control" id="email_input" name="email" />
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" value="<?php echo $address; ?>" class="form-control" id="address" name="address" />
        </div>
        <div class="form-group">
            <label for="phone_input">Phone Number</label>
            <input type="text" value="<?php echo $phone; ?>" class="form-control" id="phone_input" name="phone" />
        </div>         
        <div class="form-group">
            <label for="website">Web Site</label>
            <input type="text" value="<?php echo $website; ?>" class="form-control" id="website" name="website" />
        </div>   
        <div class="form-group">
            <label for="birthday">Birthday</label>
            <input type="date" value="<?php echo date('Y-m-d', strtotime($birthday)); ?>" class="form-control" id="birthday" name="birthday" />
        </div>   
        <button name='updateForm' type="submit" class="btn btn-primary" value="<?php echo $address_id; ?>" >Update</button>

    </form>
</div>