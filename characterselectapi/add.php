<?
require 'connect.php';

// get the posted data
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty ($postdata))
{
    // extract the data
    $request = json_decode($postdata);

    // validate
    if(trim($request->data->characterName) === '' || trim($request->data->characterType) === '' || trim($request->data->alignment) === '' ||trim($request->data->playable) === '')
    {
        return http_response_code(400);
    }

    // sanitize
    $characterName = mysqli_real_escape_string($con, trim($request->data->characterName));
    $characterType = mysqli_real_escape_string($con, trim($request->data->characterType));
    $alignment = mysqli_real_escape_string($con, trim($request->data->alignment));
    $playable = mysqli_real_escape_string($con, trim($request->data->playable));

    // store
    $sql = "INSERT INTO `characters`(`characterName`, `characterType`, `alignment`, `playable`) VALUES (null, '{$characterName}', '{$characterType}', '{$alignment}', '{$playable}')";

    if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    $character = [
      'characterName' => $characterName,
      'characterType' => $characterType,
      'alignment' => $alignment,
      'playable' => $playable    
      'characterID'=> mysqli_insert_id($con)
    ];
    echo json_encode(['data'=>$contact]);
  }
  else
  {
    http_response_code(422);
  }
}
 
?>
