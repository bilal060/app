<?php 
use yii\helpers\Html;
$images_url =  Yii::getAlias('@web/assets')."/images/heart.png";
?>
<h1>Fruits Data</h1>
<table class="table border">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">genus</th>
      <th scope="col">family</th>
      <th scope="col">order</th>
      <th scope="col">carbohydrates</th>
      <th scope="col">protein</th>
      <th scope="col">fat</th>
      <th scope="col">calories</th>
      <th scope="col">sugar</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($results as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['genus'] ?></td>
            <td><?= $row['family'] ?></td>
            <td><?= $row['order'] ?></td>
            <td><?= $row['carbohydrates'] ?></td>
            <td><?= $row['protein'] ?></td>
            <td><?= $row['fat'] ?></td>
            <td><?= $row['calories'] ?></td>
            <td><?= $row['sugar'] ?></td>
              <td>
              <i type='button'  data-fruit-id="<?= $row['id'] ?>" class="fa fa-heart-o favorite-icon favorite-fruit">
              <img class="textmiddle" width="24px" height="24px" alt="Run the report" src="<?= $images_url ?>">
</i>



</td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>


<?php
$this->registerJs('
    $(".favorite-fruit").on("click", function() {
        var fruitId = $(this).data("fruit-id");
        $.ajax({
            url: "' . Yii::$app->urlManager->createUrl(['favorite-fruits/add']) . '",
            type: "POST",
            data: {
                fruit_id: fruitId,
                _csrf: "' . Yii::$app->request->csrfToken . '"
            },
            success: function(response) {
      
                alert("fruits added to favorite susessfully");
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });
');
?>