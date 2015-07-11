var gulp = require('gulp'),
	$ = require('gulp-load-plugins')(
		{
		  rename: {
		    'gulp-ruby-sass': 'sass',
		    'gulp-combine-media-queries': 'cmq',
		    'gulp-filesize': 'size'
		  }
		}
	);

var root = 'webroot/';
	
/*
*	SASS TASK
*/
gulp.task('sass', function() {

        // .pipe($.plumber({
        //     errorHandler: onError
        // }))
		return $.sass(root + 'sass/style.scss') 
			.on('error', function (err) {
			console.error('Error!', err.message);
			})
			.pipe($.cmq({
			    log: true
			}))
			.pipe($.autoprefixer({
			    browsers: ['last 2 versions'],
			    cascade: false
			}))
			.pipe(gulp.dest(root + 'css/'))
			//.pipe($.size())
			.pipe($.minifyCss({keepSpecialComments:0}))
			.pipe($.rename({suffix: '.min'}))
			.pipe(gulp.dest(root + 'css/'))
			//.pipe($.size())
			;
});

/*
 * SCRIPT
 */
gulp.task('script', function() {
    
    return gulp.src([
		root + 'js/jquery.js',
		root + 'js/main.js',
		])

		.pipe($.concat('script.js'))
		    .pipe(gulp.dest(root + 'js/' ))
		// .pipe($.size())
		.pipe($.uglify())
		// .pipe($.size())
		.pipe($.rename('script.min.js'))
		    .pipe(gulp.dest(root + 'js/' ));    
});


/*
 * WATCH
 */

gulp.task('watch', function() {
	gulp.watch(root + 'sass/*.scss', ['sass']);
});


/*
 * ICONFONT
 */

gulp.task('iconfont', function(){
  gulp.src([root + 'css/font/svg/*.svg'])
    .pipe($.iconfontCss({
      fontName: 'noddifont', // nom de la fonte, doit être identique au nom du plugin iconfont
      normalize: 'true',
      targetPath: '../noddifont.css', // emplacement de la css finale
      fontPath: root + 'css/font/' // emplacement des fontes finales
    }))
    .pipe($.iconfont({
    	normalize: 'true',
      fontName: 'noddifont' // identique au nom de iconfontCss
     }))
    .pipe( gulp.dest( root + 'css/font/') )
});

gulp.task('default', ['sass,']);