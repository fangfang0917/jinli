<?php
/**
 * 自动生成mysql数据字典
 */
header("Content-type: text/html; charset=utf-8");
//配置数据库
$dbserver = "127.0.0.1";
$dbusername = "jinli_db"; // 数据库连接账号
$dbpassword = "scJzthyFApAFXpPS"; // 数据库连接密码
$database = "jinli_db"; // 数据库名
// 连接数据库
$mysql_conn = mysqli_connect("$dbserver", "$dbusername", "$dbpassword", "$database") or die("Mysql connect is error.");
mysqli_query($mysql_conn, 'SET NAMES utf8');
$table_result = mysqli_query($mysql_conn, 'show tables');
$no_show_table = array(); // 不需要显示的表
$no_show_field = array(); // 不需要显示的字段
//取得所有的表名
$tables = array();
while ($row = mysqli_fetch_array($table_result)) {
    if (!in_array($row[0], $no_show_table)) {
        $tables[]['TABLE_NAME'] = $row[0];
    }
}
//循环取得所有表的备注及表中列信息
foreach ($tables as $k => $v) {
    $sql = 'SELECT * FROM ';
    $sql .= 'INFORMATION_SCHEMA.TABLES ';
    $sql .= 'WHERE ';
    $sql .= "table_name = '{$v['TABLE_NAME']}'  AND table_schema = '{$database}'";
    $table_result = mysqli_query($mysql_conn, $sql);
    while ($t = mysqli_fetch_array($table_result)) {
        $tables[$k]['TABLE_COMMENT'] = $t['TABLE_COMMENT'];
    }
    $sql = 'SELECT * FROM ';
    $sql .= 'INFORMATION_SCHEMA.COLUMNS ';
    $sql .= 'WHERE ';
    $sql .= "table_name = '{$v['TABLE_NAME']}' AND table_schema = '{$database}'";
    $fields = array();
    $field_result = mysqli_query($mysql_conn, $sql);
    while ($t = mysqli_fetch_array($field_result)) {
        $fields[] = $t;
    }
    $tables[$k]['COLUMN'] = $fields;
}
mysqli_close($mysql_conn);
$html = '';
//循环所有表
foreach ($tables as $k => $v) {
    if (!in_array($v['TABLE_NAME'], $no_show_table)) {
        $html .= '<h3>' . ($k + 1) . '、' . $v['TABLE_COMMENT'] . ' (' . $v['TABLE_NAME'] . ')</h3>';
        $html .= '<table border="1" cellspacing="0" cellpadding="0" width="100%">';
        $html .= '<tbody>';
        $html .= '<tr>';
        $html .= '<th>字段名</th>';
        $html .= '<th>数据类型</th>';
        $html .= '<th>默认值</th>';
        $html .= '<th>允许非空</th>';
        $html .= '<th>自动递增</th>';
        $html .= '<th>备注</th>';
        $html .= '</tr>';
        foreach ($v['COLUMN'] as $f) {
            if (!in_array($f['COLUMN_NAME'], $no_show_field)) {
                $html .= '<tr>';
                $html .= '<td class="c1">' . $f['COLUMN_NAME'] . '</td>';
                $html .= '<td class="c2">' . $f['COLUMN_TYPE'] . '</td>';
                $html .= '<td class="c3">' . $f['COLUMN_DEFAULT'] . '</td>';
                $html .= '<td class="c4">' . $f['IS_NULLABLE'] . '</td>';
                $html .= '<td class="c5">' . ($f['EXTRA'] == 'auto_increment' ? '是' : '&nbsp;') . '</td>';
                $html .= '<td class="c6">' . $f['COLUMN_COMMENT'] . '</td>';
                $html .= '</tr>';
            }
        }
        $html .= '</tbody>';
        $html .= '</table>';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>数据字典</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <style>
        body, td, th {
            font-family: "微软雅黑";
            font-size: 14px;
        }

        .warp {
            margin: auto;
            width: 900px;
        }

        .warp h3 {
            margin: 0px;
            padding: 0px;
            line-height: 30px;
            margin-top: 10px;
        }

        table {
            border-collapse: collapse;
            border: 1px solid #CCC;
            background: #efefef;
        }

        table th {
            text-align: left;
            font-weight: bold;
            height: 26px;
            line-height: 26px;
            font-size: 14px;
            text-align: center;
            border: 1px solid #CCC;
            padding: 5px;
        }

        table td {
            height: 20px;
            font-size: 14px;
            border: 1px solid #CCC;
            background-color: #fff;
            padding: 5px;
        }

        .c1 {
            width: 120px;
        }

        .c2 {
            width: 120px;
        }

        .c3 {
            width: 150px;
        }

        .c4 {
            width: 80px;
            text-align: center;
        }

        .c5 {
            width: 80px;
            text-align: center;
        }

        .c6 {
            width: 270px;
        }
    </style>
</head>
<body>
<div class="warp">
    <h1 style="text-align:center;">数据字典自动生成</h1>
    <?php echo $html; ?>
</div>
</body>
</html>