<?php
/**
 *  Purpose: multiple functions for handling databases
 *  Authors: Hui, Debora, Jihye, Xiong, Jane
 *  Data:    Feb 10, 2019
 *
 */

function connect_db()
{
    $db_conn = new mysqli("localhost", "lamp2user", "Test123!", "microwave_path_data");
    if ($db_conn->connect_errno) {
        printf("Could not connect to database server\n Error: "
            . $db_conn->connect_errno . "\n Report: "
            . $db_conn->connect_error . "\n");
        die;
    }
    return $db_conn;
}

//discnnect database
function disconnect_db($db_conn)
{
    $db_conn->close();
}

//db_insert()
function db_insert($db_conn, $qry)
{

    $db_conn->query($qry);

    return mysqli_affected_rows($db_conn) ? mysqli_insert_id($db_conn) : false;
}

//db_trans_exec()
function db_trans_exec($db_conn, $qryArr)
{

    $db_conn->autocommit(false);

    $results = [];

    foreach ($qryArr as $qry) {
        $results[] = $db_conn->query($qry)?0:1;
    }

    if (!array_sum($results)) {
        $db_conn->commit();
        return true;
    } else {
        $db_conn->rollback();
        echo '{ "code": "1251" ,"data":{"msg":"Fail to execute SQL "}}';
        return false;
    }
}

//db_select(column)
function db_select($db_conn,$tableName,$objColName,$conColName,$condition){

    $sel_qry = "select ".$objColName." from ".$tableName." where ".$conColName."= '".$condition."';";

    $result = $db_conn->query($sel_qry);
    $colData = array();

    if($result->num_rows>0){
        while($row = $result->fetch_assoc()){
            array_push($colData,$row[$objColName]);
        }
    }
    return $colData;
}


//db_select_oneCol
function db_select_oneCol($db_conn,$tableName,$objColName){

    $sel_qry = "select ".$objColName." from ".$tableName.";";

    $result = $db_conn->query($sel_qry);
    $colData = array();

    if($result->num_rows>0){
        while($row = $result->fetch_assoc()){
            array_push($colData,$row[$objColName]);
        }
    }
    return $colData;
}
?>