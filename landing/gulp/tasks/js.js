const jsFiles = [
  "./src/js/vendor/detect.min.js",
  "./src/js/vendor/inputmask.bundle.min.js",
  "./src/js/vendor/notify.min.js", 
  "./src/js/vendor/jquery.cookie.min.js",
  "./src/js/admin.js",
  "./src/js/main.js",
];
   
module.exports = function () {        
  
  $.gulp.task('js-rel', () => {
      return $.gulp.src(jsFiles, {base: './src/js'})  
        .pipe($.gp.concat('build.js'))  
        .pipe($.gp.plumber())  
        .pipe($.gp.babel({
        presets: [
          ['@babel/env', {
            modules: false
          }]
        ]
        }))
        .pipe($.gp.uglify())
      .pipe($.gulp.dest($.ppath.release + $.ppath.js.dest));
    });

  $.gulp.task('js', () => {
       return $.gulp.src(jsFiles, {base: './src/js'})
        .pipe($.gp.concat('build.js'))
        .pipe($.gp.plumber())  
        .pipe($.gp.babel({
        presets: [
          ['@babel/env', {
            modules: false
          }]
        ]
        }))
        .pipe($.gulp.dest($.ppath.DIST + $.ppath.js.dest));
    });

	
	
  $.gulp.task('js-jquery', () => {
     return $.gulp.src('./src/js/vendor/jquery-3.3.1.min.js',)
    .pipe($.gulp.dest($.ppath.release + $.ppath.js.dest))  
  });
};