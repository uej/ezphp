<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
<!--<script src="/js/webuploader/webuploader.html5only.min.js" type="text/javascript"></script>
<script src="/js/webuploader/diyUpload.js" type="text/javascript"></script>-->
<script src="/js/jquery-3.1.1.js" type="text/javascript"></script>
<link href="/js/diyUpload/css/diyUpload.css" rel="stylesheet" type="text/css"/>
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
<div id="box">
	<div id="test" ></div>
</div>

<div id="demo">
	<div id="as" ></div>
</div>
</body>
<script type="text/javascript">

/*
* 服务器地址,成功返回,失败返回参数格式依照jquery.ajax习惯;
* 其他参数同WebUploader
*/

$('#test').diyUpload({
	url:'<?=\ez\core\Route::createUrl('index/up')?>',
	success:function( data ) {
		console.info( data );
	},
	error:function( err ) {
		console.info( err );	
	},
    
});

$('#as').diyUpload({
	url:'server/fileupload.php',
	success:function( data ) {
		console.info( data );
	},
	error:function( err ) {
		console.info( err );	
	},
	buttonText : '选择文件',
	chunked:true,
	// 分片大小
	chunkSize:512 * 1024,
	//最大上传的文件数量, 总文件大小,单个文件大小(单位字节);
	fileNumLimit:50,
	fileSizeLimit:500000 * 1024,
	fileSingleSizeLimit:50000 * 1024,
	accept: {}
});
</script>

</body>
</html>
