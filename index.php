<?php 
    require_once("apis/get.php");
    $basedir = realpath(__DIR__);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address book</title>
    <!-- librarys -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- man-made css -->
    <link rel="stylesheet" type="text/css" href="./assets/main.css"/>
</head>
<body>
    
    <div class="container">
        <div class="row body-header">
            <h1 class="text-primary" align="center">Address Book</h1>
            <button class="btn btn-primary" align="right" data-toggle="modal" data-target="#add"> + Add</button>
        </div>
        <div class="row">
        <table class="table table-striped table-condensed table-hover" id="addressTable">
                <thead>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Birthday</th>
                    <th>Phone Number</th>
                    <th>City</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php if(!empty($addressbooks)) { 
                        $no=1;
                    ?>
                        <?php foreach($addressbooks as $addressbook) { ?>
                            <tr>
                                <td><?php echo $no++;?></td>
                                <td><?php echo $addressbook['name']; ?></td>
                                <td><?php echo $addressbook['email']; ?></td>
                                <td><?php echo $addressbook['birthday']; ?></td>
                                <td><?php echo $addressbook['phonenumber']; ?></td>
                                <td><?php echo $addressbook['city']; ?></td>
                                <td>
                                    <button 
                                      onclick="edit(
                                          '<?php echo $addressbook['id']; ?>', 
                                          '<?php echo $addressbook['name']; ?>', 
                                          '<?php echo $addressbook['email']; ?>', 
                                          '<?php echo $addressbook['birthday']; ?>', 
                                          '<?php echo $addressbook['phonenumber']; ?>', 
                                          '<?php echo $addressbook['city']; ?>')"
                                    >
                                      <i class="fa fa-edit fa-lg text-info" data-toggle="modal" data-target="#edit"></i>
                                    </button>
                                    <button onclick="delete_addr('<?php echo $addressbook['id']; ?>')">
                                      <i class="fa fa-trash-o fa-lg text-danger"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
      </div>
    </div>
    <div id="add" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Address</h4>
                </div>
                <form method="post" action="apis/add.php">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="control-label">Name : </label>
                            <input id="name" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Email : </label>
                            <input type="email" id="email" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label for="name">Birthday : </label>
                            <input type="date" id="birthday" class="form-control" name="birthday">
                        </div>
                        <div class="form-group">
                            <label for="name">Phone Number : </label>
                            <input id="phonenumber" class="form-control" name="phonenumber">
                        </div>
                        <div class="form-group">
                            <label for="name">City : </label>
                            <input id="city" class="form-control" name="city">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"> + Add</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="edit" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Address</h4>
                </div>
                <form method="post" action="apis/edit.php">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="control-label">Name : </label>
                            <input id="edit_name" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Email : </label>
                            <input id="edit_email" type="email" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label for="name">Birthday : </label>
                            <input id="edit_birthday" type="date" class="form-control" name="birthday">
                        </div>
                        <div class="form-group">
                            <label for="name">Phone Number : </label>
                            <input id="edit_phonenumber" class="form-control" name="phonenumber">
                        </div>
                        <div class="form-group">
                            <label for="name">City : </label>
                            <input id="edit_city" class="form-control" name="city">
                        </div>
                        <input type="hidden" id="edit_id" name="id"/>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"> Edit Add</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<!-- scripts -->
<script>
    $(document).ready(function() {
        $('#addressTable').DataTable({
                searching: false,
                paging: false,
                info: false,
                "aoColumnDefs": [
                    { "bSortable": false, "aTargets": [ 6 ] }, 
                ]
            }
        );
    });

    function edit(id, name, email, birthday, phonenumber, city){
        $("#edit_id").val(id); 
        $("#edit_name").val(name); 
        $("#edit_email").val(email); 
        $("#edit_birthday").val(birthday); 
        $("#edit_phonenumber").val(phonenumber); 
        $("#edit_city").val(city); 
    }

    function delete_addr(id){
        if ( window.confirm('Are you sure? Do you want delete this address?')) {
            window.location.href = "/apis/delete.php?id="+id;
        }
    }
    
</script>
</html>