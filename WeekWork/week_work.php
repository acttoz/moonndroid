 
                                <table width="100%;">
                                    <tr>
                                        <td style="width:70%;">
                                            <h2 id="workDate" style="margin-top: 10px" user="<?php echo $_SESSION["id"]; ?>" >제목</h2> 
                                        </td>
                                        <td style="width: 30%;text-align: right">
                                            <button style="height:35px;width:150px;" type="button"  class="btn btn-success" onclick="toMyWork()">나의 할일로 등록</button>
                                        </td>
                                    </tr>                                    
                                </table>
                                <input id="work_id" type="hidden" name="work_id" value=<?php
                                if (isset($_REQUEST['work_id'])) {
                                    echo $_REQUEST['work_id'];
                                } else {
                                    echo 0;
                                }
                                ?>/>
                                <input id="flag_select" type="hidden" name="select" value="upload"/>
                                <input id="work_day" type="hidden" name="work_day" value=0/>
                                <input id="work_ch_id" type="hidden" name="work_ch_id" value=0/>
                                 <table class="time_table" style="table-layout: fixed" align="center"  >
                                    <tr class="" style="border-radius: 10px 0 0 0; ">
                                        <td   class="content " style=" width:7%;border-top-style:none;border-left-style:none; border-right-color:white; border-bottom-color:white; border-radius: 10px 0 0 0; font-weight: bold;font-size:20px ">
                                           
                                            <button id="work_complete_btn" style="height: 50px;padding:inherit ;text-align: center;" type="button" class="btn btn-info has-spinner glyphicon">
                                            </button>
                                         </td>
                                        <td  class="content"  style="width:40%;border-top-style:none;border-left-color:white;  border-bottom-color:white; font-weight: bold;font-size:20px ">
                                            <input id="work_title" style="height:40px;width:100%;" type="text" name="work_name" placeholder="제목"/>
                                            </td>
                                         
                                        
                                        <td rowspan="2"  class="content" style="vertical-align:top;  width:70%;border-top-style:none; border-right-style:none; border-radius: 0 10px 0 0;">
                                            <div id="reply" style="text-align:left; overflow-y:scroll;margin:10px;">
                                            
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="" style="border-radius: 10px 0 0 0; ">
                                        <td class="content " id="work_content_td" colspan="2" style="border-bottom-style:none;border-left-style:none;">
                                                <textarea class="contents" type="text" name="work_content" id="work_content" placeholder="내용" ></textarea>                                                                                           
                                                <p style="white-space: pre-wrap" class="contents" id="work_content_view"></p>                                                                                           
                                         </td>    
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="content" style="width:15%;border-left-style:none;border-top-style:none;border-bottom-color:white; ">
                                            <input class="file" type="file" name="file" id="work_file_add" style="display:none"/>
                                            <div id="work_file_btns" class="btn-group" style="display:none; width:100%;">
                                             <button id="work_file_down" class="btn btn-info" type="button" style="width:88%;height:35px" >
                                                 첨부파일
                                                 </button>
                                             <button id="work_file_del" class="btn btn-danger glyphicon glyphicon-trash" type="button" style="width:12%;height:35px" >

                                                 </button>
                                             </div>
                                         </td> 
                                        <td class="content" style="width:15%;border-right-style:none;border-top-style:none;border-bottom-color:white; ">
                                              <div class="form-group" style="">
                                            <div class="col-sm-12">
                                            <input class="file" type="file" name="reply_file" id="reply_file_add"  />
                                            </div>
                                            </div>
                                         </td> 
                                    </tr>
                                    <tr>
                                          <td colspan="2"  class="content" style="width:40%;border-left-style:none;border-bottom-style:none;   font-weight: bold;font-size:10px;border-radius: 0 0 0 10px  ;  ">
                                             <div class="btn-group" style=" width:100%;">
                                            <button id="work_edit_btn" type="button" style="width:80%;height: 50px;" class="btn btn-info" onclick="editMode()">
                                                                                        수정
                                            </button>
                                            <button id="work_save_btn" name="submit" style="width:80%;height: 50px;display:none" type="submit" class="btn btn-info btn-warning" >
                                                                                        저장
                                            </button>
                                            <button id="work_delete_btn" style="width:20%;height: 50px;" type="button" class="btn btn-danger glyphicon glyphicon-trash">
                                            </button>
                                            </div>
                                         </td>
                                         <td class="content"  style="width:10%;border-bottom-style:none;border-right-style:none; border-left-color:white; border-radius: 0 0 10px  0;">
                                            <div class="form-group" style="">
                                                <div class="col-sm-9">
                                                    <textarea id="reply_input" type="text" name="reply_content" style="height:50px; width:100%" class="form-control"   checked="0" placeholder="댓글을 입력하세요."></textarea>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input id="reply_submit" class = "btn btn-info form-control" type="submit" name="submit" style="margin-top:1px;width: 100%px;height:50px;" value="저장"/>
                                                </div>
                                            </div>
                                          </td>
                                    </tr>
                                </table>
                               