<?php
if (empty($_SESSION['is_logged']) || $_SESSION['is_logged'] == FALSE) {
    header("location:index.php");
    exit ;
}

if ($_SESSION['ch_school'] == 0 || $_SESSION['ch_grade'] == 0) {
    echo "<script>";
    echo "if(!alert('학교와 학년 로그인이 필요합니다.'))";
    echo "location.href='channel.php';";
    echo "</script>";
}

// $sql = "SELECT ch_id,ch_name FROM w_channel WHERE ";
// $sql = $sql . "ch_id='" . $_SESSION['w_ch1'] . "'";
// $sql = $sql . " OR ch_id='" . $_SESSION['w_ch2'] . "'";
// $sql = $sql . " OR ch_id='" . $_SESSION['w_ch3'] . "'";
// $sql = $sql . " OR ch_id='" . $_SESSION['w_ch4'] . "'";
// $sql = $sql . " OR ch_id='" . $_SESSION['w_ch5'] . "'";
// $result = mysql_query($sql);
// while ($row = mysql_fetch_array($result)) {
// $ch_ids[] = $row['ch_id'];
// $ch_names[] = $row['ch_name'];
// }
$ch_ids = array($_SESSION['ch_school'], $_SESSION['ch_grade'], $_SESSION['ch_me']);
if ($_SESSION['grade'] == 10)
    $temp_grade = '교무실';
else if ($_SESSION['grade'] == 100)
    $temp_grade = '행정실';
else {
    $temp_grade = $_SESSION['grade'] . '학년';
}
$ch_names = array('학교', $temp_grade, $_SESSION['name']);
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

$eventyear1 = new DateTime($weeks[0]);
$eventyear = $eventyear1 -> format("Y");
?>

<script>var year =   '<?= $eventyear ?>';</script>

<LINK REL="SHORTCUT ICON" HREF="./favicon.ico" />
<header id="header">

    <logo>
        <a href="./login.php"></a>
    </logo>
    <nav id="mainMenu">
        <ul>

            <li > 
                <a href="http://alim.dothome.co.kr/today.php"><span style="color:#eb625e" >알림장</span></a>
            </li>
            <li>
                <a href="week.php?week=<?php echo(int)$this_week - 1; ?>" class="glyphicon-text glyphicon-arrow-left"></a>
            </li>
            
            <li>
                <a href="week.php?week=<?php echo(int)$this_week + 1; ?>" class="glyphicon-text glyphicon-arrow-right"></a>
            </li>
           
            <li >
                <a href="week.php">WeekWork</a>
            </li>
            <li >
                <a href="channel.php">학년 설정</a>
            </li>
            <li >
                <a href="http://alim.dothome.co.kr/help_weekwork.php">고객지원</a>
            </li>
            <li >
                <a href="account.php"><?php echo $_SESSION['name']; ?></a>
            </li>

        </ul>
    </nav>
</header>