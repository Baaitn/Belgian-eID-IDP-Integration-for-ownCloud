(function ($, OC) {

    $(document).on('click', '#fileList tr', function(event){
//        var tr = $(this);
//        var type = tr.attr('data-type');
//        var file = tr.attr('data-file');
//        alert(type + " : " + file);
//        
//        tr.find( '[data-action="Download"]' ).css( 'background-color', 'yellow' );
    });
    $(document).on('click', '.name', function(event){
//        event.preventDefault();
//        
//        var row = $(this).parent().parent();
//        var type = row.attr('data-type');
//        var file = row.attr('data-file');
//        alert(type + " : " + file);
//        
//        row.find( '[data-action="Download"]' ).css( 'background-color', 'yellow' );
    });
    $(document).on('click', '.name', function(event){
        //event.preventDefault();
    });
    $(document).on('click', '.action .action-download', function(event){
        //event.preventDefault();
    });
    $(document).on('click', '.action action-download', function(event){
        //event.preventDefault();
    });
    $(document).on('click', '.action-download', function(event){
        //event.preventDefault();
    });
    $(document).on('click', '.action', function(event){
        //event.preventDefault();
    });
    $(document).on('click', '[data-action="Download"]', function(event){
        //event.preventDefault();
    });
    $(document).on('click', '#filestable .download', function(event){
        //event.preventDefault();
    });
    $(document).on('ready', function(event){
        //event.preventDefault();
    });
    
//    $(document).on('click', function(event){
//        var body = $(this);
//        var filelist = body.find( '#fileList' );
//        if(filelist.children().length > 0){
//            alert('iets');
//        } else {
//            alert('niets');
//        }
//        
//        alert("clicked: " + event.target);
//    });




    $(document).ready(function () {
        //alert('document.ready()');

        $('#fileList').on('click', 'a.name', function(event, options){ //$('#fileList').on('click', 'td.filename > a.name', function(event){
            //event.preventDefault();
            
//            var tr = $(this).parent().parent();
//            var type = tr.attr('data-type');
//            var name = tr.attr('data-file');
//            alert(type + " : " + name);
//            
//            tr.find( '[data-action="Download"]' ).css( 'background-color', 'green' );
//            tr.find( '[data-action="Versions"]' ).css( 'background-color', 'yellow' );
//            tr.find( '[data-action="Share"]' ).css( 'background-color', 'red' );
//          
//            var data = 'TEST';
//            $.post(
//                OC.filePath('beididp', 'ajax', 'log.php'),
//                {data: data},
//                function (result) {
//                    if (result.status === 'success') {
//                        alert('success');
//                    } else {
//                        alert('error');
//                    }
//                }
//            );

            //$(this).unbind('click').click()
        });

//        $('#fileList').on('click', '.filesize', function(event){
//            event.preventDefault();
//            
//            var data = '.filesize';
//            $.post(
//                OC.filePath('beididp', 'ajax', 'log.php'),
//                {data: data},
//                function (result) {
//                    if (result.status === 'success') {
//                        alert('success');
//                    } else {
//                        alert('error');
//                    }
//                }
//            );
//        });

//        $('#fileList').on('click', '.nametext', function(event){
//            event.preventDefault();
//
//            alert('.nametext');
//        });

//        $('#fileList').on('click', '.fileactions', function(event){
//            event.preventDefault();
//
//            alert('.fileactions');
//        });

//        $('#fileList').on('click', '.action', function(event){
//            event.preventDefault();
//
//            var data = 'ACTION CLICK';
//            $.post(
//                OC.filePath('beididp', 'ajax', 'log.php'),
//                {data: data},
//                function (result) {
//                    if (result.status === 'success') {
//                        alert('success');
//                    } else {
//                        alert('error');
//                    }
//                }
//            );
//        });




        //var fL = $(this).find( '#fileList' );
        //var type = tr.attr('data-type');
        //var file = tr.attr('data-file');
        //tr.find( '[data-action="Download"]' ).css( 'background-color', 'yellow' );

        //$('#fileList').on('click', 'td > a.name > span.fileactions > a.action-download"', function(){
        
//        $('#fileList').on('click', 'tr', function(event){
//            event.preventDefault();
//            alert('tr'); //op rij
//        });
        




        
//        $('#fileList').on('click', '.action-download', function(event){
//            event.preventDefault();
//            alert('beh');
//        });
        
//        $('#fileList').on('click', 'a.name > .fileactions', function (event) {
//            event.preventDefault();
//            alert('yay');
//        });
        
        
        
        
//        $('#fileList').on('click', 'a.action.action-download span', function(event){ 
//            event.preventDefault();
//            alert('BAM!');
//        });
//        
//        $('#fileList').on('click', '[data-action="Download"]', function(event){
//            event.preventDefault();
//            alert('da');
//        });
        
//        $(".action-download").css( "text-decoration", "underline" );
//        $("#filestable").css( "border", "3px solid green" );
//        $("#filestable tbody tr td:nth-child(1)").css( "color", "red" ); 
        
    });
    
    $(window).load(function() {
     alert("windown.load()");
     var filelist = $(document).find( '#fileList' );
     filelist.css( 'background-color', 'yellow' );
     
     filelist.on('click', 'a', function(event){ alert('action'); });
     
     filelist.on('click', 'a.name', function(event){ //$('#fileList').on('click', 'td.filename > a.name', function(event){
            //event.preventDefault();
            
            alert('click');
            
//            var tr = $(this).parent().parent();
//            var type = tr.attr('data-type');
//            var name = tr.attr('data-file');
//            alert(type + " : " + name);
//            
//            tr.find( '[data-action="Download"]' ).css( 'background-color', 'green' );
//            tr.find( '[data-action="Versions"]' ).css( 'background-color', 'yellow' );
//            tr.find( '[data-action="Share"]' ).css( 'background-color', 'red' );
//          
//            var data = 'TEST';
//            $.post(
//                OC.filePath('beididp', 'ajax', 'log.php'),
//                {data: data},
//                function (result) {
//                    if (result.status === 'success') {
//                        alert('success');
//                    } else {
//                        alert('error');
//                    }
//                }
//            );

            //$(this).unbind('click').click()
        });
     
    });

})(jQuery, OC);