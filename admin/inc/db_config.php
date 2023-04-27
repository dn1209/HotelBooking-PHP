<?php
$hname='localhost';
$uname='root';
$pass='';
$db='elevenwebsite';
$con=mysqli_connect($hname,$uname,$pass,$db);

if(!$con){
die("Cannot Connect to Database".mysqli_connect_error());
}

function filteration($data){
    foreach($data as $key => $value){
      $value = trim($value);
      $value = stripcslashes($value);
      $value = htmlspecialchars($value);
      $value = strip_tags($value);
      $data[$key] = $value;

    }
    return $data;
}
function select($sql,$values,$datatypes)
{
    $con = $GLOBALS['con'];
    if($stmt = mysqli_prepare($con,$sql))
    {
        mysqli_stmt_bind_param($stmt,$datatypes,...$values);
        if(mysqli_stmt_execute($stmt)){
            $res = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        }
        else{
            mysqli_stmt_close($stmt);
            die("Query cannot be excuted - select");
        }
    }
    else{
        die("Query cannot be prepared - select");
    }
}

function update($sql,$values,$datatypes){
    $con = $GLOBALS['con'];
    if($stmt = mysqli_prepare($con,$sql))
    {
        mysqli_stmt_bind_param($stmt,$datatypes,...$values);
        if(mysqli_stmt_execute($stmt)){
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        }
        else{
            mysqli_stmt_close($stmt);
            die("Query cannot be excuted - update");
        }
    }
    else{
        die("Query cannot be prepared - update");
    }
}
function insert($sql,$values,$datatypes){
    $con = $GLOBALS['con'];
    if($stmt = mysqli_prepare($con,$sql))
    {
        mysqli_stmt_bind_param($stmt,$datatypes,...$values);
        if(mysqli_stmt_execute($stmt)){
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        }
        else{
            mysqli_stmt_close($stmt);
            die("Query cannot be excuted - insert");
        }
    }
    else{
        die("Query cannot be prepared - in sot");
    }
}
function selectAll($table){
    $con = $GLOBALS['con'];
    $res = mysqli_query($con,"SELECT * FROM $table");
    return $res;
}
function delete($sql, $values, $datatypes){
    $con = $GLOBALS['con'];
    if($stmt = mysqli_prepare($con,$sql))
    {
        mysqli_stmt_bind_param($stmt,$datatypes,...$values);
        if(mysqli_stmt_execute($stmt)){
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        }
        else{
            mysqli_stmt_close($stmt);
            die("Query cannot be excuted - delete");
        }
    }
    else{
        die("Query cannot be prepared - delete");
    }
}

?>