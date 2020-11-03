const gcmq = require('gulp-group-css-media-queries');


let SRC_DIR = './src/',
    DIST_DIR = './dist/',
    REL_DIR_HTML = 'release/*.html',
    REL_DIR_JS = 'release/js/*js';
let path = {
    scss: {
        entry: SRC_DIR + 'scss/main.scss',
        src: SRC_DIR + 'scss/**/*.scss',
        dist: DIST_DIR + 'css'
    }
};


module.exports = function () {
    $.gulp.task('sass', function () {
        return $.gulp.src(path.scss.src)
            .pipe($.gp.sourcemaps.init())
            .pipe($.gp.sass())
            .on('error', $.gp.notify.onError({
                title: 'Style'
            }))
            .pipe($.gp.autoprefixer({
                cascade: false
            }))
            .pipe($.gp.csso())
            .pipe($.gp.sourcemaps.write())
            .pipe($.gulp.dest(path.scss.dist));
    });

    $.gulp.task('sass-rel', function () {
        return $.gulp.src($.ppath.SRC + $.ppath.css.src)          
            .pipe($.gp.sass())
            .on('error', $.gp.notify.onError({
                title: 'Style'
            }))
    		.pipe($.gp.purgecss({
    			content: [REL_DIR_HTML, REL_DIR_JS],
    			fontFace: false,
    			keyframes: true
    		}))
            .pipe($.gp.autoprefixer({
                cascade: false
            }))
            .pipe(gcmq())
            .pipe($.gp.csso())            
            .pipe($.gulp.dest($.ppath.release + $.ppath.css.dest));
    });

    $.gulp.task('css-rel', function () {
        return $.gulp.src('src/css/vendor/*.css')          
            .pipe($.gulp.dest('release/css/vendor/'));
    });
};