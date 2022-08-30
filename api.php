<?php

header("Access-Control-Allow-Origin: *");

include ('includes/connect.php');

// ********************************************************************************
// Merge received JSON with standard $_REQUEST data
if (file_get_contents('php://input'))
{
  $_REQUEST = array_merge($_REQUEST, json_decode(file_get_contents('php://input'),true));
}

$data = array();

// ********************************************************************************
// Delete all livecodes older than on hour
$query = 'DELETE FROM livecode
  WHERE date < NOW() - INTERVAL 1 HOUR';
mysqli_query($connect, $query);

// ********************************************************************************
// Get date of last livecode
$query = 'SELECT MAX(UNIX_TIMESTAMP(date)) AS date
  FROM livecode
  LIMIT 1';
$result = mysqli_query($connect, $query);

if (mysqli_num_rows($result) > 0)
{
  $data['updated'] = mysqli_fetch_assoc($result)['date']; 
}
else
{
  $data['updated'] = 0;
}

// ********************************************************************************
// Count all current livecodes
if (isset($_REQUEST['date']) and false)
{

  $query = 'SELECT *
    FROM livecode
    ORDER BY path';
  $result = mysqli_query($connect, $query);
  
  $data['count'] = mysqli_num_rows($result);
  
} 

// ********************************************************************************
// Add or update a new livecode
elseif (isset($_REQUEST['content']) and isset($_REQUEST['path']))
{
  
  $path = explode('/', $_REQUEST['path']);
  $path = $path[count($path)-1];
  
  $query = 'SELECT id 
    FROM livecode 
    WHERE path = "'.addslashes($path).'"';
  $result = mysqli_query($connect, $query);
  
  if (mysqli_num_rows($result))
  {
    
    $query = 'UPDATE livecode SET
      content = "'.addslashes($_REQUEST['content']).'",
      date = NOW()
      WHERE path = "'.addslashes($path).'"';
    
    $data['action'] = 'Path updated: '.$path;
    
  }
  else
  {
    
    $query = 'INSERT INTO livecode (
        path,
        content
      ) VALUES (
        "'.addslashes($path).'",
        "'.addslashes($_REQUEST['content']).'"
      )';
    
    $data['action'] = 'New path added: '.$path;
    
  }
  
  mysqli_query($connect, $query);
  
}

// ********************************************************************************
// Clear livecode
elseif (isset($_GET['reset']))
{
  
  $query = 'DELETE FROM livecode';
  mysqli_query($connect, $query);
  
  $data['action'] = 'Paths have been reset';
  
}

// ********************************************************************************
// Retrieve all livecodes
else
{
  
  $query = 'SELECT *
    FROM livecode
    ORDER BY path';
  $result = mysqli_query($connect, $query);
  
  $data['action'] = 'Paths retrieved: '.mysqli_num_rows($result);
  $data['count'] = mysqli_num_rows($result);
  
  $paths = array();
  
  while($record = mysqli_fetch_assoc($result))
  {
    $paths[$record['path']] = htmlentities($record['content'], ENT_QUOTES);
  }
  
  $data['paths'] = $paths;
  
}

$data['status'] = 'Complete';

echo json_encode($data);