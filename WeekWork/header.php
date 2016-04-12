<?php
if (empty($_SESSION['w_is_logged']) || $_SESSION['w_is_logged'] == FALSE) {
    header("location:index.php");
    exit ;
}

if (empty($_SESSION['w_ch1'])) {
    echo "<script>";
    echo "if(!alert('기본 학년(학교)을 선택해야 이용이 가능합니다.'))";
    echo "location.href='channel.php';";
    echo "</script>";
    // header("Location:channel.php");
    // exit;
}

$sql = "SELECT ch_id,ch_name FROM w_channel WHERE ";
$sql = $sql . "ch_id='" . $_SESSION['w_ch1'] . "'";
$sql = $sql . " OR ch_id='" . $_SESSION['w_ch2'] . "'";
$sql = $sql . " OR ch_id='" . $_SESSION['w_ch3'] . "'";
$sql = $sql . " OR ch_id='" . $_SESSION['w_ch4'] . "'";
$sql = $sql . " OR ch_id='" . $_SESSION['w_ch5'] . "'";
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result)) {
    $ch_ids[] = $row['ch_id'];
    $ch_names[] = $row['ch_name'];
}
$ddate = date('Y-m-d');
$date = new DateTime($ddate);
$week = $date -> format("W");
$year = $date -> format("y");
if (empty($_REQUEST['week'])) {

    echo $array[0];
    echo $array[1];

    $this_week = 0;
} else {
    $this_week = $_REQUEST['week'];
}
$week += $this_week;

$weeks = getStartAndEndDate($week, $year);
function getStartAndEndDate($week, $year) {

    $time = strtotime("1 January $year", time());
    $day = date('w', $time);
    $time += ((7 * $week) + 1 - $day) * 24 * 3600;

    for ($i = 0; $i < 5; $i++) {
        $return[$i] = date('Y-m-d', $time);
        $time += 24 * 3600;
    }
    return $return;
}

?>

<LINK REL="SHORTCUT ICON" HREF="./favicon.ico" />
<header id="header">

    <logo>
        <a href="./index.php"></a>
    </logo>
    <nav id="mainMenu">
        <ul>

            <li >
                <a href="week.php?week=<?php echo(int)$this_week - 4; ?>" class="glyphicon-text glyphicon-fast-backward"></a>
            </li>
            <li>
                <a href="week.php?week=<?php echo(int)$this_week - 1; ?>" class="glyphicon-text glyphicon-arrow-left"></a>
            </li>
            <li>
                <a href="week.php" class="glyphicon-text glyphicon-stop"></a>
            </li>
            <li>
                <a href="week.php?week=<?php echo(int)$this_week + 1; ?>" class="glyphicon-text glyphicon-arrow-right"></a>
            </li>
            <li>
                <a href="week.php?week=<?php echo(int)$this_week + 4; ?>" class="glyphicon-text glyphicon-fast-forward"></a>
            </li>
            <li>
            </li>
            <li >
                <a href="week.php">WeekWork</a>
            </li>
            <li >
                <a href="channel.php">학년 설정</a>
            </li>
            <li >
                <a href="qna.php">질문 게시판</a>
            </li>
            <li >
                <a href="account.php"><?php echo $_SESSION['w_name']; ?></a>
            </li>

        </ul>
    </nav>
</header>