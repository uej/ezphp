<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
<!--<script src="/js/webuploader/webuploader.html5only.min.js" type="text/javascript"></script>
<script src="/js/webuploader/diyUpload.js" type="text/javascript"></script>-->
<script src="/js/jquery-3.1.1.js" type="text/javascript"></script>
<link href="/js/diyUpload/css/webuploader.css" rel="stylesheet" type="text/css"/>
<script src="/js/diyUpload/js/webuploader.html5only.min.js" type="text/javascript"></script>
<script src="/js/diyUpload/js/diyUpload.js" type="text/javascript"></script>
</head>
<body>
<style>
*{ margin:0; padding:0;}
#box{ margin:50px auto; width:540px; min-height:400px; background:#FF9}
#demo{ margin:50px auto; width:540px; min-height:800px; background:#CF9}
</style>

<div id="uploader" class="wu-example">
    <!--用来存放文件信息-->
    <div id="thelist" class="uploader-list"></div>
    <div class="btns">
        <div id="picker">选择文件</div>
        <button id="ctlBtn" class="btn btn-default">开始上传</button>
    </div>
</div>

<!--<div id="box">
	<div id="test"></div>
</div>

<div id="demo">
	<div id="as" ></div>
</div>-->
</body>
<script type="text/javascript">

var uploader = WebUploader.create({

//    auto: true,

    // 文件接收服务端。
    server: '<?=\ez\core\Route::createUrl('index/up')?>',

    // 选择文件的按钮。可选。
    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
    pick: {
        id: '#picker',
        innerHTML: '点击选择图片',
        multiple: true
    },

    // 开启分片上传
    chunked:true,
    // 分片大小
    chunkSize:512 * 1024,

    // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
    resize: false
});

uploader.on( 'fileQueued', function( file ) {
    var $list = $("#thelist");
    $list.append( '<div id="' + file.id + '" class="item">' +
        '<h4 class="info">' + file.name + '</h4>' +
        '<p class="state">等待上传...</p>' +
    '</div>' );
});

uploader.on( 'uploadProgress', function( file, percentage ) {
    var $li = $( '#'+file.id ),
        $percent = $li.find('.progress .progress-bar');

    // 避免重复创建
    if ( !$percent.length ) {
        $percent = $('<div class="progress progress-striped active">' +
          '<div class="progress-bar" role="progressbar" style="width: 0%">' +
          '</div>' +
        '</div>').appendTo( $li ).find('.progress-bar');
    }

    $li.find('p.state').text('上传中');

    $percent.css( 'width', percentage * 100 + '%' );
});

uploader.on( 'uploadSuccess', function( file ) {
    $( '#'+file.id ).find('p.state').text('已上传');
});

uploader.on( 'uploadError', function( file ) {
    $( '#'+file.id ).find('p.state').text('上传出错');
});

uploader.on( 'uploadComplete', function( file ) {
    $( '#'+file.id ).find('.progress').fadeOut();
});

$("#ctlBtn").click(function(){
    uploader.upload();
});

//$('#test').diyUpload({
//	url:'<?=\ez\core\Route::createUrl('index/up')?>',
//	success:function( data ) {
//		console.info( data );
//	},
//	error:function( err ) {
//		console.info( err );	
//	},
//    
//});

//$('#as').diyUpload({
//	url:'server/fileupload.php',
//	success:function( data ) {
//		console.info( data );
//	},
//	error:function( err ) {
//		console.info( err );	
//	},
//	buttonText : '选择文件',
//	chunked:true,
//	// 分片大小
//	chunkSize:512 * 1024,
//	//最大上传的文件数量, 总文件大小,单个文件大小(单位字节);
//	fileNumLimit:50,
//	fileSizeLimit:500000 * 1024,
//	fileSingleSizeLimit:50000 * 1024,
//	accept: {}
//});
</script>

</body>
</html>
