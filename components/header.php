<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <title>SEO Dream - Creative SEO HTML5 Template by TemplateMo test</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=(!empty($relative_path)?$relative_path:"")?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="<?=(!empty($relative_path)?$relative_path:"")?>assets/css/fontawesome.css">
    <link rel="stylesheet" href="<?=(!empty($relative_path)?$relative_path:"")?>assets/css/templatemo-seo-dream.css">
    <link rel="stylesheet" href="<?=(!empty($relative_path)?$relative_path:"")?>assets/css/animated.css">
    <link rel="stylesheet" href="<?=(!empty($relative_path)?$relative_path:"")?>assets/css/owl.css">
    <link rel="stylesheet" href="<?=(!empty($relative_path)?$relative_path:"")?>assets/css/obrazky.css">
<!--

TemplateMo 563 SEO Dream

https://templatemo.com/tm-563-seo-dream

-->

</head>

<body>
  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="index.php" class="logo">
              <h4>SEO Dream <img src="<?=(!empty($relative_path)?$relative_path:"")?>assets/images/logo-icon.png" alt=""></h4>
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
                <?php $menu_items = $Header_menu->get_menu(); ?>
                <?php foreach ($menu_items as $page=>$url):?>
              <li class="scroll-to-section"><a href="<?=(!empty($relative_path)?$relative_path:"").$url?>" class="active"><?=$page?></a></li>
                <?php endforeach; ?>
            </ul>        
            <a class='menu-trigger'>
                <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->