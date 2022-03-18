<?php 
   include 'views/header.php';
   if(empty($_SESSION['userid'])) {
    header("Location: login.php");
     exit();
   }
if (isset($_POST["ReplyID"])){
$ReplyID = $_POST['ReplyID'];

require "models/dbConnection.php";

$stmt = $db->prepare('SELECT * FROM tblReplies WHERE ReplyID = :replyid');
$stmt->bindParam(':replyid',$ReplyID);
$stmt->execute();

$indStmt = $stmt->fetch();
}
else {
  $PostID = null;
  echo "no username supplied";
}
date_default_timezone_set('US/Eastern');
?>

<div class="container">
    <div class="row">
    <div style="margin-top:50px;border-radius:20px;" class="<?php if(!isset($_SESSION['email'])) echo 'col m8 l8 s12 offset-m2 offset-l2'; else echo 'col m8 l8 s12'?>">
    <div class="row" id="posts-cards">
    <div class="col s12 m12 l12">
      <div class="card white" style="<?php if(!isset($_SESSION['email'])) echo 'display:none;';?>">
        <div class="card-content grey darken-4 white-text">
          <span class="white-text card-title" style="font-weight:bold;">
          <p class="center">Edit Reply</p>
        <div class="chip">
    <img src="images/profile-pic.jpg">
    <?php echo $_SESSION['username']?>
       </div>
      </span>
      <form action="models/editReply.php" method="POST">
      <input type='hidden' name="reply_time" value="<?php echo $date = date('Y-m-d H:i:s');?>">
      <input type='hidden' name="user_id" value="<?php echo $_SESSION['userid']?>">
      <input type='hidden' name="post_id" value="<?php echo $indStmt['PostID'] ?>">
      <input type='hidden' name="reply_id" value="<?php echo $indStmt['ReplyID'] ?>">
        <input class="white-text" id="edit_reply" value="<?php echo $indStmt["Reply"]?>" name="edit_reply_message" type="text" class="validate"/>
        <button style="border-radius:5px;" class="btn waves-effect waves-light red" type="submit" name="action">Edit Reply</button>
        
</form>
        </div>
      </div>
</div>
</div>
</div>
<div style="margin-top:50px;border-radius:20px;" class="<?php if(!isset($_SESSION['email'])) echo ''; else echo 'col m3 l3 s12'?>">
    <h5 class="center white-text" style="<?php if(!isset($_SESSION['email'])) echo 'display:none;';?>"  style="margin-top:0px;font-weight:bold;"><?php echo $_SESSION['username']?></h5>
    <?php if(isset($_SESSION['username']) && $_SESSION['role'] == 1) echo '<h6 style="margin-top:0px;" class="grey-text center">Admin</h6>'?>
    <p class="center" style="<?php if(!isset($_SESSION['email'])) echo 'display:none;';?>" ><img id="profile-pic" src="images/profile-pic.jpg"/></p>
    <div class="collection" style="border-radius:5px;<?php if(!isset($_SESSION['email'])) echo 'display:none;';?>" >
        <a href="#!" class="collection-item active">News Feed</a>
        <a href="#!" class="collection-item">Profile</a>
        <a href="#!" class="collection-item">Games</a>
        <a href="#!" class="collection-item">Friends</a>
      </div>
    </div>
</div>
</div>

<?php include 'views/footer.php';?>