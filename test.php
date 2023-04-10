<?php

include "./VTU.php";
$vtu = new VTU();
$vtu->buyData(1,"09089659890", "237");
$vtu->buyAirtime(1,"09089659890", 200);
$vtu->buyEPin("WAEC", 1);
$vtu->buyElectricity(18, 2000, "09089659890", "Prepaid");
$vtu->buyCableSub(1, 2, "11111111111");
?>>