module.exports = function () {

    $.gulp.task('font-min', () => {
        return $.gulp.src('src/fonts/*')
        .pipe($.gp.fonter({
            subset:" №!#$%&'()*+±,-‐‑‒–—―./:;<=>?@][^_`{|}~¢£¥¨ƒ§©«®™°´′¸»ˆ˚˜€‘’‚“”″„×÷•…‹›€₽←⇐➔➜➟↖↑↓↗↘↙↺↻✔✓αβγδεηθμπρσφω" + '"0123456789¼½¾²³ⅠⅡⅢⅣⅤ' + 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz' + 'АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя',
            formats: ['woff', 'woff2', 'ttf']
        }))
        .pipe($.gp.ttf2woff2({
            ignoreExt: true,
            clone: true,
        }))
        .pipe($.gulp.dest('dist/css/'));
    });
};