<?php
$sql = "SELECT ch_id,ch_name FROM channel WHERE ";
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
?>
<LINK REL="SHORTCUT ICON" HREF="./favicon.ico" />
<header id="header">

    <logo>
        <a href="" title="스피드알림장3">스피드알림장3</a>
    </logo>
    <nav id="mainMenu">
        <ul>

            <li >
                <a href="#">WeekWork</a>
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