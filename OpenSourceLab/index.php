<?php include 'views/header.php';
 include_once 'models/dbConnection.php';
  date_default_timezone_set('US/Eastern');
?>

<?php 
$query = 'SELECT * FROM tblposts INNER JOIN tblusers ON tblposts.UserID = tblusers.UserID ORDER BY tblposts.PostTime desc;';
    $Posts = $db->query($query);
?>
  
    <div class="container">
    <div class="row">
      <div class="center white-text">
      <h1>World Chat</h1>
</div>
    <div style="margin-top:50px;border-radius:20px;" class="<?php if(!isset($_SESSION['email'])) echo 'col m8 l8 s12 offset-m2 offset-l2'; else echo 'col m8 l8 s12'?>">
    <div class="row" id="posts-cards">
    <div class="col s12 m12 l12">
      <div class="card grey darken-4" style="<?php if(!isset($_SESSION['email'])) echo 'display:none;';?>">
        <div class="card-content white-text">
          <span class="white-text card-title" style="font-weight:bold;">
          <p class="center">Make A Status</p>
        <div class="chip">
    <img src="images/profile-pic.jpg">
    <?php echo $_SESSION['username']?>
       </div>
      </span>
      <form action="models/addPost.php" method="POST">
      <input type='hidden' name="post_time" value="<?php echo $date = date('Y-m-d H:i:s');?>">
      <input type='hidden' name="user_id" value="<?php echo $_SESSION['userid']?>">
        <input class="white-text" style="font-size:20px;" id="create_post" placeholder="what's running in to your head, <?php echo $_SESSION['username']?>?" name="create_post" type="text" class="validate"/>
        <div style="padding-left:0px;padding-bottom:0px;" class="card-action">
        <button style="border-radius:5px;" class="btn waves-effect waves-light blue" type="submit" name="action">Create Post</button>
        </div>
</form>
        </div>
      </div>

 <?php foreach($Posts as $indStmt):?>
                        <?php 
