const replace = require('gulp-replace-task');

module.exports = function () {
    $.gulp.task('pug', () => {
        return $.gulp.src('src/pug/pages/*.pug')
            .pipe($.gp.pug({
                locals: $.locals,
                pretty: true

            }))
            .pipe(replace({
                patterns: [
                    {
                        match: /&#32;/g,
                        replacement: ''
                    }
                ]
            }))
            .on('error', $.gp.notify.onError(
                function (error) {
                    return {
                        title: 'Pug',
                        message: error.message
                    }
                }
            ))
            .pipe($.gulp.dest('./dist'))
    });

    $.gulp.task('pug-rel', () => {
        return $.gulp.src($.ppath.html.src)
            .pipe($.gp.pug({
                locals: $.locals,
                pretty: false
            }))
            .pipe(replace({
                patterns: [
                    {
                        match: /&#32;/g,
                        replacement: ''
                    }
                ]
            }))
            .on('error', $.gp.notify.onError(
                function (error) {
                    return {
                        title: 'Pug',
                        message: error.message
                    }
                }
            ))
            .pipe($.gulp.dest($.ppath.release))
    });
};