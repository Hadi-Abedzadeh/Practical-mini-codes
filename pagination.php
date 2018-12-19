<?
	/*
    Pagination Module   
    Author: Hadi Abedzadeh 
    Date: 4/12/2017     
	*/

    /*CONTROLLER*/
    header('Content-Type: text/text');
    $pageIndex = 9; // page value eg: http://example/data/9
    $itemCount = 4;
    $itemIndex = ($pageIndex - 1) * $itemCount;
    $getData = $this->db->query("YOUR QUERY limit $itemIndex,$itemCount");
    $count = $this->db->query("FULL QUERY FOR COUNTING");
	
	foreach($getData->result() as $query){ /*.. get entities from DB */}

    echo '<div style="clear: both"></div>';
    $count = ceil($count->num_rows() / $itemCount);
    for ($i = $pageIndex - 3; $i <= $pageIndex + 3; $i++) {
      if ($i <= 0) continue; if ($i >= $count) continue; if ($i == $pageIndex) { ?>
        <span class="btn" style="background:red;"><?=$i?></span>
        <? } else {?>
        <span class="btn btn-blue" onclick="setData(<?= $i ?>)"><?=$i?></span>
        <? } } ?>
    <span>..</span>
    <span class="btn btn-blue" onclick="setData(<?= $count ?>)"><?=$count?></span>
    <? } ?>
	<div style="clear: both"></div>

	<!--VIEW:-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script>
  setData(1);
  function setData(page) {
    $.ajax({
      url: "http://ControllerURL/adminPageData/" + page,
	  success: function (result) {
        $("#content").html(result);
      }
    });
  }
</script>

<div class="container" id="content"></div>
