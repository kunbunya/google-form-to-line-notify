
<?php 

function ubisGoogleFormToLineNotify() {
  
  var form = FormApp.getActiveForm();
  var form_res = form.getResponses();
  
  var formResponse = form_res[form_res.length - 1];
  var itemResponses = formResponse.getItemResponses();

  var dept = itemResponses[0].getResponse();
  var name = itemResponses[1].getResponse();
  var issue = itemResponses[2].getResponse();
  var detail = itemResponses[3].getResponse();
  
  var all_message = 'มีผู้แจ้งปัญหา IT ผ่านทาง Google Form '+ 
  ' \n'+'แผนก: '+ dept +
  ' \n'+'ชื่อ-สกุล: '+ name +
  ' \n'+'เกี่ยวกับ: '+ issue +
  ' \n'+'รายละเอียด: '+ detail ;
  
//  var image_id = itemResponses[4].getResponse();
  
//  Logger.log('all_message = ', all_message);
//  Logger.log('image_id = ', image_id);
  
  var token = "LFFBsbVKOXzlJOb3SslV6lhesuZT7RzbVF6YZBKcMPy";
//  var message = '';
//  var IMAGE_URL = 'https://drive.google.com/uc?export=view&id='+ image_id;
    
//  var imgThumbnail = IMAGE_URL;
//  var imgFullsize =  IMAGE_URL;

//  Logger.log('IMAGE_URL = ', IMAGE_URL);
  
  var formData = {
    'message' : all_message,
//    'imageThumbnail': imgThumbnail,
//    'imageFullsize' : imgFullsize,
  }

  var options = {
    "method" : "post",
    "payload" : formData,
    "headers" : {"Authorization" : "Bearer " + token}
  };
  
  UrlFetchApp.fetch("https://notify-api.line.me/api/notify", options);
 
}





    function onFormSubmit() {

        var form = FormApp.openById('1fvef_NOwdiWgdpRooRMa-Jy8mNtPgTngcQI_HFPQ-TE');
        var fRes = form.getResponses();
        
        var formResponse = fRes[fRes.length - 1];
        var itemResponses = formResponse.getItemResponses();
        
        var msg = 'มีผู้แจ้งปัญหา IT ผ่านทาง Google Form';//+
        // ' \n' + itemResponses[0].getItem().getTitle() + ': ' + itemResponses[0].getResponse() +
        // ' \n' + itemResponses[0].getItem().getTitle() + ': ' + itemResponses[0].getResponse() +
        // ' \n' + itemResponses[0].getItem().getTitle() + ': ' + itemResponses[0].getResponse() +
        // ' \n' + itemResponses[0].getItem().getTitle() + ': ' + itemResponses[0].getResponse()
        
        for (var i = 0; i < itemResponses.length; i++) {
        msg += ' \n' + itemResponses[i].getItem().getTitle() + ': ' + itemResponses[i].getResponse();
        }
        sendLineNotify(msg);
        // Logger.log(msg)
        }
        
        function sendLineNotify(message) {
        
        //For IT Dept: LFFBsbVKOXzlJOb3SslV6lhesuZT7RzbVF6YZBKcMPy
        //For Testing: lU5OKQKL5awlRvaRm83HmjG35SSKWeAu8bMx92alf2O
        
        var token = ["LFFBsbVKOXzlJOb3SslV6lhesuZT7RzbVF6YZBKcMPy"]; 
        var options = {
        "method": "post",
        "payload": "message=" + message,
        "headers": {
        "Authorization": "Bearer " + token
        }
        };
        
        UrlFetchApp.fetch("https://notify-api.line.me/api/notify", options);
        }
    
?>
