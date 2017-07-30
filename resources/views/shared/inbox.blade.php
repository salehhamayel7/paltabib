
@extends(($user->role == 'Doctor')? 'doctor.layouts.master': (($user->role == 'Secretary') ? 'secretary.layouts.master' :(($user->role == 'Pacient') ? 'patient.layouts.master' : 'manager.layouts.master' ) ))


@section('content')

<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=rovlmdt59qy1yhzqi3f9o1c7lgiwgb38yd00ubv2sd6zmlrm"></script>
<script>
  
tinymce.init({ 
    selector:'textarea',
    plugins : 'advlist autolink link image lists charmap print preview',
    height: 200,
    theme: 'modern',
  });
</script>

<?php

use App\User;

if(count($msgs) == 0){
  $noMsgs = true;
}
else{
  $noMsgs = false; 
}

?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="page-content">

            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12" style="width: 100%;">
                <div class="x_panel">
                  <div class="x_title">
                   
                    <ul class="nav navbar-left panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                     <h2 style="float:right;">البريد الوارد</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <div style="float:right;" class="col-sm-3 mail_list_column">
                        <button id="compose" class="btn btn-sm btn-success btn-block" type="button">رسالة جديدة</button>
                        @if(!$noMsgs)
                        @foreach($msgs as $msg)
                       
                        <a class="showmsg" msgid="{{ $msg->msg_id }}">
                          <div class="mail_list" style="<?php if(!$msg->seen) echo 'background-color: #ecfdea;'; ?>">
                            
                            <div class="right">
                              <h3 style="display:inline-block;"> {{$msg->name}} </h3>
                              <small class="pull-left"> {{$msg->msg_time }} </small>
                              <p style="<?php if(!$msg->seen) echo 'font-weight: bold;'; ?>">{{$msg->title}}</p>
                            </div>
                          </div>
                        </a>

                        @endforeach
                        {{$msgs->links()}}
                         @endif
                      </div>
                      <!-- /MAIL LIST -->

                      <!-- CONTENT MAIL -->
                      <div class="col-sm-9 mail_view">
                         @if(!$noMsgs)
                        <div class="inbox-body">
                          <div class="mail_heading row">
                            <div class="col-md-8">
                              <div class="btn-group">
                                <button id="replyMsg" data="{{ $currentmsg->msg_id }}" class="btn btn-sm btn-primary" type="button"><i class="fa fa-reply"></i> رد</button>
                                <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
                                <a href="/message/delete/receiver/{{ $currentmsg->msg_id }}" id="deleteMSG" class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></a>
                              </div>
                            </div>
                            <div class="col-md-4 text-right msgTitle" id="msgtitle">
                              <p>{{ $currentmsg->title}}</p>
                            </div>
                            
                          </div>
                           <hr style="margin-top: 0px;"/>

                          <div class="sender-info">
                            <div class="row">
                              <div class="col-md-12 msgHeader">
                                <strong>المرسل: </strong>
                                <span id="sender_name">{{ $currentmsg->name }}</span>
                                <br>
                                <strong>الايميل: </strong>
                                <span id="sender_mail">{{ $currentmsg->email }}</span>
                                <p class="date pull-left">{{ $currentmsg->msg_time}}</p>

                              </div>
                               
                            </div>
                          </div>
                          <div id="msgbody" class="view-mail">
                            <?php
                                echo htmlspecialchars_decode($currentmsg->message);
                            ?>
                            
                           </div>                        
                        </div>
                         @endif
                      </div>
                      <!-- /CONTENT MAIL -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

<!-- compose -->
<div class="compose col-md-6 col-xs-12">
  <div class="compose-header">
    رسالة جديدة
    <button id="closeCompose" type="button" class="close compose-close">
      <span>×</span>
    </button>
  </div>

  <div class="compose-body">
    <div id="alerts"></div>

    <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor">
      
        <form method="POST" action="/send/msg" id="sendMsgFrom">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input name="smsgsender" id="smsgsender" type="hidden" value="{{ $user->user_name }}">		


        <div class="btn-group pull-right col-md-6 col-sm-6 col-xs-12" style="margin-right: 10px;">          
						<input placeholder="عنوان الرساله" title="العنوان" name="smsgtitle" id="smsgtitle" class="form-control col-md-7 col-xs-12" data-validate-length-range="15" data-validate-words="1" required="required" type="text">		
          </div>
        


          <div class="btn-group pull-right" style="margin-right: 10px;">
            <h2>الى</h2>
            
          </div>

            <div class="btn-group pull-right">
          
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                          <select required="required" class="select2_group form-control" name="smsgreceiver" id="smsgreceiver">
                            
                  <optgroup label="الاطباء">
                  <?php
                  foreach($doctors as $doctor){
                      echo "<option value='".$doctor->user_name."'>".$doctor->name."(".$doctor->email.")"."</option>";
                  }
                  ?>
                  </optgroup>

                  @if($user->role != 'Pacient')
                  <optgroup label="السكرتاريا">

                    <?php
                  
                  foreach($secretaries as $secretary){
                      echo "<option value='".$secretary->user_name."'>".$secretary->name."(".$secretary->email.")"."</option>";
                  }
                  
                  ?>
                      
                  </optgroup>
                  <optgroup label="الممرضين">
                      
                    <?php

                  foreach($nurses as $nurse){
                      echo "<option value='".$nurse->user_name."'>".$nurse->name."(".$nurse->email.")"."</option>";
                  }
                  
                  ?>
                  </optgroup>

                  <optgroup label="المرضى">
                      
                    <?php

                  foreach($pacirnts as $patient){
                      echo "<option value='".$patient->user_name."'>".$patient->name."(".$patient->email.")"."</option>";
                  }
                  
                  ?>
                  </optgroup>
                  @endif
                  
                </select>
              
            </div>
                      
          </div>

        </div>

      <textarea name="smsgbody"></textarea>
     

      <a class="compose-footer" id="sendmsg">
        <input type="submit" value="ارسال" class="btn btn-sm btn-success" type="submit" style="margin-top:5px;"></input>
        
      </a>
            
    </form>
  </div>
</div>
<!-- /compose -->

    <!-- Button trigger modal -->
<button id="msgModal" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="display:none;">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title pull-right" id="exampleModalLabel">تنبيه</h4>
        <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalMsg" style="font-size: 17px;">
        تم ارسال الرسالة بنجاح
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-success pull-left" data-dismiss="modal">اغلاق</button>
      </div>
    </div>
  </div>
</div>


@endsection