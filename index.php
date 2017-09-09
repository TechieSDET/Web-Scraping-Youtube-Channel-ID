<html>
<head>
 <title>Getting Data......</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<style>
.header h1{
font-weight: bolder;
text-align: center;
}
form,table{
  margin-top: 20px;
}
.well{
    background-color: white;
    box-shadow: 0px 0px 10px rgba(220,220,220,0.2);
  }
.well:hover{
    box-shadow: 0px 0px 10px grey;
    z-index: 10;
}
body{
  background-color: rgba(220,220,220,0.3);
}
</style>
</head>
<body>
<div class="container">
  <div class="row">
    <section class="content bgcolor-3">
      <div class="header col-lg-offset-2 col-lg-8">
        <h1>YOUTUBE CHANNEL ID </h1>
        <h1> FINDER</h1>
            <div class="col-lg-offset-3 col-lg-6">
                  <form action ="index.php" method="post">
                      <div class="input-group">
                          <input type="text" class="form-control" placeholder="Search" name="keyword">
                             <div class="input-group-btn">
                                <button class="btn btn-danger" type="submit" name="submit">Search</button>
                             </div>
                      </div>
                  </form>
            </div> 
      </div>
      <div class="well  col-lg-offset-1 col-lg-10 col-lg-offset-1">
        <table class="table table-responsive table-bordered table-striped table-centered  table-hovered">
          <thead>
            <th>ChannelName</th>
            <th>ChannelID</th>
            <th>FacebookUrl</th>
            <th>Country</th>
          </thead>
          <tbody>
<?php
error_reporting(E_ALL ^ E_DEPRECATED);
if(isset($_POST['submit']))
{
$ur= $_POST['keyword'];
$ur=explode(",",$ur);
$cu=count($ur);
$fbid=" ";
for($i=0;$i<$cu;$i++)
{
 $url="https://www.youtube.com/user/".$ur[$i];
 $url="https://www.youtube.com/user/".$ur[$i]."/about";

 $html = new DOMDocument();
 @$html->loadHtmlFile($url);
 $xpath = new DOMXPath( $html );
 echo "<tr>";
  echo "<td>".$ur[$i]."</td>";
$nodelist = $xpath->query( "//meta[@itemprop='channelId'] " );

  foreach  ($nodelist as $chid )
     { 
      session_start();
     $chlid="";
      $chlid=$chid->getAttribute('content');
      /*$country=$area->nodeValue;*/
     echo "<td>".$chlid."</td>";
     
  session_destroy();
     break;
     }

$fb = $xpath->query( "//a[@title='Facebook']" );   
    foreach ($fb as $id)
      {  
      session_start();
     
   /*   $fbid="";*/
       $fbid=$id->getAttribute('href');
       if(!$id)
      {
       echo "<td>"."NA"."</td>";
      }
      else
      {
       echo "<td>".$fbid."</td>";
      }

      session_destroy();
     break;
      }
      if(!$fbid)
      {
       echo "<td>"."NA"."</td>";
      }
     
    $loc= $xpath->query( "//span[@class='country-inline']" ); 
    foreach ($loc as $area )
     { 
        session_start();
      $country=""; 
      $country=$area->nodeValue;
      echo "<td>".$country."</td>";
      echo "</tr>";
      echo "<br>";
 session_destroy();
      break;
     } 
   }
 }
?>
</tbody>


</table>
</section>
</div>
</div>
</body>
</html>