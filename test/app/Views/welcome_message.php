<!DOCTYPE html>
    <html lang="en">
    <head>
    <title>Home Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/276f0127d0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/custom.css');?>">
    </head>
    <body>
    <div class="container">
        <h1>User List</h1>
        <div class="row">
        <div class="col-md-12">
            <button id="addNewUser" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> &nbsp;Add New</button>
        </div>
            <div class="col-md-12">
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th>ID #</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="userTableContent">
                        <?php
                            foreach($users as $user)
                            {
                                ?>
                                <tr>
                                    <td>#<?php echo $user->id; ?></td>
                                    <td><?php echo $user->full_name; ?></td>
                                    <td><?php echo $user->email; ?></td>
                                    <td><?php echo $user->phone_no; ?></td>
                                    <td>
                                        <button class="edit_user btn"  data-id="<?php echo $user->id; ?>" title="Edit"><i class="far fa-edit"></i></button>
                                        <button class="delete_user btn"  data-id="<?php echo $user->id; ?>" title="Delete"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                <nav aria-label="Page navigation example">
                    <input type="hidden" autocomplete="off" id="currentPageNo" value="1" />
                    <input type="hidden" autocomplete="off" id="maxPageNo" value="<?php echo $pageCount; ?>" />
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link btnPrev" >Previous</a></li>
                        <?php
                            for($i=1;$i<=$pageCount;$i++)
                            {
                                $activeClass = ($i==1?'active':'');
                                echo '<li class="page-item"><a href="#" class="page-link pageItem '.$activeClass.'"  data-page="'.$i.'">'.$i.'</a></li>';
                            }
                        ?>
                        <li class="page-item"><a class="page-link btnNext" >Next</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    </body>
    </html>
<input type="hidden" value="<?php echo base_url();?>" id="userBaseUrl"/>
<!-- Modal -->
<div id="addNewUserModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New User</h4>
      </div>
      <div class="modal-body">
       <div class="row">
           <div class="col-md-12">
           <form id="newUserForm" method="POST" enctype="multipart/form-data">
                <input type="hidden" autocomplete="off" id="currentUserId" name="currentUserId" value=""/>
                <div class="form-group">
                    <img id="userProfilePictureImage" alt="profile Picture" src="" />
                </div>
                <div class="form-group">
                    <label >Full Name *</label>
                    <input type="text" class="form-control"  id="userFullName" name="userFullName" />
                    <p class="error-msg"></p>
                </div>
                <div class="form-group">
                    <label >Email *</label>
                    <input type="email" class="form-control" id="userEmail" name="userEmail" />
                    <p class="error-msg"></p>
                </div>
                <div class="form-group">
                    <label >Phone *</label>
                    <input type="text" class="form-control" id="userPhone" name="userPhone">
                    <p class="error-msg"></p>
                </div>
                <div class="form-group">
                    <label>Porfile Picture</label>
                    <input type="file" class="form-control" accept=".png, .jpg, .jpeg" id="userProfilePicture" name="userProfilePicture">
                    <p class="error-msg"></p>
                </div>
                <button id="btnSaveUser" class="btn btn-success">Save</button>
            </form>
           </div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
    <script src="<?php echo base_url('/assets/js/custom.js');?>"></script>