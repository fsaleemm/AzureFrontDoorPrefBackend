<!DOCTYPE html>
<html>  
  <body>
    <p><?php echo "App Name is: ".getenv("AppName"); ?></p>
    <p><?php 
    $currentDate = new datetime();
    echo $currentDate->format('Y-m-d H:i:s'); ?></p>
  </body>
</html>