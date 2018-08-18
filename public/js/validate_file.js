$(function(){
    $('#photo').change(function() {
    var fileSize = $('#photo').prop('files')[0].size;
        if (fileSize > 8300000) {
          alert("ファイルが大き過ぎます。");
          console.log(fileSize);
          $('#photo').val(null); 
        }
    });
});