$PostID = $indStmt['PostID'];
$Post = $indStmt['Post'];
$TimePosted = $indStmt['PostTime'];
$UserID = $indStmt['UserID'];
$likes = $indStmt['likes'];
?>
<div class="row" id="posts-cards">
    <div class="col s12 m12 l12">
      <div class="card grey darken-4">
        <div class="card-content white-text">
          <span class="white-text card-title">
          <form action="models/deletePost.php" method="POST">
          <input type='hidden' name="PostID" style="font-size:20px;" value="<?php echo $PostID?>">
          <button style="margin-left:10px;<?php if(!isset($_SESSION['userid'])) echo 'display:none;'; else if (isset($_SESSION['userid'])) if($_SESSION['role'] == 1) echo 'display:inline;'; else if ($_SESSION['userid'] == $UserID && $_SESSION['role']!=1) echo 'display:inline'; else echo 'display:none';?>" class="right btn-flat waves-effect waves-light red" type="submit" name="action">
    <i style="margin:0px;" class="white-text material-icons right">delete</i>
  </button>
  </form>
  <form action="EditPost.php" method="POST">
  <input type='hidden' name="PostID" value="<?php echo $PostID;?>">
  <button style="<?php if(!isset($_SESSION['userid'])) echo 'display:none;'; else if (isset($_SESSION['userid'])) if ($_SESSION['userid'] == $UserID) echo 'display:inline'; else echo 'display:none';?>" class="right btn-flat waves-effect waves-light blue" type="submit" name="action">
    <i style="margin:0px;" class="white-text material-icons right">create</i>
  </button>
  </form>
  
  <form action="models/likes.php" method="POST" style="margin-right:2px;">
  <input type='hidden' name="PostID" value="<?php echo $PostID;?>">
  <button style="margin-right:9px;<?php if(!isset($_SESSION['userid'])) echo 'display:none;'; else if (isset($_SESSION['userid'])) if ($_SESSION['userid'] == $UserID) echo 'display:inline'; else echo 'display:none';?>" class="right btn-flat waves-effect waves-light green" type="submit" name="action">
    <i style="margin:0px;" class="white-text material-icons right">thumb_up</i>
  </button>
  </form>
          <p class="blue-text" style="font-weight:bold;"><?php echo $indStmt['Username']?></p>
          <p style="font-size:0.7em;opacity:0.5">Posted <?php echo $TimePosted?></p>
          </span>
          <p class="white-text"><?php echo $Post?></p>
          <p class="white-text"><?php echo $likes?> like(s)</p>
        </div>
        <div class="card-action">
        <!---Reply to Post-->

        <?php $query2 = "SELECT * FROM tblreplies INNER JOIN tblusers ON tblreplies.UserID = tblusers.UserID WHERE PostID = '$PostID' ORDER BY tblreplies.ReplyTime desc;";
        $Replies = $db->query($query2);
        ?>
        <?php foreach($Replies as $temp):?>
        <div class="row">
    <div class="col s12 m12 l12">
      <div class="card-panel grey">
        <span class="black-text">
        <span style="font-weight:bold;">
        <?php echo $temp['Username'] . ":" . " " . " "?></span><?php echo $temp['Reply']?><br/>
        <?php echo $temp['ReplyTime']?><br/>
        <?php echo $temp['likes']?> like(s)
        <form action="models/deleteReply.php" method="POST">
          <input type='hidden' name="ReplyID" value="<?php echo $temp['ReplyID']?>"/>
          <button style="margin-left:10px;bottom:20px;<?php if(!isset($_SESSION['userid'])) echo 'display:none;'; else if (isset($_SESSION['userid'])) if($_SESSION['role'] == 1) echo 'display:inline;'; else if ($_SESSION['userid'] == $temp["UserID"] && $_SESSION['role']!=1) echo 'display:inline'; else echo 'display:none';?>" class="right btn-flat waves-effect waves-light red" type="submit" name="action">
    <i style="margin:0px;" class="white-text material-icons right">delete</i>
  </button>
  </form>
  <form action="EditReply.php" method="POST">
          <input type='hidden' name="ReplyID" value="<?php echo $temp['ReplyID']?>"/>
          <button style="margin-left:10px;bottom:20px;<?php if(!isset($_SESSION['userid'])) echo 'display:none;'; else if (isset($_SESSION['userid'])) if ($_SESSION['userid'] == $temp["UserID"]) echo 'display:inline'; else echo 'display:none';?>" class="right btn-flat waves-effect waves-light blue" type="submit" name="action">
    <i style="margin:0px;" class="white-text material-icons right">create</i>
  </button>
  </form>

  <form action="models/likesReply.php" method="POST">
  <input type='hidden' name="ReplyID" value="<?php echo $temp['ReplyID'];?>">
  <button style="margin-left:10px;bottom:20px;<?php if(!isset($_SESSION['userid'])) echo 'display:none;'; else if (isset($_SESSION['userid'])) if ($_SESSION['userid'] == $UserID) echo 'display:inline'; else echo 'display:none';?>" class="right btn-flat waves-effect waves-light green" type="submit" name="action">
    <i style="margin:0px;" class="white-text material-icons right">thumb_up</i>
  </button>
  </form>
        </span>
      </div>
    </div>
  </div>
        <?php endforeach; ?>

        <form action="models/addReply.php" method="POST">
      <input type='hidden' name="reply_time" value="<?php echo $date = date('Y-m-d H:i:s');?>"/>
      <input type='hidden' name="user_id" value="<?php if(isset($_SESSION['userid'])) echo $_SESSION['userid'];?>"/>
      <input type='hidden' name="post_id" value="<?php echo $PostID?>"/>
        <input style="<?php if(!isset($_SESSION['userid'])) echo 'display:none;';?>" class="white-text" id="create_reply" placeholder=" Write a comment.." name="create_reply" type="text" class="validate"/>
        <button style="border-radius:5px;" class="btn waves-effect waves-light blue right" type="submit" name="action">Send</button>
        </form>

        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>
</div>
    </div>
    <div style="margin-top:50px;border-radius:20px;" class="<?php if(!isset($_SESSION['email'])) echo ''; else echo 'col m3 l3 s12'?>">
    <h5 class="center white-text" style="<?php if(!isset($_SESSION['email'])) echo 'display:none;';?>"  style="margin-top:0px;font-weight:bold;"><?php echo $_SESSION['username']?></h5>
    <?php if(isset($_SESSION['username']) && $_SESSION['role'] == 1) echo '<h6 style="margin-top:0px;" class="grey-text center">Admin</h6>'?>
    <p class="center" style="<?php if(!isset($_SESSION['email'])) echo 'display:none;';?>" ><img id="profile-pic" src="images/profile-pic.jpg"/></p>
    <div class="collection" style="border-radius:5px;<?php if(!isset($_SESSION['email'])) echo 'display:none;';?>" >
        <a href="#!" class="collection-item active">Recent Feed</a>
        <a href="#!" class="collection-item">User Page</a>
        <a href="#!" class="collection-item">Memories</a>
        <a href="#!" class="collection-item">Events</a>
      </div>
    </div>
        </div\>
        </div>
<?php include 'views/footer.php';?>