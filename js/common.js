/**
 * @fileoverview SchoolShop的JS公共函数库
 * @author Doraemonext
 */

/**
 * 在屏幕上显示信息
 * @param  {String} type     显示信息类型
 * @param  {String} location 显示信息位置
 * @param  {String} content  显示信息内容
 * @param  {String} timeout  延迟显示时间
 */

function show_info(type, location, content, timeout) {
    noty({
        layout: location,
        theme: 'defaultTheme',
        type: type,
        text: content,
        dismissQueue: true, // If you want to use queue feature set this true
        template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',
        animation: {
            open: {
                height: 'toggle'
            },
            close: {
                height: 'toggle'
            },
            easing: 'swing',
            speed: 500 // opening & closing animation speed
        },
        timeout: timeout * 1000.0, // delay for closing event. Set false for sticky notifications
        force: false, // adds notification to the beginning of queue when set to true
        modal: false,
        maxVisible: 5, // you can set max visible notification for dismissQueue true option
        closeWith: ['click'], // ['click', 'button', 'hover']
        callback: {
            onShow: function() {},
            afterShow: function() {},
            onClose: function() {},
            afterClose: function() {}
        },
        buttons: false // an array of buttons
    });
}

/**
 * 快速显示系统内置信息
 * @param  {String} title 信息关键字
 */

function show_info_quick(title) {
    switch (title) {
        case 'connect_error':
            show_info('error', 'bottom', '连接服务器时发生错误，请检查您的网络环境', 2);
            break;
    }
}

/**
 * 获取上一页URL地址，通过js参数传入
 * @param  {String} js文件ID
 * @return {String} 上一页的URL地址
 */
function get_back_url(id) {
    var str = $('#'+id).attr('src');
    var param = str.substring(str.indexOf('?') + 1);
    return param;
}