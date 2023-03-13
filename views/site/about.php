
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
      <th scope="col">name</th>
      <th scope="col">family</th>
      <th scope="col">order</th>
      <th scope="col">calories</th>
      <th scope="col">fat</th>
      <th scope="col">protein</th>
      <th scope="col">sugar</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($results as $row): ?>
        <tr>
            <td><?= $row['fv_id'] ?></td>
            <td><?= $row['genus'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['family'] ?></td>
            <td><?= $row['order'] ?></td>
            <td><?= $row['calories'] ?></td>
            <td><?= $row['fat'] ?></td>
            <td><?= $row['protein'] ?></td>
            <td><?= $row['sugar'] ?></td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>


