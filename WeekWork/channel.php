<br>
            <table class="time_table" style="width: 80%;table-layout: fixed;height: 200px;display: table; margin-left: auto; margin-right: auto" >
                <tr class="" style="border-radius: 10px 0 0 0; ">
                    <!-- 학교제목  -->
                    <td  class="content"  style="color: white;background-color: #59c2d8;height:70px;width:10%;border-radius:10px 0 0 0; border-left-style:none;border-top-style:none;   font-weight: bold;font-size:25px "> 학교 </td>

                    <!-- 학교   -->
                    <td  class="content"    style="width:30%; font-weight: bold;font-size:15px "><?php
                    echo $_SESSION['school'];
                    ?>
                    </td>

                    <!-- 검색리스트  -->
                    <td    class="content" style=" width:60%;  border-radius: 0 10px 0 0;"><?php

                    $sql = "SELECT * FROM w_channel WHERE ";
                    $sql = $sql . "school_no='" . $_SESSION['school_id'] . "'";
                    $result = mysql_query($sql);
                    $results;
                    $ch_login_list = array();
                    while ($row = mysql_fetch_array($result)) {
                        // if($row['grade']==0)
                        // $ch_login_list['school'] = array('grade'=>$row['grade'],'ch_id' => $row['ch_id'], 'pw' => $row['pw']);
                        // else if($row['grade']==10)
                        // $ch_login_list['me'] = array('grade'=>$row['grade'],'ch_id' => $row['ch_id'], 'pw' => $row['pw']);
                        // else
                        // $ch_login_list['grade'] = array('grade'=>$row['grade'],'ch_id' => $row['ch_id'], 'pw' => $row['pw']);

                        $ch_login_list[$row['grade']] = array('grade' => $row['grade'], 'ch_id' => $row['ch_id'], 'pw' => $row['pw']);
                    }

                    //로그인 됨  ch_school!=0 or ch_grade!=0
                    if ($_SESSION['ch_school'] != 0) {
                        echo '로그인됨(코드:' . $ch_login_list[0]['pw'] . ')';
                    } else {
                        //채널이 생성 안됨  w_channel테이블의 school_no 컬럼이 일치하는 row가 없음.
                        echo '
                          <div class="form-group" id="sign_school" style="display:block">
                           <h5 id="ch_name" style="white-space: pre-wrap">';
                        if (!empty($ch_login_list[0]))
                            echo '학교 채널 생성자가 정한 학교코드를 입력해주세요.';
                        else {
                            echo '학교 채널이 생성되지 않았습니다.<br> 학교 코드를 생성해주세요.';
                        }
                        echo '</h4>
                                
                                
                            <div class="col-sm-8">
                                <input type="text" id="school_pw" class="form-control numeric" placeholder="숫자 네자리" maxlength="4" style="ime-mode:disabled;"/>
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-success form-control" onclick="';
                        if (!empty($ch_login_list[0]))
                            echo 'login_ch(0,' . $ch_login_list[0]['ch_id'] . ')';
                        else {
                            echo 'sign_ch(0,' . $_SESSION['school_id'] . ')';
                        }

                        echo '">';
                        if (!empty($ch_login_list[0]))
                            echo '로그인';
                        else {
                            echo '암호생성';
                        }

                        echo '</button>
                            </div>
                        </div>
                        ';
                    }
                        ?>
                      
                     
                    </td>
                </tr>
                <tr style="">
                    <!-- 학년제목  -->
                    <td  class="content"  style="color: white; background-color: #59c2d8; width:10%;border-radius:0 0 0 10px; border-left-style:none;border-bottom-style:none; font-weight: bold;font-size:25px "> 학년 </td>

                    <!-- 학년 리스트  -->
                    <td  class="content"  style=" width:40%; border-left-color:white; font-weight: bold;font-size:15px "><?php
                    // if (count($ch_ids) > 1) {
                    // for ($i = 1; $i < count($ch_ids); $i++) {
                    //
                    // echo "<button class='btn btn-default' style='margin-bottom:10px;height:70px;font-size:20px;' onclick='channel()'>" . $ch_names[$i] . "(재설정)</button>";
                    // }
                    // } else if (count($ch_ids) == 1) {
                    // echo "<button class='btn btn-info' style='height:70px;font-size:30px;' onclick='channel()' >+</button>";
                    // }
                    if ($_SESSION['grade'] == 10)
                        echo '교무실';
                    else if ($_SESSION['grade'] == 100)
                        echo '행정실';
                    else
                        echo $_SESSION['grade'] . '학년';
                    ?></td>
                    
                    <td    class="content" style=" width:50%; border-radius: 0 0 10px 0;"><?php

                    if ($_SESSION['ch_grade'] != 0) {
                        echo '로그인됨(코드:' . $ch_login_list[$_SESSION['grade']]['pw'] . ')';
                    } else {
                        //채널이 생성 안됨  w_channel테이블의 school_no 컬럼이 일치하는 row가 없음.
                        echo '
                          <div class="form-group" id="sign_school" style="display:block">
                           <h5 id="ch_name" style="white-space: pre-wrap">';
                        if (!empty($ch_login_list[$_SESSION['grade']])) {
                            $grade = "";
                            if ($_SESSION['grade'] == 10)
                                $grade = '교무실';
                            else if ($_SESSION['grade'] == 100)
                                $grade = '행정실';
                            else
                                $grade = $_SESSION['grade'] . '학년';
                            echo $grade . ' 채널 생성자가 정한 코드를 입력해주세요.';
                        } else {
                            $grade = "";
                            if ($_SESSION['grade'] == 10)
                                $grade = '교무실';
                            else if ($_SESSION['grade'] == 100)
                                $grade = '행정실';
                            else
                                $grade = $_SESSION['grade'] . '학년';

                            echo $grade . ' 채널이 생성되지 않았습니다. <br>채널의 코드를 생성해주세요.';
                        }
                        echo '</h4>
                                
                                
                            <div class="col-sm-8">
                            
                                <input type="text" id="grade_pw" class="form-control numeric" placeholder="숫자 네자리" maxlength="4" style="ime-mode:disabled;"/>
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-success form-control" onclick="';
                        if (!empty($ch_login_list[$_SESSION['grade']]))
                            echo 'login_ch(' . $ch_login_list[$_SESSION['grade']]['grade'] . ',' . $ch_login_list[$_SESSION['grade']]['ch_id'] . ')';
                        else {
                            echo 'sign_ch(' . $_SESSION['grade'] . ',' . $_SESSION['school_id'] . ')';

                        }

                        echo '">';
                        if (!empty($ch_login_list[$_SESSION['grade']]))
                            echo '로그인';
                        else {
                            echo '암호생성';
                        }

                        echo '</button>
                            </div>
                        </div>
                        ';
                    }
                        ?>
                      
                     
                    </td>
                </tr>
            </table>
            
             <script src="./sign.js"></script>
<script>var school_pw =  '<?= $ch_login_list[0]['pw'] ?>';
        var grade_pw =  '<?= $ch_login_list[$_SESSION['grade']]['pw'] ?>';
    </script>
            <?php
            include_once ("./tail.php");
        ?>