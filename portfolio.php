<?php
include('components/header.php');
include('components/portf_baner.php');
include_once('inc/Portfolio.php');
?>
<main>
  <?php
    $portfolio = $Portfolio->get_portfolio();
    echo '<div class="port">';
    for ($i=0;$i<count($portfolio);$i++) {
      $temp_i = $i+1;
      if ($temp_i%4==1) {     
        echo '<div class="col-25 portfolio text-white textcenter" style = "background-image: url(\''.$portfolio[$i]->image.'\');"'.'>';
        echo $portfolio[$i]->name;
      } elseif ($temp_i%4==0) {
        echo '<div class="col-25 portfolio text-white textcenter" style = "background-image: url(\''.$portfolio[$i]->image.'\');"'.'>';
        echo $portfolio[$i]->name;
      } else {
        echo '<div class="col-25 portfolio text-white textcenter" style = "background-image: url(\''.$portfolio[$i]->image.'\');"'.'>';
        echo $portfolio[$i]->name;
      }
      echo '</div>';
    }
  ?>  
</main>
<?php
include('components/footer.php');
?>