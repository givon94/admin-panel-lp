module.exports = function () {   

  $.gulp.task('rel', $.gulp.series(   
  	'rel-del',
    'pug-rel',
    'js-rel',
	'js-admin-rel',
     $.gulp.parallel(
		 'video-rel',
		 'imagesOther-rel',
         'images-rel',
         'sass-rel',
         'files-rel',
         'fonts-rel',
         'js-jquery',
         'php-rel',
         'css-rel',
     )
  ));
};