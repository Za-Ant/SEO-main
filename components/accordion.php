<section class="container">
      <?php
        $qna = $Qna->get_qna();
        for ($i=0;$i<count($qna);$i++){
          echo '<div class="accordion">';
          echo '<div class="question">'.$qna[$i]->question.'</div>';
          echo '<div class="answer">'.$qna[$i]->answer.'</div>';
          echo '</div>';
      }
      ?>
</section>