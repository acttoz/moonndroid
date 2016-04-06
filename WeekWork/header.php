<?php

if(empty($_SESSION['ch1'])){
    echo "<script>";
    echo "if(!alert('기본 채널(학교)을 선택해야 이용이 가능합니다.'))";
    echo "location.href='channel.php';";
    echo "</script>";
    // header("Location:channel.php");
    // exit;
}


$sql = "SELECT ch_id,ch_name FROM w_channel WHERE ";
$sql = $sql . "ch_id='" . $_SESSION['ch1'] . "'";
$sql = $sql . " OR ch_id='" . $_SESSION['ch2'] . "'";
$sql = $sql . " OR ch_id='" . $_SESSION['ch3'] . "'";
$sql = $sql . " OR ch_id='" . $_SESSION['ch4'] . "'";
$sql = $sql . " OR ch_id='" . $_SESSION['ch5'] . "'";
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result)) {
    $ch_ids[] = $row['ch_id'];
    $ch_names[] = $row['ch_name'];
}

if (empty($_REQUEST['week'])) {
    $this_week = 0;
}else{
    $this_week=$_REQUEST['week'];
}

$tempweek = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday');
for ($i = 0; $i < 5; $i++) {
    $weeks[] = date("Y-m-d", strtotime($tempweek[$i].' '.$this_week.' week'));
}
?>

<LINK REL="SHORTCUT ICON" HREF="./favicon.ico" />
<header id="header">

    <logo>
        <a href="./week.php"></a>
    </logo>
    <nav id="mainMenu">
        <ul>

            <li >
                <a href="week.php?week=<?php echo (int)$this_week-4;?>" class="glyphicon-text glyphicon-fast-backward"></a>
            </li>
            <li>
                <a href="week.php?week=<?php echo (int)$this_week-1;?>" class="glyphicon-text glyphicon-arrow-left"></a>
            </li>
            <li>
                <a href="week.php?week=<?php echo (int)$this_week+1;?>" class="glyphicon-text glyphicon-arrow-right"></a>
            </li>
            <li>
                <a href="week.php?week=<?php echo (int)$this_week+4;?>" class="glyphicon-text glyphicon-fast-forward"></a>
            </li>
            <li>
            </li>
            <li >
                <a href="week.php">WeekWork</a>
            </li>
            <li >
                <a href="#">채널 설정</a>
            </li>
            <li >
                <a href="#">질문&답변</a>
            </li>
            <li >
                <a href="#">계정 관리</a>
            </li>

        </ul>
    </nav>
</header>