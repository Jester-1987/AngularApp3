<?php

require 'connect.php';

$characters = [];
$sql = "SELECT characterName, characterType, alignment, playable FROM characters";

if($result = mysqli_query($con,$sql))
{
    count = 0;
    while($row = mysqli_fetch_assoc($result))
    {
        $characters[$count]['characterName'] = $row['characterName'];
        $characters[$count]['characterType'] = $row['characterType'];
        $characters[$count]['alignment'] = $row['alignment'];
        $characters[$count]['playable'] = $row['playable'];
        $count++;
    }

    echo json_encode(['data'=>$characters]);
}
else
{
    http_response_code(404);
}
?>