
<div class="container">
    <!-- print confirmation that data was added or not -->
    <h1><?php echo $results; ?></h1> 

    <form method="post" action="#" enctype="multipart/form-data">
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
            <input type="text" value="" class="form-control" id="name" name="fullname" />
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" value="" class="form-control" id="email_input" name="email" />
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" value="" class="form-control" id="address" name="address" />
        </div>
        <div class="form-group">
            <label for="phone_input">Phone Number</label>
            <input type="text" value="" class="form-control" id="phone_input" name="phone" />
        </div>         
        <div class="form-group">
            <label for="website">Web Site</label>
            <input type="text" value="" class="form-control" id="website" name="website" />
        </div>   
        <div class="form-group">
            <label for="birthday">Birthday</label>
            <input type="date" value="" class="form-control" id="birthday" name="birthday" />
        </div>   
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name="upfile" />
        </div>   
        <input type="submit" class="btn btn-primary" value="Submit" />

    </form>
</div>