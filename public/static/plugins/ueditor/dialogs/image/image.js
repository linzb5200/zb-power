(function () {
	var remoteImage,uploadImage;
	window.onload = function () {
		initTabs();
		initAlign();
		initButtons();
		layui.element.on('tab(image)', function(data){
			setTabFocus($(this).attr('lay-id'));
		});
		$(document).on('click','.delimg',function(e){
			if(confirm('确认要删除吗？删除后已同步微信的内容不受影响。但编辑器中使用过此图片的将无法显示。')) { 
				var url = editor.getActionUrl(editor.getOpt('backgroundActionName')),
					isJsonp = utils.isCrossDomainUrl(url),_this = $(this);
				$.ajax({
					url:editor.getActionUrl(editor.getOpt('imageDeleteActionName')),
					data:{id:$(this).data('id')},
					type:'get',
					cache:false,
					dataType:isJsonp ? 'jsonp':'json',
					xhrFields:{withCredentials:true},
					error:function(){layer.closeAll('loading');},
					beforeSend:function(){var loading = layer.load(2, {shade: [.2,'#000']});},
					success:function(json){
						layer.closeAll('loading');
						json =json||{};
						if(json.state == 'SUCCESS'){
							_this.parent().remove();
						}else{
							layer.msg(json.state,{icon:5,anim:6});
						}
					}
				});  
			}e.stopPropagation();
		});
		$(document).on('click','#myList .icon',function(){
			var $parent = $(this).parents('li:first');
			if($parent.hasClass('selected') ) {
				$parent.removeClass('selected');
			}else{
				$parent.addClass('selected');
			}
		});
	};
	function initTabs() {
		var img = editor.selection.getRange().getClosedNode();
		if (img && img.tagName && img.tagName.toLowerCase() == 'img') {
			setTabFocus('remote');
		} else {
			layui.element.tabChange('image', 'upload');
			setTabFocus('upload');
		}
	}
	function setTabFocus(id) {
		if(!id) return;
		switch (id) {
			case 'remote':
				remoteImage = remoteImage || new RemoteImage();
				break;
			case 'upload':
				uploadImage = uploadImage || new UploadImage('queueList');
				break;
			case 'myimage':
				if(!parent.AlreadyLogin){
					layui.layer.msg('必须登录后才能执行该操作',{time:1000,anim:6}, function(){
						parent.window.float_login();
						dialog.close(false);
					});
					return !1
				}
				if($('#myList').html()=="") myImage();
				break;
		}
	}
	function initButtons() {
		dialog.onok = function () {
			var remote = false, list = [], id, tabs = $G('tabhead').children;
			for (var i = 0; i < tabs.length; i++) {
				if (domUtils.hasClass(tabs[i], 'layui-this')) {
					id = tabs[i].getAttribute('lay-id');
					break;
				}
			}
			switch (id) {
				case 'remote':
					list = remoteImage.getInsertList();
					break;
				case 'upload':
					list = uploadImage.getInsertList();
					var count = uploadImage.getQueueCount();
					if (count) {
						$('.info', '#queueList').html('<span style="color:red;">' + '还有2个未上传文件'.replace(/[\d]/, count) + '</span>');
						return false;
					}
					break;
				case 'myimage':
					$('#myList li.selected').each(function(){
						var img = $(this).find('img:first');
						list.push({
							src: img.attr('src'),
							_src: img.attr('src'),
							title: img.attr('title'),
							alt: img.attr('src').substr(img.attr('src').lastIndexOf('/') + 1),
							floatStyle: getAlign()
						});
					});
					break;
			}
			if(list) {
				editor.execCommand('insertimage', list);
				remote && editor.fireEvent("catchRemoteImage");
            }
		};
	}
	function myImage() {
		function myImageLoad(){			
			$('#myList .page a').click(function(){
				if($(this).attr('href') == 'javascript:;') return false;
				$('#myList').html('');
				$.ajax({
					url:editor.getActionUrl(editor.getOpt('imageManagerActionName'))+$(this).attr('href'),
					type:'get',
					cache:false,
					dataType:'html',
					xhrFields:{withCredentials:true},
					success:function(json){
						$('#myList').html(json);
						myImageLoad();
					}
				});
				return false;
			})
		}
		$.ajax({
			url:editor.getActionUrl(editor.getOpt('imageManagerActionName')),
			type:'get',
			cache:false,
			dataType:'html',
			xhrFields:{withCredentials:true},
			success:function(json){
				$('#myList').html(json);
				myImageLoad();
			}
		});
	}
	function initAlign(){
		domUtils.on($G("alignIcon"), 'click', function(e){
			var target = e.target || e.srcElement;
			if(target.className && target.className.indexOf('-align') != -1) {
				setAlign(target.getAttribute('data-align'));
			}
			$G('preview').style.textAlign = getAlign();
		});
	}
	function setAlign(align){
		align = align || 'none';
		var aligns = $G("alignIcon").children;
		for(i = 0; i < aligns.length; i++){
			if(aligns[i].getAttribute('data-align') == align) {
				domUtils.addClass(aligns[i], 'focus');
				$G("align").value = aligns[i].getAttribute('data-align');
			} else {
				domUtils.removeClasses(aligns[i], 'focus');
			}
		}
	}
	function getAlign(){
		var align = $G("align").value || 'none';
		return align == 'none' ? '':align;
	}
	function RemoteImage(target) {
		this.container = utils.isString(target) ? document.getElementById(target) : target;
		this.init();
	}
	RemoteImage.prototype = {
		init: function () {
			this.initContainer();
			this.initEvents();
		},
		initContainer: function () {
			this.dom = {
				'url': $G('url'),
				'width': $G('width'),
				'height': $G('height'),
				'radius': $G('radius'),
				'padding': $G('padding'),
				'opacity': $G('opacity'),
				'title': $G('title'),
				'align': $G('align')
			};
			var img = editor.selection.getRange().getClosedNode();
			if (img) this.setImage(img);
		},
		initEvents: function () {
			var _this = this;
			/* 改变url */
			domUtils.on($G("url"), ['keyup','blur'], updatePreview);
			domUtils.on($G("width"), ['keyup','input'], updatePreview);
			domUtils.on($G("height"), ['keyup','input'], updatePreview);
			domUtils.on($G("radius"), ['keyup','input'], updatePreview);
			domUtils.on($G("padding"), ['keyup','input'], updatePreview);
			domUtils.on($G("opacity"), ['keyup','input'], updatePreview);
			domUtils.on($G("title"), ['keyup','blur'], updatePreview);
			function updatePreview(){
				_this.setPreview();
			}
		},
		setImage: function(img){
			/* 不是正常的图片 */
			if (!img.tagName || img.tagName.toLowerCase() != 'img' && !img.getAttribute("src") || !img.src) return;

			var wordImgFlag = img.getAttribute("word_img"),
				src = wordImgFlag ? wordImgFlag.replace("&amp;", "&") : (img.getAttribute('_src') || img.getAttribute("src", 2).replace("&amp;", "&")),
				align = editor.queryCommandValue("imageFloat");

			/* 防止onchange事件循环调用 */
			if (src !== $G("url").value) $G("url").value = src;
			if(src) {
				$G("width").placeholder = img.width + ' 或 100%' || '输入整数或百分比';
				$G("height").placeholder = img.height + ' 或 100%' || '输入整数或百分比';
				/* 设置表单内容 */
				var width = img.style.width || img.getAttribute("width") || '';
				if(width) width = width.toLowerCase();
				$G("width").value = width.indexOf('px') != -1 ? width.replace('px','') : width;
				
				var height = img.style.height || img.getAttribute("height") || '';
				if(height) height = height.toLowerCase();
				$G("height").value = height.indexOf('px') != -1 ? height.replace('px','') : height;
				
				var radius = img.style.borderRadius || '';
				if(radius) radius = radius.toLowerCase();
				$G("radius").value =  radius.indexOf('px') != -1 ? radius.replace('px','') : radius;
				
				var padding = img.style.padding || '';
				$G("padding").value = (padding) ? padding.toLowerCase() : padding;
				
				$G("opacity").value = img.style.opacity || '';
				$G("title").value = img.title || img.alt || '';
				setAlign(align);
				this.setPreview();
			}
		},
		getData: function(){
			var data = {};
			for(var k in this.dom){
				data[k] = this.dom[k].value;
			}
			return data;
		},
		setPreview: function(){
			var url = $G('url').value,
				ow = $G('width').value,
				oh = $G('height').value,
				radius = $G('radius').value,
				padding = $G('padding').value,
				opacity = $G('opacity').value,
				title = $G('title').value,
				preview = $G('preview'),
				width,height,
				style = '';

			url = utils.unhtmlForUrl(url);
			title = utils.unhtml(title);
			if(ow){
				if(ow.toLowerCase().indexOf('px') != -1) ow = ow.toLowerCase().replace('px','');
				width = ow.indexOf('%') != -1 ? (parseFloat(ow) > 100 ? '100%' : ow) : (ow == 'auto' ? '' : Math.min(ow, preview.offsetWidth - 17));
			}else{
				width = '';
			}
			if(oh){
				if(oh.toLowerCase().indexOf('px') != -1) oh = oh.toLowerCase().replace('px','');
				height = oh.indexOf('%') != -1 ? (parseFloat(oh) > 100 ? '100%' : oh) : (oh == 'auto' ? '' : Math.min(oh, preview.offsetWidth - 17));
			}else{
				height = '';
			}
			if(url) {
				if( url.indexOf('//mmbiz.qlogo.cn') > -1  || url.indexOf('//mmbiz.qpic.cn') > -1 || url.indexOf('//mmsns.qpic.cn')  > -1) url = parent.RemoteUrl + url.replace('https:/','').replace('http:/','');
				style+= (width == '') ? 'max-width:300px;' : 'width:' + (isNaN(width) ? width : width + 'px') + ';';
				style+= (height == '') ? '' : 'height:' + (isNaN(height) ? height : height + 'px') + ';';
				if(radius != '' && radius != 0) style+= 'border-radius:' + (isNaN(radius) ? radius : radius + 'px') + ';';
				if(opacity != '' && opacity != 0) style+= 'opacity:' + opacity + ';';
				if(padding) style+= 'padding:' + (isNaN(padding) ? padding : padding + 'px') + ';box-sizing:border-box;';
				preview.innerHTML = '<img src="' + url + '" style="' + style + '" title="' + title + '" />';
				preview.style.textAlign = getAlign();
			}
		},
		getInsertList: function () {
			var data = this.getData(),cssText = "";
			if(data['url']) {
				if( data['url'].indexOf('//mmbiz.qlogo.cn') > -1  || data['url'].indexOf('//mmbiz.qpic.cn') > -1 || data['url'].indexOf('//mmsns.qpic.cn')  > -1) data['url'] = parent.RemoteUrl + data['url'].replace('https:/','').replace('http:/','');
				cssText+= (data['width']) ? 'width:' + (isNaN(data['width']) ? data['width'] : data['width'] + 'px') + ';': 'width:auto;';
				cssText+= (data['height']) ? 'height:' + (isNaN(data['height']) ? data['height'] : data['height'] + 'px') + ';': 'height:auto;';
				if(data['radius'] != '' && data['radius'] != 0) cssText+= 'border-radius:' + (isNaN(data['radius']) ? data['radius'] : data['radius'] + 'px') + ';';
				if(data['opacity'] != '') cssText+= 'opacity:' + data['opacity'] + ';';
				if(data['padding']) cssText+= 'padding:' + (isNaN(data['padding']) ? data['padding'] : data['padding'] + 'px') + ';box-sizing:border-box;';
				return [{
					src: data['url'],
					_src: data['url'],
					floatStyle: data['align'] || '',
					title: data['title'] || '',
					alt: data['title'] || '',
					style: cssText
				}];
			} else {
				return [];
			}
		}
	};
	/* 上传图片 */
	function UploadImage(target) {
		this.$wrap = target.constructor == String ? $('#' + target) : $(target);
		this.init();
	}
	UploadImage.prototype = {
		init: function () {
			this.imageList = [];
			this.initContainer();
			this.initUploader();
		},
		initContainer: function () {
			this.$queue = this.$wrap.find('.filelist');
		},
		/* 初始化容器 */
		initUploader: function () {
			var _this = this,
				$ = jQuery,	// just in case. Make sure it's not an other libaray.
				$wrap = _this.$wrap,
			// 图片容器
				$queue = $wrap.find('.filelist'),
			// 状态栏，包括进度和控制按钮
				$statusBar = $wrap.find('.statusBar'),
			// 文件总体选择信息。
				$info = $statusBar.find('.info'),
			// 上传按钮
				$upload = $wrap.find('.uploadBtn'),
			// 上传按钮
				$filePickerBtn = $wrap.find('.filePickerBtn'),
			// 上传按钮
				$filePickerBlock = $wrap.find('.filePickerBlock'),
			// 没选择文件之前的内容。
				$placeHolder = $wrap.find('.placeholder'),
			// 总体进度条
				$progress = $statusBar.find('.progress').hide(),
			// 添加的文件数量
				fileCount = 0,
			// 添加的文件总大小
				fileSize = 0,
			// 优化retina, 在retina下这个值是2
				ratio = window.devicePixelRatio || 1,
			// 缩略图大小
				thumbnailWidth = 113 * ratio,
				thumbnailHeight = 113 * ratio,
			// 可能有pedding, ready, uploading, confirm, done.
				state = '',
			// 所有文件的进度信息，key为file id
				percentages = {},
				supportTransition = (function () {
					var s = document.createElement('p').style,
						r = 'transition' in s ||
							'WebkitTransition' in s ||
							'MozTransition' in s ||
							'msTransition' in s ||
							'OTransition' in s;
					s = null;
					return r;
				})(),
			// WebUploader实例
				uploader,
				actionUrl = editor.getActionUrl(editor.getOpt('imageActionName')),
				acceptExtensions = (editor.getOpt('imageAllowFiles') || []).join('').replace(/\./g, ',').replace(/^[,]/, ''),
				imageMaxSize = editor.getOpt('imageMaxSize'),
				imageCompressBorder = editor.getOpt('imageCompressBorder');
			if (!WebUploader.Uploader.support()) {
				$('#filePickerReady').after($('<div>').html(lang.errorNotSupport)).hide();
				return;
			} else if (!editor.getOpt('imageActionName')) {
				$('#filePickerReady').after($('<div>').html(lang.errorLoadConfig)).hide();
				return;
			} else{
				if("function" == typeof parent.window.meitu_upload) $('#filePickerReady').after('<div class="webuploader-pick" onclick="parent.window.meitu_upload();dialog.close(false);" style="display: inline-block;">美化图片上传</div>');
				if("function" == typeof parent.window.pintu_upload) $('#filePickerReady').after('<div class="webuploader-pick" onclick="parent.window.pintu_upload();dialog.close(false);" style="display:inline-block;">拼接图片上传</div>');
				if("function" == typeof parent.window.phone_upload) $('#filePickerReady').after('<div class="webuploader-pick" onclick="parent.window.phone_upload();dialog.close(false);" style="display: inline-block;">上传手机图片</div><br>');
			}
			uploader = _this.uploader = WebUploader.create({
				pick: {
					id: '#filePickerReady',
					label: lang.uploadSelectFile
				},
				accept: {
					title: 'Images',
					extensions: acceptExtensions,
					mimeTypes: 'image/*'
				},
				swf: '../../third-party/webuploader/Uploader.swf',
				server: actionUrl,
				fileVal: editor.getOpt('imageFieldName'),
				duplicate: true,
				withCredentials: true,
				fileSingleSizeLimit: imageMaxSize,	// 默认 2 M
				compress: editor.getOpt('imageCompressEnable') ? {
					width: imageCompressBorder,
					height: imageCompressBorder,
					// 图片质量，只有type为`image/jpeg`的时候才有效。
					quality: 90,
					// 是否允许放大，如果想要生成小图的时候不失真，此选项应该设置为false.
					allowMagnify: false,
					// 是否允许裁剪。
					crop: false,
					// 是否保留头部meta信息。
					preserveHeaders: true
				}:false
			});
			uploader.addButton({
				id: '#filePickerBlock'
			});
			uploader.addButton({
				id: '#filePickerBtn',
				label: lang.uploadAddFile
			});
			setState('pedding');
			// 当有文件添加进来时执行，负责view的创建
			function addFile(file) {
				var $li = $('<li id="' + file.id + '">' +
						'<p class="title">' + file.name + '</p>' +
						'<p class="imgWrap"></p>' +
						'<p class="progress"><span></span></p>' +
						'</li>'),
					$btns = $('<div class="file-panel">' +
						'<span class="cancel">' + lang.uploadDelete + '</span>' +
						'<span class="rotateRight">' + lang.uploadTurnRight + '</span>' +
						'<span class="rotateLeft">' + lang.uploadTurnLeft + '</span></div>').appendTo($li),
					$prgress = $li.find('p.progress span'),
					$wrap = $li.find('p.imgWrap'),
					$info = $('<p class="error"></p>').hide().appendTo($li),
					showError = function (code) {
						switch (code) {
							case 'exceed_size':
								text = lang.errorExceedSize;
								break;
							case 'interrupt':
								text = lang.errorInterrupt;
								break;
							case 'http':
								text = lang.errorHttp;
								break;
							case 'not_allow_type':
								text = lang.errorFileType;
								break;
							default:
								text = lang.errorUploadRetry;
								break;
						}
						$info.text(text).show();
					};
				if (file.getStatus() === 'invalid') {
					showError(file.statusText);
				} else {
					$wrap.text(lang.uploadPreview);
					if (browser.ie && browser.version <= 7) {
						$wrap.text(lang.uploadNoPreview);
					} else {
						uploader.makeThumb(file, function (error, src) {
							if (error || !src) {
								$wrap.text(lang.uploadNoPreview);
							} else {
								var $img = $('<img src="' + src + '">');
								$wrap.empty().append($img);
								$img.on('error', function () {
									$wrap.text(lang.uploadNoPreview);
								});
							}
						}, thumbnailWidth, thumbnailHeight);
					}
					percentages[ file.id ] = [ file.size, 0 ];
					file.rotation = 0;
					/* 检查文件格式 */
					if (!file.ext || acceptExtensions.indexOf(file.ext.toLowerCase()) == -1) {
						showError('not_allow_type');
						uploader.removeFile(file);
					}
				}
				file.on('statuschange', function (cur, prev) {
					if (prev === 'progress') {
						$prgress.hide().width(0);
					} else if (prev === 'queued') {
						$li.off('mouseenter mouseleave');
						$btns.remove();
					}
					// 成功
					if (cur === 'error' || cur === 'invalid') {
						showError(file.statusText);
						percentages[ file.id ][ 1 ] = 1;
					} else if (cur === 'interrupt') {
						showError('interrupt');
					} else if (cur === 'queued') {
						percentages[ file.id ][ 1 ] = 0;
					} else if (cur === 'progress') {
						$info.hide();
						$prgress.css('display', 'block');
					} else if (cur === 'complete') {
					}
					$li.removeClass('state-' + prev).addClass('state-' + cur);
				});
				$li.on('mouseenter', function () {
					$btns.stop().animate({height: 30});
				});
				$li.on('mouseleave', function () {
					$btns.stop().animate({height: 0});
				});
				$btns.on('click', 'span', function () {
					var index = $(this).index(),
						deg;
					switch (index) {
						case 0:
							uploader.removeFile(file);
							return;
						case 1:
							file.rotation += 90;
							break;
						case 2:
							file.rotation -= 90;
							break;
					}
					if (supportTransition) {
						deg = 'rotate(' + file.rotation + 'deg)';
						$wrap.css({
							'-webkit-transform': deg,
							'-mos-transform': deg,
							'-o-transform': deg,
							'transform': deg
						});
					} else {
						$wrap.css('filter', 'progid:DXImageTransform.Microsoft.BasicImage(rotation=' + (~~((file.rotation / 90) % 4 + 4) % 4) + ')');
					}
				});
				$li.insertBefore($filePickerBlock);
			}
			// 负责view的销毁
			function removeFile(file) {
				var $li = $('#' + file.id);
				delete percentages[ file.id ];
				updateTotalProgress();
				$li.off().find('.file-panel').off().end().remove();
			}
			function updateTotalProgress() {
				var loaded = 0,
					total = 0,
					spans = $progress.children(),
					percent;
				$.each(percentages, function (k, v) {
					total += v[ 0 ];
					loaded += v[ 0 ] * v[ 1 ];
				});
				percent = total ? loaded / total : 0;
				spans.eq(0).text(Math.round(percent * 100) + '%');
				spans.eq(1).css('width', Math.round(percent * 100) + '%');
				updateStatus();
			}
			function setState(val, files) {
				if (val != state) {
					var stats = uploader.getStats();
					$upload.removeClass('state-' + state);
					$upload.addClass('state-' + val);
					switch (val) {
						/* 未选择文件 */
						case 'pedding':
							$queue.addClass('element-invisible');
							$statusBar.addClass('element-invisible');
							$placeHolder.removeClass('element-invisible');
							$progress.hide(); $info.hide();
							uploader.refresh();
							break;
						/* 可以开始上传 */
						case 'ready':
							$placeHolder.addClass('element-invisible');
							$queue.removeClass('element-invisible');
							$statusBar.removeClass('element-invisible');
							$progress.hide(); $info.show();
							$upload.text(lang.uploadStart);
							uploader.refresh();
							break;
						/* 上传中 */
						case 'uploading':
							$progress.show(); $info.hide();
							$upload.text(lang.uploadPause);
							break;
						/* 暂停上传 */
						case 'paused':
							$progress.show(); $info.hide();
							$upload.text(lang.uploadContinue);
							break;
						case 'confirm':
							$progress.show(); $info.hide();
							$upload.text(lang.uploadStart);

							stats = uploader.getStats();
							if (stats.successNum && !stats.uploadFailNum) {
								setState('finish');
								return;
							}
							break;
						case 'finish':
							$progress.hide(); $info.show();
							if (stats.uploadFailNum) {
								$upload.text(lang.uploadRetry);
							} else {
								$upload.text(lang.uploadStart);
							}
							break;
					}
					state = val;
					updateStatus();
				}
				if (!_this.getQueueCount()) {
					$upload.addClass('disabled')
				} else {
					$upload.removeClass('disabled')
				}
			}
			function updateStatus() {
				var text = '', stats;
				if (state === 'ready') {
					text = lang.updateStatusReady.replace('_', fileCount).replace('_KB', WebUploader.formatSize(fileSize));
				} else if (state === 'confirm') {
					stats = uploader.getStats();
					if (stats.uploadFailNum) {
						text = lang.updateStatusConfirm.replace('_', stats.successNum).replace('_', stats.successNum);
					}
				} else {
					stats = uploader.getStats();
					text = lang.updateStatusFinish.replace('_', fileCount).
						replace('_KB', WebUploader.formatSize(fileSize)).
						replace('_', stats.successNum);
					if (stats.uploadFailNum) {
						text += lang.updateStatusError.replace('_', stats.uploadFailNum);
					}
				}
				$info.html(text);
			}
			uploader.on('fileQueued', function (file) {
				fileCount++;
				fileSize += file.size;
				if (fileCount === 1) {
					$placeHolder.addClass('element-invisible');
					$statusBar.show();
				}
				addFile(file);
			});
			uploader.on('fileDequeued', function (file) {
				fileCount--;
				fileSize -= file.size;
				removeFile(file);
				updateTotalProgress();
			});
			uploader.on('filesQueued', function (file) {
				if (!uploader.isInProgress() && (state == 'pedding' || state == 'finish' || state == 'confirm' || state == 'ready')) {
					setState('ready');
				}
				updateTotalProgress();
			});
			uploader.on('all', function (type, files) {
				switch (type) {
					case 'uploadFinished':
						setState('confirm', files);
						if($("#iframe_picture",parent.document).length){
							$("#iframe_picture",parent.document).attr('src', $("#iframe_picture",parent.document).attr('src'));
						}
						if($(".picture-list",parent.document).length) top.location.reload();
						break;
					case 'startUpload':
						/* 添加额外的GET参数 */
						var params = utils.serializeParam(editor.queryCommandValue('serverparam')) || '',
							url = utils.formatUrl(actionUrl + (actionUrl.indexOf('?') == -1 ? '?':'&') + 'encode=utf-8&' + params);
						uploader.option('server', url);
						setState('uploading', files);
						break;
					case 'stopUpload':
						setState('paused', files);
						break;
				}
			});
			uploader.on('uploadBeforeSend', function (file, data, header) {
				//这里可以通过data对象添加POST参数
				header['X_Requested_With'] = 'XMLHttpRequest';
			});
			uploader.on('uploadProgress', function (file, percentage) {
				var $li = $('#' + file.id),
					$percent = $li.find('.progress span');
				$percent.css('width', percentage * 100 + '%');
				percentages[ file.id ][ 1 ] = percentage;
				updateTotalProgress();
			});
			uploader.on('uploadSuccess', function (file, ret) {
				var $file = $('#' + file.id);
				try {
					var responseText = (ret._raw || ret),
						json = utils.str2json(responseText);
					if (json.state == 'SUCCESS') {
						_this.imageList.push(json);
						$file.append('<span class="success"></span>');
					} else {
						$file.find('.error').text(json.state).show();
					}
				} catch (e) {
					$file.find('.error').text(lang.errorServerUpload).show();
				}
			});
			uploader.on('uploadError', function (file, code) {
			});
			uploader.on('error', function (code, file) {
				if (code == 'Q_TYPE_DENIED' || code == 'F_EXCEED_SIZE') {
					addFile(file);
				}
			});
			uploader.on('uploadComplete', function (file, ret) {
			});
			$upload.on('click', function () {
				if ($(this).hasClass('disabled')) {
					return false;
				}
				if (state === 'ready') {
					uploader.upload();
				} else if (state === 'paused') {
					uploader.upload();
				} else if (state === 'uploading') {
					uploader.stop();
				}
			});
			$upload.addClass('state-' + state);
			updateTotalProgress();
		},
		getQueueCount: function () {
			var file, i, status, readyFile = 0, files = this.uploader.getFiles();
			for (i = 0; file = files[i++]; ) {
				status = file.getStatus();
				if (status == 'queued' || status == 'uploading' || status == 'progress') readyFile++;
			}
			return readyFile;
		},
		destroy: function () {
			this.$wrap.remove();
		},
		getInsertList: function () {
			var i, data, list = [],
				align = getAlign(),
				prefix = editor.getOpt('imageUrlPrefix');
			for (i = 0; i < this.imageList.length; i++) {
				data = this.imageList[i];
				list.push({
					src: prefix + (data.url.substr(0,1) == '/' ? data.url : '/' + data.url),
					_src: prefix + (data.url.substr(0,1) == '/' ? data.url : '/' + data.url),
					title: data.title,
					alt: data.original,
					floatStyle: align
				});
			}
			return list;
		}
	};
})();