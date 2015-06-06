<?php 

$_CFG = array();
$_CFG['host'] = 'localhost';
$_CFG['user'] = 'root';
$_CFG['pwd'] = '111111';



$conn = mysql_connect($_CFG['host'],$_CFG['user'],$_CFG['pwd']);

mysql_query('use xrun', $conn);
mysql_query('set names utf8', $conn);



if(empty($_POST['unm'])||empty($_POST['pwd'])) {
    exit('请填写完整用户名和密码');
}
if($_POST['unm']){
        $sql = 'select * from user'." where username = '".$_POST['unm']."'";
        
         
         $rs = mysql_query($sql,$conn);
         $row = mysql_fetch_row($rs);
        if(!empty($row)){echo'该用户名已被注册';exit;}
       
        
     }
	
        

$data = array();
$data['username'] = $_POST['unm'];
$data['passwd'] = $_POST['pwd'];
$data['regtime'] = date('ymdhis');
$data['location'] = $_POST['location'];
$data['tel'] = $_POST['tel'];


$data['email'] = $_POST['eml'];


 $sql2 = 'insert into user' . ' (' . implode(',',array_keys($data)) . ')';
 $sql2 .= ' values (\'';
 $sql2 .= implode("','",array_values($data));
 $sql2 .= '\')';


if(mysql_query($sql2, $conn)){
	echo "注册成功";
}
