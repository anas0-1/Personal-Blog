<?php
/*** Check the $_GET variable ***/
if(filter_has_var(INPUT_GET, "id") !== false && filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) !== false)
    {
    /*** set the image_id variable ***/
    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
    $hostname = "localhost";
	$dbname = "store";
	$user = "root";
	$pass = "";
   try    {
          /*** connect to the database ***/
          $DBH = new PDO("mysql:host=$hostname;dbname=$dbname", $user, $pass);
          /*** set the PDO error mode to exception ***/
          $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          /*** The sql statement ***/
          $sql = "SELECT image, type FROM testblob WHERE id=".$id;
          /*** prepare the sql ***/
          $STH = $DBH->prepare($sql);
          /*** exceute the query ***/
          $STH->execute(); 
          /*** set the fetch mode to associative array ***/
          $STH->setFetchMode(PDO::FETCH_ASSOC);
          $array = $STH->fetch();
          /*** the size of the array should be 2 (1 for each field) ***/
          if(sizeof($array) === 2)
              {
              $type = "Content-type: ".$array['type'];
              /*** set the header for the image ***/
              header($type);
              echo $array['image'];
              }
          else
              {
              throw new Exception("Out of bounds error");
              }
          }
       catch(PDOException $e)
          {
          echo $e->getMessage();
          }
       catch(Exception $e)
          {
          echo $e->getMessage();
          }
      }
 else
      {
      echo 'Please use a valid image id number';
      }
?>