<?php 

$title = $page->get('headline|title');

$sidebar = $page->sidebar;

$homepage = $pages->get('/'); 

// basic-page.php template file 
// See README.txt for more information

// Primary content is the page's body copy
$content = $page->body; 

// If the page has children, then render navigation to them under the body.
// See the _func.php for the renderNav example function.
/*if($page->hasChildren) {
  $content .= renderNav($page->children);
}*/

// if the rootParent (section) page has more than 1 child, then render 
// section navigation in the sidebar
/*if($page->rootParent->hasChildren > 1) {
  $sidebar = renderNavTree($page->rootParent, 3) . $page->sidebar; 
}*/

if(count($page->HeaderImage)) {
  // if the page has images on it, grab one of them randomly... 
  $image = $page->HeaderImage->getRandom();
  // resize it to 400 pixels wide
  //$image = $image->width(1024); 
  // output the image at the top of the sidebar...
  $headbar = "<img src='$image->url' alt='$image->description' class='img-responsive' />";
} else {
  // no images... 
  // append sidebar text if the page has it
  $headbar = $page->images->getRandom();
}

?>

<!DOCTYPE html>
<head>

  <html lang="en">

  <meta charset="utf-8">
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?php echo $title; ?></title>
  <meta name="description" content="<?php echo $page->summary; ?>" />

  <!-- CSS -->
  <link rel="stylesheet" href="<?php echo $config->urls->templates; ?>styles/cubs_reset.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo $config->urls->templates; ?>styles/cubs.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  
  <!-- JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <meta name="wot-verification" content="8d7318b5424f254e68a4"/>
</head>

<body>

  <?php include_once("analyticstracking.php"); 
        include_once("./_func.php"); ?>

<div class="container">

  <?php if($headbar): ?>
    <div class="container-fluid">
       <div class="row" id='headbar'>
          <?php echo $headbar; ?>
       </div>
    </div>
  <?php endif; ?>


    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
          </button>
          <a class="navbar-brand" href="<?php echo $homepage->url; ?>"><?php echo $homepage->title; ?></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav topnav"><?php 
            // top navigation consists of homepage and its visible children
            foreach($homepage->children as $item) {
              if($item->id == $page->rootParent->id) {
                echo "<li class='current active'>";
              } else {
                echo "<li>";
              }
              echo "<a href='$item->url'>$item->title</a></li>";
            }
            ?></ul>
          <ul class="nav navbar-nav navbar-right">
            <?php 
            // output an "Edit" link if this page happens to be editable by the current user
            if($page->editable()) echo "<li class='edit'><a href='$page->editUrl'>Edit</a></li>";
            ?>
            <li><a href="https://booking.hertscubs.uk/login"><span class="glyphicon glyphicon-log-in"></span> Booking Site Login</a></li>
          </ul>
        </div>
      </div>
    </nav>
      
    <div class="container-fluid text-center">    
      <div class="row content responsive">
        <div class="col-sm-10 text-left responsive"> 
          <h1><?php echo $title; ?></h1>

          <p><?php echo $content; ?></p>
        </div>
        </br>
        <?php if(count($page->EventFiles)): ?>
          <div class="col-sm-10 responsive text-center">
            <table cellpadding="3" cellspacing="3" style="width:80%;">
              <tbody>

                  <?php if(count($page->EventFiles) > 3) {
                    echo "<tr><td><hr></td></tr>";
                    foreach($page->EventFiles as $file) {
                      
                      if ($file->ext === 'docx' || $file->ext === 'doc') {
                        $icon = 'fa-file-word-o';
                      } elseif ($file->ext === 'pdf') {
                        $icon = 'fa-file-pdf-o';
                      } elseif ($file->ext === 'xls' || $file->ext === 'xlsx') {
                        $icon = 'fa-file-excel-o';
                      } elseif ($file->ext === 'zip') {
                        $icon = 'fa-file-zip-o';
                      } else {
                        $icon = 'fa-file-o';
                      }

                      echo "<tr style='padding:5px 5px 5px 5px;'>";
                        //echo "<td><i class='fa $icon fa-fw fa-2x' style='text-align:right;'></i></td>";
                        echo "<td style='text-align:left; vertical-align:middle;'>";
                          echo "<a href='$file->httpUrl'><span><i class='fa $icon fa-fw fa-2x'></i>$file->description</span></a>";
                        echo "</td>";
                      echo "</tr><tr><td><hr></td></tr>";
                    }
                  } else {
                    if (count($page->EventFiles) == 1) {
                      echo "<tr><td><hr></td></tr>";
                    } elseif (count($page->EventFiles) == 2) {
                      echo "<tr><td><hr></td><td><hr></td></tr>";
                    } else {
                      echo "<tr><td><hr></td><td><hr></td><td><hr></td></tr>";
                    }
                    
                    echo "<tr>";
                    foreach($page->EventFiles as $file) {
                      
                      if ($file->ext === 'docx' || $file->ext === 'doc') {
                        $icon = 'fa-file-word-o';
                      } elseif ($file->ext === 'pdf') {
                        $icon = 'fa-file-pdf-o';
                      } elseif ($file->ext === 'xls' || $file->ext === 'xlsx') {
                        $icon = 'fa-file-excel-o';
                      } else {
                        $icon = 'fa-file-o';
                      }

                      echo "<td style='vertical-align:middle;'>";
                        echo "<a href='$file->httpUrl'><span><i class='fa $icon fa-fw fa-2x'></i>$file->description</span></a>";
                      echo "</td>";
                    }
                    echo "</tr>";
                    if (count($page->EventFiles) == 1) {
                      echo "<tr><td><hr></td></tr>";
                    } elseif (count($page->EventFiles) == 2) {
                      echo "<tr><td><hr></td><td><hr></td></tr>";
                    } else {
                      echo "<tr><td><hr></td><td><hr></td><td><hr></td></tr>";
                    }
                  }?>

                  
                </tr>
              </tbody>
            </table>
          </div>
        <?php endif ?>
        </br>
      </div>
    </div>

    <footer class="container-fluid text-center">
      <img src='<?php echo $config->urls->templates; ?>img/cubs/foot.png' alt='Footer' class='img-responsive' />
      <div class="row responsive">
        <div class="col-sm-12 responsive">
          <ul>
            <li ><a class="processwire" href="https://processwire.com"></a></li>
            <li ><?php 
              if($user->isLoggedin()) {
                // if user is logged in, show a logout link
                echo "<a class='login' href='{$config->urls->admin}login/logout/'>Logout ($user->name)</a>";
              } else {
                // if user not logged in, show a login link
                echo "<a class='login' href='{$config->urls->admin}'>Admin Login</a>";
              }
              ?></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>

</body>
</html>
