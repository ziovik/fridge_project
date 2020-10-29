 <?php
                              date_default_timezone_set('Europe/Moscow');
                              $dt = date('Y-m-d H:i:s');
                              $date = substr($dt, 0, -9);
                     
                              $date_new = date('Y-m-d H:i:s', strtotime($date . ' +1 day'));
                              $date2 = substr($date_new, 0, -9);

                              $time = '08:00:00';

                              $datetime1 = $date .' '.$time ;
                              $datetime2 = $date2 .' '.$time ;
                              $fridge_id = $row['id'];
                              $sql = "
                                       SELECT 
                                         * 
                                       FROM fridge_power 
                                       WHERE fridge_id = '$fridge_id'
                                       AND datetime_compare BETWEEN '$datetime1' AND '$datetime2'
                                       ORDER BY datetime_compare ASC
                                     ";
                              $run = mysqli_query($con, $sql);
                              $count = mysqli_num_rows($run);
                              if($count >=1){
                                while($rows = mysqli_fetch_assoc($run)){
                                  $status = $rows['status1'];
                                  $begin_time1 = $rows['begin_time1'];
                                 

                                  $end_time1 = $rows['end_time1'];

                                  $begin_time2 = $rows['begin_time2'];

                                  $end_time2 = $rows['end_time2'];
                                 
                                  ?>
                              <table>
                                <tr>
                                  <td>
                                     <div class="modal-body">
                                        <div class="input-group">
                                          <div class=" one_third first">
                                             <input type="text" id="beg_time" name="begin_time1" class="form-control" value="<?php echo $begin_time1 ?>" readonly/>
                                          </div>
                                          <div class=" one_third" style="text-align: center;">

                                            <input type="hidden"   id="fridge1"  name="fridgeId"> 
                                            <input onclick="fridge('<?php echo $row['id'] ?>')"   id="clc" class="btn"  type="submit" name="submit1" value="Go" style="width: 50px;cursor: pointer;">
                                             &nbsp;
                                          </div>
                                          <div class=" one_third">
                                            <input type="text" id="end_time" name="end_time1" class="form-control" value="<?php echo $end_time1 ?>" readonly/>
                                          </div>
                                        </div>
                                      </div>
                                  </td>
                                  <td>
                                    <div class="modal-body">
                                      <div class="input-group">
                                        <div class=" one_third first">
                                          <input type="text" name="begin_time2" class="form-control"  value="<?php echo $begin_time2 ?>" readonly/>
                                        </div>
                                       <div class=" one_third " style="text-align: center;">
                                          <div class="input-group-addon" > 
                                            <a  style="width: 70px;text-align: center; font-size: 14px;padding: 5px"  class="btn btn-success addMore"> Go</a>
                                          </div>
                                        </div>
                                         <div class=" one_third">
                                          <input type="text" name="end_time2" class="form-control" value="<?php echo $end_time2 ?>" readonly/>
                                         </div>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                              </table>
                              <?php
                              }


                            }else{
                              echo 'empty';
                            }
                          ?>