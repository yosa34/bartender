var _window = $(window),
_header = $('.page_nav'),
heroBottom;

_window.on('scroll',function(){
heroBottom = 140;
if(_window.scrollTop() > heroBottom){
    _header.addClass('fixed');
}
else{
    _header.removeClass('fixed');
}
});

_window.trigger('scroll');