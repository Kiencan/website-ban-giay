<?php
// Các hàm sử lý liên quan đến database
if (!defined('_CODE')) {
    die('Access denied');
}

function query($sql, $data = [], $check = false)
{
    global $conn;
    $result = false;
    try {
        $statement = $conn->prepare($sql);

        if (!empty($data)) {
            $result = $statement->execute($data);
        } else {
            $result = $statement->execute();
        }
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        echo 'File ' . $exception->getFile() . '<br>';
        echo 'Line ' . $exception->getLine();
        die();
    }

    if ($check) {
        return $statement;
    }
    return $result;
}

//insert vào database
function insert($table, $data)
{
    $key = array_keys($data);
    $field = implode(',', $key);
    $valuetb = ":" . implode(',:', $key);

    $sql = 'INSERT INTO ' . $table . '(' . $field . ')' . ' VALUES' . '(' . $valuetb . ')';
    $result = query($sql, $data);
    return $result;
}

//update database
function update($table, $data, $condition)
{
    $update = '';
    foreach ($data as $key => $value) {
        $update .= $key . ' = :' . $key . ', ';
    }
    $update = trim($update, ', ');
    if (!empty($update)) {
        $sql = 'UPDATE ' . $table . ' SET ' . $update . ' WHERE ' . $condition;
    } else {
        $sql = 'UPDATE ' . $table . ' SET ' . $update;
    }

    $result = query($sql, $data);
    return $result;
}

//delete database
function delete($table, $condition)
{
    if (empty($condition)) {
        $sql = 'DELETE FROM ' . $table;
    } else {
        $sql = 'DELETE FROM ' . $table . ' WHERE ' . $condition;
    }
    $result = query($sql);
    return $result;
}

//select database

// TH1: Lấy nhiều dòng dữ liệu
function getRaw($sql)
{
    $result = query($sql, '', true);
    if (is_object($result)) {
        $datafetch = $result->fetchAll(PDO::FETCH_ASSOC);
    }
    return $datafetch;
}

// TH2: Lấy 1 dòng dữ liệu
function oneRaw($sql)
{
    $result = query($sql, '', true);
    if (is_object($result)) {
        $datafetch = $result->fetch(PDO::FETCH_ASSOC);
    }
    return $datafetch;
}

// TH3: đếm số dòng dữ liệu
function getRows($sql)
{
    $result = query($sql, '', true);
    if (!empty($result)) {
        return $result->rowCount();
    }
}
