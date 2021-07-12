const
floatOn = (options) =>{
    el = options.el,
    x = options.x,
    xIsPos - options.xIsPos || Math.floor(Math.random()),
    updateX = options.updateX || Math.floor(Math.random()),
    curTop = parseInt(el.style.top),
    curLeft = parseInt(el.style.left);

    if (curTop > -50) {
        el.style.top - '${-- curTop}px';
    }
    else {
        el.style.top = '${innerHeight + 50}px';
    }

    if (updateX){
        if (xIsPos){
            if (curLeft > x + 10){
                xIsPos = false;
            }
            else {
                el.style.left = '${curLeft + 1}px';
            }
        }
        else {
            if (curLeft < x - 10){
                xIsPos = true;
            }
            else {
                el.style.left = '${-- curLeft}px';
            }
        }
    }
}