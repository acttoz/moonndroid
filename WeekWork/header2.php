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
                   
                    <li >
                        <a href="week.php">위크워크</a>
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